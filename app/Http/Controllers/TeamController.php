<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Player;

class TeamController extends Controller
{
    public function create()
    {
        $players = Player::all();
        return view('team', compact('players'));
    }
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'player_id' => 'required|exists:players,id',
            'formationPosition' => 'required|string|max:255', // Add this line
        ]);

        // Find the selected player
        $player = Player::find($validatedData['player_id']);

        Team::create([
            'fullName' => $player->fullName,
            'contact' => $player->contact,
            'jerseyNumber' => $player->jerseyNumber,
            'position' => $player->position,
            'formationPosition' => $validatedData['formationPosition'], 
        ]);

        $players = Player::all();

        return view('team', compact('players'))->with('success', 'Player updated successfully.');    
    }

    public function view()
    {

        // Fetch all teams from the database
        $teams = Team::all();

        // Pass the data to the view
        return view('team', compact('teams'));
    }

    public function showLineUp()
    {
        // Fetch all teams from the database
        $teams = Team::all();

        // Pass the teams data to the 'line-up' view
        return view('line-up', compact('teams'));
    }
}
