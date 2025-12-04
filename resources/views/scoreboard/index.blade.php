<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/scoreboard.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/771de58f02.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.2.2/dist/echarts.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Scoreboard - {{ $tournament->name }}</title>
    <style>
        body {
            background-color: #f5f5f5;
        }
        .status {
            font-weight: bold;
        }
    </style>
</head>
<body>
    @include('layouts.navbar')

    <div class="container-fluid" style="height: 90%;">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-3" style="background-color: #929292; ">
                @include('layouts.sidebar')
            </div>

            <!-- Main Content -->
            <div class="col-8">
                <h3 class="mt-4 mb-3" style="color: #5D3CB8;">
                    <strong>SCOREBOARD - {{ $tournament->name }}</strong>
                </h3>

                <!-- Match Selection Form -->
                <section class="score-section">
                    <form action="{{ route('scoreboard.updateMatch') }}" method="POST">
                        @csrf
                        <div class="row mb-3 align-items-center">
                            <div class="col-md-4">
                                @if($categories->isNotEmpty())
                                <label for="category-dropdown" class="form-label">CATEGORY:</label>
                                <select class="form-select" name="category_id" id="category-dropdown">
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <label for="match-dropdown" class="form-label">MATCH:</label>
                                <select class="form-select" name="match_id" id="match-dropdown">
                                    <option value="">Select Match</option>
                                    @foreach($matches as $match)
                                        <option value="{{ $match->Match_groupID }}">
                                            {{ $teams[$match->TeamAID]->name }} vs {{ $teams[$match->TeamBID]->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 mt-4">
                                <button type="button" class="btn btn-primary w-100" id="status-button">STATUS</button>
                            </div>
                            <div class="col-md-1 mt-4">
                                <div class="status" id="match-status">Status</div>
                            </div>
                        </div>

                    </form>

                    <!-- Score Update Form -->
                    {{-- @if(count($matches) > 0) --}}
                        {{-- @foreach($matches as $match) --}}
                            <form action="{{ route('update.match', $match->Match_groupID) }}" method="POST">
                                @csrf
                                <div class="score-container">
                                    <div class="score-title">SCORE</div>
                                    <div class="team-score-wrapper">
                                        <div class="team-score">
                                            <div class="team-box" id="team1-box">TEAM A</div>
                                            <input type="number" name="match_ID" id="match-id" class="score-box" value="{{ old('matchID', $match->Match_groupID) }}" hidden>
                                            <input type="number" name="ScoreA" id="team1-score" class="score-box" value="{{ old('ScoreA', $match->team1_score) }}">
                                        </div>
                                        <div class="team-score">
                                            <input type="number" name="ScoreB" id="team2-score" class="score-box" value="{{ old('ScoreB', $match->team2_score) }}">
                                            <div class="team-box" id="team2-box">TEAM B</div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="update-btn">Save Scores</button>
                            </form>
                        {{-- @endforeach
                    @endif --}}x    

                    <!-- Player Score Section -->
                    <div class="player-title">PLAYER SCORE</div>
                    <div class="team-player-wrapper">
                        <div class="team-player">
                            <div class="player-box" id="team1-player-box">Player-Score</div>
                        </div>
                        <div class="team-player">
                            <div class="player-box" id="team2-player-box">Player-Score</div>
                        </div>
                    </div>
                </section>

                <!-- Update Knockout Board Section -->
                <!-- <div class="container mt-5">
                    <h3 class="text-center" style="color: #5D3CB8;">
                        <strong>UPDATE KNOCKOUT BOARD - {{ $tournament->name }}</strong>
                    </h3>
                    <div class="tournament-container">
                        <div class="tournament-groups">
                            
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        
        <script>
            $(document).ready(function() {
                $('#match-dropdown').on('change', function() {
                    var matchId = $(this).val();
                    $('#match-id').val(matchId);

                    if (matchId) {
                        $.ajax({
                            url: '/get-match-details',
                            type: 'GET',
                            data: { id: matchId },
                            success: function(response) {
                                // Update team names and scores
                                $('#team1-box').text(response.team1_name);
                                $('#team2-box').text(response.team2_name);
                                $('#team1-score').val(response.team1_score);
                                $('#team2-score').val(response.team2_score);
                                $('#match-id').val(response.match_id);

                                // Determine match status
                                var today = new Date();
                                var matchDate = new Date(response.date);
                                var todayDateOnly = new Date(today.getFullYear(), today.getMonth(), today.getDate());
                                var matchDateOnly = new Date(matchDate.getFullYear(), matchDate.getMonth(), matchDate.getDate());

                                if (todayDateOnly > matchDateOnly) {
                                    $('#match-status').html('<td style="color: green;">Completed</td>');
                                } else if (todayDateOnly < matchDateOnly) {
                                    $('#match-status').html('<td style="color: blue;">Upcoming</td>');
                                } else {
                                    $('#match-status').html('<td style="color: orange;">On-going</td>');
                                }

                                // Update player scores
                                var team1Players = '';
                                var team2Players = '';

                                $.each(response.players, function(index, player) {
                                    if (player.team_name === response.team1_name) {
                                        team1Players += '<div>' + player.name + ' - ' + player.Score + '</div>';
                                    } else {
                                        team2Players += '<div>' + player.name + ' - ' + player.Score + '</div>';
                                    }
                                });

                                $('#team1-player-box').html(team1Players);
                                $('#team2-player-box').html(team2Players);
                            },
                            error: function() {
                                $('#match-status').text('Error fetching match details');
                            }
                        });
                    } else {
                        // Reset fields if no match is selected
                        $('#team1-box').text('TEAM A');
                        $('#team2-box').text('TEAM B');
                        $('#team1-score').val(0);
                        $('#team2-score').val(0);
                        $('#match-status').text('Please select a match');
                    }
                });
            });
        </script>

    @include('layouts.footer')
</body>
</html>
