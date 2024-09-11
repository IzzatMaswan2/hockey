<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tournament;

class TournamentController extends Controller
{
    // Method to display the list of tournaments
    public function create()
    {
        // Retrieve all tournaments from the database
        $tournaments = Tournament::all();
        
        // Return the tournament list view with the tournaments data
        return view('managetournament', compact('tournaments'));
    }

    // Method to store a new tournament in the database
    public function store(Request $request)
    {
    
        
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'no_team' => 'required|integer',
            'no_group' => 'required|integer',
            'category' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'venue_id' => 'required|integer',
        ]);

        // Create a new tournament record in the database
        Tournament::create($validatedData);

        // Redirect back to the tournament list view with a success message
        return redirect()->route('managetournament')->with('success', 'Tournament added successfully');
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

   $tournament->name = $request->name;
   $tournament->no_team = $request->no_team;
   $tournament->no_group = $request->no_group;
   $tournament->category = $request->category;
   $tournament->start_date = $request->start_date;
   $tournament->end_date = $request->end_date;
   $tournament->start_time = $request->start_time;
   $tournament->end_time = $request->end_time;
   $tournament->venue_id = $request->venue_id;


   $tournament->save();
    

    // Redirect back to the tournament list view with a success message
    return redirect()->route('managetournament')->with('success', 'Tournament updated successfully');
}


    // Method to delete a tournament
    public function destroy($id)
    {
        // Find the tournament by ID and delete it
        $tournament = Tournament::findOrFail($id);
        $tournament->delete();

        // Redirect back to the tournament list view with a success message
        return redirect()->route('managetournament')->with('success', 'Tournament deleted successfully');
    }
}
