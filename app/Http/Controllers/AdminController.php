<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Team;
use App\Models\Tournament;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function create()
    {
        $teams = Team::all();
        $tournaments = Tournament::all();
        $groups= Group::all();
        return view('Admin.admin', compact('teams', 'tournaments'));
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

        return redirect()->route('groups')->with('success', 'Group created successfully.');
    }

    public function index()
    {
        $tournaments = Tournament::all();
        $groups = Group::with(['team', 'tournaments'])->get();
        return view('Admin.admin', compact('groups', 'tournaments'));
    }
}
