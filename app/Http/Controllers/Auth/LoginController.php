<?php

// namespace App\Http\Controllers\Auth;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

// class LoginController extends Controller
// {
//     const ROLE_ADMIN = 1;
//     const ROLE_MANAGER = 2;

//     protected function authenticated(Request $request, $user)
//     {
//         switch ($user->user_roleID) {
//             case self::ROLE_ADMIN:
//                 return redirect()->route('dashboard');
//             case self::ROLE_MANAGER:
//                 return redirect('/manager-dashboard');
//             default:
//                 return redirect('/')->with('error', 'Unknown role');
//         }
//     }
// }


