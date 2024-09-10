<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/771de58f02.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.2.2/dist/echarts.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    @include('profile.partials.navbar')

    <div class="container-fluid" style="height: 90%; padding: 0;">
        <div class="row">
            <div class="col-3" style="background-color: #D3D3D3;">
                @include('layouts.sidebar-manager')
            </div>

            <div class="col-9 mt-5">
                <!-- Welcome Message -->
                <div class="text-center mb-4">
                    <h1 style="color:#280137; font-weight:bold;">Welcome, manager {{ Auth::user()->name }}!</h1>
                </div>

                <!-- Dashboard Stats -->
                <div class="row mb-4">
                    <!-- Box 1: Total Players -->
                    <div class="col-md-4 mb-3">
                        <div class="card text-white bg-primary">
                            <div class="card-body text-center">
                                <h5 class="card-title">Total Players</h5>
                                <p class="card-text">{{ $totalPlayers ?? 0 }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Box 2: Wins -->
                    <div class="col-md-4 mb-3">
                        <div class="card text-white bg-success">
                            <div class="card-body text-center">
                                <h5 class="card-title">Total Wins</h5>

                            </div>
                        </div>
                    </div>

                    <!-- Box 3: Losses -->
                    <div class="col-md-4 mb-3">
                        <div class="card text-white bg-danger">
                            <div class="card-body text-center">
                                <h5 class="card-title">Total Losses</h5>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Players Table -->
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Player Name</th>
                                <th>Jersey Number</th>
                                <th>Wins</th>
                                <th>Losses</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($players as $player)
                            <tr>
                                <td>{{ $player->fullName }}</td>
                                <td>{{ $player->jerseyNumber }}</td>
                                <td>{{ $player->wins ?? 0 }}</td>
                                <td>{{ $player->losses ?? 0 }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footer')
</body>

</html>
