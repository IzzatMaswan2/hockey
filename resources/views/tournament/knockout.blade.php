<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/771de58f02.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <title>Knockout Stage</title>
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
                            <h4>Knockout Stage: Top Teams</h4>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success mt-3">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Tournament List -->
                        <div class="card">
                            <form action="/select-knockout-teams" method="POST">
                                @csrf

                                <input type="hidden" name="TourID" value="{{$TourID}}"> 
                                <h5>Top Teams</h5>
                                <table class="table table-bordered mb-3">
                                    <thead>
                                        <tr>
                                            <th style="width: 20%">Group</th>
                                            <th style="width: 40$">Team Name</th>
                                            <th style="width: 10%">Points</th>
                                            <th style="width: 10%">Goal Difference</th>
                                            <th style="width: 10%">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($teams as $index => $team)
                                            <tr class="{{ $index === 0 }}"> 
                                                <td>{{$team->groupcreate->Name ?? $team['groupcreate']['Name']}}</td>
                                                <td>{{ $team->team->Name ?? $team['team']['Name'] }}</td>
                                                <td>{{ $team->points ?? $team['points'] }}</td>
                                                <td>{{ $team->gd ?? $team['gd'] }}</td>
                                                <td>
                                                    <span class="badge {{ 'bg-success' }}">
                                                        {{ 'Top Team' }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <!-- Teams tied for 8th -->
                                {{-- @if ($isTie)
                                <h5>Teams Tied for 8th</h5>
                                <table class="table table-bordered mb-3">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%">Select</th>
                                            <th style="width: 20%">Group</th>
                                            <th style="width: 40$">Team Name</th>
                                            <th style="width: 10%">Points</th>
                                            <th style="width: 10%">Goal Difference</th>
                                            <th style="width: 10%">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="yellow">
                                            <td>
                                                <input type="checkbox" name="teams[]" value="{{ $teams[8]->team_id }}">
                                            </td>
                                            <td>{{$team->groupcreate->Name}}</td>
                                            <td>{{ $teams[8]->team->Name }}</td>
                                            <td>{{ $teams[8]->points }}</td>
                                            <td>{{ $teams[8]->gd }}</td>
                                            <td><span class="badge bg-warning">Tie for 8th</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                                @endif --}}

                                <!-- Unqualified Teams -->
                                {{-- <h5>Unqualified Teams</h5>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%">Select</th>
                                            <th style="width: 20%">Group</th>
                                            <th style="width: 40$">Team Name</th>
                                            <th style="width: 10%">Points</th>
                                            <th style="width: 10%">Goal Difference</th>
                                            <th style="width: 10%">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($unqualified as $team)
                                        <tr class="grey">
                                            <td>
                                                <input type="checkbox" name="teams[]" value="{{ $team->team_id }}">
                                            </td>
                                            <td>{{$team->groupcreate->Name}}</td>
                                            <td>{{ $team->team->Name }}</td>
                                            <td>{{ $team->points }}</td>
                                            <td>{{ $team->gd }}</td>
                                            <td><span class="badge bg-secondary">Not Qualified</span></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table> --}}

                                <button type="submit" class="styled-button mt-3">Select Teams</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@include('layouts.footer')
</html>
