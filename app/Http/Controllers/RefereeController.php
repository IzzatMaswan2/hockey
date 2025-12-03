<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Referee;

class RefereeController extends Controller
{
    public function index()
    {
        // Fetch all  from the database
        $referee = Referee::all(); // Using $referee for consistency
        return view('referee', compact('referee'));  // Passing 'referee' to the view
        
    }
    

    public function store(Request $request)
    {
    

        // Create a new Referee record in the database
        Referee::create([
            'Name' => $request->Name,
            'Role' => $request->Role,
        ]);

        // Redirect back or to a different page with a success message
        return redirect()->route('referee.index')->with('success', 'Referee created successfully!');
        
    }

    public function edit($id)
        {
            $referee = Referee::findOrFail($id); // Retrieve the referee by its ID
            

            return view('referee.edit', compact('referee'));
        }


        public function update(Request $request, $id)
        {
            // Find the referee by ID
            $referee = Referee::findOrFail($id);
        
        
            $referee->name = $request->name;
            $referee->role = $request->role;
            
        
            $referee->save();
        
            // Redirect back to the venue list view with a success message
            return redirect()->route('referee.index')->with('success', 'Referee updated successfully');
        }

    public function destroy($id)
    {
        $referee = Referee::findOrFail($id);
        $referee->delete();

        return redirect()->route('referee.index')->with('success', 'Referee deleted successfully');
    }

}
