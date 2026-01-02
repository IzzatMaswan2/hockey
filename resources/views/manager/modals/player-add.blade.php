<div class="modal fade" id="addPlayerModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <form method="POST" action="{{ route('manageplayer') }}">
                @csrf

                <div class="modal-header bg-light">
                    <h5 class="modal-title fw-bold">Add New Player</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="fullName" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Display Name</label>
                            <input type="text" name="displayName" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Date of Birth</label>
                            <input type="date" name="dob" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Jersey Number</label>
                            <input type="number" name="jerseyNumber" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Position</label>
                            <input type="text" name="position" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Field Status</label>
                            <select name="field_status" class="form-select">
                                <option value="Active">Active</option>
                                <option value="Injured">Injured</option>
                                <option value="Bench">Bench</option>
                            </select>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary">Add Player</button>
                </div>

            </form>
        </div>
    </div>
</div>
