<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta, CSS, and JavaScript links as before -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-6S3kS8Z2v3dHhe04cF0xtbB7t8Z6ZtQbCOkOqgRIse0dY+6BfVtA8tTu1Q8l10m4" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-DbfNwCApThcJe4fP5z5LfXz0cI0zTXh83Ge9pu6vxZyL2W1p7FSm5lZZjBX92W48" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/771de58f02.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.2.2/dist/echarts.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" href="img/Logo.png" type="image/icon type">
    <style>
        /* Additional styling */
        th {
            color: #5D3CB8;
        }

        table, th, td {
            border: 1px solid #007bff;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
        }

        /* Style for the Update button */
        .btn-update {
            color: white; /* Text color */
            padding: 6px 12px; /* Padding for better size */
            border-radius: 6px; /* Rounded corners */
            font-weight: 600; /* Bold text */
            transition: background-color 0.3s ease, transform 0.3s ease; /* Smooth transitions */
        }

        /* Hover effect */
        .btn-update:hover {
            background-color: #4a2f9c; /* Slightly darker background on hover */
            border-color: #4a2f9c;
            transform: scale(1.05); /* Slight zoom effect */
        }

        /* Focus and active states */
        .btn-update:focus, .btn-update:active {
            outline: none;
            box-shadow: 0 0 10px rgba(93, 60, 184, 0.5); /* Glow effect on focus */
        }

        .status-upcoming {
            color: #00FF87;
        }

        .status-ongoing {
            color: #FFC107;
        }

        .vs-text {
            font-size:  1rem;
            line-height: 1;
        }

        .form-row-align-right {
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }

        .form-group-custom {
            margin-bottom: 0;
        }

        .form-group-margin {
            margin-right: 20px; /* Adjust the margin as needed */
            padding-bottom: 20px;
        }

    </style>
</head>

<body>
    @include('layouts.navbar')

    <div class="container-fluid" style="height: 90%; padding: 0;">
        <div class="row">
            <div class="col-2" style="background-color: #929292; width: 20%;">
                @include('layouts.sidebar')
            </div>

            <div class="col-8">
                <h3 class="mt-4 mb-3" style="color: #5D3CB8;"><strong>MANAGE MATCH</strong></h3>
                
                <!-- Event Selection -->
                <div class="mb-3">
                    <label for="eventSelect" class="form-label">Select Event</label>
                    <select id="eventSelect" class="form-select">
                        <option value="all">All Events</option>
                        <option value="event1">Event 1</option>
                        <option value="event2">Event 2</option>
                        <option value="event3">Event 3</option>
                    </select>
                </div>

                <!-- Match Schedule Table -->
                <table class="table table-striped" id="matchTable">
                    <thead>
                        <tr>
                            <th>MATCH SCHEDULE</th>
                            <th>DATE & TIME</th>
                            <th>STATUS</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody id="matchTableBody">
                        <tr data-event="event1">
                            <td>Team A vs Team B</td>
                            <td>2024-08-20 15:00</td>
                            <td class="status-upcoming"  style="color: #0096FF;">Upcoming</td>
                            <td>
                                <button class="btn btn-sm btn-update" style="background-color: #50C878;">Update</button>
                            </td>
                        </tr>
                        <tr data-event="event2">
                            <td>Team C vs Team D</td>
                            <td>2024-08-21 17:00</td>
                            <td class="status-ongoing" style="color: #FFAC1C;">Ongoing</td>
                            <td>
                                <button class="btn btn-sm btn-update" style="background-color: #50C878;">Update</button>
                            </td>
                        </tr>
                        <tr data-event="event3">
                            <td>Team A vs Team C</td>
                            <td>2024-08-22 17:00</td>
                            <td class="status-ongoing" style="color: #FF4433;">Ended</td>
                            <td>
                                <button class="btn btn-sm btn-update" style="background-color: #50C878;">Update</button>
                            </td>
                        </tr>
                        <!-- Additional rows as necessary -->
                    </tbody>
                </table>

                <h4 class="mt-4 mb-3" style="color: #5D3CB8;"><strong> CREATE NEW MATCH</strong></h4>
                <!-- Match Form -->
                <form>
                    <div class="row">
                        <!-- Competing Team 1 -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="team1">Competing Team 1</label>
                                <input type="text" class="form-control" id="team1" placeholder="Enter Team 1 Name">
                            </div>
                        </div>

                        <!-- Date -->
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="date" class="form-control" id="date">
                            </div>
                        </div>

                        <!-- Start Time -->
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="startTime">Start Time</label>
                                <input type="time" class="form-control" id="startTime">
                            </div>
                        </div>

                        <!-- End Time -->
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="endTime">End Time</label>
                                <input type="time" class="form-control" id="endTime">
                            </div>
                        </div>

                        <!-- Group -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="group">Group</label>
                                <input type="text" class="form-control" id="group" placeholder="Enter Group Name">
                            </div>
                        </div>
                    </div>

                    <div class="row align-items-center mt-3">
                        <div class="col-md-1 d-flex justify-content-center">
                            <span class="vs-text">VS</span>
                        </div>
                    </div>

                    <!-- Competing Team 2 and Venue (in a separate row) -->
                    <div class="row align-items-center">
                        <!-- Competing Team 2 -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="team2">Competing Team 2</label>
                                <input type="text" class="form-control" id="team2" placeholder="Enter Team 2 Name">
                            </div>
                        </div>

                        <!-- Venue -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="venue">Venue</label>
                                <input type="text" class="form-control" id="venue" placeholder="Place of The Match">
                            </div>
                        </div>
                    </div>

                    <div class="row form-row-align-right mt-3">
                        <div class="col-md-4">
                            <div class="form-group form-group-margin">
                                <label for="scoringJudge">Scoring Judge</label>
                                <input type="text" class="form-control" id="scoringJudge" placeholder="Enter Scoring Judge Name">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group form-group-margin">
                                <label for="timingJudge">Timing Judge</label>
                                <input type="text" class="form-control" id="timingJudge" placeholder="Enter Timing Judge Name">
                            </div>
                        </div>
                        
                        <div class="col-md-4 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">CREATE MATCH</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Script to handle event selection and table filtering
        document.getElementById('eventSelect').addEventListener('change', function() {
            var selectedEvent = this.value;
            var rows = document.querySelectorAll('#matchTableBody tr');

            rows.forEach(row => {
                if (selectedEvent === 'all' || row.dataset.event === selectedEvent) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
    
    @include('layouts.footer')
</body>
</html>