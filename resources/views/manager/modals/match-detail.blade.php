<div class="modal fade" id="matchDetailModal{{ $match->Match_groupID }}" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">

            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold">
                    Match Details
                </h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="row g-3">

                    <div class="col-12 text-center">
                        <strong>{{ $match->teamA->Name }}</strong>
                        <span class="mx-2">vs</span>
                        <strong>{{ $match->teamB->Name }}</strong>
                    </div>

                    <div class="col-md-6">
                        <strong>Date:</strong>
                        <div>{{ $match->Date }}</div>
                    </div>

                    <div class="col-md-6">
                        <strong>Start Time:</strong>
                        <div>{{ $match->start_time }}</div>
                    </div>

                    <div class="col-md-6">
                        <strong>End Time:</strong>
                        <div>{{ $match->end_time }}</div>
                    </div>

                    <div class="col-md-6">
                        <strong>Venue:</strong>
                        <div>{{ $match->Venue }}</div>
                    </div>

                    <div class="col-md-6">
                        <strong>Scoring Referee:</strong>
                        <div>{{ $match->scoringReferee->Name ?? 'N/A' }}</div>
                    </div>

                    <div class="col-md-6">
                        <strong>Timing Referee:</strong>
                        <div>{{ $match->timingReferee->Name ?? 'N/A' }}</div>
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">
                    Close
                </button>
            </div>

        </div>
    </div>
</div>
