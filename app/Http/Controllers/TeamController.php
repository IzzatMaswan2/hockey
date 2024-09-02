<?php


namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use App\Models\Player;

class TeamController extends Controller
{
    public function index()
    {
        // Retrieve all team names
        $teams = Team::all(['Name']); // Fetch only the 'Name' column
        return view('teams.index', compact('teams')); // Pass the teams to a view
    }

    public function show($id)
    {
        // Retrieve a single team by its ID
        $team = Team::find($id);
        return view('teams.show', compact('team')); // Pass the team to a view
    }

    public function create()
    {
        // Fetch all players from the database to populate the dropdown
        $players = Player::all();

        // Return the view with the form and players data
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

        // Create a new Team record
        Team::create([
            'fullName' => $player->fullName,
            'contact' => $player->contact,
            'jerseyNumber' => $player->jerseyNumber,
            'position' => $player->position,
            'formationPosition' => $validatedData['formationPosition'], // Add this line
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
