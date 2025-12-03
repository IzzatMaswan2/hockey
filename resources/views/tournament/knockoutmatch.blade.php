<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/771de58f02.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <title>Knockout Matches</title>
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
        .green {
            background-color: green;
            color: white;
        }
        .yellow {
            background-color: yellow;
        }
        .grey {
            background-color: grey;
            color: white;
        }
        .styled-button {
            display: inline-block;
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .styled-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

@include('layouts.navbar')

<body style="background-color: #f4f7f6;">

    <div class="container-fluid" style="width: 100%; height: 90%; min-height: 100vh;">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-3" style="background-color: #929292; min-height: 100vh; width: 20%;">
                @include('layouts.sidebar')
            </div>

            <div class="col-9" style="padding: 10px; margin:10px;">
                <div class="container-fluid">
                    <div class="row" style="margin-top:0;">
                        <!-- Header -->
                        <div class="mb-4" style="margin-top:0;">
                            <h4>Knockout Matches for Tournament {{ $tournament->name }}</h4>
                            <p class="text-muted">Manage and edit the knockout matches below.</p>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success mt-3">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Matches List -->
                        <div class="card">
                            <div class="card-body">
                                <h5>Knockout Matches</h5>
                                <div class="row">
                                    @foreach($knockoutMatches as $match)
                                    <div class="col-md-6">
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <h5 class="card-title">Match {{ $loop->iteration }}</h5>
                                                @if($match->stage == 1)
                                                    <span class="card-title">Quater-Finale</span>
                                                @elseif($match->stage == 2)
                                                    <span>Semi-Finale </span>
                                                @elseif($match->stage == 3)
                                                    <span>Finale</span>
                                                @endif
                                                <p class="card-text">
                                                    <strong>Team A:</strong> <span class="team-name">{{ $match->team1->name }}</span> <br>
                                                    <strong>Team B:</strong> <span class="team-name">{{ $match->team2->name }}</span> <br>
                                                    <strong>Match Status:</strong> 
                                                    @if ($match->match_status == 0)
                                                        Pending
                                                    @elseif ($match->match_status == 1)
                                                        Live
                                                    @elseif ($match->match_status == 2)
                                                        Completed
                                                    @endif <br>
                                                    <strong>Venue:</strong> {{ $match->venue->name ?? 'TBD' }} <br>
                                                    <strong>Date:</strong> {{ $match->date ?? 'TBD' }} <br>
                                                    <strong>Start Time:</strong> {{ $match->start_time ?? 'TBD' }} <br>
                                                    <strong>End Time:</strong> {{ $match->end_time ?? 'TBD' }} <br>
                                                    <strong>Scoring Referee:</strong> {{ $match->scoringReferee->Name ?? 'TBD' }} <br>
                                                    <strong>Timing Referee:</strong> {{ $match->timingReferee->Name ?? 'TBD' }} <br>
                                                </p>
                                                <button class="styled-button" data-bs-toggle="modal" data-bs-target="#editMatchModal{{ $match->id }}">Edit</button>
                                                    @if ($match->match_status == 0)
                                                        <form action="{{ route('knockoutmatches.start', $match->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            <button type="submit" class="styled-button" style="background-color: green">Start Match</button>
                                                        </form>
                                                    @endif
                                                @if ($match->error == 1)
                                                    <button class="styled-button" data-bs-toggle="modal" data-bs-target="#errorScoreModal{{ $match->id }}" style="background-color: rgb(255, 17, 17)">Fix Score</button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Edit Match Modal -->
                                    <div class="modal fade" id="editMatchModal{{ $match->id }}" tabindex="-1" aria-labelledby="editMatchModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('update.knockout', ['id' => $match->id]) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editMatchModalLabel">Edit Match {{ $loop->iteration }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="date" class="form-label">Date</label>
                                                            <input type="date" class="form-control" name="Date" value="{{ $match->date }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="start_time" class="form-label">Start Time</label>
                                                            <input type="time" class="form-control" name="start_time" value="{{ $match->start_time }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="end_time" class="form-label">End Time</label>
                                                            <input type="time" class="form-control" name="end_time" value="{{ $match->end_time }}">
                                                        </div>
                                                        
                                                        <!-- Venue Dropdown -->
                                                        <div class="mb-3">
                                                            <label for="venue" class="form-label">Venue</label>
                                                            <select class="form-control" id="venue" name="venue" required>
                                                                <option value="">Select Venue</option>
                                                                @foreach($venues as $venue)
                                                                    <option value="{{ $venue->id }}" {{ $match->venue_id == $venue->id ? 'selected' : '' }}>{{ $venue->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                            <!-- Scoring Referee Dropdown -->
                                                            <div class="mb-3">
                                                                <label for="scoring_referee" class="form-label">Scoring Referee</label>
                                                                <select class="form-control" id="scoring_referee" name="ScoringRefereeID" required> <!-- Updated name -->
                                                                    <option value="">Select Scoring Referee</option>
                                                                    @foreach($referees as $scoringReferee)
                                                                        <option value="{{ $scoringReferee->id }}" {{ $match->ScoringRefereeID == $scoringReferee->id ? 'selected' : '' }}>
                                                                            {{ $scoringReferee->Name }} - {{ $scoringReferee->Role }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <!-- Timing Referee Dropdown -->
                                                            <div class="mb-3">
                                                                <label for="timing_referee" class="form-label">Timing Referee</label>
                                                                <select class="form-control" id="timing_referee" name="TimingRefereeID" required> <!-- Updated name -->
                                                                    <option value="">Select Timing Referee</option>
                                                                    @foreach($referees as $timingReferee)
                                                                        <option value="{{ $timingReferee->id }}" {{ $match->TimingRefereeID == $timingReferee->id ? 'selected' : '' }}>
                                                                            {{ $timingReferee->Name }} - {{ $timingReferee->Role }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>


                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="errorScoreModal{{ $match->id }}" tabindex="-1" aria-labelledby="errorScoreModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('update.knockout', ['id' => $match->id]) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="errorScoreModalLabel">Edit Score for Match {{ $loop->iteration }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Score for Team A -->
                                                        <div class="mb-3">
                                                            <label for="ScoreA" class="form-label">Score for Team A</label>
                                                            <input type="number" class="form-control" name="ScoreA" value="{{ $match->Score1 }}">
                                                        </div>
                                    
                                                        <!-- Score for Team B -->
                                                        <div class="mb-3">
                                                            <label for="ScoreB" class="form-label">Score for Team B</label>
                                                            <input type="number" class="form-control" name="ScoreB" value="{{ $match->Score2 }}">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save Score</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

@include('layouts.footer')

</html>
