<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MatchGroup;
use App\Models\PlayerStatMatch;
use App\Models\Player;
use App\Models\Team;   
use App\Models\Judge;   
use App\Models\Tournament;
use Illuminate\Cache\RateLimiting\Limit;

class LiveStatMatchController extends Controller
{
    public function showLiveMatch($matchGroupId)
    {
        // Retrieve match details
        $match = MatchGroup::where('Match_groupID', $matchGroupId)->first();

        if (!$match) {
            abort(404, 'Match not found.');
        }

        // Retrieve player statistics for the specific match
        $stats = PlayerStatMatch::where('Match_groupID', $matchGroupId)->get();

        // Retrieve all players and index by PlayerID
        $allPlayers = Player::all()->keyBy('PlayerID');

        // Retrieve Team IDs
        $teamAID = $match->TeamAID;
        $teamBID = $match->TeamBID;

        // Filter players by Team A and Team B
        $teamAPlayers = $allPlayers->filter(fn($player) => $player->teamID == $teamAID);
        $startingA = $teamAPlayers->where('field_status', 1)->take(5);
        $reserveA = $teamAPlayers->where('field_status', 2)->take(5);
        $nameStartingA = $startingA->pluck('Name');
        $nameReserveA = $reserveA->pluck('Name');

        $teamBPlayers = $allPlayers->filter(fn($player) => $player->teamID == $teamBID);
        $startingB = $teamBPlayers->where('field_status', 1)->take(5);
        $reserveB = $teamBPlayers->where('field_status', 2)->take(5);
        $nameStartingB = $startingB->pluck('Name');
        $nameReserveB = $reserveB->pluck('Name');

        $startingA = array_pad($nameStartingA->toArray(), 5, '-');
        $startingB = array_pad($nameStartingB->toArray(), 5, '-');
        $reserveA = array_pad($nameReserveA->toArray(), 5, '-');
        $reserveB = array_pad($nameReserveB->toArray(), 5, '-');
        
        // Retrieve team information
        $teamAInfo = Team::select('Name', 'logoURL')->where('teamID', $teamAID)->first();
        $teamBInfo = Team::select('Name', 'logoURL')->where('teamID', $teamBID)->first();

        // Prepare live match details
        $liveMatchDetails = [
            'teamA' => $teamAInfo,
            'starterA'=>$startingA,
            'reserveA'=>$reserveA,
            'teamB' => $teamBInfo,
            'starterB'=>$startingB,
            'reserveB'=>$reserveB,
            'match' => $match
        ];

        $SJudgeID = $match -> ScoringJudgeID;
        $TJudgeID = $match -> TimingJudgeID;

        $ScoringJudgeID = Judge::select('Name')->where('JudgeID', $SJudgeID)->first();
        $TimingJudgeID = Judge::select('Name')->where('JudgeID', $TJudgeID)->first();

        $TourID = $match -> TournamentID;

        $TournamentName = Tournament::select('Name') -> where('TournamentID', $TourID)->first();

        // Return view with data
        return view('user.livematch', [
            'match' => $match,
            'stats' => $stats,
            'teamAPlayers' => $teamAPlayers,
            'teamBPlayers' => $teamBPlayers,
            'liveMatchDetails' => $liveMatchDetails,
            'ScoringJudgeID' => $ScoringJudgeID,
            'TimingJudgeID' => $TimingJudgeID,
            'TournamentName' => $TournamentName
        ]);
    }
}

