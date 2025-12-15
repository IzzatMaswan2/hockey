<x-admin-layout>
    {{-- @include('layouts.navbar') --}}

    <div class="flex flex-col md:flex-row w-full min-h-screen bg-[#f4f7f6]">

        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Main Content -->
        <div class="flex-1 px-4 sm:px-6 md:px-10 py-6">

            <!-- ADD NEW TOURNAMENT -->
            <h2 class="text-2xl sm:text-3xl font-bold text-[#7A5DCA]">ADD NEW TOURNAMENT</h2>

            <form method="POST" action="{{ route('managetournament.store') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">

                    <!-- Tournament Fields -->
                    <div>
                        <label for="name" class="block text-gray-500 font-bold mb-1">Tournament Name:</label>
                        <input type="text" id="name" name="name" placeholder="Tournament Name" value="{{ old('name') }}"
                               class="w-full p-3 rounded bg-gray-300 font-bold text-black placeholder-black/70 focus:ring-2 focus:ring-purple-500">
                    </div>

                    <div>
                        <label for="start_date" class="block text-gray-500 font-bold mb-1">Start Date:</label>
                        <input type="date" id="start_date" name="start_date" value="{{ old('start_date') }}"
                               class="w-full p-3 rounded bg-gray-300 font-bold text-black focus:ring-2 focus:ring-purple-500">
                    </div>

                    <div>
                        <label for="start_time" class="block text-gray-500 font-bold mb-1">Start Time:</label>
                        <input type="time" id="start_time" name="start_time" value="{{ old('start_time') }}"
                               class="w-full p-3 rounded bg-gray-300 font-bold text-black focus:ring-2 focus:ring-purple-500">
                    </div>

                    <div>
                        <label for="venue_id" class="block text-gray-500 font-bold mb-1">Venue:</label>
                        <select id="venue_id" name="venue_id"
                                class="w-full p-3 rounded bg-gray-300 font-bold text-black focus:ring-2 focus:ring-purple-500">
                            <option value="" disabled selected>Select a venue</option>
                            @foreach ($venues as $venue)
                                <option value="{{ $venue->id }}">{{ $venue->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="end_date" class="block text-gray-500 font-bold mb-1">End Date:</label>
                        <input type="date" id="end_date" name="end_date" value="{{ old('end_date') }}"
                               class="w-full p-3 rounded bg-gray-300 font-bold text-black focus:ring-2 focus:ring-purple-500">
                    </div>

                    <div>
                        <label for="end_time" class="block text-gray-500 font-bold mb-1">End Time:</label>
                        <input type="time" id="end_time" name="end_time" value="{{ old('end_time') }}"
                               class="w-full p-3 rounded bg-gray-300 font-bold text-black focus:ring-2 focus:ring-purple-500">
                    </div>

                    <div>
                        <label for="regclose_date" class="block text-gray-500 font-bold mb-1">Registration Closed Date:</label>
                        <input type="date" id="regclose_date" name="regclose_date" value="{{ old('regclose_date') }}"
                               class="w-full p-3 rounded bg-gray-300 font-bold text-black focus:ring-2 focus:ring-purple-500">
                    </div>

                    <div>
                        <label for="no_team" class="block text-gray-500 font-bold mb-1">Participating Teams:</label>
                        <input type="number" id="no_team" name="no_team" placeholder="Number of Teams" value="{{ old('no_team') }}"
                               class="w-full p-3 rounded bg-gray-300 font-bold text-black focus:ring-2 focus:ring-purple-500">
                    </div>

                    <div>
                        <label for="no_group" class="block text-gray-500 font-bold mb-1">Group Number:</label>
                        <input type="number" id="no_group" name="no_group" placeholder="Number of Groups" value="{{ old('no_group') }}"
                               class="w-full p-3 rounded bg-gray-300 font-bold text-black focus:ring-2 focus:ring-purple-500">
                    </div>

                    <div class="col-span-1 sm:col-span-2 md:col-span-3">
                        <label class="block font-bold text-gray-500 mb-1" for="image">Image:</label>
                        <input type="file" id="image" name="image" class="w-full p-2 rounded bg-gray-300 focus:ring-2 focus:ring-purple-500">
                    </div>

                    <div class="col-span-1 sm:col-span-2 md:col-span-3">
                        <label for="description" class="block text-gray-500 font-bold mb-1">Description</label>
                        <textarea id="description" name="description" rows="5" placeholder="Short Description of the Tournament"
                                  class="w-full p-3 rounded bg-gray-300 font-bold text-black placeholder-black/70 focus:ring-2 focus:ring-purple-500">{{ old('description') }}</textarea>
                    </div>

                    <!-- Category Buttons -->
                    <div class="col-span-1 sm:col-span-2 md:col-span-3 flex flex-wrap items-center gap-2 mt-2">
                        <label class="text-gray-500 font-bold w-full md:w-auto">Category:</label>
                        <div class="flex flex-wrap gap-2 category-buttons">
                            <button type="button" class="px-3 py-1 border border-green-500 rounded bg-green-400 font-bold text-black hover:bg-green-600 hover:text-white"
                                    onclick="selectCategory(this)">Single Elimination</button>
                            <button type="button" class="px-3 py-1 border border-green-500 rounded bg-green-400 font-bold text-black hover:bg-green-600 hover:text-white"
                                    onclick="selectCategory(this)">Double Elimination</button>
                            <button type="button" class="px-3 py-1 border border-green-500 rounded bg-green-400 font-bold text-black hover:bg-green-600 hover:text-white"
                                    onclick="selectCategory(this)">Round Robin</button>
                            <button type="button" class="px-3 py-1 border border-green-500 rounded bg-green-400 font-bold text-black hover:bg-green-600 hover:text-white"
                                    onclick="selectCategory(this)">Group Stage + Knockout</button>
                        </div>
                        <input type="hidden" id="category" name="category" value="{{ old('category') }}">
                    </div>

                </div>

                <div class="flex justify-center mt-6">
                    <button type="submit" class="px-10 py-3 text-lg font-bold text-white rounded bg-[#62096e] border border-[#62096e] hover:bg-[#4e0658]">
                        Create Tournament
                    </button>
                </div>
            </form>

            <hr class="my-10 border-gray-400 w-full md:w-3/4 mx-auto">

            <!-- TOURNAMENTS LIST -->
            <h2 class="text-2xl sm:text-3xl font-bold text-[#7A5DCA] mb-4">TOURNAMENTS LIST</h2>

            <!-- Alpine.js Tabs -->
            <div x-data="{ tab: 'unarchived' }" class="mb-4">

                <div class="flex flex-wrap gap-2 mb-4">
                    <button @click="tab = 'unarchived'" :class="tab==='unarchived' ? 'bg-purple-500 text-white' : 'bg-gray-200 text-gray-700'" class="px-4 py-2 rounded">Unarchived Tournaments</button>
                    <button @click="tab = 'archived'" :class="tab==='archived' ? 'bg-purple-500 text-white' : 'bg-gray-200 text-gray-700'" class="px-4 py-2 rounded">Archived Tournaments</button>
                </div>

                <!-- Unarchived Table -->
                <div x-show="tab==='unarchived'" class="overflow-x-auto border border-black rounded-lg">
                    <table class="w-full text-center min-w-[600px]">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="p-3">Name</th>
                                <th class="p-3">Venue</th>
                                <th class="p-3">Period</th>
                                <th class="p-3">Category</th>
                                <th class="p-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tournaments as $tournament)
                                @if ($tournament->archived === 1)
                                    <tr class="border-t">
                                        <td class="p-3">{{ $tournament->name }}</td>
                                        <td class="p-3">{{ $tournament->venue->name }}</td>
                                        <td class="p-3">{{ $tournament->start_date }} → {{ $tournament->end_date }}</td>
                                        <td class="p-3">{{ $tournament->category }}</td>
                                        <td class="p-3 flex flex-wrap justify-center gap-2">
                                            <button @click="$dispatch('open-modal', 'view-{{ $tournament->id }}')" class="px-2 py-1 bg-blue-400 text-white rounded">View</button>
                                            <button @click="$dispatch('open-modal', 'edit-{{ $tournament->id }}')" class="px-2 py-1 bg-yellow-400 text-black rounded">Edit</button>
                                            <button @click="$dispatch('open-category-modal', {{ $tournament->id }})" class="bg-orange-400 text-black px-2 py-1 rounded hover:bg-orange-500">Manage Categories</button>
                                            <form method="POST" action="{{ route('managetournament.archive', $tournament->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="px-2 py-1 bg-red-600 text-white rounded">Archive</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Archived Table -->
                <div x-show="tab==='archived'" class="overflow-x-auto border border-black rounded-lg">
                    <table class="w-full text-center min-w-[600px]">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="p-3">Name</th>
                                <th class="p-3">Venue</th>
                                <th class="p-3">Period</th>
                                <th class="p-3">Category</th>
                                <th class="p-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tournaments as $tournament)
                                @if ($tournament->archived === 0)
                                    <tr class="border-t">
                                        <td class="p-3">{{ $tournament->name }}</td>
                                        <td class="p-3">{{ $tournament->venue->name }}</td>
                                        <td class="p-3">{{ $tournament->start_date }} → {{ $tournament->end_date }}</td>
                                        <td class="p-3">{{ $tournament->category }}</td>
                                        <td class="p-3 flex flex-wrap justify-center gap-2">
                                            <button @click="$dispatch('open-modal', 'view-{{ $tournament->id }}')" class="px-2 py-1 bg-blue-400 text-white rounded">View</button>
                                            <form method="POST" action="{{ route('managetournament.unarchive', $tournament->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="px-2 py-1 bg-green-600 text-white rounded">Unarchive</button>
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
    </div>

    <script>
        function selectCategory(button) {
            document.querySelectorAll('.category-buttons button').forEach(btn => btn.classList.remove('selected'));
            button.classList.add('selected');
            document.getElementById('category').value = button.innerText;
        }
    </script>
</x-admin-layout>
