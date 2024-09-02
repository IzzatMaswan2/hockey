<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fixture Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Create New Fixture</h2>
        <form method="POST" action="{{ route('fixture') }}">
            @csrf

            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <!-- Teams Competing -->
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="team1Id">Team 1 ID</label>
                    <input type="text" class="form-control" id="team1Id" name="team_id_1" placeholder="Enter Team 1 ID" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="team2Id">Team 2 ID</label>
                    <input type="text" class="form-control" id="team2Id" name="team_id_2" placeholder="Enter Team 2 ID" required>
                </div>
            </div>

            <!-- Group ID -->
            <div class="form-group">
                <label for="groupId">Group ID</label>
                <input type="text" class="form-control" id="groupId" name="group_id" placeholder="Enter Group ID" required>
            </div>

            <!-- Date and Time -->
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="date">Date</label>
                    <input type="date" class="form-control" id="date" name="date" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="time">Time</label>
                    <input type="time" class="form-control" id="time" name="time" required>
                </div>
            </div>

            <!-- Score -->
            <div class="form-group">
                <label for="score">Score</label>
                <input type="text" class="form-control" id="score" name="score" placeholder="Enter score" required>
            </div>

            <!-- Agreed (Yes/No) -->
            <div class="form-group">
                <label>Agreed</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="agreedYes" name="agreed" value="yes" required>
                    <label class="form-check-label" for="agreedYes">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="agreedNo" name="agreed" value="no" required>
                    <label class="form-check-label" for="agreedNo">No</label>
                </div>
            </div>

            <!-- Match Type -->
            <div class="form-group">
                <label for="match">Match Type</label>
                <select class="form-control" id="match" name="match" required>
                    <option value="" disabled selected>Select match type</option>
                    <option value="league">League</option>
                    <option value="friendly">Friendly</option>
                    <option value="tournament">Tournament</option>
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">{{ __('Create Fixture') }}</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
