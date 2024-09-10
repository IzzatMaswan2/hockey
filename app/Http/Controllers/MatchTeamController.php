<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MatchGroup;
use App\Models\Team;
use App\Models\Judge;
use App\Models\Tournament;    
use App\Models\Player;

class MatchTeamController extends Controller
{
    public function showMatchDetails($matchGroupId)
    {
        $matchDetail =MatchGroup::where('Match_groupID', $matchGroupId)->first();

        $teamAID = $matchDetail->TeamAID;
        $teamBID = $matchDetail->TeamBID;

        $teamAInfo = Team::select('Name', 'logoURL')->where('TeamID', $teamAID)->first();
        $teamBInfo = Team::select('Name', 'logoURL')->where('TeamID', $teamBID)->first();

        $teamAPlayers = Player::where('TeamID', $teamAID)->get();
        $startingA = $teamAPlayers->where('field_status', 1)->take(5);
        $reserveA = $teamAPlayers->where('field_status', 2)->take(5);
        $nameStartingA = $startingA->pluck('Name');
        $nameReserveA = $reserveA->pluck('Name');

        $teamBPlayers = Player::where('TeamID', $teamBID)->get();
        $startingB = $teamBPlayers->where('field_status', 1)->take(5);
        $reserveB = $teamBPlayers->where('field_status', 2)->take(5);
        $nameStartingB = $startingB->pluck('Name');
        $nameReserveB = $reserveB->pluck('Name');

        $startingA = array_pad($nameStartingA->toArray(), 5, '-');
        $startingB = array_pad($nameStartingB->toArray(), 5, '-');
        $reserveA = array_pad($nameReserveA->toArray(), 5, '-');
        $reserveB = array_pad($nameReserveB->toArray(), 5, '-');

        $playerCollect = [
            'starterA'=>$startingA,
            'reserveA'=>$reserveA,
            'starterB'=>$startingB,
            'reserveB'=>$reserveB,
        ];

        $SJudgeID = $matchDetail -> ScoringJudgeID;
        $TJudgeID = $matchDetail -> TimingJudgeID;

        $ScoringJudgeID = Judge::select('Name')->where('JudgeID', $SJudgeID)->first();
        $TimingJudgeID = Judge::select('Name')->where('JudgeID', $TJudgeID)->first();

        $TourID = $matchDetail -> TournamentID;

        $TournamentName = Tournament::select('Name') -> where('TournamentID', $TourID)->first();

        return view('user.match', [
            'teamAInfo' => $teamAInfo,
            'teamBInfo' => $teamBInfo,
            'matchDetail' => $matchDetail,
            'ScoringJudgeID' => $ScoringJudgeID,
            'TimingJudgeID' => $TimingJudgeID,
            'TournamentName' => $TournamentName,
            'playerCollect' => $playerCollect
        ]);

    }
}
