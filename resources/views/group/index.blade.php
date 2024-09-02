<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/771de58f02.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.2.2/dist/echarts.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Hockey Tournament Standings</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            text-align: center;
        }

        table {
            width: 100%;
            max-width: 800px;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #280137;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .group-selection {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <h1>Hockey Tournament Standings</h1>

    <!-- Group Selection Dropdown -->
    <div class="group-selection">
        <label for="group-id">Select Group:</label>
        <select id="group-id" class="form-select" style="width: 200px; margin: 0 auto;">
            @foreach($groups as $group)
                <option value="{{ $group->group_id }}" {{ $group->group_id == $group->group_id ? 'selected' : '' }}>
                    Group {{ $group->group_id }}
                </option>
            @endforeach
        </select>
    </div>

    <h2>Group {{ $group->group_id }}</h2>
    <table id="standings-table">
        <thead>
            <tr>
                <th>Position</th>
                <th>Team</th>
                <th>Played</th>
                <th>Wins</th>
                <th>Draws</th>
                <th>Losses</th>
                <th>GF</th>
                <th>GA</th>
                <th>GD</th>
                <th>Points</th>
                <th>SO-bonus</th>
            </tr>
        </thead>

        <tbody>
        @foreach ($groups as $group)
                <tr>
                    <td>{{ $group->id }}</td>
                    <td>{{ $group->team_name }}</td>
                    <td>{{ $group->played }}</td>
                    <td>{{ $group->wins }}</td>
                    <td>{{ $group->draws }}</td>
                    <td>{{ $group->losses }}</td>
                    <td>{{ $group->gf }}</td>
                    <td>{{ $group->ga }}</td>
                    <td>{{ $group->gd }}</td>
                    <td>{{ $group->points }}</td>
                    <td>{{ $group->so_bonus }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        // Handle group selection change
        document.getElementById('group-id').addEventListener('change', function() {
            var selectedGroupId = this.value;
            window.location.href = '/standings/' + selectedGroupId; // Redirect to the selected group's standings page
        });
    </script>

</body>
</html>
