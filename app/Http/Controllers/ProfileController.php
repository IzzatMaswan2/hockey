<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{

    public function rules()
{
    return [
        'occupation' => 'required|string|max:255',
        'teamName' => 'nullable|string|max:255',
        'address' => 'required|string|max:255',
        'country' => 'required|string|max:255',
        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Logo validation
    ];
}
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
    
        // Fill the user details from the validated request data
        $user->fill($request->validated());
    
        // Check if the email is being updated to reset verification
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
    
        // Handle team logo upload if a file is provided
        if ($request->hasFile('logo')) {
            // Validate the logo file (this can be adjusted based on your needs)
            $request->validate([
                'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Set max size to 2MB
            ]);
    
            // Store the new logo and update the team logo
            $logoPath = $request->file('logo')->store('team_logos', 'public'); // Adjust the storage path as needed
            $user->team->LogoURL = $logoPath; // Assuming the team is related to the user
        }
    
        // Save the user
        $user->save();
        // Save the team if the logo was updated
        if ($request->hasFile('logo')) {
            $user->team->save();
        }
    
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
