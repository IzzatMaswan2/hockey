<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/771de58f02.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.2.2/dist/echarts.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <title>Manage Manager</title>

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

    <!-- Main Content -->
    <div class="container-fluid" style="width: 100%; height: 90%;">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-2" style="background-color: #929292; width: 20%;">
                @include('layouts.sidebar')
            </div>

            <!-- Center Content -->
            <div class="col-8" style="width: 80%;">
                <div class="container-fluid"><br>
                <h2 style="color:#7A5DCA;font-weight:bold;">REGISTER MANAGER</h2><br>
                    
                    <!-- Add Manager Button -->
                    <button class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#addManagerModal" style="background-color:#5D3CB8;font-weight:bold;color:white;border: #5D3CB8 1px solid; ">Add Manager</button>


                    <br>
                <h2 style="color:#7A5DCA;font-weight:bold;">MANAGER LIST</h2><br>
                                <!-- Search Bar for Managers -->
                                <div class="mb-4">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" id="managerSearchInput" placeholder="Search managers...">
                                        </div>
                                    </div>
                                </div>

                                <!-- Managers Tabs -->
                                <ul class="nav nav-tabs" id="managerTabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="unarchived-tab" data-bs-toggle="tab" data-bs-target="#unarchived" type="button" role="tab" aria-controls="unarchived" aria-selected="true">Registered Managers</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="archived-tab" data-bs-toggle="tab" data-bs-target="#archived" type="button" role="tab" aria-controls="archived" aria-selected="false">Archived Managers</button>
                                    </li>
                                </ul>

                                <div class="tab-content" id="managerTabsContent">
                                    <!-- Unarchived Managers Table -->
                                    <div class="tab-pane fade show active" id="unarchived" role="tabpanel" aria-labelledby="unarchived-tab">
                                        <div class="table-container" style="margin-bottom:20px">
                                            <table class="table table-striped">
                                                <thead style="border:1px black solid">
                                                    <tr style="border:1px black solid">
                                                        <th>Manager Name</th>
                                                        <th>Email Address</th>
                                                        <th>Team Name</th>
                                                        <th>Country</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="unarchivedManagerTableBody">
                                                    @foreach ($users as $user)
                                                    @if ($user->role === 'Manager' && $user->archived === 1)
                                                        <tr data-status="{{ $user->status }}">
                                                            <td>{{ $user->fullName }}</td>
                                                            <td>{{ $user->email }}</td>
                                                            <td>{{ $user->team ? $user->team->name : 'N/A' }}</td>
                                                            <td>{{ $user->country }}</td>
                                                            <td>
                                                                <button class="btn btn-primary btn-view" 
                                                                    data-manager-name="{{ $user->fullName }}" 
                                                                    data-manager-email="{{ $user->email }}" 
                                                                    data-manager-team-name="{{ $user->team ? $user->team->name : 'N/A' }}" 
                                                                    data-manager-occupation="{{ $user->occupation }}" 
                                                                    data-manager-address="{{ $user->address }}" 
                                                                    data-manager-country="{{ $user->country }}" 
                                                                    data-bs-toggle="modal" data-bs-target="#managerModal">View</button>

                                                                <button 
                                                                        class="btn btn-secondary btn-edit" 
                                                                        data-manager-id="{{ $user->id }}" 
                                                                        data-manager-name="{{ $user->fullName }}" 
                                                                        data-manager-email="{{ $user->email }}" 
                                                                        data-manager-occupation="{{ $user->occupation }}" 
                                                                        data-manager-team-name="{{ $user->team ? $user->team->name : 'N/A' }}" 
                                                                        data-manager-address="{{ $user->address }}" 
                                                                        data-manager-country="{{ $user->country }}"
                                                                    data-bs-toggle="modal" data-bs-target="#editManagerModal">Edit</button>

                                                                <form method="POST" action="{{ route('manageuser.archive', $user->id) }}" style="display:inline;">
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

                                    <!-- Archived Managers Table -->
                                    <div class="tab-pane fade" id="archived" role="tabpanel" aria-labelledby="archived-tab">
                                        <div class="table-container" style="margin-bottom:20px">
                                            <table class="table table-striped">
                                                <thead style="border:1px black solid">
                                                    <tr style="border:1px black solid">
                                                        <th>Manager Name</th>
                                                        <th>Email Address</th>
                                                        <th>Team Name</th>
                                                        <th>Country</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="archivedManagerTableBody">
                                                    @foreach ($users as $user)
                                                    @if ($user->role === 'Manager' && $user->archived === 0)
                                                        <tr data-status="{{ $user->status }}">
                                                            <td>{{ $user->fullName }}</td>
                                                            <td>{{ $user->email }}</td>
                                                            <td>{{ $user->team ? $user->team->name : 'N/A' }}</td>
                                                            <td>{{ $user->country }}</td>
                                                            <td>
                                                                <button class="btn btn-primary btn-view" 
                                                                    data-manager-name="{{ $user->fullName }}" 
                                                                    data-manager-email="{{ $user->email }}" 
                                                                    data-manager-team-name="{{ $user->team ? $user->team->name : 'N/A' }}" 
                                                                    data-manager-occupation="{{ $user->occupation }}" 
                                                                    data-manager-address="{{ $user->address }}" 
                                                                    data-manager-country="{{ $user->country }}" 
                                                                    data-bs-toggle="modal" data-bs-target="#managerModal">View</button>

                                                              

                                                                <form method="POST" action="{{ route('manageuser.unarchive', $user->id) }}" style="display:inline;">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <button type="submit" class="btn-arc">Unarchive</button>
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
                            </div>
                        </div>

                        <!-- View Manager Details Modal -->
                        <div class="modal fade" id="managerModal" tabindex="-1" aria-labelledby="managerModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="managerModalLabel">Manager Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Name:</strong> <span id="modalManagerName"></span></p>
                                        <p><strong>Email:</strong> <span id="modalManagerEmail"></span></p>
                                        <p><strong>Team Name:</strong> <span id="modalManagerTeam"></span></p>
                                        <p><strong>Occupation:</strong> <span id="modalManagerOccupation"></span></p>
                                        <p><strong>Address:</strong> <span id="modalManagerAddress"></span></p>
                                        <p><strong>Country:</strong> <span id="modalManagerCountry"></span></p>


                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Edit Manager Modal -->
                        <div class="modal fade" id="editManagerModal" tabindex="-1" aria-labelledby="editManagerModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editManagerModalLabel">Edit Manager</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Edit Manager Form -->
                                        <form id="editManagerForm" method="POST" action="{{ route('manageuser.update', ':id') }}">
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
                                                <label for="editOccupation">
                                                    <i class='bx bx-briefcase' style="color: #7A5DCA;font-weight:bold;"></i> Occupation:  &nbsp;&nbsp;
                                                </label>
                                                <input id="editOccupation" type="text" name="occupation" class="form-control"style="border-radius:20px" required>
                                            </div>

                                            <!-- Team Name -->
                                            <div class="input-group mb-3">
                                                <label for="editTeamName">
                                                    <i class='bx bx-group' style="color: #7A5DCA;font-weight:bold;"></i> Team Name:  &nbsp;&nbsp;
                                                </label>
                                                <input id="editTeamName" type="text" name="teamName" class="form-control" style="border-radius:20px"required>
                                            </div>

                                            <!-- Address -->
                                            <div class="input-group mb-3">
                                                <label for="editAddress">
                                                    <i class='bx bx-home' style="color: #7A5DCA; font-weight:bold;"></i> Address: &nbsp;&nbsp;
                                                </label>
                                                <textarea id="editAddress" name="address" class="form-control" style="border-radius:20px; resize:none;" rows="4" required></textarea>
                                            </div>

                                            <div class="input-group mb-3">
                                                <label for="editCountry">
                                                    <i class='bx bx-globe' style="color: #7A5DCA;font-weight:bold;"></i> Country:  &nbsp;&nbsp;
                                                </label>
                                                <input id="editCountry" type="text" name="country" class="form-control"style="border-radius:20px" required>
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

                        <!-- Add Manager Modal -->
            <div class="modal fade" id="addManagerModal" tabindex="-1" aria-labelledby="addManagerModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addManagerModalLabel">Add Manager</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Add Manager Form -->
                            <form method="POST" action="{{ route('manageuser.store') }}">
                                @csrf
                                <input type="hidden" name="role" value="Manager">

                                <!-- Name -->
                                <div class="input-group mb-3">
                                    <label for="fullName" >
                                        <i class='bx bx-user' style="color: #7A5DCA;font-weight:bold;"></i> Name: &nbsp;&nbsp;
                                    </label>
                                    <input id="fullName" type="text" name="fullName" class="form-control" value="{{ old('fullName') }}" required autofocus autocomplete="fullName"style="border-radius:20px">
                                    <x-input-error :messages="$errors->get('fullName')" class="error" />
                                </div>

                                <!-- Email Address -->
                                <div class="input-group mb-3">
                                    <label for="email" >
                                        <i class='bx bx-envelope' style="color: #7A5DCA;font-weight:bold;"></i> Email Address: &nbsp;&nbsp;
                                    </label>
                                    <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus autocomplete="username"style="border-radius:20px">
                                    <x-input-error :messages="$errors->get('email')" class="error" />
                                </div>

                              <!-- Occupation-->
                                <div class="input-group mb-3" >
                                    <label for="occupation">
                                        <i class='bx bx-user' style="color: #7A5DCA;font-weight:bold;"></i> Occupation: &nbsp;&nbsp;
                                    </label>
                                    <input id="occupation" type="text" name="occupation" class="form-control" value="{{ old('occupation') }}" required autofocus autocomplete="occupation"style="border-radius:20px">
                                    <x-input-error :messages="$errors->get('occupation')" class="error" />
                                </div>

                                <div class="input-group mb-3">
                                    <label for="tournament_id">
                                        <i class='bx bx-trophy' style="color: #7A5DCA;font-weight:bold;"></i> Tournament: &nbsp;&nbsp;
                                    </label>
                                    <select id="tournament_id" class="form-select" name="tournament_id">
                                                                    <option value="" disabled selected>Select a tournament</option>
                                                                    @foreach ($tournaments as $tournament)
                                                                        <option value="{{ $tournament->id }}">{{ $tournament->name }}</option>
                                                                    @endforeach
                                                                </select>
                                    <x-input-error :messages="$errors->get('tournament_id')" class="error" />
                                </div>
                              <!-- Team Name-->
                              <div class="input-group mb-3" >
                                    <label for="teamName">
                                        <i class='bx bx-user' style="color: #7A5DCA;font-weight:bold;"></i> Team Name: &nbsp;&nbsp;
                                    </label>
                                    <input id="teamName" type="text" name="teamName" class="form-control" value="{{ old('teamName') }}" required autofocus autocomplete="teamName"style="border-radius:20px">
                                    <x-input-error :messages="$errors->get('teamName')" class="error" />
                                </div>

                              <!-- Address-->
                                <!-- House/Street Number -->
                                <div class="input-group mb-3" >
                                    <label for="address">
                                        <i class='bx bx-home' style="color: #7A5DCA;font-weight:bold;"></i> Address: &nbsp;&nbsp;
                                    </label>
                                    <input id="address" type="text" name="address" class="form-control" value="{{ old('address') }}" required autofocus autocomplete="address"style="border-radius:20px">
                                    <x-input-error :messages="$errors->get('address')" class="error" />
                                </div>

                                <!-- Country -->
                                <div class="input-group mb-3" >
                                    <label for="country">
                                        <i class='bx bx-globe' style="color: #7A5DCA;font-weight:bold;"></i> Country: &nbsp;&nbsp;
                                    </label>
                                    <input id="country" type="text" name="country" class="form-control" value="{{ old('country') }}" required autofocus autocomplete="country"style="border-radius:20px">
                                    <x-input-error :messages="$errors->get('country')" class="error" />
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
        // Manager search function
        function searchManagers() {
            const input = document.getElementById("managerSearchInput");
            const filter = input.value.toLowerCase();
            const rows = document.querySelectorAll("#managerTableBody tr");

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
        document.getElementById("managerSearchInput").addEventListener("input", function() {
            searchManagers();
        });

        // Event listener for view button click to show manager details in the modal
        document.querySelectorAll('.btn-view').forEach(button => {
            button.addEventListener('click', function() {
                const managerName = this.getAttribute('data-manager-name');
                const managerEmail = this.getAttribute('data-manager-email');
                const managerTeamName = this.getAttribute('data-manager-team-name');
                const managerOccupation = this.getAttribute('data-manager-occupation');
                const managerAddress = this.getAttribute('data-manager-address');
                const managerCountry = this.getAttribute('data-manager-country');

                // Populate modal fields
                document.getElementById('modalManagerName').textContent = managerName;
                document.getElementById('modalManagerEmail').textContent = managerEmail;
                document.getElementById('modalManagerTeam').textContent = managerTeamName;
                document.getElementById('modalManagerOccupation').textContent = managerOccupation;
                document.getElementById('modalManagerAddress').textContent = managerAddress;
                document.getElementById('modalManagerCountry').textContent = managerCountry;
            });
        });

        document.querySelectorAll('.btn-edit').forEach(button => {
    button.addEventListener('click', function() {
        const managerId = this.getAttribute('data-manager-id');
        const managerName = this.getAttribute('data-manager-name');
        const managerEmail = this.getAttribute('data-manager-email');
        const managerOccupation = this.getAttribute('data-manager-occupation');
        const managerTeamName = this.getAttribute('data-manager-team-name');
        const managerAddress = this.getAttribute('data-manager-address');
        const managerCountry = this.getAttribute('data-manager-country');

        // Populate form fields
        document.getElementById('editFullName').value = managerName;
        document.getElementById('editEmail').value = managerEmail;
        document.getElementById('editOccupation').value = managerOccupation;
        document.getElementById('editTeamName').value = managerTeamName;
        document.getElementById('editAddress').value = managerAddress;
        document.getElementById('editCountry').value = managerCountry;

        // Update form action URL
        const form = document.getElementById('editManagerForm');
        form.action = form.action.replace(':id', managerId);
    });
    $(document).ready(function() {
        // Initialize Select2 on the tournament dropdown
        $('#tournament_id').select2({
            placeholder: "Select Tournament",
            allowClear: true
        });
    });
});

    </script>
</body>
@include('layouts.footer')
</html>
