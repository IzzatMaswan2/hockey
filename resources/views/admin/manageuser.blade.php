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
    <title>Create New Event</title>
    <!-- Include Navbar -->
    @include('admin.navbar')
    @include('admin.sidebar')
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
            width: 250px;
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
    <div class="container my-5">
        <div class="section">
            <h4 style="color:#7A5DCA;font-weight:bold;">CREATE NEW EVENT</h4>
            <form method="GET" action="{{ ('manageuser') }}">
            <div class="row g-3">
                <!-- Event Creation Form -->
                <div class="col-md-4 input-field">
                    <label for="eventName" class="form-label" style="color:#929292;font-weight:bold;">Event Name:</label>
                    <input type="text" id="eventName" class="form-control" name="eventName" placeholder="Event Name">
                </div>
                <div class="col-md-4 input-field">
                    <label for="startDate" class="form-label" style="color:#929292;font-weight:bold;">Start Date:</label>
                    <input type="date" id="startDate" class="form-control" name="startDate"placeholder="Start Date">
                </div>
                <div class="col-md-4 input-field">
                    <label for="endDate" class="form-label" style="color:#929292;font-weight:bold;">End Date:</label>
                    <input type="date" id="endDate" class="form-control" name="endDate" placeholder="End Date">
                </div>
                <div class="col-md-4 input-field">
                    <label for="participatingTeam" class="form-label" style="color:#929292;font-weight:bold;">Participating Teams:</label>
                    <input type="number" id="participatingTeam" class="form-control" name="participatingTeam" placeholder="Number of Team(s)">
                </div>
                <div class="col-md-4 input-field">
                    <label for="groupNumber" class="form-label" style="color:#929292;font-weight:bold;">Group Number:</label>
                    <input type="number" id="groupNumber" class="form-control" name="groupNumber" placeholder="Number of Group(s)">
                </div>
                <div class="col-md-4 input-field">
                    <label for="venue" class="form-label" style="color:#929292;font-weight:bold;">Venue:</label>
                    <input type="text" id="venue" class="form-control" name="venue"placeholder="Place of the Event">
                </div>
                <div class="col-md-4 input-field">
                    <div class="category-row">
                        <label class="form-label mb-0" style="color:#929292;font-weight:bold;">Category:</label>
                        <div class="category-buttons">
                            <button type="button" class="btn btn-outline-primary" name="category" onclick="selectCategory(this)">Single Elimination</button>
                            <button type="button" class="btn btn-outline-primary"  name="category" onclick="selectCategory(this)">Double Elimination</button>
                            <button type="button" class="btn btn-outline-primary"  name="category" onclick="selectCategory(this)">Round Robin</button>
                            <button type="button" class="btn btn-outline-primary"  name="category" onclick="selectCategory(this)">Group Stage + Knockout</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Create Event</button>
            </div>
            </form>
        </div>
    </div>

    <hr style="margin: 0 120px;">

    <div class="container my-5">
        <div class="section">
            <h4 style="color:#7A5DCA;font-weight:bold;">EVENT PLANNER</h4>
            
            <!-- Search Bar and Filter for Events -->
            <div class="mb-4">
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="eventSearchInput" placeholder="Search events...">
                    </div>
                    <div class="col-md-4">
                        <select class="form-select" id="eventStatusFilter">
                            <option value="">All Statuses</option>
                            <option value="Upcoming">Upcoming</option>
                            <option value="Ongoing">Ongoing</option>
                            <option value="Ended">Ended</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Events Table -->
            <div class="table-container">
                <table class="table table-striped">
                    <thead style="border:1px black solid">
                        <tr style="border:1px black solid">
                            <th>Event Name</th>
                            <th>Time Period</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="eventTableBody">
                        <tr data-status="Ongoing">
                            <td>LA LIGA HOCKEY</td>
                            <td>1 AUG 2024 - 15 AUG 2024</td>
                            <td class="status-cell">ONGOING</td>
                            <td>
                                <button class="btn btn-warning btn-action">UPDATE</button>
                                <button class="btn btn-danger btn-action">REMOVE</button>
                            </td>
                        </tr>
                        <tr data-status="Ended">
                            <td>HOCKEY TOURNAMENT 2024</td>
                            <td>3 MAY 2024 - 1 JUN 2024</td>
                            <td class="status-cell">ENDED</td>
                            <td>
                                <button class="btn btn-warning btn-action">UPDATE</button>
                                <button class="btn btn-danger btn-action">REMOVE</button>
                            </td>
                        </tr>
                        <tr data-status="Ended">
                            <td>FIELD HOCKEY FIESTA</td>
                            <td>11 FEB 2024 - 2 MAR 2024</td>
                            <td class="status-cell">ENDED</td>
                            <td>
                                <button class="btn btn-warning btn-action">UPDATE</button>
                                <button class="btn btn-danger btn-action">REMOVE</button>
                            </td>
                        </tr>
                        <tr data-status="Upcoming">
                            <td>FOOTBALL MATCHES 2024</td>
                            <td>1 SEP 2024 - 15 DEC 2024</td>
                            <td class="status-cell">UPCOMING</td>
                            <td>
                                <button class="btn btn-warning btn-action">UPDATE</button>
                                <button class="btn btn-danger btn-action">REMOVE</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <hr style="margin: 0 120px;">

    <div class="container my-5">
        <div class="section">
            <h4 style="color:#7A5DCA;font-weight:bold;">MANAGERS</h4>
            
            <!-- Search Bar and Filter for Managers -->
            <div class="mb-4">
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="managerSearchInput" placeholder="Search managers...">
                    </div>
                    <div class="col-md-4">
                        <select class="form-select" id="managerStatusFilter">
                            <option value="">All Statuses</option>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
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
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="managerTableBody">
                        <tr data-status="Active">
                            <td>John Doe</td>
                            <td>Sales</td>
                            <td class="status-cell">ACTIVE</td>
                            <td>
                                <button class="btn btn-warning btn-action">UPDATE</button>
                                <button class="btn btn-danger btn-action">REMOVE</button>
                            </td>
                        </tr>
                        <tr data-status="Active">
                            <td>John Doe</td>
                            <td>Sales</td>
                            <td class="status-cell">ACTIVE</td>
                            <td>
                                <button class="btn btn-warning btn-action">UPDATE</button>
                                <button class="btn btn-danger btn-action">REMOVE</button>
                            </td>
                        </tr>
                        <tr data-status="Active">
                            <td>John Doe</td>
                            <td>Sales</td>
                            <td class="status-cell">ACTIVE</td>
                            <td>
                                <button class="btn btn-warning btn-action">UPDATE</button>
                                <button class="btn btn-danger btn-action">REMOVE</button>
                            </td>
                        </tr>
                        <tr data-status="Active">
                            <td>John Doe</td>
                            <td>Sales</td>
                            <td class="status-cell">ACTIVE</td>
                            <td>
                                <button class="btn btn-warning btn-action">UPDATE</button>
                                <button class="btn btn-danger btn-action">REMOVE</button>
                            </td>
                        </tr>
                        <tr data-status="Inactive">
                            <td>Jane Smith</td>
                            <td>john@gmail.com</td>
                            <td class="status-cell">INACTIVE</td>
                            <td>
                                <button class="btn btn-warning btn-action">UPDATE</button>
                                <button class="btn btn-danger btn-action">REMOVE</button>
                            </td>
                        </tr>                        <tr data-status="Inactive">
                            <td>Jane Smith</td>
                            <td>john@gmail.com</td>
                            <td class="status-cell">INACTIVE</td>
                            <td>
                                <button class="btn btn-warning btn-action">UPDATE</button>
                                <button class="btn btn-danger btn-action">REMOVE</button>
                            </td>
                        </tr>                        <tr data-status="Inactive">
                            <td>Geto Suguru</td>
                            <td>john@gmail.com</td>
                            <td class="status-cell">INACTIVE</td>
                            <td>
                                <button class="btn btn-warning btn-action">UPDATE</button>
                                <button class="btn btn-danger btn-action">REMOVE</button>
                            </td>
                        </tr>
                        <tr data-status="Inactive">
                            <td>Jane Smith</td>
                            <td>john@gmail.com</td>
                            <td class="status-cell">INACTIVE</td>
                            <td>
                                <button class="btn btn-warning btn-action">UPDATE</button>
                                <button class="btn btn-danger btn-action">REMOVE</button>
                            </td>
                        </tr>
                        <tr data-status="Active">
                            <td>Emily Johnson</td>
                            <td>Finance</td>
                            <td class="status-cell">ACTIVE</td>
                            <td>
                                <button class="btn btn-warning btn-action">UPDATE</button>
                                <button class="btn btn-danger btn-action">REMOVE</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Event search function
        function searchEvents(inputId, tableId) {
            const input = document.getElementById(inputId);
            const filter = input.value.toLowerCase();
            const table = document.getElementById(tableId);
            const rows = table.getElementsByTagName("tr");

            for (let i = 0; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName("td");
                let match = false;
                for (let j = 0; j < cells.length - 1; j++) {
                    if (cells[j].innerText.toLowerCase().indexOf(filter) > -1) {
                        match = true;
                        break;
                    }
                }
                rows[i].style.display = match ? "" : "none";
            }
        }

        // Event filter function
        function filterEvents(filterId, tableId) {
            const filter = document.getElementById(filterId).value;
            const table = document.getElementById(tableId);
            const rows = table.getElementsByTagName("tr");

            for (let i = 0; i < rows.length; i++) {
                const status = rows[i].getAttribute("data-status");
                rows[i].style.display = (!filter || status === filter) ? "" : "none";
            }
        }

        // Manager search function
        function searchManagers(inputId, tableId) {
            const input = document.getElementById(inputId);
            const filter = input.value.toLowerCase();
            const table = document.getElementById(tableId);
            const rows = table.getElementsByTagName("tr");

            for (let i = 0; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName("td");
                let match = false;
                for (let j = 0; j < cells.length - 1; j++) {
                    if (cells[j].innerText.toLowerCase().indexOf(filter) > -1) {
                        match = true;
                        break;
                    }
                }
                rows[i].style.display = match ? "" : "none";
            }
        }

        // Manager filter function
        function filterManagers(filterId, tableId) {
            const filter = document.getElementById(filterId).value;
            const table = document.getElementById(tableId);
            const rows = table.getElementsByTagName("tr");

            for (let i = 0; i < rows.length; i++) {
                const status = rows[i].getAttribute("data-status");
                rows[i].style.display = (!filter || status === filter) ? "" : "none";
            }
        }

        // Event listeners
        document.getElementById("eventSearchInput").addEventListener("input", function() {
            searchEvents("eventSearchInput", "eventTableBody");
        });

        document.getElementById("eventStatusFilter").addEventListener("change", function() {
            filterEvents("eventStatusFilter", "eventTableBody");
        });

        document.getElementById("managerSearchInput").addEventListener("input", function() {
            searchManagers("managerSearchInput", "managerTableBody");
        });

        document.getElementById("managerStatusFilter").addEventListener("change", function() {
            filterManagers("managerStatusFilter", "managerTableBody");
        });

        // Category selection function
        function selectCategory(button) {
            const buttons = document.querySelectorAll('.category-buttons .btn');
            buttons.forEach(btn => btn.classList.remove('selected'));
            button.classList.add('selected');
        }
    </script>
</body>
</html>
