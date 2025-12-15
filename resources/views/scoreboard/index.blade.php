<x-admin-layout :footer="$footer">

    <div class="bg-gray-100 min-h-screen w-full flex flex-col">

        {{-- @include('layouts.navbar') --}}

    {{-- Notifications --}}
    <div class="fixed top-5 right-5 z-50 space-y-2">
        @if(session('success'))
            <div class="px-4 py-2 bg-green-500 text-white rounded shadow-md">
                <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="px-4 py-2 bg-red-500 text-white rounded shadow-md">
                <i class="fas fa-times-circle mr-2"></i> {{ session('error') }}
            </div>
        @endif
        @if(session('warning'))
            <div class="px-4 py-2 bg-yellow-500 text-white rounded shadow-md">
                <i class="fas fa-exclamation-triangle mr-2"></i> {{ session('warning') }}
            </div>
        @endif
        @if(session('info'))
            <div class="px-4 py-2 bg-blue-500 text-white rounded shadow-md">
                <i class="fas fa-info-circle mr-2"></i> {{ session('info') }}
            </div>
        @endif
    </div>

    <div class="flex flex-1">
        @include('layouts.sidebar')

        <div class="flex-1 p-6">
            <h3 class="text-2xl font-bold mb-6 text-purple-700">SCOREBOARD - {{ $tournament->name }}</h3>

            <!-- Match Selection -->
            <div class="bg-white shadow-md rounded-xl p-6 mb-6">
                <form id="scoreboard-form">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                        <div>
                            <label for="category-dropdown" class="block font-semibold mb-1">CATEGORY</label>
                            <select id="category-dropdown" class="w-full border border-gray-300 rounded-md p-2">
                                <option value="">Select Category</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="match-dropdown" class="block font-semibold mb-1">MATCH</label>
                            <select id="match-dropdown" class="w-full border border-gray-300 rounded-md p-2">
                                <option value="">Select Match</option>
                                @foreach($matches as $match)
                                    <option value="{{ $match->Match_groupID }}">
                                        {{ $teams[$match->TeamAID]->name }} vs {{ $teams[$match->TeamBID]->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="text-center">
                            <div id="match-status" class="font-bold text-gray-700">Status</div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Score Update -->
            <div class="bg-white shadow-md rounded-xl p-5 mb-6 border border-gray-200">
                <form id="score-update-form" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- TEAM A -->
                        <div>
                            <div id="team1-box"
                                class="text-lg font-semibold text-white text-center
                                        bg-gradient-to-r from-blue-500 to-purple-600
                                        py-2 rounded-md shadow-md mb-2">
                                TEAM A
                            </div>

                            <input type="hidden" id="match-id" name="match_ID">

                            <input type="number" id="team1-score" name="ScoreA"
                                class="w-full text-xl font-bold text-center p-2
                                        border rounded-md bg-gray-50 focus:ring focus:ring-blue-300"
                                value="0">
                        </div>

                        <!-- TEAM B -->
                        <div>
                            <input type="number" id="team2-score" name="ScoreB"
                                class="w-full text-xl font-bold text-center p-2
                                        border rounded-md bg-gray-50 focus:ring focus:ring-red-300"
                                value="0">

                            <div id="team2-box"
                                class="text-lg font-semibold text-white text-center
                                        bg-gradient-to-r from-red-500 to-pink-600
                                        py-2 rounded-md shadow-md mt-2">
                                TEAM B
                            </div>
                        </div>

                    </div>

                    <!-- Save button -->
                    <div class="mt-5 text-center">
                        <button type="submit"
                                class="px-6 py-2 font-semibold text-white rounded-md
                                    bg-green-600 hover:bg-green-700 shadow-sm transition">
                            Save Scores
                        </button>
                    </div>

                </form>
            </div>



            <!-- Player Scores -->
            <div class="bg-white shadow-md rounded-xl p-6">
                <h5 class="text-lg font-bold mb-4">PLAYER SCORE</h5>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div id="team1-player-box" class="bg-gray-100 rounded-md p-4">Player-Score</div>
                    <div id="team2-player-box" class="bg-gray-100 rounded-md p-4">Player-Score</div>
                </div>
            </div>
        </div>
    </div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $(document).on('change', '#category-dropdown', function() {
        var categoryId = $(this).val();
        var tournamentId = "{{ $tournament->id }}";

        $('#match-dropdown').html('<option>Loading...</option>');

        $.get('/scoreboard/get-matches', { tournament_id: tournamentId, category_id: categoryId }, function(data) {
            $('#match-dropdown').html('<option value="">Select Match</option>');
            $.each(data, function(i, m){
                $('#match-dropdown').append(`<option value="${m.Match_groupID}">${m.teamA_name} vs ${m.teamB_name}</option>`);
            });
            // Reset display
            $('#team1-box').text('TEAM A');
            $('#team2-box').text('TEAM B');
            $('#team1-score').val(0);
            $('#team2-score').val(0);
            $('#match-status').text('Please select a match');
            $('#team1-player-box').html('Player-Score');
            $('#team2-player-box').html('Player-Score');
        });
    });

    $(document).on('change', '#match-dropdown', function() {
        var matchId = $(this).val();
        $('#match-id').val(matchId);

        if(matchId){
            $.get('/get-match-details', { id: matchId }, function(res){
                $('#team1-box').text(res.team1_name);
                $('#team2-box').text(res.team2_name);
                $('#team1-score').val(res.team1_score);
                $('#team2-score').val(res.team2_score);

                var today = new Date();
                var matchDate = new Date(res.date);
                var todayOnly = new Date(today.getFullYear(), today.getMonth(), today.getDate());
                var matchOnly = new Date(matchDate.getFullYear(), matchDate.getMonth(), matchDate.getDate());

                if(todayOnly > matchOnly) $('#match-status').text('Completed').removeClass().addClass('font-bold text-green-600');
                else if(todayOnly < matchOnly) $('#match-status').text('Upcoming').removeClass().addClass('font-bold text-blue-600');
                else $('#match-status').text('On-going').removeClass().addClass('font-bold text-orange-500');

                var t1Players = '', t2Players = '';
                $.each(res.players, function(i, p){
                    if(p.team_name === res.team1_name) t1Players += `<div>${p.name} - ${p.Score}</div>`;
                    else t2Players += `<div>${p.name} - ${p.Score}</div>`;
                });
                $('#team1-player-box').html(t1Players);
                $('#team2-player-box').html(t2Players);
            });
        } else {
            $('#team1-box').text('TEAM A');
            $('#team2-box').text('TEAM B');
            $('#team1-score').val(0);
            $('#team2-score').val(0);
            $('#match-status').text('Please select a match');
            $('#team1-player-box').html('Player-Score');
            $('#team2-player-box').html('Player-Score');
        }
    });

    $('#score-update-form').submit(function(e){
        e.preventDefault();
        var matchId = $('#match-id').val();
        var scoreA = $('#team1-score').val();
        var scoreB = $('#team2-score').val();

        $.post('/update-match/' + matchId, {
            _token: '{{ csrf_token() }}',
            ScoreA: scoreA,
            ScoreB: scoreB,
            match_ID: matchId
        }, function(res){
            alert('Scores updated successfully!');
        });
    });
});
</script>

{{-- @include('layouts.footer') --}}
    </div>

    

</x-admin-layout>
