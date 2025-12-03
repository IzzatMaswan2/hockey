<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matches; // Assuming you have a Match model
use App\Models\Team;
use App\Models\MatchGroup;
use App\Models\Tournament;
use Carbon\Carbon; 

class FixtureController extends Controller
{
    public function tournamentList()
    {
        $tournaments = Tournament::all();
        return view('fixture.tournamentlist', compact('tournaments'));
    }



    public function index($id)
{
    $tournament = Tournament::findOrFail($id);

    // // Get matches for the tournament
    $liveMatches = Matches::where('tournament_id', $id)->where('match_status', 1)->get();
    $upcomingMatches = Matches::where('tournament_id', $id)->where('match_status', 0)->get();
    $resultMatches = Matches::where('tournament_id', $id)->where('match_status', 2)->get();

    // Collect all team IDs from the matches
    $teamIds = array_merge(
        $liveMatches->pluck('team1_id')->toArray(),
        $liveMatches->pluck('team2_id')->toArray(),
        $upcomingMatches->pluck('team1_id')->toArray(),
        $upcomingMatches->pluck('team2_id')->toArray(),
        $resultMatches->pluck('team1_id')->toArray(),
        $resultMatches->pluck('team2_id')->toArray()
    );

    // Fetch team details in one query to avoid repeated queries
    $teams = Team::whereIn('teamID', array_unique($teamIds))->get()->keyBy('teamID');

    // Process upcoming matches
    if ($upcomingMatches->isNotEmpty()) {
        $upcomingMatchDetail = $upcomingMatches->map(function ($upmatch) use ($teams) {
            return [
                'team1' => $teams->get($upmatch->team1_id),
                'team2' => $teams->get($upmatch->team2_id),
                'upmatch' => $upmatch
            ];
        });
    } else {
        $upcomingMatchDetail = collect(); // Empty collection if no upcoming matches
    }

    // Process result matches
    $resultMatchDetail = $resultMatches->map(function ($resultmatch) use ($teams) {
        return [
            'team1' => $teams->get($resultmatch->team1_id),
            'team2' => $teams->get($resultmatch->team2_id),
            'resultmatch' => $resultmatch
        ];
    });

    // Process live matches
    $liveMatchDetails = $liveMatches->map(function ($match) use ($teams) {
        return [
            'team1' => $teams->get($match->team1_id),
            'team2' => $teams->get($match->team2_id),
            'match' => $match
        ];
    });

    // Section for the table group - team 
    // $groups = GroupCreate::where('TournamentID', $id)->get();

    // $groupData = $groups->map(function ($group) {
    //     $groupteam = Group::where('groupcreateID', $group->GroupID)->get();

    //     $sortedTeams = $groupteam->sortByDesc('points')->values()->map(function ($team, $index) {
    //         $team->rank = $index + 1;
    //         return $team;
    //     });

    //     return [
    //         'group' => $group,
    //         'groupteam' => $sortedTeams,
    //     ];
    // });

    // Fetch only teams that are registered for this specific tournament
    // $teamsjoin = Competition::where('tournament_id', $id)
    //     ->with('team') // Ensure this relationship is set correctly in the Competition model
    //     ->get();

    // $registeredTeamCount = $teamsjoin->count();
    // $maxTeams = $tournament->no_team; // Assuming `no_team` is the maximum teams allowed

    // $isRegistrationFull = $registeredTeamCount >= $maxTeams;

    // Return the tournament details view with the specific tournament data
    return view('fixture.index')
        ->with('tournament', $tournament)
        ->with('liveMatchDetails', $liveMatchDetails)
        ->with('liveMatches', $liveMatches)
        ->with('upcomingMatchDetail', $upcomingMatchDetail)
        ->with('resultMatchDetail', $resultMatchDetail)
         ->with('teams', $teams);
        // ->with('groupData', $groupData)
        // ->with('teamsjoin', $teamsjoin)
        // ->with('isRegistrationFull', $isRegistrationFull);
}

}
