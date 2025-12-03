<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/771de58f02.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.2.2/dist/echarts.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Manage Article</title>
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

        .content {
            padding: 20px;
        }
    </style>
</head>
<body style="background-color: #f4f7f6;">

    <!-- Navbar -->
    @include('layouts.navbar')
    <!-- Main Content -->
    <div class="container-fluid" style="width: 100%; height: 90%;">
        <div class="row">
            <div class="col-2" style="background-color: #929292;">
                @include('layouts.sidebar')
            </div>

            <div class="col-9" style="padding:0;margin:0;" >

            <!-- Main Content -->
            <div class="col-9 content" style="padding:0;margin:15px; height: 100vh;">
                <h2 class="mb-4">Ongoing Matches</h2>
                <div class="table-container">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Venue</th>
                                <th>Date</th>
                                <th>Teams</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($liveMatchDetails as $detail)
                                <tr>
                                    <td>{{ $detail['match']->Venue }}</td>
                                    <td>{{ $detail['match']->Date }}</td>
                                    <td>{{ $detail['teamA']->Name }} vs {{ $detail['teamB']->Name }}</td>
                                    <td>
                                        <a href="{{ route('playerstat.create', $detail['match']->Match_groupID) }}" class="btn btn-primary">Input Player Stats</a>
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

    <!-- Include Footer -->
    @include('layouts.footer')
</body>
</html>

