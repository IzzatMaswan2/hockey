<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Player;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\Validator;
use League\Csv\Reader;


class PlayerController extends Controller

{


    public function showLineUp()
{
    // Get the logged-in manager
    $manager = Auth::user(); // Assuming the manager is logged in

    // Fetch players that belong to the same team as the manager
    $players = Player::where('teamID', $manager->teamID)->get();

    // Pass the filtered players data to the 'line-up' view
    return view('line-up', compact('players'));
}

public function view()
{
    // Get the logged-in manager
    $manager = Auth::user(); // Assuming the manager is logged in

    // Fetch players that belong to the same team as the manager
    $players = Player::where('teamID', $manager->teamID)->get();

    // Pass the filtered players data to the 'formation' view
    return view('formation', compact('players'));
}
    //Player Store is inside RegisteredUserController :3
  
    //-------------------------------------------------------------------------MANAGER DASHBOAR


    public function dashboard()
    {
        // Get the authenticated manager
        $manager = Auth::user();
    
        // Ensure the user is a manager
        if ($manager->role !== 'Manager') {
            return redirect()->back()->with('error', 'Only managers can access the dashboard.');
        }
    
        // Fetch all players registered by this manager
        $managerPlayers = User::where('role', 'Player')->where('manager_id', $manager->id)->get();
    
        // Fetch all players under the same team ID as the manager
        $teamPlayers = User::where('role', 'Player')->where('teamID', $manager->teamID)->get();
    
        // Get the manager's team and the tournaments the team has joined
        $team = $manager->team; // assuming there's a `team` relationship in User model
        $teamTournaments = $team->tournaments; // assuming the `tournaments` relationship is defined in the Team model
    
        // Return view with all necessary data
        return view('manager-dashboard', [
            'managerPlayers' => $managerPlayers,
            'teamPlayers' => $teamPlayers,
            'teamTournaments' => $teamTournaments,
        ]);
    }
//aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa


public function dashboardPlayer()
{
    // Get the authenticated player
    $user = Auth::user();
    $team = $user->team; // Assuming there's a `team` relationship in User model

    // Check if the team exists
    if ($team) {
        $teamTournaments = $team->tournaments; // Assuming the `tournaments` relationship is defined in the Team model

        // Get the team details
        $teamDetails = [
            'name' => $team->name,
            'logo' => $team->LogoURL ? asset('storage/' . $team->LogoURL) : null, // Generate full logo URL
            'manager_name' => optional($team->manager)->name, // Assuming there's a relationship to get manager's name
        ];
    } else {
        // Handle case when team does not exist
        $teamDetails = [
            'name' => 'N/A',
            'logo' => null,
            'manager_name' => 'N/A',
        ];
        $teamTournaments = collect(); // Empty collection if no team
    }

    // Return view with all necessary data
    return view('player-dashboard', [
        'teamTournaments' => $teamTournaments,
        'teamDetails' => $teamDetails, // Pass team details to the view
    ]);
}

    
    //---------------------------------------------------------------------------------------formation

    /**
     * Store a newly selected player and assign them a formation position.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'player_id' => 'required|exists:players,id',
            'formationPosition' => 'required|string',
        ]);

        // Find the player
        $player = Player::findOrFail($request->input('player_id'));

        // Update the player's formation position
        $player->formationPosition = $request->input('formationPosition');
        $player->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Player added to the formation successfully!');
    }

    /**
     * Change an existing player's formation position.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function change(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'player_id' => 'required|exists:players,id',
            'formationPosition' => 'required|string',
        ]);
    
        // Find the player with the current formation position and set it to null
        $existingPlayer = Player::where('formationPosition', $request->input('formationPosition'))->first();
        if ($existingPlayer) {
            $existingPlayer->formationPosition = null;
            $existingPlayer->save();
        }
    
        // Find the new player and update their formation position
        $player = Player::findOrFail($request->input('player_id'));
        $player->formationPosition = $request->input('formationPosition');
        $player->save();
    
        // Redirect back with success message
        return redirect()->back()->with('success', 'Player position updated successfully!');
    }
    
}

