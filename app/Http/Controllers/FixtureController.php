<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fixture;

class FixtureController extends Controller
{
    public function create()
    {
        // Return the view with the form
        return view('fixture.viewfixture');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'team_id_1' => 'required|integer|exists:team,id', // Make sure team IDs exist in the teams table
            'team_id_2' => 'required|integer|exists:team,id',
            'group_id' => 'required|integer|exists:group,id', // Assuming you have a groups table
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'score' => 'required|string|max:255',
            'agreed' => 'required|in:yes,no',
            'match' => 'required|in:league,friendly,tournament',
        ]);

        // Create a new Fixture record
        Fixture::create($validatedData);

        // Redirect with success message
        return redirect()->route('fixture')->with('success', 'Fixture created successfully!');
    }

    public function index()
    {
        // Fetch all fixtures from the database
        $fixtures = Fixture::all();

        // Load fixtures with related team1, team2, and group
        $fixtures = Fixture::with(['team1', 'team2', 'group'])->get();


        // Pass the data to the view
        return view('fixture.index', compact('fixtures'));
    }
}