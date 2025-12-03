<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Team;
use App\Models\Tournament;
use App\Models\GroupCreate;
use App\Models\Competition;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class GroupsController extends Controller
{
    public function index()
    {
        $tournaments = Tournament::all();
        $teams = Team::all();
        $groupcreates = GroupCreate::all();
        $competitions = Competition::all();
        $groups = Group::with(['team', 'tournaments', 'groupcreate', 'category'])->get();

        // dd($groups);
        // foreach ($groups as $group) {
        //     // Check if the related team is null
        //     if (is_null($group->team)) {
        //         // Dump and die with the group ID where the team is null
        //         dd('Group ID with null team:', $group->id);
        //     }
        // }

        // dd($groups);

        return view('managegroup', compact('groups', 'tournaments', 'teams', 'groupcreates', 'competitions'));
    }

    public function getTeamsAndGroupsByTournament(Request $request)
    {
        $tournamentId = $request->input('id');
        
        // Fetch teams based on the tournament
        $teams = Competition::where('tournament_id', $tournamentId)
            ->join('teams', 'competitions.team_id', '=', 'teams.teamID')
            ->select('teams.teamID as id', 'teams.name as text')
            ->get();
        
        // Fetch groups based on the tournament
        $groups = GroupCreate::where('TournamentID', $tournamentId)
            ->select('GroupID as id', 'Name as name')
            ->get();

        // dd($groups);
        
        // Return both teams and groups
        return response()->json([
            'teams' => $teams,
            'groups' => $groups,
        ]);
    }

    public function create()
    {
        $teams = Team::all();
        $tournaments = Tournament::all();
        $groupcreates = GroupCreate::all();
        $competitions = Competition::all();
        $groups = Group::with(['team', 'tournaments', 'groupcreate'])->get();

        return view('managegroup', compact('teams', 'tournaments', 'groups', 'groupcreates', 'competitions'));
    }

public function store(Request $request)
{
    $request->validate([
        'tournament' => 'required|exists:tournaments,id',
        'numGroups'  => 'required|integer|min:1',
        'category'   => 'nullable|exists:tournament_category,id',
    ]);

    $tournament_id = $request->tournament;
    $category_id   = $request->category ?? null;
    $numGroups     = (int) $request->numGroups;

    DB::beginTransaction();

    try {
        // 1) Find existing GroupCreate IDs for this tournament (and category if provided)
        $existingGroupCreateIds = GroupCreate::where('TournamentID', $tournament_id)
            ->when($category_id, fn($q) => $q->where('category_id', $category_id))
            ->pluck('GroupID')->toArray(); // array of ints (maybe empty)

        $groupQuery = Group::where('tournament_id', $tournament_id);

        if ($category_id) {
            // delete only this category
            $groupQuery->where('category_id', $category_id);
        }

        if (!empty($existingGroupCreateIds)) {
            $groupQuery->orWhereIn('groupcreateID', $existingGroupCreateIds);
        }

        $groupQuery->delete();


        // 3) Delete the GroupCreate rows themselves
        $groupCreateQuery = GroupCreate::where('TournamentID', $tournament_id);
        if ($category_id) {
            $groupCreateQuery->where('category_id', $category_id);
        }
        $groupCreateQuery->delete();

        // 4) Fetch teams (filter by category if provided)
        if ($category_id) {
            $competitionTeams = Competition::where('tournament_id', $tournament_id)
                ->where('category_id', $category_id)
                ->pluck('team_id');
        } else {
            $competitionTeams = Competition::where('tournament_id', $tournament_id)
                ->pluck('team_id');
        }

        if ($competitionTeams->isEmpty()) {
            DB::rollBack();
            return redirect()->back()->with('error', 'No teams found for this tournament/category.');
        }

        // 5) Shuffle and compute distribution
        $totalTeams = $competitionTeams->count();
        $teamsPerGroup = intdiv($totalTeams, $numGroups);
        $extraTeams = $totalTeams % $numGroups;
        $shuffledTeams = $competitionTeams->shuffle();

        // 6) Create new GroupCreate rows
        $createdGroups = [];
        for ($i = 0; $i < $numGroups; $i++) {
            $groupCreate = GroupCreate::create([
                'TournamentID' => $tournament_id,
                'category_id'  => $category_id,
                'Name'         => 'Group ' . ($i + 1),
                'Description'  => 'Automatically generated group ' . ($i + 1),
            ]);
            $createdGroups[] = $groupCreate;
        }

        // 7) Assign teams to each new GroupCreate
        foreach ($createdGroups as $groupCreate) {
            $currentGroupSize = $teamsPerGroup + ($extraTeams > 0 ? 1 : 0);
            if ($extraTeams > 0) $extraTeams--;

            $groupTeams = $shuffledTeams->splice(0, $currentGroupSize);

            foreach ($groupTeams as $teamId) {
                Group::create([
                    'tournament_id' => $tournament_id,
                    'groupcreateID' => $groupCreate->GroupID,
                    'category_id'   => $category_id,
                    'teamID'        => $teamId,
                ]);
            }
        }

        DB::commit();

        return redirect()->route('managegroup.index')->with('success', 'Groups updated successfully.');
    } catch (\Throwable $e) {
        DB::rollBack();
        // log the error so you can inspect it
        \Log::error('Group create/overwrite failed: '.$e->getMessage(), [
            'tournament_id' => $tournament_id,
            'category_id'   => $category_id,
            'exception'     => $e,
        ]);

        return redirect()->back()->with('error', 'An error occurred while updating groups. Check logs.');
    }
}



    public function getTournamentTeams($id)
    {
        // Count the number of teams registered for this tournament
        $numTeams = Competition::where('tournament_id', $id)
                    ->distinct()
                    ->count('team_id');

        return response()->json(['numTeams' => $numTeams]);
    }


    // public function showStandings($groupId)
    // {
    //     $allGroups = Group::all();
    //     $groups = Group::where('id', $groupId)->get();
    
    //     return view('standings', [
    //         'allGroups' => $allGroups,
    //         'groups' => $groups,
    //         'selectedGroupId' => $groupId
    //     ]);

    //     return view('groups', compact('group'));
    // }
    
}
