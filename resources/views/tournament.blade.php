<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <!-- Link to Bootstrap CSS and your custom CSS -->
    <link rel="stylesheet" href="{{asset('https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"> 
    <link rel="stylesheet" href="{{ asset('css/home.css') }}"> 
    <link rel="stylesheet" href="{{ asset('css/tournament.css') }}"> 
    <link rel="stylesheet" href="{{ asset('css/about.css') }}"> 
    <link rel="stylesheet" href="{{ asset('css/loginstyles.css') }}"> 
    <link rel="stylesheet" href="{{ asset('css/match.css') }}">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css"rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="js/faq.js"></script>
</head>
<body>
    @include('components.side-nav')
    @include('profile.partials.navbar')
    <div class="main-content">
        <h1 class="tournament-heading">TOURNAMENT LEADERBOARD</h1>
    </div>
    <main>
        <div class="tournament-bracket zoom-in">
            <div class="container-tour">
                    <div class="roundquarter">
                    <div class="round-details">QUARTERFINALS<br /></div>
                        <ul class="matchup">Quater 1
                            <li class="team team-top">Winner Group A <span class="score">4</span></li>
                            <li class="team team-bottom">Winner Group B<span class="score">2</span></li>
                        </ul>
                        <div class="match-lines">
                            <div class="line-one"></div>
                            <div class="line-two"></div>
                            <div class="line-one"></div>
                        </div>
                        <div class="match-lines5">
                            <div class="line-one"></div>
                        </div>
                        <ul class="matchup">Quater 2
                            <li class="team team-top">Winner Group C (C)<span class="score">1</span></li>
                            <li class="team team-bottom">Winner Group D (D)<span class="score">0</span></li>
                        </ul>
                        <div class="match-lines2">
                            <div class="line-one"></div>
                            <div class="line-two"></div>
                            <div class="line-one"></div>
                        </div>
                        <div class="match-lines6">
                            <div class="line-one"></div>
                        </div>
                        <ul class="matchup">Quater 3
                            <li class="team team-top">Winner Group E (E)<span class="score">4</span></li>
                            <li class="team team-bottom">Winner Group F (F)<span class="score">2</span></li>
                        </ul>
                        <div class="match-lines3">
                            <div class="line-one"></div>
                            <div class="line-two"></div>
                            <div class="line-one"></div>
                        </div>
                        <div class="match-lines7">
                            <div class="line-one"></div>
                        </div>
                        <ul class="matchup">Quater 1
                            <li class="team team-top">Winner Group G (G)<span class="score">3</span></li>
                            <li class="team team-bottom">Winner Group H (H)<span class="score">0</span></li>
                        </ul>
                        <div class="match-lines4">
                            <div class="line-one"></div>
                            <div class="line-two"></div>
                            <div class="line-one"></div>
                        </div>
                        <div class="match-lines8">
                            <div class="line-one"></div>
                        </div>
                    </div> <!-- END quarter -->



                <div class="roundsemi">
                    <div class="round-details">SEMIFINAL</div>
                    <ul class="matchup semifinal"> SEMIFINAL 1
                        <li class="team team-top">Group A Winner (A)<span class="score">2</span></li><div class="semispace"></div>
                        <li class="team team-bottom">Group B Winner (C)<span class="score">1</span></li>
                    </ul><div class="semispace2"></div>
                    <div class="champ-lines">
                        <div class="line-one"></div>
                        <div class="line-two"></div>
                        <div class="line-one"></div>
                    </div>
                    <div class="champ-lines2">
                        <div class="line-one"></div>
                    </div>
                    <ul class="matchup semifinal">SEMIFINAL 2
                        <li class="team team-top">Group A Winner (E)<span class="score">2</span></li><div class="semispace3"></div>
                        <li class="team team-bottom">Group B Winner (G)<span class="score">1</span></li>
                    </ul>
                    <div class="champ-lines3">
                        <div class="line-one"></div>
                        <div class="line-two"></div>
                        <div class="line-one"></div>
                    </div>
                    <div class="champ-lines4">
                        <div class="line-one"></div>
                    </div>
                </div> <!-- END semifinal -->

                <div class="roundchampion">
                    <div class="round-details">FINALE</div>
                    <ul class="matchupchampion">
                        <li class="team team-top">Group A Winner (A)<span class="score">2</span></li><div class="champspace"></div>
                        <li class="team team-bottom">Group B Winner (E)<span class="score">1</span></li>
                    </ul>
                    <div class="winner-lines">
                        <div class="line-one"></div>
                        <div class="line-two"></div>
                        <div class="line-one"></div>
                    </div>
                    <div class="winner-lines2">
                        <div class="line-one"></div>
                    </div>
                
                </div>

                <div class="champion">
                    <div class="round-details">CHAMPION</div>
                    <ul class="winnerchampion">
                        <li class="team team-top"> <span style="color: red; text-align:center; font-weight:bold;">Winner</span> <br> Group A</li>
                    </ul>
                </div>
                <!-- END CHAMPION -->
                </div> <!-- END SPLIT TWO -->
            </div> <!-- END CONTAINER -->

        <div class="tab-container">
            <div class="tab">
                <button class="tablinks" onclick="openGroup(event, 'GroupA')" id="defaultOpen">Group A</button>
                <button class="tablinks" onclick="openGroup(event, 'GroupB')">Group B</button>
                <button class="tablinks" onclick="openGroup(event, 'GroupC')">Group C</button>
                <button class="tablinks" onclick="openGroup(event, 'GroupD')">Group D</button>
                <button class="tablinks" onclick="openGroup(event, 'GroupE')">Group E</button>
                <button class="tablinks" onclick="openGroup(event, 'GroupF')">Group F</button>
                <button class="tablinks" onclick="openGroup(event, 'GroupG')">Group G</button>
                <button class="tablinks" onclick="openGroup(event, 'GroupH')">Group H</button>
            </div>
        </div>

        <div id="GroupA" class="tabcontent group-table">
            <table>
                <thead>
                    <tr>
                        <th>Rank</th>
                        <th>Team</th>
                        <th>Play</th>
                        <th>Win</th>
                        <th>Draw</th>
                        <th>Lose</th>
                        <th>Result</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Team A</td>
                        <td>2</td>
                        <td>2</td>
                        <td>0</td>
                        <td>1</td>
                        <td>+3</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Team B</td>
                        <td>3</td>
                        <td>2</td>
                        <td>1</td>
                        <td>1</td>
                        <td>+2</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Team C</td>
                        <td>2</td>
                        <td>1</td>
                        <td>0</td>
                        <td>2</td>
                        <td>-1</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Team D</td>
                        <td>1</td>
                        <td>0</td>
                        <td>0</td>
                        <td>3</td>
                        <td>-4</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div id="GroupB" class="tabcontent group-table">
            <table>
                <thead>
                    <tr>
                        <th>Rank</th>
                        <th>Team</th>
                        <th>Play</th>
                        <th>Win</th>
                        <th>Draw</th>
                        <th>Lose</th>
                        <th>Result</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Team A</td>
                        <td>3</td>
                        <td>3</td>
                        <td>0</td>
                        <td>1</td>
                        <td>+3</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Team B</td>
                        <td>3</td>
                        <td>1</td>
                        <td>0</td>
                        <td>1</td>
                        <td>+2</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Team C</td>
                        <td>3</td>
                        <td>1</td>
                        <td>1</td>
                        <td>2</td>
                        <td>-1</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Team D</td>
                        <td>1</td>
                        <td>0</td>
                        <td>0</td>
                        <td>3</td>
                        <td>-4</td>
                    </tr>
                </tbody>
            </table>
        </div>


        <div id="GroupC" class="tabcontent group-table">
            <table>
                <thead>
                    <tr>
                        <th>Rank</th>
                        <th>Team</th>
                        <th>Play</th>
                        <th>Win</th>
                        <th>Draw</th>
                        <th>Lose</th>
                        <th>Result</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Team A</td>
                        <td>2</td>
                        <td>2</td>
                        <td>0</td>
                        <td>1</td>
                        <td>+3</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Team B</td>
                        <td>3</td>
                        <td>2</td>
                        <td>0</td>
                        <td>2</td>
                        <td>+2</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Team C</td>
                        <td>3</td>
                        <td>1</td>
                        <td>0</td>
                        <td>3</td>
                        <td>-1</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Team D</td>
                        <td>3</td>
                        <td>0</td>
                        <td>0</td>
                        <td>2</td>
                        <td>-4</td>
                    </tr>
                </tbody>
            </table>
        </div>


        <div id="GroupD" class="tabcontent group-table">
            <table>
                <thead>
                    <tr>
                        <th>Rank</th>
                        <th>Team</th>
                        <th>Play</th>
                        <th>Win</th>
                        <th>Draw</th>
                        <th>Lose</th>
                        <th>Result</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Team A</td>
                        <td>2</td>
                        <td>2</td>
                        <td>0</td>
                        <td>1</td>
                        <td>+3</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Team B</td>
                        <td>3</td>
                        <td>2</td>
                        <td>0</td>
                        <td>2</td>
                        <td>+2</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Team C</td>
                        <td>3</td>
                        <td>1</td>
                        <td>0</td>
                        <td>2</td>
                        <td>-1</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Team D</td>
                        <td>3</td>
                        <td>0</td>
                        <td>1</td>
                        <td>3</td>
                        <td>-4</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div id="GroupE" class="tabcontent group-table">
            <table>
                <thead>
                    <tr>
                        <th>Rank</th>
                        <th>Team</th>
                        <th>Play</th>
                        <th>Win</th>
                        <th>Draw</th>
                        <th>Lose</th>
                        <th>Result</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Team A</td>
                        <td>1</td>
                        <td>2</td>
                        <td>0</td>
                        <td>1</td>
                        <td>+3</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Team B</td>
                        <td>3</td>
                        <td>2</td>
                        <td>0</td>
                        <td>1</td>
                        <td>+2</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Team C</td>
                        <td>3</td>
                        <td>1</td>
                        <td>0</td>
                        <td>2</td>
                        <td>-1</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Team D</td>
                        <td>3</td>
                        <td>1</td>
                        <td>0</td>
                        <td>3</td>
                        <td>-4</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div id="GroupF" class="tabcontent group-table">
            <table>
                <thead>
                    <tr>
                        <th>Rank</th>
                        <th>Team</th>
                        <th>Play</th>
                        <th>Win</th>
                        <th>Draw</th>
                        <th>Lose</th>
                        <th>Result</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Team A</td>
                        <td>2</td>
                        <td>2</td>
                        <td>0</td>
                        <td>1</td>
                        <td>+3</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Team B</td>
                        <td>2</td>
                        <td>2</td>
                        <td>0</td>
                        <td>1</td>
                        <td>+2</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Team C</td>
                        <td>3</td>
                        <td>3</td>
                        <td>0</td>
                        <td>2</td>
                        <td>-1</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Team D</td>
                        <td>3</td>
                        <td>1</td>
                        <td>0</td>
                        <td>3</td>
                        <td>-4</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div id="GroupG" class="tabcontent group-table">
            <table>
                <thead>
                    <tr>
                        <th>Rank</th>
                        <th>Team</th>
                        <th>Play</th>
                        <th>Win</th>
                        <th>Draw</th>
                        <th>Lose</th>
                        <th>Result</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Team A</td>
                        <td>1</td>
                        <td>1</td>
                        <td>0</td>
                        <td>1</td>
                        <td>+3</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Team B</td>
                        <td>3</td>
                        <td>2</td>
                        <td>0</td>
                        <td>1</td>
                        <td>+2</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Team C</td>
                        <td>3</td>
                        <td>1</td>
                        <td>0</td>
                        <td>2</td>
                        <td>-1</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Team D</td>
                        <td>3</td>
                        <td>1</td>
                        <td>1</td>
                        <td>3</td>
                        <td>-4</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div id="GroupH" class="tabcontent group-table">
            <table>
                <thead>
                    <tr>
                        <th>Rank</th>
                        <th>Team</th>
                        <th>Play</th>
                        <th>Win</th>
                        <th>Draw</th>
                        <th>Lose</th>
                        <th>Result</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Team A</td>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                        <td>+3</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Team B</td>
                        <td>3</td>
                        <td>2</td>
                        <td>4</td>
                        <td>1</td>
                        <td>+2</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Team C</td>
                        <td>3</td>
                        <td>2</td>
                        <td>3</td>
                        <td>2</td>
                        <td>-1</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Team D</td>
                        <td>3</td>
                        <td>1</td>
                        <td>2</td>
                        <td>3</td>
                        <td>-4</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <h1 class="matchschedule-heading">MATCH SCHEDULE</h1>

        <div class="scheduletab">
            <button class="scheduletablinks" onclick="openScheduleGroup(event, 'UPCOMING')" id="defaultScheduleOpen">UPCOMING</button>
            <button class="scheduletablinks" onclick="openScheduleGroup(event, 'LIVE')">LIVE</button>
            <button class="scheduletablinks" onclick="openScheduleGroup(event, 'RESULT')">RESULT</button>
        </div>
        
        <div class="match-container">
            <div id="UPCOMING" class="scheduletabcontent mtabcontent">
                @foreach($upcomingMatchDetail as $upcoming)
                    <div class="matchtab">
                        <div class="tabm">
                            <img src="{{$upcoming['teamA']->logoURL}}" alt="{{$upcoming['teamA']->Name}} Logo" class="teamlogo left">
                            <div class="matchcontent">
                                <h3>{{$upcoming['teamA']->Name}}</h3>
                                <p>{{$upcoming['teamA']->country}}</p>
                                <p>Rating: 97%</p>
                                <a href="/match/{{$upcoming['upmatch']->Match_groupID}}" class="lineup-button">Lineup</a>
                            </div>
                        </div>

                        <div class="vs-container">
                            <div class="vs">vs</div>
                            <div class="date">{{$upcoming['upmatch']->Date}}</div>
                            <div class="time">08:00am - 09:00</div>
                        </div>

                        <div class="tabm">
                            <div class="matchcontent">
                                <h3>{{$upcoming['teamB']->Name}}</h3>
                                <p>{{$upcoming['teamB']->country}}</p>
                                <p>Rating: 93%</p>
                                <a href="/match/{{$upcoming['upmatch']->Match_groupID}}" class="lineup-button">Lineup</a>
                            </div>
                            <img src="{{$upcoming['teamB']->logoURL}}" alt="{{$upcoming['teamA']->Name}} Logo" class="teamlogo right">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

            <div id="LIVE" class="scheduletabcontent mtabcontent">
                @if($liveMatches->isEmpty())
                    <p>There No Match At the Moment</p>
                @else
                    @foreach ($liveMatchDetails as $detail)
                        <div class="matchtab">
                            <div class="tabm">
                                <!-- Display Team A -->
                                <img src="{{$detail['teamA']->logoURL}}" alt="{{$detail['teamA']->Name}} Logo" class="teamlogo left">
                                <div class="matchcontent">
                                    <h3>{{$detail['teamA']->Name}}</h3>
                                    <!-- Display live score for Team A -->
                                    <div class="livescore">{{$detail['match']->ScoreA ?? 'N/A'}}</div>
                                </div>
                            </div>
                
                            <div class="vs-container">
                                <div class="vs">vs</div>
                                <div class="timer">48:00 minutes</div> 
                                <a href="/livematch/{{$detail['match']->Match_groupID}}" class="lineup-button">Live Score</a>
                            </div>
                
                            <div class="tabm">
                                <div class="matchcontent">
                                    <!-- Display Team B -->
                                    <h3>{{$detail['teamB']->Name}}</h3>
                                    <!-- Display live score for Team B -->
                                    <div class="livescore">{{$detail['match']->ScoreB ?? 'N/A' }}</div>
                                </div>
                                <img src="{{$detail['teamB']->logoURL}}" alt="{{$detail['teamB']->Name}} Logo" class="teamlogo right">
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            
            <div id="RESULT" class="scheduletabcontent mtabcontent">
                @foreach ($resultMatchDetail as $result)
                    <div class="matchtab">
                        <div class="tabm">
                            <img src="{{$result['teamA']->logoURL}}" alt="{{$result['teamA']->Name}} Logo" class="teamlogo left">
                            <div class="matchcontent">
                                <h3>{{$result['teamA']->Name}}</h3>
                                <div class="finalscore">{{$result['resultmatch']->ScoreA}}</div>
                            </div>
                        </div>
                        
                        <div class="vs-container">
                            <div class="vs">vs</div>
                        </div>
            
                        
                        <div class="tabm">
                            <div class="matchcontent">
                                <h3>{{$result['teamB']->Name}}</h3>
                                <div class="finalscore">{{$result['resultmatch']->ScoreB}}</div>
                            </div>
                            <img src="{{$result['teamB']->logoURL}}" alt="{{$result['teamB']->Name}} Logo" class="teamlogo right">
                        </div>
                    </div>
                @endforeach

            </div>
        </div>

    </main>
    <script src="{{ asset('js/tournament.js') }}"></script>
    @include('profile.partials.footer')

</body>

