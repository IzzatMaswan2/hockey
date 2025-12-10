<x-admin-layout>
    <div class="flex min-h-screen w-full">
        <!-- Sidebar -->

        @include('layouts.sidebar')


        <!-- Main Content -->
        <div class="flex-1 p-6 space-y-6">
            <h4 class="text-purple-800 font-bold text-lg mb-4">CREATE NEW MATCH</h4>

            <!-- Match Form -->
            <form action="{{ route('matches.auto-create') }}" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                    <!-- Tournament -->
                    <div class="md:col-span-4">
                        <label for="tournament_id" class="font-semibold block mb-1">Tournament</label>
                        <select id="tournament_id" name="tournament_id" required
                            class="w-full border-2 border-black rounded p-2 focus:border-blue-400 focus:ring focus:ring-blue-200">
                            <option value="">Select Tournament</option>
                            @foreach($tournaments as $tournament)
                                <option value="{{ $tournament->id }}">{{ $tournament->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Category -->
                    <div class="md:col-span-3">
                        <label for="category_id" class="font-semibold block mb-1">Category</label>
                        <select id="category_id" name="category_id" required
                            class="w-full border-2 border-black rounded p-2 focus:border-blue-400 focus:ring focus:ring-blue-200">
                            <option value="">Select Category</option>
                        </select>
                    </div>

                    <!-- Group -->
                    <div class="md:col-span-3">
                        <label for="group" class="font-semibold block mb-1">Group</label>
                        <select id="group" name="group" required
                            class="w-full border-2 border-black rounded p-2 focus:border-blue-400 focus:ring focus:ring-blue-200">
                            <option value="">Select Group</option>
                        </select>
                    </div>

                    <!-- Date -->
                    <div class="md:col-span-2">
                        <label for="date" class="font-semibold block mb-1">Date</label>
                        <input type="date" id="date" name="date"
                            class="w-full border-2 border-black rounded p-2 focus:border-blue-400 focus:ring focus:ring-blue-200">
                    </div>

                    <!-- Start Time -->
                    <div class="md:col-span-2">
                        <label for="start_time" class="font-semibold block mb-1">Start Time</label>
                        <input type="time" id="start_time" name="start_time"
                            class="w-full border-2 border-black rounded p-2 focus:border-blue-400 focus:ring focus:ring-blue-200">
                    </div>

                    <!-- End Time -->
                    <div class="md:col-span-2">
                        <label for="end_time" class="font-semibold block mb-1">End Time</label>
                        <input type="time" id="end_time" name="end_time"
                            class="w-full border-2 border-black rounded p-2 focus:border-blue-400 focus:ring focus:ring-blue-200">
                    </div>

                    <!-- Venue -->
                    <div class="md:col-span-4">
                        <label for="venue" class="font-semibold block mb-1">Venue</label>
                        <select id="venue" name="venue" required
                            class="w-full border-2 border-black rounded p-2 focus:border-blue-400 focus:ring focus:ring-blue-200">
                            <option value="">Select Venue</option>
                            @foreach($venues as $venue)
                                <option value="{{ $venue->id }}">{{ $venue->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Referees and Submit -->
                <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end mt-4">
                    <div class="md:col-span-4">
                        <label for="scoring_referee" class="font-semibold block mb-1">Scoring Referee</label>
                        <select id="scoring_referee" name="scoring_referee" required
                            class="w-full border-2 border-black rounded p-2 focus:border-blue-400 focus:ring focus:ring-blue-200">
                            <option value="">Select Referee</option>
                            @foreach($referee as $scoringReferee)
                                <option value="{{ $scoringReferee->id }}">{{ $scoringReferee->Name }}-{{ $scoringReferee->Role }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="md:col-span-4">
                        <label for="timing_referee" class="font-semibold block mb-1">Timing Referee</label>
                        <select id="timing_referee" name="timing_referee" required
                            class="w-full border-2 border-black rounded p-2 focus:border-blue-400 focus:ring focus:ring-blue-200">
                            <option value="">Select Referee</option>
                            @foreach($referee as $timingReferee)
                                <option value="{{ $timingReferee->id }}">{{ $timingReferee->Name }}-{{ $timingReferee->Role }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="md:col-span-4 flex justify-end">
                        <button type="submit"
                            class="bg-purple-700 text-white px-4 py-2 rounded hover:bg-purple-800">CREATE MATCHES</button>
                    </div>
                </div>
            </form>

            <!-- Tournament Filter -->
            <div class="mt-6">
                <label for="eventSelect" class="font-semibold block mb-2">Select Tournament</label>
                <select id="eventSelect" class="w-full border-2 border-black rounded p-2 focus:border-blue-400 focus:ring focus:ring-blue-200">
                    <option value="all">All Tournaments</option>
                    @foreach($tournaments as $tournament)
                        <option value="{{ $tournament->id }}">{{ $tournament->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Match Table -->
            <div class="overflow-x-auto mt-4">
                <table class="min-w-full border border-blue-500" id="matchTable">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="border px-4 py-2 text-left">MATCH SCHEDULE</th>
                            <th class="border px-4 py-2 text-left">DATE & TIME</th>
                            <th class="border px-4 py-2 text-left">GROUP</th>
                            <th class="border px-4 py-2 text-left">CATEGORY</th>
                            <th class="border px-4 py-2 text-left">STATUS</th>
                            <th class="border px-4 py-2 text-left">ACTION</th>
                        </tr>
                    </thead>
                    <tbody id="matchTableBody">
                        @php $mytime = Carbon\Carbon::now(); @endphp
                        @foreach($matches as $match)
                        <tr data-event="{{ $match->tournament_id }}">
                            <td class="px-4 py-2">{{ $match->team1->name }} vs {{ $match->team2->name }}</td>
                            <td class="px-4 py-2">{{ $match->date }} {{ $match->start_time }}</td>
                            <td class="px-4 py-2">{{ $match->groupcreate->Name ?? 'Knockout' }}</td>
                            <td class="px-4 py-2">{{ $match->category->name ?? '-' }}</td>
                            @if($mytime->toDateString() > $match->date)
                            <td class="px-4 py-2 text-green-600">Completed</td>
                            @elseif($mytime->toDateString() < $match->date)
                            <td class="px-4 py-2 text-blue-600">Upcoming</td>
                            @else
                            <td class="px-4 py-2 text-orange-600">On-going</td>
                            @endif
                            <td class="px-4 py-2">
                                <a href="{{ route('matches.edit', $match->id) }}"
                                class="inline-block px-4 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition duration-200 shadow-sm">
                                    Update
                                </a>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <script>
        // Tournament filter
        document.getElementById('eventSelect').addEventListener('change', function () {
            var selectedEvent = this.value;
            var rows = document.querySelectorAll('#matchTable tbody tr');
            rows.forEach(function (row) {
                row.style.display = selectedEvent === 'all' || row.getAttribute('data-event') === selectedEvent ? '' : 'none';
            });
        });

        // Dynamic category fetch
        document.getElementById('tournament_id').addEventListener('change', function () {
            var tournamentId = this.value;
            var categorySelect = document.getElementById('category_id');
            categorySelect.innerHTML = '<option value="">Select Category</option>';

            var groupSelect = document.getElementById('group');
            groupSelect.innerHTML = '<option value="">Select Group</option>';

            if (tournamentId) {
                fetch('/get-categories-by-tournament/' + tournamentId)
                .then(res => res.json())
                .then(data => {
                    data.forEach(function(category){
                        var option = document.createElement('option');
                        option.value = category.id;
                        option.text = category.name;
                        categorySelect.appendChild(option);
                    });
                });
            }
        });

        // Dynamic group fetch
        document.getElementById('category_id').addEventListener('change', function () {
            var categoryId = this.value;
            var tournamentId = document.getElementById('tournament_id').value;
            var groupSelect = document.getElementById('group');
            groupSelect.innerHTML = '<option value="">Select Group</option>';

            if (categoryId && tournamentId) {
                fetch('/get-groups-by-tournament-and-category/' + tournamentId + '/' + categoryId)
                .then(res => res.json())
                .then(data => {
                    data.forEach(function(group){
                        var option = document.createElement('option');
                        option.value = group.GroupID;
                        option.text = group.Name;
                        groupSelect.appendChild(option);
                    });
                });
            }
        });
    </script>
</x-admin-layout>
