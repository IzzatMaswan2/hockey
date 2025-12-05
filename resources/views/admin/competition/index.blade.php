<x-admin-layout :title="'Manage Participants'">

    <div class="container-fluid" style="min-height: 90vh;">
        <div class="row" class="pl-2">
            <div class="col-md-10 offset-md-1">
                <h2 class="text-primary mt-4 mb-3">MANAGE COMPETITIONS</h2>

                <!-- Tournament Filter -->
                <div class="mb-3">
                    <label for="tournamentSelect" class="form-label">Select Tournament:</label>
                    <select class="form-select" id="tournamentSelect">
                        <option value="">All Tournaments</option>
                        @foreach($tournaments as $tournamentItem)
                            <option value="{{ $tournamentItem->id }}"
                                {{ request('tournament_id') == $tournamentItem->id ? 'selected' : '' }}>
                                {{ $tournamentItem->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Category Filter -->
                <div class="mb-3">
                    <label for="categorySelect" class="form-label">Select Category:</label>
                    <select class="form-select" id="categorySelect">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Add Participant Button -->
                <button class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#addParticipantModal">
                    Add Participant
                </button>

                <!-- Search Bar -->
                <div class="mb-3">
                    <input type="text" class="form-control" id="participantSearchInput" placeholder="Search participants...">
                </div>

                <!-- Participants Tabs -->
                <ul class="nav nav-tabs mb-3" id="participantTabs" role="tablist">
                    <li class="nav-item">
                        <button class="nav-link active" id="active-tab" data-bs-toggle="tab" data-bs-target="#active" type="button" role="tab">
                            Active Participants
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" id="archived-tab" data-bs-toggle="tab" data-bs-target="#archived" type="button" role="tab">
                            Archived Participants
                        </button>
                    </li>
                </ul>

                <div class="tab-content">
                    <!-- Active Participants -->
                    <div class="tab-pane fade show active" id="active">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Team</th>
                                        {{-- <th>Email</th> --}}
                                        <th>Tournament</th>
                                        <th>Category</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="activeParticipantTable">
                                    @foreach ($participants as $participant)
                                        <tr>
                                            <td>{{ $participant->team->name ?? 'Unknown Team' }}</td>
                                            {{-- <td>{{ $participant->team->country ?? 'N/A' }}</td> --}}
                                            <td>{{ $participant->tournament->name ?? 'N/A' }}</td>
                                            <td>{{ $participant->category->name ?? 'N/A' }}</td>

                                            <td>
                                                <a href="{{ route('participants.view', $participant->id) }}" 
                                                    class="btn btn-sm btn-primary">
                                                    View
                                                </a>

                                                <button class="btn btn-sm btn-secondary btn-edit"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editParticipantModal"
                                                    data-id="{{ $participant->id }}"
                                                    data-team="{{ $participant->team->name }}"
                                                    data-tournament="{{ $participant->tournament_id }}"
                                                    data-category="{{ $participant->category_id }}">
                                                    Edit
                                                </button>

                                                <button class="btn btn-sm btn-danger btn-delete"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteParticipantModal"
                                                    data-id="{{ $participant->id }}"
                                                    data-team="{{ $participant->team->name }}">
                                                    Delete
                                                </button>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>

                    <!-- Archived Participants -->
                    <div class="tab-pane fade" id="archived">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Team</th>
                                        {{-- <th>Email</th> --}}
                                        <th>Tournament</th>
                                        <th>Category</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="archivedParticipantTable">
                                    @foreach ($participants as $participant)
                                        @if($participant->archived)
                                            <tr>
                                                <td>{{ $participant->team->name ?? 'N/A' }}</td>
                                                {{-- <td>{{ $participant->email }}</td> --}}
                                                <td>{{ $participant->tournament->name ?? 'N/A' }}</td>
                                                <td>{{ $participant->category->name ?? 'N/A' }}</td>
                                                <td>
                                                    <form action="{{ route('participants.unarchive', $participant->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-sm btn-success">Unarchive</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Modals (View, Edit, Add) -->
                @include('admin.competition.modals')

            </div> <!-- col-md-10 offset-md-2 -->
        </div> <!-- row -->
    </div> <!-- container-fluid -->

    @push('scripts')
    <script>
        // Tournament filter reload
        $('#tournamentSelect').on('change', function() {
            const tournamentId = $(this).val();
            let url = window.location.pathname;
            if(tournamentId) {
                url += '?tournament_id=' + tournamentId;
            }
            window.location.href = url;
        });

        // View Participant Modal
        $('.btn-view').on('click', function() {
            $('#viewTeamName').text($(this).data('team'));
            $('#viewTournament').text($(this).data('tournament'));
            $('#viewCategory').text($(this).data('category'));
        });

        // Prefill modal
        $('.btn-edit').on('click', function () {

            let id = $(this).data('id');
            let teamName = $(this).data('team');
            let tournamentId = $(this).data('tournament');
            let categoryId = $(this).data('category');

            $('#editParticipantForm').attr('action', '/participants/' + id);
            $('#editParticipantId').val(id);
            $('#editParticipantTeam').val(teamName);

            // set tournament
            $('#editTournamentId').val(tournamentId);

            // filter categories and select correct one
            $('#editCategoryId option').each(function () {

                if ($(this).data('tournament') == tournamentId) {
                    $(this).show();
                } else {
                    $(this).hide();
                }

                if ($(this).val() == categoryId) {
                    $(this).prop('selected', true);
                }
            });
        });

    // When tournament changes, update category dropdown
    $('#editTournamentId').on('change', function() {
        let tournamentId = $(this).val();

        $('#editCategoryId option').each(function() {
            if($(this).data('tournament') == tournamentId){
                $(this).show();
            } else {
                $(this).hide();
            }
            $(this).prop('selected', false); // clear previous selection
        });
    });


        // Search Participants
        $('#participantSearchInput').on('keyup', function() {
            const filter = $(this).val().toLowerCase();
            $('#activeParticipantTable tr, #archivedParticipantTable tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(filter) > -1);
            });
        });

        // Category filter reload
        $('#categorySelect').on('change', function() {
            const tournamentId = $('#tournamentSelect').val();
            const categoryId = $(this).val();

            let url = window.location.pathname + '?';

            if (tournamentId) url += 'tournament_id=' + tournamentId + '&';
            if (categoryId) url += 'category_id=' + categoryId;

            window.location.href = url;
        });

        $('.btn-delete').on('click', function () {
            let id = $(this).data('id');
            let team = $(this).data('team');

            $("#deleteParticipantName").text(team);
            $("#deleteParticipantForm").attr('action', '/participants/' + id);
        });

    </script>
    @endpush

</x-admin-layout>
