<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="{{ asset('css/tournamentlist.css') }}" rel="stylesheet">
{{--    <link rel="stylesheet" href="{{asset('https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css')}}">--}}
    <link rel="stylesheet" href="{{ asset('../css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('../css/tournament.css') }}">
    <script src="https://kit.fontawesome.com/771de58f02.js" crossorigin="anonymous"></script>
    <title>Fixture </title>
    <!-- Bootstrap CSS -->
{{--    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">--}}
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .matchschedule {
            text-align: center;
            margin: 10px;
            padding: 10px;
            font-size: 30px;
            color: #333;
            /* font-family: "Open Sans",sans-serif; */
            font-weight: 900;
        }

        .scheduletab1 {
            overflow: auto;
            background-color: #4ccb90;
            border-radius: 50px;
            margin: 0 auto; /* Center the tab container */
            display: flex;
            justify-content: center; /* Center buttons inside the container */
        }

        .scheduletab1 button {
            background-color: inherit;
            flex: 1;
            text-align: center;
            color: #ffffff;
            font-weight: bold;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
            border-radius: 50px;
            
        }

        .scheduletab1 button:hover {
            background-color: #30ad73;
        }

        .scheduletab1 button.active {
            background-color: #30ad73;
        }

        /* .btn-secondary {
            margin-top: 50px;
            margin-bottom: 50px;
        } */

    </style>
    
</head>
<body>
    @include('components.side-nav')
    @include('profile.partials.navbar')

    <!-- Main Content -->
    <div class="container-fluid" style="height: 90%;">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-2">
            </div>

            <!-- Main Match Schedule Section -->
            <div class="col-8">
                
                <div class="d-flex align-items-center mb-3">
                    <button type="button" class="btn btn-secondary " style="background-color: #fff; border: 0;" onclick="history.back()">
                        <i class="fa-solid fa-arrow-left-long" style="color: #000;">BACK</i>
                    </button>
                    <h4 class="matchschedule text-center flex-grow-1 mb-0">MATCH SCHEDULE - {{ $tournament->name }}</h4>
                </div>


                <div class="scheduletab1">
                    <button class="scheduletablinks" onclick="openScheduleGroup(event, 'LIVE')">LIVE</button>
                    <button class="scheduletablinks" onclick="openScheduleGroup(event, 'UPCOMING')" id="defaultScheduleOpen">UPCOMING</button>
                    <button class="scheduletablinks" onclick="openScheduleGroup(event, 'RESULT')">RESULT</button>
                </div>

                <!-- Upcoming Matches -->
                <div class="match-container">
                    <div id="UPCOMING" class="scheduletabcontent mtabcontent">
                        @if($upcomingMatchDetail->isNotEmpty())
                            @foreach($upcomingMatchDetail as $upcoming)
                                <div class="matchtab">
                                    <div class="tabm">
                                        <img src="{{$upcoming['team1']->logoURL}}" alt="{{$upcoming['team1']->name}} Logo" class="teamlogo left">
                                        <div class="matchcontent">
                                            <h3>{{$upcoming['team1']->name}}</h3>
                                            <p>{{$upcoming['team1']->country}}</p>
                                            
                                            <a href="/match/{{$upcoming['upmatch']->id}}" class="lineup-button">Lineup</a>
                                        </div>
                                    </div>

                                    <div class="vs-container">
                                        <div class="vs">vs</div>
                                        <div class="date">{{ \Carbon\Carbon::parse($upcoming['upmatch']->date)->format('d F Y') }}</div>
                                        <div class="time">{{ $upcoming['upmatch']->start_time }}</div>
                                    </div>

                                    <div class="tabm">
                                        <div class="matchcontent">
                                            <h3>{{$upcoming['team2']->name}}</h3>
                                            <p>{{$upcoming['team2']->country}}</p>
                                           
                                            <a href="/match/{{$upcoming['upmatch']->id}}" class="lineup-button">Lineup</a>
                                        </div>
                                        <img src="{{$upcoming['team2']->logoURL}}" alt="{{$upcoming['team2']->name}} Logo" class="teamlogo right">
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>No upcoming matches at the moment.</p>
                        @endif
                    </div>
                </div>

                <!-- Live Matches -->
                <div class="match-container">
                    <div id="LIVE" class="scheduletabcontent mtabcontent">
                        @if($liveMatches->isEmpty())
                            <p>There are no live matches at the moment.</p>
                        @else
                            @foreach ($liveMatchDetails as $detail)
                                <div class="matchtab">
                                    <div class="tabm">
                                        <img src="{{$detail['team1']->logoURL}}" alt="{{$detail['team1']->name}} Logo" class="teamlogo left">
                                        <div class="matchcontent">
                                            <h3>{{$detail['team1']->name}}</h3>
                                            <div class="livescore">{{$detail['match']->score1 ?? '0'}}</div>
                                        </div>
                                    </div>

                                    <div class="vs-container">
                                        <div class="vs">vs</div>
                                        <div class="date">{{ \Carbon\Carbon::parse($upcoming['upmatch']->date)->format('d F Y') }}</div>
                                        <div class="timer">48:00 minutes</div>
                                        <a href="/livematch/{{$detail['match']->id}}" class="lineup-button">Live Score</a>
                                    </div>

                                    <div class="tabm">
                                        <div class="matchcontent">
                                            <h3>{{$detail['team2']->name}}</h3>
                                            <div class="livescore">{{$detail['match']->score2 ?? '0'}}</div>
                                        </div>
                                        <img src="{{$detail['team2']->logoURL}}" alt="{{$detail['team2']->name}} Logo" class="teamlogo right">
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <!-- Result Matches -->
                <div class="match-container">
                    <div id="RESULT" class="scheduletabcontent mtabcontent">
                        @foreach ($resultMatchDetail as $result)
                            <div class="matchtab">
                                <div class="tabm">
                                    <img src="{{$result['team1']->logoURL}}" alt="{{$result['team1']->name}} Logo" class="teamlogo left">
                                    <div class="matchcontent">
                                        <h3>{{$result['team1']->name}}</h3>
                                        <div class="finalscore">{{$result['resultmatch']->score1}}</div>
                                    </div>
                                </div>

                                <div class="vs-container">
                                    <div class="vs">vs</div>
                                </div>

                                <div class="tabm">
                                    <div class="matchcontent">
                                        <h3>{{$result['team2']->name}}</h3>
                                        <div class="finalscore">{{$result['resultmatch']->score2}}</div>
                                    </div>
                                    <img src="{{$result['team2']->logoURL}}" alt="{{$result['team2']->name}} Logo" class="teamlogo right">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/tournament.js') }}"></script>
    <script>
        // Get the modal
        var modal = document.getElementById("registerTeamModal");

        // Get the button that opens the modal
        var btn = document.getElementById("registerTeamBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal
        function openScheduleGroup(evt, groupName) {
            // Hide all tab content
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("scheduletabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            // Remove the active class from all tabs
            tablinks = document.getElementsByClassName("scheduletablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }

            // Show the selected tab's content and mark the tab as active
            document.getElementById(groupName).style.display = "block";
            evt.currentTarget.className += " active";
        }

        // Trigger the default open tab on page load
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("defaultScheduleOpen").click(); // Simulate a click on the default open tab
        });
    </script>

    @include('profile.partials.footer')
</body>

</html>
