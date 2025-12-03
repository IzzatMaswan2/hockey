<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/771de58f02.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <title>Manager Dashboard</title>
</head>

<body style="background-color: #f4f7f6;">
    <!-- Navbar -->
    @include('layouts.navbar')

    <!-- Main Layout -->
    <div class="container-fluid" style="width: 100%; height: 100%;">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-2" style="background-color: #929292; height: 100vh;">
                @include('layouts.sidebar-manager')
            </div>

            <!-- Main Content -->
            <div class="col-10">
                <div class="container mt-4">
                <h1 class="" style="color:#5D3CB8;font-weight:bold;">Hello! welcome Manager {{ Auth::user()->fullName }}!</h1>
                    <!-- Display total players for the manager and team -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5>Total Players Registered by You:</h5>
                                    <p class="card-text">{{ count($managerPlayers) }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5>Total Players Under Your Team:</h5>
                                    <p class="card-text">{{ count($teamPlayers) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5>Tournaments Your Team Has Joined:</h5>
                                    <ul>
                                        @foreach($teamTournaments as $tournament)
                                        <li>{{ $tournament->name }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabs for players -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="manager-players-tab" data-bs-toggle="tab" data-bs-target="#manager-players" type="button" role="tab" aria-controls="manager-players" aria-selected="true">My Registered Players</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="team-players-tab" data-bs-toggle="tab" data-bs-target="#team-players" type="button" role="tab" aria-controls="team-players" aria-selected="false">Players Under My Team</button>
                        </li>
                    </ul>

                    <div class="tab-content mt-3" id="myTabContent">
                        <!-- Tab 1: Manager's Registered Players -->
                        <div class="tab-pane fade show active" id="manager-players" role="tabpanel" aria-labelledby="manager-players-tab">
                            <h4>My Registered Players</h4>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Player Name</th>
                                        <th>Jersey Number</th>
                                        <th>Position</th>
                                        <th>Date of Birth</th>
                                        <th>Contact</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($managerPlayers as $player)
                                    <tr>
                                        <td>{{ $player->fullName }}</td>
                                        <td>{{ $player->jerseyNumber }}</td>
                                        <td>{{ $player->position }}</td>
                                        <td>{{ $player->dob }}</td>
                                        <td>{{ $player->contact }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Tab 2: All Players Under the Same Team -->
                        <div class="tab-pane fade" id="team-players" role="tabpanel" aria-labelledby="team-players-tab">
                            <h4>Players Under My Team</h4>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Player Name</th>
                                        <th>Jersey Number</th>
                                        <th>Position</th>
                                        <th>Date of Birth</th>
                                        <th>Contact</th>
                                        <th>Registered By</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($teamPlayers as $player)
                                    <tr>
                                        <td>{{ $player->fullName }}</td>
                                        <td>{{ $player->jerseyNumber }}</td>
                                        <td>{{ $player->position }}</td>
                                        <td>{{ $player->dob }}</td>
                                        <td>{{ $player->contact }}</td>
                                        <td>{{ $player->manager->fullName ?? 'huh' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

  
</body>
@include('layouts.footer')
</html>
