<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

        input[type="text"], input[type="number"] {
            width: 100%;
            box-sizing: border-box;
            padding: 5px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Hockey Tournament Standings</h1>
    <h2>Group A</h2>
    <form action="/update-standings" method="POST">
        @csrf
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
                        <td>
                            <input type="text" name="teams[{{ $group->id }}][team_name]" value="{{ $group->team->team_name }}">
                        </td>
                        <td><input type="number" name="teams[{{ $group->id }}][played]" value="{{ $group->played }}"></td>
                        <td><input type="number" name="teams[{{ $group->id }}][wins]" value="{{ $group->wins }}"></td>
                        <td><input type="number" name="teams[{{ $group->id }}][draws]" value="{{ $group->draws }}"></td>
                        <td><input type="number" name="teams[{{ $group->id }}][losses]" value="{{ $group->losses }}"></td>
                        <td><input type="number" name="teams[{{ $group->id }}][gf]" value="{{ $group->gf }}"></td>
                        <td><input type="number" name="teams[{{ $group->id }}][ga]" value="{{ $group->ga }}"></td>
                        <td><input type="number" name="teams[{{ $group->id }}][gd]" value="{{ $group->gd }}"></td>
                        <td><input type="number" name="teams[{{ $group->id }}][points]" value="{{ $group->points }}"></td>
                        <td><input type="number" name="teams[{{ $group->id }}][so_bonus]" value="{{ $group->so_bonus }}"></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit">Save Changes</button>
    </form>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

</body>
</html>
