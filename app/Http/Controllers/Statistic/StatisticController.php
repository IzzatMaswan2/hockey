<?php
namespace App\Http\Controllers\Statistic;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\GroupCreate;
use App\Models\Matches;
use App\Models\MatchGroup;
use App\Models\PlayerStatMatch;
use App\Models\Tournament;
use App\Models\Player; 
use App\Models\Stat;
use App\Models\Team;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function index()
    {
        // Fetch tournaments ordered by created_at and with a count of related knockout matches
        $tournaments = Tournament::orderBy('created_at', 'desc')
            ->get();
        
        $knockout = Matches::where('knockout',true )->get()->keyBy('tournament_id');
        // dd($knockout);
        
        // Return the view with the tournaments
        return view('statistic.index', compact('tournaments', 'knockout'));
    }


    public function showMatches($tournamentId)
    {
        // Fetch matches for the specified tournament
        $matches = MatchGroup::where('TournamentID', $tournamentId)->get();
        $Teams = Team::all()->keyBy('teamID');
        $Groups = GroupCreate::where('TournamentID', $tournamentId)->get()->keyBy('GroupID');

        $tournament = Tournament::where('id', $tournamentId);
        // Prepare to count ended matches and total matches for each group
        $groupCounts = [];

        foreach ($Groups as $group) {
            // Get matches for the current group
            $groupMatches = $matches->where('GroupID', $group->GroupID);
            
            // Count ended matches (status = 2)
            $endedCount = $groupMatches->where('match_status', 2)->count();

            $errorCount = $groupMatches->where('error', 1)->count();
            
            // Total matches for the group
            $totalCount = $groupMatches->count();

            // Store the counts in the array
            $groupCounts[$group->GroupID] = [
                'ended' => $endedCount,
                'total' => $totalCount,
                'error' => $errorCount,
            ];
        }

        $knockout = Matches::where('tournament_id', $tournamentId)->exists();
        // dd($knockout);

        return view('statistic.matches', compact('matches', 'tournamentId', 'Teams', 'Groups', 'groupCounts','knockout'));
    }

    
    public function startMatch($Match_groupID)
    {
        $match = MatchGroup::findOrFail($Match_groupID);
        // dd($match);
        $match->match_status = 1; // Change status to 1
        $match->save();

        return redirect()->back()->with('success', 'Match started successfully.');
    }

    public function showStatistics($matchId)
    {
        $match = MatchGroup::find($matchId);
        // dd($match);
        $statistics = PlayerStatMatch::where('Match_groupID', $matchId)->get();
        $players = Player::all()->keyBy('id'); 
        $stats = Stat::all();
        // dd($statistics[0]->StatID);

        $playersCollection = Player::all();

        $teamAID = $match->TeamAID;
        $teamBID = $match->TeamBID;

        $TeamA = Team::find($teamAID);
        $TeamB = Team::find($teamBID);

        $Teams = Team::all();
        // dd($Teams);

        $teamAPlayers = $playersCollection->filter(fn($player) => $player->teamID == $teamAID);
        $teamBPlayers = $playersCollection->filter(fn($player) => $player->teamID == $teamBID);

        $combinedPlayers = $teamAPlayers->map(fn($player) => [
            'id' => $player->id,
            'name' => $player->displayName . ' (' . $TeamA->name . ')'
        ])->merge(
            $teamBPlayers->map(fn($player) => [
                'id' => $player->id,
                'name' => $player->displayName . ' (' . $TeamB->name . ')'
            ])
        );

    return view('statistic.statistics', compact('match', 'statistics', 'players', 'stats','Teams', 'TeamA', 'TeamB'))->with('combinedPlayers', $combinedPlayers);
    }

    public function storeStatistic(Request $request, $matchId)
    {
        $request->validate([
            'PlayerID' => 'required|integer',
            'StatID' => 'required|integer',
            'Reason' => 'nullable|string|max:100',
        ]);

        // dd($request);
        PlayerStatMatch::create([
            'Match_groupID' => $matchId,
            'PlayerID' => $request->PlayerID, 
            'Time' => $request->Time,
            'StatID' => $request->StatID,
            'Reason' => $request->Reason,
            'Score' => 1, 
        ]);

        $statcheck = Stat::where('StatID', $request->StatID)->pluck('Type')->first();
        if ($statcheck == 'Goal') {
            $match = MatchGroup::find($matchId);
            $player = Player::find($request->PlayerID);
            $TeamID = $player ? $player->teamID : null; 
        
            if ($TeamID === $match->TeamAID) {
                $currentScore = $match->ScoreA;
                $updatedScore = $currentScore + 1;
                // $updatedScore = 0; 
                $match->update(['ScoreA' => $updatedScore]);
                // dd($match->ScoreA);
            } elseif ($TeamID === $match->TeamBID) {
                $currentScore = $match->ScoreB;
                $updatedScore = $currentScore + 1; 
                // $updatedScore = 0;
                $match->update(['ScoreB' => $updatedScore]);
                // dd($match->ScoreB);
            } 
        } else {
        }
        

        return redirect()->route('statistics.index', $matchId)->with('success', 'Match statistic recorded successfully.');
    }

    public function editStatistic($PlayerStatMatchID)
    {
        $statistic = PlayerStatMatch::find($PlayerStatMatchID);
        $matchGroupID = $statistic->Match_groupID;
        $match = MatchGroup::find($matchGroupID);
        $playersCollection = Player::all();
        $stats = Stat::all();
        // dd($stats);

        $teamAID = $match->TeamAID;
        $teamBID = $match->TeamBID;

        $TeamA = Team::find($teamAID);
        $TeamB = Team::find($teamBID);

        $teamAPlayers = $playersCollection->filter(fn($player) => $player->teamID == $teamAID);
        $teamBPlayers = $playersCollection->filter(fn($player) => $player->teamID == $teamBID);

        $combinedPlayers = $teamAPlayers->map(fn($player) => [
            'id' => $player->id,
            'name' => $player->displayName . ' (' . $TeamA->name . ')'
        ])->merge(
            $teamBPlayers->map(fn($player) => [
                'id' => $player->id,
                'name' => $player->displayName . ' (' . $TeamB->name . ')'
            ])
        );
        // dd($teamAPlayers);
        return view('statistic.edit', compact('statistic', 'stats'))->with('combinedPlayers', $combinedPlayers);
    }

    public function updateStatistic(Request $request, $PlayerStatMatchID)
    {

        // $request->validate([
        //     'PlayerID' => 'required|integer',
        //     'Time' => 'nullable|date_format:H:i',
        //     'StatID' => 'required|integer',
        //     'Reason' => 'nullable|string|max:100',
        // ]);

        $statistic = PlayerStatMatch::find($PlayerStatMatchID);
        $statistic->update([
            'PlayerID' => $request->PlayerID, 
            'Time' => $request->Time,
            'StatID' => $request->StatID,
            'Reason' => $request->Reason,
        ]);

        return redirect()->route('statistics.index', $statistic->Match_groupID)->with('success', 'Match statistic updated successfully.');
    }

    public function destroyStatistic($PlayerStatMatchID)
    {
        $statistic = PlayerStatMatch::find($PlayerStatMatchID);
        $PlayerStatMatch = $statistic;
        $statistic->delete();

        $statcheck = Stat::where('StatID', $PlayerStatMatch->StatID)->pluck('Type')->first();
        $matchId = $PlayerStatMatch->Match_groupID; 

        if ($statcheck == 'Goal') {
            $match = MatchGroup::find($matchId);
            $player = Player::find($PlayerStatMatch->PlayerID);
            $TeamID = $player ? $player->teamID : null; 

            if ($TeamID === $match->TeamAID) {
                $currentScore = $match->ScoreA;
                $updatedScore = $currentScore - 1; // Decrement score for Team A
                $match->update(['ScoreA' => $updatedScore]);
                // dd('ScoreA');
                // dd($match->ScoreA);
            } elseif ($TeamID === $match->TeamBID) {
                $currentScore = $match->ScoreB;
                $updatedScore = $currentScore - 1; // Decrement score for Team B
                $match->update(['ScoreB' => $updatedScore]);
                // dd('ScoreB');
                // dd($match->ScoreB);
            } 
        } 
        return redirect()->route('statistics.index', $statistic->Match_groupID)->with('success', 'Match statistic deleted successfully.');
    }

    public function getMatchDetails($id)
    {
        $match = MatchGroup::with(['teamA', 'teamB','tournament'])->findOrFail($id);
        // dd($match);
        return response()->json([
            'TournamentID' => $match->tournament->name,
            'TeamAID' => $match->TeamAID,
            'TeamBID' => $match->TeamBID,
            'match_status' => 'Ended',
            'Date' => $match->Date,
            'start_time' => $match->start_time,
            'end_time' => $match->end_time,
            'Venue' => $match->Venue,
            'ScoreA' => $match->ScoreA,
            'ScoreB' => $match->ScoreB,
            'TeamAName' => $match->teamA->name, 
            'TeamBName' => $match->teamB->name,
        ]);
    }

    public function updateTournamentStats(Request $request)
    {
        $tournamentID = $request->input('tournament_id');
        // Call the actual function to update the stats
        $this->performTournamentStatsUpdate($tournamentID);

        return redirect()->back()->with('success', 'Tournament stats updated successfully.');
    }

    private function performTournamentStatsUpdate($tournamentID): void
    {
        // Step 1: Clear previous data for all teams in the specified tournament
        Group::where('tournament_id', $tournamentID)->update([
            'played' => 0,
            'wins' => 0,
            'draws' => 0,
            'losses' => 0,
            'gf' => 0,  // Goals For
            'ga' => 0,  // Goals Against
            'gd' => 0,  // Goal Difference
            'points' => 0
        ]);

        // Step 2: Fetch all valid matches for the given tournament (match_status = 2, both_approved = 1, error = 0)
        $matches = MatchGroup::where('TournamentID', $tournamentID)
            ->where('match_status', 1)
            // ->where('both_approved', 1)
            // ->where('error', NULL)
            ->get();

            // dd($matches);

        // Step 3: Loop through each match and update the team stats
        foreach ($matches as $match) {
            // Find both teams (Team A and Team B) for this tournament
            $teamA = Group::where('tournament_id', $tournamentID)->where('teamID', $match->TeamAID)->first();
            $teamB = Group::where('tournament_id', $tournamentID)->where('teamID', $match->TeamBID)->first();

            // Increment the 'played' field for both teams
            $teamA->increment('played');
            $teamB->increment('played');

            // Update based on scores
            if ($match->ScoreA > $match->ScoreB) {
                // Team A wins
                $teamA->increment('wins');
                $teamB->increment('losses');
                $teamA->increment('points', 3);
            } elseif ($match->ScoreA < $match->ScoreB) {
                // Team B wins
                $teamB->increment('wins');
                $teamA->increment('losses');
                $teamB->increment('points', 3);
            } else {
                // It's a draw
                $teamA->increment('draws');
                $teamB->increment('draws');
                $teamA->increment('points', 1);
                $teamB->increment('points', 1);
            }

            // Update goals for/against and goal difference
            $teamA->increment('gf', $match->ScoreA);
            $teamA->increment('ga', $match->ScoreB);
            $teamB->increment('gf', $match->ScoreB);
            $teamB->increment('ga', $match->ScoreA);

            // Update goal difference (gd = gf - ga)
            $teamA->update(['gd' => $teamA->gf - $teamA->ga]);
            $teamB->update(['gd' => $teamB->gf - $teamB->ga]);
        }
    }
}
