<div class="modal fade" id="scoreModal" tabindex="-1">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">

            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold">
                    <i class="fas fa-futbol me-2 text-success"></i>
                    Submit Match Score
                </h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('match-score.submit') }}" method="POST">
                @csrf
                <input type="hidden" name="match_id" id="modal_match_id">

                <div class="modal-body">
                    <div class="row g-3">

                        <div class="col-6">
                            <label class="form-label fw-semibold">
                                Team A Score
                            </label>
                            <input type="number" name="score_a" class="form-control" required>
                        </div>

                        <div class="col-6">
                            <label class="form-label fw-semibold">
                                Team B Score
                            </label>
                            <input type="number" name="score_b" class="form-control" required>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button class="btn btn-success">
                        <i class="fas fa-check me-1"></i> Submit
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
