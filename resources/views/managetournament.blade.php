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
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Manage Tournament</title>
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
        .period-column {
    width: 200px; /* Adjust this value as necessary */
    white-space: nowrap;
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
                <div class="container-fluid"><br>
                        <h2 style="color:#7A5DCA;font-weight:bold;">ADD NEW TOURNAMENT</h2>
                        <br>
                        <form method="POST" action="{{ route('managetournament.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="row g-3">
        <div class="col-md-4 input-field">
            <label for="name" class="form-label" style="color:#929292;font-weight:bold;">Tournament Name:</label>
            <input type="text" id="name" class="form-control" name="name" placeholder="Tournament Name" value="{{ old('name') }}">
        </div>
        <div class="col-md-4 input-field">
            <label for="start_date" class="form-label" style="color:#929292;font-weight:bold;">Start Date:</label>
            <input type="date" id="start_date" class="form-control" name="start_date" value="{{ old('start_date') }}">
        </div>
        <div class="col-md-4 input-field">
            <label for="start_time" class="form-label" style="color:#929292;font-weight:bold;">Start Time:</label>
            <input type="time" id="start_time" class="form-control" name="start_time" value="{{ old('start_time') }}">
        </div>
        <div class="col-md-4 input-field">
            <label for="venue_id" class="form-label" style="color:#929292;font-weight:bold;">Venue:</label>
            <select id="venue_id" class="form-select" name="venue_id">
                <option value="" disabled selected>Select a venue</option>
                @foreach ($venues as $venue)
                    <option value="{{ $venue->id }}">{{ $venue->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 input-field">
            <label for="end_date" class="form-label" style="color:#929292;font-weight:bold;">End Date:</label>
            <input type="date" id="end_date" class="form-control" name="end_date" value="{{ old('end_date') }}">
        </div>
        <div class="col-md-4 input-field">
            <label for="end_time" class="form-label" style="color:#929292;font-weight:bold;">End Time:</label>
            <input type="time" id="end_time" class="form-control" name="end_time" value="{{ old('end_time') }}">
        </div>
        <div class="col-md-4 input-field">
            <label for="regclose_date" class="form-label" style="color:#929292;font-weight:bold;">Registration Closed Date:</label>
            <input type="date" id="regclose_date" class="form-control" name="regclose_date" value="{{ old('regclose_date') }}">
        </div>
        <div class="col-md-4 input-field">
            <label for="no_team" class="form-label" style="color:#929292;font-weight:bold;">Participating Teams:</label>
            <input type="number" id="no_team" class="form-control" name="no_team" placeholder="Number of Teams" value="{{ old('no_team') }}">
        </div>
        <div class="col-md-4 input-field">
            <label for="no_group" class="form-label" style="color:#929292;font-weight:bold;">Group Number:</label>
            <input type="number" id="no_group" class="form-control" name="no_group" placeholder="Number of Groups" value="{{ old('no_group') }}">
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                    <path d="m9 13 3-4 3 4.5V12h4V5c0-1.103-.897-2-2-2H4c-1.103 0-2 .897-2 2v12c0 1.103.897 2 2 2h8v-4H5l3-4 1 2z"></path>
                    <path d="M19 14h-2v3h-3v2h3v3h2v-3h3v-2h-3z"></path>
                </svg>
            </label>Image:
            <input type="file" class="form-control" id="image" name="image">
        </div>

        <div class="col-md-9 input-field">
            <label for="description" class="form-label" style="color:#929292;font-weight:bold;">Description</label>
            <textarea id="description" class="form-control" name="description" rows="5" placeholder="Short Description of the Tournament">{{ old('description') }}</textarea>
        </div>

        <div class="row mb-4"></div>
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
        <input type="hidden" id="category" name="category" value="{{ old('category') }}">
    </div>
    <div class="d-flex justify-content-center align-items-center">
        <button type="submit" class="btn btn-primary" style="font-size:22px;background-color:#62096e;color:white;font-weight:bold;border:1px solid #62096e">
            Create Tournament
        </button>
    </div>
</form>

                    </div>

                    <br><hr style="margin: 0 120px;"><br>

                    <!-- TOURNAMENTS LIST TABS -->
                    <div class="section">
                        <h2 style="color:#7A5DCA;font-weight:bold;">TOURNAMENTS LIST</h2>

                        <!-- Tabs for Unarchived and Archived Tournaments -->
                        <ul class="nav nav-tabs" id="tournamentTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="unarchived-tournament-tab" data-bs-toggle="tab" data-bs-target="#unarchived-tournament" type="button" role="tab" aria-controls="unarchived-tournament" aria-selected="true">Unarchived Tournaments</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="archived-tournament-tab" data-bs-toggle="tab" data-bs-target="#archived-tournament" type="button" role="tab" aria-controls="archived-tournament" aria-selected="false">Archived Tournaments</button>
                            </li>
                        </ul>

                        <div class="tab-content" id="tournamentTabsContent">
                            <!-- Unarchived Tournaments Table -->
                            <div class="tab-pane fade show active" id="unarchived-tournament" role="tabpanel" aria-labelledby="unarchived-tournament-tab">
                                <div class="table-container">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Venue</th>
                                                <th class="period-column">Period</th>
                                                <th>Category</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tournaments as $tournament)
                                                @if ($tournament->archived === 1) <!-- Unarchived tournaments -->
                                                    <tr>
                                                        <td>{{ $tournament->name }}</td>
                                                        <td>{{ $tournament->venue->name }}</td>
                                                        <td class="period-column">
                                                            {{ $tournament->start_date }}
                                                            <i class='bx bxs-right-arrow-alt arrow-icon'></i>
                                                            {{ $tournament->end_date }}
                                                        </td>
                                                        <td>{{ $tournament->category }}</td>
                                                        <td>
                                                            <div class="d-flex gap-2">
                                                                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewModal{{ $tournament->id }}">View</button>
                                                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $tournament->id }}">Edit</button>
                                                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#categoryModal{{ $tournament->id }}">
                                                                    Manage Categories
                                                                </button>
                                                                <form method="POST" action="{{ route('managetournament.archive', $tournament->id) }}" style="display:inline;">
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

                            <!-- Archived Tournaments Table -->
                            <div class="tab-pane fade" id="archived-tournament" role="tabpanel" aria-labelledby="archived-tournament-tab">
                                <div class="table-container">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Venue</th>
                                                <th class="period-column">Period</th>
                                                <th>Category</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tournaments as $tournament)
                                                @if ($tournament->archived === 0) <!-- Archived tournaments -->
                                                    <tr>
                                                        <td>{{ $tournament->name }}</td>
                                                        <td>{{ $tournament->venue->name }}</td>
                                                        <td class="period-column">
                                                            {{ $tournament->start_date }}
                                                            <i class='bx bxs-right-arrow-alt arrow-icon'></i>
                                                            {{ $tournament->end_date }}
                                                        </td>
                                                        <td>{{ $tournament->category }}</td>
                                                        <td>
                                                            <div class="d-flex gap-2">
                                                                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewModal{{ $tournament->id }}">View</button>
                                                                <form method="POST" action="{{ route('managetournament.unarchive', $tournament->id) }}" style="display:inline;">
                                                                    @csrf
                                                                    @method('PUT')
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

                    @foreach ($tournaments as $tournament)
                        <!-- View Modal for Tournament -->
                        <div class="modal fade" id="viewModal{{ $tournament->id }}" tabindex="-1" aria-labelledby="viewModalLabel{{ $tournament->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewModalLabel{{ $tournament->id }}">Tournament Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h4>{{ $tournament->name }}</h4>
                                        <p><strong>Category:</strong> {{ $tournament->category }}</p>
                                        <p><strong>Participating Teams:</strong> {{ $tournament->no_team }}</p>
                                        <p><strong>Groups:</strong> {{ $tournament->no_group }}</p>
                                        <p><strong>Start Date:</strong> {{ $tournament->start_date }}</p>
                                        <p><strong>End Date:</strong> {{ $tournament->end_date }}</p>
                                        <p><strong>Venue:</strong> {{ $tournament->venue->name }}</p>
                                        <p><strong>Description:</strong> {{ $tournament->description }}</p>
                                        <img src="{{ asset('storage/' . $tournament->image) }}" class="img-fluid mb-3" alt="{{ $tournament->name}} Image">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!--EDIT MODAL-->
                    @foreach ($tournaments as $tournament)
                        <div class="modal fade" id="editModal{{ $tournament->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $tournament->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{ $tournament->id }}">Edit Tournament</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('managetournament.update', $tournament->id) }}" enctype="multipart/form-data">
                                            @csrf
                                        <!-- Use PUT for updates -->
                                            <div class="mb-3">
                                                <label for="name{{ $tournament->id }}" class="form-label">Tournament Name: </label>
                                                <input type="text" class="form-control" id="name{{ $tournament->id }}" name="name" value="{{ $tournament->name }}" required style="border-radius:20px">
                                            </div>
                                            <div class="mb-3">
                                                <label for="start_date{{ $tournament->id }}" class="form-label">Start Date:</label>
                                                <input type="date" class="form-control" id="start_date{{ $tournament->id }}" name="start_date" value="{{ $tournament->start_date }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="start_time{{ $tournament->id }}" class="form-label">Start Time:</label>
                                                <input type="time" class="form-control" id="start_time{{ $tournament->id }}" name="start_time" value="{{ $tournament->start_time }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="end_date{{ $tournament->id }}" class="form-label">End Date:</label>
                                                <input type="date" class="form-control" id="end_date{{ $tournament->id }}" name="end_date" value="{{ $tournament->end_date }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="end_time{{ $tournament->id }}" class="form-label">End Time:</label>
                                                <input type="time" class="form-control" id="end_time{{ $tournament->id }}" name="end_time" value="{{ $tournament->end_time }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="venue_id" class="form-label">Venue</label>
                                                <select class="form-control" id="venue_id" name="venue_id" required>
                                                    <option value="" disabled>Select a venue</option>
                                                        @foreach ($venues as $venue)
                                                            <option value="{{ $venue->id }}" {{ $venue->id == $tournament->venue_id ? 'selected' : '' }}>
                                                            {{ $venue->name }}
                                                        </option>
                                                        @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="no_team{{ $tournament->id }}" class="form-label">Participating Teams:</label>
                                                <input type="number" class="form-control" id="no_team{{ $tournament->id }}" name="no_team" value="{{ $tournament->no_team }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="no_group{{ $tournament->id }}" class="form-label">Group Numbers:</label>
                                                <input type="number" class="form-control" id="no_group{{ $tournament->id }}" name="no_group" value="{{ $tournament->no_group }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="category{{ $tournament->id }}" class="form-label">Category:</label>
                                                <select class="form-select" id="category{{ $tournament->id }}" name="category"value="{{ $tournament->category }}" required>
                                                    <option value="" disabled>Select category</option>
                                                    <option value="Single Elimination" {{ $tournament->category == 'Single Elimination' ? 'selected' : '' }}>Single Elimination</option>
                                                    <option value="Double Elimination" {{ $tournament->category == 'Double Elimination' ? 'selected' : '' }}>Double Elimination</option>
                                                    <option value="Round Robin" {{ $tournament->category == 'Round Robin' ? 'selected' : '' }}>Round Robin</option>
                                                    <option value="Group Stage + Knockout" {{ $tournament->category == 'Group Stage + Knockout' ? 'selected' : '' }}>Group Stage + Knockout</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="image{{ $tournament->id }}" class="form-label">Upload Image:</label>
                                                <input type="file" class="form-control" id="image{{ $tournament->id }}" name="image" accept="image/*" value="{{ $tournament->image }}"required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="description{{ $tournament->id }}" class="form-label">Description:</label>
                                                <textarea class="form-control" id="description{{ $tournament->id }}" name="description" rows="3" value="{{ $tournament->description }}"required>{{ $tournament->description }}</textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Update Tournament</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    @foreach($tournaments as $tournament)
                    <div class="modal fade" id="categoryModal{{ $tournament->id }}" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title">Manage Categories — {{ $tournament->name }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">

                                    <!-- CATEGORY LIST -->
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Category Name</th>
                                                <th>Description</th>
                                                <th>Max Teams</th>
                                                <th>Groups</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach($tournament->categories as $category)
                                            <tr>

                                                <!-- UPDATE FORM (ONE PER ROW - NOT NESTED) -->
                                                <form action="{{ route('categories.update', $category->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')

                                                    <td>
                                                        <input type="text" class="form-control" 
                                                            name="name" value="{{ $category->name }}" required>
                                                    </td>

                                                    <td>
                                                        <textarea class="form-control" 
                                                                name="description">{{ $category->description }}</textarea>
                                                    </td>

                                                    <td>
                                                        <input type="number" class="form-control" 
                                                            name="max_teams" value="{{ $category->max_teams }}">
                                                    </td>

                                                    <td>
                                                        <input type="number" class="form-control" 
                                                            name="number_group" value="{{ $category->number_group }}">
                                                    </td>

                                                    <td style="width:160px;">
                                                        <button type="submit" class="btn btn-primary btn-sm">
                                                            Save
                                                        </button>
                                                </form>

                                                <!-- DELETE FORM (SEPARATE FORM → NO NESTING) -->
                                                <form action="{{ route('categories.destroy', $category->id) }}" 
                                                    method="POST" 
                                                    style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" 
                                                            class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Delete this category?')">
                                                        Del
                                                    </button>
                                                </form>

                                                    </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <hr>

                                    <!-- ADD NEW CATEGORY -->
                                    <h5>Add Category</h5>

                                    <form action="{{ route('categories.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="tournament_id" value="{{ $tournament->id }}">

                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label>Category Name</label>
                                                <input type="text" class="form-control" name="name" required>
                                            </div>

                                            <div class="col-md-8 mb-3">
                                                <label>Description</label>
                                                <input type="text" class="form-control" name="description">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label>Max Teams</label>
                                                <input type="number" class="form-control" name="max_teams">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Number of Groups</label>
                                                <input type="number" class="form-control" name="number_group">
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-success">
                                            Add Category
                                        </button>
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

    <!-- Add this at the very end, just before </body> -->

<!-- CATEGORY MODAL -->
{{-- <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="categoryModalLabel">Manage Categories</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <div class="d-flex gap-2 justify-content-center">
                                        <button class="btn btn-warning btn-sm edit-category-btn" data-id="{{ $category->id }}" data-name="{{ $category->name }}">Edit</button>
                                        <form method="POST" action="{{ route('categories.destroy', $category->id) }}" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <hr>

                <form method="POST" id="categoryForm" action="{{ route('categories.store') }}">
                    @csrf
                    <input type="hidden" id="category_id" name="category_id">
                    <div class="mb-3">
                        <label for="category_name" class="form-label">Category Name:</label>
                        <input type="text" class="form-control" id="category_name" name="name" required>
                    </div>
                    <button type="submit" class="btn btn-primary" id="categoryFormSubmit">Add Category</button>
                    <button type="button" class="btn btn-secondary" id="categoryFormCancel" style="display:none;">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div> --}}

<!-- CATEGORY MODAL SCRIPT -->
<script>
    function selectCategory(button) {
        document.querySelectorAll('.category-buttons .btn').forEach(btn => btn.classList.remove('selected'));
        button.classList.add('selected');
        document.getElementById('category').value = button.innerText;
    }

    // Category modal AJAX
    $('#categoryModal').on('show.bs.modal', function(event){
        let tournamentId = $(event.relatedTarget).data('tournament-id');
        $(this).data('tournament-id', tournamentId);

        $.get('/tournaments/' + tournamentId + '/categories', function(categories){
            let tbody = $('#categoryModalBody');
            tbody.empty();
            categories.forEach(category => {
                tbody.append(`
                    <tr>
                        <td>${category.name}</td>
                        <td class="d-flex gap-2 justify-content-center">
                            <button class="btn btn-warning btn-sm edit-category-btn" data-id="${category.id}" data-name="${category.name}">Edit</button>
                            <form method="POST" action="/categories/${category.id}" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                `);
            });
        });
    });

    $(document).ready(function(){
        $('#categoryModalBody').on('click', '.edit-category-btn', function(){
            let id = $(this).data('id');
            let name = $(this).data('name');
            $('#category_id').val(id);
            $('#category_name').val(name);

            let tournamentId = $('#categoryModal').data('tournament-id');
            $('#categoryForm').attr('action', '/tournaments/' + tournamentId + '/categories/' + id);
            if($('#categoryForm input[name="_method"]').length === 0){
                $('#categoryForm').append('<input type="hidden" name="_method" value="PUT">');
            }
            $('#categoryFormSubmit').text('Update Category');
            $('#categoryFormCancel').show();
        });

        $('#categoryFormCancel').click(function(){
            $('#category_id').val('');
            $('#category_name').val('');
            let tournamentId = $('#categoryModal').data('tournament-id');
            $('#categoryForm').attr('action', '/tournaments/' + tournamentId + '/categories');
            $('#categoryFormSubmit').text('Add Category');
            $('#categoryFormCancel').hide();
            $('#categoryForm input[name="_method"]').remove();
        });
    });
</script>



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
