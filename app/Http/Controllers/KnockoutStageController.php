<?php

namespace App\Http\Controllers;

use App\Models\Group;
// use App\Models\Knockout;
use App\Models\Matches;
use App\Models\Team;
use App\Models\Venue;
use App\Models\Referee;
use App\Models\Tournament;
use Illuminate\Http\Request;

class KnockoutStageController extends Controller
{
    
    public function getTopTeams($tournament_id)
    {
        // Step 1: Fetch all teams grouped by groupcreateID
        $groups = Group::with([
            'team:teamID,Name,logoURL',
            'groupcreate'
        ])
        ->where('tournament_id', $tournament_id)
        ->orderBy('groupcreateID')
        ->get()
        ->groupBy('groupcreateID');

        // dd($groups);
        $teams = [];
        $groupWinners = [];
        $groupRunnerUps = [];
        $qualifiedTeamIds = []; // Keep track of qualified team IDs

        // Step 2: Get winner and runner-up from each group
        foreach ($groups as $group) {
            $sortedGroup = $group->sortByDesc(function ($team) {
                return [$team->points, $team->gd];
            });

            $winner = $sortedGroup->first();
            $runnerUp = $sortedGroup->skip(1)->first();

            $groupWinners[] = $winner;
            $groupRunnerUps[] = $runnerUp;

            $qualifiedTeamIds[] = $winner->team_id;
            if ($runnerUp) {
                $qualifiedTeamIds[] = $runnerUp->team_id;
            }
        }

        // dd($groupRunnerUps);

        // Total number of groups and calculate the required teams based on tournament structure
        $totalGroups = count($groups);
        $requiredTeams = $this->getRequiredTeamCount($totalGroups);

        // Step 3: Determine the number of runner-ups to select
        if (count($groupWinners) >= $requiredTeams) {
            // If winners alone meet the required team count
            $teams = array_slice($groupWinners, 0, $requiredTeams);
        } else {
            // Combine winners with the best runner-ups
            // Pass the original groups to selectBestRunnerUps
            $bestRunnerUps = $this->selectBestRunnerUps($groups, $qualifiedTeamIds, $requiredTeams - count($groupWinners));
            $teams = array_merge($groupWinners, $bestRunnerUps->toArray());
        }

        // dd($teams);

        // dd($bestRunnerUps);

        // Step 4: Sort teams by points and goal difference
        // usort($teams, function ($a, $b) {
        //     return $b->points <=> $a->points ?: $b->gd <=> $a->gd;
        // });

        return view('tournament.knockout', [
            'teams' => $teams,
            'groupWinners' => $groupWinners,
            'groupRunnerUps' => $groupRunnerUps,
            'TourID' => $tournament_id,
            'runnerup' =>  $bestRunnerUps,
        ]);
    }

    private function selectBestRunnerUps($groups, $qualifiedTeamIds, $count)
    {
        $runnerUps = collect();

        foreach ($groups as $group) {
            $sortedGroup = $group->sortByDesc(function ($team) {
                return [$team->points, $team->gd];
            });

            $runnerUp = $sortedGroup->skip(1)->first();
            if ($runnerUp) {
                $runnerUps->push($runnerUp);
            }
        }

        // Sort runner-ups by points and GD, then take the top X (based on count)
        return $runnerUps->sortByDesc(function ($team) {
            return [$team->points, $team->gd];
        })->take($count);
    }


    private function getRequiredTeamCount($totalGroups)
    {
        // Adjust based on total groups; for example:
        if ($totalGroups <= 8) {
            return 8; // Use top 8 teams
        } elseif ($totalGroups <= 16) {
            return 16; // Use top 16 teams
        } else {
            return 32; // Use top 32 teams
        }
    }

    public function createKnockoutMatches(Request $request) 
    {
        // Step 1: Fetch only teamID and groupcreateID for winners and runner-ups
        $teamsData = $this->getTopTeams($request->TourID);
        $groupWinners = collect($teamsData['groupWinners'])->map(fn($team) => ['teamID' => $team->teamID, 'groupcreateID' => $team->groupcreateID]);
        $groupRunnerUps = collect($teamsData['runnerup'])->map(fn($team) => ['teamID' => $team->teamID, 'groupcreateID' => $team->groupcreateID]);
    
        // Step 2: Determine total teams and assign the knockout round size
        $totalTeams = $groupWinners->count() + $groupRunnerUps->count();
        $round = $totalTeams <= 8 ? 8 : ($totalTeams <= 16 ? 16 : 32);
    
        // Step 3: Prepare labels for side positioning in matches
        $sideLabels = array_map(fn($i) => chr(65 + $i), range(0, $totalTeams / 2 - 1));
        $matchIndex = 0;
    
        $leftGroups = $rightGroups = [];
        $leftSideTeams = [];
        $rightSideTeams = [];
    
        // Step 4: Group teams by `groupcreateID` and assign based on count
        $groupedTeams = $groupWinners->merge($groupRunnerUps)->groupBy('groupcreateID');
    
        // Prioritize groups with two teams, assigning them alternately
        foreach ($groupedTeams as $groupTeams) {
            if ($groupTeams->count() === 2) {
                // Split group across left and right sides
                $leftSideTeams[] = $groupTeams[0];
                $rightSideTeams[] = $groupTeams[1];
                $leftGroups[$groupTeams[0]['groupcreateID']] = true;
                $rightGroups[$groupTeams[1]['groupcreateID']] = true;
            } else {
                // Handle single-team groups based on side balance
                if (count($leftSideTeams) <= count($rightSideTeams)) {
                    $leftSideTeams[] = $groupTeams[0];
                    $leftGroups[$groupTeams[0]['groupcreateID']] = true;
                } else {
                    $rightSideTeams[] = $groupTeams[0];
                    $rightGroups[$groupTeams[0]['groupcreateID']] = true;
                }
            }
        }
    
        // Randomize the left and right side teams
        shuffle($leftSideTeams);
        shuffle($rightSideTeams);

    
        // Function to assign teams to a match
        function createMatch($team1, $team2, $currentSide, $matchIndex, $sideLabels, $round, $tournamentID) {
            Matches::create([
                'tournament_id' => $tournamentID,
                'team1_id' => $team1['teamID'],
                'team2_id' => $team2['teamID'],
                'knockout' => true,
                'stage' => $round,
                'side' => $currentSide,
                'side2' => $sideLabels[$matchIndex],
            ]);
        }
    
        // Step 5: Pair teams from left and right sides and create a single match for each pair
        foreach ($leftSideTeams as $i => $team1) {
            $team2 = $rightSideTeams[$i] ?? null;
            if ($team2) {
                $side = $i % 2 == 0 ? 'left' : 'right'; // Alternate starting with 'left'
                createMatch($team1, $team2, $side, $matchIndex, $sideLabels, $round, $request->TourID);
                $matchIndex++;
            }
        }
    
        return $this->redirectToKnockoutMatch($request->TourID);
    }
    
    
    public function showKnockoutMatches($tournament_id)
    {

        $venues = Venue::all();

        // Fetch all the referees
        $referees = Referee::all();
        // Fetch the knockout matches for the given tournament
        $knockoutMatches = Matches::with(['team1', 'team2', 'venue','scoringReferee','timingReferee'])
            ->where('tournament_id', $tournament_id)
            ->where('knockout', true)
            ->get();

        // dd($knockoutMatches);

        // Filter matches by their respective stages
        $quarterfinals = $knockoutMatches->where('stage', 1); // Assuming stage 1 is for quarter-finals
        $semifinals = $knockoutMatches->where('stage', 2); // Assuming stage 2 is for semi-finals
        $finals = $knockoutMatches->where('stage', 3); // Assuming stage 3 is for finals

        // Fetch the tournament details
        $tournament = Tournament::find($tournament_id);

        return view('tournament.knockoutmatch', [
            'knockoutMatches' => $knockoutMatches,
            'quarterfinals' => $quarterfinals,
            'semifinals' => $semifinals,
            'finals' => $finals,
            'tournament_id' => $tournament_id,
            'tournament' => $tournament,
            'venues' => $venues,
        'referees' => $referees,
        ]);
    }


    public function redirectToKnockoutMatch($tournamentId)
    {
        // Redirect to the new page for knockout matches
        return redirect()->route('knockout.match', ['tournament_id' => $tournamentId]);
    }

    public function update(Request $request, $id)
    {
        // Find the knockout match by ID
        $match = Matches::findOrFail($id);

        // dd($match, $request->input('Date'));
        // Create an array of fields to update, only including non-null values
        $updateData = [];

        if ($request->filled('Date')) {
            $updateData['date'] = $request->input('Date');
        }
        if ($request->filled('start_time')) {
            $updateData['start_time'] = $request->input('start_time');
        }
        if ($request->filled('end_time')) {
            $updateData['end_time'] = $request->input('end_time');
        }
        if ($request->filled('venue')) {
            $updateData['venue_id'] = $request->input('venue');
        }
        if ($request->filled('ScoringRefereeID')) {
            $updateData['scoring_refereeID'] = $request->input('ScoringRefereeID');
        }
        if ($request->filled('TimingRefereeID')) {
            $updateData['timing_refereeID'] = $request->input('TimingRefereeID');
        }
        if ($request->filled('ScoreA')) {
            $updateData['Score1'] = $request->input('ScoreA');
        }
        if ($request->filled('ScoreB')) {
            $updateData['Score2'] = $request->input('ScoreB');
        }

        // Update the match with the provided data
        $match->update($updateData);

        // Check if scores have been provided, then set error to 0
        if ($request->filled('ScoreA') && $request->filled('ScoreB')) {
            $match->update(['error' => 0]);
        }

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Match updated successfully.');
    }

    

}
