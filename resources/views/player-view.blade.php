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
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @include('layouts.navbar')
    <div class="container-fluid" style="height: 90%; padding: 0;">
        <div class="row">
            <div class="col-3" style="background-color: #D3D3D3;">
                @include('layouts.sidebar-manager')
            </div>
            <div class="col-9 mt-5">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="text-center"style="color:#5D3CB8;font-weight:bold;">Add Players</h1>
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <a href="{{ url('player') }}" class="btn btn-primary" style="background-color:#5D3CB8;font-weight:bold;color:white;border: #5D3CB8 1px solid; ">Add Player</a>
                    <a href="{{ route('players.export') }}" class="btn btn-success" style="background-color:#5D3CB8;font-weight:bold;color:white;border:#5D3CB8 1px solid;">Export CSV</a>
                </div>
                <table class="table table-striped mt-3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Contact Number</th>
                            <th>Jersey Number</th>
                            <th>Position</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($players as $player)
                            <tr>
                                <td>{{ $player->id }}</td>
                                <td>{{ $player->fullName }}</td>
                                <td>{{ $player->contact }}</td>
                                <td>{{ $player->jerseyNumber }}</td>
                                <td>{{ $player->position }}</td>
                                <td>
                                    <a href="{{ route('player.edit', $player->id) }}" class="btn btn-warning btn-sm" style="border:#00CF00 1px solid;background-color:#00CF00;color:white;font-weight:bold">Edit</a>
                                    <form action="{{ route('player.destroy', $player->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm " style="border:red 1px solid;background-color:red;color:white;font-weight:bold" onclick="return confirm('Are you sure you want to delete this player?');">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
@include('layouts.footer')
</html>

