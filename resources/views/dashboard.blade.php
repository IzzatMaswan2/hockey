<!DOCTYPE html>
<html lang="en">

<head>
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

        .article-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .article-card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
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
                <div class="container-fluid">
                    <h2>Welcome, {{ Auth::user()->name }}</h2>

                                        <!-- Dashboard Cards -->
                    <div class="row custom-row" style="display: flex;">
                        <div class="col-md-4">
                            <div class="card" style="background-color: #5D3CB8; margin: 10px;">
                                <div class="card-body">
                                    <h5 class="card-title" style="color: #fff;"><i class="fas fa-users"></i> {{ $total_player }}</h5>
                                    <p class="card-text">PLAYERS</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card" style="background-color: #5D3CB8; margin: 10px;">
                                <div class="card-body">
                                    <h5 class="card-title" style="color: #fff;"><i class="fas fa-flag"></i> {{ $teamsCount }} </h5>
                                    <p class="card-text">TEAMS</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card" style="background-color: #5D3CB8; margin: 10px;">
                                <div class="card-body">
                                    <h5 class="card-title" style="color: #fff;"><i class="fas fa-user-tie"></i> {{ $managersCount }}</h5>
                                    <p class="card-text">MANAGERS</p>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Statistics and Extra Cards -->
                    <div class="container">
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

                            <div class="col-md-6 d-flex flex-wrap">
                                <div class="col-12 col-sm-6">
                                    <div class="card" style="background-color: #fff; margin: 10px;">
                                        <div class="card-body d-flex align-items-center">
                                            <img src="img/goalicon.png" alt="" style="width: 50px; height: 50px; margin-right: 10px;">
                                            <div>
                                                <h5 class="card-title" style="color: #000; font-size: 1.5rem; margin: 0;">{{ $goalsScored }}</h5>
                                                <p class="card-text" style="margin: 0;">Goals Scored</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6">
                                    <div class="card" style="background-color: #fff; margin: 10px;">
                                        <div class="card-body d-flex align-items-center">
                                            <img src="img/stickhoki.png" alt="" style="width: 50px; height: 50px; margin-right: 10px;">
                                            <div>
                                                <h5 class="card-title" style="color: #000; font-size: 1.5rem; margin: 0;">{{ $penaltyCorner }}</h5>
                                                <p class="card-text" style="margin: 0; font-size: 15px;">Penalty Corner Goals</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Additional Cards -->
                                <div class="col-12">
                                    <div class="card mb-3">
                                        <div class="card-body d-flex align-items-center">
                                            <img src="img/red.png" alt="" style="width: 20px; height: 30px; margin-right: 10px;">
                                            <div class="d-flex justify-content-between w-100">
                                                <span>Red Card</span>
                                                <span style="font-weight: bold; font-size: 1.5rem;">{{ $totalRedCards }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mb-3">
                                        <div class="card-body d-flex align-items-center">
                                            <img src="img/yellow.png" alt="" style="width: 20px; height: 30px; margin-right: 10px;">
                                            <div class="d-flex justify-content-between w-100">
                                                <span>Yellow Card</span>
                                                <span style="font-weight: bold; font-size: 1.5rem;">{{ $totalYellowCards }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mb-3">
                                        <div class="card-body d-flex align-items-center">
                                            <img src="img/green.png" alt="" style="width: 20px; height: 30px; margin-right: 10px;">
                                            <div class="d-flex justify-content-between w-100">
                                                <span>Green Card</span>
                                                <span style="font-weight: bold; font-size: 1.5rem;">{{ $totalGreenCards }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Standings Card -->
                    <div class="col-8" style="width: 100%;">
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
                                        @foreach($group as $team)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>
                                                <img src="img/hokit1.png" alt="Team A Logo" style="width: 30px; height: 30px; margin-right: 10px;">
                                                {{$team->team_id}}
                                            </td>
                                            <td>{{$team->points}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Article Card -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card mb-3 article-card">
                                <div class="card-header">Latest Articles</div>
                                <div class="card-body">
                                    <img src="img/hoki1.PNG" class="card-img-top" alt="Hockey Championship Image">
                                    <h5 class="card-title mt-3"><i class="fas fa-newspaper"></i> Hockey Championship</h5>
                                    <p class="card-text">
                                        Check out the latest news on the upcoming hockey championship. Stay informed about team preparations, key players to watch, and more!
                                    </p>
                                    <a href="#" class="btn btn-primary">Read More</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card mb-3 article-card">
                                <div class="card-header">Latest Articles</div>
                                <div class="card-body">
                                    <img src="img/assist.png" class="card-img-top" alt="Player Spotlight Image">
                                    <h5 class="card-title mt-3"><i class="fas fa-newspaper"></i> Player Spotlight: John Doe</h5>
                                    <p class="card-text">
                                        Discover the journey of John Doe, a rising star in the world of hockey. Learn about his training regimen, achievements, and future goals.
                                    </p>
                                    <a href="#" class="btn btn-primary">Read More</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card mb-3 article-card">
                                <div class="card-header">Latest Articles</div>
                                <div class="card-body">
                                    <img src="img/hoki3.PNG" class="card-img-top" alt="Top 10 Moments Image">
                                    <h5 class="card-title mt-3"><i class="fas fa-newspaper"></i> Top 10 Moments in Hockey History</h5>
                                    <p class="card-text">
                                        Relive the most unforgettable moments in hockey history. From legendary goals to game-changing plays, here are the top 10 highlights.
                                    </p>
                                    <a href="#" class="btn btn-primary">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Sidebar -->
            <div class="col-2" style="background-color: #929292; width: 20%;">
                <div class="card mt-3">
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

    <!-- Chart Initialization -->
    <script>
    $(document).ready(function() {
        var donutChart = echarts.init(document.getElementById('donut'));

        // Use the data passed from the controller
        var wins = {{ $wins }};
        var losses = {{ $losses }};
        var draws = {{ $draws }};

        var donutOptions = {
            tooltip: {
                trigger: 'item'
            },
            legend: {
                orient: 'vertical',
                left: 'left'
            },
            series: [
                {
                    name: 'Statistics',
                    type: 'pie',
                    radius: ['50%', '70%'],
                    avoidLabelOverlap: false,
                    label: {
                        show: false,
                        position: 'center'
                    },
                    emphasis: {
                        label: {
                            show: true,
                            fontSize: '30',
                            fontWeight: 'bold'
                        }
                    },
                    labelLine: {
                        show: false
                    },
                    data: [
                        { value: wins, name: 'Wins', itemStyle: { color: '#31d58d' } },
                        { value: losses, name: 'Losses', itemStyle: { color: '#ed1d1a' } },
                        { value: draws, name: 'Draws', itemStyle: { color: '#f7a409' } }
                    ]
                }
            ]
        };

        donutChart.setOption(donutOptions);
    });
</script>
    <!-- Footer -->
    @include('layouts.footer')
</body>
</html>
