<?php

namespace App\Http\Controllers;

use App\Models\PlayerStatMatch;
use App\Models\Player;
use App\Models\MatchGroup;
use App\Models\Stat;
use App\Models\Team;
use App\Models\Judge;
use App\Models\Tournament;
use Illuminate\Http\Request;

class PlayerStatMatchController extends Controller
{
    public function create($matchId)
    {
    $match = MatchGroup::find($matchId);
    
    if (!$match) {
        return redirect()->back()->with('error', 'Match not found.');
    }

    $teamAID = $match->TeamAID;
    $teamBID = $match->TeamBID;

    // Fetch players for both teams
    $teamAPlayers = Player::where('teamID', $teamAID)->get();
    $teamBPlayers = Player::where('teamID', $teamBID)->get();

    return view('playerstat.create', [
        'match' => $match,
        'players' => $teamAPlayers->merge($teamBPlayers), 
        'teamAPlayers' => $teamAPlayers,
        'teamBPlayers' => $teamBPlayers,
    ]);
    }

    public function store(Request $request, MatchGroup $match)
    {
        $request->validate([
            'PlayerID' => 'required|exists:players,PlayerID',
            'Time' => 'required|date_format:H:i',
            'StatID' => 'required|exists:stat,StatID',
            'Reason' => 'nullable|string|max:100',
            'Score' => 'required|integer|min:0',
        ]);

        PlayerStatMatch::create([
            'PlayerID' => $request->PlayerID,
            'Match_groupID' => $match->Match_groupID,
            'Time' => $request->Time,
            'StatID' => $request->StatID,
            'Reason' => $request->Reason,
            'Score' => $request->Score,
        ]);

        return redirect()->route('playerstat.create', $match->Match_groupID)->with('success', 'Player statistics recorded successfully!');
    }

    public function index()
    {
        $matches = MatchGroup::where('match_status', 1)->get(); 

        $liveMatchDetails = [];

        foreach ($matches as $match) {
            $teamAID = $match->TeamAID;
            $teamBID = $match->TeamBID;

            $teamAPlayers = Player::where('teamID', $teamAID)->get();
            $teamBPlayers = Player::where('teamID', $teamBID)->get();

            $teamAInfo = Team::select('Name', 'logoURL')->where('teamID', $teamAID)->first();
            $teamBInfo = Team::select('Name', 'logoURL')->where('teamID', $teamBID)->first();

            $liveMatchDetails[] = [
                'teamA' => $teamAInfo,
                'teamB' => $teamBInfo,
                'match' => $match,
                'teamAPlayers' => $teamAPlayers,
                'teamBPlayers' => $teamBPlayers,
            ];
        }

        return view('playerstat.match', [
            'liveMatchDetails' => $liveMatchDetails,
        ]);
    }

}
