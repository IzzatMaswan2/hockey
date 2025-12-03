<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta, CSS, and JavaScript links as before -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/771de58f02.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.2.2/dist/echarts.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="icon" href="img/Logo.png" type="image/icon type">
    <title>Manage Match</title>
    <style>
        th {
            color: #5D3CB8;
        }

        table,
        th,
        td {
            border: 1px solid #007bff;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
        }

        .btn-update {
            color: white;
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: 600;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-update:hover {
            background-color: #4a2f9c;
            border-color: #4a2f9c;
            transform: scale(1.05);
        }

        .btn-update:focus,
        .btn-update:active {
            outline: none;
            box-shadow: 0 0 10px rgba(93, 60, 184, 0.5);
        }

        .status-upcoming {
            color: #00FF87;
        }

        .status-ongoing {
            color: #FFC107;
        }

        .vs-text {
            font-size: 1rem;
            line-height: 1;
            font-weight: bold;
        }

        .form-row-align-right {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            margin: 30px;
        }

        .status {
            text-align: left;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    @include('layouts.navbar')

    <div class="container-fluid" style="width: 100%; height: 90%;">
        <div class="row">
            <div class="col-2" style="background-color: #929292;">
                @include('layouts.sidebar')
            </div>

            <div class="col-8">
                <h4 class="mt-4 mb-3" style="color: #5D3CB8;">
                    <strong>CREATE NEW MATCH</strong>
                </h4>

                <!-- Match Form -->
                <form action="{{ route('matches.auto-create') }}" method="POST">
                    @csrf
                    <div class="row">
                        <!-- Tournament Dropdown -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tournament_id">Tournament</label>
                                <select class="form-control" id="tournament_id" name="tournament_id" required>
                                    <option value="">Select Tournament</option>
                                    @foreach($tournaments as $tournament)
                                    <option value="{{ $tournament->id }}">{{ $tournament->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Category Dropdown -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select class="form-control" id="category_id" name="category_id" required>
                                    <option value="">Select Category</option>
                                    <!-- Categories will be populated dynamically -->
                                </select>
                            </div>
                        </div>

                        <!-- Group Dropdown -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="group">Group</label>
                                <select class="form-control" id="group" name="group" required>
                                    <option value="">Select Group</option>
                                </select>
                            </div>
                        </div>

                        <!-- Date -->
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="date" class="form-control" id="date" name="date">
                            </div>
                        </div>

                        <!-- Start Time -->
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="startTime">Start Time</label>
                                <input type="time" class="form-control" id="start_time" name="start_time">
                            </div>
                        </div>

                        <!-- End Time -->
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="endTime">End Time</label>
                                <input type="time" class="form-control" id="end_time" name="end_time">
                            </div>
                        </div>

                        <!-- Venue -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="venue">Venue</label>
                                <select class="form-control" id="venue" name="venue" required>
                                    <option value="">Select Venue</option>
                                    @foreach($venues as $venue)
                                    <option value="{{ $venue->id }}">{{ $venue->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Scoring Judge, Timing Judge, and Submit Button -->
                    <div class="row form-row-align-right mt-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="scoringReferee">Scoring Referee</label>
                                <select class="form-control" id="scoring_referee" name="scoring_referee" required>
                                    <option value="">Select Referee</option>
                                    @foreach($referee as $scoringReferee)
                                    <option value="{{ $scoringReferee->id }}">{{ $scoringReferee->Name }}-{{ $scoringReferee->Role }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="timingReferee">Timing Referee</label>
                                <select class="form-control" id="timing_referee" name="timing_referee" required>
                                    <option value="">Select Referee</option>
                                    @foreach($referee as $timingReferee)
                                    <option value="{{ $timingReferee->id }}">{{ $timingReferee->Name }}-{{ $timingReferee->Role }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">CREATE MATCHES</button>
                        </div>
                    </div>
                </form>

                <!-- Event Selection -->
                <div class="mb-3">
                    <label for="eventSelect" class="form-label">Select Tournament</label>
                    <select id="eventSelect" class="form-select">
                        <option value="all">All Tournaments</option>
                        @foreach($tournaments as $tournament)
                        <option value="{{ $tournament->id }}">{{ $tournament->name }}</option>
                        @endforeach
                    </select>
                </div>

                @php
                $mytime = Carbon\Carbon::now();
                echo $mytime->toDateString();
                @endphp

                <!-- Match Schedule Table -->
                <table class="table table-striped" id="matchTable">
                    <thead>
                        <tr>
                            <th>MATCH SCHEDULE</th>
                            <th>DATE & TIME</th>
                            <th>GROUP</th>
                            <th>CATEGORY</th>
                            {{-- <th>STATUS</th> --}}
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody id="matchTableBody">
                        @foreach($matches as $match)
                        <tr data-event="{{ $match->tournament_id }}" data-date="{{ $match->date }}" data-time="{{ $match->start_time }}">
                            <td>{{ $match->team1->name }} vs {{ $match->team2->name }}</td>
                            <td>{{ $match->date }} {{ $match->start_time }}</td>
                            <td>{{ $match->groupcreate->Name ?? 'Knockout' }}</td>
                            <td>{{ $match->category->name ?? '-' }}</td>

                            {{-- @if($mytime->toDateString() > $match->date)
                            <td style="color: green;">Completed</td>
                            @elseif($mytime->toDateString() < $match->date)
                            <td style="color: blue;">Upcoming</td>
                            @else
                            <td style="color: orange;">On-going</td>
                            @endif --}}

                            <td>
                                <a href="{{ route('matches.edit', $match->id) }}" class="btn btn-sm btn-update" style="background-color: #50C878;">
                                    Update
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Filter match table by tournament
        document.getElementById('eventSelect').addEventListener('change', function () {
            var selectedEvent = this.value;
            var rows = document.querySelectorAll('#matchTable tbody tr');

            rows.forEach(function (row) {
                row.style.display = selectedEvent === 'all' || row.getAttribute('data-event') === selectedEvent ? '' : 'none';
            });
        });

        document.getElementById('tournament_id').addEventListener('change', function () {
            var tournamentId = this.value;

            // Category dropdown
            var categorySelect = document.getElementById('category_id');
            categorySelect.innerHTML = '<option value="">Select Category</option>';

            // Clear group dropdown
            var groupSelect = document.getElementById('group');
            groupSelect.innerHTML = '<option value="">Select Group</option>';

            if (tournamentId) {
                // Fetch categories for this tournament
                fetch('/get-categories-by-tournament/' + tournamentId)
                    .then(res => res.json())
                    .then(data => {
                        data.forEach(function (category) {
                            var option = document.createElement('option');
                            option.value = category.id;
                            option.text = category.name;
                            categorySelect.appendChild(option);
                        });
                    }).catch(err => console.error(err));
            }
        });

        // When a category is selected, fetch groups under that tournament & category
        document.getElementById('category_id').addEventListener('change', function () {
            var categoryId = this.value;
            var tournamentId = document.getElementById('tournament_id').value;

            var groupSelect = document.getElementById('group');
            groupSelect.innerHTML = '<option value="">Select Group</option>';

            if (categoryId && tournamentId) {
                fetch('/get-groups-by-tournament-and-category/' + tournamentId + '/' + categoryId)
                    .then(res => res.json())
                    .then(data => {
                        data.forEach(function (group) {
                            var option = document.createElement('option');
                            option.value = group.GroupID;
                            option.text = group.Name;
                            groupSelect.appendChild(option);
                        });
                    }).catch(err => console.error(err));
            }
        });

    </script>

    @include('layouts.footer')
</body>

</html>
