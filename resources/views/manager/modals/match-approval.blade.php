<div class="modal fade" id="approvalModal{{ $match->Match_groupID }}" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">

            <div class="modal-header bg-warning bg-opacity-25">
                <h5 class="modal-title fw-bold">
                    Approve Match Score
                </h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('approve-match') }}" method="POST">
                @csrf
                <input type="hidden" name="match_id" value="{{ $match->Match_groupID }}">

                <div class="modal-body">

                    <div class="row text-center mb-3">
                        <div class="col">
                            <strong>{{ $match->teamA->Name }}</strong>
                            <div class="fs-3 fw-bold">
                                {{ $match->approvals->first()->ScoreA ?? '-' }}
                            </div>
                            <input type="hidden" name="ScoreA" value="{{ $match->approvals->first()->ScoreA ?? 0 }}">
                        </div>

                        <div class="col">
                            <strong>{{ $match->teamB->Name }}</strong>
                            <div class="fs-3 fw-bold">
                                {{ $match->approvals->first()->ScoreB ?? '-' }}
                            </div>
                            <input type="hidden" name="ScoreB" value="{{ $match->approvals->first()->ScoreB ?? 0 }}">
                        </div>
                    </div>

                    <div class="alert alert-warning text-center">
                        Please confirm the submitted score
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" name="approved" value="1" class="btn btn-success">
                        Approve
                    </button>
                    <button type="submit" name="approved" value="0" class="btn btn-danger">
                        Reject
                    </button>
                    <button class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
