<x-admin-layout>
    <x-slot name="title">Knockout Matches</x-slot>

    @include('layouts.sidebar-manager')

    <div class="container-fluid mt-4">
        <h1>Knockout Matches</h1>

        <!-- Ongoing Matches -->
        <h2 class="mt-4">Ongoing Matches</h2>
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
                            @php
                                $approval = $match->approvals->first();
                            @endphp

                            @if(($match->team1_id == $teamId && (!$approval || $approval->managerA_approved < 1)) ||
                                ($match->team2_id == $teamId && (!$approval || $approval->managerB_approved < 1)))
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#scoreModal{{ $match->id }}">
                                    Submit Score
                                </button>
                            @else
                                <div>Pending</div>
                            @endif
                        </td>
                    </tr>

                    <!-- Score Modal -->
                    <div class="modal fade" id="scoreModal{{ $match->id }}" tabindex="-1" aria-labelledby="scoreModalLabel{{ $match->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('update.knockout', $match->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="scoreModalLabel{{ $match->id }}">Submit Score - Match {{ $match->id }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="score_a_{{ $match->id }}" class="form-label">{{ $match->team1->Name }} Score:</label>
                                            <input type="number" id="score_a_{{ $match->id }}" name="score_a" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="score_b_{{ $match->id }}" class="form-label">{{ $match->team2->Name }} Score:</label>
                                            <input type="number" id="score_b_{{ $match->id }}" name="score_b" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">Submit Score</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>

        <!-- Upcoming Matches -->
        <h2 class="mt-4">Upcoming Matches</h2>
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
                            @if(!empty($match->team1->logoURL) && Storage::disk('public')->exists($match->team1->logoURL))
                                <img src="{{ asset('storage/' . $match->team1->logoURL) }}" alt="{{ $match->team1->Name }}" style="width: 40px; height: 40px;">
                            @endif
                            {{ $match->team1->Name }} vs
                            @if(!empty($match->team2->logoURL) && Storage::disk('public')->exists($match->team2->logoURL))
                                <img src="{{ asset('storage/' . $match->team2->logoURL) }}" alt="{{ $match->team2->Name }}" style="width: 40px; height: 40px;">
                            @endif
                            {{ $match->team2->Name }}
                        </td>
                        <td>{{ $match->date }} & {{ $match->start_time }}</td>
                        <td>
                            <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#matchDetailModal{{ $match->id }}">
                                See Details
                            </button>
                        </td>
                    </tr>

                    <!-- Match Details Modal -->
                    <div class="modal fade" id="matchDetailModal{{ $match->id }}" tabindex="-1" aria-labelledby="matchDetailModalLabel{{ $match->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="matchDetailModalLabel{{ $match->id }}">Match Details - {{ $match->id }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Date:</strong> {{ $match->date ?? 'TBD' }}</p>
                                    <p><strong>Start Time:</strong> {{ $match->start_time ?? 'TBD' }}</p>
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
        <h2 class="mt-4">Ended Matches</h2>
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
                                <img src="{{ asset('storage/' . $match->team1->logoURL) }}" alt="{{ $match->team1->Name }}" style="width: 40px; height: 40px;">
                            @endif
                            {{ $match->team1->Name }} vs
                            @if(!empty($match->team2->logoURL) && Storage::disk('public')->exists($match->team2->logoURL))
                                <img src="{{ asset('storage/' . $match->team2->logoURL) }}" alt="{{ $match->team2->Name }}" style="width: 40px; height: 40px;">
                            @endif
                            {{ $match->team2->Name }}
                        </td>
                        <td>{{ $match->date }} & {{ $match->start_time }}</td>
                        <td>
                            @if($match->approvals->isNotEmpty())
                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#approvalModal{{ $match->id }}">
                                    Approve/Reject
                                </button>
                            @else
                                <div>Ended</div>
                            @endif
                        </td>
                    </tr>

                    <!-- Approval Modal -->
                    <div class="modal fade" id="approvalModal{{ $match->id }}" tabindex="-1" aria-labelledby="approvalModalLabel{{ $match->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('update.knockout', $match->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="approvalModalLabel{{ $match->id }}">Approve/Reject Score - Match {{ $match->id }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Team Scores:</p>
                                        <p>{{ $match->team1->Name }}: {{ $match->approvals->first()->ScoreA ?? 'N/A' }}</p>
                                        <p>{{ $match->team2->Name }}: {{ $match->approvals->first()->ScoreB ?? 'N/A' }}</p>
                                        <input type="hidden" name="approved" value="1">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="approved" value="1" class="btn btn-success">Approve</button>
                                        <button type="submit" name="approved" value="0" class="btn btn-danger">Reject</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>
</x-admin-layout>
