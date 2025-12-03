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
    <title>Manage Admin</title>

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
            background-color: #7A5DCA;
            font-weight: bold;
            font-size: 25px;
            color: black;
        }

        .btn-primary:hover {
            background-color: #5f288a;
            color: white;
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

        .modal-content {
    background-image: url('path/to/logreg.jpg');
    background-size: cover;
    background-position: center;
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
                <h2 style="color:#7A5DCA;font-weight:bold;">REGISTER ADMIN</h2><br>
                    
                    <!-- Add Admin Button -->
                    <button class="btn btn-primary mb-4" data-bs-toggle="modal"style="background-color:#5D3CB8;font-weight:bold;color:white;border: #5D3CB8 1px solid; " data-bs-target="#addAdminModal">Add Admin</button>


                    <br>
                <h2 style="color:#7A5DCA;font-weight:bold;">ADMIN LIST</h2><br>
                                <!-- Search Bar for Admins -->
                                <div class="mb-4">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" id="adminSearchInput" placeholder="Search admins...">
                                        </div>
                                    </div>
                                </div>

                                <!-- Admins Table -->
                                <!-- Admin Tabs -->
                                <ul class="nav nav-tabs" id="adminTabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="unarchived-admin-tab" data-bs-toggle="tab" data-bs-target="#unarchived-admin" type="button" role="tab" aria-controls="unarchived-admin" aria-selected="true">Registered Admins</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="archived-admin-tab" data-bs-toggle="tab" data-bs-target="#archived-admin" type="button" role="tab" aria-controls="archived-admin" aria-selected="false">Archived Admins</button>
                                    </li>
                                </ul>

                                <div class="tab-content" id="adminTabsContent">
                                    <!-- Unarchived Admins Table -->
                                    <div class="tab-pane fade show active" id="unarchived-admin" role="tabpanel" aria-labelledby="unarchived-admin-tab">
                                        <div class="table-container" style="margin-bottom:20px">
                                            <table class="table table-striped">
                                                <thead style="border:1px black solid">
                                                    <tr style="border:1px black solid">
                                                        <th>Admin Name</th>
                                                        <th>Email Address</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="unarchivedAdminTableBody">
                                                    @foreach ($users as $user)
                                                    @if ($user->role === 'Admin' && $user->archived === 1)
                                                        <tr data-status="{{ $user->status }}">
                                                            <td>{{ $user->fullName }}</td>
                                                            <td>{{ $user->email }}</td>
                                                            <td>
                                                                <button class="btn btn-primary btn-view" 
                                                                    data-admin-name="{{ $user->fullName }}" 
                                                                    data-admin-email="{{ $user->email }}" 
                                                                    data-admin-status="{{ $user->status }}" 
                                                                    data-bs-toggle="modal" data-bs-target="#adminModal">View</button>

                                                                <form method="POST" action="{{ route('manageadmin.archive', $user->id) }}" style="display:inline;">
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

                                    <!-- Archived Admins Table -->
                                    <div class="tab-pane fade" id="archived-admin" role="tabpanel" aria-labelledby="archived-admin-tab">
                                        <div class="table-container" style="margin-bottom:20px">
                                            <table class="table table-striped">
                                                <thead style="border:1px black solid">
                                                    <tr style="border:1px black solid">
                                                        <th>Admin Name</th>
                                                        <th>Email Address</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="archivedAdminTableBody">
                                                    @foreach ($users as $user)
                                                    @if ($user->role === 'Admin' && $user->archived === 0)
                                                        <tr data-status="{{ $user->status }}">
                                                            <td>{{ $user->fullName }}</td>
                                                            <td>{{ $user->email }}</td>
                                                            <td>
                                                                <button class="btn btn-primary btn-view" 
                                                                    data-admin-name="{{ $user->fullName }}" 
                                                                    data-admin-email="{{ $user->email }}" 
                                                                    data-admin-status="{{ $user->status }}" 
                                                                    data-bs-toggle="modal" data-bs-target="#adminModal">View</button>

                                                                <form method="POST" action="{{ route('manageadmin.unarchive', $user->id) }}" style="display:inline;">
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

                        <!-- Admin Details Modal -->
<div class="modal fade" id="adminModal" tabindex="-1" aria-labelledby="adminModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-custom-bg">
            <div class="modal-header">
                <h5 class="modal-title" id="adminModalLabel">Admin Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Name:</strong> <span id="modalAdminName"></span></p>
                <p><strong>Email:</strong> <span id="modalAdminEmail"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


                        <!-- Add Admin Modal -->
            <div class="modal fade" id="addAdminModal" tabindex="-1" aria-labelledby="addAdminModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addAdminModalLabel">Add Admin</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Add Admin Form -->
                            <form method="POST" action="{{ route('admin.manageadmin') }}">
                                @csrf
                                <input type="hidden" name="role" value="Admin">

                                <!-- Name -->
                                <div class="input-group mb-3">
                                    <label for="fullName">
                                        <i class='bx bx-user' style="color: #7A5DCA;font-weight:bold;"></i> Name: &nbsp;&nbsp;
                                    </label>
                                    <input id="fullName" type="text" name="fullName" class="form-control" value="{{ old('fullName') }}" required autofocus autocomplete="fullName" style="border-radius:20px">
                                    <x-input-error :messages="$errors->get('fullName')" class="error" />
                                </div>

                                <!-- Email Address -->
                                <div class="input-group mb-3">
                                    <label for="email">
                                        <i class='bx bx-envelope' style="color: #7A5DCA;font-weight:bold;"></i> Email Address: &nbsp;&nbsp;
                                    </label>
                                    <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}"  required autofocus autocomplete="username"style="border-radius:20px">
                                    <x-input-error :messages="$errors->get('email')" class="error" />
                                </div>

                                <!-- Password -->
                                <div class="input-group mb-3">
                                    <label for="password">
                                        <i class='bx bx-lock' style="color: #7A5DCA;font-weight:bold;"></i> Password: &nbsp;&nbsp;
                                    </label>
                                    <input id="password" type="password" name="password" class="form-control"  required autofocus autocomplete="new-password"style="border-radius:20px">
                                    <x-input-error :messages="$errors->get('password')" class="error" />
                                </div>

                                <!-- Confirm Password -->
                                <div class="input-group mb-3">
                                    <label for="password_confirmation">
                                        <i class='bx bx-lock-alt' style="color: #7A5DCA;font-weight:bold;"></i> Confirm Password: &nbsp;&nbsp;
                                    </label>
                                    <input id="password_confirmation" type="password" name="password_confirmation" class="form-control"  required autofocus autocomplete="new-password"style="border-radius:20px">
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="error" />
                                </div>

                                <div class="modal-footer">
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
        // Admin search function
        function searchAdmins() {
            const input = document.getElementById("adminSearchInput");
            const filter = input.value.toLowerCase();
            const rows = document.querySelectorAll("#adminTableBody tr");

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
        document.getElementById("adminSearchInput").addEventListener("input", function() {
            searchAdmins();
        });

        // Event listener for view button click to show admin details in the modal
        document.querySelectorAll('.btn-view').forEach(button => {
            button.addEventListener('click', function() {
                const adminName = this.getAttribute('data-admin-name');
                const adminEmail = this.getAttribute('data-admin-email');


                // Populate modal fields
                document.getElementById('modalAdminName').textContent = adminName;
                document.getElementById('modalAdminEmail').textContent = adminEmail;

            });
        });

        // Initial filtering
        searchAdmins();
    </script>
</body>
@include('layouts.footer')
</html>
