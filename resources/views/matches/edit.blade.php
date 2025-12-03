<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta, CSS, and JavaScript links as before -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-6S3kS8Z2v3dHhe04cF0xtbB7t8Z6ZtQbCOkOqgRIse0dY+6BfVtA8tTu1Q8l10m4" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-DbfNwCApThcJe4fP5z5LfXz0cI0zTXh83Ge9pu6vxZyL2W1p7FSm5lZZjBX92W48" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/771de58f02.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.2.2/dist/echarts.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" href="img/Logo.png" type="image/icon type">

    <title>Edit Match</title>
    
    <style>
        .btn.btn-primary {
            border-radius: 12px;
            border-color: #22b67c;
            background-color: #22b67c;
            margin: 30px;

        }

        .card{
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            margin: 50px;
        }

        .form-group {
            font-weight: bold;
        }

        .btn.btn-secondary{
            border-radius: 12px;
            border-color: #22b67c;
            background-color: #22b67c;
            margin: 30px;

        }
    </style>
</head>

<body>
    @include('layouts.navbar')

    <div class="container-fluid" style="height: 90%;">
        <div class="row">
            <div class="col-2" style="background-color: #929292; width: 20%;">
                @include('layouts.sidebar')
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="col-8">
                <div class="card">
                    <div class="card-header" style="color: #5D3CB8;">
                        <h3 class="mb-0"><strong>EDIT MATCH</strong></h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('matches.update', $matches->id) }}" method="POST">
                            @csrf
                            @method('PUT') <!-- To indicate it's an update -->

                            <div class="row">
                                <!-- Competing Team 1 -->
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="team1">Competing Team 1</label>
                                        <input type="text" class="form-control" id="team1_name" name="team1_name" 
                                            value="{{ $matches->team1->name }}" placeholder="Enter Team 1 Name">
                                    </div>
                                </div>

                                <!-- VS Text -->
                                <div class="col-md-4 mb-3 d-flex justify-content-center">
                                    <span class="vs-text"><strong>VS</strong></span>
                                </div>

                                <!-- Competing Team 2 -->
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="team2">Competing Team 2</label>
                                        <input type="text" class="form-control" id="team2_name" name="team2_name" 
                                            value="{{ $matches->team2->name }}" placeholder="Enter Team 2 Name">
                                    </div>
                                </div>
                            </div>

                            <!-- Date, Start Time, End Time -->
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="date">Date</label>
                                        <input type="date" class="form-control" id="date" name="date" 
                                            value="{{ $matches->date }}">
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="startTime">Start Time</label>
                                        <input type="time" class="form-control" id="start_time" name="start_time" 
                                            value="{{ $matches->start_time }}">
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="endTime">End Time</label>
                                        <input type="time" class="form-control" id="end_time" name="end_time" 
                                            value="{{ $matches->end_time }}">
                                    </div>
                                </div>
                            </div>

                            <!-- Group -->
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="group">Group</label>
                                    <input type="text" class="form-control" id="group" name="group" 
                                        value="{{ $matches->groupcreate->Name }}" placeholder="Enter Group Name">
                                </div>
                            </div>

                            <!-- Venue -->
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                <label for="venue">Venue</label>
                                <select class="form-control" id="venue" name="venue">
                                    <option value="">Select Venue</option>
                                    @foreach($venues as $venue)
                                        <option value="{{ $venue->id }}">{{ $venue->name}}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="col-md-12 d-flex justify-content-end">
                                <button type="button" class="btn btn-secondary" onclick="history.back()"><i class="fa-solid fa-arrow-left-long" style="color: #f0f2f4;"></i></button>
                                <button type="submit" class="btn btn-primary">UPDATE MATCH</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footer')
</body>
</html>

