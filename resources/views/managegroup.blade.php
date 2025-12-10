<x-admin-layout>
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Main Content -->
        <div class="flex-1 p-6 space-y-6 min-w-0">
            <h3 class="text-2xl font-bold text-purple-800">MANAGE GROUPS</h3>

            <!-- Create Group Form -->
            <form method="POST" action="{{ route('managegroup.store') }}" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
                    <!-- Tournament Selection -->
                    <div class="md:col-span-4">
                        <label for="tournament" class="font-semibold block mb-1">Tournament</label>
                        <select id="tournament" name="tournament" required
                            class="w-full border-2 border-black rounded p-2 focus:border-blue-400 focus:ring focus:ring-blue-200">
                            <option value="" disabled selected>Select a tournament</option>
                            @foreach($tournaments as $tournament)
                                <option value="{{ $tournament->id }}">{{ $tournament->name ?? 'N/A' }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Category Selection -->
                    <div class="md:col-span-4 hidden" id="categoryDiv">
                        <label for="category" class="font-semibold block mb-1">Category</label>
                        <select id="category" name="category"
                            class="w-full border-2 border-black rounded p-2 focus:border-blue-400 focus:ring focus:ring-blue-200">
                            <option value="" disabled selected>Select a category</option>
                        </select>
                    </div>

                    <!-- Number of Teams (read-only) -->
                    <div class="md:col-span-2">
                        <label class="font-semibold block mb-1">Number of Teams</label>
                        <p id="numTeams"
                           class="border-2 border-black rounded p-2 font-bold">0</p>
                    </div>

                    <!-- Number of Groups -->
                    <div class="md:col-span-2">
                        <label for="numGroups" class="font-semibold block mb-1">Number of Groups</label>
                        <input type="number" id="numGroups" name="numGroups" min="1" required
                            class="w-full border-2 border-black rounded p-2 focus:border-blue-400 focus:ring focus:ring-blue-200">
                    </div>
                </div>

                <div class="md:col-span-4">
                    <button type="submit"
                        class="mt-4 mb-10 bg-purple-700 text-white px-4 py-2 rounded hover:bg-purple-800">CREATE GROUP</button>
                </div>
            </form>

            <hr class="my-6">

            <!-- Event Filter -->
            <div>
                <label for="eventSelect" class="font-semibold block mb-2">Select Tournament</label>
                <select id="eventSelect" class="w-full border-2 border-black rounded p-2 focus:border-blue-400 focus:ring focus:ring-blue-200">
                    <option value="all">All Tournaments</option>
                    @foreach($tournaments as $tournament)
                        <option value="{{ $tournament->id }}">{{ $tournament->name ?? 'N/A' }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Groups Table -->
            @php
                $hasCategory = $groups->contains(fn($g) => !empty($g->category_id));
            @endphp

            <div class="overflow-x-auto mt-4">
                <table class="table-auto w-full border-collapse border border-gray-300" id="groupTable">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="border border-gray-300 px-4 py-2 text-left">TEAM</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">GROUP</th>
                            @if($hasCategory)
                                <th class="border border-gray-300 px-4 py-2 text-left">CATEGORY</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($groups as $group)
                            <tr data-event="{{ $group->tournament_id }}" class="border border-gray-300">
                                <td class="px-4 py-2">{{ $group->team->name ?? '' }}</td>
                                <td class="px-4 py-2">{{ $group->groupcreate->Name ?? '' }}</td>
                                @if($hasCategory)
                                    <td class="px-4 py-2">{{ $group->category->name ?? '' }}</td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tournamentSelect = document.getElementById('tournament');
            const categoryDiv = document.getElementById('categoryDiv');
            const categorySelect = document.getElementById('category');
            const numTeams = document.getElementById('numTeams');
            const numGroupsInput = document.getElementById('numGroups');

            // Tournament change
            tournamentSelect.addEventListener('change', function() {
                const tournamentId = this.value;
                if (!tournamentId) return;

                // Fetch number of teams
                fetch(`/getTournamentTeams/${tournamentId}`)
                    .then(res => res.json())
                    .then(data => {
                        numTeams.textContent = data.numTeams;
                        updateTeamsPerGroup(data.numTeams);
                    });

                // Fetch categories
                fetch(`/getTournamentCategories/${tournamentId}`)
                    .then(res => res.json())
                    .then(data => {
                        categorySelect.innerHTML = '<option value="" disabled selected>Select a category</option>';
                        if (data.categories.length > 0) {
                            data.categories.forEach(cat => {
                                const option = document.createElement('option');
                                option.value = cat.id;
                                option.textContent = cat.name;
                                categorySelect.appendChild(option);
                            });
                            categoryDiv.classList.remove('hidden');
                        } else {
                            categoryDiv.classList.add('hidden');
                        }
                    })
                    .catch(err => console.error(err));
            });

            // Number of groups input
            numGroupsInput.addEventListener('input', function() {
                const nTeams = parseInt(numTeams.textContent);
                const nGroups = this.value;
                updateTeamsPerGroup(nTeams, nGroups);
            });

            function updateTeamsPerGroup(nTeams, nGroups = numGroupsInput.value) {
                // Optional: can display teams per group somewhere
                const perGroup = (nTeams > 0 && nGroups > 0) ? Math.floor(nTeams / nGroups) : 'N/A';
                // console.log('Teams per group:', perGroup);
            }

            // Event filter
            const eventSelect = document.getElementById('eventSelect');
            const tableRows = document.querySelectorAll('#groupTable tbody tr');

            eventSelect.addEventListener('change', function() {
                const selectedEvent = this.value;
                tableRows.forEach(row => {
                    row.style.display = (selectedEvent === 'all' || row.dataset.event === selectedEvent) ? '' : 'none';
                });
            });
        });
    </script>
</x-admin-layout>
