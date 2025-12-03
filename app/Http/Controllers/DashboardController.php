<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Goal;
use App\Models\Cards;
use App\Models\Result;
use App\Models\Manager;
use App\Models\Group;
use App\Models\Article;
use App\Models\Player;
use App\Models\Matches;
use App\Models\MatchGroup;
use App\Models\PlayerStatMatch;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {        
        // Count total players
        $total_player = User::where('role', 'Player')->count();
        
        // Count the number of teams
        $teamsCount = Team::count();

        // Count the number of managers
        $managersCount = User::where('role', 'Manager')->count();
        
        // Sum of all goals scored
        $goalsScored = PlayerStatMatch::where('StatID', 1)->sum('Score');
        
        // Sum of all penalty corner goals
        $penaltyCorner = PlayerStatMatch::where('StatID', 2)->sum('Score');

        // Calculate total number of each card type from the playerstatmatch table
        $totalGreenCards = PlayerStatMatch::where('StatID', 4)->count();
        $totalYellowCards = PlayerStatMatch::where('StatID', 5)->count();
        $totalRedCards = PlayerStatMatch::where('StatID', 6)->count();


        // Sum of wins, losses, and draws from the Group model
        $wins = Group::sum('wins');
        $losses = Group::sum('losses');
        $draws = Group::sum('draws');

        // Fetch groups and get their team IDs
        $groups = Group::all();
        $groupTeamIDs = $groups->pluck('teamID');
        
        // Fetch teams in the group
        $teams = Team::whereIn('teamID', $groupTeamIDs)->get();

        // Initialize group data, sorted by points and goal difference (GD), then limited to top 10
        $groupData['team'] = $groups->sortByDesc(function ($group) {
            return [$group->points, $group->gd, $group->gf]; // Sort by points, then goal difference
        })->take(10)->values(); // Reindex to get correct ranking order

        // Fetch the 3 most recent articles
        $recentArticles = Article::latest()->take(3)->get();

        // Fetch an upcoming match that is scheduled after today
        $upcomingMatch = Matches::where('date', '>', now())
                        ->inRandomOrder()
                        ->with(['team1', 'team2', 'venue'])
                        ->first();
        // Check if $upcomingMatch is null and handle the case
        if ($upcomingMatch) {
            $team1 = $upcomingMatch->team1;
            $team2 = $upcomingMatch->team2;
            $venue = $upcomingMatch->venue;
        } else {
            // If no upcoming match is found, set these to null or provide default values
            $team1 = null;
            $team2 = null;
            $venue = null;
        }
       

        // Fetch a random past match that occurred before today
        $match = MatchGroup::where('Date', '<', now())
                        ->inRandomOrder()
                        ->with(['teamA', 'teamB'])
                        ->first();

        // Pass data to the view
        return view('/dashboard', compact(
            'total_player', 
            'teamsCount', 
            'managersCount', 
            'goalsScored', 
            'penaltyCorner',
            'totalRedCards', 
            'totalYellowCards', 
            'totalGreenCards', 
            'wins', 
            'losses', 
            'draws',
            'recentArticles',
            'upcomingMatch',
            'groupData',
            'match'
        ));
    }
}
