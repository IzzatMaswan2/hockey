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
                        <h4 style="color:#7A5DCA;font-weight:bold;">CREATE NEW TOURNAMENT</h4>
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
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Create Event</button>
                            </div>
                        </form>
                    </div>
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
</body>
@include ('layouts.footer')
</html>
