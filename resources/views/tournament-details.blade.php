<x-guest-layout>
@push('style')
    {{-- <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet"> --}}

    {{-- <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tournament.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tournamentlist.css') }}"> --}}

    <!-- Bootstrap JS Bundle (includes Popper) -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> --}}

    <!-- Custom JS -->
    

    <style>
        /* Background for detail, category, participants */
        .bg-detail {
            background: url('/img/logreg.jpg') center/cover no-repeat;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.96);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

    </style>
@endpush

<div class="py-16 flex flex-col items-center space-y-8 bg-grey-100">
    @php
        // Load tournament categories
        $categories = $categories ?? \App\Models\TournamentCategory::where('tournament_id', $tournament->id)->get();

        // If no categories → disable category mode
        $hasCategory = $categories && $categories->isNotEmpty();

        // Auto–select first category if none selected in URL
        $selectedCategoryId = null;
        if ($hasCategory) {
            $selectedCategoryId = request('category_id') 
                ? (int) request('category_id') 
                : (int) $categories->first()->id;
        }
    @endphp

    {{-- Tournament Header --}}
    <div class="w-full max-w-5xl text-center relative p-8 rounded-2xl shadow-lg bg-[url('/img/logreg.jpg')]">
        <h1 class="inline-block bg-white border-4 border-black text-[#4a3d89] text-3xl md:text-4xl font-extrabold rounded-3xl px-8 py-3 mb-6 shadow-lg font-poppins tracking-wide"
            style="text-shadow: 2px 0 #000, -2px 0 #000, 0 2px #000, 0 -2px #000, 1px 1px #000, -1px -1px #000, 1px -1px #000, -1px 1px #000;">
            {{ $tournament->tournament_name }} Details
        </h1>

        <div class="flex flex-col items-center gap-4 ">
            <div class="flex flex-col items-center bg-slate-50 bg-opacity-70 rounded-lg p-6 shadow-md w-full">
                <img src="{{ asset('storage/' . $tournament->image) }}" alt="{{ $tournament->name }}" class="w-48 h-48 object-cover rounded-lg mb-4">
                <p><strong>Number of Teams:</strong> {{ $tournament->no_team }}</p>
                <p><strong>Number of Groups:</strong> {{ $tournament->no_group }}</p>
                <p><strong>Start Date:</strong> {{ $tournament->start_date }}, {{ $tournament->start_time }}</p>
                <p><strong>End Date:</strong> {{ $tournament->end_date }}, {{ $tournament->end_time }}</p>
                <p><strong>Venue:</strong> {{ $tournament->venue->name }}</p>
                <p><strong>Category:</strong> {{ $tournament->category }}</p>
                <p><strong>Description:</strong> {{ $tournament->description }}</p>
            </div>

            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('tournamentlist.view') }}" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-500 text-white rounded-full font-semibold shadow transition transform hover:scale-105">
                    Back to Tournament List
                </a>

                <button id="registerTeamBtn" class="px-6 py-3 bg-green-600 hover:bg-green-500 text-white rounded-full font-semibold shadow transition transform hover:scale-105 disabled:bg-gray-400" 
                {{ $isRegistrationFull ? 'disabled' : '' }}>
                    {{ $isRegistrationFull ? 'Team Registration Full' : 'Register Your Team' }}
                </button>
            </div>
        </div>
    </div>

    {{-- Modal for Registration --}}
    <div
        id="registerTeamModal"
        class="hidden fixed inset-0 z-50 flex items-center justify-center
               bg-black/40 backdrop-blur-sm px-4" 
    >
        <div class="relative w-full max-w-3xl bg-white/95 backdrop-blur rounded-2xl shadow-2xl flex flex-col max-h-[90vh] animate-fadeIn">

            {{-- Sticky header --}}
            <div class="sticky top-0 bg-white/95 backdrop-blur px-6 py-4 border-b rounded-t-2xl z-10 flex justify-center items-center">
                <h2 class="text-xl font-bold text-center">Register Your Team</h2>
                <button
                    class="absolute top-4 right-4 text-gray-400 hover:text-gray-700 text-2xl font-bold close transition"
                    aria-label="Close modal"
                >
                    &times;
                </button>
            </div>

            {{-- Scrollable form body --}}
            <form id="registerForm" action="{{ route('tournament-details') }}" method="POST" class="flex-1 overflow-y-auto px-6 py-4 flex flex-col gap-4">
                @csrf
                <input type="hidden" name="tournament_id" value="{{ $tournament->id }}">

                @if(Auth::check())
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <label class="font-semibold text-sm" for="teamName">Team Name:</label>
                    <input class="border rounded-2xl px-3 py-2 text-sm w-full" type="text" id="teamName" name="teamName" value="{{ Auth::user()->team ? Auth::user()->team->name : 'N/A' }}" required>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="font-semibold text-sm" for="fullName">Full Name:</label>
                            <input class="border rounded-2xl px-3 py-2 text-sm w-full" type="text" id="fullName" name="fullName" required>
                        </div>
                        <div>
                            <label class="font-semibold text-sm" for="email">Email:</label>
                            <input class="border rounded-2xl px-3 py-2 text-sm w-full" type="email" id="email" name="email" required>
                        </div>
                        <div>
                            <label class="font-semibold text-sm" for="occupation">Occupation:</label>
                            <input class="border rounded-2xl px-3 py-2 text-sm w-full" type="text" id="occupation" name="occupation" required>
                        </div>
                        <div>
                            <label class="font-semibold text-sm" for="teamName">Team Name:</label>
                            <input class="border rounded-2xl px-3 py-2 text-sm w-full" type="text" id="teamName" name="teamName" required>
                        </div>
                        <div>
                            <label class="font-semibold text-sm" for="address">Address:</label>
                            <input class="border rounded-2xl px-3 py-2 text-sm w-full" type="text" id="address" name="address" required>
                        </div>
                        <div>
                            <label class="font-semibold text-sm" for="country">Country:</label>
                            <input class="border rounded-2xl px-3 py-2 text-sm w-full" type="text" id="country" name="country" required>
                        </div>
                        <div>
                            <label class="font-semibold text-sm" for="password">Password:</label>
                            <input class="border rounded-2xl px-3 py-2 text-sm w-full" type="password" id="password" name="password" required>
                        </div>
                        <div>
                            <label class="font-semibold text-sm" for="password_confirmation">Confirm Password:</label>
                            <input class="border rounded-2xl px-3 py-2 text-sm w-full" type="password" id="password_confirmation" name="password_confirmation" required>
                        </div>
                    </div>
                @endif

                @if($availableCategories->isNotEmpty())
                    <div>
                        <label class="font-semibold text-sm" for="category">Select Category:</label>
                        <select name="category_id" id="category" class="border rounded-2xl px-3 py-2 text-sm w-full" required>
                            @foreach($availableCategories as $cat)
                                <option value="{{ $cat->id }}" {{ ($selectedCategoryId == $cat->id) ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif
                <div class="sticky bottom-0 bg-white/95 backdrop-blur px-6 py-4 border-t rounded-b-2xl">
                    <button type="submit" form="registerForm" class="w-full px-4 py-3 bg-indigo-600 text-white rounded-xl font-semibold hover:bg-indigo-500 transition">
                        Submit Registration
                    </button>
            </div>
            </form>

            {{-- Sticky footer with submit --}}


        </div>
    </div>

    {{-- Category Selector --}}
    @if($hasCategory)
    <div class="w-full max-w-5xl bg-[url('/img/logreg.jpg')] rounded-lg p-6 flex flex-wrap gap-2 justify-center">
        @foreach($categories as $cat)
            <a href="{{ url()->current() }}?category_id={{ $cat->id }}" class="px-3 py-1 rounded-full font-semibold {{ $selectedCategoryId === (int)$cat->id ? 'bg-indigo-600 text-white' : 'bg-white text-gray-800' }}">
                {{ $cat->name }}
            </a>
        @endforeach
    </div>
    @endif

    {{-- Participants Table --}}
    @php
        $participants = $teamsjoin ?? collect();
        if ($selectedCategoryId) {
            $participants = $participants->filter(function($c) use ($selectedCategoryId) {
                $catId = $c->category_id ?? $c->categoryId ?? $c->category ?? null;
                if ($catId === null) return false;
                return (int)$catId === (int)$selectedCategoryId;
            })->values();
        }
    @endphp
    @if($participants->isNotEmpty())
    <div class="w-full max-w-5xl bg-[url('/img/logreg.jpg')] rounded-lg p-6 overflow-x-auto">
        <h2 class="text-xl font-bold mb-4 text-center text-white">Participants</h2>
        <table class="w-full text-left table-auto border-collapse">
            <thead>
                <tr class="bg-indigo-600 text-white">
                    <th class="px-3 py-2 border text-center">Team Name</th>
                    {{-- <th class="px-3 py-2 border">Status</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach($teamsForCurrentPage as $competition)
                    @if(!$selectedCategoryId || $competition->category_id == $selectedCategoryId)
                        <tr class="odd:bg-white even:bg-gray-100">
                            <td class="px-3 py-2 border text-center">{{ $competition->team->name ?? 'N/A' }}</td>
                            {{-- <td class="px-3 py-2 border">TBD</td> --}}
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

        {{-- Groups --}}
    @if(!empty($groupData) && count($groupData))
<div
    x-data="{ active: '{{ $groupData[0]['group']->GroupID }}' }"
    class="w-full max-w-5xl mx-auto flex flex-col space-y-4
           bg-[url('/img/logreg.jpg')] bg-cover bg-center
           p-4 sm:p-6 rounded-xl"
>

    {{-- GROUP TABS --}}
    <div class="flex gap-2 overflow-x-auto pb-2 scrollbar-hide">
        @foreach($groupData as $group)
            <button
                @click="active = '{{ $group['group']->GroupID }}'"
                :class="active === '{{ $group['group']->GroupID }}'
                        ? 'bg-indigo-700 ring-2 ring-white'
                        : 'bg-indigo-500'"
                class="flex-shrink-0 px-4 py-2 rounded-full text-sm sm:text-base
                       font-semibold text-white transition"
            >
                {{ $group['group']->Name }}
            </button>
        @endforeach
    </div>

    {{-- GROUP TABLES --}}
    @foreach($groupData as $group)
        <div
            x-show="active === '{{ $group['group']->GroupID }}'"
            x-cloak
            class="bg-white/80 backdrop-blur rounded-xl shadow"
        >

            {{-- MOBILE SCROLL --}}
            <div class="overflow-x-auto">
                <table class="min-w-[900px] w-full text-sm text-center">
                    <thead class="bg-indigo-600 text-white sticky top-0">
                        <tr>
                            <th class="px-2 py-2">#</th>
                            <th class="px-3 py-2 text-left">Team</th>
                            <th>P</th>
                            <th>W</th>
                            <th>D</th>
                            <th>L</th>
                            <th>Pts</th>
                            <th>GF</th>
                            <th>GA</th>
                            <th>GD</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($group['groupteam'] as $team)
                        <tr class="odd:bg-white even:bg-gray-100">
                            <td class="px-2 py-2 font-semibold">
                                {{ $team->rank }}
                            </td>

                            <td class="px-3 py-2 text-left whitespace-nowrap">
                                {{ $team->team->name ?? 'Unknown' }}
                            </td>

                            <td>{{ $team->played ?? 0 }}</td>
                            <td>{{ $team->wins ?? 0 }}</td>
                            <td>{{ $team->draws ?? 0 }}</td>
                            <td>{{ $team->losses ?? ($team->loses ?? 0) }}</td>
                            <td class="font-bold text-indigo-700">
                                {{ $team->points ?? 0 }}
                            </td>
                            <td>{{ $team->gf ?? 0 }}</td>
                            <td>{{ $team->ga ?? 0 }}</td>
                            <td>{{ $team->gd ?? 0 }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    @endforeach
</div>
@endif


    {{-- ---------- MATCH SCHEDULE ---------- --}}
    @php
        $hasUpcoming = isset($upcomingMatchDetail) && count($upcomingMatchDetail) > 0;
        $hasLive = isset($liveMatches) && $liveMatches->isNotEmpty();
        $hasResult = isset($resultMatchDetail) && count($resultMatchDetail) > 0;
    @endphp
@if($hasUpcoming || $hasLive || $hasResult)
<div
    x-data="{ tab: '{{ $hasUpcoming ? 'upcoming' : ($hasLive ? 'live' : 'result') }}' }"
    class="w-full max-w-5xl mx-auto flex flex-col space-y-6 bg-[url('/img/logreg.jpg')] bg-cover bg-center p-6 rounded-xl"
>
    <h1 class="text-3xl font-extrabold text-center text-white">
        MATCH SCHEDULE
    </h1>

    {{-- Tabs --}}
    <div class="flex justify-center gap-2 flex-wrap">
        @if($hasUpcoming)
        <button
            @click="tab = 'upcoming'"
            :class="tab === 'upcoming' ? 'bg-indigo-700' : 'bg-indigo-500'"
            class="px-4 py-2 text-white rounded-full font-semibold transition"
        >
            UPCOMING
        </button>
        @endif

        @if($hasLive)
        <button
            @click="tab = 'live'"
            :class="tab === 'live' ? 'bg-red-700' : 'bg-red-500'"
            class="px-4 py-2 text-white rounded-full font-semibold transition"
        >
            LIVE
        </button>
        @endif

        @if($hasResult)
        <button
            @click="tab = 'result'"
            :class="tab === 'result' ? 'bg-green-700' : 'bg-green-500'"
            class="px-4 py-2 text-white rounded-full font-semibold transition"
        >
            RESULT
        </button>
        @endif
    </div>

    {{-- CONTENT --}}
    <div class="space-y-4">

        {{-- UPCOMING --}}
        @if($hasUpcoming)
        <div x-show="tab === 'upcoming'" x-cloak class="space-y-4">
            @foreach($upcomingMatchDetail as $upcoming)
            <x-match-card
                :teamA="$upcoming['teamA']"
                :teamB="$upcoming['teamB']"
                :meta="[
                    $upcoming['upmatch']->category->name ?? 'N/A',
                    $upcoming['upmatch']->groupcreate->Name ?? 'N/A',
                    $upcoming['upmatch']->Date,
                    $upcoming['upmatch']->start_time.' - '.$upcoming['upmatch']->end_time,
                ]"
                :action-url="url('/match/'.$upcoming['upmatch']->Match_groupID)"
                action-label="Lineup"
            />
            @endforeach
        </div>
        @endif

        {{-- LIVE --}}
        @if($hasLive)
        <div x-show="tab === 'live'" x-cloak class="space-y-4">
            @foreach($liveMatchDetails as $detail)
            <x-match-card
                :teamA="$detail['teamA']"
                :teamB="$detail['teamB']"
                :meta="[
                    $detail['match']->category->name ?? 'N/A',
                    $detail['match']->groupcreate->Name ?? 'N/A',
                    $detail['match']->Date,
                    $detail['match']->start_time.' - '.$detail['match']->end_time,
                ]"
                :score-a="$detail['match']->ScoreA"
                :score-b="$detail['match']->ScoreB"
                score-color="text-red-600"
                :action-url="url('/livematch/'.$detail['match']->Match_groupID)"
                action-label="Live Score"
            />
            @endforeach
        </div>
        @endif

        {{-- RESULT --}}
        @if($hasResult)
        <div x-show="tab === 'result'" x-cloak class="space-y-4">
            @foreach($resultMatchDetail as $result)
            <x-match-card
                :teamA="$result['teamA']"
                :teamB="$result['teamB']"
                :meta="[
                    $result['resultmatch']->category->name ?? 'N/A',
                    $result['resultmatch']->groupcreate->Name ?? 'N/A',
                    $result['resultmatch']->Date,
                    $result['resultmatch']->start_time.' - '.$result['resultmatch']->end_time,
                ]"
                :score-a="$result['resultmatch']->ScoreA"
                :score-b="$result['resultmatch']->ScoreB"
                score-color="text-green-600"
            />
            @endforeach
        </div>
        @endif

    </div>
</div>
@endif



{{-- ---------- TOURNAMENT BRACKET ---------- --}}
@php
        function bracketHasData($bracket) {
            if (!is_array($bracket)) return false;

            foreach ($bracket as $section) {
                if (is_array($section)) {
                    foreach ($section as $sub) {
                        if (is_array($sub)) {
                            foreach ($sub as $v) {
                                if (!empty($v)) return true;
                            }
                        } else {
                            if (!empty($sub)) return true;
                        }
                    }
                } else {
                    if (!empty($section)) return true;
                }
            }

            return false;
        }

        $hasBracketData = bracketHasData($bracket);
    @endphp
@if($hasBracketData)
<div class="w-full max-w-7xl bg-white bg-opacity-70 rounded-xl p-6 shadow-lg flex flex-col items-center space-y-6 mt-8">
    <h2 class="text-2xl font-bold text-center mb-4">Tournament Bracket</h2>

    <div class="w-full flex flex-wrap justify-center gap-6">
        @foreach(['quarter_finals','semi_finals','final'] as $stage)
            <div class="flex flex-col items-center space-y-2">
                @foreach($bracket[$stage] ?? [] as $side => $teams)
                    @foreach($teams ?? [] as $match)
                        @foreach((array)$match as $team)
                            <div class="px-4 py-2 bg-green-500 text-white font-semibold rounded-lg text-center min-w-[120px]">{{ $team ?? 'TBD' }}</div>
                        @endforeach
                    @endforeach
                @endforeach
            </div>
        @endforeach
    </div>

    <div class="mt-4">
        <div class="px-6 py-3 bg-yellow-500 text-white font-bold rounded-lg text-center text-xl">
            Champion: {{ $bracket['champion']['team1'] ?? $bracket['champion']['team2'] ?? 'TBD' }}
        </div>
    </div>
</div>
@endif

</div>
<script>
    function openGroup(evt, groupId) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) tabcontent[i].style.display = "none";

        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) tablinks[i].classList.remove("active");

        var el = document.getElementById(groupId);
        if (el) el.style.display = "block";
        if (evt && evt.currentTarget) evt.currentTarget.classList.add("active");
    }
</script>

@push('scripts')
<script src="js/faq.js"></script>
<script>
    // Modal
    const modal = document.getElementById('registerTeamModal');
    const btn = document.getElementById('registerTeamBtn');
    const closeBtn = modal.querySelector('.close');

    btn.addEventListener('click', () => modal.classList.remove('hidden'));
    closeBtn.addEventListener('click', () => modal.classList.add('hidden'));
    window.addEventListener('click', (e) => {
        if (e.target === modal) modal.classList.add('hidden');
    });

    // Tabs
    function openGroup(evt, groupId){
        document.querySelectorAll('.tabcontent').forEach(e=>e.classList.add('hidden'));
        document.getElementById(groupId)?.classList.remove('hidden');
        document.querySelectorAll('.tablinks').forEach(b=>b.classList.remove('ring-2','ring-black'));
        evt.currentTarget.classList.add('ring-2','ring-black');
    }
</script>

@endpush
</x-guest-layout>
