<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\Tournament;
use App\Models\TournamentCategory;
use App\Models\GroupCreate;
use App\Models\Team;
use App\Models\Venue;
use App\Models\Matches;
use App\Models\Group;
use App\Models\MatchGroup;

class ManualController extends Controller
{
    public function createManual()
    {

            $matchGroups = MatchGroup::with(['teamA', 'teamB', 'groupcreate', 'category', 'tournament'])
                    ->orderBy('Match_GroupID', 'desc')
                    ->get();
            // dd($matchGroups);

        return view('matches.create-manual', [
            'tournaments' => Tournament::all(),
            'categories'  => TournamentCategory::all(),
            'groups'      => GroupCreate::all(),
            'teams'       => Team::all(),
            'venues'      => Venue::all(),
            'matchGroups' => $matchGroups,
        ]);
    }

    public function storeManual(Request $request)
    {
        // dd($request);
        $request->validate([
            'tournament_id' => 'required',
            'category_id'   => 'required',
            'group_id'      => 'required',
            'team1_id'      => 'required',
            'team2_id'      => 'required|different:team1_id',
            'start_time'    => 'required',
        ]);

        // dd($request);

        $date = '2025-12-06';
        $venue_id = 1;
        $venue = 'Stadium Hoki Tun Razak';

        $startTime = $request->start_time;
        $endTime = date('H:i', strtotime($startTime . ' +11 minutes'));

        $match = Matches::create([
            'tournament_id' => $request->tournament_id,
            'category_id'   => $request->category_id,
            'group_id'      => $request->group_id,
            'team1_id'      => $request->team1_id,
            'team2_id'      => $request->team2_id,
            'date'          => $date,
            'start_time'    => $request->start_time,
            'end_time'      => $endTime,
            'venue_id'      => $venue_id,
        ]);

        $gmatch = MatchGroup::create([
            'TournamentID' => $request->tournament_id,
            'category_id'  => $request->category_id,
            'GroupID'      => $request->group_id,
            'TeamAID'      => $request->team1_id,
            'TeamBID'      => $request->team2_id,
            'Date'         => $date,
            'start_time'   => $request->start_time,
            'end_time'     => $endTime,
            'Venue'        => $venue
        ]);

        // dd($match, $gmatch);

        // Redirect back to the form page with success message
        return back()->with('success', 'Match created manually!');
    }


    public function getCategories($tournament_id)
    {
        return TournamentCategory::where('tournament_id', $tournament_id)->get();
    }

    public function getGroups($category_id)
    {
        return GroupCreate::where('Category_id', $category_id)->get();
    }

    public function getTeams($group_id)
    {
        // Step 1: Get all teamIDs associated with this groupcreateID
        $teamIDs = Group::where('groupcreateID', $group_id)
                        ->pluck('teamID')
                        ->toArray();

        // Step 2: Fetch Team models
        $teams = Team::whereIn('teamID', $teamIDs)->get();

        return response()->json($teams);
    }




}
