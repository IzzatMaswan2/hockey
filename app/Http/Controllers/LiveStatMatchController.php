<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MatchGroup;
use App\Models\PlayerStatMatch;
use App\Models\Player;
use App\Models\Team;   
use App\Models\Referee;   
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
        $allPlayers = Player::all()->keyBy('id');

        // Retrieve Team IDs
        $teamAID = $match->TeamAID;
        $teamBID = $match->TeamBID;

        $teamAPlayers = $allPlayers->filter(fn($player) => $player->teamID == $teamAID);
        $startingA = $teamAPlayers->where('field_status', 'Active')->take(11);
        $reserveA = $teamAPlayers->where('field_status', 'Bench')->take(5);
        $nameStartingA = $startingA->pluck('displayName');
        $nameReserveA = $reserveA->pluck('displayName');

        $teamBPlayers = $allPlayers->filter(fn($player) => $player->teamID == $teamBID);
        $startingB = $teamBPlayers->where('field_status', 'Active')->take(11);
        $reserveB = $teamBPlayers->where('field_status', 'Bench')->take(5);
        $nameStartingB = $startingB->pluck('displayName');
        $nameReserveB = $reserveB->pluck('displayName');

        $startingA = array_pad($nameStartingA->toArray(), 11, '-');
        $startingB = array_pad($nameStartingB->toArray(), 11, '-');
        $reserveA = array_pad($nameReserveA->toArray(), 5, '-');
        $reserveB = array_pad($nameReserveB->toArray(), 5, '-');
        
        // Retrieve team information
        $teamAInfo = Team::select('Name', 'logoURL')->where('teamID', $teamAID)->first();
        $teamBInfo = Team::select('Name', 'logoURL')->where('teamID', $teamBID)->first();

        
        $liveMatchDetails = [
            'teamA' => $teamAInfo,
            'starterA'=>$startingA,
            'reserveA'=>$reserveA,
            'teamB' => $teamBInfo,
            'starterB'=>$startingB,
            'reserveB'=>$reserveB,
            'match' => $match
        ];

        $SRefereeID = $match -> ScoringRefereeID;
        $TRefereeID = $match -> TimingRefereeID;

        $ScoringRefereeID = Referee::select('Name')->where('id', $SRefereeID)->first();
        $TimingRefereeID = Referee::select('Name')->where('id', $TRefereeID)->first();

        $TourID = $match -> TournamentID;

        $TournamentName = Tournament::select('name') -> where('id', $TourID)->first();

        // dd($teamAPlayers, $teamBPlayers);

        // Return view with data
        return view('user.livematch', [
            'match' => $match,
            'stats' => $stats,
            'teamAPlayers' => $teamAPlayers,
            'teamBPlayers' => $teamBPlayers,
            'liveMatchDetails' => $liveMatchDetails,
            'ScoringRefereeID' => $ScoringRefereeID,
            'TimingRefereeID' => $TimingRefereeID,
            'TournamentName' => $TournamentName
        ]);
    }
}

