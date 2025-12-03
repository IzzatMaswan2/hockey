<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Match Score Entry and Approval</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/771de58f02.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.2.2/dist/echarts.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1 { color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f2f2f2; }
        button { padding: 10px; background-color: #28a745; color: white; border: none; cursor: pointer; }
        button:hover { background-color: #218838; }
        .message { margin-top: 20px; color: green; }
        .error { color: red; }
    </style>
</head>

<body style="background-color: #f4f7f6;">
    @include('layouts.navbar')

    <div class="container-fluid" style="height: 90%; padding: 0;">
        <div class="row">
            <div class="col-3" style="background-color: #D3D3D3;">
                @include('layouts.sidebar-manager')
            </div>

            <div class="col-9 mt-5">
                <h1>Knockout Matches</h1>
                <h2>Ongoing Matches</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col" style="width:10%;">Match ID</th>
                            <th scope="col" style="width:40%;">Teams</th>
                            <th scope="col" style="width:30%;">Date & Time</th>
                            <th scope="col" style="width:20%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($livematches as $match)
                        <tr>
                            <td>{{ $match->id }}</td>
                            <td>
                                @if(!empty($match->team1->logoURL) && Storage::disk('public')->exists($match->team1->logoURL))
                                    <img src="{{ asset('storage/' . $match->team1->logoURL) }}" alt="{{ $match->team1->Name }}" class="team-logo" style="width: 40px; height: 40px;">
                                @endif
                                {{ $match->team1->Name }} vs
                                @if(!empty($match->team2->logoURL) && Storage::disk('public')->exists($match->team2->logoURL))
                                    <img src="{{ asset('storage/' . $match->team2->logoURL) }}" alt="{{ $match->team2->Name }}" class="team-logo" style="width: 40px; height: 40px;">
                                @endif
                                {{ $match->team2->Name }}
                            </td>
                            <td>{{ $match->date }} & {{ $match->start_time }}</td>
                            <td>
                                @if($match->team1_id == $teamId)
                                    @php
                                        $approval = $match->approvals->first(); 
                                    @endphp
                                    @if($approval && $approval->managerA_approved >= 1)
                                        <div>Pending</div>
                                    @else
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#scoreModal" onclick="document.getElementById('modal_match_id').value = {{ $match->id }}">
                                            Submit Score
                                        </button>
                                    @endif
                                @elseif($match->team2_id == $teamId)
                                    @php
                                        $approval = $match->approvals->first(); // Assuming there is only one approval for the match
                                    @endphp
                                    @if($approval && $approval->managerB_approved >= 1)
                                        <div>Pending</div>
                                    @else
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#scoreModal" onclick="document.getElementById('modal_match_id').value = {{ $match->id }}">
                                            Submit Score
                                        </button>
                                    @endif
                                @endif
                            </td>
                        </tr>

                            <div class="modal fade" id="scoreModal" tabindex="-1" aria-labelledby="scoreModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="scoreModalLabel">Submit Match Score</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('knockout.match-score.submit') }}" method="POST" class="modal-content">
                                                @csrf
                                                <input type="hidden" name="match_id" id="modal_match_id"> <!-- Hidden input for match_id -->
                                                
                                                <div class="mb-3">
                                                    <label for="score_a" class="form-label">{{$match->team1->Name}} Score:</label>
                                                    <input type="number" id="score_a" name="score_a" class="form-control" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="score_b" class="form-label">{{$match->team2->Name}} Score:</label>
                                                    <input type="number" id="score_b" name="score_b" class="form-control" required>
                                                </div>
                                                <div>
                                                    {{-- Team A ID {{$allmatches[]}}
                                                Team B ID {{$allmatches[]}} --}}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">Submit Score</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>

                <!-- Upcoming Matches -->
                <h2>Upcoming Matches</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col" style="width:10%;">Match ID</th>
                            <th scope="col" style="width:40%;">Teams</th>
                            <th scope="col" style="width:30%;">Date & Time</th>
                            <th scope="col" style="width:20%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($upcomingmatches as $match)
                            <tr>
                                <td>{{ $match->id }}</td>
                                <td>
                                    <div>
                                        @if(!empty($match->team1->logoURL) && Storage::disk('public')->exists($match->team1->logoURL))
                                            <img src="{{ asset('storage/' . $match->team1->logoURL) }}" alt="{{ $match->team1->Name }}" class="team-logo me-2" style="width: 40px; height: 40px;">
                                        @endif
                                        {{ $match->team1->Name ?? 'Unknown Team A' }}
                                        vs
                                        @if(!empty($match->team2->logoURL) && Storage::disk('public')->exists($match->team2->logoURL))
                                            <img src="{{ asset('storage/' . $match->team2->logoURL) }}" alt="{{ $match->team2->Name }}" class="team-logo ms-2" style="width: 40px; height: 40px;">
                                        @endif
                                        {{ $match->team2->Name ?? 'Unknown Team B' }}
                                    </div>
                                </td>
                                <td>{{ $match->date }} & {{ $match->start_time }}</td>
                                <td>
                                    <!-- Button to open modal -->
                                    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#matchDetailModal{{ $match->id }}">
                                        See Details
                                    </button>
                                </td>
                            </tr>
                    
                            <!-- Modal for Match Details -->
                            <div class="modal fade" id="matchDetailModal{{ $match->id }}" tabindex="-1" aria-labelledby="matchDetailModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="matchDetailModalLabel">Match Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Match ID:</strong> {{ $match->id }}</p>
                                            <p><strong>Team A:</strong> 
                                                @if(!empty($match->team1->logoURL) && Storage::disk('public')->exists($match->team1->logoURL))
                                                    <img src="{{ asset('storage/' . $match->team1->logoURL) }}" alt="{{ $match->team1->Name }}" style="width: 40px; height: 40px;">
                                                @endif
                                                {{ $match->team1->Name ?? 'Unknown Team A' }}
                                            </p>
                                            <p><strong>Team B:</strong> 
                                                @if(!empty($match->team2->logoURL) && Storage::disk('public')->exists($match->team2->logoURL))
                                                    <img src="{{ asset('storage/' . $match->team2->logoURL) }}" alt="{{ $match->team2->Name }}" style="width: 40px; height: 40px;">
                                                @endif
                                                {{ $match->team2->Name ?? 'Unknown Team B' }}
                                            </p>
                                            <p><strong>Date:</strong> {{ $match->date ?? 'TBD' }}</p>
                                            <p><strong>Start Time:</strong> {{ $match->start_time ?? 'TBD' }}</p>
                                            <p><strong>End Time:</strong> {{ $match->end_time ?? 'TBD' }}</p>
                                            <p><strong>Venue:</strong> {{ $match->venue->name ?? 'TBD' }}</p>
                                            <p><strong>Scoring Referee:</strong> {{ $match->scoringReferee->Name ?? 'N/A' }}</p>
                                            <p><strong>Timing Referee:</strong> {{ $match->timingReferee->Name ?? 'N/A' }}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>

                <!-- Ended Matches -->
                <h2>Ended Matches</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col" style="width:10%;">Match ID</th>
                            <th scope="col" style="width:40%;">Teams</th>
                            <th scope="col" style="width:30%;">Date & Time</th>
                            <th scope="col" style="width:20%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($endedmatches as $match)
                            <tr>
                                <td>{{ $match->id }}</td>
                                <td>
                                    @if(!empty($match->team1->logoURL) && Storage::disk('public')->exists($match->team1->logoURL))
                                        <img src="{{ asset('storage/' . $match->team1->logoURL) }}" alt="{{ $match->team1->Name }}" class="team-logo" style="width: 40px; height: 40px;">
                                    @endif
                                    {{ $match->team1->Name }} vs
                                    @if(!empty($match->team2->logoURL) && Storage::disk('public')->exists($match->team2->logoURL))
                                        <img src="{{ asset('storage/' . $match->team2->logoURL) }}" alt="{{ $match->team2->Name }}" class="team-logo" style="width: 40px; height: 40px;">
                                    @endif
                                    {{ $match->team2->Name }}
                                </td>
                                <td>{{ $match->date }} & {{ $match->start_time }}</td>
                                <td>
                                    @if($match->match_status == 2)
                                        @if($match->team1_id == $teamId)
                                            @php
                                                $approval = $match->approvals->first(); 
                                            @endphp
                                            @if($approval)
                                                @if ($approval->managerA_approved == 1)
                                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#approvalModal{{ $match->id }}">
                                                    Approve Score
                                                </button>
                                                @elseif ($approval->managerA_approved >= 2)
                                                    @if($approval->managerB_approved == 1)
                                                        <div>Pending Approval</div>
                                                    @elseif($approval->managerB_approved >= 2)
                                                        <div>Ended</div>
                                                    @endif
                                                @endif
                                            @endif
                                        @elseif($match->team2_id == $teamId)
                                            @php
                                                $approval = $match->approvals->first(); 
                                            @endphp
                                            @if($approval)
                                                @if ($approval->managerB_approved == 1)
                                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#approvalModal{{ $match->id }}">
                                                    Approve Score
                                                </button>
                                                @elseif ($approval->managerB_approved >= 2)
                                                    @if($approval->managerA_approved == 1)
                                                        <div>Pending Approval</div>
                                                    @elseif($approval->managerA_approved >= 2)
                                                        <div>Ended</div>
                                                    @endif
                                                @endif
                                            @endif
                                        @endif
                                    @elseif ($match->match_status == 1)
                                        @if($match->team1_id == $teamId)
                                            @php
                                                $approvalmatch = $match->approvals->firstwhere('managerB_approved',1); 
                                                $CountAApprove = $match->approvals->where(function ($approval) {
                                                    return $approval->managerA_approved >=1 ;
                                                })->count();
                                                // dd($CountAApprove);
                                                $BothApprove = $match->approvals->where(function ($approval) {
                                                    return $approval->managerA_approved >=2 && $approval->managerB_approved >= 2;
                                                })->count();
                                                // dd($CountAApprove);
                                            @endphp
                                            @if ($approvalmatch)
                                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#approvalModal{{ $match->id }}">
                                                Approve Score
                                            </button>
                                            @else
                                                @if($BothApprove == 2)
                                                    <div>Ended</div>
                                                @elseif($CountAApprove == 2)
                                                    <div>Pending Approval</div>
                                                @endif
                                            @endif
                                        @elseif($match->team2_id == $teamId)
                                            @php
                                                $approvalmatch = $match->approvals->firstwhere('managerA_approved',1); 
                                                $CountBApprove = $match->approvals->where(function ($approval) {
                                                    return $approval->managerB_approved >=1 ;
                                                })->count();
                                                $BothApprove = $match->approvals->where(function ($approval) {
                                                    return $approval->managerA_approved >=2 && $approval->managerB_approved >= 2;
                                                })->count();
                                                // dd($CountAApprove);
                                            @endphp
                                            @if ($approvalmatch)
                                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#approvalModal{{ $match->id }}">
                                                Approve Score
                                            </button>
                                            @else
                                                @if($BothApprove == 2)
                                                    <div>Ended</div>
                                                @elseif($CountBApprove == 2)
                                                    <div>Pending Approval</div>
                                                @endif
                                            @endif
                                        @endif
                                    @endif 
                                </td>
                            </tr>
                    
                            <!-- Approval Modal -->
                            <div class="modal fade" id="approvalModal{{ $match->id }}" tabindex="-1" aria-labelledby="approvalModalLabel{{ $match->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="approvalModalLabel{{ $match->id }}">Approve/Reject Score for Match {{ $match->id }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('knockout.approve-match') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="match_id" value="{{ $match->id }}">
                                                @if ($match->match_status == 1)
                                                    @if($match->team1_id == $teamId)
                                                        @php
                                                            $approval = $match->approvals->firstwhere('managerB_approved',1);
                                                            // dd($approval);
                                                        @endphp
                                                        @if($approval && $approval->managerB_approved == 1)
                                                            <div class="alert alert-warning">
                                                                Both of the scores you submitted are not the same.
                                                                Do you approve the score given by Team {{ $match->team2->Name }} which is:
                                                            </div>
                                                            <div class="row">
                                                                <div class="col text-center">
                                                                    @if(!empty($match->team1->logoURL) && Storage::disk('public')->exists($match->team1->logoURL))
                                                                        <img src="{{ asset('storage/' . $match->team1->logoURL) }}" alt="{{ $match->team1->Name }}" class="team-logo" style="width: 40px; height: 40px;">
                                                                    @endif
                                                                    <div>{{ $match->team1->Name }}</div>
                                                                    <div>{{ $approval ? $approval->ScoreA : 'No Record' }}</div>
                                                                    <input type="hidden" name="ScoreA" value="{{ $approval->ScoreA }}">
                                                                </div>
                                                                <div class="col text-center">
                                                                    @if(!empty($match->team2->logoURL) && Storage::disk('public')->exists($match->team2->logoURL))
                                                                        <img src="{{ asset('storage/' . $match->team2->logoURL) }}" alt="{{ $match->team2->Name }}" class="team-logo" style="width: 40px; height: 40px;">
                                                                    @endif
                                                                    <div>{{ $match->team2->Name }}</div>
                                                                    <div>{{ $approval ? $approval->ScoreB : 'No Record' }}</div>
                                                                    <input type="hidden" name="ScoreB" value="{{ $approval->ScoreB }}">
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @elseif($match->team2_id == $teamId)
                                                        @php
                                                            $approval = $match->approvals->firstwhere('managerA_approved',1);
                                                        @endphp
                                                        @if($approval && $approval->managerA_approved == 1)
                                                            <div class="alert alert-warning">
                                                                Both of the scores you submitted are not the same.
                                                                Do you approve the score given by Team {{ $match->team1->Name }} which is:
                                                            </div>
                                                            <div class="row">
                                                                <div class="col text-center">
                                                                    @if(!empty($match->team1->logoURL) && Storage::disk('public')->exists($match->team1->logoURL))
                                                                        <img src="{{ asset('storage/' . $match->team1->logoURL) }}" alt="{{ $match->team1->Name }}" class="team-logo" style="width: 40px; height: 40px;">
                                                                    @endif
                                                                    <div>{{ $match->team1->Name }}</div>
                                                                    <div>{{ $approval ? $approval->ScoreA : 'No Record' }}</div>
                                                                    <input type="hidden" name="ScoreA" value="{{ $approval->ScoreA }}">
                                                                </div>
                                                                <div class="col text-center">
                                                                    @if(!empty($match->team2->logoURL) && Storage::disk('public')->exists($match->team2->logoURL))
                                                                        <img src="{{ asset('storage/' . $match->team2->logoURL) }}" alt="{{ $match->team2->Name }}" class="team-logo" style="width: 40px; height: 40px;">
                                                                    @endif
                                                                    <div>{{ $match->team2->Name }}</div>
                                                                    <div>{{ $approval ? $approval->ScoreB : 'No Record' }}</div>
                                                                    <input type="hidden" name="ScoreB" value="{{ $approval->ScoreB }}">
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endif
                                                @elseif ($match->match_status == 2)
                                                    <div class="row">
                                                        <div class="col text-center">
                                                            @if(!empty($match->team1->logoURL) && Storage::disk('public')->exists($match->team1->logoURL))
                                                                <img src="{{ asset('storage/' . $match->team1->logoURL) }}" alt="{{ $match->team1->Name }}" class="team-logo" style="width: 40px; height: 40px;">
                                                            @endif
                                                            <div>{{ $match->team1->Name }}</div>
                                                            <div>{{ $match->approvals->isNotEmpty() ? $match->approvals->first()->ScoreA : 'No Record' }}</div>
                                                        </div>
                                                        <div class="col text-center">
                                                            @if(!empty($match->team2->logoURL) && Storage::disk('public')->exists($match->team2->logoURL))
                                                                <img src="{{ asset('storage/' . $match->team2->logoURL) }}" alt="{{ $match->team2->Name }}" class="team-logo" style="width: 40px; height: 40px;">
                                                            @endif
                                                            <div>{{ $match->team2->Name }}</div>
                                                            <div>{{ $match->approvals->isNotEmpty() ? $match->approvals->first()->ScoreB : 'No Record' }}</div>
                                                        </div><br>
                                                    </div>
                                                @endif
                                                <div class="modal-footer" style="margin-top: 20px;">
                                                    <button type="submit" name="approved" value="1" class="btn btn-success">Approve</button>
                                                    <button type="submit" name="approved" value="0" class="btn btn-danger">Reject</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                    
                </table>
                
            </div>
        </div>
    </div>

    <script>
        function showScoreForm(matchId) {
            document.getElementById('modal_match_id').value = matchId;
            document.getElementById('scoreModal').style.display = 'block';
        }

    
        document.getElementById('scoreForm').addEventListener('submit', async function(event) {
            event.preventDefault();
    
            const formData = new FormData(this);
            
            try {
                const response = await fetch('/match-score/submit', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });
    
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
    
                const data = await response.json();
                console.log(data);
                location.reload();
            } catch (error) {
                console.error('Error:', error);
            }
        });
    </script>
    <script>
        function handleApproval(isApproved, matchId) {
    // Create the data to send
    const data = {
        match_id: matchId,
        approved: isApproved,
        _token: document.querySelector('input[name="_token"]').value // CSRF token
    };

    // Send the data using Fetch API
    fetch('/approve-match/knockout', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Score updated successfully!');
            location.reload(); // Reload the page to see changes
        } else {
            alert('Error updating score: ' + data.message);
        }
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}

    </script>

    <script>
        function fetchMatchDetails(matchId) {
            fetch(`/match-details/knockout/${matchId}`)
                .then(response => response.json())
                .then(data => {
                    if (data) {
                        document.getElementById('detailMatchId').textContent = data.Match_groupID;
                        document.getElementById('detailTeamA').innerHTML = `
                            ${data.teamA.logoURL ? `<img src="${data.teamA.logoURL}" alt="${data.teamA.Name}" class="team-logo me-2" style="width: 40px; height: 40px;">` : ''}
                            ${data.teamA.Name} vs
                            ${data.teamB.logoURL ? `<img src="${data.teamB.logoURL}" alt="${data.teamB.Name}" class="team-logo ms-2" style="width: 40px; height: 40px;">` : ''}
                            ${data.teamB.Name}
                        `;
                        document.getElementById('detailDateTime').textContent = `${data.Date} & ${data.start_time}`;
                        document.getElementById('detailVenue').textContent = data.Venue;
                        document.getElementById('detailScoringReferee').textContent = data.ScoringRefereeID;
                        document.getElementById('detailTimingReferee').textContent = data.TimingRefereeID;
                    }
                })
                .catch(error => console.error('Error fetching match details:', error));
        }
    </script>

</body>
@include('layouts.footer')
</html>
