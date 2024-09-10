<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formation;
use App\Models\Player;

class FormationController extends Controller
{
    public function create()
    {
        // Fetch all players from the database to populat the dropdown
        $players = Player::all();

        // Return the view with the form and players data
        return view('formation', compact('players'));
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

        // Create a new formation record
        Formation::create([
            'fullName' => $player->fullName,
            'displayName' => $player->displayName,
            'contact' => $player->contact,
            'jerseyNumber' => $player->jerseyNumber,
            'position' => $player->position,
            'formationPosition' => $validatedData['formationPosition'], // Add this line
        ]);

        $players = Player::all();

        return view('formation', compact('players'))->with('success', 'Player updated successfully.');    
    }

    public function view()
    {

        // Fetch all formations from the database
        $formations = Formation::all();

        // Pass the data to the view
        return view('formation', compact('formations'));
    }

    public function showLineUp()
    {
        // Fetch all formations from the database
        $formations = Formation::all();

        // Pass the formations data to the 'line-up' view
        return view('line-up', compact('formations'));
    }
    public function edit($id)
    {
        // Fetch the selected formation record
        $formation = Formation::find($id);
    
        // Check if the formation exists
        if (!$formation) {
            return redirect()->route('formation')->with('error', 'Formation not found.');
        }
    
        // Fetch all players to populate the dropdown
        $players = Player::all();
    
        // Return the view with the formation and players data
        return view('formation', compact('formations', 'players'));
    }
    
    

public function update(Request $request, $id)
{
    // Validate the request data
    $validatedData = $request->validate([
        'player_id' => 'required|exists:players,id',
        'formationPosition' => 'required|string|max:255',
    ]);

    // Find the selected player and formation
    $player = Player::find($validatedData['player_id']);
    $formation = Formation::find($id);

    // Update the formation record with new player data
    $formation->update([
        'fullName' => $player->fullName,
        'displayName' => $player->displayName,
        'contact' => $player->contact,
        'jerseyNumber' => $player->jerseyNumber,
        'position' => $player->position,
        'formationPosition' => $validatedData['formationPosition'],
    ]);

    return redirect()->route('formation.view')->with('success', 'Player updated successfully.');
}


    
}
