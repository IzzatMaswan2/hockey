<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MatchGroup;
use App\Models\Team;
use App\Models\Judge;
use App\Models\Tournament;    

class MatchTeamController extends Controller
{
    public function showMatchDetails($matchGroupId)
    {
        $matchDetail =MatchGroup::where('Match_groupID', $matchGroupId)->first();

        $teamAID = $matchDetail->TeamAID;
        $teamBID = $matchDetail->TeamBID;

        $teamAInfo = Team::select('Name', 'logoURL')->where('TeamID', $teamAID)->first();
        $teamBInfo = Team::select('Name', 'logoURL')->where('TeamID', $teamBID)->first();

        $SJudgeID = $matchDetail -> ScoringJudgeID;
        $TJudgeID = $matchDetail -> TimingJudgeID;

        $ScoringJudgeID = Judge::select('Name')->where('JudgeID', $SJudgeID)->first();
        $TimingJudgeID = Judge::select('Name')->where('JudgeID', $TJudgeID)->first();

        $TourID = $matchDetail -> TournamentID;

        $TournamentName = Tournament::select('Name') -> where('TournamentID', $TourID)->first();

        return view('match', [
            'teamAInfo' => $teamAInfo,
            'teamBInfo' => $teamBInfo,
            'matchDetail' => $matchDetail,
            'ScoringJudgeID' => $ScoringJudgeID,
            'TimingJudgeID' => $TimingJudgeID,
            'TournamentName' => $TournamentName
        ]);

    }
}
