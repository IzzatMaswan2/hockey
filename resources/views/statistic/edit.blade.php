
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/771de58f02.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <title>Edit Statistic</title>
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
                            <h4>Edit Statistic</h4>
                            <p class="text-muted">FIll in the statistic of the Match</p>
                        </div>
    
                        <form method="POST" action="{{ route('statistics.update', $statistic->PlayerStatMatchID) }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="Match_groupID" value="{{ $statistic->Match_groupID }}">
                            <span>Player Name</span>
                            <select class="form-select" id="PlayerID" name="PlayerID">
                                @foreach ($combinedPlayers as $player)
                                    <option value="{{ $player['id'] }}" {{ $player['id'] == $statistic->PlayerID ? 'selected' : '' }}>
                                        {{ $player['name'] }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="mb-3">
                                <label for="Time" class="form-label">Time (H:i):</label>
                                <input type="text" class="form-control" id="Time" name="Time" value="{{ $statistic->Time }}">
                            </div>
                            <span>Statistic</span>
                            <select class="form-select" id="StatID" name="StatID">
                                @foreach ($stats as $stat)
                                    <option value="{{ $stat['StatID'] }}" {{ $stat['StatID'] == $statistic->StatID ? 'selected' : '' }}>
                                        {{ $stat['Description'] }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="mb-3">
                                <label for="Reason" class="form-label">Reason:</label>
                                <input type="text" class="form-control" id="Reason" name="Reason" value="{{ $statistic->Reason }}" maxlength="100">
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@include('layouts.footer')
</html>


