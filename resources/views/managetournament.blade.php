<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/771de58f02.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.2.2/dist/echarts.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Manage Tournament</title>
    <!-- Include Navbar -->
    <style>
        body {
            background-color: #f5f5f5;
        }
        .section {
            margin-bottom: 2rem;
        }
        .input-field {
            margin-bottom: 1rem;
        }
        .btn-group {
            margin-right: 2rem;
        }
        .form-control:focus {
            font-weight: bold;
        }
        .form-control {
            background-color: #929292;
            color: black;
            font-weight: bold;
        }
        .form-control::placeholder {
            color: black;
            font-weight: normal;
        }
        .category-row {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .category-buttons {
            display: flex;
            gap: 0.5rem;
        }
        .category-buttons .btn {
            width: 200px;
            padding: 5px 0px 5px 0px;
            background-color: #39e75f;
            color: black;
            border: 1px solid #39e75f;
        }

        .category-buttons .btn:hover {
            background-color: green;
            color: white;
            font-weight: bold;
            transition: background-color 0.2s;
            border: 1px solid green;
        }

        .btn-primary {
            background-color: #7A5DCA;
            font-weight: bold;
            font-size: 25px;
            color: black;
        }

        .btn-primary:hover {
            background-color: #5f288a;
            color: white;
        }

        .btn.selected {
            background-color: green;
            color: white;
            border: 1px solid green;
            font-weight: bold;
        }

        .table-container {
            margin-top: 2rem;
            border: black 1px solid;
        }
        .table th, .table td {
            text-align: center;
        }
        .btn-action {
            margin: 0 0.2rem;
        }

        .status-active {
            color: green;
            font-weight: bold;
        }
        .status-inactive {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
<body style="background-color: #f4f7f6;">
    <!-- Navbar -->
    @include('layouts.navbar')

    <!-- Main Layout -->
    <div class="container-fluid" style="width: 100%; height: 100%;">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-2" style="background-color: #929292; height: 100vh;">
                @include('layouts.sidebar')
            </div>
            
            <!-- Main Content -->
            <div class="col-10">
                <div class="container my-5">
                    <div class="section">
                        <h2 style="color:#7A5DCA;font-weight:bold;">CREATE NEW TOURNAMENT</h2>
                        <form method="POST" action="{{ route('managetournament.store') }}">
                            @csrf
                            <div class="row g-3">
                                <!-- Event Creation Form -->
                                <div class="col-md-4 input-field">
                                    <label for="name" class="form-label" style="color:#929292;font-weight:bold;">Event Name:</label>
                                    <input type="text" id="name" class="form-control" name="name" placeholder="Tournament Name" value="{{ old('name') }}">
                                </div>
                                <div class="col-md-4 input-field">
                                    <label for="start_date" class="form-label" style="color:#929292;font-weight:bold;">Start Date:</label>
                                    <input type="date" id="start_date" class="form-control" name="start_date" placeholder="Start Date" value="{{ old('start_date') }}">
                                </div>
                                <div class="col-md-4 input-field">
                                    <label for="end_date" class="form-label" style="color:#929292;font-weight:bold;">End Date:</label>
                                    <input type="date" id="end_date" class="form-control" name="end_date" placeholder="End Date" value="{{ old('end_date') }}">
                                </div>
                                <div class="col-md-4 input-field">
                                    <label for="no_team" class="form-label" style="color:#929292;font-weight:bold;">Participating Teams:</label>
                                    <input type="number" id="no_team" class="form-control" name="no_team" placeholder="Number of Teams" value="{{ old('no_team') }}">
                                </div>
                                <div class="col-md-4 input-field">
                                    <label for="start_time" class="form-label" style="color:#929292;font-weight:bold;">Start Time:</label>
                                    <input type="time" id="start_time" class="form-control" name="start_time" placeholder="Start Time" value="{{ old('start_time') }}">
                                </div>
                                <div class="col-md-4 input-field">
                                    <label for="end_time" class="form-label" style="color:#929292;font-weight:bold;">End Time:</label>
                                    <input type="time" id="end_time" class="form-control" name="end_time" placeholder="End Time" value="{{ old('end_time') }}">
                                </div>
                                <div class="col-md-4 input-field">
                                    <label for="no_group" class="form-label" style="color:#929292;font-weight:bold;">Group Number:</label>
                                    <input type="text" id="no_group" class="form-control" name="no_group" placeholder="Number of Groups" value="{{ old('no_group') }}">
                                </div>
                                <div class="col-md-4 input-field">
                                    <label for="venue_id" class="form-label" style="color:#929292;font-weight:bold;">Venue ID:</label>
                                    <input type="text" id="venue_id" class="form-control" name="venue_id" placeholder="Tournament Venue" value="{{ old('venue_id') }}">
                                </div>

                                <div class="col-md-5 input-field">
                                    <div class="category-row">
                                        <label class="form-label mb-0" style="color:#929292;font-weight:bold;">Category:</label>
                                        <div class="category-buttons">
                                            <button type="button" class="btn btn-outline-primary" onclick="selectCategory(this)">Single Elimination</button>
                                            <button type="button" class="btn btn-outline-primary" onclick="selectCategory(this)">Double Elimination</button>
                                            <button type="button" class="btn btn-outline-primary" onclick="selectCategory(this)">Round Robin</button>
                                            <button type="button" class="btn btn-outline-primary" onclick="selectCategory(this)">Group Stage + Knockout</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Hidden category input field -->
                                <input type="hidden" id="category" name="category">
                            </div><br><br>

                            <div class="d-flex justify-content-center align-items-center">
    <button type="submit" class="btn btn-primary" style="font-size:22px;background-color:#62096e;color:white;font-weight:bold;border:1px solid #62096e">
        Create Tournament
    </button>
</div>

                        </form>
                        <br><hr style="margin: 0 120px;">
<br>
<br>
<div class="section">
                        <h2 style="color:#7A5DCA;font-weight:bold;">TOURNAMENTS LIST</h2>
                        <div class="table-container">
                            <table class="table table-striped">
                                <thead style="border:1px black solid">
                                    <tr style="border:1px black solid">
                                        <th>Name</th>
                                        <th>Teams</th>
                                        <th>Groups</th>
                                        <th>Category</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Venue</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tournaments as $tournament)
                                        <tr>
                                            <td>{{ $tournament->name }}</td>
                                            <td>{{ $tournament->no_team }}</td>
                                            <td>{{ $tournament->no_group }}</td>
                                            <td>{{ $tournament->category }}</td>
                                            <td>{{ $tournament->start_date }}</td>
                                            <td>{{ $tournament->end_date }}</td>
                                            <td>{{ $tournament->venue_id }}</td>
                                            <td>
                                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $tournament->id }}">Edit</button>
                                                <form action="{{ route('managetournament.destroy', $tournament->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </td>
                                        </tr>

                                        <!-- Edit Modal -->
                                        <!-- Edit Modal -->
<div class="modal fade" id="editModal{{ $tournament->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $tournament->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $tournament->id }}">Edit Tournament</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('managetournament.update', $tournament->id) }}">
                    @csrf
                    @method('POST')
                    <div class="mb-3">
                        <label for="name" class="form-label">Event Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $tournament->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="no_team" class="form-label">Participating Teams</label>
                        <input type="number" class="form-control" id="no_team" name="no_team" value="{{ $tournament->no_team }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="no_group" class="form-label">Group Number</label>
                        <input type="number" class="form-control" id="no_group" name="no_group" value="{{ $tournament->no_group }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <input type="text" class="form-control" id="category" name="category" value="{{ $tournament->category }}" required>
                        
                    </div>
                    <div class="mb-3">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $tournament->start_date }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="end_date" class="form-label">End Date</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $tournament->end_date }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="start_time" class="form-label">Start Time</label>
                        <input type="time" class="form-control" id="start_time" name="start_time" value="{{ $tournament->start_time }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="end_time" class="form-label">End Time</label>
                        <input type="time" class="form-control" id="end_time" name="end_time" value="{{ $tournament->end_time }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="venue_id" class="form-label">Venue ID</label>
                        <input type="text" class="form-control" id="venue_id" name="venue_id" value="{{ $tournament->venue_id }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Tournament</button>
                </form>
            </div>
        </div>
    </div>
</div>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    </div>

                     <!-- Tournaments Table Section -->
                     
                </div>
            </div>
        </div>
    </div>

    <script>
        // Category selection function
        function selectCategory(button) {
            const buttons = document.querySelectorAll('.category-buttons .btn');
            buttons.forEach(btn => btn.classList.remove('selected'));
            button.classList.add('selected');
            // Set the hidden input field value
            document.getElementById('category').value = button.innerText;
        }
    </script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
@include ('layouts.footer')
</html>
