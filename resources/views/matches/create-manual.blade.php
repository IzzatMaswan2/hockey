@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert-message">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert-message">
        {{ session('error') }}
    </div>
@endif


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manually Create Match</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <style>
        h4 { color: #5D3CB8; }
    </style>
</head>

<body>

<nav class="navbar navbar-dark bg-dark px-3 mb-4">
    <span class="navbar-brand">Manual Match Creator</span>
</nav>

<div class="container mt-4">
    <h4 class="mb-3"><strong>MANUALLY CREATE MATCH</strong></h4>

    <form action="{{ route('matches.manual.store') }}" method="POST">
        @csrf

        <div class="row">

            <!-- Tournament -->
            <div class="col-md-4">
                <label>Tournament</label>
                <select id="tournament" name="tournament_id" class="form-control" required>
                    <option value="">Select Tournament</option>
                    @foreach($tournaments as $t)
                        <option value="{{ $t->id }}">{{ $t->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Category -->
            <div class="col-md-4">
                <label>Category</label>
                <select id="category" name="category_id" class="form-control" required>
                    <option value="">Select Category</option>
                </select>
            </div>

            <!-- Group -->
            <div class="col-md-4">
                <label>Group</label>
                <select id="group" name="group_id" class="form-control" required>
                    <option value="">Select Group</option>
                </select>
            </div>

            <!-- Team A -->
            <div class="col-md-6 mt-3">
                <label>Team A</label>
                <select id="team1" name="team1_id" class="form-control" required>
                    <option value="">Select Team</option>
                </select>
            </div>

            <!-- Team B -->
            <div class="col-md-6 mt-3">
                <label>Team B</label>
                <select id="team2" name="team2_id" class="form-control" required>
                    <option value="">Select Team</option>
                </select>
            </div>

            <!-- Date -->
            {{-- <div class="col-md-4 mt-3">
                <label>Date</label>
                <input type="date" name="date" class="form-control" required>
            </div> --}}

            <!-- Start Time -->
            <div class="col-md-4 mt-3">
                <label>Start Time</label>
                <input type="time" name="start_time" class="form-control" required>
            </div>

            <!-- End Time -->
            <div class="col-md-4 mt-3">
                <label>End Time</label>
                <input type="time" name="end_time" class="form-control" required>
            </div>

            <!-- Venue -->
            {{-- <div class="col-md-4 mt-3">
                <label>Venue</label>
                <select name="venue_id" class="form-control" required>
                    @foreach($venues as $v)
                        <option value="{{ $v->id }}">{{ $v->name }}</option>
                    @endforeach
                </select>
            </div> --}}
        </div>

        <div class="d-flex justify-content-end mt-4 mb-5">
            <button class="btn btn-primary">SAVE MATCH</button>
        </div>

    </form>
    <br>
    <h4 class="mt-5 mb-3"><strong>ALL CREATED MATCHES</strong></h4>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tournament</th>
                <th>Category</th>
                <th>Group</th>
                <th>Team A</th>
                <th>Team B</th>
                <th>Date</th>
                <th>Start</th>
                <th>End</th>
                <th>Venue</th>
            </tr>
        </thead>
        <tbody>
            @foreach($matchGroups as $match)
            <tr>
                <td>{{ $match->tournament->name ?? '-' }}</td>
                <td>{{ $match->category->name ?? '-' }}</td>
                <td>{{ $match->groupcreate->Name ?? '-' }}</td>
                <td>{{ $match->teamA->name ?? '-' }}</td>
                <td>{{ $match->teamB->name ?? '-' }}</td>
                <td>{{ $match->Date }}</td>
                <td>{{ $match->start_time }}</td>
                <td>{{ $match->end_time }}</td>
                <td>{{ $match->Venue }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
//
// 1. Load categories when tournament changes
//
$('#tournament').change(function () {
    let id = $(this).val();

    $('#category').html('<option value="">Loading...</option>');
    $('#group').html('<option value="">Select Group</option>');
    $('#team1').html('<option value="">Select Team</option>');
    $('#team2').html('<option value="">Select Team</option>');

    $.get('/ajax/categories/' + id, function (data) {
        $('#category').html('<option value="">Select Category</option>');
        data.forEach(c => {
            $('#category').append(`<option value="${c.id}">${c.name}</option>`);
        });
    });
});

//
// 2. Load groups when category changes
//
$('#category').change(function () {
    let id = $(this).val();

    $('#group').html('<option value="">Loading...</option>');
    $('#team1').html('<option value="">Select Team</option>');
    $('#team2').html('<option value="">Select Team</option>');

    $.get('/ajax/groups/' + id, function (data) {
        $('#group').html('<option value="">Select Group</option>');
        data.forEach(g => {
            $('#group').append(`<option value="${g.GroupID}">${g.Name}</option>`);
        });
    });
});

//
// 3. Load teams when group changes
//
$('#group').change(function () {
    let id = $(this).val();

    $('#team1').html('<option value="">Loading...</option>');
    $('#team2').html('<option value="">Loading...</option>');

    $.get('/ajax/teams/' + id, function (data) {
        $('#team1').html('<option value="">Select Team</option>');
        $('#team2').html('<option value="">Select Team</option>');

        data.forEach(t => {
            $('#team1').append(`<option value="${t.teamID}">${t.name}</option>`);
            $('#team2').append(`<option value="${t.teamID}">${t.name}</option>`);
        });
    });
});

</script>
<script>
    $(document).ready(function() {
        // Auto-hide alert after 3 seconds
        setTimeout(function() {
            $('#alert-message').fadeOut('slow');
        }, 3000); // 3000 milliseconds = 3 seconds
    });
</script>

</body>
</html>
