<?php

namespace App\Http\Controllers;

use App\Models\MatchGroup;
use App\Models\Tournament;
use App\Models\Team;
use App\Models\PlayerStatMatch;
use App\Models\Stat;
use App\Models\GroupCreate;
use App\Models\Group;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Competition;;
use App\Models\TournamentCategory;

class ScoreboardController extends Controller
{
    // Display the tournament list
    public function tournamentList()
    {
        $tournaments = Tournament::all();
        return view('scoreboard.tournamentlist', compact('tournaments'));
    }

    // Display the scoreboard page for a specific tournament
    public function index(Request $request, $id)
    {   
        $matches = MatchGroup::all();
        // $groupcreates = Group::with(['group'])->get();
        $now = Carbon::now();
        // dd($now);
        $teams = Team::all()->keyBy('teamID');
        
        $tournament = Tournament::findOrFail($id);
       
        return view('scoreboard.index', compact('matches', 'teams', 'tournament'));
    }

    // Filter matches based on the selected tournament
    public function filterMatches(Request $request, $id)
    {
        $matches = MatchGroup::where('TournamentID', $id)
                            // ->where('error', 1) // Filter matches with errors
                            ->get();
        // dd($matches);
        
        // $groups = Group::with(['groupcreate'])->get();
        $teams = Team::all()->keyBy('teamID');
        
        // Fetch the specific tournament details
        $tournament = Tournament::findOrFail($id);

        $allRegistrations = Competition::where('tournament_id', $tournament->id)->get();
        $categories = TournamentCategory::where('tournament_id', $tournament->id)->get();
        // $selectedCategoryId = $request->input('category_id');

        // dd($tournament->id ,$categories, $availableCategories, $allRegistrations);


        return view('scoreboard.index', compact('matches', 'tournament', 'teams', 'categories'));
    }

    public function getMatches(Request $request)
    {
        $matches = MatchGroup::where('TournamentID', $request->tournament_id)
                            ->where('category_id', $request->category_id)
                            ->get();

        $teams = Team::all()->keyBy('teamID');

        $formatted = $matches->map(function ($m) use ($teams) {
            return [
                'Match_groupID' => $m->Match_groupID,
                'teamA_name' => $teams[$m->TeamAID]->name ?? 'Unknown',
                'teamB_name' => $teams[$m->TeamBID]->name ?? 'Unknown',
            ];
        });

        return response()->json($formatted);
    }



    // Get match details for AJAX
    public function getMatchDetails(Request $request)
    {
        
        // $groups = Group::with(['groupcreate'])->get();
        $match = MatchGroup::with(['teamA:teamID,name,logoURL', 'teamB:teamID,name,logoURL'])->find($request->id);
        $teamA_id = $match->TeamAID;
        $teamB_id = $match->TeamBID;

      
        if (!$match) {
            return response()->json(['error' => 'Match not found'], 404);
        }

        $teamA = Team::findOrFail($teamA_id);
        $teamB = Team::findOrFail($teamB_id);

        $players = PlayerStatMatch::where('Match_groupID', $request->id)
            ->join('players', 'playerstatmatch.playerID', '=', 'players.id')
            ->join('teams', 'players.teamID', '=', 'teams.teamID')
            ->select('players.name', 'playerstatmatch.Score', 'teams.name as team_name')
            ->get();

        return response()->json([
            'team1_name' => $teamA->name ?? 'Unknown Team A',
            'team2_name' => $teamB->name ?? 'Unknown Team B',
            'match_id' => $request->id,
            'team1_score' => $match->ScoreA,
            'team2_score' => $match->ScoreB,
            'date' => $match->Date,
            'start_time' => $match->start_time,
            'end_time' => $match->end_time,
            'players' => $players,
            // 'groups' => $groups
        ]);
    }
        // Update match scores
        public function updateMatch(Request $request, $match_group_id)
        {
            // Retrieve the match using the provided ID
            $match = MatchGroup::findOrFail($request->match_ID);

            // Update the scores correctly
            $match->update([
                'ScoreA' => $request->ScoreA,
                'ScoreB' => $request->ScoreB,
                'error' => 0,
                'match_status' => 2 // Set match status to completed
            ]);

            // Return a success message
            return redirect()->back()->with('message', 'No data found in the database.');
        }

        // public function showGroup($groupId)
        // {
        //     // Fetch the group data by group ID
        //     $group = Group::find($groupId);
    
        //     // Fetch all teams associated with this group
        //     $teams = Team::where('group_id', $groupId)->get();
    
        //     // Collect the group and team data in a structured format
        //     $groupData = [
        //         'group' => $group,
        //         'teams' => $teams,
        //     ];
    
        //     // Pass the data to the view
        //     return view('scoreboard.index', compact('groupData'));
        // }


        
        // public function showRounds($id)
        // {
        //     // Fetch teams based on points and goal difference using the Group model
        //     $teamgroup = Group::select('teamID', 'points', 'gd', 'gc.Name as group_name')
        //         ->join('groups_create as gc', 'groupcreateID', '=', 'gc.GroupID')
        //         ->orderBy('points', 'desc')
        //         ->orderBy('gd', 'desc')
        //         ->get()
        //         ->groupBy('group_name');

        //         return $teamgroup;
        // }
        


        

        // public function editMatch($id)
        // {
        //     // Find the match by its ID
        //     $match = MatchGroup::findOrFail($id);
          
        //     // Pass the match data to the view, allowing the current scores to be displayed in the form
        //     return view('scoreboard.index', compact('match'));
        // }
        
}

    
