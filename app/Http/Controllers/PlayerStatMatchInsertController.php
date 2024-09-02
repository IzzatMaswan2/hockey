<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlayerStatMatchInsertController extends Controller
{
    public function create()
    {
        return view('playerstatmatch');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'PlayerID' => 'required|integer',
            'Match_groupID' => 'required|integer',
            'Time' => 'nullable|date_format:H:i',
            'StatID' => 'required|integer',
            'Reason' => 'nullable|string|max:100',
            'Score' => 'required|integer',
        ]);

        // Insert the data into the database
        DB::table('playerstatmatch')->insert([
            'PlayerID' => $request->PlayerID,
            'Match_groupID' => $request->Match_groupID,
            'Time' => $request->Time,
            'StatID' => $request->StatID,
            'Reason' => $request->Reason,
            'Score' => $request->Score,
        ]);

        return redirect()->route('playerstatmatch.create')->with('success', 'Player stats recorded successfully.');
    }
}
