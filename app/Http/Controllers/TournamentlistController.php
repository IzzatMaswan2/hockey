<?php

namespace App\Http\Controllers;

use App\Models\GroupCreate;
use App\Models\MatchGroup;
use App\Models\Group;
use App\Models\Competition;
use App\Models\Matches;
use App\Models\Team;
use Illuminate\Http\Request;
use App\Models\Tournament;
use App\Models\TournamentCategory;

class TournamentlistController extends Controller
{
    // Method to display the list of tournaments
    public function create()
    {
        // Retrieve all tournaments from the database
        $tournaments = Tournament::where('archived',1)->get();
        // Return the tournament list view with the tournaments data
        return view('tournamentlist', compact('tournaments'));
    }

    // Method to store a new tournament in the database
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'no_team' => 'required|integer|max:255',
            'no_group' => 'required|integer|max:255',
            'start_date' => 'required|date',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'end_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'description' => 'required|string',
            'venue_id' => 'required|integer|max:255',
            'category' => 'required|string|max:255',
        ]);

        // Create a new tournament record in the database
        Tournament::create($validatedData);

        // Redirect back to the tournament list view with a success message
        return redirect()->route('tournamentlist.view')->with('success', 'Tournament added successfully');
    }

    
    public function show($id)
    {
        $tournament = Tournament::findOrFail($id);
    
        $selectedCategoryId = request('category_id');

        // dd($selectedCategoryId);

        if (!$selectedCategoryId) {
            $firstCategory = TournamentCategory::where('tournament_id', $id)->first();
            if ($firstCategory) {
                $selectedCategoryId = $firstCategory->id;
            }
        }

        // dd($selectedCategoryId);

        // Live Matches
        $liveMatches = MatchGroup::where('TournamentID', $id)
            ->where('match_status', 1)
            ->when($selectedCategoryId, fn($q) => $q->where('category_id', $selectedCategoryId))
            ->with('category','groupcreate')
            ->get();

        // Upcoming Matches
        $upcomingMatches = MatchGroup::where('TournamentID', $id)
            ->where('match_status', 0)
            ->when($selectedCategoryId, fn($q) => $q->where('category_id', $selectedCategoryId))
            ->with('category','groupcreate')
            ->get();

        // Result Matches
        $resultMatches = MatchGroup::where('TournamentID', $id)
            ->where('match_status', 2)
            ->when($selectedCategoryId, fn($q) => $q->where('category_id', $selectedCategoryId))
            ->with('category','groupcreate')
            ->get();


        // dd($resultMatches);
    
        $liveMatchDetails = [];
        $upcomingMatchDetail = [];
        $resultMatchDetail = []; 

        foreach ($upcomingMatches as $upmatch) {
            $teamA = $upmatch->TeamAID;
            $teamB = $upmatch->TeamBID;
    
            $teamAInfo = Team::select('Name', 'logoURL', 'country')->where('teamID', $teamA)->first();
            $teamBInfo = Team::select('Name', 'logoURL', 'country')->where('teamID', $teamB)->first();
    
            $upcomingMatchDetail[] = [
                'teamA' => $teamAInfo,
                'teamB' => $teamBInfo,
                'upmatch' => $upmatch
            ];
        }

        foreach ($resultMatches as $resultmatch) {
            $teamA = $resultmatch->TeamAID;
            $teamB = $resultmatch->TeamBID;
    
            $teamAInfo = Team::select('Name', 'logoURL')->where('teamID', $teamA)->first();
            $teamBInfo = Team::select('Name', 'logoURL')->where('teamID', $teamB)->first();
    
            $resultMatchDetail[] = [
                'teamA' => $teamAInfo,
                'teamB' => $teamBInfo,
                'resultmatch' => $resultmatch
            ];
        }

        foreach ($liveMatches as $match) {
            $teamA = $match->TeamAID;
            $teamB = $match->TeamBID;
    
            $teamAInfo = Team::select('Name', 'logoURL')->where('teamID', $teamA)->first();
            $teamBInfo = Team::select('Name', 'logoURL')->where('teamID', $teamB)->first();
    
            $liveMatchDetails[] = [
                'teamA' => $teamAInfo,
                'teamB' => $teamBInfo,
                'match' => $match
            ];
        }
    
        // $selectedCategoryId = request('category_id'); 
        if ($selectedCategoryId) {
            $groups = GroupCreate::where('TournamentID', $id)
                ->where('category_id', $selectedCategoryId)
                ->get();
            // dd($id);
        } else {
            $groups = GroupCreate::where('TournamentID', $id)->get();
        }

        // dd($groups);

        // dd($groups);
        
        $groupData = [];
    
        foreach ($groups as $group) {
            $groupteam = Group::where('groupcreateID', $group->GroupID)->get();
            
            $maxTeams = match($group->Name) {
                'Group A' => 4,
                'Group B' => 8,
                'Group C' => 16,
                default => $groupteam->count(),
            };
        
            $sortedTeams = $groupteam->sortByDesc('points')->take($maxTeams)->values()->map(function($team, $index) {
                $team->rank = $index + 1;
                return $team;
            });
        
            $groupData[] = [
                'group' => $group,
                'groupteam' => $sortedTeams,
            ];
        }

        // dd($groupData);
                
        $teamsjoin = Competition::where('tournament_id', $id)
            ->when($selectedCategoryId, fn($q) => $q->where('category_id', $selectedCategoryId))
            ->with('team')
            ->get();


        $perPage = 10;
        $currentPage = request('page', 1);
        $teamsForCurrentPage = $teamsjoin->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $totalTeams = $teamsjoin->count();

        $teams = Team::all()->keyBy('teamID');

        $registeredTeamCount = $teamsjoin->count();
        $maxTeams = $tournament->no_team;

        $isRegistrationFull = $registeredTeamCount >= $maxTeams;

        $matchesbraket = Matches::where('tournament_id', $id)
            ->where('knockout', 1)
            ->with(['team1', 'team2']) 
            ->get();

        $bracket = [
            'quarter_finals' => [
                'left' => ['top' => null, 'bottom' => null],
                'right' => ['top' => null, 'bottom' => null],
            ],
            'semi_finals' => ['left' => null, 'right' => null],
            'final' => null,
            'champion' => null,
        ];

        foreach ($matchesbraket as $match) {
            if ($match->stage == 1) {
                if ($match->side == 'left' && $match->side2 == 'top') {
                    $bracket['quarter_finals']['left']['top'] = ['team1' => $match->team1->name, 'team2' => $match->team2->name];
                } elseif ($match->side == 'left' && $match->side2 == 'bottom') {
                    $bracket['quarter_finals']['left']['bottom'] = ['team1' => $match->team1->name, 'team2' => $match->team2->name];
                } elseif ($match->side == 'right' && $match->side2 == 'top') {
                    $bracket['quarter_finals']['right']['top'] = ['team1' => $match->team1->name, 'team2' => $match->team2->name];
                } elseif ($match->side == 'right' && $match->side2 == 'bottom') {
                    $bracket['quarter_finals']['right']['bottom'] = ['team1' => $match->team1->name, 'team2' => $match->team2->name];
                }
            } elseif ($match->stage == 2) {
                if ($match->side == 'left') {
                    $bracket['semi_finals']['left'] = ['team1' => $match->team1->name, 'team2' => $match->team2->name];
                } elseif ($match->side == 'right') {
                    $bracket['semi_finals']['right'] = ['team1' => $match->team1->name, 'team2' => $match->team2->name];
                }
            } elseif ($match->stage == 3) {
                $bracket['final'] = ['team1' => $match->team1->name, 'team2' => $match->team2->name];
                
                if ($match->score1 > $match->score2) {
                    $bracket['champion'] = ['team1' => $match->team1->name, 'team2' => null];
                } elseif ($match->score2 > $match->score1) {
                    $bracket['champion'] = ['team1' => null, 'team2' => $match->team2->name];
                }
            }
        }

        $allRegistrations = Competition::where('tournament_id', $id)->get(); // ignore category filter
        $categories = TournamentCategory::where('tournament_id', $id)->get();

        $availableCategories = $categories->filter(function($cat) use ($allRegistrations) {
            $registeredTeams = $allRegistrations->where('category_id', $cat->id)->count();
            return $registeredTeams < $cat->max_teams;
        });
        // dd($teamsjoin);

        return view('tournament-details')
            ->with('selectedCategoryId', $selectedCategoryId)
            ->with('availableCategories', $availableCategories)
            ->with('tournament', $tournament)
            ->with('liveMatchDetails', $liveMatchDetails)
            ->with('liveMatches', $liveMatches)
            ->with('upcomingMatchDetail', $upcomingMatchDetail)
            ->with('resultMatchDetail', $resultMatchDetail)
            ->with('groupData', $groupData)
            ->with('teams', $teams)
            ->with('teamsjoin', $teamsjoin)
            ->with('isRegistrationFull', $isRegistrationFull)
            ->with('bracket', $bracket)
            ->with('teamsForCurrentPage', $teamsForCurrentPage)
            ->with('currentPage', $currentPage)
            ->with('perPage', $perPage)
            ->with('totalTeams', $totalTeams);
    }
    
    

}