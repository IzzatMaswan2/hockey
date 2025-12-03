<?php

// namespace App\Http\Controllers;

// use App\Models\Game;
// use App\Models\MatchGroup;
// use App\Models\Team;
// use App\Models\Tournament;
// use Carbon\Carbon;
// use Illuminate\Http\Request;

// class ScoreboardController extends Controller
// {
//     // Display the scoreboard page
//     public function index()
//     {
//         // Fetch match data from the 'matches' table
//         $matches = MatchGroup::all(); // Fetch from database
//         $tournaments = Tournament::all();

//         foreach ($matches as $match) {
//             $now = Carbon::now();
//             $matchDate = Carbon::parse($match->date);
//             $startTime = Carbon::parse($match->start_time);
//             $endTime = Carbon::parse($match->end_time);

//             // Check if match has ended
//             if ($now->greaterThan($endTime)) {
//                 $match->status = 'Completed';
//             }
//             // Check if the match is currently in progress
//             elseif ($now->between($startTime, $endTime)) {
//                 $match->status = 'On-going';
//             }
//             // Check if the match is scheduled for a future date/time
//             elseif ($now->lessThan($startTime)) {
//                 $match->status = 'Upcoming';
//             }
//         }

//         $teams = Team::all()->keyBy('teamID');
        
//         // You can leave rankings and knockout as empty arrays for now if not needed
//         $rankings = []; // Placeholder, replace with actual data when available
//         $knockout = []; // Placeholder, replace with actual data when available

//         return view('scoreboard.index', compact('matches', 'rankings', 'knockout','teams', 'tournaments'));
//     }


//     public function getMatchDetails(Request $request)
//     {
//         $match = MatchGroup::with(['teamA:teamID,Name,logoURL', 'teamB:teamID,Name,logoURL'])
//             ->find($request->id);

//         // Check if the match was found
//         if (!$match) {
//             return response()->json(['error' => 'Match not found'], 404);
//         }

//         // Prepare the response data
//         $response = [
//             'team1_name' => $match->teamA ? $match->teamA->Name : 'Unknown Team A', 
//             'team2_name' => $match->teamB ? $match->teamB->Name : 'Unknown Team B', 
//             'date' => $match->Date, 
//             'start_time' => $match->start_time,
//             'end_time' => $match->end_time
//         ];

//         // Return the match details as a JSON response
//         return response()->json($response);
//     }

    

//     public function updateMatch(Request $request)
//     {
//         // Validate and update match score data
//         $validated = $request->validate([
//             'match_id' => 'required|exists:matches,id', // Ensure 'matches' table exists
//             'team1_score' => 'required|integer',
//             'team2_score' => 'required|integer',
//             'scoring_player_a' => 'nullable|string',
//             'scoring_player_b' => 'nullable|string',
//         ]);

//         // Find the match by ID and update scores using the Game model
//         $game = Game::findOrFail($request->match_id);
//         $game->update([
//             'team1_score' => $request->team1_score,
//             'team2_score' => $request->team2_score,
//             'scoring_player_a' => $request->scoring_player_a,
//             'scoring_player_b' => $request->scoring_player_b,
//         ]);

//         // Redirect back to the scoreboard page with a success message
//         return redirect()->route('scoreboard.index')->with('success', 'Match updated successfully!');
//     }

//     public function updateScores(Request $request)
//     {
//         // Validate the form inputs
//         $validated = $request->validate([
//             'match_id' => 'required|exists:matches,id', // Ensure match_id exists in the database
//             'team1_score' => 'required|integer', // Score for Team A
//             'team2_score' => 'required|integer', // Score for Team B
//         ]);

//         // Find the match by ID
//         $match = Game::findOrFail($request->match_id);

//         // Format the scoring judge information (you can customize this as needed)
//         $scoringJudge = "Team A: " . $request->team1_score . " - Team B: " . $request->team2_score;

//         // Update the scoring_judge column with the score information
//         $match->scoring_judge = $scoringJudge;
//         $match->save(); // Save the updated match record

//         // Redirect back with a success message
//         return redirect()->route('scoreboard.index')->with('success', 'Scores updated successfully!');
//     }

//     // Update team ranking data (segment 2)
//     public function updateRanking(Request $request)
//     {
//         // Validate and save team ranking data
//         $validated = $request->validate([
//             'total_win' => 'required|integer',
//             'total_draw' => 'required|integer',
//             'total_lose' => 'required|integer',
//         ]);

//         // Logic to save rankings to the database
//         // Example: Ranking::find($request->team_id)->update([...]);

//         return redirect()->route('scoreboard.index')->with('success', 'Ranking updated successfully!');
//     }

//     // Update knockout board (segment 3)
//     public function updateKnockout(Request $request)
//     {
//         // Validate and save knockout data
//         $validated = $request->validate([
//             'match_winner' => 'required|string',
//             'match_score' => 'required|integer',
//         ]);

//         // Logic to update the knockout stage
//         // Example: Knockout::find($request->match_id)->update([...]);

//         return redirect()->route('scoreboard.index')->with('success', 'Knockout board updated successfully!');
//     }

//     public function filterMatches(Request $request)
//     {
//         // Get the selected tournament ID
//         $tournamentId = $request->input('TournamentID');
//         // If 'all' is selected, return all matches; otherwise, filter by the tournament
//         if ($tournamentId == 'all') {
//             $matches = MatchGroup::all();
//         } else {
//             $matches = MatchGroup::where('TournamentID', $tournamentId)->get();
//         }

//         // Get all tournaments for the dropdown
//         $tournaments = Tournament::all();
//         $teams = Team::all()->keyby( 'teamID');

//         // Return the view with the filtered matches and tournaments
//         return view('scoreboard.index', compact('matches', 'tournaments', 'teams'));
//     }
// }
