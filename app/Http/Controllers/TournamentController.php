<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venue;
use App\Models\Tournament;
use App\Models\TournamentCategory;


class TournamentController extends Controller
{

    // // Method to display the list of tournaments
    // public function create()
    // {
    //     // Retrieve all tournaments and venues from the database
    //     $tournaments = Tournament::all();
    //     $venues = Venue::all(); // Retrieve all venues
    
    //     // Return the tournament list view with the tournaments and venues data
    //     return view('managetournament', compact('tournaments', 'venues'));
    // }

    // Method to store a new tournament in the database
    public function store(Request $request)
    {
//        dd($request);


        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        Tournament::create([
            'name' => $request->name,
            'no_team' => $request->no_team,
            'no_group' => $request->no_group,
            'description' => $request->description,
            'image' => $imagePath,
            'category' => $request->category,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'venue_id' => $request->venue_id,
            'regclose_date' => $request->regclose_date
        ]);
        
        // Redirect back to the tournament list view with a success message
        return redirect()->route('managetournament')->with('success', 'Tournament added successfully');
    }

    public function unarchiveTournament($id)
    {
        $tournament = Tournament::findOrFail($id);
        $tournament->archived = 1; // Set to unarchived (active)
        $tournament->save();
    
        return redirect()->back()->with('success', 'Manager unarchived successfully.');
    }

    // Method to display the details of a specific tournament
    public function show($id)
    {
        // Find the tournament by ID, or fail if not found
        $tournaments = Tournament::findOrFail($id);

        // Return the tournament details view with the specific tournament data
        return view('managetournament', compact('tournaments')); // corrected variable name
    }

    public function update(Request $request, $id)
    {
        // Find the tournament by ID
        $tournament = Tournament::findOrFail($id);

        
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('images', 'public');
                $tournament->image = $imagePath;
            }

        $tournament->name = $request->name;
        $tournament->no_team = $request->no_team;
        $tournament->no_group = $request->no_group;
        $tournament->category = $request->category;
        $tournament->start_date = $request->start_date;
        $tournament->end_date = $request->end_date;
        $tournament->start_time = $request->start_time;
        $tournament->end_time = $request->end_time;
        $tournament->venue_id = $request->venue_id;
        $tournament->description = $request->description;

        
        $tournament->save();
        
        
        // Redirect back to the tournament list view with a success message
        return redirect()->route('managetournament')->with('success', 'Tournament updated successfully');
    }

    public function archive($id)
    {
        $tournament = Tournament::findOrFail($id);
        $tournament->archived = 0; // Set archived to 0
        $tournament->save();

        return redirect()->back()->with('success', 'Tournament archived successfully.');
    }
    public function index()
    {
        $tournaments = Tournament::with('categories')->get();
        // dd($tournaments);
        $venues = Venue::all(); 
        $categories = TournamentCategory::all(); 

        return view('managetournament', compact('tournaments', 'venues', 'categories'));
    }

    // Get number of teams
    public function getTeams($id) {
        $tournament = Tournament::findOrFail($id);
        return response()->json(['numTeams' => $tournament->no_team ?? 0]);
    }

    // Get tournament categories
    public function getCategories($id) {
        $tournament = Tournament::with('categories')->findOrFail($id);
        return response()->json([
            'categories' => $tournament->categories->map(fn($c) => ['id' => $c->id, 'name' => $c->name])
        ]);
    }

    public function getCategories2($tournamentId)
    {
        // Fetch categories related to the tournament
        $categories = TournamentCategory::where('tournament_id', $tournamentId)->get();

        return response()->json($categories);
    }


}

