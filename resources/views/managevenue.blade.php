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
    <title>Manage Venue</title>
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
            padding: 5px 0;
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
<body style="background-color: #f4f7f6;">

    <!-- Navbar -->
    @include('layouts.navbar')

    <!-- Main Content -->
    <div class="container-fluid" style="width: 100%; height: 90%;">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-2" style="background-color: #929292; width: 20%;">
                @include('layouts.sidebar')
            </div>

            <!-- Center Content -->
            <div class="col-8" style="width: 60%;">
                <div class="container-fluid">
                    <br>
                        <h2 style="color:#7A5DCA;font-weight:bold;">ADD NEW VENUE</h2>
                        <br>
                        <form method="POST" action="{{ route('managevenue.store') }}">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-4 input-field">
                                    <label for="name" class="form-label" style="color:#929292;font-weight:bold;">Venue Name:</label>
                                    <input type="text" id="name" class="form-control" name="name" placeholder="Venue Name" value="{{ old('name') }}">
                                </div>
                                <div class="col-md-4 input-field">
                                    <label for="location" class="form-label" style="color:#929292;font-weight:bold;">Venue Location:</label>
                                    <input type="text" id="location" class="form-control" name="location" placeholder="No. 123, etc..."value="{{ old('location') }}">
                                </div>
                                <div class="col-md-4 input-field">
                                    <label for="no_court" class="form-label" style="color:#929292;font-weight:bold;">Number of Courts:</label>
                                    <input type="number" id="no_court" class="form-control" name="no_court" placeholder="Number of Courts available"value="{{ old('no_court') }}">
                                </div>
                                <br><br>
                            <div class="d-flex justify-content-center align-items-center">
                                <button type="submit" class="btn btn-primary" style="font-size:22px;background-color:#62096e;color:white;font-weight:bold;border:1px solid #62096e">
                                    Add Venue
                                </button>
                            </div>
                        </form>
                    </div>


                    <br><hr style="margin: 0 120px;"><br>


                   <!-- VENUES LIST TABS -->
                    <div class="section">
                        <h2 style="color:#7A5DCA;font-weight:bold;">VENUES LIST</h2>

                        <!-- Tabs for Unarchived and Archived Venues -->
                        <ul class="nav nav-tabs" id="venueTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="unarchived-venue-tab" data-bs-toggle="tab" data-bs-target="#unarchived-venue" type="button" role="tab" aria-controls="unarchived-venue" aria-selected="true">Unarchived Venues</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="archived-venue-tab" data-bs-toggle="tab" data-bs-target="#archived-venue" type="button" role="tab" aria-controls="archived-venue" aria-selected="false">Archived Venues</button>
                            </li>
                        </ul>

                        <div class="tab-content" id="venueTabsContent">
                            <!-- Unarchived Venues Table -->
                            <div class="tab-pane fade show active" id="unarchived-venue" role="tabpanel" aria-labelledby="unarchived-venue-tab">
                                <div class="table-container">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Venue Name</th>
                                                <th>Venue Location</th>
                                                <th>Number of Courts</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($venues as $venue)
                                                @if ($venue->archived === 1) <!-- Unarchived venues -->
                                                    <tr>
                                                        <td>{{ $venue->name }}</td>
                                                        <td>{{ $venue->location }}</td>
                                                        <td>{{ $venue->no_court }}</td>
                                                        <td>
                                                            <div class="d-flex gap-2">
                                                                <!-- Edit Button -->
                                                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $venue->id }}">Edit</button>

                                                                <!-- Archive Button -->
                                                                <form method="POST" action="{{ route('managevenue.archive', $venue->id) }}">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <button type="submit" class="btn btn-danger btn-sm">Archive</button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Archived Venues Table -->
                            <div class="tab-pane fade" id="archived-venue" role="tabpanel" aria-labelledby="archived-venue-tab">
                                <div class="table-container">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Venue Name</th>
                                                <th>Venue Location</th>
                                                <th>Number of Courts</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($venues as $venue)
                                                @if ($venue->archived === 0) <!-- Archived venues -->
                                                    <tr>
                                                        <td>{{ $venue->name }}</td>
                                                        <td>{{ $venue->location }}</td>
                                                        <td>{{ $venue->no_court }}</td>
                                                        <td>
                                                            <div class="d-flex gap-2">
                                                                <!-- Unarchive Button -->
                                                                <form method="POST" action="{{ route('managevenue.unarchive', $venue->id) }}">
                                                                    @csrf
                                                                    
                                                                    <button type="submit" class="btn btn-success btn-sm">Unarchive</button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Modal HTML structure -->
@foreach ($venues as $venue)
    <div class="modal fade" id="editModal{{ $venue->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $venue->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel{{ $venue->id }}">Edit Venue</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('managevenue.update', $venue->id) }}">
                        @csrf
                       <!-- Use PUT for updates -->
                        <div class="mb-3">
                            <label for="name{{ $venue->id }}" class="form-label">Event Name</label>
                            <input type="text" class="form-control" id="name{{ $venue->id }}" name="name" value="{{ $venue->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="location{{ $venue->id }}" class="form-label">Address</label>
                            <input type="text" class="form-control" id="location{{ $venue->id }}" name="location" value="{{ $venue->location }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="no_court{{ $venue->id }}" class="form-label">Number of Courts</label>
                            <input type="number" class="form-control" id="no_court{{ $venue->id }}" name="no_court" value="{{ $venue->no_court }}" required>
                        </div>
                                              <button type="submit" class="btn btn-primary">Update Venue</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach


                   
                </div>
            </div>
        </div>
    </div>


    <!-- Script to handle category selection -->
    <script>
        function selectCategory(button) {
            var buttons = document.querySelectorAll('.category-buttons .btn');
            buttons.forEach(function(btn) {
                btn.classList.remove('selected');
            });
            button.classList.add('selected');
            document.getElementById('category').value = button.innerText;
        }
    </script>
</body>
@include('layouts.footer')
</html>



