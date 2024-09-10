<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Team;
use App\Models\Tournament;
use Illuminate\Http\Request;

class StandingsController extends Controller
{
    public function update(Request $request)
    {
        // Retrieve the form data
        $teamsData = $request->input('teams');

        // Loop through each team's data and update the respective record
        foreach ($teamsData as $groupId => $data) {
            $group = Group::find($groupId);
            if ($group) {
                $group->played = $data['played'];
                $group->wins = $data['wins'];
                $group->draws = $data['draws'];
                $group->losses = $data['losses'];
                $group->gf = $data['gf'];
                $group->ga = $data['ga'];
                $group->gd = $data['gd'];
                $group->points = $data['points'];
                $group->so_bonus = $data['so_bonus'];
                
                // Update the related team name if necessary
                $group->team->team_name = $data['team_name'];
                $group->team->save(); // Save the team details
                
                $group->save(); // Save the group standings
            }
        }

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Standings updated successfully!');
    }

    public function showStandings($id)
    {
        // Fetch the group data based on the provided ID
        $group = Group::find($id);

        // Check if the group exists
        if (!$group) {
            return redirect()->back()->withErrors(['Group not found.']);
        }

        // Pass the group data to the view
        return view('standings.show', compact('group'));
    }
}

