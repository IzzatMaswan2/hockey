<x-admin-layout :title="'Manage Participants'">

    @include('layouts.sidebar')

    <main class="flex-1 p-6 space-y-6 bg-gray-100 min-h-screen">

        <h2 class="text-3xl font-bold text-purple-700">MANAGE PARTICIPANTS</h2>

        <!-- Filters -->
        <div class="flex flex-wrap gap-4 mt-4 mb-4">
            <div class="w-full md:w-1/3">
                <label for="tournamentSelect" class="form-label font-semibold">Select Tournament:</label>
                <select class="form-select border border-gray-300 rounded-lg px-3 py-2" id="tournamentSelect">
                    <option value="">All Tournaments</option>
                    @foreach($tournaments as $tournamentItem)
                        <option value="{{ $tournamentItem->id }}" {{ request('tournament_id') == $tournamentItem->id ? 'selected' : '' }}>
                            {{ $tournamentItem->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="w-full md:w-1/3">
                <label for="categorySelect" class="form-label font-semibold">Select Category:</label>
                <select class="form-select border border-gray-300 rounded-lg px-3 py-2" id="categorySelect">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Add Participant Button -->
        <button class="bg-purple-700 text-white font-bold py-2 px-6 rounded-lg hover:bg-purple-800 mb-4" 
                data-bs-toggle="modal" data-bs-target="#addParticipantModal">
            Add Participant
        </button>

        <!-- Search -->
        <div class="mb-4 w-full md:w-1/3">
            <input type="text" id="participantSearchInput" placeholder="Search participants..."
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
        </div>

        <!-- Tabs -->
        <ul class="nav nav-tabs" id="participantTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="active-tab" data-bs-toggle="tab" data-bs-target="#active" type="button" role="tab" aria-controls="active" aria-selected="true">
                    Active Participants
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="archived-tab" data-bs-toggle="tab" data-bs-target="#archived" type="button" role="tab" aria-controls="archived" aria-selected="false">
                    Archived Participants
                </button>
            </li>
        </ul>

        <div class="tab-content mt-4">
            <!-- Active Participants -->
            <div class="tab-pane fade show active" id="active" role="tabpanel" aria-labelledby="active-tab">
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                        <thead class="bg-purple-700 text-white">
                            <tr>
                                <th class="py-2 px-4">Team</th>
                                <th class="py-2 px-4">Tournament</th>
                                <th class="py-2 px-4">Category</th>
                                <th class="py-2 px-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="activeParticipantTable" class="text-center">
                            @foreach ($participants as $participant)
                                @if(!$participant->archived)
                                <tr class="border-b">
                                    <td class="py-2 px-4">{{ $participant->team->name ?? 'Unknown Team' }}</td>
                                    <td class="py-2 px-4">{{ $participant->tournament->name ?? 'N/A' }}</td>
                                    <td class="py-2 px-4">{{ $participant->category->name ?? 'N/A' }}</td>
                                    <td class="py-2 px-4 space-x-2">
                                        <a href="{{ route('participants.view', $participant->id) }}" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">View</a>
                                        <button class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 btn-edit"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editParticipantModal"
                                            data-id="{{ $participant->id }}"
                                            data-team="{{ $participant->team->name }}"
                                            data-tournament="{{ $participant->tournament_id }}"
                                            data-category="{{ $participant->category_id }}">
                                            Edit
                                        </button>
                                        <button class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 btn-delete"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteParticipantModal"
                                            data-id="{{ $participant->id }}"
                                            data-team="{{ $participant->team->name }}">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Archived Participants -->
            <div class="tab-pane fade" id="archived" role="tabpanel" aria-labelledby="archived-tab">
                <div class="overflow-x-auto mt-4">
                    <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                        <thead class="bg-purple-700 text-white">
                            <tr>
                                <th class="py-2 px-4">Team</th>
                                <th class="py-2 px-4">Tournament</th>
                                <th class="py-2 px-4">Category</th>
                                <th class="py-2 px-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="archivedParticipantTable" class="text-center">
                            @foreach ($participants as $participant)
                                @if($participant->archived)
                                <tr class="border-b">
                                    <td class="py-2 px-4">{{ $participant->team->name ?? 'N/A' }}</td>
                                    <td class="py-2 px-4">{{ $participant->tournament->name ?? 'N/A' }}</td>
                                    <td class="py-2 px-4">{{ $participant->category->name ?? 'N/A' }}</td>
                                    <td class="py-2 px-4">
                                        <form action="{{ route('participants.unarchive', $participant->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">Unarchive</button>
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

    </main>

    <script>
        // Tournament filter reload
        $('#tournamentSelect').on('change', function() {
            const tournamentId = $(this).val();
            let url = window.location.pathname;
            if(tournamentId) url += '?tournament_id=' + tournamentId;
            window.location.href = url;
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

        // Search Participants
        $('#participantSearchInput').on('keyup', function() {
            const filter = $(this).val().toLowerCase();
            $('#activeParticipantTable tr, #archivedParticipantTable tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(filter) > -1);
            });
        });

        // Prefill edit modal
        $('.btn-edit').on('click', function () {
            let id = $(this).data('id');
            let teamName = $(this).data('team');
            let tournamentId = $(this).data('tournament');
            let categoryId = $(this).data('category');

            $('#editParticipantForm').attr('action', '/participants/' + id);
            $('#editParticipantId').val(id);
            $('#editParticipantTeam').val(teamName);

            $('#editTournamentId').val(tournamentId);

            $('#editCategoryId option').each(function () {
                if ($(this).data('tournament') == tournamentId) $(this).show();
                else $(this).hide();
                $(this).prop('selected', $(this).val() == categoryId);
            });
        });

        // Delete modal
        $('.btn-delete').on('click', function () {
            let id = $(this).data('id');
            let team = $(this).data('team');
            $("#deleteParticipantName").text(team);
            $("#deleteParticipantForm").attr('action', '/participants/' + id);
        });

    </script>

</x-admin-layout>
