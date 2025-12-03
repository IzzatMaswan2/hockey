<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/771de58f02.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <title>Match Selection</title>
    <style>
        body {
            background-color: #f5f5f5; 
        }
        .mb-4 {
            border-radius: 20px;
            background-color: white;
            padding: 20px 20px 0 20px;
            margin: 0;
        }
        .card {
            border-radius: 20px;
            padding: 10px;
        }
        .sidebar {
            background-color: #929292;
            padding: 20px;
        }

        .styled-button {
        display: inline-block;
        padding: 10px 15px;
        background-color: #007bff; /* Bootstrap primary color */
        color: white;
        text-decoration: none;
        border: none;
        border-radius: 5px;
        font-size: 14px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .input-styled-button  {
        display: inline-block;
        padding: 10px 15px;
        background-color: #15d02e; /* Bootstrap primary color */
        color: white;
        text-decoration: none;
        border: none;
        border-radius: 5px;
        font-size: 14px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .error-styled-button  {
        display: inline-block;
        padding: 10px 15px;
        background-color: #ff0000; /* Bootstrap primary color */
        color: white;
        text-decoration: none;
        border: none;
        border-radius: 5px;
        font-size: 14px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .styled-button:hover {
        background-color: #0056b3; /* Darker shade on hover */
    }

    /* Optional: Make the button look more like a link */
    .styled-button:focus {
        outline: none;
    }
    </style>
</head>
@include('layouts.navbar')
<body style="background-color: #f4f7f6;">

    
    <div class="container-fluid" style="width: 100%; height: 90%; min-height:100vh;">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-3" style="background-color: #929292; min-height:100vh; width:20%;">
                @include('layouts.sidebar')
            </div>
    
            <div class="col-9" style="padding: 10px; margin:10px;">
                <div class="container-fluid">
                    <div class="row" style="margin-top:0;">
                        <!-- Header -->
                        <div class="mb-4" style="margin-top:0;">
                            <h4>Select a Matches</h4>
                            <p class="text-muted">Choose a matches and manage statistic</p>
                        </div>
    
                        <!-- Tournament List -->
                        <div class="card" >
                            <div class="row" style="margin-bottom: 50px;">
                                @foreach($Groups as $group)
                                    <div class="col-3 mb-3 border p-3 rounded">
                                        <h5>{{ $group->Name }}</h5> 
                                        <p>Ended Matches: 
                                            {{ $groupCounts[$group->GroupID]['ended'] ?? 0 }}/{{ $groupCounts[$group->GroupID]['total'] ?? 0 }}
                                        </p>
                                        <p>Number of Error: {{ $groupCounts[$group->GroupID]['error'] ?? 0 }} </p>
                                    </div>
                                @endforeach
                                {{-- <span>{{$tournamentId}}</span> --}}
                                <div class="row" style="display: flex">
                                    <form action="{{ route('tournament.updateStats') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="tournament_id" value="{{ $tournamentId }}">
                                        <button type="submit" class="btn btn-primary">Update Tournament Stats</button>
                                    </form>
                                    @php
                                        $allMatchesEnded = collect($groupCounts)->every(fn($counts) => $counts['ended'] === $counts['total']);
                                        $noErrors = collect($groupCounts)->every(fn($counts) => $counts['error'] === 0);
                                    @endphp
    
                                    @if($allMatchesEnded && $noErrors)
                                        @if(!$knockout)
                                        <a href="{{ route('knockout.advance', ['id' => $tournamentId]) }}" class="btn btn-success mt-3 ml-2" style="width: 20%;">
                                            Advance to Knockout Stage
                                        </a>
                                        @endif
                                    @endif
                                </div>

                                @if(session('success'))
                                    <div class="alert alert-success mt-3">
                                        {{ session('success') }}
                                    </div>
                                @endif
                            </div>

                            <div class="card-header d-flex align-items-center justify-content-between" style="background-color:transparent; padding-top:20px;">
                                <h4 class="mt-4">Matches</h4>
                                <i class="bi bi-caret-down-fill" type="button" onclick="toggleMatchList()" style="cursor: pointer;"></i>
                            </div>
                            <div class="form-group mt-3">
                                <input type="text" id="matchSearch" class="form-control" placeholder="Search by team or group name" onkeyup="searchMatches()">
                            </div>
                            <div class="container">
                                <div id="matchList" style="display: none;">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Group</th>
                                                <th>VS</th>
                                                <th>Venue</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="matchTableBody">
                                            @php
                                                // Separate live matches from the rest
                                                $liveMatches = $matches->filter(function ($match) {
                                                    return $match->match_status == 1; // Live matches
                                                });
                                            
                                                // Group remaining matches by GroupID (excluding live matches)
                                                $groupedMatches = $matches->filter(function ($match) {
                                                    return $match->match_status != 1; // Non-live matches
                                                })->groupBy('GroupID');
                                            @endphp
                                            
                                            <!-- Display Live Matches First -->
                                            @if($liveMatches->isNotEmpty())
                                                <tr>
                                                    <th colspan="5" class="text-center bg-warning">Live Matches</th>
                                                </tr>
                                                @foreach($liveMatches as $match)
                                                    <tr>
                                                        <td>{{ $Groups[$match->GroupID]->Name }}</td>
                                                        <td>{{ $Teams[$match->TeamAID]->name }} vs {{ $Teams[$match->TeamBID]->name }}</td>
                                                        <td>{{ $match->Venue }}</td>
                                                        <td style="color: green;">Live</td>
                                                        <td>
                                                            <a href="{{ route('statistics.index', $match->Match_groupID) }}" class="input-styled-button">Input Score</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            
                                            <!-- Display Matches Grouped by GroupID -->
                                            @foreach($groupedMatches as $groupID => $groupMatches)
                                                <tr>
                                                    <th colspan="5" class="text-center bg-secondary">{{ $Groups[$groupID]->Name }}</th>
                                                </tr>
                                                @foreach($groupMatches as $match)
                                                    <tr>
                                                        <td>{{ $Groups[$match->GroupID]->Name }}</td>
                                                        <td>{{ $Teams[$match->TeamAID]->name }} vs {{ $Teams[$match->TeamBID]->name }}</td>
                                                        <td>{{ $match->Venue }}</td>
                                                        <td style="color: 
                                                            @switch($match->match_status)
                                                                @case(0) blue @break
                                                                @case(2) red @break
                                                            @endswitch">
                                                            @switch($match->match_status)
                                                                @case(0) Upcoming @break
                                                                @case(2) Ended @break
                                                            @endswitch
                                                        </td>
                                                        <td>
                                                            @switch($match->match_status)
                                                                @case(0)
                                                                    <form action="{{ route('matches.start', $match->Match_groupID) }}" method="POST" style="display:inline;">
                                                                        @csrf
                                                                        <button type="submit" class="styled-button">Start Match</button>
                                                                    </form>
                                                                @break
                                                                @case(2)
                                                                    @if($match->error) 
                                                                        <span class="error-styled-button">Error In Approval Process</span>
                                                                    @else 
                                                                        <button type="button" class="styled-button" data-toggle="modal" data-target="#matchModal" onclick="showMatchDetails({{ $match->Match_groupID }})">
                                                                            View Match Details
                                                                        </button>
                                                                    @endif
                                                                @break
                                                            @endswitch
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <div class="modal fade" id="matchModal" tabindex="-1" role="dialog" aria-labelledby="matchModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="matchModalLabel">Match Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="matchDetails">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    function showMatchDetails(matchId) {
        $.ajax({
            url: '/statistics/matches/' + matchId + '/details',
            method: 'GET',
            success: function(data) {
                $('#matchDetails').html(`
                    <p><strong>Tournament:</strong> ${data.TournamentID}</p>
                    <p><strong>Teams:</strong> ${data.TeamAName} vs ${data.TeamBName}</p>
                    <p><strong>Status:</strong> ${data.match_status}</p>
                    <p><strong>Date:</strong> ${data.Date}</p>
                    <p><strong>Start Time:</strong> ${data.start_time}</p>
                    <p><strong>End Time:</strong> ${data.end_time}</p>
                    <p><strong>Venue:</strong> ${data.Venue}</p>
                    <p><strong>Score:</strong> ${data.ScoreA} - ${data.ScoreB}</p>
                `);
            },
            error: function() {
                $('#matchDetails').html('<p>Error loading match details.</p>');
            }
        });
    }

    </script>
    <script>
        // Function to show or hide the match list
        function toggleMatchList() {
            var matchList = document.getElementById('matchList');
            if (matchList.style.display === 'none' || matchList.style.display === '') {
                matchList.style.display = 'block';
            } else {
                matchList.style.display = 'none';
            }
        }
    
        // Function to search matches
        function searchMatches() {
            var input, filter, tableBody, rows, td, i, txtValue;
            input = document.getElementById("matchSearch");
            filter = input.value.toLowerCase();
            tableBody = document.getElementById("matchTableBody");
            rows = tableBody.getElementsByTagName("tr");
    
            for (i = 0; i < rows.length; i++) {
                let rowText = rows[i].innerText.toLowerCase();
                if (rowText.includes(filter)) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }
    </script>
@include('layouts.footer')
</html>


