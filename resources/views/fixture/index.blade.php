<x-guest-layout>

    {{-- PAGE HEADER --}}
    <section class="py-12 bg-green-700/20">
        <div class="max-w-7xl mx-auto px-4 flex items-center space-x-4">
            <button onclick="history.back()" 
                    class="flex items-center px-4 py-2 bg-purple-600/70 border border-purple-500 rounded-md shadow hover:bg-purple-600 transition text-white">
                <i class="fa-solid fa-arrow-left-long mr-2"></i> Back
            </button>
            <h1 class="text-3xl font-bold text-purple-900 drop-shadow-md">Match Schedule - {{ $tournament->name }}</h1>
        </div>
    </section>

    {{-- TABS --}}
    <section class="py-6 bg-green-100/80">
        <div class="max-w-7xl mx-auto px-4" x-data="{ activeTab: 'UPCOMING' }">
            <div class="flex flex-wrap justify-center gap-4 mb-8">
                <button 
                    @click="activeTab = 'LIVE'"
                    :class="activeTab === 'LIVE' ? 'bg-purple-600 text-white' : 'bg-purple-200 text-purple-900'"
                    class="px-6 py-2 rounded-full font-semibold transition shadow">
                    LIVE
                </button>
                <button 
                    @click="activeTab = 'UPCOMING'"
                    :class="activeTab === 'UPCOMING' ? 'bg-purple-600 text-white' : 'bg-purple-200 text-purple-900'"
                    class="px-6 py-2 rounded-full font-semibold transition shadow">
                    UPCOMING
                </button>
                <button 
                    @click="activeTab = 'RESULT'"
                    :class="activeTab === 'RESULT' ? 'bg-purple-600 text-white' : 'bg-purple-200 text-purple-900'"
                    class="px-6 py-2 rounded-full font-semibold transition shadow">
                    RESULT
                </button>
            </div>

            {{-- UPCOMING MATCHES --}}
            <div x-show="activeTab === 'UPCOMING'" class="space-y-6">
                @if($upcomingMatchDetail->isNotEmpty())
                    @foreach($upcomingMatchDetail as $upcoming)
                        <div class="bg-green-200/30 border border-green-400 rounded-xl p-6 flex flex-col md:flex-row items-center justify-between shadow hover:shadow-lg transition">
                            {{-- Team 1 --}}
                            <div class="flex flex-col items-center md:items-start md:flex-1 text-center md:text-left">
                                <img src="{{$upcoming['team1']->logoURL}}" alt="{{$upcoming['team1']->name}}" class="w-20 h-20 mb-2 rounded-full border-2 border-green-600 shadow-md">
                                <h3 class="font-semibold text-green-900">{{$upcoming['team1']->name}}</h3>
                                <p class="text-green-700">{{$upcoming['team1']->country}}</p>
                                <a href="/match/{{$upcoming['upmatch']->id}}" class="mt-2 px-4 py-1 bg-green-600 text-white rounded-full text-sm hover:bg-green-500 transition">Lineup</a>
                            </div>

                            {{-- VS --}}
                            <div class="flex flex-col items-center justify-center px-6 py-2 text-center md:px-12">
                                <span class="text-lg font-bold text-green-900">vs</span>
                                <span class="text-green-700">{{ \Carbon\Carbon::parse($upcoming['upmatch']->date)->format('d F Y') }}</span>
                                <span class="text-green-700">{{ $upcoming['upmatch']->start_time }}</span>
                            </div>

                            {{-- Team 2 --}}
                            <div class="flex flex-col items-center md:items-end md:flex-1 text-center md:text-right">
                                <img src="{{$upcoming['team2']->logoURL}}" alt="{{$upcoming['team2']->name}}" class="w-20 h-20 mb-2 rounded-full border-2 border-green-600 shadow-md">
                                <h3 class="font-semibold text-green-900">{{$upcoming['team2']->name}}</h3>
                                <p class="text-green-700">{{$upcoming['team2']->country}}</p>
                                <a href="/match/{{$upcoming['upmatch']->id}}" class="mt-2 px-4 py-1 bg-green-600 text-white rounded-full text-sm hover:bg-green-500 transition">Lineup</a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-center text-green-800">No upcoming matches at the moment.</p>
                @endif
            </div>

            {{-- LIVE MATCHES --}}
            <div x-show="activeTab === 'LIVE'" class="space-y-6">
                @if($liveMatches->isEmpty())
                    <p class="text-center text-green-800">There are no live matches at the moment.</p>
                @else
                    @foreach ($liveMatchDetails as $detail)
                        <div class="bg-green-200/30 border border-green-400 rounded-xl p-6 flex flex-col md:flex-row items-center justify-between shadow hover:shadow-lg transition">
                            <div class="flex flex-col items-center md:items-start md:flex-1 text-center md:text-left">
                                <img src="{{$detail['team1']->logoURL}}" alt="{{$detail['team1']->name}}" class="w-20 h-20 mb-2 rounded-full border-2 border-green-600 shadow-md">
                                <h3 class="font-semibold text-green-900">{{$detail['team1']->name}}</h3>
                                <div class="text-xl font-bold text-red-500">{{$detail['match']->score1 ?? '0'}}</div>
                            </div>

                            <div class="flex flex-col items-center justify-center px-6 py-2 text-center md:px-12">
                                <span class="text-lg font-bold text-green-900">vs</span>
                                <span class="text-green-700">{{ \Carbon\Carbon::parse($detail['match']->date ?? now())->format('d F Y') }}</span>
                                <span class="text-green-700">48:00 min</span>
                                <a href="/livematch/{{$detail['match']->id}}" class="mt-2 px-4 py-1 bg-red-600 text-white rounded-full text-sm hover:bg-red-500 transition">Live Score</a>
                            </div>

                            <div class="flex flex-col items-center md:items-end md:flex-1 text-center md:text-right">
                                <img src="{{$detail['team2']->logoURL}}" alt="{{$detail['team2']->name}}" class="w-20 h-20 mb-2 rounded-full border-2 border-green-600 shadow-md">
                                <h3 class="font-semibold text-green-900">{{$detail['team2']->name}}</h3>
                                <div class="text-xl font-bold text-red-500">{{$detail['match']->score2 ?? '0'}}</div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            {{-- RESULT MATCHES --}}
            <div x-show="activeTab === 'RESULT'" class="space-y-6">
                @foreach ($resultMatchDetail as $result)
                    <div class="bg-green-200/30 border border-green-400 rounded-xl p-6 flex flex-col md:flex-row items-center justify-between shadow hover:shadow-lg transition">
                        <div class="flex flex-col items-center md:items-start md:flex-1 text-center md:text-left">
                            <img src="{{$result['team1']->logoURL}}" alt="{{$result['team1']->name}}" class="w-20 h-20 mb-2 rounded-full border-2 border-green-600 shadow-md">
                            <h3 class="font-semibold text-green-900">{{$result['team1']->name}}</h3>
                            <div class="text-xl font-bold text-green-800">{{$result['resultmatch']->score1}}</div>
                        </div>

                        <div class="flex flex-col items-center justify-center px-6 py-2 text-center md:px-12">
                            <span class="text-lg font-bold text-green-900">vs</span>
                        </div>

                        <div class="flex flex-col items-center md:items-end md:flex-1 text-center md:text-right">
                            <img src="{{$result['team2']->logoURL}}" alt="{{$result['team2']->name}}" class="w-20 h-20 mb-2 rounded-full border-2 border-green-600 shadow-md">
                            <h3 class="font-semibold text-green-900">{{$result['team2']->name}}</h3>
                            <div class="text-xl font-bold text-green-800">{{$result['resultmatch']->score2}}</div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

</x-guest-layout>
