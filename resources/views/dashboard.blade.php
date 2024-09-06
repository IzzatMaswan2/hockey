<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Dashboard</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/771de58f02.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.2.2/dist/echarts.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        #donut {
            width: 100%;
            height: 100%;
            min-height: 300px; /* Minimum height for better visibility on smaller screens */
        }

        .chart-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
        }

        .container-fluid {
            padding: 0;
        }

        .custom-row {
            margin-left: -50px;
            margin-right: -50px;
        }
    </style>
</head>

<body style="background-color: #f4f7f6;">

    <!-- Navbar -->
    @include('layouts.navbar')
    <!-- Main Content -->
    <div class="container-fluid" style="width: 100%; height: 90%;">
        <div class="row">
            <div class="col-2" style="background-color: #929292; width: 20%;">
                @include('layouts.sidebar')
            </div>
            <div class="col-8" style="width: 80%;">
                <div class="container-fluid">
                    <h2>Welcome, {{ Auth::user()->name }}</h2>
                    <div class="row custom-row" style="display: flex;">
                        <div class="col-md-4">
                            <div class="card" style="background-color: #5D3CB8; margin: 10px;">
                                <div class="card-body">
                                    <h5 class="card-title" style="color: #fff;"><i class="fas fa-users"></i> 100</h5>
                                    <p class="card-text">PLAYERS</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card" style="background-color: #5D3CB8;margin: 10px;">
                                <div class="card-body">
                                    <h5 class="card-title" style="color: #fff;"><i class="fas fa-flag"></i> 30</h5>
                                    <p class="card-text">TEAMS</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card" style="background-color: #5D3CB8; margin: 10px;">
                                <div class="card-body">
                                    <h5 class="card-title" style="color: #fff;"><i class="fas fa-user-tie"></i> 30</h5>
                                    <p class="card-text">MANAGERS</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-header">Statistics</div>
                                <div class="card-body">
                                    <div class="chart-container">
                                        <div id="donut"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Standings Card -->
                        <div class="col-md-4">
                            <div class="card mb-3">
                                <div class="card-header">Team Standings</div>
                                <div class="card-body">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Rank</th>
                                                <th>Team</th>
                                                <th>Points</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Team A</td>
                                                <td>30</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Team B</td>
                                                <td>27</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Team C</td>
                                                <td>24</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Team D</td>
                                                <td>21</td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>Team E</td>
                                                <td>18</td>
                                            </tr>
                                            <tr>
                                                <td>6</td>
                                                <td>Team F</td>
                                                <td>15</td>
                                            </tr>
                                            <tr>
                                                <td>7</td>
                                                <td>Team G</td>
                                                <td>12</td>
                                            </tr>
                    
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Article Card -->
                        <div class="col-md-4">
                            <div class="card mb-3">
                                <div class="card-header">Latest Articles</div>
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fas fa-newspaper"></i> Hockey Championship</h5>
                                    <p class="card-text">
                                        Check out the latest news on the upcoming hockey championship. Stay informed about team preparations, key players to watch, and more!
                                    </p>
                                    <a href="#" class="btn btn-primary">Read More</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="card mb-3">
                                <div class="card-header">Recent Activity</div>
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fas fa-calendar-alt"></i> UPCOMING MATCH</h5>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex flex-column align-items-center">
                                            <img src="img/hokit1.png" alt="Team A Logo" style="width: 50px; height: 50px; margin-right: 10px;">
                                            <strong>Team A</strong>
                                        </div>
                                        <div style="margin: 0 10px;">vs</div>
                                        <div class="d-flex flex-column align-items-center">
                                            <img src="img/hokit2.png" alt="Team B Logo" style="width: 50px; height: 50px;">
                                            <strong>Team B</strong>
                                        </div>
                                    </div>
                                    <p class="card-text mt-3">
                                        Date: August 15, 2024<br>
                                        Time: 7:00 PM<br>
                                        Venue: National Arena, City
                                    </p>
                                    <h5 class="card-title"><i class="fas fa-history"></i> LAST MATCH</h5>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex flex-column align-items-center">
                                            <img src="img/hokit3.png" alt="Team C Logo" style="width: 50px; height: 50px; margin-right: 10px;">
                                            <strong>Team C</strong>
                                        </div>
                                        <div style="margin: 0 10px;">2 - 3</div>
                                        <div class="d-flex flex-column align-items-center">
                                            <img src="img/hokit4.png" alt="Team D Logo" style="width: 50px; height: 50px;">
                                            <strong>Team D</strong>
                                        </div>
                                    </div>
                                    <p class="card-text mt-3">
                                        Date: August 10, 2024<br>
                                        Venue: National Arena, City
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Initialize the chart on the element with ID 'donut'
            const chart = echarts.init(document.getElementById("donut"));

            // Define the chart options for a donut chart
            const option = {
                title: {
                    text: 'Match Outcomes',
                    left: 'center'
                },
                tooltip: {
                    trigger: 'item'
                },
                legend: {
                    orient: 'vertical',
                    left: 'left'
                },
                series: [
                    {
                        name: 'Match Outcomes',
                        type: 'pie',
                        radius: ['50%', '70%'],  // Inner radius makes it a donut chart
                        avoidLabelOverlap: false,
                        label: {
                            show: false,
                            position: 'center'
                        },
                        emphasis: {
                            label: {
                                show: true,
                                fontSize: '20',
                                fontWeight: 'bold'
                            }
                        },
                        labelLine: {
                            show: false
                        },
                        data: [
                            { value: 40, name: 'Wins', itemStyle: { color: '#31d58d' } },
                            { value: 30, name: 'Losses', itemStyle: { color: '#ed1d1a' } },
                            { value: 30, name: 'Draws', itemStyle: { color: '#f7a409' } }
                        ]
                    }
                ]
            };

            // Set the chart option to display the chart
            chart.setOption(option);

            // Resize chart on window resize
            window.addEventListener('resize', () => {
                chart.resize();
            });
        </script>

        <!-- Footer -->
        @include('layouts.footer')

    </body>
</html>
