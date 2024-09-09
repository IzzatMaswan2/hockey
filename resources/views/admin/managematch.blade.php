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
    <title>Manage Match</title>
    <!-- Include Navbar -->
    @include('admin.navbar')
    @include('admin.sidebar')
    <style>
        .table-container {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Select Event Dropdown -->
        <div class="mb-3">
            <label for="eventSelect" class="form-label">Event:</label>
            <select id="eventSelect" class="form-select">
                <option value="event1">TURF TITAN CUP</option>
                <option value="event2">LA LIGA HOCKEY</option>
                <option value="event3">HOCKEY TOURNAMENT 2024</option>
            </select>
        </div>

        <!-- Table -->
        <div class="table-container">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Match Schedule</th>
                        <th>Date & Time</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <!-- Table rows will be added here based on selected event -->
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Sample data for each event
        const eventData = {
            event1: [
                { schedule: "TEAM A VS TEAM B", dateTime: "24 AUGUST 2024 18:00", status: "UPCOMING" },
                { schedule: "TEAM C VS TEAM D", dateTime: "24 AUGUST 2024 19:00", status: "ONGOING" },
                { schedule: "TEAM E VS TEAM F", dateTime: "24 AUGUST 2024 20:00", status: "UPCOMING" },
                { schedule: "TEAM G VS TEAM H", dateTime: "25 AUGUST 2024 18:00", status: "ENDED" },
                { schedule: "TEAM I VS TEAM J", dateTime: "25 AUGUST 2024 19:00", status: "UPCOMING" },
            ],
            event2: [
                { schedule: "TEAM A VS TEAM B", dateTime: "10 AUGUST 2024 18:00", status: "UPCOMING" },
                { schedule: "TEAM C VS TEAM D", dateTime: "10 AUGUST 2024 19:00", status: "ONGOING" },
                { schedule: "TEAM E VS TEAM F", dateTime: "10 AUGUST 2024 20:00", status: "UPCOMING" },
                { schedule: "TEAM G VS TEAM H", dateTime: "11 AUGUST 2024 18:00", status: "ENDED" },
                { schedule: "TEAM I VS TEAM J", dateTime: "11 AUGUST 2024 19:00", status: "UPCOMING" },
            ],
            event3: [
                { schedule: "TEAM A VS TEAM B", dateTime: "14 AUGUST 2024 18:00", status: "UPCOMING" },
                { schedule: "TEAM C VS TEAM D", dateTime: "14 AUGUST 2024 19:00", status: "ONGOING" },
                { schedule: "TEAM E VS TEAM F", dateTime: "14 AUGUST 2024 20:00", status: "UPCOMING" },
                { schedule: "TEAM G VS TEAM H", dateTime: "15 AUGUST 2024 18:00", status: "ENDED" },
                { schedule: "TEAM I VS TEAM J", dateTime: "15 AUGUST 2024 19:00", status: "UPCOMING" },
            ]
        };

        // Update table based on selected event
        document.getElementById('eventSelect').addEventListener('change', function() {
            const selectedEvent = this.value;
            const tableBody = document.getElementById('tableBody');
            tableBody.innerHTML = ''; // Clear existing rows

            const rows = eventData[selectedEvent] || [];
            rows.forEach(row => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${row.schedule}</td>
                    <td>${row.dateTime}</td>
                    <td>${row.status}</td>
                    <td>
                        <button class="btn btn-warning btn-sm">Update</button>
                        <button class="btn btn-danger btn-sm">Remove</button>
                    </td>
                `;
                tableBody.appendChild(tr);
            });
        });
    </script>
        @include('layouts.footer')
</body>
</html>

