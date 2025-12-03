<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/771de58f02.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <title>Match Statistic</title>
    
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

        .matchtab {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 50px;
            background-color: #7A5DCA;
            border-radius: 10px;
            position: relative;
        }

        .tabm {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            text-align: center;
            gap: 80px;
        }

        .matchcontent {
            background-color: #7A5DCA;
            padding: 10px;
            border-radius: 10px;
            color: #FFF; /* Ensuring text is visible against the background */
        }

        .teamlogo {
            margin-top: 100px;
            height: 40vw; /* Adjust the height as a percentage of the viewport width */
            max-height: 100px; /* Ensure it does not exceed a certain height */
            position: relative;
            top: 50%;
            transform: translateY(-50%);
        }

        .teamlogo.left {
            left: 2vw; 
        }

        .teamlogo.right {
            right: 2vw; 
        }

        .vs-container {
            text-align: center;
            align-items: center;
            margin-top: 10px; 
            color: #FFFFFF;
        }

        .vs {
            font-size: 24px;
            font-weight: bold;
            color: #FFFFFF;
            margin-left: 80px; 
            margin-right: 80px;
            z-index: 1; 
        }

        .date, time {
            font-size: 15px;
            font-weight: bold;
            color: #FFFFFF;
        }

        .finalscore {
            font-size: 48px;
            color: #fff;
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
                            <h4>Update The Event Happening in the Match</h4>
                            <p class="text-muted">FIll in the statistic of the Match</p>
                        </div>
    
                        <div class="container">
                            <h4 class="mt-4">Match Statistics for {{ $match->Venue }}</h4>
                            <div class="matchtab">
                                <div class="tabm">
                                    <img src="{{asset('storage/' . $TeamA->logoURL)}}" alt="{{$TeamA->name}}Logo" class="teamlogo left">
                                    <div class="matchcontent">
                                        <h3>{{$Teams[($match->TeamAID)-1]->name}}</h3>
                                        <div class="finalscore">{{$match->ScoreA ?? 'N/A'}}</div>
                                    </div>
                                </div>
                                
                                <div class="vs-container">
                                    <div class="vs">vs</div>
                                </div>
                                
                                <div class="tabm">
                                    <div class="matchcontent">
                                        <h3>{{$Teams[($match->TeamBID)-1]->name}}</h3>
                                        <div class="finalscore">{{$match->ScoreB ?? 'N/A'}}</div>
                                    </div>
                                    <img src="{{asset('storage/' . $TeamB->logoURL)}}" alt="{{$TeamB->name}}Logo" class="teamlogo right">
                                </div>
                            </div>
                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                    
                            <div class="container" style="background-color: #f4f7f6; margin-bottom: 20px; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                                <form method="POST" action="{{ route('statistics.store', $match->Match_groupID) }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="Player" class="form-label">Player:</label>
                                        <select class="form-select" id="PlayerID" name="PlayerID">
                                            <option value="">Select a Player</option>
                                            @foreach ($combinedPlayers as $player)
                                                <option value="{{ $player['id'] }}">
                                                    {{ $player['name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="Time" class="form-label">Minute of Event :</label>
                                        <input type="text" class="form-control" id="Time" name="Time" value="00:00:00" placeholder="e.g., 00:00:15" required>
                                        <small class="form-text text-muted">Enter time in the format MM:SS.</small>
                                    </div>
                                    <span>Statistic</span>
                                        <select class="form-select" id="StatID" name="StatID">
                                            <option value="">Select the Statistic</option>
                                            @foreach ($stats as $stat)
                                                <option value="{{ $stat['StatID'] }}">
                                                    {{ $stat['Description'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    <div class="mb-3">
                                        <label for="Reason" class="form-label">Reason:</label>
                                        <input type="text" class="form-control" id="Reason" name="Reason" maxlength="100">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </form>
                            </div>
                            
                    
                            <h5 class="mt-4">Existing Statististic & Event Happen During Match</h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 30%;">Player</th>
                                        <th style="width: 10%;">Time</th>
                                        <th style="width: 15%;">Description</th>
                                        <th style="width: 30%;">Reason</th>
                                        <th style="width: 15%;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($statistics as $statistic)
                                        <tr>
                                            <td>{{ $players[$statistic->PlayerID]->displayName ?? 'Unknown' }}</td>
                                            <td>{{ $statistic->Time }}</td>
                                            <td>{{ $stats[($statistic->StatID)-1]->Description ?? 'None' }}</td>
                                            <td>{{ $statistic->Reason }}</td>
                                            <td>
                                                <a href="{{ route('statistics.edit', $statistic->PlayerStatMatchID) }}" class="btn btn-warning btn-sm">Edit</a>
                                                <form method="POST" action="{{ route('statistics.destroy', $statistic->PlayerStatMatchID) }}" class="d-inline" onsubmit="return confirmDelete();">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                                
                                                <script>
                                                    function confirmDelete() {
                                                        return confirm('Are you sure you want to delete this event?');
                                                    }
                                                </script>                                                
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
</body>
@include('layouts.footer')
</html>


