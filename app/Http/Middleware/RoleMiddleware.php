<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Please login to access this page.');
        }

        // Check if the user's role is in the provided roles
        if (!in_array(Auth::user()->role, $roles)) {
            return redirect('/')->with('error', 'Unauthorized access.');
        }

        return $next($request);
    }
}
