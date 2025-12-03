<?php

namespace App\Http\Controllers;

use App\Models\Matches;
use App\Models\Tournament;
use App\Models\Group;
use App\Models\Venue;
use App\Models\Referee;
use App\Models\GroupCreate;
use App\Models\Team;
use App\Models\MatchGroup;
use Illuminate\Http\Request;
use App\Models\TournamentCategory;

use function PHPUnit\Framework\matches;

class MatchesController extends Controller
{
     // Display a listing of the matches
     public function index()
     {
         $tournaments = Tournament::all();
         $matches = Matches::with(['team1','team2','groupcreate','category'])->get();
        //  dd($matches);
         $venues = Venue::all();
         $referee = Referee::all();
         $groups = Group::all();
         $groupcreate = GroupCreate::all();
         $teams = Team::all();
         return view('matches.matches', compact('matches','tournaments','venues','referee', 'groups', 'groupcreate', 'teams'));
     }
 
     // Show the form for creating a new match
     public function create()
     {
        // Fetch all tournaments
        $tournaments = Tournament::all();
        $matches = Matches::with(['team1','team2','groupcreate'])->get();
        $venues = Venue::all();
        $referee = Referee::all();
        $groups = Group::all();
        $groupcreate = GroupCreate::all();
        $teams = Team::all();
    // Pass tournaments to the view
         return view('matches', compact('matches','tournaments','venues','referee', 'groups', 'groupcreate', 'teams'));
     }
 
     // Store a newly created match in the database
     public function store(Request $request)
     
     {  

        Matches::create([
            'team1_id' => $request->team1_name,
            'team2_id' => $request->team2_name,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'group_id' => $request->group,
            'venue' => $request->venue,
            'tournament_id'=>$request->tournament_id,
            'scoring_referee' => $request->scoring_referee,
            'timing_referee' => $request->timing_referee
        ]);
       
        
         // Redirect to a relevant page
        //  $MatchesController = new MatchesController();
        // return $MatchesController->index();

        return redirect()->route('matches.index')->with('success', 'Match created successfully!');
         // return redirect()->route('matches')->with('success', 'Match created successfully!');
     }
 
     // Display the specified match
     public function show(Matches $matches)
     {
         return view('matches.show', compact('matches'));
     }
 
     // Show the form for editing the specified match
     public function edit($id)
        {
            $matches = Matches::findOrFail($id); // Retrieve the match by its ID
            $groups = Group::all(); // Fetch groups if necessary for dropdowns
            $venues = Venue::all();

            return view('matches.edit', compact('matches', 'groups', 'venues'));
        }

 
     // Update the specified match in the database
     public function update(Request $request, $id) {
        $matches = Matches::findOrFail($id);
        
        // Validate and update the match
        $matches->update($request->all());
    
        return redirect()->route('matches.index')->with('success', 'Match updated successfully');
    }
    
    // Fetch groups based on tournament ID
// Auto-create matches based on selected group
    public function autoCreateMatches(Request $request)
    {
        $tournamentId    = $request->tournament_id;
        $scoringReferee  = $request->scoring_referee;
        $timingReferee   = $request->timing_referee;
        $venueId         = $request->venue;
        $venue           = Venue::find($venueId)->name ?? '';

        $matchDuration   = 11; // minutes
        $breakDuration   = 4;  // minutes
        $currentTime     = \Carbon\Carbon::parse($request->start_time);

        // Get categories for the tournament (if none, use a single null category for "no category")
        $categories = TournamentCategory::where('tournament_id', $tournamentId)->get();
        if ($categories->isEmpty()) {
            // create a single dummy "category" slot so groups without category are processed
            $categories = collect([ (object)['id' => null] ]);
        }

        // Build matches-per-group using standard round-robin (circle) algorithm
        // $matchesByGroup[groupId] = [ round0 => [ [teamA,teamB], ... ], round1 => [...], ... ]
        $matchesByGroup = [];
        $groupCategoryMap = []; // keep category mapping for each group

        foreach ($categories as $category) {
            $categoryId = $category ? $category->id : null;

            $groupsQuery = GroupCreate::where('TournamentID', $tournamentId);
            if ($categoryId !== null) {
                $groupsQuery->where('category_id', $categoryId);
            }
            $groups = $groupsQuery->get();

            foreach ($groups as $group) {
                // gather teamIDs in this group
                $teamRows = Group::where('tournament_id', $tournamentId)
                    ->where('groupcreateID', $group->GroupID)
                    ->get()->pluck('teamID')->toArray();

                // store mapping
                $groupCategoryMap[$group->GroupID] = $categoryId;

                // if less than 2 teams -> no matches
                if (count($teamRows) < 2) {
                    $matchesByGroup[$group->GroupID] = []; // no rounds
                    continue;
                }

                // If odd number of teams, add a bye (null)
                if (count($teamRows) % 2 !== 0) {
                    $teamRows[] = null;
                }

                $n = count($teamRows);         // even
                $rounds = $n - 1;             // number of rounds in round-robin
                $half = $n / 2;

                // make a working array
                $teams = $teamRows;

                $groupRounds = []; // will hold rounds

                for ($r = 0; $r < $rounds; $r++) {
                    $pairs = [];
                    for ($i = 0; $i < $half; $i++) {
                        $teamA = $teams[$i];
                        $teamB = $teams[$n - 1 - $i];

                        // skip matches with bye (null)
                        if ($teamA === null || $teamB === null) {
                            continue;
                        }

                        $pairs[] = [$teamA, $teamB];
                    }

                    $groupRounds[] = $pairs;

                    // rotate for next round (standard circle method keeping first element fixed)
                    // teams = [ first, ...rest... ]
                    $first = $teams[0];
                    $rest  = array_slice($teams, 1);

                    // rotate rest right by 1: last of rest becomes first of rest
                    array_unshift($rest, array_pop($rest));

                    // rebuild teams
                    $teams = array_merge([$first], $rest);
                }

                $matchesByGroup[$group->GroupID] = $groupRounds;
            }
        }

        // Find maximum number of rounds across all groups
        $maxRounds = 0;
        foreach ($matchesByGroup as $groupId => $roundsArray) {
            $maxRounds = max($maxRounds, count($roundsArray));
        }

        // Now schedule in the order: for round = 0..maxRounds-1:
        //    for each category (in the $categories order)
        //       for each group of that category (in DB order)
        //           schedule that group's match for this round (if exists)
        foreach (range(0, $maxRounds - 1) as $roundIndex) {
            foreach ($categories as $category) {
                $categoryId = $category ? $category->id : null;

                // get groups for this category (preserve DB order)
                $groupsQuery = GroupCreate::where('TournamentID', $tournamentId);
                if ($categoryId !== null) $groupsQuery->where('category_id', $categoryId);
                $groups = $groupsQuery->get();

                foreach ($groups as $group) {
                    $groupId = $group->GroupID;

                    if (!isset($matchesByGroup[$groupId][$roundIndex])) {
                        continue; // no match for this group in this round
                    }

                    $pairs = $matchesByGroup[$groupId][$roundIndex];

                    foreach ($pairs as $pair) {
                        [$team1Id, $team2Id] = $pair;

                        // compute start/end in H:i format
                        $start = $currentTime->format('H:i');
                        $end   = $currentTime->copy()->addMinutes($matchDuration)->format('H:i');

                        // create Matches (your table)
                        Matches::create([
                            'team1_id' => $team1Id,
                            'team2_id' => $team2Id,
                            'date' => $request->date,
                            'start_time' => $start,
                            'end_time' => $end,
                            'group_id' => $groupId,
                            'venue_id' => $venueId,
                            'tournament_id' => $tournamentId,
                            'category_id' => $groupCategoryMap[$groupId] ?? null,
                            'scoring_refereeID' => $scoringReferee,
                            'timing_refereeID' => $timingReferee,
                        ]);

                        // create MatchGroup (your other table)
                        MatchGroup::create([
                            'TeamAID' => $team1Id,
                            'TeamBID' => $team2Id,
                            'Date' => $request->date,
                            'start_time' => $start,
                            'end_time' => $end,
                            'GroupID' => $groupId,
                            'Venue' => $venue,
                            'TournamentID' => $tournamentId,
                            'category_id' => $groupCategoryMap[$groupId] ?? null,
                            'ScoringRefereeID' => $scoringReferee,
                            'TimingRefereeID' => $timingReferee,
                        ]);

                        // advance time
                        $currentTime->addMinutes($matchDuration + $breakDuration);
                    }
                }
            }
        }

        return redirect()->route('matches.index')->with('success', 'Matches created successfully!');
    }

 
     // Remove the specified match from the database
     public function destroy(Matches $match)
     {
         $match->delete();
 
         return redirect()->route('matches')->with('success', 'Match deleted successfully!');
     }

    public function getGroupsByTournament($tournamentId)
    {
        // dd($tournamentId);
        // Fetch groups that belong to the selected tournament
        $groups = GroupCreate::where('TournamentID', $tournamentId)->get();
        // dd($groups);
        // Return the groups as JSON
        return response()->json($groups);
    }

    public function getGroupsByTournamentAndCategory($tournamentId, $categoryId)
    {
        $groups = GroupCreate::where('TournamentID', $tournamentId)
            ->where('category_id', $categoryId)
            ->get();

        // dd($groups);

        return response()->json($groups);
    }


}

