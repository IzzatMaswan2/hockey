<!-- View Participant Modal -->
<div class="modal fade" id="viewParticipantModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Participant Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p><strong>Team Name:</strong> <span id="viewTeamName"></span></p>
                <p><strong>Tournament:</strong> <span id="viewTournament"></span></p>
                <p><strong>Category:</strong> <span id="viewCategory"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            <a href="{{ route('participants.view', $participant->id) }}">
                View Detail
            </a>
        </div>
    </div>
</div>

<!-- Edit Participant Modal -->
<div class="modal fade" id="editParticipantModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" id="editParticipantForm" action="">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title">Edit Participant</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <input type="hidden" name="id" id="editParticipantId">

                    <!-- Team Name -->
                    <div class="mb-3">
                        <label>Team Name</label>
                        <input type="text" class="form-control" name="team_name" id="editParticipantTeam" required>
                    </div>

                    <!-- Tournament Dropdown -->
                    <div class="mb-3">
                        <label>Tournament</label>
                        <select name="tournament_id" id="editTournamentId" class="form-select" required>
                            <option value="">Select Tournament</option>
                            @foreach($tournaments as $tournament)
                                <option value="{{ $tournament->id }}">{{ $tournament->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Category Dropdown -->
                    <div class="mb-3">
                        <label>Category</label>
                        <select name="category_id" id="editCategoryId" class="form-select" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" data-tournament="{{ $category->tournament_id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- Add Participant Modal -->
<div class="modal fade" id="addParticipantModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('participants.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Participant</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <!-- Tournament Dropdown -->
                    <div class="mb-3">
                        <label for="tournamentSelect" class="form-label">Tournament</label>
                        <select name="tournament_id" id="tournamentSelect" class="form-select" required>
                            <option value="">Select Tournament</option>
                            @foreach($tournaments as $tournament)
                                <option value="{{ $tournament->id }}">{{ $tournament->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Category Dropdown -->
                    <div class="mb-3">
                        <label for="categorySelect" class="form-label">Category</label>
                        <select name="category_id" id="categorySelect" class="form-select">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" data-tournament="{{ $category->tournament_id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Team Dropdown -->
                    <div class="mb-3">
                        <label for="teamSelect" class="form-label">Team</label>
                        <select name="team_id" id="teamSelect" class="form-select" required>
                            <option value="">Select Team</option>
                            @foreach($teams as $team)
                                <option value="{{ $team->teamID }}" 
                                        data-tournament="{{ $team->tournament_id }}" 
                                        @if($team->category) data-category="{{ $team->category->id }}" @endif>
                                    {{ $team->name }}
                                    @if($team->category) - {{ $team->category->name }} @endif
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Participant</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- DELETE PARTICIPANT MODAL -->
<div class="modal fade" id="deleteParticipantModal" tabindex="-1">
    <div class="modal-dialog">
        <form id="deleteParticipantForm" method="POST">
            @csrf
            @method('DELETE')

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Participant</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <p>Are you sure you want to delete <strong id="deleteParticipantName"></strong>?</p>
                    <p class="text-danger">
                        <small>This action cannot be undone.</small>
                    </p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                </div>
            </div>

        </form>
    </div>
</div>
