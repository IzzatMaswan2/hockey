<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; 
use App\Models\Tournament;
use App\Models\Competition;
use App\Models\TournamentCategory;
use App\Models\Team;

class ParticipantController extends Controller
{
    // Show all participants
    public function index(Request $request)
    {
        $tournaments = Tournament::all();
        $categories = TournamentCategory::all();
        $teams = Team::all();

        $query = Competition::with(['tournament', 'team', 'category']);

        if ($request->tournament_id) {
            $query->where('tournament_id', $request->tournament_id);
        }

        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        $participants = $query->get();

        return view('admin.competition.index', compact('participants', 'tournaments', 'categories', 'teams'));
    }

    // Store new participant
    public function store(Request $request)
    {
        $request->validate([
            'fullName' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'tournament_id' => 'required|exists:tournaments,id',
            'team_name' => 'nullable|string|max:255',
        ]);

        User::create([
            'fullName' => $request->fullName,
            'email' => $request->email,
            'role' => 'Participant',
            'tournament_id' => $request->tournament_id,
            'team_name' => $request->team_name,
            'password' => bcrypt('password'), // Default password
        ]);

        return redirect()->back()->with('success', 'Participant added successfully.');
    }

    // Update participant info
    public function update(Request $request, $id)
    {
        $competition = Competition::findOrFail($id);

        $request->validate([
            'team_name'     => 'required|string|max:255',
            'tournament_id' => 'required|exists:tournaments,id',
            'category_id'   => 'required|exists:tournament_category,id',
        ]);

        // Update TEAM name (Team table)
        $team = $competition->team;
        $team->name = $request->team_name;
        $team->save();

        // Update COMPETITION (tournament + category)
        $competition->update([
            'tournament_id' => $request->tournament_id,
            'category_id'   => $request->category_id,
        ]);

        return redirect()->back()->with('success', 'Participant updated successfully.');
    }


    // Archive participant
    public function archive($id)
    {
        $participant = User::findOrFail($id);
        $participant->archived = 1;
        $participant->save();

        return redirect()->back()->with('success', 'Participant archived successfully.');
    }

    // Unarchive participant
    public function unarchive($id)
    {
        $participant = User::findOrFail($id);
        $participant->archived = 0;
        $participant->save();

        return redirect()->back()->with('success', 'Participant unarchived successfully.');
    }

    // Delete participant
    public function destroy($id)
    {
        $competition = Competition::findOrFail($id);
        $competition->delete();

        return redirect()->back()->with('success', 'Participant deleted successfully.');
    }
}
