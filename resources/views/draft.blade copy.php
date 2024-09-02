<x-manager-layout>
    <main>
        <div class="container">
            <h1>Input Player Statistics</h1>
            <form action="{{ route('playerstatmatch.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="player_id">Player ID:</label>
                    <input type="number" id="player_id" name="PlayerID" required>
                </div>
                <div class="form-group">
                    <label for="match_group_id">Match Group ID:</label>
                    <input type="number" id="match_group_id" name="Match_groupID" required>
                </div>
                <div class="form-group">
                    <label for="time">Time:</label>
                    <input type="time" id="time" name="Time">
                </div>
                <div class="form-group">
                    <label for="stat_id">Stat ID:</label>
                    <input type="number" id="stat_id" name="StatID" required>
                </div>
                <div class="form-group">
                    <label for="reason">Reason:</label>
                    <input type="text" id="reason" name="Reason">
                </div>
                <div class="form-group">
                    <label for="score">Score:</label>
                    <input type="number" id="score" name="Score" value="0" required>
                </div>
                <button type="submit">Submit</button>
            </form>
        </div>
    </main>
</x-manager-layout>