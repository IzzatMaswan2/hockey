<div class="modal fade" id="editPlayerModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <form method="POST" id="editPlayerForm">
                @csrf
                @method('PUT')

                <div class="modal-header bg-light">
                    <h5 class="modal-title fw-bold">Edit Player</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="fullName" id="editFullName" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Display Name</label>
                            <input type="text" name="displayName" id="editDisplayName" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Date of Birth</label>
                            <input type="date" name="dob" id="editDob" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Contact</label>
                            <input type="text" name="contact" id="editContact" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Jersey Number</label>
                            <input type="number" name="jerseyNumber" id="editJersey" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Position</label>
                            <input type="text" name="position" id="editPosition" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Field Status</label>
                            <select name="field_status" id="editStatus" class="form-select">
                                <option value="Active">Active</option>
                                <option value="Injured">Injured</option>
                                <option value="Bench">Bench</option>
                            </select>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary">Save Changes</button>
                </div>

            </form>
        </div>
    </div>
</div>
