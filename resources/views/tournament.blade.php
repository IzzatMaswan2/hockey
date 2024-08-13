<x-layout>
            
    <div class="main-content">
        <h1 class="tournament-heading">TOURNAMENT LEADERBOARD</h1>
    </div>
    <main>
        <div class="tournament-bracket">
            <div class="container-tour">
                    <div class="roundquarter">
                      <div class="round-details">QUARTERFINALS<br /></div>
                        <ul class="matchup">
                            <li class="team team-top">Winner Group A (A)<span class="score">4</span></li>
                            <li class="team team-bottom">Winner Group B (B)<span class="score">2</span></li>
                        </ul>
                        <ul class="matchup">
                            <li class="team team-top">Winner Group C (C)<span class="score">1</span></li>
                            <li class="team team-bottom">Winner Group D (D)<span class="score">0</span></li>
                        </ul>
                        <ul class="matchup">
                            <li class="team team-top">Winner Group E (E)<span class="score">4</span></li>
                            <li class="team team-bottom">Winner Group F (F)<span class="score">2</span></li>
                        </ul>
                        <ul class="matchup">
                            <li class="team team-top">Winner Group G (G)<span class="score">3</span></li>
                            <li class="team team-bottom">Winner Group H (H)<span class="score">0</span></li>
                        </ul>
                    </div> <!-- END quarter -->


                <div class="roundsemi">
                    <div class="round-details">SEMIFINAL</div>
                    <ul class="matchup semifinal">
                        <li class="team team-top">Group A Winner (A)<span class="score">2</span></li>
                        <li class="team team-bottom">Group B Winner (C)<span class="score">1</span></li>
                    </ul>
                    <ul class="matchup semifinal">
                        <li class="team team-top">Group A Winner (E)<span class="score">2</span></li>
                        <li class="team team-bottom">Group B Winner (G)<span class="score">1</span></li>
                    </ul>
                </div> <!-- END semifinal -->

                <div class="roundchampion">
                    <div class="round-details">CHAMPION</Canvas></div>
                    <ul class="matchupchampion">
                        <li class="team team-top">Group A Winner (A)<span class="score">2</span>
                        <li class="team team-bottom">Group B Winner (E)<span class="score">1</span></li>
                    </ul>
                </div> <!-- END CHAMPION -->
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
                        <div class="matchtab">
                            <div class="tabm">
                                <img src="img/teamAlogo.png" alt="Team A Logo" class="teamlogo left">
                                <div class="matchcontent">
                                    <h3>TEAM A</h3>
                                    <p>COUNTRY</p>
                                    <p>Rating: 97%</p>
                                    <a href="/match" class="lineup-button">Lineup</a>
                                </div>
                            </div>
                            
                            <div class="vs-container">
                                <div class="vs">vs</div>
                                <div class="date">Monday</div>
                                <div class="time">08:00am - 09:00</div>
                            </div>
                
                            
                            <div class="tabm">
                                <div class="matchcontent">
                                    <h3>TEAM B</h3>
                                    <p>COUNTRY</p>
                                    <p>Rating: 93%</p>
                                    <a href="/match" class="lineup-button">Lineup</a>
                                </div>
                                <img src="img/teamBlogo.png" alt="Team B Logo" class="teamlogo right">
                            </div>
                        </div>
                
                        <div class="matchtab">
                            <div class="tabm">
                                <img src="img/teamClogo.png" alt="Team C Logo" class="teamlogo left">
                                <div class="matchcontent">
                                    <h3>TEAM C</h3>
                                    <p>COUNTRY</p>
                                    <p>Rating: 88%</p>
                                    <a href="/match" class="lineup-button">Lineup</a>
                                </div>
                            </div>
                            
                            <div class="vs-container">
                                <div class="vs">vs</div>
                                <div class="date">Thursday</div>
                                <div class="time">10:00am - 11:00am</div>
                            </div>
                
                            <div class="tabm">
                                <div class="matchcontent">
                                    <h3>TEAM D</h3>
                                    <p>COUNTRY</p>
                                    <p>Rating: 83%</p>
                                    <a href="/match" class="lineup-button">Lineup</a>
                                </div>
                                <img src="img/teamDlogo.png" alt="Team D Logo" class="teamlogo right">
                            </div>
                        </div>
                    </div>
            </div>

            <div id="LIVE" class="scheduletabcontent mtabcontent">
                <div class="matchtab">
                    <div class="tabm">
                        <img src="img/teamAlogo.png" alt="Team A Logo" class="teamlogo left">
                        <div class="matchcontent">
                            <h3>TEAM A</h3>
                            <div class="livescore">2</div>
                        </div>
                    </div>
                    
                    <div class="vs-container">
                        <div class="vs">vs</div>
                        <div class="timer">48:00 minutes</div>
                    </div>
        
                    
                    <div class="tabm">
                        <div class="matchcontent">
                            <h3>TEAM B</h3>
                            <div class="livescore">1</div>
                        </div>
                        <img src="img/teamBlogo.png" alt="Team B Logo" class="teamlogo right">
                    </div>
                </div>
            </div>
            
            <div id="RESULT" class="scheduletabcontent mtabcontent">
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

                <div class="matchtab">
                    <div class="tabm">
                        <img src="img/teamClogo.png" alt="Team C Logo" class="teamlogo left">
                        <div class="matchcontent">
                            <h3>TEAM C</h3>
                            <div class="finalscore">4</div>
                        </div>
                    </div>
                    
                    <div class="vs-container">
                        <div class="vs">vs</div>
                    </div>
        
                    
                    <div class="tabm">
                        <div class="matchcontent">
                            <h3>TEAM D</h3>
                            <div class="finalscore">2</div>
                        </div>
                        <img src="img/teamDlogo.png" alt="Team D Logo" class="teamlogo right">
                    </div>
                </div>

                <div class="matchtab">
                    <div class="tabm">
                        <img src="img/teamElogo.png" alt="Team E Logo" class="teamlogo left">
                        <div class="matchcontent">
                            <h3>TEAM E</h3>
                            <div class="finalscore">2</div>
                        </div>
                    </div>
                    
                    <div class="vs-container">
                        <div class="vs">vs</div>
                    </div>
        
                    
                    <div class="tabm">
                        <div class="matchcontent">
                            <h3>TEAM F</h3>
                            <div class="finalscore">1</div>
                        </div>
                        <img src="img/teamFlogo.png" alt="Team F Logo" class="teamlogo right">
                    </div>
                </div>

            </div>
        </div>

    </main>
    <script src="{{ asset('js/tournament.js') }}"></script>

</x-layout>

