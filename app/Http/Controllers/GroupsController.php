<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Team;
use App\Models\Tournament;
use Illuminate\Http\Request;

class GroupsController extends Controller
{
    public function index()
    {
        $tournaments = Tournament::all();
        $groups = Group::with(['team', 'tournaments'])->get();
        return view('group.index', compact('groups', 'tournaments'));
    }

    public function create()
    {
        $teams = Team::all();
        $tournaments = Tournament::all();
        return view('group.groupcr', compact('teams', 'tournaments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tournament_id' => 'required',
            'group_id'=> 'required|',
            'team_id' => 'required',
            'played' => 'required',
            'wins' => 'required|',
            'draws' => 'required|',
            'losses' => 'required|',
            'gf' => 'required|',
            'ga' => 'required|',
            'gd' => 'required|',
            'so_bonus' => 'required|',
        ]);

        Group::create($request->all());

        return redirect()->route('group')->with('success', 'Group created successfully.');
    }

    public function showStandings($groupId)
    {
        $allGroups = Group::all();
        $groups = Group::where('id', $groupId)->get();
    
        return view('standings', [
            'allGroups' => $allGroups,
            'groups' => $groups,
            'selectedGroupId' => $groupId
        ]);

        return view('groups', compact('group'));
    }
    
}
