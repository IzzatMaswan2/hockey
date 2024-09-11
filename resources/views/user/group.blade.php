<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Group</title>
    <!-- Link to Bootstrap CSS and your custom CSS -->
    <link rel="stylesheet" href="{{asset('https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"> 
    <link rel="stylesheet" href="{{ asset('css/home.css') }}"> 
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
<div class="group-page">
    <div class="selection-container">
        <div class="selection-header">Team Selection</div>
        <div class="team-table">
            <table>
                <thead>
                    <tr>
                        <th colspan="2">Teams</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Team A</td>
                        <td>Team Z</td>
                    </tr>
                    <tr>
                        <td>Team A</td>
                        <td>Team Z</td>
                    </tr>
                    <tr>
                        <td>Team A</td>
                        <td>Team Z</td>
                    </tr>
                    <tr>
                        <td>Team A</td>
                        <td>Team Z</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="underline-group"></div>
    <div class="selection-container">
        <div class="selection-header">Team Lineup</div>
        <div class="team-table">
            <table>
                <thead>
                    <tr>
                        <th>Team A</th>
                        <th>Team B</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>John Doe</td>
                        <td>John Doe</td>
                    </tr>
                    <tr>
                        <td>John Doe</td>
                        <td>John Doe</td>
                    </tr>
                    <tr>
                        <td>John Doe</td>
                        <td>John Doe</td>
                    </tr>
                    <tr>
                        <td>John Doe</td>
                        <td>John Doe</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="underline-group"></div>
    <div class="selection-container">
        <div class="selection-header">Player Stats</div>
        <div class="player-stats">
            <div class="player-container">
                <div class="player-stat">
                    <div class="player-info">
                        <div class="stat">Goals</div>
                        <div class="player-name">John</div>
                        <div class="player-team">TeamA</div>
                        <div class="player-number">10</div>
                    </div>
                    <img src="img/goal.png" alt="goalstat">
                </div>
                <div class="score-detail">
                    <table>
                    <tbody>
                        <tr>
                            <td class="score" >6</td>
                            <td class="scorer">John</td>
                        </tr>
                        <tr>
                            <td class="score" >3</td>
                            <td class="scorer">John</td>
                        </tr>
                        <tr>
                            <td class="score">1</td>
                            <td class="scorer">John</td>
                        </tr>
                    </tbody>
                    </table>
                </div>
            </div>
            <div class="player-container">
                <div class="player-stat">
                    <div class="player-info">
                        <div class="stat">Assist</div>
                        <div class="player-name">John</div>
                        <div class="player-team">TeamA</div>
                        <div class="player-number">10</div>
                    </div>
                    <img src="img/assist.png" alt="assiststat">
                </div>
                <div class="score-detail">
                    <table>
                    <tbody>
                        <tr>
                            <td class="score">6</td>
                            <td class="scorer">John</td>
                        </tr>
                        <tr>
                            <td class="score">3</td>
                            <td class="scorer">John</td>
                        </tr>
                        <tr>
                            <td class="score">1</td>
                            <td class="scorer">John</td>
                        </tr>
                    </tbody>
                    </table>
                </div>
            </div>
            <div class="player-container">
                <div class="player-stat">
                    <div class="player-info">
                        <div class="stat">Clean Sheet</div>
                        <div class="player-name">John</div>
                        <div class="player-team">TeamA</div>
                        <div class="player-number">10</div>
                    </div>
                    <img src="img/cleansheet.png" alt="cleansheetstat">
                </div>
                <div class="score-detail">
                    <table>
                    <tbody>
                        <tr>
                            <td class="score">6</td>
                            <td class="scorer">John</td>
                        </tr>
                        <tr>
                            <td class="score">3</td>
                            <td class="scorer">John</td>
                        </tr>
                        <tr>
                            <td class="score">1</td>
                            <td class="scorer">John</td>
                        </tr>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="underline-group"></div>
</div>
@include('profile.partials.footer')

</body>