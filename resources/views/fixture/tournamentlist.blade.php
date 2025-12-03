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
        width: 190px;
        height: 254px;
        border-radius: 30px;
        background: #e0e0e0;
        box-shadow: 15px 15px 30px #bebebe,
                    -15px -15px 30px #ffffff;
        margin-bottom: 50px;
        }


    </style>
</head>
@include('components.side-nav')
@include('profile.partials.navbar')
<body >
<div class="container-fluid" style="height: 90%;">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-2">
            </div>

            <div class="col-8">
                <div class="container-fluid">
                    <div class="row" style="margin-top:0;">
                        <!-- Header -->
                        <div class="mb-4">
                            <h4>Select a Tournament</h4>
                            <p class="text-muted">Choose a tournament to view match schedule</p>
                        </div>
    
                        <!-- Tournament List -->
                        <div class="card ">
                            <div class="card-header" style="background-color:transparent;padding-top:20px;">
                                <h5>Tournaments</h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-group">
                                    @foreach($tournaments as $tournament)
                                        <li class="list-group-item">
                                            <a href="{{ route('fixture.index', $tournament->id) }}" class="text-decoration-none">
                                                {{ $tournament->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
             </div>
        </div>
    </div>
</body>

</html>
@include('profile.partials.footer')


