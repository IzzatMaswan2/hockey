<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $tournament->name }} Details</title>
    <link href="{{ asset('css/tournamentlist.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"> 
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
    <style>
/* Modal background and content styling */
.modal {
    display: none;
    position: fixed;
    z-index: 9999;
    left: 0;
    top: 0;
    width: 600px;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.6); /* Dark overlay */
}

/* Compact and thinner modal */
.modal-content {
    background-color: #fefefe;
    position: relative;
    margin: 0 auto;
    top: 3%; /* Higher position */
    padding: 10px; /* Smaller padding */
    border-radius: 8px;
    border: 1px solid #888;
    width: 100%; /* Thinner width - only 20% of the screen */
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    max-width: 600px; /* Ensures it doesn't get too wide on large screens */
    min-width: 400px; /* Prevents it from getting too small */
}

/* Close button styling */
.close {
    color: #aaa;
    float: right;
    font-size: 18px; /* Smaller size */
    font-weight: bold;
    cursor: pointer;
}

.close:hover,
.close:focus {
    color: #000;
}

/* Form styling */
form {
    display: flex;
    flex-direction: column;
}

form label {
    margin: 5px 0 3px; /* Smaller margin */
    font-weight: bold;
    font-size: 14px; /* Smaller font */
}

form input {
    padding: 6px; /* Smaller padding */
    border: 1px solid #ccc;
    border-radius: 20px;
    margin-bottom: 8px; /* Smaller spacing between fields */
    font-size: 14px; /* Smaller font */
    width: 100%;
    box-sizing: border-box;
    transition: border-color 0.3s ease;
}

form input:focus {
    border-color: #007bff;
    outline: none;
}

/* Submit button styling */
button[type="submit"] {
    padding: 8px 10px; /* Smaller padding */
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px; /* Smaller font size */
    margin-top: 8px;
}

button[type="submit"]:hover {
    background-color: #0056b3;
}

/* Modal Title Styling */
.modal-content h2 {
    font-size: 16px; /* Smaller title */
    margin-bottom: 10px;
    text-align: center;
    color: #333;
}

/* Add padding to container */
.container1 {
    padding: 15px;
}

/* small badge for initials when no logo */
.team-initials {
    display:inline-flex;
    align-items:center;
    justify-content:center;
    width:60px;
    height:60px;
    border-radius:8px;
    background:#f1f1f1;
    color:#333;
    font-weight:600;
    font-size:14px;
    text-transform:uppercase;
}

/* subtle hidden class */
.hidden { display: none !important; }

        </style>
</head>
<body>
@include('components.side-nav')
@include('profile.partials.navbar')

    <div class="content">
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
        <div class="container1">
            <h1>{{ $tournament->tournament_name }} Details</h1>

            <div class="details-box">
                <div class="image-container">
                    <img src="{{ asset('storage/' . $tournament->image) }}" alt="{{ $tournament->name }}" style="width:200px;height:200px">
                </div>
                <p> <strong>Number of Teams:</strong> {{ $tournament->no_team }}</p>
                <p><strong>Number of Groups:</strong> {{ $tournament->no_group }}</p>
                <p><strong>Start Date:</strong> {{ $tournament->start_date }},  {{ $tournament->start_time }}</p>
                <p><strong>End Date:</strong> {{ $tournament->end_date }},  {{ $tournament->end_time }}</p>
                <p><strong>Venue:</strong> {{ $tournament->venue->name }}</p>
                <p><strong>Category:</strong> {{ $tournament->category }}</p>
                <p><strong>Description:</strong> {{ $tournament->description }}</p>
            </div>

            <a href="{{ route('tournamentlist.view') }}" class="tournament-button">Back to Tournament List</a>

            <button id="registerTeamBtn" class="register-button" 
            {{ $isRegistrationFull ? 'disabled' : '' }}>
            {{ $isRegistrationFull ? 'Team Registration Full' : 'Register Your Team' }}
        </button>

            
        </div>

            @if(Auth::check())
            <!-- If user is logged in, show team name input only -->
            <div id="registerTeamModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Register Your Team </h2>
                    <form action="{{ route('tournament-details') }}" method="POST">
                        @csrf
                        <input type="hidden" name="tournament_id" value="{{ $tournament->id }}">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        
                        <label for="teamName">Team Name:</label>
                        <input type="text" id="teamName" name="teamName" value="{{ Auth::user()->team ? Auth::user()->team->name : 'N/A' }}"required>

                        @if($availableCategories->isNotEmpty())
                            <label for="category">Select Category:</label>
                            <select name="category_id" id="category" required>
                                @foreach($availableCategories as $cat)
                                    <option value="{{ $cat->id }}"
                                        {{ ($selectedCategoryId == $cat->id) ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        @endif

                        <button type="submit" style="font-weight:bold;">Submit</button>
                    </form>
                </div>
            </div>
        @else

        <div id="registerTeamModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Register Your Team</h2>
                <form action="{{ route('tournament-details') }}" method="POST">
                    @csrf
                    <input type="hidden" name="tournament_id" value="{{ $tournament->id }}">
                    <label for="fullName">Full Name:</label>
                    <input type="text" id="fullName" name="fullName" required>

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>

                    <label for="occupation">Occupation:</label>
                    <input type="text" id="occupation" name="occupation" required>

                    <label for="teamName">Team Name:</label>
                    <input type="text" id="teamName" name="teamName" required>

                        @if($availableCategories->isNotEmpty())
                            <label for="category">Select Category:</label>
                            <select name="category_id" id="category" required>
                                @foreach($availableCategories as $cat)
                                    <option value="{{ $cat->id }}"
                                        {{ ($selectedCategoryId == $cat->id) ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        @endif


                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" required>

                    <label for="country">Country:</label>
                    <input type="text" id="country" name="country" required>

                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>

                    <label for="password_confirmation">Confirm Password:</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required>

                    <button type="submit" style="font-weight:bold;">Submit</button>
                </form>
            </div>
        </div>
        @endif

        </div>

    {{-- ---------- CATEGORY SELECTOR (AUTO FIRST, NO "ALL") ---------- --}}

    @if($hasCategory)
    <div class="container1" style="margin-bottom: 20px;">
        <h2>Categories</h2>

        <div class="d-flex gap-2 flex-wrap">
            @foreach($categories as $cat)
                <a href="{{ url()->current() }}?category_id={{ $cat->id }}"
                class="btn btn-outline-primary {{ $selectedCategoryId === (int)$cat->id ? 'active' : '' }}" style="background-color: rgba(255, 255, 255, 0.7); ">
                    {{ $cat->name }}
                </a>
            @endforeach
        </div>

        <p class="mt-2 text-muted" style="color: white;">
            Showing Category: 
            {{ $categories->firstWhere('id', $selectedCategoryId)->name ?? 'Unknown' }}
        </p>
    </div>
    @endif
    {{-- ---------- END CATEGORY SELECTOR ---------- --}}



    {{-- ---------- PARTICIPANTS ---------- --}}
    @php
        // Attempt to filter participants by category_id if competitions have that field.
        $participants = $teamsjoin ?? collect();
        if ($selectedCategoryId) {
            // If competition has category_id property on server side, it will be filtered.
            $participants = $participants->filter(function($c) use ($selectedCategoryId) {
                // Safely handle both possible property names
                $catId = $c->category_id ?? $c->categoryId ?? $c->category ?? null;
                if ($catId === null) {
                    // no category info on participant -> exclude when a category filter is selected
                    return false;
                }
                return (int)$catId === (int)$selectedCategoryId;
            })->values();
        }

        // dd($participants);
    @endphp

    @if($participants->isNotEmpty())
    <div class="container1" style="margin-bottom: 10px;">
        <h2>Participants</h2>
        <h3>Teams Competing in this Tournament:</h3>
        <table style="width: 80%; margin: 0 auto; background-color: rgba(255, 255, 255, 0.7);">
            <thead>
                <tr>
                    <th>Team Name</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            @foreach($teamsForCurrentPage as $competition)
                @if(!$selectedCategoryId || $competition->category_id == $selectedCategoryId)
                    <tr>
                        <td>{{ $competition->team->name ?? 'N/A' }}</td>
                        <td>TBD</td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>

        {{-- Custom Pagination Links --}}
        <div class="custom-pagination" style="text-align: center; margin-top: 20px;">
            @php
                $totalPages = ceil($totalTeams / $perPage);
            @endphp

            {{-- Previous Page --}}
            @if ($currentPage > 1)
                <a href="{{ url()->current() }}?page={{ $currentPage - 1 }}{{ $selectedCategoryId ? '&category_id='.$selectedCategoryId : '' }}" class="pagination-prev" style="font-size: 19px; padding: 5px;">Previous</a>
            @endif

            {{-- Page Numbers --}}
            @for ($i = 1; $i <= $totalPages; $i++)
                @if ($i == $currentPage)
                    <span style="font-weight: bold;text:white; font-size: 19px; padding: 5px;">{{ $i }}</span>
                @else
                    <a href="{{ url()->current() }}?page={{ $i }}{{ $selectedCategoryId ? '&category_id='.$selectedCategoryId : '' }}" class="pagination-page" style="font-size: 12px; padding: 5px;">{{ $i }}</a>
                @endif
            @endfor

            {{-- Next Page --}}
            @if ($currentPage < $totalPages)
                <a href="{{ url()->current() }}?page={{ $currentPage + 1 }}{{ $selectedCategoryId ? '&category_id='.$selectedCategoryId : '' }}" class="pagination-next" style="font-size: 19px; padding: 5px;">Next</a>
            @endif
        </div>
    </div>
    @endif
    {{-- ---------- end PARTICIPANTS ---------- --}}


    {{-- ---------- GROUPS (only show if groups exist) ---------- --}}
    @if(!empty($groupData) && count($groupData) > 0)
        <div class="tab-container">
            <div class="tab">
                @foreach($groupData as $index => $group)
                    <button class="tablinks {{ $index === 0 ? 'active' : '' }}" 
                        onclick="openGroup(event, 'group{{ $group['group']->GroupID }}')">
                        {{ $group['group']->Name }}
                    </button>
                @endforeach
            </div>
        </div>

        @foreach($groupData as $index => $group)
            <div class="containertable" 
                style="display: flex; flex-direction: column; align-items: center; justify-content: center; border-radius:20px; overflow:hidden;">

                <div id="group{{ $group['group']->GroupID }}" 
                    class="tabcontent group-table"
                    style="width:100%; {{ $index === 0 ? 'display:block;' : 'display:none;' }}">

                    <table style="width: 100%">
                        <thead>
                            <tr>
                                <th style="width:5%">Rank</th>
                                <th >Team</th>
                                <th >Played</th>
                                <th >Win</th>
                                <th >Draw</th>
                                <th >Lose</th>
                                <th >Point</th>
                                <th>GF</th>
                                <th>GA</th>
                                <th>GD</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($group['groupteam'] as $groupteam)
                            <tr>
                                <td>{{ $groupteam->rank }}</td>
                                <td>{{ $groupteam->team->name ?? 'Unknown Team' }}</td>
                                <td>{{ $groupteam->played ?? '0' }}</td>
                                <td>{{ $groupteam->wins ?? '0' }}</td>
                                <td>{{ $groupteam->draws ?? '0' }}</td>
                                <td>{{ $groupteam->losses ?? ($groupteam->loses ?? '0') }}</td>
                                <td>{{ $groupteam->points ?? '0' }}</td>
                                <td>{{ $groupteam->gf ?? '0' }}</td>
                                <td>{{ $groupteam->ga ?? '0' }}</td>
                                <td>{{ $groupteam->gd ?? '0' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        @endforeach
    @endif
    {{-- ---------- end GROUPS ---------- --}}


    {{-- ---------- MATCH SCHEDULE (hide if all empty) ---------- --}}
    @php
        $hasUpcoming = isset($upcomingMatchDetail) && count($upcomingMatchDetail) > 0;
        $hasLive = isset($liveMatches) && $liveMatches->isNotEmpty();
        $hasResult = isset($resultMatchDetail) && count($resultMatchDetail) > 0;
    @endphp

    @if($hasUpcoming || $hasLive || $hasResult)
        <h1 class="matchschedule-heading">MATCH SCHEDULE</h1>

        <div class="scheduletab">
            <button class="scheduletablinks" onclick="openScheduleGroup(event, 'UPCOMING')" id="defaultScheduleOpen">UPCOMING</button>
            <button class="scheduletablinks" onclick="openScheduleGroup(event, 'LIVE')">LIVE</button>
            <button class="scheduletablinks" onclick="openScheduleGroup(event, 'RESULT')">RESULT</button>
        </div>
        
        <div class="match-container">
            <div id="UPCOMING" class="scheduletabcontent mtabcontent" style="{{ $hasUpcoming ? '' : 'display:none;' }}">
                @if($hasUpcoming)
                    @foreach($upcomingMatchDetail as $upcoming)
                        <div class="matchtab">
                            <div class="tabm">
                                @if(!empty($upcoming['teamA']) && !empty($upcoming['teamA']->logoURL))
                                    <img src="{{ asset('storage/' . $upcoming['teamA']->logoURL) }}"
                                        alt="{{ $upcoming['teamA']->Name }} Logo"
                                        class="teamlogo left">
                                    {{-- {{ 'storage/' . $upcoming['teamA']->logoURL }} --}}
                                @else
                                    {{-- fallback initials --}}
                                    <div class="team-initials">
                                        {{ \Illuminate\Support\Str::of($upcoming['teamA']->Name ?? 'No Logo')->words(2, '')->map(fn($w)=>substr($w,0,1))->join() }}
                                    </div>
                                @endif
                                <div class="matchcontent">
                                    <h3>{{$upcoming['teamA']->Name ?? 'TBA'}}</h3>
                                    <p>{{$upcoming['teamA']->country  ?? 'TBA'}}</p>
                                    {{-- <p>Rating: 97%</p> --}}
                                    <a href="/match/{{$upcoming['upmatch']->Match_groupID  ?? 'TBA'}}" class="lineup-button">Lineup</a>
                                </div>
                            </div>

                            <div class="vs-container">
                                <div>{{$upcoming['upmatch']->category->name ?? 'N/A'}}</div>
                                <div>{{$upcoming['upmatch']->groupcreate->Name ?? 'N/A'}}</div>
                                <div class="vs">vs</div>
                                <div class="date">{{$upcoming['upmatch']->Date}}</div>
                                <div class="time">{{$upcoming['upmatch']->start_time}} - {{$upcoming['upmatch']->end_time}}</div>
                            </div>

                            <div class="tabm">
                                <div class="matchcontent">
                                    <h3>{{$upcoming['teamB']->Name ?? 'TBA'}}</h3>
                                    <p>{{$upcoming['teamB']->country ?? 'TBA'}}</p>
                                    {{-- <p>Rating: 93%</p> --}}
                                    <a href="/match/{{$upcoming['upmatch']->Match_groupID  ?? 'TBA'}}" class="lineup-button">Lineup</a>
                                </div>
                                @if(!empty($upcoming['teamB']) && !empty($upcoming['teamB']->logoURL))
                                    <img src="{{ asset('storage/' . $upcoming['teamB']->logoURL) }}"
                                        alt="{{ $upcoming['teamB']->Name }} Logo"
                                        class="teamlogo right">
                                @else
                                    <div class="team-initials">
                                        {{ \Illuminate\Support\Str::of($upcoming['teamB']->Name ?? 'No Logo')->words(2, '')->map(fn($w)=>substr($w,0,1))->join() }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        <div class="match-container" style="{{ $hasLive ? '' : 'display:none;' }}">
            <div id="LIVE" class="scheduletabcontent mtabcontent">
                @if(!$hasLive)
                    <p>There No Match At the Moment</p>
                @else
                    @foreach ($liveMatchDetails as $detail)
                        <div class="matchtab">
                            <div class="tabm">
                                @if(!empty($detail['teamA']) && !empty($detail['teamA']->logoURL))
                                    <img src="{{ asset('storage/' . $detail['teamA']->logoURL) }}" alt="{{ $detail['teamA']->Name }} Logo" class="teamlogo left">
                                @else
                                    <div class="team-initials">{{ \Illuminate\Support\Str::of($detail['teamA']->Name ?? 'No Logo')->words(2, '')->map(fn($w)=>substr($w,0,1))->join() }}</div>
                                @endif
                                <div class="matchcontent">
                                    <h3>{{$detail['teamA']->Name ?? 'TBA'}}</h3>
                                    <div class="livescore">{{$detail['match']->ScoreA ?? 'N/A'}}</div>
                                </div>
                            </div>
                
                            <div class="vs-container">
                                <div class="vs">vs</div>
                                <div class="timer">{{$detail['match']->start_time}} - {{$detail['match']->end_time}}</div> 
                                <a href="/livematch/{{$detail['match']->Match_groupID}}" class="lineup-button">Live Score</a>
                            </div>
                
                            <div class="tabm">
                                <div class="matchcontent">
                                    <h3>{{$detail['teamB']->Name ?? 'TBA'}}</h3>
                                    <div class="livescore">{{$detail['match']->ScoreB ?? 'N/A' }}</div>
                                </div>
                                @if(!empty($detail['teamB']) && !empty($detail['teamB']->logoURL))
                                    <img src="{{ asset('storage/' . $detail['teamB']->logoURL) }}" alt="{{ $detail['teamB']->Name }} Logo" class="teamlogo right">
                                @else
                                    <div class="team-initials">{{ \Illuminate\Support\Str::of($detail['teamB']->Name ?? 'No Logo')->words(2, '')->map(fn($w)=>substr($w,0,1))->join() }}</div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        <div class="match-container" style="{{ $hasResult ? '' : 'display:none;' }}">
            <div id="RESULT" class="scheduletabcontent mtabcontent">
                @if($hasResult)
                    @foreach ($resultMatchDetail as $result)
                        <div class="matchtab">
                            <div class="tabm">
                                @if(!empty($result['teamA']) && !empty($result['teamA']->logoURL))
                                    <img src="{{ asset('storage/' . $result['teamA']->logoURL) }}" alt="{{ $result['teamA']->Name }} Logo" class="teamlogo left">
                                @else
                                    <div class="team-initials">{{ \Illuminate\Support\Str::of($result['teamA']->Name ?? 'No Logo')->words(2, '')->map(fn($w)=>substr($w,0,1))->join() }}</div>
                                @endif
                                <div class="matchcontent">
                                    <h3>{{$result['teamA']->Name ?? 'TBA'}}</h3>
                                    <div class="finalscore">{{$result['resultmatch']->ScoreA}}</div>
                                </div>
                            </div>
                            
                            <div class="vs-container">
                                <div class="vs">vs</div>
                            </div>
                
                            
                            <div class="tabm">
                                <div class="matchcontent">
                                    <h3>{{$result['teamB']->Name ?? 'TBA'}}</h3>
                                    <div class="finalscore">{{$result['resultmatch']->ScoreB}}</div>
                                </div>
                                @if(!empty($result['teamB']) && !empty($result['teamB']->logoURL))
                                    <img src="{{ asset('storage/' . $result['teamB']->logoURL) }}" alt="{{ $result['teamB']->Name }} Logo" class="teamlogo right">
                                @else
                                    <div class="team-initials">{{ \Illuminate\Support\Str::of($result['teamB']->Name ?? 'No Logo')->words(2, '')->map(fn($w)=>substr($w,0,1))->join() }}</div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    @endif
    {{-- ---------- end MATCH SCHEDULE ---------- --}}


    {{-- ---------- BRACKET (move down; hide if empty) ---------- --}}
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
    <main>
        <div class="tournament-bracket zoom-in">
            <div class="container-tour">
                <div class="tournament-container">
                    <div class="tournament-headers">
                        <h4>QUARTER-FINAL</h4>
                        <h4>SEMI-FINAL</h4>
                        <h4>FINAL</h4>
                        <h4>SEMI-FINAL</h4>
                        <h4>QUARTER-FINAL</h4>
                    </div>

                    <div class="tournament-brackets">
                        {{-- Left side quarter-finals --}}
                        <ul class="bracket bracket-1">
                            <li class="team-item">{{ $bracket['quarter_finals']['left']['top']['team1'] ?? 'Seed #1' }}</li>
                            <li class="team-item">{{ $bracket['quarter_finals']['left']['top']['team2'] ?? 'Seed #8' }}</li>
                            <li class="team-item">{{ $bracket['quarter_finals']['left']['top2']['team1'] ?? 'Seed #9' }}</li>
                            <li class="team-item">{{ $bracket['quarter_finals']['left']['top2']['team2'] ?? 'Seed #16' }}</li>

                            <li class="team-item">{{ $bracket['quarter_finals']['left']['bottom']['team1'] ?? 'Seed #4' }}</li>
                            <li class="team-item">{{ $bracket['quarter_finals']['left']['bottom']['team2'] ?? 'Seed #5' }}</li>
                            <li class="team-item">{{ $bracket['quarter_finals']['left']['bottom2']['team1'] ?? 'Seed #13' }}</li>
                            <li class="team-item">{{ $bracket['quarter_finals']['left']['bottom2']['team2'] ?? 'Seed #12' }}</li>
                        </ul>

                        {{-- Left side semi-finals --}}
                        <ul class="bracket bracket-2">
                            <li class="team-item">{{ $bracket['semi_finals']['left']['team1'] ?? 'Winner Left Top' }}</li>
                            <li class="team-item">{{ $bracket['semi_finals']['left']['team2'] ?? 'Winner Left Bottom' }}</li>
                            <li class="team-item">{{ $bracket['semi_finals']['left']['team3'] ?? 'Winner Left Top 2' }}</li>
                            <li class="team-item">{{ $bracket['semi_finals']['left']['team4'] ?? 'Winner Left Bottom 2' }}</li>
                        </ul>

                        {{-- Finals --}}
                        <ul class="bracket bracket-3">
                            <li class="team-item">{{ $bracket['final']['team1'] ?? 'Finalist 1' }}</li>
                            <li class="team-item">{{ $bracket['final']['team2'] ?? 'Finalist 2' }}</li>
                        </ul>

                        {{-- Right side semi-finals --}}
                        <ul class="bracket bracket-2">
                            <li class="team-item reverse">{{ $bracket['semi_finals']['right']['team1'] ?? 'Winner Right Top' }}</li>
                            <li class="team-item reverse">{{ $bracket['semi_finals']['right']['team2'] ?? 'Winner Right Bottom' }}</li>
                            <li class="team-item reverse">{{ $bracket['semi_finals']['right']['team3'] ?? 'Winner Right Top 2' }}</li>
                            <li class="team-item reverse">{{ $bracket['semi_finals']['right']['team4'] ?? 'Winner Right Bottom 2' }}</li>
                        </ul>

                        {{-- Right side quarter-finals --}}
                        <ul class="bracket bracket-1">
                            <li class="team-item reverse">{{ $bracket['quarter_finals']['right']['top']['team1'] ?? 'Seed #2' }}</li>
                            <li class="team-item reverse">{{ $bracket['quarter_finals']['right']['top']['team2'] ?? 'Seed #7' }}</li>
                            <li class="team-item reverse">{{ $bracket['quarter_finals']['right']['top2']['team1'] ?? 'Seed #10' }}</li>
                            <li class="team-item reverse">{{ $bracket['quarter_finals']['right']['top2']['team2'] ?? 'Seed #15' }}</li>

                            <li class="team-item reverse">{{ $bracket['quarter_finals']['right']['bottom']['team1'] ?? 'Seed #3' }}</li>
                            <li class="team-item reverse">{{ $bracket['quarter_finals']['right']['bottom']['team2'] ?? 'Seed #6' }}</li>
                            <li class="team-item reverse">{{ $bracket['quarter_finals']['right']['bottom2']['team1'] ?? 'Seed #14' }}</li>
                            <li class="team-item reverse">{{ $bracket['quarter_finals']['right']['bottom2']['team2'] ?? 'Seed #11' }}</li>
                        </ul>

                        {{-- Champion --}}
                        <ul class="bracket-champion">
                            <li class="champion-item">
                                @if(isset($bracket['champion']['team1']) && $bracket['champion']['team1'])
                                    {{ $bracket['champion']['team1'] }}
                                @elseif(isset($bracket['champion']['team2']) && $bracket['champion']['team2'])
                                    {{ $bracket['champion']['team2'] }} 
                                @else
                                    Champion TBD
                                @endif
                            </li>
                        </ul>
                    </div>

                </div>
            </div> 
        </div>
    </main>
    @endif
    {{-- ---------- end BRACKET ---------- --}}


    <script src="{{ asset('js/tournament.js') }}"></script>
    <script>
    // Get the modal
    var modal = document.getElementById("registerTeamModal");

    // Get the button that opens the modal
    var btn = document.getElementById("registerTeamBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal
    if (btn) {
        btn.onclick = function() {
            modal.style.display = "block";
        }
    }

    // When the user clicks on <span> (x), close the modal
    if (span) {
        span.onclick = function() {
            modal.style.display = "none";
        }
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    // small helper functions for tabs (reuse existing function names if you already have them)
    function openGroup(evt, groupId) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].classList.remove("active");
        }
        var el = document.getElementById(groupId);
        if (el) el.style.display = "block";
        if (evt && evt.currentTarget) evt.currentTarget.classList.add("active");
    }

    function openScheduleGroup(evt, scheduleId) {
        var i, x;
        x = document.getElementsByClassName("scheduletabcontent");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        var el = document.getElementById(scheduleId);
        if (el) el.style.display = "block";
        var btns = document.getElementsByClassName("scheduletablinks");
        for (i = 0; i < btns.length; i++) btns[i].classList.remove("active");
        if (evt && evt.currentTarget) evt.currentTarget.classList.add("active");
    }

    // open default schedule tab if present
    document.addEventListener('DOMContentLoaded', function() {
        var defaultBtn = document.getElementById('defaultScheduleOpen');
        if (defaultBtn) defaultBtn.click();

        // if no schedule at all, hide schedule heading area — already handled server side
    });
</script>

@include('profile.partials.footer')
</body>
</html>
