<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Match</title>
    <!-- Link to Bootstrap CSS and your custom CSS -->
    <link rel="stylesheet" href="{{asset('https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"> 
    <link rel="stylesheet" href="{{ asset('css/match.css') }}"> 
    <link rel="stylesheet" href="{{ asset('css/tournament.css') }}"> 
    
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
        <h1 class="tournament-heading">MATCH CENTER</h1>
    </div>

<div class="match-container">
    <div class="matchtab">
        <div class="tabm">
            <img src="{{asset($liveMatchDetails['teamA']->logoURL)}}" alt="{{$liveMatchDetails['teamA']->Name}}Logo" class="teamlogo left">
            <div class="matchcontent">
                <h3>{{$liveMatchDetails['teamA']->Name}}</h3>
                <div class="finalscore">{{$liveMatchDetails['match']->ScoreA ?? 'N/A'}}</div>
            </div>
        </div>
        
        <div class="vs-container">
            <div class="vs">vs</div>
        </div>
        
        <div class="tabm">
            <div class="matchcontent">
                <h3>{{$liveMatchDetails['teamB']->Name}}</h3>
                <div class="finalscore">{{$liveMatchDetails['match']->ScoreB ?? 'N/A'}}</div>
            </div>
            <img src="{{asset($liveMatchDetails['teamB']->logoURL)}}" alt="{{$liveMatchDetails['teamB']->Name}}Logo" class="teamlogo right">
        </div>
    </div>
</div>

    <div class="schelduleALL">
        <div class="scheduletab">
            <button class="scheduletablinks" onclick="openScheduleGroup(event, 'LINEUP')" id="defaultScheduleOpen">LINEUP</button>
            <button class="scheduletablinks" onclick="openScheduleGroup(event, 'STAT')" id="defaultScheduleOpen">STAT</button>
            <button class="scheduletablinks" onclick="openScheduleGroup(event, 'MATCH INFO')">MATCH INFO</button>
        </div>

        

        <div id="LINEUP" class="scheduletabcontent">
            <div class="teamtab">
                <button>{{$liveMatchDetails['teamA']->Name}}</button>
                <button>{{$liveMatchDetails['teamB']->Name}}</button>
            </div>
            <table>
                <thead>
                    <tr>
                        <th colspan="2">STARTING</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < 5; $i++)
                    <tr>
                        <td>{{ htmlspecialchars($liveMatchDetails['starterA'][$i]) }}</td>
                        <td>{{ htmlspecialchars($liveMatchDetails['starterB'][$i]) }}</td>
                    </tr>
                    @endfor
                </tbody>
                <thead>
                    <tr>
                        <th colspan="2">RESERVE</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < 5; $i++)
                    <tr>
                        <td>{{ htmlspecialchars($liveMatchDetails['reserveA'][$i]) }}</td>
                        <td>{{ htmlspecialchars($liveMatchDetails['reserveB'][$i]) }}</td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>
        

        <div id="STAT" class="scheduletabcontent">
            <table class="stat-table">
                <thead>
                    <tr>
                        <th class="middle-head">{{ $liveMatchDetails['teamA']->Name }}</th>
                        <th class="middle-head">Statistics</th>
                        <th class="middle-head">{{ $liveMatchDetails['teamB']->Name }}</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        // Initialize statistics arrays for Team A and Team B
                        $statsTeamA = [
                            'Field Goal' => 0,
                            'Penalty Goal' => 0,
                            'Corner Goal' => 0,
                            'Green Card' => 0,
                            'Yellow Card' => 0,
                            'Red Card' => 0
                        ];
        
                        $statsTeamB = [
                            'Field Goal' => 0,
                            'Penalty Goal' => 0,
                            'Corner Goal' => 0,
                            'Green Card' => 0,
                            'Yellow Card' => 0,
                            'Red Card' => 0
                        ];
        
                        // Iterate through stats and accumulate values
                        foreach ($stats as $stat) {
                            $statName = '';
        
                            switch ($stat->StatID) {
                                case 1: $statName = 'Field Goal'; break;
                                case 2: $statName = 'Penalty Goal'; break;
                                case 3: $statName = 'Corner Goal'; break;
                                case 4: $statName = 'Green Card'; break;
                                case 5: $statName = 'Yellow Card'; break;
                                case 6: $statName = 'Red Card'; break;
                            }
        
                            if ($statName) {
                                if ($teamAPlayers->contains('PlayerID', $stat->PlayerID)) {
                                    $statsTeamA[$statName] += $stat->Score;
                                } elseif ($teamBPlayers->contains('PlayerID', $stat->PlayerID)) {
                                    $statsTeamB[$statName] += $stat->Score;
                                }
                            }
                        }
                    @endphp
        
                    @foreach ($statsTeamA as $statName => $statValue)
                        <tr>
                            <td class="score-stat">{{ $statValue }}</td>
                            <td class="middle-head">{{ $statName }}</td>
                            <td class="score-stat">{{ $statsTeamB[$statName] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        


        <div id="MATCH INFO" class="scheduletabcontent">
        <div class="matchinfo">
            <table>
                <tbody>
                    <tr>
                        <td class="label">VENUE</td>
                        <td class="value">{{ $liveMatchDetails['match']->Venue}}</td>
                    </tr>
                    <tr>
                        <td class="label">DATE & TIME</td>
                        <td class="value">{{ $liveMatchDetails['match']->Date}}</td>
                    </tr>
                    <tr>
                        <td class="label">EVENT NAME</td>
                        <td class="value">{{$TournamentName->Name}}</td>
                    </tr>
                    <tr>
                        <td class="label">SCORING JUDGE</td>
                        <td class="value">{{$ScoringJudgeID->Name}}</td>
                    </tr>
                    <tr>
                        <td class="label">TIMING JUDGE</td>
                        <td class="value">{{$TimingJudgeID->Name}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        </div>
    </div>
    <script src="{{ asset('js/tournament.js') }}"></script>
    @include('profile.partials.footer')
</body>
