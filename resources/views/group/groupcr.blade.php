<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Group</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Create Group</h2>
        <form method="POST" action="{{ route('groups.store') }}">
            @csrf

            <!-- Tournament -->
            <div class="form-group">
                <label for="tournament">Tournament</label>
                <select class="form-control" id="tournament" name="tournament_id" required>
                    <option value="" disabled selected>Select a tournament</option>
                    @foreach($tournaments as $tournament)
                        <option value="{{ $tournament->id }}">{{ $tournament->tournament_name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Team -->
            <div class="form-group">
                <label for="team">Team</label>
                <select class="form-control" id="team" name="team_id" required>
                    <option value="" disabled selected>Select a team</option>
                    @foreach($teams as $team)
                        <option value="{{ $team->id }}">{{ $team->team_name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Match Status -->
            <div class="form-group">
                <label for="match_status">Match Status</label>
                <select class="form-control" id="match_status" name="match_status" required>
                    <option value="win">Win</option>
                    <option value="lose">Lose</option>
                    <option value="draw">Draw</option>
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Create Group</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
