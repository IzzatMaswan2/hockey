<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Goal;

class GoalController extends Controller
{
    public function index()
    {
        $goalsScored = Goal::all();
        $penaltyCorner = Goal::sum('penalty_corner');
        return view('dashboard', compact('goalsScored','penaltyCorner'));
    }
}
