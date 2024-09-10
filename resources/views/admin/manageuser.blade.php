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
            background-color: #7A5DCA;
            font-weight: bold;
            font-size: 25px;
            color: black;
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
    <div class="container-fluid" style="width: 100%; height: 100%;">
        <div class="row">
            <div class="col-2" style="background-color: #929292; width: 20%;">
                @include('layouts.sidebar')
            </div>

            <div class="col-9" style="padding:0;margin:0;">
                <div class="col-11 content" style="padding:0;margin:15px;">
                    <div class="container-fluid">
                        <div class="container my-5">
                            <div class="section">
                                <h4 style="color:#7A5DCA;font-weight:bold;">MANAGERS</h4>

                                <!-- Search Bar for Managers -->
                                <div class="mb-4">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" id="managerSearchInput" placeholder="Search managers...">
                                        </div>
                                    </div>
                                </div>

                                <!-- Managers Table -->
                                <div class="table-container">
                                    <table class="table table-striped">
                                        <thead style="border:1px black solid">
                                            <tr style="border:1px black solid">
                                                <th>Manager Name</th>
                                                <th>Email Address</th>
                                                <th>Team Name</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="managerTableBody">
                                            @foreach ($users as $user)
                                                @if ($user->role === 'Manager')
                                                    <tr data-status="{{ $user->status }}">
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ $user->teamName }}</td>
                                                        <td>
                                                            <button class="btn btn-primary btn-view" data-manager-name="{{ $user->name }}" data-manager-email="{{ $user->email }}" data-manager-team="{{ $user->teamName }}" data-manager-status="{{ $user->status }}" data-bs-toggle="modal" data-bs-target="#managerModal">View</button>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Manager Details Modal -->
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
                                        <p><strong>Team:</strong> <span id="modalManagerTeam"></span></p>
                                        <p><strong>Status:</strong> <span id="modalManagerStatus"></span></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                const managerTeam = this.getAttribute('data-manager-team');
                const managerStatus = this.getAttribute('data-manager-status') === 'active' ? 'Active' : 'Inactive';

                // Populate modal fields
                document.getElementById('modalManagerName').textContent = managerName;
                document.getElementById('modalManagerEmail').textContent = managerEmail;
                document.getElementById('modalManagerTeam').textContent = managerTeam;
                document.getElementById('modalManagerStatus').textContent = managerStatus;
            });
        });

        // Initial filtering
        searchManagers();
    </script>
</body>
@include('layouts.footer')
</html>
