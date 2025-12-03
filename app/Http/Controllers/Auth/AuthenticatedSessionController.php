<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        // Authenticate the user
        $request->authenticate();

        // Regenerate session to prevent fixation attacks
        $request->session()->regenerate();

        // Get the authenticated user
        $user = Auth::user();

        // Redirect based on user role
        if ($user->role === 'Admin') {
            return redirect()->intended(route('dashboard'));
        } elseif ($user->role === 'Manager') {
            return redirect()->intended(route('manager-dashboard'));
        } elseif ($user->role === 'Player') {
            return redirect()->intended(route('player-dashboard'));
        }
        
        // Default redirection if no role matches
        return redirect()->intended(route('dashboard'));
    }

    public function destroy(Request $request): RedirectResponse
    {
        // Logout the user
        Auth::guard('web')->logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate the CSRF token
        $request->session()->regenerateToken();

        // Redirect to the homepage
        return redirect('/');
    }
}
