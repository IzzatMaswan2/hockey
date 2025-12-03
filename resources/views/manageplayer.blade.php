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
    <title>Manage Player</title>

    <style>
        body {
            background-color: #f5f5f5;
        }

        .mb-4 {
            border-radius: 20px;
            background-color: white;
            padding: 20px;
            margin: 0;
        }

        .section {
            margin-bottom: 2rem;
        }

        .btn-primary {

            font-weight: bold;
            font-size: 14px;

        }

        .btn-primary:hover {
            background-color: #5f288a;
            color: white;
        }

        .table-container {
            margin-top: 2rem;
            border: black 1px solid;
        }

        .table th, .table td {
            text-align: center;
        }

        .btn-arc
        {
            background-color:red;

            font-size: 16px;
            color:white;
            padding:6.5px;
            margin:0;
            border-radius:5px;
            border: 1px solid red;
        }
        .btn-arc:hover
        {
            background-color:#bd2b2b;
            color:white;
            border: 1px solid #bd2b2b;
        }

        .btn-action {
            margin: 0 0.2rem;
        }



    </style>
</head>
<body style="background-color: #f4f7f6;">
    <!-- Navbar -->
    @include('layouts.navbar')

    <!-- Main Layout -->
    <div class="container-fluid" style="width: 100%; height: 100%;">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-2" style="background-color: #929292; height: 100vh;">
                @include('layouts.sidebar-manager')
            </div>

            <!-- Main Content -->
            <div class="col-10">
                <div class="container mt-4">
                <h1 class="" style="color:#5D3CB8;font-weight:bold;">Manage Players</h1>
                    
                    <!-- Add Player Button -->
                    <button class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#addPlayerModal" style="background-color:#5D3CB8;font-weight:bold;color:white;border: #5D3CB8 1px solid; ">Add Player</button>

                                <!-- Search Bar for Players -->
                                <div class="mb-4">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" id="playerSearchInput" placeholder="Search players...">
                                        </div>
                                    </div>
                                </div>

                                <!-- Players Table -->
                                <div class="table-container">
                                    <table class="table table-striped">
                                        <thead style="border:1px black solid">
                                            <tr style="border:1px black solid">
                                                <th>Player Name</th>
                                                <th>Jersey Number</th>
                                                <th>Position</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="playerTableBody">
                                            @foreach ($users as $user)
                                                @if ($user->role === 'Player')
                                                    <tr data-status="{{ $user->status }}">
                                                        <td>{{ $user->fullName }}</td>
                                                        <td>{{ $user->jerseyNumber }}</td>
                                                        <td>{{ $user->position }}</td>
                                                        <td>{{ $user->field_status }}</td>
                                                        <td>
                                                            <button class="btn btn-primary btn-view" 
                                                                data-player-name="{{ $user->fullName }}" 
                                                                data-player-email="{{ $user->email }}" 
                                                                data-player-display-name="{{ $user->displayName }}" 
                                                                data-player-dob="{{ $user->dob }}" 
                                                                data-player-contact="{{ $user->contact }}" 
                                                                data-player-jersey-number="{{ $user->jerseyNumber }}" 
                                                                data-player-position="{{ $user->position }}" 
                                                                data-player-field-status="{{ $user->field_status }}" 
                                                                data-bs-toggle="modal" data-bs-target="#playerModal">View</button>

                                                                <button 
                                                                    class="btn btn-secondary btn-edit" 
                                                                    data-player-id="{{ $user->id }}" 
                                                                    data-player-name="{{ $user->fullName }}" 
                                                                    data-player-email="{{ $user->email }}" 
                                                                    data-player-display-name="{{ $user->displayName }}" 
                                                                    data-player-dob="{{ $user->dob }}" 
                                                                    data-player-contact="{{ $user->contact }}" 
                                                                    data-player-jersey-number="{{ $user->jerseyNumber }}" 
                                                                    data-player-position="{{ $user->position }}" 
                                                                    data-player-field-status="{{ $user->field_status }}" 

                                                                data-bs-toggle="modal" data-bs-target="#editPlayerModal">Edit</button>

                                                            <form method="POST" action="{{ route('manageplayer.archive', $user->id) }}" style="display:inline;">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit" class="btn-arc">Archive</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Player Details Modal -->
                        <div class="modal fade" id="playerModal" tabindex="-1" aria-labelledby="playerModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="playerModalLabel">Player Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Name:</strong> <span id="modalPlayerName"></span></p>
                                        <p><strong>Email:</strong> <span id="modalPlayerEmail"></span></p>
                                        <p><strong>Display Name:</strong> <span id="modalPlayerDisplayName"></span></p>
                                        <p><strong>Date of Birth:</strong> <span id="modalPlayerDOB"></span></p>
                                        <p><strong>Contact:</strong> <span id="modalPlayerContact"></span></p>
                                        <p><strong>Jersey Number:</strong> <span id="modalPlayerJerseyNumber"></span></p>
                                        <p><strong>Position:</strong> <span id="modalPlayerPosition"></span></p>
                                        <p><strong>status:</strong> <span id="modalPlayerFieldStatus"></span></p>



                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Edit Player Modal -->
                        <div class="modal fade" id="editPlayerModal" tabindex="-1" aria-labelledby="editPlayerModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editPlayerModalLabel">Edit Player</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Edit Player Form -->
                                        <form id="editPlayerForm" method="POST" action="{{ route('manageplayer.update', ':id') }}">
                                            @csrf
                                            @method('PUT')

                                            <!-- Name -->
                                            <div class="input-group mb-3">
                                                <label for="editFullName">
                                                    <i class='bx bx-user' style="color: #7A5DCA;font-weight:bold;"></i> Name: &nbsp;&nbsp;
                                                </label>
                                                <input id="editFullName" type="text" name="fullName" class="form-control" style="border-radius:20px"required autofocus>
                                            </div>

                                            <!-- Email Address -->
                                            <div class="input-group mb-3">
                                                <label for="editEmail">
                                                    <i class='bx bx-envelope' style="color: #7A5DCA;font-weight:bold;"></i> Email Address:  &nbsp;&nbsp;
                                                </label>
                                                <input id="editEmail" type="email" name="email" class="form-control"style="border-radius:20px" required>
                                            </div>

                                            <!-- Occupation -->
                                            <div class="input-group mb-3">
                                                <label for="editDisplayName">
                                                    <i class='bx bx-briefcase' style="color: #7A5DCA;font-weight:bold;"></i> Display Name:  &nbsp;&nbsp;
                                                </label>
                                                <input id="editDisplayName" type="text" name="displayName" class="form-control"style="border-radius:20px" required>
                                            </div>

                                            <!-- Team Name -->
                                            <div class="input-group mb-3">
                                                <label for="editDOB">
                                                    <i class='bx bx-group' style="color: #7A5DCA;font-weight:bold;"></i> Date of Birth:  &nbsp;&nbsp;
                                                </label>
                                                <input id="editDOB" type="date" name="dob" class="form-control" style="border-radius:20px"required>
                                            </div>

                                            <!-- Address -->
                                            <div class="input-group mb-3">
                                                <label for="editContact">
                                                    <i class='bx bx-home' style="color: #7A5DCA; font-weight:bold;"></i> Contact: &nbsp;&nbsp;
                                                </label>
                                                <input id="editContact" type="text" name="contact" class="form-control" style="border-radius:20px;"  required></textarea>
                                            </div>

                                            <div class="input-group mb-3">
                                                <label for="editJerseyNumber">
                                                    <i class='bx bx-globe' style="color: #7A5DCA;font-weight:bold;"></i> Jersey Number:  &nbsp;&nbsp;
                                                </label>
                                                <input id="editJerseyNumber" type="number" name="jerseyNumber" class="form-control"style="border-radius:20px" required>
                                            </div>

                                            <div class="input-group mb-3">
                                                <label for="editPosition">
                                                    <i class='bx bx-globe' style="color: #7A5DCA;font-weight:bold;"></i> Position:  &nbsp;&nbsp;
                                                </label>
                                              
                                                <select class="form-control" id="editPosition" name="position" value="{{ old('position') }}"required style="border-radius:20px">
                                                    <option value="" disabled selected>Select a position</option>
                                                    <option value="Goal Keeper">Goal Keeper</option>
                                                    <option value="Defender">Defender</option>
                                                    <option value="Midfielder">Midfielder</option>
                                                    <option value="Inner">Inner</option>
                                                    <option value="Forward">Forward</option>
                                                </select>
                                            </div>

                                            <div class="input-group mb-3">
                                                <label for="editFieldStatus">
                                                    <i class='bx bx-globe' style="color: #7A5DCA;font-weight:bold;"></i> Field Status:  &nbsp;&nbsp;
                                                </label>
                                                <select class="form-control" id="editFieldStatus" name="field_status" value="{{ old('field_status') }}"required  style="border-radius:20px">
                                                    <option value="" disabled selected>Select status</option>
                                                    <option value="Active">Active</option>
                                                    <option value="Injured">Subtitude</option>
                                                    <option value="Retired">Bench</option>
                                                </select>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Add Player Modal -->
            <div class="modal fade" id="addPlayerModal" tabindex="-1" aria-labelledby="addPlayerModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addPlayerModalLabel">Add Player</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Add Player Form -->
                            <form method="POST" action="{{ route('manageplayer') }}">
                                @csrf
                                <input type="hidden" name="role" value="Player">

                               
                                <!-- Name -->
                                <div class="input-group mb-3">
                                    <label for="fullName" >
                                        <i class='bx bx-user' style="color: #7A5DCA;font-weight:bold;"></i>Full Name: &nbsp;&nbsp;
                                    </label>
                                    <input id="fullName" type="text" name="fullName" class="form-control" value="{{ old('fullName') }}" required autofocus autocomplete="fullName"style="border-radius:20px">
                                    <x-input-error :messages="$errors->get('fullName')" class="error" />
                                </div>

                                <!-- Email Address -->
                                <div class="input-group mb-3"                                                            >
                                    <label for="email" >
                                        <i class='bx bx-envelope' style="color: #7A5DCA;font-weight:bold;"></i> Email Address: &nbsp;&nbsp;
                                    </label>
                                    <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus autocomplete="username"style="border-radius:20px">
                                    <x-input-error :messages="$errors->get('email')" class="error" />    
                                    </div>

                              <!-- Display Name-->
                                <div class="input-group mb-3" >
                                    <label for="displayName">
                                        <i class='bx bx-user' style="color: #7A5DCA;font-weight:bold;"></i> Display Name: &nbsp;&nbsp;
                                    </label>
                                    <input id="displayName" type="text" name="displayName" class="form-control" value="{{ old('displayName') }}" required autofocus autocomplete="displayName"style="border-radius:20px">
                                    <x-input-error :messages="$errors->get('displayName')" class="error" />
                                </div>

                              <!-- DOB-->
                                <div class="input-group mb-3" >                                                              
                                    <label for="dob">
                                        <i class='bx bx-user' style="color: #7A5DCA;font-weight:bold;"></i> Date of Birth: &nbsp;&nbsp;
                                    </label>
                                    <input id="dob" type="date" name="dob" class="form-control" value="{{ old('dob') }}" required autofocus autocomplete="dob"style="border-radius:20px">
                                    <x-input-error :messages="$errors->get('dob')" class="error" />
                                </div>

                              <!-- Contact-->
                              <div class="input-group mb-3" >
                                    <label for="contact">
                                        <i class='bx bx-user' style="color: #7A5DCA;font-weight:bold;"></i> Contact: &nbsp;&nbsp;
                                    </label>
                                    <input id="contact" type="text" name="contact" class="form-control" value="{{ old('contact') }}" required autofocus autocomplete="contact"style="border-radius:20px">
                                    <x-input-error :messages="$errors->get('contact')" class="error" />
                                </div>

                                <!-- Contact-->
                              <div class="input-group mb-3" >
                                    <label for="jerseyNumber">
                                        <i class='bx bx-user' style="color: #7A5DCA;font-weight:bold;"></i> Jersey Number: &nbsp;&nbsp;
                                    </label>
                                    <input id="jerseyNumber" type="number" name="jerseyNumber" class="form-control" value="{{ old('jerseyNumber') }}" required autofocus autocomplete="jerseyNumber"style="border-radius:20px">
                                    <x-input-error :messages="$errors->get('jerseyNumber')" class="error" />
                                </div>

                                <!-- Contact-->
                              <div class="input-group mb-3" >
                                    <label for="position">
                                        <i class='bx bx-user' style="color: #7A5DCA;font-weight:bold;"></i> Position: &nbsp;&nbsp;
                                    </label>
                                    <select class="form-control" id="position" name="position" value="{{ old('position') }}"required autofocus autocomplete="position" style="border-radius:20px">
                                        <option value="" disabled selected>Select a position</option>
                                        <option value="Goal Keeper">Goal Keeper</option>
                                        <option value="Defender">Defender</option>
                                        <option value="Midfielder">Midfielder</option>
                                        <option value="Inner">Inner</option>
                                        <option value="Forward">Forward</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('position')" class="error" />
                                </div>

                                <div class="input-group mb-3" >
                                    <label for="field_status">
                                        <i class='bx bx-user' style="color: #7A5DCA;font-weight:bold;"></i> Status on the Field: &nbsp;&nbsp;
                                    </label>
                                    <select class="form-control" id="field_status" name="field_status" value="{{ old('field_status') }}"required autofocus autocomplete="field_status" style="border-radius:20px">
                                        <option value="" disabled selected>Select status</option>
                                        <option value="Active">Active</option>
                                        <option value="Injured">Subtitude</option>
                                        <option value="Retired">Bench</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('field_status')" class="error" />
                                </div>
                                <!-- Password -->
                                <div class="input-group mb-3" >
                                    <label for="password">
                                        <i class='bx bx-lock' style="color: #7A5DCA;font-weight:bold;"></i> Password: &nbsp;&nbsp;
                                    </label>
                                    <input id="password" type="password" name="password" class="form-control" required autocomplete="new-password"style="border-radius:20px">
                                    <x-input-error :messages="$errors->get('password')" class="error" />
                                </div>

                                <!-- Confirm Password -->
                                <div class="input-group mb-3" >
                                    <label for="password_confirmation">
                                        <i class='bx bx-lock-alt' style="color: #7A5DCA;font-weight:bold;"></i> Confirm Password: &nbsp;&nbsp;
                                    </label>
                                    <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" required autocomplete="new-password" style="border-radius:20px">
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="error" />
                                </div>

                                <div class="modal-footer" >
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <x-primary-button class="btn btn-primary">{{ __('Register') }}</x-primary-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Player search function
        function searchPlayers() {
            const input = document.getElementById("playerSearchInput");
            const filter = input.value.toLowerCase();
            const rows = document.querySelectorAll("#playerTableBody tr");

            rows.forEach(row => {
                const cells = row.getElementsByTagName("td");
                let match = false;
                for (let j = 0; j < cells.length - 1; j++) {
                    if (cells[j].innerText.toLowerCase().includes(filter)) {
                        match = true;
                        break;
                    }
                }
                row.style.display = match ? "" : "none";
            });
        }

        // Event listeners for searching
        document.getElementById("playerSearchInput").addEventListener("input", function() {
            searchPlayers();
        });

        // Event listener for view button click to show player details in the modal
        document.querySelectorAll('.btn-view').forEach(button => {
            button.addEventListener('click', function() {
                const playerName = this.getAttribute('data-player-name');
                const playerEmail = this.getAttribute('data-player-email');
                const playerDisplayName = this.getAttribute('data-player-display-name');
                const playerDOB = this.getAttribute('data-player-dob');
                const playerContact = this.getAttribute('data-player-contact');
                const playerJerseyNumber = this.getAttribute('data-player-jersey-number');
                const playerPosition = this.getAttribute('data-player-position');
                const playerFieldStatus = this.getAttribute('data-player-field-status');

                // Populate modal fields
                document.getElementById('modalPlayerName').textContent = playerName;
                document.getElementById('modalPlayerEmail').textContent = playerEmail;
                document.getElementById('modalPlayerDisplayName').textContent = playerDisplayName;
                document.getElementById('modalPlayerDOB').textContent = playerDOB;
                document.getElementById('modalPlayerContact').textContent = playerContact;
                document.getElementById('modalPlayerJerseyNumber').textContent = playerJerseyNumber;
                document.getElementById('modalPlayerPosition').textContent = playerPosition;
                document.getElementById('modalPlayerFieldStatus').textContent = playerFieldStatus;
            });
        });

        document.querySelectorAll('.btn-edit').forEach(button => {
    button.addEventListener('click', function() {
                const playerId = this.getAttribute('data-player-id');
                const playerName = this.getAttribute('data-player-name');
                const playerEmail = this.getAttribute('data-player-email');
                const playerDisplayName = this.getAttribute('data-player-display-name');
                const playerDOB = this.getAttribute('data-player-dob');
                const playerContact = this.getAttribute('data-player-contact');
                const playerJerseyNumber = this.getAttribute('data-player-jersey-number');
                const playerPosition = this.getAttribute('data-player-position');
                const playerFieldStatus = this.getAttribute('data-player-field-status');

        // Populate form fields
        document.getElementById('editFullName').value = playerName;
        document.getElementById('editEmail').value = playerEmail;
        document.getElementById('editDisplayName').value = playerDisplayName;
        document.getElementById('editDOB').value = playerDOB;
        document.getElementById('editContact').value = playerContact;
        document.getElementById('editJerseyNumber').value = playerJerseyNumber;
        document.getElementById('editPosition').value = playerPosition;
        document.getElementById('editFieldStatus').value = playerFieldStatus;

        // Update form action URL
        const form = document.getElementById('editPlayerForm');
        form.action = form.action.replace(':id', playerId);
    });

});

    </script>
</body>
@include('layouts.footer')
</html>
