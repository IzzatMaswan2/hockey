<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MatchGroup;
use App\Models\Team;
use App\Models\Tournament;    
use App\Models\Player;
use App\Models\Referee;

class MatchTeamController extends Controller
{
    public function showMatchDetails($matchGroupId)
    {
        $matchDetail =MatchGroup::where('Match_groupID', $matchGroupId)->first();

        $allPlayers = Player::all()->keyBy('id');

        $teamAID = $matchDetail->TeamAID;
        $teamBID = $matchDetail->TeamBID;

        $teamAInfo = Team::select('Name', 'logoURL')->where('teamID', $teamAID)->first();
        $teamBInfo = Team::select('Name', 'logoURL')->where('teamID', $teamBID)->first();

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

        $playerCollect = [
            'starterA'=>$startingA,
            'reserveA'=>$reserveA,
            'starterB'=>$startingB,
            'reserveB'=>$reserveB,
        ];

        $SRefereeID = $matchDetail -> ScoringRefereeID;
        $TRefereeID = $matchDetail -> TimingRefereeID;

        $ScoringRefereeID = Referee::select('Name')->where('id', $SRefereeID)->first();
        $TimingRefereeID = Referee::select('Name')->where('id', $TRefereeID)->first();

        $TourID = $matchDetail -> TournamentID;

        $TournamentName = Tournament::select('Name') -> where('id', $TourID)->first();

        return view('user.match', [
            'teamAInfo' => $teamAInfo,
            'teamBInfo' => $teamBInfo,
            'matchDetail' => $matchDetail,
            'ScoringRefereeID' => $ScoringRefereeID,
            'TimingRefereeID' => $TimingRefereeID,
            'TournamentName' => $TournamentName,
            'playerCollect' => $playerCollect
        ]);

    }
}
