<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MatchGroup;
use App\Models\Team;

class LiveMatchController extends Controller
{
    public function showLiveMatch()
    {
        // Get live matches where match_status is 1
        $liveMatches = MatchGroup::where('match_status', 1)->get();
        $upcomingMatches = MatchGroup::where('match_status', 0)->get();
        $resultMatches = MatchGroup::where('match_status', 2)->get();

        
        if ($liveMatches->isEmpty()) {
            return view('user.tournament', ['message' => 'No live matches found']);
        }

        $liveMatchDetails = [];
        $upcomingMatchDetail = [];
        $resultMatchDetail = []; 

        foreach ($upcomingMatches as $upmatch) {
            $teamA = $upmatch->TeamAID;
            $teamB = $upmatch->TeamBID;

            $teamAInfo = Team::select('Name', 'logoURL', 'country')->where('TeamID', $teamA)->first();
            $teamBInfo = Team::select('Name', 'logoURL', 'country')->where('TeamID', $teamB)->first();

            $upcomingMatchDetail[] = [
                'teamA' => $teamAInfo,
                'teamB' => $teamBInfo,
                'upmatch' => $upmatch
            ];
        }

        // dd($upcomingMatchDetail);

        foreach ($resultMatches as $resultmatch) {
            $teamA = $resultmatch->TeamAID;
            $teamB = $resultmatch->TeamBID;

            $teamAInfo = Team::select('Name', 'logoURL')->where('TeamID', $teamA)->first();
            $teamBInfo = Team::select('Name', 'logoURL')->where('TeamID', $teamB)->first();

            $resultMatchDetail[] = [
                'teamA' => $teamAInfo,
                'teamB' => $teamBInfo,
                'resultmatch' => $resultmatch
            ];
        }

        foreach ($liveMatches as $match) {
            $teamA = $match->TeamAID;
            $teamB = $match->TeamBID;

            // Fetch team information
            $teamAInfo = Team::select('Name', 'logoURL')->where('TeamID', $teamA)->first();
            $teamBInfo = Team::select('Name', 'logoURL')->where('TeamID', $teamB)->first();

            // Append match details to the array
            $liveMatchDetails[] = [
                'teamA' => $teamAInfo,
                'teamB' => $teamBInfo,
                'match' => $match
            ];

            
        }

        return view('user.tournament', [
            'liveMatchDetails' => $liveMatchDetails, 
            'liveMatches' => $liveMatches, 
            'upcomingMatchDetail' => $upcomingMatchDetail,
            'resultMatchDetail' => $resultMatchDetail
        ]);
    }
}

