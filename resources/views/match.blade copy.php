<!DOCTYPE html>
<html lang="en">
<head>
    <title>Match Center</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Match Center</title>
    <link rel="stylesheet" href="{{ asset('css/match.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>
<body>
    @include('components.side-nav')
    @include('profile.partials.navbar')
        
    <div class="main-content">
        <h1 class="tournament-heading">MATCH CENTER</h1>
    </div>


    <div class="matchtab">
        <div class="tabm">
            <img src="img/teamAlogo.png" alt="Team A Logo" class="teamlogo left">
            <div class="matchcontent">
                <h3>TEAM A</h3>
                <div class="finalscore">2</div>
            </div>
        </div>
        
        <div class="vs-container">
            <div class="vs">vs</div>
        </div>

        
        <div class="tabm">
            <div class="matchcontent">
                <h3>TEAM B</h3>
                <div class="finalscore">1</div>
            </div>
            <img src="img/teamBlogo.png" alt="Team B Logo" class="teamlogo right">
        </div>
    </div>


    <div class="schelduleALL">
        <div class="scheduletab">
            <button class="scheduletablinks" onclick="openScheduleGroup(event, 'LINEUP')" id="defaultScheduleOpen">LINEUP</button>
            <button class="scheduletablinks" onclick="openScheduleGroup(event, 'MATCH INFO')">MATCH INFO</button>
        </div>

        <div id="LINEUP" class="scheduletabcontent">
            <div class="teamtab">
                <button >TEAM A</button>
                <button >TEAM B</button>
            </div>
            <table>
                <thead>
                    <tr>
                        <th colspan="2">STARTING</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>JOHN DOE</td>
                        <td>JOHNY JOHSON</td>
                    </tr>
                    <tr>
                        <td>ALICE SMITH</td>
                        <td>BOB JOHNSON</td>
                    </tr>
                    <tr>
                        <td>CAROL WILLIAMS</td>
                        <td>DAVE BROWN</td>
                    </tr>
                    <tr>
                        <td>EMMA JONES</td>
                        <td>FRANK MILLER</td>
                    </tr>
                    <tr>
                        <td>GRACE TAYLOR</td>
                        <td>HARRY ANDERSON</td>
                    </tr>
                </tbody>
                <thead>
                    <tr>
                        <th colspan="2">RESERVE</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>JAMES ANDERSON</td>
                        <td>LINDA MARTIN</td>
                    </tr>
                    <tr>
                        <td>MICHAEL THOMPSON</td>
                        <td>BARBARA MOORE</td>
                    </tr>
                    <tr>
                        <td>WILLIAM TAYLOR</td>
                        <td>SUSAN HARRIS</td>
                    </tr>
                    <tr>
                        <td>ELIZABETH ROBERTS</td>
                        <td>DAVID CLARK</td>
                    </tr>
                    <tr>
                        <td>RICHARD WALKER</td>
                        <td>MARY LEWIS</td>
                    </tr>
                </tbody>
            </table>
        </div>


        <div id="MATCH INFO" class="scheduletabcontent">
        <div class="matchinfo">
            <table>
                <tbody>
                    <tr>
                        <td class="label">VENUE</td>
                        <td class="value">FIELD A, HILLPARK, SELANGOR</td>
                    </tr>
                    <tr>
                        <td class="label">DATE & TIME</td>
                        <td class="value">MONDAY (09:00 - 10:00)</td>
                    </tr>
                    <tr>
                        <td class="label">EVENT NAME</td>
                        <td class="value">LIGA HOKI TOURNAMENT</td>
                    </tr>
                    <tr>
                        <td class="label">SCORING JUDGE</td>
                        <td class="value">FRANK MILLER</td>
                    </tr>
                    <tr>
                        <td class="label">TIMING JUDGE</td>
                        <td class="value">HARRY ANDERSON</td>
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