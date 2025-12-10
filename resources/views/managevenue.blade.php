<x-admin-layout>
    {{-- @include('layouts.navbar') --}}

    <div class="flex w-full h-full bg-[#f4f7f6]">
        <!-- Sidebar -->
        {{-- <div class="bg-gray-500 text-white p-4"> --}}
            @include('layouts.sidebar')
        {{-- </div> --}}

        <!-- Main Content -->
        <div class="flex-1 px-10 py-6">
            
            <!-- ADD NEW VENUE -->
            <h2 class="text-3xl font-bold text-[#7A5DCA]">ADD NEW VENUE</h2>

            <form method="POST" action="{{ route('managevenue.store') }}" class="mt-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    <!-- Venue Name -->
                    <div>
                        <label for="name" class="block text-gray-500 font-bold mb-1">Venue Name:</label>
                        <input type="text" id="name" name="name"
                               value="{{ old('name') }}"
                               placeholder="Venue Name"
                               class="w-full p-3 rounded bg-gray-300 font-bold text-black placeholder-black/70 focus:ring-2 focus:ring-purple-500">
                    </div>

                    <!-- Venue Location -->
                    <div>
                        <label for="location" class="block text-gray-500 font-bold mb-1">Venue Location:</label>
                        <input type="text" id="location" name="location"
                               value="{{ old('location') }}"
                               placeholder="No. 123, etc..."
                               class="w-full p-3 rounded bg-gray-300 font-bold text-black placeholder-black/70 focus:ring-2 focus:ring-purple-500">
                    </div>

                    <!-- Number of Courts -->
                    <div>
                        <label for="no_court" class="block text-gray-500 font-bold mb-1">Number of Courts:</label>
                        <input type="number" id="no_court" name="no_court"
                               value="{{ old('no_court') }}"
                               placeholder="Number of Courts available"
                               class="w-full p-3 rounded bg-gray-300 font-bold text-black placeholder-black/70 focus:ring-2 focus:ring-purple-500">
                    </div>
                </div>

                <div class="flex justify-center mt-10">
                    <button type="submit"
                        class="px-10 py-3 text-lg font-bold text-white rounded bg-[#62096e] border border-[#62096e] hover:bg-[#4e0658]">
                        Add Venue
                    </button>
                </div>
            </form>

            <hr class="my-10 border-gray-400 w-3/4 mx-auto">

            <!-- VENUES LIST -->
            <h2 class="text-3xl font-bold text-[#7A5DCA]">VENUES LIST</h2>

            <!-- Tabs -->
            <ul class="nav nav-tabs mt-4" id="venueTabs" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active"
                        id="unarchived-venue-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#unarchived-venue"
                        type="button">
                        Unarchived Venues
                    </button>
                </li>

                <li class="nav-item">
                    <button class="nav-link"
                        id="archived-venue-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#archived-venue"
                        type="button">
                        Archived Venues
                    </button>
                </li>
            </ul>

            <div class="tab-content mt-4">

                <!-- Unarchived Venues Table -->
                <div class="tab-pane fade show active" id="unarchived-venue">
                    <div class="overflow-hidden border border-black rounded-lg">
                        <table class="w-full text-center">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="p-3">Venue Name</th>
                                    <th class="p-3">Venue Location</th>
                                    <th class="p-3">Number of Courts</th>
                                    <th class="p-3">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($venues as $venue)
                                    @if ($venue->archived === 1)
                                        <tr class="border-t">
                                            <td class="p-3">{{ $venue->name }}</td>
                                            <td class="p-3">{{ $venue->location }}</td>
                                            <td class="p-3">{{ $venue->no_court }}</td>

                                            <td class="p-3">
                                                <div class="flex justify-center gap-2">

                                                    <!-- Edit -->
                                                    <button class="px-3 py-1 bg-yellow-400 text-black rounded"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editModal{{ $venue->id }}">
                                                        Edit
                                                    </button>

                                                    <!-- Archive -->
                                                    <form method="POST" action="{{ route('managevenue.archive', $venue->id) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit"
                                                            class="px-3 py-1 bg-red-600 text-white rounded">
                                                            Archive
                                                        </button>
                                                    </form>

                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Archived Venues Table -->
                <div class="tab-pane fade" id="archived-venue">
                    <div class="overflow-hidden border border-black rounded-lg">
                        <table class="w-full text-center">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="p-3">Venue Name</th>
                                    <th class="p-3">Venue Location</th>
                                    <th class="p-3">Number of Courts</th>
                                    <th class="p-3">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($venues as $venue)
                                    @if ($venue->archived === 0)
                                        <tr class="border-t">
                                            <td class="p-3">{{ $venue->name }}</td>
                                            <td class="p-3">{{ $venue->location }}</td>
                                            <td class="p-3">{{ $venue->no_court }}</td>

                                            <td class="p-3">
                                                <div class="flex justify-center gap-2">

                                                    <!-- Unarchive -->
                                                    <form method="POST" action="{{ route('managevenue.unarchive', $venue->id) }}">
                                                        @csrf
                                                        <button type="submit"
                                                            class="px-3 py-1 bg-green-600 text-white rounded">
                                                            Unarchive
                                                        </button>
                                                    </form>

                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <!-- EDIT MODALS -->
            @foreach ($venues as $venue)
                <div class="modal fade"
                     id="editModal{{ $venue->id }}"
                     tabindex="-1">

                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title">Edit Venue</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">
                                <form method="POST" action="{{ route('managevenue.update', $venue->id) }}">
                                    @csrf

                                    <div class="mb-3">
                                        <label class="font-bold">Event Name</label>
                                        <input type="text" class="form-control"
                                               id="name{{ $venue->id }}"
                                               name="name"
                                               value="{{ $venue->name }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="font-bold">Address</label>
                                        <input type="text" class="form-control"
                                               id="location{{ $venue->id }}"
                                               name="location"
                                               value="{{ $venue->location }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="font-bold">Number of Courts</label>
                                        <input type="number" class="form-control"
                                               id="no_court{{ $venue->id }}"
                                               name="no_court"
                                               value="{{ $venue->no_court }}" required>
                                    </div>

                                    <button type="submit"
                                        class="px-4 py-2 bg-purple-600 text-white rounded">
                                        Update Venue
                                    </button>

                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</x-admin-layout>
