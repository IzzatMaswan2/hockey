<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/771de58f02.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <title>Player Dashboard</title>
</head>

<body style="background-color: #f4f7f6;">
    <!-- Navbar -->
    @include('layouts.navbar')

    <!-- Main Layout -->
    <div class="container-fluid d-flex justify-content-center align-items-center" style="min-height: 80vh;"> <!-- Full height and centered -->
        <div class="col-10"> <!-- Adjust the column width for better centering -->
            <div class="container mt-4 text-center"> <!-- Center text inside the main container -->
                <h1 style="color:#5D3CB8; font-weight:bold;">Hello! Player {{ Auth::user()->fullName }}!</h1>

                <!-- Display Team Information -->
                <div class="card mb-4 mx-auto" style="background-image: url('{{ asset('img/logreg.jpg') }}'); background-size: cover; background-position: center; max-width: 1010px;">
                    <div class="card-body">
                        <div class="row text-center"> <!-- Create a row for two columns -->
                            <div class="col-md-6"> <!-- First column for Team Information -->
                                <!-- Smaller container with white background and opacity -->
                                <div class="bg-white" style="opacity: 0.8; padding: 20px; border-radius: 10px;">
                                    <h5 class="text-center fw-bold">Team Information</h5>
                                    <h3>{{ $teamDetails['name'] }}</h3> <!-- Team name -->

                                    <!-- Display Team Logo -->
                                    @if($teamDetails['logo'])
                                    <div class="mb-2">
                                        <img src="{{ $teamDetails['logo'] }}" alt="{{ $teamDetails['name'] }} Logo" style="width: 100px; height: 100px; border-radius: 10px;">
                                    </div>
                                    @else
                                    <p class="card-text"><i class="bi bi-image"></i> Team Logo: <b>No logo available</b></p>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6"> <!-- Second column for Player Information -->
                                <!-- Smaller container with white background and opacity -->
                                <div class="bg-white" style="opacity: 0.8; padding: 20px; border-radius: 10px;">
                                    <h5 class="fw-bold">Player Information</h5>
                                    <p><strong>Name:</strong> {{ Auth::user()->fullName }}</p>
                                    <p><strong>Display Name:</strong> {{ Auth::user()->displayName }}</p>
                                    <p><strong>Position:</strong> {{ Auth::user()->position }}</p>
                                    <p><strong>Jersey Number:</strong> {{ Auth::user()->jerseyNumber }}</p>
                                    <p><strong>Field Status:</strong> {{ Auth::user()->field_status }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tournaments Your Team Has Joined -->
                <div class="row mb-4 d-flex justify-content-center"> <!-- Center the card horizontally -->
                    <div class="col-md-8"> <!-- Adjust column width for centering -->
                        <div class="card" style="background-image: url('{{ asset('img/logreg.jpg') }}'); background-size: cover; background-position: center;"> 
                            <div class="card-body text-center"> <!-- Center text inside the card -->
                                <!-- Smaller container with white background and opacity -->
                                <div class="bg-white mx-auto" style="opacity: 0.8; padding: 20px; border-radius: 10px; max-width: 1000px;"> <!-- Center and limit width -->
                                    <ul class="list-unstyled"> <!-- Remove default list styling -->
                                        <h5>Tournaments Your Team Has Joined:</h5>
                                        @if($teamTournaments->isEmpty())
                                            <li>No tournaments joined.</li> <!-- Handle case with no tournaments -->
                                        @else
                                            @foreach($teamTournaments as $tournament)
                                                <li>{{ $tournament->name }}</li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div> <!-- Close main content container -->
        </div> <!-- Close main content column -->
    </div> <!-- Close container fluid -->

    @include('layouts.footer')
</body>

</html>
