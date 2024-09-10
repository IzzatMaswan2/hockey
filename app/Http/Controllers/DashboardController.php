<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Goal;
use App\Models\Cards;
use App\Models\Result;
use App\Models\Manager;
use App\Models\Group;

class DashboardController extends Controller
{
    public function index()
    {        
        
        $total_player = Team::sum('total_player');
        
        // Count the number of teams
        $teamsCount = Team::count();

        $managersCount = Manager::count();
        
        // Sum of all goals scored
        $goalsScored = Goal::sum('scored_goals');
        
        // Sum of all penalty corner goals
        $penaltyCorner = Goal::sum('penalty_corner');

        // Calculate total number of each card type
        $totalRedCards = Cards::where('card_type', 'red')->sum('count');
        $totalYellowCards = Cards::where('card_type', 'yellow')->sum('count');
        $totalGreenCards = Cards::where('card_type', 'green')->sum('count');

        $wins = Result::where('result', 'win')->count();
        $losses = Result::where('result', 'loss')->count();
        $draws = Result::where('result', 'draw')->count();

        $group = Group::all();

        return view('/dashboard', compact('total_player', 'teamsCount', 'managersCount', 'goalsScored', 'penaltyCorner','totalRedCards', 'totalYellowCards', 'totalGreenCards', 'wins', 'losses', 'draws','group'));
    }
}
