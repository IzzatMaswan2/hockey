<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{

    public function listUsers(): View
    {
        
         // Fetch users with the role of 'Manager'
        $users = User::where('role', 'Manager')->get();
    
         // Return the view and pass the users data
        return view('admin.manageuser', ['users' => $users]);
    }
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
{
    // Add validation rules
    $rules = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        'role' => ['required', 'string', 'max:255'],
        'teamName' => ['nullable', 'string', 'max:255'], // Team Name should be nullable
        'country' => ['nullable', 'string', 'max:255'],  // Country should be nullable
    ];

    // Validate the request
    $request->validate($rules);

    // Create a new user
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'teamName' => $request->role !== 'Admin' ? $request->teamName : null,
        'country' => $request->role !== 'Admin' ? $request->country : null,
        'role' => $request->role,
        'password' => Hash::make($request->password),
    ]);

    // Fire the Registered event
    event(new Registered($user));

    // Log the user in
    Auth::login($user);

    // Redirect to home
    return redirect(RouteServiceProvider::HOME);
}


}
