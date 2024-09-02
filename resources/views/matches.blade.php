<!DOCTYPE html>
<html lang="en">

<head>
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
        /* Add any additional styling here */
        th {
            color: #5D3CB8;
        }

         /* Table border styling */
         table, th, td {
            border: 1px solid #007bff; /* Change the color to suit your design */
            border-collapse: collapse;
        }

        /* Optional: Padding for table cells */
        th, td {
            padding: 8px;
        }

        /* Specific styling for the "Update" buttons in the table */
        .btn-update {
            background-color: #5D3CB8; /* New color */
            border-color: #5D3CB8;
            color: white;
        }

        .btn-update:hover {
            background-color: #4a2f9c; /* Darker shade on hover */
            border-color: #4a2f9c;
        }

        /* Status colors */
        .status-upcoming {
            color: #00FF87; /* Green color for 'Upcoming' */
        }

        .status-ongoing {
            color: #FFC107; /* Yellow color for 'Ongoing' */
        }

    </style>
</head>

<body>
    @include('layouts.navbar')

    <div class="container-fluid" style="height: 90%; padding: 0;">
        <div class="row">
            <div class="col-3" style="background-color: #929292; width: 15%;">
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
                        <!-- Example rows for different events -->
                        <tr data-event="event1">
                            <td>Team A vs Team B</td>
                            <td>2024-08-20 15:00</td>
                            <td class="status-upcoming">Upcoming</td>
                            <td>
                                <button class="btn btn-sm btn-update">Update</button>
                            </td>
                        </tr>
                        <tr data-event="event2">
                            <td>Team C vs Team D</td>
                            <td>2024-08-21 17:00</td>
                            <td class="status-ongoing">Ongoing</td>
                            <td>
                                <button class="btn btn-sm btn-update">Update</button>
                            </td>
                        </tr>
                        <!-- Additional rows as necessary -->
                    </tbody>
                </table>

                <!-- Match Form -->
                <form>
                    <div class="row mb-3">
                        <div class="form-group col-md-4">
                            <label for="inputTeam1">Competing Team 1</label>
                            <input type="text" class="form-control" id="inputTeam1" placeholder="Enter Team 1 Name">
                        </div>
                        <div class="form-group col-md-2 d-flex align-items-center justify-content-center">
                            <span class="form-label">vs</span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputTeam2">Competing Team 2</label>
                            <input type="text" class="form-control" id="inputTeam2" placeholder="Enter Team 2 Name">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="form-group col-md-3">
                            <label for="inputDate">Date</label>
                            <input type="date" class="form-control" id="inputDate" placeholder="Select Date">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputStartTime">Start Time</label>
                            <input type="time" class="form-control" id="inputStartTime" placeholder="Start Time">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputEndTime">End Time</label>
                            <input type="time" class="form-control" id="inputEndTime" placeholder="End Time">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputGroup">Group</label>
                            <input type="text" class="form-control" id="inputGroup" placeholder="Enter Group Name">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="form-group col-md-6">
                            <label for="inputVenue">Venue</label>
                            <input type="text" class="form-control" id="inputVenue" placeholder="Enter Venue">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="form-group col-md-6">
                            <label for="inputScoringJudging">Scoring Judging</label>
                            <input type="text" class="form-control" id="inputScoringJudging" placeholder="Enter Scoring Judging Name">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputTimingJudging">Timing Judging</label>
                            <input type="text" class="form-control" id="inputTimingJudging" placeholder="Enter Timing Judging Name">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

        </div>
    </div>

    @include('layouts.footer')

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
</body>
</html>
