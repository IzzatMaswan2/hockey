<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TournamentCategory;
use App\Models\Tournament;
use App\Models\Team;

class CategoryController extends Controller
{
    // List all categories (for Blade)
    public function index()
    {
        $categories = TournamentCategory::all();
        return view('managetournament.index', compact('categories'));
    }

    // Get categories for a specific tournament (AJAX)
    public function getTournamentCategories(Tournament $tournament)
    {
        return response()->json($tournament->categories);
    }

    // Store new category for a tournament
    public function storeTournamentCategory(Request $request, Tournament $tournament)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $tournament->categories()->create([
            'name' => $request->name,
        ]);

        return response()->json(['success' => true, 'message' => 'Category added.']);
    }

    // Update a category for a tournament
    public function updateTournamentCategory(Request $request, Tournament $tournament, TournamentCategory $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->update([
            'name' => $request->name,
        ]);

        return response()->json(['success' => true, 'message' => 'Category updated.']);
    }

    // Delete a category
    public function destroy(TournamentCategory $category)
    {
        $category->delete();
        return response()->json(['success' => true, 'message' => 'Category deleted.']);
    }

    public function update(Request $request, $id)
    {
        $category = TournamentCategory::findOrFail($id);

        $category->update([
            'name'          => $request->name,
            'description'   => $request->description,
            'max_teams'     => $request->max_teams,
            'number_group'  => $request->number_group,
        ]);

        return back()->with('success', 'Category updated successfully.');
    }

    public function getCategoryTeams($tournamentId, $categoryId)
    {
        $numTeams = Team::where('tournament_id', $tournamentId)
                        ->where('category_id', $categoryId)
                        ->count();

        return response()->json(['numTeams' => $numTeams]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tournament_id' => 'required|exists:tournaments,id',
            'name'          => 'required|string|max:255',
            'description'   => 'nullable|string',
            'max_teams'     => 'required|integer|min:1',
            'number_group'  => 'required|integer|min:1',
        ]);

        TournamentCategory::create([
            'tournament_id' => $request->tournament_id,
            'name'          => $request->name,
            'description'   => $request->description,
            'max_teams'     => $request->max_teams,
            'number_group'  => $request->number_group,
        ]);

        return back()->with('success', 'Category created successfully.');
    }

}
