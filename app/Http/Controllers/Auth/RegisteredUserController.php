<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\TeamController; 
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Tournament; 
use App\Models\Competition;
use App\Models\Team; 
use App\Models\Player; 
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Validation\Rule;


class RegisteredUserController extends Controller
{
        /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */


    public function create(): View
    {
        $users = User::all();
        $tournaments = Tournament::all();

        return view('auth.register',compact('tournaments'));
    }

    public function store(Request $request): RedirectResponse
    {
        // Add validation rules
        $rules = [
            'fullName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'occupation' => ['required', 'string', 'max:255'],
            'teamName' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'tournament_id' => ['required', 'exists:tournaments,id'], // Validate tournament_id
        ];
    
        // Validate the request
        $request->validate($rules);
    
        $teamNameUpper = strtoupper($request->teamName);
    
        if ($request->role === 'Manager') {
            // Check if the team exists (with uppercase team name)
            $teamName = Team::where('name', $teamNameUpper)->get()->all();
    
            if (empty($teamName)) {
                // Create a new team with the uppercase team name
                $team = Team::create([
                    'name' => $teamNameUpper,
                    'country' => $request->country,
                    'manager_name' => $request->fullName,
                    'manager_id' => 0,
                ]);
            }
        }
    
        // Retrieve the teamID based on the uppercase team name
        $teamID = Team::where('name', $teamNameUpper)->pluck('teamID')->first();
        // dd($team);
        // Create a new user with the teamID and tournament_id, and assign it to the $user variable
        $user = User::create([
            'fullName' => $request->fullName,
            'email' => $request->email,
            'role' => 'Manager',
            'occupation' => $request->occupation,
            'teamID' => $teamID,
            'address' => $request->address,
            'country' => $request->country,
            'password' => Hash::make($request->password),
            'tournament_id' => $request->tournament_id, // Use tournament_id from request
        ]);

        // dd($user);
        if($team){
            $team->update([
                'manager_id' => $user->id,
            ]);
        }
        
        // Dispatch registered event and log the user in
        event(new Registered($user));
        Auth::login($user);
    
        return redirect()->route('manager-dashboard');
    }

    //------------------------------------------------------------------------------------------ MANAGER
    public function storeManager(Request $request)
    {
        // Validate the request data
        $request->validate([
            'fullName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'occupation' => ['required', 'string', 'max:255'],
            'teamName' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'tournament_id' => ['required', 'exists:tournaments,id'], // Validate tournament_id
        ]);

        // Convert teamName to uppercase
        $teamNameUpper = strtoupper($request->teamName);

        // Create or find the team
        $teamName = Team::where('name', $teamNameUpper)->first();
        if (!$teamName) {
            $teamName = Team::create([
                'name' => $teamNameUpper,
                'country' => $request->country,
                'manager_name' => $request->fullName,
                'manager_id'=> 0,
            ]);
        }

        // Retrieve the teamID
        $teamID = $teamName->teamID;

        // Create the user
        $user = User::create([
            'fullName' => $request->fullName,
            'email' => $request->email,
            'role' => 'Manager',
            'occupation' => $request->occupation,
            'teamID' => $teamID,
            'address' => $request->address,
            'country' => $request->country,
            'password' => Hash::make($request->password),
            'tournament_id' => $request->tournament_id,
        ]);

        // dd($user);

        $teamName->update([
            'manager_id' => $user->id
        ]);

        // Check if the competition already exists
        $competitionExists = Competition::where('team_id', $teamID)
            ->where('tournament_id', $request->tournament_id)
            ->exists();

        if (!$competitionExists) {
            // Insert into competitions if it doesn't exist
            Competition::create([
                'team_id' => $teamID,
                'tournament_id' => $request->tournament_id,
            ]);
        } else {
            // Optionally, you can return a message indicating the team is already registered for this tournament
            return redirect()->back()->with('error', 'This team is already registered for the selected tournament.');
        }

        $users = User::where('role', 'Manager')->get();
        $tournaments = Tournament::all();

        return view('admin.manageuser', compact('users', 'tournaments'))
            ->with('success', 'Manager added successfully.');
    }
    

    public function index()
    {
        $tournaments = Tournament::all(); // Fetch tournaments
        $users = User::where('role', 'Manager')->get();
        
        
        return view('admin.manageuser', compact('users', 'tournaments'));
    }


    public function archive($id)
    {
        $user = User::findOrFail($id);
        $user->archived = 0; // Set to archived
        $user->save();
    
        return redirect()->back()->with('success', 'User archived successfully.');
    }
    
    public function unarchive($id)
    {
        $user = User::findOrFail($id);
        $user->archived = 1; // Set to unarchived (active)
        $user->save();
    
        return redirect()->back()->with('success', 'Manager unarchived successfully.');
    }
    


   public function update(Request $request, $id)
{
    // Validate the request data
    $request->validate([
        'fullName' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id], // Exclude current user's email
        'occupation' => ['required', 'string', 'max:255'],
        'teamName' => ['required', 'string', 'max:255'],
        'address' => ['required', 'string', 'max:255'],
        'country' => ['required','string','max:255'],
    ]);

    // Find the user and update details
    $user = User::findOrFail($id);
    $user->update([
        'fullName' => $request->fullName,
        'email' => $request->email,
        'occupation' => $request->occupation,
        'teamName' => $request->teamName,
        'address' => $request->address,
        'country' => $request->country,  // Update with the merged address
    ]);

    return redirect()->route('admin.manageuser')->with('success', 'Manager details updated successfully.');
}

//-------------------------------------------------------------------------------------------------------REGISTER FROM TOURNAMENT

    public function storeManagerTournament(Request $request)
    {
        
        // If the user is not logged in, handle full registration process (user + team)
        if (!Auth::check()) {
            $request->validate([
                'fullName' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'occupation' => ['required', 'string', 'max:255'],
                'teamName' => ['required', 'string', 'max:255'],
                'address' => ['required', 'string', 'max:255'],
                'country' => ['required', 'string', 'max:255'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'tournament_id' => ['required', 'exists:tournaments,id'],
                'category_id' => ['nullable', 'exists:tournament_category,id'],
            ]);

        // dd($request->all());

            // Convert teamName to uppercase
        $teamNameUpper = strtoupper($request->teamName);

        // Create or find the team
        $teamName = Team::where('name', $teamNameUpper)->first();
        if (!$teamName) {
            $teamName = Team::create([
                'name' => $teamNameUpper,
                'country' => $request->country,
                'manager_name' => $request->fullName,
                'manager_id'=>0,
            ]);
        }

        // Retrieve the teamID
        $teamID = $teamName->teamID;

            // Register user first
            $user = User::create([
                'fullName' => $request->fullName,
                'email' => $request->email,
                'role' => 'Manager',
                'occupation' => $request->occupation,
                'address' => $request->address,
                'country' => $request->country,
                'teamID' => $teamID,
                'password' => Hash::make($request->password),
            ]);

            // dd($user);

            Auth::login($user); // Log the user in after registration

            $userID = $user->id; // Get the user ID of the newly created user
        } else {
            // If user is logged in, just retrieve user ID
            $userID = Auth::user()->id;
        }

        // dd($userID);

        // Now handle team registration
        $teamNameUpper = strtoupper($request->teamName);
        $team = Team::updateOrCreate([
            'name' => $teamNameUpper
        ], [
            'manager_name' => Auth::user()->fullName,
            'country' => Auth::user()->country,
            'manager_id' => $userID,
        ]);

        // dd($team);

        // Check if the team is already registered for the tournament
        $competitionExists = Competition::where('team_id', $team->teamID)
            ->where('tournament_id', $request->tournament_id)
            ->exists();

        if (!$competitionExists) {
            // Register the team for the tournament
            Competition::create([
                'team_id' => $team->teamID,
                'tournament_id' => $request->tournament_id,
                'category_id' => $request->category_id ?? null,
            ]);

            return redirect()->back()->with('success', 'Team registered successfully.');
        } else {
            return redirect()->back()->with('error', 'This team is already registered for this tournament.');
        }
    }
    //--------------------------------------------------------------------------------------------------- -----------------ADMIN
    public function storeAdmin(Request $request)
    {
        // Validate the request data
        $request->validate([
            'fullName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
           'fullName' => $request->fullName,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'Admin',
        ]);

        return redirect()->route('admin.manageadmin');
    }

    public function listAdmin(): View
    {
        $users = User::where('role', 'Admin')->get();
        return view('admin.manageadmin', ['users' => $users]);
    }

    
    public function archiveadmin($id)
    {
        $user = User::findOrFail($id);
        $user->archived = 0; // Set to archived
        $user->save();
    
        return redirect()->back()->with('success', 'User archived successfully.');
    }

    public function unarchiveAdmin($id)
    {
        $user = User::findOrFail($id);
        $user->archived = 1; // Set to unarchived (active)
        $user->save();
    
        return redirect()->back()->with('success', 'Manager unarchived successfully.');
    }
    
    
    public function indexadmin()
    {
        $users = User::where('role','Admin')->get();
        return view('admin.manageadmin', compact('users'));
    }

    //--------------------------------------------------------------------------------------------------- ----------------PLAYER
    public function storePlayer(Request $request)
    {
        // Validate the request data
        $request->validate([
            'fullName' => ['required', 'string', 'max:255'],
            'displayName' => ['required', 'string', 'max:255'],
            'contact' => ['required', 'string', 'max:255'],
            'jerseyNumber' => ['required', 'integer'],
            'position' => ['required', 'string', 'max:255'],
            'dob' => ['required', 'date'],
            'field_status' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    
        // Get the logged-in manager (the one registering the player)
        $manager = Auth::user();
    
        if ($manager->role !== 'Manager') {
            return redirect()->back()->with('error', 'Only managers can register players.');
        }
    
        // Use the manager's teamID and manager_id to associate the player with the correct team
        $teamID = $manager->teamID;
        $managerID = $manager->id;
    
        try {
            // Create a new user (player)
            $user = User::create([
                'fullName' => $request->fullName,
                'displayName' => $request->displayName,
                'contact' => $request->contact,
                'jerseyNumber' => $request->jerseyNumber,
                'position' => $request->position,
                'dob' => $request->dob,
                'field_status' => $request->field_status,
                'email' => $request->email,
                'role' => 'Player',
                'teamID' => $teamID, // Associate the player's teamID with the manager's teamID
                'manager_id' => $managerID, // Associate the player's manager_id with the manager's id
                'password' => Hash::make($request->password),
            ]);
    
            // Ensure $user is not null
            if (!$user) {
                return redirect()->back()->with('error', 'Failed to create user.');
            }
    
            // Log or debug the user creation
            // Uncomment for debugging:
            // dd($user);
    
            // Now, create the player record using the newly created user
            Player::create([
                'user_id' => $user->id, // Use the ID of the newly created user
                'name' => $request->fullName,
                'displayName' => $request->displayName,
                'contact' => $request->contact,
                'jerseyNumber' => $request->jerseyNumber,
                'position' => $request->position,
                'formationPosition' => $request->formationPosition,
                'dob' => $request->dob,
                'field_status' => $request->field_status,
                'email' => $request->email,
                'teamID' => $teamID,
                'manager_id' => $managerID,
            ]);
    
            return redirect()->route('manageplayer')->with('success', 'Player registered successfully.');
    
        } catch (\Exception $e) {
            // Log the error message for debugging
            \Log::error($e->getMessage());
    
            return redirect()->back()->with('error', 'Failed to register player.');
        }
    }
    

    public function listPlayer(): View
    {
        $users = User::where('role', 'Player')->get();
        return view('manageplayer', ['users' => $users]);
    }

    public function archivePlayer($id)
    {
        $user = User::findOrFail($id);
        $user->archived = 0; // Set to archived
        $user->save();
    
        return redirect()->back()->with('success', 'User archived successfully.');
    }
    
    public function indexPlayer()
    {
        // $managers = User::where('role', 'Manager')->get();

        // foreach ($managers as $manager) {
        //     if ($manager->teamID) {
        //         // Update the corresponding team
        //         Team::where('teamID', $manager->teamID)
        //             ->update(['manager_id' => $manager->id]);
        //     }
        // }

        // dd(Auth::user()->id);

        $teamid = Team::where('manager_id',Auth::user()->id)->value('teamID');
        // dd($teamid, Auth::user()->fullName);
        $users = User::where('archived', 1)->where('teamid',$teamid)->get();
        // dd( $users);
        $player = Player::where('teamID',$teamid)->get();
        return view('manageplayer', compact('users', 'player'));
    }


    public function updatePlayer(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'fullName' => ['required', 'string', 'max:255'],
            'displayName' => ['required', 'string', 'max:255'],
            'contact' => ['required', 'string', 'max:255'],
            'jerseyNumber' => ['required', 'integer'],
            'position' => ['required', 'string', 'max:255'],
            'dob' => ['required', 'date'],
            'field_status' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
        ]);
    
        // Find the user and update details
        $user = User::findOrFail($id);
        $user->update([
            'fullName' => $request->fullName,
            'email' => $request->email,
            'displayName' => $request->displayName,
            'contact' => $request->contact,
            'jerseyNumber' => $request->jerseyNumber,
            'position' => $request->position,
            'dob' => $request->dob,
            'field_status' => $request->field_status, 
       
        ]);

        $player = Player::where('user_id', $id)->firstOrFail();
        $player->update([
            'name' => $request->fullName,
            'displayName' => $request->displayName,
            'contact' => $request->contact,
            'jerseyNumber' => $request->jerseyNumber,
            'position' => $request->position,
            'formationPosition' => $request->formationPosition,
            'dob' => $request->dob,
            'field_status' => $request->field_status,
            'email' => $request->email,
        ]);
    
        return redirect()->route('manageplayer')->with('success', 'Player details updated successfully.');
    }

    //--------------------------------------------------------------------------------------------------------------------------------
    public function dashboard()
{
    // Get the authenticated manager
    $manager = Auth::user();

    if ($manager->role !== 'Manager') {
        return redirect()->back()->with('error', 'Only managers can access the dashboard.');
    }

    // Fetch all players registered by this manager
    $managerPlayers = User::where('role', 'Player')->where('manager_id', $manager->id)->get();

    // Fetch all players under the same team ID as the manager
    $teamPlayers = User::where('role', 'Player')->where('teamID', $manager->teamID)->get();

    // Pass data to the view
    return view('manager-dashboard', [
        'managerPlayers' => $managerPlayers,
        'teamPlayers' => $teamPlayers
    ]);
}

    

}
