<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <!-- Meta, CSS, and JavaScript links as before -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/771de58f02.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.2.2/dist/echarts.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <style>
        .sidebar {
            background-color: #f8f9fa;
        }
        .main-content {
            padding: 0px;
        }
        .table-modern {
            border-collapse: collapse;
            width: 100%;
            background-color: #fff;
        }
        .table-modern thead th {
            background-color: #fff;
            color: #5D3CB8;
            font-weight: bold;
            text-align: center;
            padding: 10px;
        }
        .table-modern tbody td {
            padding: 2px;
            text-align: center;
            vertical-align: middle;
        }
        .btn-modern {
            border-radius: 4px;
            padding: 6px 12px;
            font-size: 0.9rem;
            transition: background-color 0.3s, color 0.3s;
        }
        .btn-info.btn-modern {
            background-color: #28C179;
            color: #fff;
        }
        .btn-info.btn-modern:hover {
            background-color: #138496;
        }
        .text-active {
            color: #28a745;
            font-weight: bold;
        }
        .text-expired {
            color: #dc3545;
            font-weight: bold;
        }
        .profile-picture {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
        }
        .modal-body h5 {
            font-weight: bold;
        }
        .profile-info {
            margin-top: 10px;
        }

        /* Email verification styles */
        .text-verified {
            color: #28a745; /* Green for verified */
            font-weight: bold;
        }
        .text-not-verified {
            color: #dc3545; /* Red for not verified */
            font-weight: bold;
        }
    </style>
</head>

<body>
    @include('layouts.navbar')

    <div class="container-fluid" style="height: 90%; padding: 0;">
        <div class="row">
            <div class="col-3" style="background-color: #929292; width:15%;">
                @include('layouts.sidebar')
            </div>

            <div class="col-9 main-content">
                <h3 class="mt-4 mb-3" style="color: #5D3CB8;" ><strong>TEAM MANAGERS LIST</strong></h3>
                <div class="mb-3">
                    <label for="managerSearch" class="form-label"></label>
                    <input type="text" class="form-" id="managerSearch" placeholder="Search by name, email, or subscription status...">
                </div>
                <table class="table table-modern mt-3">
                    <thead>
                        <tr>
                            <th scope="col">NAME</th>
                            <th scope="col">EMAIL ADDRESS</th>
                            <th scope="col">SUBSCRIPTION STATUS</th>
                            <th scope="col">ACTION</th>
                        </tr>
                    </thead>
                    <tbody id="managerTableBody">
                        <tr>
                            <td>John Doe</td>
                            <td>johndoe@example.com</td>
                            <td><span class="text-active">Active</span></td>
                            <td><button class="btn btn-info btn-modern" data-bs-toggle="modal" data-bs-target="#profileModal" onclick="viewProfile('John Doe', 'johndoe@example.com', true, '2 Events', 'Team A', 'profile-pic-url')">View</button></td>
                        </tr>
                        <tr>
                            <td>Jane Smith</td>
                            <td>janesmith@example.com</td>
                            <td><span class="text-expired">Expired</span></td>
                            <td><button class="btn btn-info btn-modern" data-bs-toggle="modal" data-bs-target="#profileModal" onclick="viewProfile('Jane Smith', 'janesmith@example.com', false, '5 Events', 'Team B', 'profile-pic-url')">View</button></td>
                        </tr>
                        <!-- Add more manager rows as needed -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('layouts.footer')

    <!-- Profile Modal -->
    <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="profileModalLabel">Manager Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <img src="img/manager A.png" id="profilePicture" alt="Profile Picture" class="profile-picture mb-3">
                        <h5 id="profileName"></h5>
                    </div>
                    <div class="profile-info">
                        <p><strong>Email:</strong> <span id="profileEmail"></span></p>
                        <p><strong>Email Verified:</strong> <span id="profileVerified"></span></p>
                        <p><strong>Events Involved:<control/strong> <span id="profileEvents"></span></p>
                        <p><strong>Team:</strong> <span id="profileTeam"></span></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function viewProfile(name, email, verified, events, team, pictureUrl) {
            document.getElementById('profileName').textContent = name;
            document.getElementById('profileEmail').textContent = email;
            document.getElementById('profileVerified').textContent = verified ? 'Verified' : 'Not Verified';
            document.getElementById('profileVerified').className = verified ? 'text-verified' : 'text-not-verified';
            document.getElementById('profileEvents').textContent = events;
            document.getElementById('profileTeam').textContent = team;
            document.getElementById('profilePicture').src = pictureUrl;
        }

        // Filter managers by name, email, or subscription status
        document.getElementById('managerSearch').addEventListener('input', function () {
            var searchTerm = this.value.toLowerCase();
            var rows = document.querySelectorAll('#managerTableBody tr');

            rows.forEach(row => {
                var name = row.cells[0].textContent.toLowerCase();
                var email = row.cells[1].textContent.toLowerCase();
                var status = row.cells[2].textContent.toLowerCase();
                if (name.includes(searchTerm) || email.includes(searchTerm) || status.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>
