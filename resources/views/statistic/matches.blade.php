<x-admin-layout>
    <div class="flex min-h-screen bg-gray-100 w-full">

        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Main Content -->
        <main class="flex-1 p-6">

            <!-- Header -->
            <div class="bg-white rounded-2xl shadow p-6 mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Select Matches</h2>
                <p class="text-gray-500 mt-1">Choose a match and manage statistics</p>
            </div>

            <!-- Groups Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                @foreach($Groups as $group)
                    <div class="p-4 bg-gradient-to-br from-purple-100 to-purple-200 rounded-2xl shadow hover:scale-105 transform transition cursor-pointer">
                        <h5 class="font-semibold text-gray-800">{{ $group->Name }}</h5>
                        <p class="text-gray-700 text-sm mt-1">Ended Matches: {{ $groupCounts[$group->GroupID]['ended'] ?? 0 }}/{{ $groupCounts[$group->GroupID]['total'] ?? 0 }}</p>
                        <p class="text-gray-700 text-sm">Errors: {{ $groupCounts[$group->GroupID]['error'] ?? 0 }}</p>
                    </div>
                @endforeach
            </div>

            <!-- Actions -->
            <div class="flex flex-wrap gap-2 mb-6">
                <form action="{{ route('tournament.updateStats') }}" method="POST">
                    @csrf
                    <input type="hidden" name="tournament_id" value="{{ $tournamentId }}">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition">
                        Update Tournament Stats
                    </button>
                </form>

                @php
                    $allMatchesEnded = collect($groupCounts)->every(fn($counts) => $counts['ended'] === $counts['total']);
                    $noErrors = collect($groupCounts)->every(fn($counts) => $counts['error'] === 0);
                @endphp

                @if($allMatchesEnded && $noErrors && !$knockout)
                    <a href="{{ route('knockout.advance', ['id' => $tournamentId]) }}"
                       class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow transition">
                       Advance to Knockout Stage
                    </a>
                @endif
            </div>

            <!-- Search Matches -->
            <div class="bg-white rounded-2xl shadow p-6 mb-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-semibold text-gray-800">Matches</h3>
                    <button onclick="toggleMatchList()" id="toggleButton" 
                            class="text-gray-500 hover:text-gray-800 transition flex items-center space-x-1">
                        <span>Show/Hide</span>
                        <i class="bi bi-caret-down-fill text-lg"></i>
                    </button>
                </div>

                <input type="text" id="matchSearch" placeholder="Search by team or group name"
                       class="w-full border border-gray-300 rounded-lg p-2 mb-4 focus:ring-2 focus:ring-purple-500 focus:outline-none"
                       onkeyup="searchMatches()">

                <!-- Matches List -->
                <div id="matchList" class="grid grid-cols-1 gap-4 hidden">
                    @php
                        $liveMatches = $matches->filter(fn($match) => $match->match_status == 1);
                        $groupedMatches = $matches->filter(fn($match) => $match->match_status != 1)->groupBy('GroupID');
                    @endphp

                    <!-- Live Matches -->
                    @if($liveMatches->isNotEmpty())
                        <div class="bg-yellow-100 p-3 rounded-lg text-center font-semibold text-yellow-800">Live Matches</div>
                        @foreach($liveMatches as $match)
                            <div class="bg-white rounded-xl shadow p-4 flex flex-col sm:flex-row items-center justify-between hover:shadow-lg transition">
                                <div class="flex flex-col sm:flex-row sm:space-x-4 text-gray-700 mb-2 sm:mb-0">
                                    <span class="font-semibold">{{ $Groups[$match->GroupID]->Name }}</span>
                                    <span>{{ $Teams[$match->TeamAID]->name }} vs {{ $Teams[$match->TeamBID]->name }}</span>
                                    <span>{{ $match->Venue }}</span>
                                    <span>{{ $match->Date }} ({{ $match->start_time }} - {{ $match->end_time }})</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <span class="bg-green-500 text-white px-2 py-1 rounded-full text-sm font-semibold">Live</span>
                                    <a href="{{ route('statistics.index', $match->Match_groupID) }}"
                                       class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-lg text-sm shadow transition">
                                       Input Score
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @endif

                    <!-- Other Matches by Group -->
                    @foreach($groupedMatches as $groupID => $groupMatches)
                        <div class="bg-purple-100 p-2 rounded-lg font-semibold text-purple-800 text-center">{{ $Groups[$groupID]->Name }}</div>
                        @foreach($groupMatches as $match)
                            <div class="bg-white rounded-xl shadow p-4 flex flex-col sm:flex-row items-center justify-between hover:shadow-lg transition">
                                <div class="flex flex-col sm:flex-row sm:space-x-4 text-gray-700 mb-2 sm:mb-0">
                                    <span class="font-semibold">{{ $Groups[$match->GroupID]->Name }}</span>
                                    <span>{{ $Teams[$match->TeamAID]->name }} vs {{ $Teams[$match->TeamBID]->name }}</span>
                                    <span>{{ $match->Venue }}</span>
                                    <span>{{ $match->Date }} ({{ $match->start_time }} - {{ $match->end_time }})</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    @switch($match->match_status)
                                        @case(0)
                                            <form action="{{ route('matches.start', $match->Match_groupID) }}" method="POST">
                                                @csrf
                                                <span class="bg-gray-500 text-white px-2 py-1 rounded-full text-sm font-semibold">Upcoming</span>
                                                <button type="submit"
                                                        class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-lg text-sm shadow transition">
                                                    Start Match
                                                </button>
                                            </form>
                                            @break
                                        @case(2)
                                            @if($match->error)
                                                <span class="bg-red-600 text-white px-3 py-1 rounded-lg text-sm">Error</span>
                                            @else
                                                <span class="bg-gray-800 text-white px-2 py-1 rounded-full text-sm font-semibold">Ended</span>
                                                <button type="button"
                                                        class="bg-gray-600 hover:bg-gray-700 text-white px-3 py-1 rounded-lg text-sm shadow transition"
                                                        onclick="showMatchDetails({{ $match->Match_groupID }})">
                                                    View Details
                                                </button>
                                            @endif
                                            @break
                                    @endswitch
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>

            <!-- Modal -->
            <div id="matchModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
                <div class="bg-white rounded-2xl shadow-lg w-11/12 md:w-1/2 p-6 relative">
                    <button class="absolute top-4 right-4 text-gray-500 hover:text-gray-800" onclick="closeMatchModal()">&times;</button>
                    <h5 class="text-lg font-semibold mb-4">Match Details</h5>
                    <div id="matchDetails" class="space-y-2 text-gray-700"></div>
                    <div class="mt-4 text-right">
                        <button class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg" onclick="closeMatchModal()">Close</button>
                    </div>
                </div>
            </div>

        </main>
    </div>

    <script>
        function toggleMatchList() {
            document.getElementById('matchList').classList.toggle('hidden');
        }

        function searchMatches() {
            const filter = document.getElementById('matchSearch').value.toLowerCase();
            const rows = document.querySelectorAll('#matchList > div');
            rows.forEach(row => {
                row.style.display = row.innerText.toLowerCase().includes(filter) ? '' : 'none';
            });
        }

        function showMatchDetails(matchId) {
            fetch(`/statistics/matches/${matchId}/details`)
                .then(res => res.json())
                .then(data => {
                    const details = document.getElementById('matchDetails');
                    details.innerHTML = `
                        <p><strong>Tournament:</strong> ${data.TournamentID}</p>
                        <p><strong>Teams:</strong> ${data.TeamAName} vs ${data.TeamBName}</p>
                        <p><strong>Status:</strong> ${data.match_status}</p>
                        <p><strong>Date:</strong> ${data.Date}</p>
                        <p><strong>Start Time:</strong> ${data.start_time}</p>
                        <p><strong>End Time:</strong> ${data.end_time}</p>
                        <p><strong>Venue:</strong> ${data.Venue}</p>
                        <p><strong>Score:</strong> ${data.ScoreA} - ${data.ScoreB}</p>
                    `;
                    document.getElementById('matchModal').classList.remove('hidden');
                })
                .catch(() => {
                    document.getElementById('matchDetails').innerHTML = '<p>Error loading match details.</p>';
                    document.getElementById('matchModal').classList.remove('hidden');
                });
        }

        function closeMatchModal() {
            document.getElementById('matchModal').classList.add('hidden');
        }
    </script>
</x-admin-layout>
