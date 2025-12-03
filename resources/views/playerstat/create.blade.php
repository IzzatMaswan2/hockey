<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Record Player Statistics</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-bottom: 20px;
        }
        .alert {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Record Player Statistics for Match: {{ $match->Venue }} on {{ $match->Date }}</h2>
    
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
    
        <form action="{{ route('playerstat.store', $match->Match_groupID) }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="Team">Select Team</label>
                <select id="team" name="team" class="form-control" required>
                    <option value="A">Team A</option>
                    <option value="B">Team B</option>
                </select>
            </div>

            <div class="form-group">
                <label for="PlayerID">Player</label>
                <select id="PlayerID" name="PlayerID" class="form-control" required>
                    <option value="">Select a Player</option>
                    @foreach($players as $player)
                        <option value="{{ $player->PlayerID }}" data-team="{{ $player->teamID }}">
                            {{ $player->Name }}
                        </option>
                    @endforeach
                </select>
            </div>
    
            <div class="form-group">
                <label for="Time">Time of Event</label>
                <input type="time" name="Time" class="form-control" required>
            </div>
    
            <div class="form-group">
                <label for="StatID">Statistic Type</label>
                <select name="StatID" class="form-control" required>
                    <option value="">Select Statistic</option>
                    @foreach($stats as $stat)
                        <option value="{{ $stat->StatID }}">{{ $stat->Description }}</option>
                    @endforeach
                </select>
            </div>
    
            <div class="form-group">
                <label for="Reason">Reason (Optional)</label>
                <input type="text" name="Reason" class="form-control" maxlength="100">
            </div>
    
            <div class="form-group">
                <label for="Score">Score</label>
                <input type="number" name="Score" class="form-control" required min="0">
            </div>
    
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $('#team').change(function() {
            var selectedTeam = $(this).val();
            $('#PlayerID option').each(function() {
                $(this).toggle($(this).data('team') === selectedTeam);
            });
        });
    });
</script>
</body>
</html>
