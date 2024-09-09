<!DOCTYPE html>
<html lang="en">
<head>
    <title>Match Center</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Match Center</title>
    <link rel="stylesheet" href="{{ asset('css/match.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tournament.css') }}"> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
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
                <img src="{{asset($teamAInfo->logoURL)}}" alt="{{$teamAInfo->Name}} Logo" class="teamlogo left">
                <div class="matchcontent">
                    <h3>{{$teamAInfo->Name}}</h3>
                    <div class="finalscore">2</div>
                </div>
            </div>
            
            <div class="vs-container">
                <div class="vs">vs</div>
            </div>
            
            <div class="tabm">
                <div class="matchcontent">
                    <h3>{{$teamBInfo->Name}}</h3>
                    <div class="finalscore">1</div>
                </div>
                <img src="{{asset($teamBInfo->logoURL)}}" alt="{{$teamBInfo->Name}}Logo" class="teamlogo right">
            </div>
        </div>
    </div>



    <div class="schelduleALL">
        <div class="scheduletab">
            <button class="scheduletablinks" onclick="openScheduleGroup(event, 'LINEUP')" id="defaultScheduleOpen">LINEUP</button>
            <button class="scheduletablinks" onclick="openScheduleGroup(event, 'MATCH INFO')">MATCH INFO</button>
        </div>

        <div id="LINEUP" class="scheduletabcontent">
            <div class="teamtab">
                <button >{{$teamAInfo->Name}}</button>
                <button >{{$teamBInfo->Name}}</button>
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
                        <td>{{ htmlspecialchars($playerCollect['starterA'][$i]) }}</td>
                        <td>{{ htmlspecialchars($playerCollect['starterB'][$i]) }}</td>
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
                        <td>{{ htmlspecialchars($playerCollect['reserveA'][$i]) }}</td>
                        <td>{{ htmlspecialchars($playerCollect['reserveB'][$i]) }}</td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>


        <div id="MATCH INFO" class="scheduletabcontent">
        <div class="matchinfo">
            <table>
                <tbody>
                    <tr>
                        <td class="label">VENUE</td>
                        <td class="value">{{$matchDetail->Venue}}</td>
                    </tr>
                    <tr>
                        <td class="label">DATE & TIME</td>
                        <td class="value">{{$matchDetail->Date}}</td>
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

</html>