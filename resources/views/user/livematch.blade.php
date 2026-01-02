<x-guest-layout>

    {{-- PAGE HEADER --}}
    <section class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">MATCH CENTER</h1>
        </div>
    </section>

    {{-- LIVE MATCH SCORE --}}
    <section class="py-12">
        <div class="max-w-4xl mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center justify-between bg-white rounded-2xl shadow-md p-6 gap-6">

                {{-- Team A --}}
                <div class="flex flex-col items-center gap-2">
                    <img src="{{ asset($liveMatchDetails['teamA']->logoURL) }}" alt="{{ $liveMatchDetails['teamA']->Name }} Logo" class="w-24 h-24 object-contain rounded-full">
                    <h3 class="font-semibold text-lg">{{ $liveMatchDetails['teamA']->Name }}</h3>
                    <div class="text-2xl font-bold">{{ $liveMatchDetails['match']->ScoreA ?? 'N/A' }}</div>
                </div>

                {{-- VS --}}
                <div class="text-xl font-bold text-gray-700">vs</div>

                {{-- Team B --}}
                <div class="flex flex-col items-center gap-2">
                    <img src="{{ asset($liveMatchDetails['teamB']->logoURL) }}" alt="{{ $liveMatchDetails['teamB']->Name }} Logo" class="w-24 h-24 object-contain rounded-full">
                    <h3 class="font-semibold text-lg">{{ $liveMatchDetails['teamB']->Name }}</h3>
                    <div class="text-2xl font-bold">{{ $liveMatchDetails['match']->ScoreB ?? 'N/A' }}</div>
                </div>

            </div>
        </div>
    </section>

    {{-- MATCH DETAILS TABS --}}
    <section class="py-12" x-data="{ tab: 'LINEUP' }">
        <div class="max-w-5xl mx-auto px-4">

            {{-- Tabs --}}
            <div class="flex gap-2 mb-6 justify-center">
                <button @click="tab='LINEUP'" :class="tab==='LINEUP' ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-700'" class="px-4 py-2 rounded-full font-semibold transition">LINEUP</button>
                <button @click="tab='STAT'" :class="tab==='STAT' ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-700'" class="px-4 py-2 rounded-full font-semibold transition">STAT</button>
                <button @click="tab='MATCHINFO'" :class="tab==='MATCHINFO' ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-700'" class="px-4 py-2 rounded-full font-semibold transition">MATCH INFO</button>
            </div>

            {{-- Tab Contents --}}
            <div>

                {{-- LINEUP --}}
                <div x-show="tab==='LINEUP'" class="bg-white rounded-2xl shadow p-6 mb-6">
                    <div class="flex justify-center gap-4 mb-4">
                        <span class="font-semibold">{{ $liveMatchDetails['teamA']->Name }}</span>
                        <span class="font-semibold">{{ $liveMatchDetails['teamB']->Name }}</span>
                    </div>
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-100">
                                <th colspan="2" class="p-2">STARTING</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < 11; $i++)
                            <tr class="border-b">
                                <td class="p-2">{{ htmlspecialchars($liveMatchDetails['starterA'][$i]) }}</td>
                                <td class="p-2">{{ htmlspecialchars($liveMatchDetails['starterB'][$i]) }}</td>
                            </tr>
                            @endfor
                        </tbody>
                        <thead>
                            <tr class="bg-gray-100">
                                <th colspan="2" class="p-2">RESERVE</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < 5; $i++)
                            <tr class="border-b">
                                <td class="p-2">{{ htmlspecialchars($liveMatchDetails['reserveA'][$i]) }}</td>
                                <td class="p-2">{{ htmlspecialchars($liveMatchDetails['reserveB'][$i]) }}</td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>

                {{-- STAT --}}
                <div x-show="tab==='STAT'" class="bg-white rounded-2xl shadow p-6 mb-6 overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="p-2">{{ $liveMatchDetails['teamA']->Name }}</th>
                                <th class="p-2">Statistics</th>
                                <th class="p-2">{{ $liveMatchDetails['teamB']->Name }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $statsTeamA = ['Field Goal'=>0,'Penalty Goal'=>0,'Corner Goal'=>0,'Green Card'=>0,'Yellow Card'=>0,'Red Card'=>0];
                                $statsTeamB = ['Field Goal'=>0,'Penalty Goal'=>0,'Corner Goal'=>0,'Green Card'=>0,'Yellow Card'=>0,'Red Card'=>0];
                                foreach ($stats as $stat) {
                                    $statName = match($stat->StatID){
                                        1=>'Field Goal',2=>'Penalty Goal',3=>'Corner Goal',4=>'Green Card',5=>'Yellow Card',6=>'Red Card', default=>''
                                    };
                                    if($statName){
                                        if($teamAPlayers->contains('id',$stat->PlayerID)) $statsTeamA[$statName]+=$stat->Score;
                                        elseif($teamBPlayers->contains('id',$stat->PlayerID)) $statsTeamB[$statName]+=$stat->Score;
                                    }
                                }
                            @endphp
                            @foreach ($statsTeamA as $statName=>$statValue)
                            <tr class="border-b">
                                <td class="p-2">{{ $statValue }}</td>
                                <td class="p-2 font-semibold">{{ $statName }}</td>
                                <td class="p-2">{{ $statsTeamB[$statName] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- MATCH INFO --}}
                <div x-show="tab==='MATCHINFO'" class="bg-white rounded-2xl shadow p-6 mb-6">
                    <table class="w-full text-left border-collapse">
                        <tbody>
                            <tr>
                                <td class="font-semibold p-2">VENUE</td>
                                <td class="p-2">{{ $liveMatchDetails['match']->Venue }}</td>
                            </tr>
                            <tr>
                                <td class="font-semibold p-2">DATE & TIME</td>
                                <td class="p-2">{{ $liveMatchDetails['match']->Date }}</td>
                            </tr>
                            <tr>
                                <td class="font-semibold p-2">EVENT NAME</td>
                                <td class="p-2">{{ $TournamentName->name }}</td>
                            </tr>
                            <tr>
                                <td class="font-semibold p-2">SCORING REFEREE</td>
                                <td class="p-2">{{ $ScoringRefereeID->Name }}</td>
                            </tr>
                            <tr>
                                <td class="font-semibold p-2">TIMING REFEREE</td>
                                <td class="p-2">{{ $TimingRefereeID->Name }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </section>

</x-guest-layout>
