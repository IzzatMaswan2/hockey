<!-- resources/views/fixtures/index.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fixtures List</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Fixtures List</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Match</th> <!-- Column for both teams -->
                    <th>Group</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Score</th>
                    <th>Agreed</th>
                    <th>Match Type</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($fixtures as $fixture)
                    <tr>
                        <td>{{ $fixture->id }}</td>
                        <td>
                            {{ $fixture->team1 ? $fixture->team1->team_name : 'N/A' }} 
                            vs 
                            {{ $fixture->team2 ? $fixture->team2->team_name : 'N/A' }}
                        </td>
                        <td>{{ $fixture->group ? $fixture->group->name : 'N/A' }}</td>
                        <td>{{ $fixture->date }}</td>
                        <td>{{ $fixture->time }}</td>
                        <td>{{ $fixture->score }}</td>
                        <td>{{ ucfirst($fixture->agreed) }}</td>
                        <td>{{ ucfirst($fixture->match) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
