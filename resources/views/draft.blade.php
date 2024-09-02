<x-manager-layout>
    <main class="draft-page">
        <div class="row-draft1">
            <div class="match-dropdown">
                Match: 
                <select class="dropdown-option">
                    <option value="">Team A VS Team B</option> 
                    <option value="">Team C VS Team D</option>
                </select>
            </div>
            <div class="status-match">
                <select>
                    <option value="">Ended</option>
                </select>
            </div>
        </div>

        <div class="score-stated">Score</div>
            <div class="row-draft2">
                <div class="column-team-A">
                    <div class="Team-A">
                        <div class="score-container">
                            <div class="score-A">Team A</div>
                            <form class="score-form">
                                <input type="number" class="score-input" placeholder="Fill In The Score" name="scoreA">
                            </form>
                        </div>
                        <div class="scoring-player">
                            Scoring Player:
                            <select class="player-select" name="playerA">
                                <option value="">Select Player</option>
                                <option value="john_doe">John Doe</option>
                                <option value="jane_doe">Jane Doe</option>
                                <!-- Add more players as needed -->
                            </select>
                        </div>
                    </div>
                </div>
                <div class="column-team-B">
                    <div class="Team-B">
                        <div class="score-container">
                            <div class="score-B">Team B</div>
                            <form class="score-form">
                                <input type="number" class="score-input" placeholder="Fill In The Score" name="scoreA">
                            </form>
                        </div>
                        <div class="scoring-player">
                            Scoring Player:
                            <select class="player-select" name="playerB">
                                <option value="">Select Player</option>
                                <option value="john_doe">John Doe</option>
                                <option value="jane_doe">Jane Doe</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="update-btn">Update</div>
        <div class="row-draft1">
            <div class="Team-Ranking">
                Team-Ranking:
                <div class="group-dropdown">Group A</div>
                <div class="team-dropdown">Team A</div>
            </div>
            <div class="underline"></div>
        </div>
        <div class="row-draft1">
            <div class="match-statistic">
                Fill in The Match Statistic : 
                <table>
                    <thead>
                        <tr>
                            <th>Play</th>
                            <th>Win</th>
                            <th>Draw</th>
                            <th>Lose</th>
                            <th>Result</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Fill The Total Match</td>
                            <td>Total Win</td>
                            <td>Total Draw</td>
                            <td>Total Lose</td>
                            <td>Blank</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="update-btn">Update</div>
            <div class="underline"></div>
        </div>
    </main>
</x-manager-layout>
