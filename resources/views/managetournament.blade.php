<x-admin-layout>
    {{-- @include('layouts.navbar') --}}

    <div class="flex w-full h-full bg-[#f4f7f6]">

        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Main Content -->
        <div class="flex-1 px-10 py-6">

            <!-- ADD NEW TOURNAMENT -->
            <h2 class="text-3xl font-bold text-[#7A5DCA]">ADD NEW TOURNAMENT</h2>

            <form method="POST" action="{{ route('managetournament.store') }}" enctype="multipart/form-data" class="mt-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

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

                    <div class="col-span-3">
                        <label class="block font-bold text-gray-500 mb-1" for="image">Image:</label>
                        <input type="file" id="image" name="image" class="w-full p-2 rounded bg-gray-300 focus:ring-2 focus:ring-purple-500">
                    </div>

                    <div class="col-span-3">
                        <label for="description" class="block text-gray-500 font-bold mb-1">Description</label>
                        <textarea id="description" name="description" rows="5" placeholder="Short Description of the Tournament"
                                  class="w-full p-3 rounded bg-gray-300 font-bold text-black placeholder-black/70 focus:ring-2 focus:ring-purple-500">{{ old('description') }}</textarea>
                    </div>

                    <!-- Category Buttons -->
                    <div class="col-span-3 flex items-center gap-4 mt-2">
                        <label class="text-gray-500 font-bold">Category:</label>
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

            <hr class="my-10 border-gray-400 w-3/4 mx-auto">

            <!-- TOURNAMENTS LIST -->
            <h2 class="text-3xl font-bold text-[#7A5DCA] mb-4">TOURNAMENTS LIST</h2>

            <!-- Alpine.js Tabs -->
            <div x-data="{ tab: 'unarchived' }" class="mb-4">
                <div class="flex gap-2 mb-4">
                    <button @click="tab = 'unarchived'" :class="tab==='unarchived' ? 'bg-purple-500 text-white' : 'bg-gray-200 text-gray-700'" class="px-4 py-2 rounded">Unarchived Tournaments</button>
                    <button @click="tab = 'archived'" :class="tab==='archived' ? 'bg-purple-500 text-white' : 'bg-gray-200 text-gray-700'" class="px-4 py-2 rounded">Archived Tournaments</button>
                </div>

                <!-- Unarchived Table -->
                <div x-show="tab==='unarchived'" class="overflow-x-auto border border-black rounded-lg">
                    <table class="w-full text-center">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="p-3">Name</th>
                                <th class="p-3">Venue</th>
                                <th class="p-3 period-column">Period</th>
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
                                        <td class="p-3 period-column">{{ $tournament->start_date }} → {{ $tournament->end_date }}</td>
                                        <td class="p-3">{{ $tournament->category }}</td>
                                        <td class="p-3 flex justify-center gap-2">

                                            <!-- View Modal Trigger -->
                                            <button @click="$dispatch('open-modal', 'view-{{ $tournament->id }}')" class="px-2 py-1 bg-blue-400 text-white rounded">View</button>

                                            <!-- Edit Modal Trigger -->
                                            <button @click="$dispatch('open-modal', 'edit-{{ $tournament->id }}')" class="px-2 py-1 bg-yellow-400 text-black rounded">Edit</button>

                                            <!-- Category Modal Trigger -->
                                            <button @click="$dispatch('open-category-modal', {{ $tournament->id }})" 
                                                    class="bg-orange-400 text-black px-2 py-1 rounded hover:bg-orange-500">
                                                Manage Categories
                                            </button>

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
                    <table class="w-full text-center">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="p-3">Name</th>
                                <th class="p-3">Venue</th>
                                <th class="p-3 period-column">Period</th>
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
                                        <td class="p-3 period-column">{{ $tournament->start_date }} → {{ $tournament->end_date }}</td>
                                        <td class="p-3">{{ $tournament->category }}</td>
                                        <td class="p-3 flex justify-center gap-2">
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

            <!-- VIEW & EDIT MODALS -->
            @foreach ($tournaments as $tournament)
                <!-- VIEW MODAL -->
                <div
                    x-data="{ open: false }"
                    x-on:open-modal.window="if($event.detail === 'view-{{ $tournament->id }}') open = true"
                    x-show="open"
                    x-transition
                    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 overflow-auto"
                >
                    <div class="bg-white rounded-lg shadow-lg w-11/12 md:w-3/4 lg:w-1/2">
                        <div class="flex justify-between items-center border-b p-4">
                            <h2 class="text-xl font-bold">Tournament Details</h2>
                            <button @click="open = false" class="text-gray-500 hover:text-black">&times;</button>
                        </div>
                        <div class="p-4 space-y-2">
                            <h4 class="text-lg font-bold">{{ $tournament->name }}</h4>
                            <p><strong>Category:</strong> {{ $tournament->category }}</p>
                            <p><strong>Participating Teams:</strong> {{ $tournament->no_team }}</p>
                            <p><strong>Groups:</strong> {{ $tournament->no_group }}</p>
                            <p><strong>Start Date:</strong> {{ $tournament->start_date }}</p>
                            <p><strong>End Date:</strong> {{ $tournament->end_date }}</p>
                            <p><strong>Venue:</strong> {{ $tournament->venue->name }}</p>
                            <p><strong>Description:</strong> {{ $tournament->description }}</p>
                            <img src="{{ asset('storage/' . $tournament->image) }}" class="w-full rounded mt-2" alt="{{ $tournament->name }}">
                        </div>
                        <div class="flex justify-end p-4 border-t">
                            <button @click="open = false" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Close</button>
                        </div>
                    </div>
                </div>

                <!-- EDIT MODAL -->
                <div
                    x-data="{ open: false }"
                    x-on:open-modal.window="if($event.detail === 'edit-{{ $tournament->id }}') open = true"
                    x-show="open"
                    x-transition
                    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 overflow-auto"
                >
                    <div class="bg-white rounded-lg shadow-lg w-11/12 md:w-3/4 lg:w-1/2 overflow-auto max-h-screen">
                        <div class="flex justify-between items-center border-b p-4">
                            <h2 class="text-xl font-bold">Edit Tournament</h2>
                            <button @click="open = false" class="text-gray-500 hover:text-black">&times;</button>
                        </div>
                        <div class="p-4">
                            <form method="POST" action="{{ route('managetournament.update', $tournament->id) }}" enctype="multipart/form-data">
                                @csrf
                                {{-- @method('PUT') --}}
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block font-bold text-gray-500 mb-1" for="name{{ $tournament->id }}">Tournament Name:</label>
                                        <input type="text" id="name{{ $tournament->id }}" name="name" value="{{ $tournament->name }}" required
                                            class="w-full p-2 rounded border border-gray-300 focus:ring-2 focus:ring-purple-500">
                                    </div>
                                    <div>
                                        <label class="block font-bold text-gray-500 mb-1" for="venue_id{{ $tournament->id }}">Venue:</label>
                                        <select id="venue_id{{ $tournament->id }}" name="venue_id" required
                                            class="w-full p-2 rounded border border-gray-300 focus:ring-2 focus:ring-purple-500">
                                            @foreach ($venues as $venue)
                                                <option value="{{ $venue->id }}" {{ $tournament->venue_id == $venue->id ? 'selected' : '' }}>{{ $venue->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block font-bold text-gray-500 mb-1" for="start_date{{ $tournament->id }}">Start Date:</label>
                                        <input type="date" id="start_date{{ $tournament->id }}" name="start_date" value="{{ $tournament->start_date }}" required
                                            class="w-full p-2 rounded border border-gray-300 focus:ring-2 focus:ring-purple-500">
                                    </div>
                                    <div>
                                        <label class="block font-bold text-gray-500 mb-1" for="end_date{{ $tournament->id }}">End Date:</label>
                                        <input type="date" id="end_date{{ $tournament->id }}" name="end_date" value="{{ $tournament->end_date }}" required
                                            class="w-full p-2 rounded border border-gray-300 focus:ring-2 focus:ring-purple-500">
                                    </div>
                                    <div>
                                        <label class="block font-bold text-gray-500 mb-1" for="start_time{{ $tournament->id }}">Start Time:</label>
                                        <input type="time" id="start_time{{ $tournament->id }}" name="start_time" value="{{ $tournament->start_time }}" required
                                            class="w-full p-2 rounded border border-gray-300 focus:ring-2 focus:ring-purple-500">
                                    </div>
                                    <div>
                                        <label class="block font-bold text-gray-500 mb-1" for="end_time{{ $tournament->id }}">End Time:</label>
                                        <input type="time" id="end_time{{ $tournament->id }}" name="end_time" value="{{ $tournament->end_time }}" required
                                            class="w-full p-2 rounded border border-gray-300 focus:ring-2 focus:ring-purple-500">
                                    </div>
                                    <div>
                                        <label class="block font-bold text-gray-500 mb-1" for="no_team{{ $tournament->id }}">Participating Teams:</label>
                                        <input type="number" id="no_team{{ $tournament->id }}" name="no_team" value="{{ $tournament->no_team }}" required
                                            class="w-full p-2 rounded border border-gray-300 focus:ring-2 focus:ring-purple-500">
                                    </div>
                                    <div>
                                        <label class="block font-bold text-gray-500 mb-1" for="no_group{{ $tournament->id }}">Group Number:</label>
                                        <input type="number" id="no_group{{ $tournament->id }}" name="no_group" value="{{ $tournament->no_group }}" required
                                            class="w-full p-2 rounded border border-gray-300 focus:ring-2 focus:ring-purple-500">
                                    </div>
                                    <div class="col-span-2">
                                        <label class="block font-bold text-gray-500 mb-1" for="description{{ $tournament->id }}">Description:</label>
                                        <textarea id="description{{ $tournament->id }}" name="description" rows="4" required
                                            class="w-full p-2 rounded border border-gray-300 focus:ring-2 focus:ring-purple-500">{{ $tournament->description }}</textarea>
                                    </div>
                                    <div class="col-span-2">
                                        <label class="block font-bold text-gray-500 mb-1" for="image{{ $tournament->id }}">Image:</label>
                                        <input type="file" id="image{{ $tournament->id }}" name="image"
                                            class="w-full p-2 rounded border border-gray-300 focus:ring-2 focus:ring-purple-500">
                                    </div>
                                    <div class="mb-3">
                                        <label for="category{{ $tournament->id }}" class="form-label">Category:</label>
                                        <select class="form-select" id="category{{ $tournament->id }}" name="category"value="{{ $tournament->category }}" required>
                                            <option value="" disabled>Select category</option>
                                            <option value="Single Elimination" {{ $tournament->category == 'Single Elimination' ? 'selected' : '' }}>Single Elimination</option>
                                            <option value="Double Elimination" {{ $tournament->category == 'Double Elimination' ? 'selected' : '' }}>Double Elimination</option>
                                            <option value="Round Robin" {{ $tournament->category == 'Round Robin' ? 'selected' : '' }}>Round Robin</option>
                                            <option value="Group Stage + Knockout" {{ $tournament->category == 'Group Stage + Knockout' ? 'selected' : '' }}>Group Stage + Knockout</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="flex justify-end mt-4">
                                    <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700">Update Tournament</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach

            @foreach($tournaments as $tournament)
            <div x-data="{ open: false }" 
                x-on:open-category-modal.window="if($event.detail === {{ $tournament->id }}) open = true"
                x-show="open"
                class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
                style="display: none;">
                
                <div class="bg-white w-full max-w-4xl rounded-lg shadow-lg overflow-auto max-h-[90vh]">
                    
                    <!-- Header -->
                    <div class="flex justify-between items-center p-4 border-b">
                        <h2 class="text-lg font-bold">Manage Categories — {{ $tournament->name }}</h2>
                        <button @click="open = false" class="text-gray-500 hover:text-black text-2xl">&times;</button>
                    </div>
                    
                    <!-- Body -->
                    <div class="p-4 space-y-6">

                        <!-- CATEGORY LIST -->
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border border-gray-300 rounded">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="px-3 py-2 border">Category Name</th>
                                        <th class="px-3 py-2 border">Description</th>
                                        <th class="px-3 py-2 border">Max Teams</th>
                                        <th class="px-3 py-2 border">Groups</th>
                                        <th class="px-3 py-2 border">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tournament->categories as $category)
                                    <tr class="border-t">
                                        <!-- UPDATE FORM -->
                                        <form action="{{ route('categories.update', $category->id) }}" method="POST" class="flex flex-wrap items-center gap-2">
                                            @csrf
                                            @method('PUT')

                                            <td class="px-2 py-1 border">
                                                <input type="text" name="name" value="{{ $category->name }}" required
                                                    class="w-full border rounded px-2 py-1">
                                            </td>
                                            <td class="px-2 py-1 border">
                                                <textarea name="description" class="w-full border rounded px-2 py-1">{{ $category->description }}</textarea>
                                            </td>
                                            <td class="px-2 py-1 border">
                                                <input type="number" name="max_teams" value="{{ $category->max_teams }}" class="w-full border rounded px-2 py-1">
                                            </td>
                                            <td class="px-2 py-1 border">
                                                <input type="number" name="number_group" value="{{ $category->number_group }}" class="w-full border rounded px-2 py-1">
                                            </td>
                                            <td class="px-2 py-1 border flex gap-2">
                                                <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600">Save</button>
                                        </form>

                                        <!-- DELETE FORM -->
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Delete this category?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">Del</button>
                                        </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <hr class="border-gray-300">

                        <!-- ADD NEW CATEGORY -->
                        <div>
                            <h3 class="font-bold mb-2">Add Category</h3>
                            <form action="{{ route('categories.store') }}" method="POST" class="space-y-4">
                                @csrf
                                <input type="hidden" name="tournament_id" value="{{ $tournament->id }}">

                                <div class="flex flex-wrap gap-4">
                                    <div class="flex-1">
                                        <label class="block mb-1">Category Name</label>
                                        <input type="text" name="name" required class="w-full border rounded px-2 py-1">
                                    </div>
                                    <div class="flex-1">
                                        <label class="block mb-1">Description</label>
                                        <input type="text" name="description" class="w-full border rounded px-2 py-1">
                                    </div>
                                </div>

                                <div class="flex flex-wrap gap-4">
                                    <div class="flex-1">
                                        <label class="block mb-1">Max Teams</label>
                                        <input type="number" name="max_teams" class="w-full border rounded px-2 py-1">
                                    </div>
                                    <div class="flex-1">
                                        <label class="block mb-1">Number of Groups</label>
                                        <input type="number" name="number_group" class="w-full border rounded px-2 py-1">
                                    </div>
                                </div>

                                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Add Category</button>
                            </form>
                        </div>

                    </div>

                </div>
            </div>
            @endforeach

        </div>
    </div>

    <!-- Category Button Script -->
    <script>
        function selectCategory(button) {
            document.querySelectorAll('.category-buttons button').forEach(btn => btn.classList.remove('selected'));
            button.classList.add('selected');
            document.getElementById('category').value = button.innerText;
        }
    </script>

</x-admin-layout>
