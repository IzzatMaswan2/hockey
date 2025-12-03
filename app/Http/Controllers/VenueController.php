<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Venue;


class VenueController extends Controller
{
    // Method to display the list of venues
    public function create()
    {
        // Retrieve all venues and venues from the database
        $venues = Venue::all->where(); // Retrieve all venues
      
        // Return the venue list view with the venues and venues data
        return view('managevenue', compact('venues'));
    }

    public function unarchiveVenue($id)
    {
        $venue = Venue::findOrFail($id);
        $venue->archived = 1; // Set to unarchived (active)
        $venue->save();
    
        return redirect()->back()->with('success', 'Manager unarchived successfully.');
    }


    // Method to store a new venue in the database
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'no_court' => 'required|integer']);


        // Create a new venue record in the database
        Venue::create($validatedData);


        // Redirect back to the venue list view with a success message
        return redirect()->route('managevenue')->with('success', 'Venue added successfully');
    }


    // Method to display the details of a specific venue
    public function show($id)
    {
        // Find the venue by ID, or fail if not found
        $venues = Venue::findOrFail($id);


        // Return the venue details view with the specific venue data
        return view('managevenue', compact('venues')); // corrected variable name
    }


    public function update(Request $request, $id)
{
    // Find the venue by ID
    $venue = Venue::findOrFail($id);


    $venue->name = $request->name;
    $venue->location = $request->location;
    $venue->no_court = $request->no_court;
    $venue->save();
    return redirect()->route('managevenue')->with('success', 'Venue updated successfully');
}


public function archiveVenue($id)
{

    $venue = Venue::findOrFail($id);
    $venue->archived = 0; // Set archived to 0
    $venue->save();

    return redirect()->back()->with('success', 'Venue archived successfully.');
}


public function index()
{
    $venues = Venue::all();
    return view('managevenue', compact('venues'));
}


}



