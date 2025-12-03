<!DOCTYPE html>
<html>
<head>
    <title>Scoreboard</title>
    <!-- Link to external CSS file -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/scoreboard.css') }}">
</head>
<body style="background-color: #f4f7f6;">

    <!-- Navbar -->
    @include('layouts.navbar')

    <!-- Main Content -->
    <div class="container-fluid" style="width: 100%; height: 90%;">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-2" style="background-color: #929292; width: 20%;">
                @include('layouts.sidebar')
            </div>

            <!-- Center Content -->
            <div class="col-8" style="width: 60%;">
                <div class="container-fluid">

    <!-- Matches and Team Scores Section -->
    <section class="score-section">
        <form action="{{ route('scoreboard.filterMatches') }}" method="GET">
            <div class="mb-3">
                <label for="eventSelect" class="form-label">Select Tournament</label>
                <select id="eventSelect" name="TournamentID" class="form-select" onchange="this.form.submit()">
                    <option value="all" {{ request('TournamentID') == 'all' ? 'selected' : '' }}>All Tournaments</option>
                    @foreach($tournaments as $tournament)
                        <option value="{{ $tournament->TournamentID }}" {{ request('TournamentID') == $tournament->TournamentID ? 'selected' : '' }}>
                            {{ $tournament->name }}
                        </option>
                    @endforeach
                </select>
            </div>
         </form>


        <form action="{{ route('scoreboard.updateScores') }}" method="POST">
            @csrf
            <div class="match-container">
                <label for="match-dropdown" class="label">MATCH:</label>
                <select class="match-select" name="match_id" id="match-dropdown">
                    <option value="">Select Match</option>
                    @foreach($matches as $match)
                        <option value="{{ $match->Match_groupID }}">
                            {{ $teams[$match->TeamAID]->name }} vs {{ $teams[$match->TeamBID]->name }}
                        </option>
                    @endforeach
                </select>
    
                <!-- Status Button -->
                <button type="button" class="status-btn">STATUS</button>
    
                <!-- Status Display -->
                <div class="status" id="match-status">
                    Please select a match
                </div>
            </div>
    
            <div class="score-container">
                <div class="score-title">Score</div>
                <div class="team-score-wrapper">
                    <div class="team-score">
                        <div class="team-box" id="team1-box">TEAM A</div> <!-- Placeholder for Team A -->
                        <input type="number" name="team1_score" class="score-input" placeholder="Fill in the score">
                    </div>
                    <div class="team-score">
                        <input type="number" name="team2_score" class="score-input" placeholder="Fill in the score">
                        <div class="team-box" id="team2-box">TEAM B</div> <!-- Placeholder for Team B -->
                    </div>
                </div>    
            </div>
    
            <!-- Include match_id as a hidden field -->
            <input type="hidden" name="match_id" id="match-id">
            
            <button type="submit" class="update-btn">Save Scores</button>
        </form>
    
        <!-- Include jQuery (if not already included) -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
        <script>
            $(document).ready(function() {
                // Listen for changes in the match dropdown
                $('#match-dropdown').on('change', function() {
                    var matchId = $(this).val(); // Get the selected match ID
                    $('#match-id').val(matchId); // Set the hidden match_id input value
    
                    if (matchId) {
                        // Make an AJAX request to fetch the selected match details
                        $.ajax({
                            url: '/get-match-details',  // Define the route to fetch match details
                            type: 'GET',
                            data: { id: matchId },
                            success: function(response) {
                                // Dynamically update the team names based on the response
                                $('#team1-box').text(response.team1_name);
                                $('#team2-box').text(response.team2_name);
                                
                                // Update the match status
                                var today = new Date();  // Get today's date
                                var matchDate = new Date(response.date);  // Convert the response date to JS Date object
                                var startTime = new Date(response.start_time);  // Match start time
                                var endTime = new Date(response.end_time);  // Match end time
                                
                                if (today > endTime) {
                                    $('#match-status').html('<span style="color: green;">Completed</span>');
                                } else if (today >= startTime && today <= endTime) {
                                    $('#match-status').html('<span style="color: orange;">On-going</span>');
                                } else {
                                    $('#match-status').html('<span style="color: blue;">Upcoming</span>');
                                }
                            },
                            error: function() {
                                $('#match-status').text('Error fetching match details');
                            }
                        });
                    } else {
                        // Reset the team names and status if no match is selected
                        $('#team1-box').text('TEAM A');
                        $('#team2-box').text('TEAM B');
                        $('#match-status').text('Please select a match');
                    }
                });
            });
        </script>
    </section>
    

            <div class="player-container">
                <div class="scoring-player">
                    <input type="text" class="player-input" placeholder="Player Name">
                    <button class="add-player-btn">+</button>
                </div>
                <div class="scoring-player">
                    <button class="add-player-btn">+</button>
                    <input type="text" class="player-input" placeholder="Player Name">
                </div>
            </div>

            <!-- Update button aligned to the right -->
            <button type="submit" class="update-btn right-align">UPDATE</button>
        </form>
    </section>

    <!-- Team Ranking Section -->
    <section class="ranking-section">
        <h2>TEAM RANKING:</h2>
        <div class="ranking-container">
            <select class="ranking-group-select">
                <option value="">GROUP A</option>
            </select>
            <button class="vs-btn">V</button>
            <input type="text" class="ranking-team-select" placeholder="TEAM A">
        </div>

        <div class="match-statistics">
            <div class="statistics-label">Fill in Match Statistic</div>
            <table class="stat-table">
                <thead>
                    <tr>
                        <th>PLAY</th>
                        <th>WIN</th>
                        <th>DRAW</th>
                        <th>LOSE</th>
                        <th>RESULT</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" placeholder="Fill Total Match"></td>
                        <td><input type="text" placeholder="Total Win"></td>
                        <td><input type="text" placeholder="Total Draw"></td>
                        <td><input type="text" placeholder="Total Lose"></td>
                        <td>-</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <button class="update-btn">UPDATE</button>
    </section>

    <!-- Update Knockout Board Section -->
    <section class="knockout-section">
        <h2>UPDATE KNOCKOUT BOARD</h2>
        <div class="knockout-board">
            <div class="knockout-match">
                <div class="match-title">Match 1</div>
                <div class="team">WINNER GROUP A</div>
                <div class="team">WINNER GROUP B</div>
            </div>
            <!-- Add other knockout matches -->
        </div>

        <button class="update-btn">UPDATE</button>
    </section>

</body>


</html>
@include('layouts.footer')