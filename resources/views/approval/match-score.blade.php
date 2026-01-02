<x-admin-layout title="Match Score Management">

<div class="container-fluid">
    <div class="row">

        {{-- SIDEBAR --}}
        @include('layouts.sidebar-manager')

        {{-- MAIN CONTENT --}}
        <div class="col-lg-10 col-md-9 px-4 py-4">

            {{-- HEADER --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold mb-1">Match Score Management</h2>
                    <p class="text-muted mb-0">Submit and approve match results</p>
                </div>

                <a href="{{ url('/match-score/knockout') }}" class="btn btn-primary">
                    <i class="fas fa-trophy me-1"></i> Knockout Matches
                </a>
            </div>

            {{-- ONGOING MATCHES --}}
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white fw-bold">
                    Ongoing Matches
                </div>
                <div class="card-body p-0">

                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Teams</th>
                                <th>Date & Time</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($livematches as $match)
                                <tr>
                                    <td>{{ $match->Match_groupID }}</td>

                                    <td class="fw-semibold">
                                        {{ $match->teamA->Name }} vs {{ $match->teamB->Name }}
                                    </td>

                                    <td>
                                        {{ $match->Date }} <br>
                                        <small class="text-muted">{{ $match->start_time }}</small>
                                    </td>

                                    <td class="text-end">
                                        @php
                                            $approval = $match->approvals->first();
                                        @endphp

                                        @if(
                                            ($match->TeamAID == $teamId && $approval?->managerA_approved >= 1) ||
                                            ($match->TeamBID == $teamId && $approval?->managerB_approved >= 1)
                                        )
                                            <span class="badge bg-warning">Pending</span>
                                        @else
                                            <button class="btn btn-sm btn-success"
                                                data-bs-toggle="modal"
                                                data-bs-target="#scoreModal"
                                                onclick="document.getElementById('modal_match_id').value={{ $match->Match_groupID }}">
                                                Submit Score
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">
                                        No ongoing matches
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>

            {{-- UPCOMING MATCHES --}}
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white fw-bold">
                    Upcoming Matches
                </div>
                <div class="card-body p-0">

                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Teams</th>
                                <th>Date & Time</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($upcomingmatches as $match)
                                <tr>
                                    <td>{{ $match->Match_groupID }}</td>
                                    <td>{{ $match->teamA->Name }} vs {{ $match->teamB->Name }}</td>
                                    <td>{{ $match->Date }} {{ $match->start_time }}</td>
                                    <td class="text-end">
                                        <button class="btn btn-sm btn-info"
                                            data-bs-toggle="modal"
                                            data-bs-target="#matchDetailModal{{ $match->Match_groupID }}">
                                            Details
                                        </button>
                                    </td>
                                </tr>

                                @include('manager.modals.match-detail')
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

            {{-- ENDED MATCHES --}}
            <div class="card shadow-sm">
                <div class="card-header bg-white fw-bold">
                    Ended Matches
                </div>
                <div class="card-body p-0">

                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Teams</th>
                                <th>Date & Time</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($endedmatches as $match)
                                <tr>
                                    <td>{{ $match->Match_groupID }}</td>
                                    <td>{{ $match->teamA->Name }} vs {{ $match->teamB->Name }}</td>
                                    <td>{{ $match->Date }} {{ $match->start_time }}</td>
                                    <td class="text-end">

                                        @php
                                            $approval = $match->approvals->first();
                                        @endphp

                                        @if($approval && (
                                            ($match->TeamAID == $teamId && $approval->managerA_approved == 1) ||
                                            ($match->TeamBID == $teamId && $approval->managerB_approved == 1)
                                        ))
                                            <button class="btn btn-sm btn-warning"
                                                data-bs-toggle="modal"
                                                data-bs-target="#approvalModal{{ $match->Match_groupID }}">
                                                Approve
                                            </button>
                                        @elseif($approval && $approval->managerA_approved >= 2 && $approval->managerB_approved >= 2)
                                            <span class="badge bg-success">Ended</span>
                                        @else
                                            <span class="badge bg-secondary">Pending</span>
                                        @endif

                                    </td>
                                </tr>

                                @include('manager.modals.match-approval')
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>
</div>

{{-- GLOBAL MODALS --}}
@include('manager.modals.match-score-submit')

</x-admin-layout>
