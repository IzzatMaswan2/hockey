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
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Bootstrap Bundle (includes Popper) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<title>Admin Dashboard</title>
{{--    <link rel="icon" href="../img/Logo.png" type="image/icon type">--}}
    <link rel="icon" href="{{ asset('img/Logo Latest 1.png') }}" type="image/icon type">


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
                    <h2>Welcome, Admin {{ Auth::user()->fullName }}</h2>

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
                                <div class="row">
                                    <div class="col-6 col-sm-6">
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
    
                                    <div class="col-6 col-sm-6">
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
                    <div class="col-12" style="width: 100%;">
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
                                        @foreach($groupData['team'] as $index => $group)
                                            <tr>
                                                <td>{{ $index + 1 }}</td> <!-- Rank based on index -->
                                                <td>
{{--                                                    <img src="{{ $group->team->LogoURL }}" alt="{{ $group->team->name }} Logo" style="width: 30px; height: 30px; margin-right: 10px;">--}}
                                                    <img src="{{ !empty($group->team) && !empty($group->team->LogoURL) ? asset('storage/' . $group->team->LogoURL) : asset('images/default-team.png') }}" alt="{{ $group->team->name ?? 'TBA' }} Logo" style="width: 30px; height: 30px; margin-right: 10px;">
                                                    {{ $group->team->name ?? 'TBA'}}
                                                </td>
                                                <td>{{ $group->points }}</td> <!-- Points from group -->
                                                <!-- <td>{{ $group->gd ?? 0 }}</td> Goal difference from group -->
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Article Card -->
                    <div class="row">
                        @foreach($recentArticles as $article)
                            <div class="col-md-4">
                                <div class="card mb-3 article-card">
                                    <div class="card-header">Latest Articles</div>
                                    <div class="card-body">
                                        <img src="{{ asset('storage/' . $article->image) }}" class="card-img-top" alt="{{ $article->title }} Image">
                                        <h5 class="card-title mt-3"><i class="fas fa-newspaper"></i> {{ $article->title }}</h5>
                                        <p class="card-text">
                                            {{ $article->summary }}
                                        </p>
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#articleModal{{ $article->id }}">
                                            Read More
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="articleModal{{ $article->id }}" tabindex="-1" role="dialog" aria-labelledby="articleModalLabel{{ $article->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="articleModalLabel{{ $article->id }}">{{ $article->title }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="{{ asset('storage/' . $article->image) }}" class="img-fluid mb-3" alt="{{ $article->title }} Image">
                                            <p style="white-space: pre-wrap;">{{ $article->content }}</p> <!-- Full content of the article -->
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Right Sidebar -->
{{--            <div class="col-2" style="background-color: #929292; width: 20%;">--}}
{{--                <div class="card mt-3">--}}
{{--                    <div class="card-header">Recent Activity</div>--}}
{{--                    <div class="card-body">--}}
{{--                    <h5 class="card-title"><i class="fas fa-calendar-alt"></i> UPCOMING MATCHES</h5>--}}

{{--                    @if($upcomingMatch)--}}
{{--                        <div class="d-flex align-items-center">--}}
{{--                            <div class="d-flex flex-column align-items-center">--}}
{{--                                <img src="{{ asset('img/' . $upcomingMatch->team1->logo) }}" alt="{{ $upcomingMatch->team1->name }} Logo" style="width: 50px; height: 50px; margin-right: 10px;">--}}
{{--                                <strong>{{ $upcomingMatch->team1->name }}</strong>--}}
{{--                            </div>--}}
{{--                            <div style="margin: 0 10px;">vs</div>--}}
{{--                            <div class="d-flex flex-column align-items-center">--}}
{{--                                <img src="{{ asset('img/' . $upcomingMatch->team2->logo) }}" alt="{{ $upcomingMatch->team2->name }} Logo" style="width: 50px; height: 50px;">--}}
{{--                                <strong>{{ $upcomingMatch->team2->name }}</strong>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <p class="card-text mt-3">--}}
{{--                            Date: {{ \Carbon\Carbon::parse($upcomingMatch->date)->format('F j, Y') }}<br>--}}
{{--                            Time: {{ $upcomingMatch->start_time }}<br>--}}
{{--                            Venue: {{ $upcomingMatch->venue->name }}--}}
{{--                        </p>--}}
{{--                    @else--}}
{{--                        <p>No upcoming matches at the moment.</p>--}}
{{--                    @endif--}}


{{--                        <h5 class="card-title"><i class="fas fa-history"></i> LAST MATCH</h5>--}}
{{--                        <div class="d-flex align-items-center">--}}
{{--                            <div class="d-flex flex-column align-items-center">--}}
{{--                                <img src="{{ asset('img/' . $match->teamA_logo) }}" alt="{{ $match->teamA_name }} Logo" style="width: 50px; height: 50px; margin-right: 10px;">--}}
{{--                                <strong>{{ $match->teamA->name ?? 'TBA' }}</strong>--}}
{{--                            </div>--}}
{{--                            <div style="margin: 5px;">{{ $match->ScoreA }} - {{ $match->ScoreB }}</div>--}}
{{--                            <div class="d-flex flex-column align-items-center">--}}
{{--                                <img src="{{ asset('img/' . $match->teamB_logo) }}" alt="{{ $match->teamB_name }} Logo" style="width: 50px; height: 50px;">--}}
{{--                                <strong>{{ $match->teamB->name  ?? 'TBA' }}</strong>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <p class="card-text mt-3">--}}
{{--                            Date: {{ \Carbon\Carbon::parse($match->Date)->format('F d, Y') }}<br>--}}
{{--                            Venue: {{ $match->Venue }}--}}
{{--                        </p>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

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
    @include('layouts.footer')
</body>
</html>
