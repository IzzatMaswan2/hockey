<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/771de58f02.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <title>Tournament Selection</title>
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
        }
        .sidebar {
            background-color: #929292;
            padding: 20px;
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
                            <h4>Select a Tournament</h4>
                            <p class="text-muted">Choose a tournament to view matches and statistics</p>
                        </div>

                        <!-- Tournament List -->
                        <div class="card">
                            <div class="card-header" style="background-color:transparent;padding-top:20px;">
                                <h5>Tournaments</h5>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Tournament Name</th>
                                            <th scope="col" class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($tournaments as $tournament)
                                            <tr>
                                                <td>{{ $tournament->name }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('stat.matches.index', $tournament->id) }}" class="btn btn-primary btn-sm me-2">View Matches</a>
                                                    @if ($knockout->has($tournament->id))
                                                        @php
                                                            $tournament_id = $tournament->id;
                                                        @endphp
                                                        <a href="{{ route('knockout.match', $tournament_id) }}" class="btn btn-secondary btn-sm">View Knockout Matches</a>
                                                    @endif
                                                </td>
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
    </div>
</body>
@include('layouts.footer')
</html>
