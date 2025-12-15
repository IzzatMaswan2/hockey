<x-admin-layout>
    <div class="flex flex-col md:flex-row w-full min-h-screen bg-[#f4f7f6]">

        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Main Content -->
        <div class="flex-1 p-6 md:p-10">

            <!-- ADD NEW VENUE -->
            <h2 class="text-3xl font-bold text-[#7A5DCA]">ADD NEW VENUE</h2>

            <form method="POST" action="{{ route('managevenue.store') }}" class="mt-6 space-y-6">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">

                    <!-- Venue Name -->
                    <div>
                        <label for="name" class="block text-gray-600 font-semibold mb-1">Venue Name:</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Venue Name"
                            class="w-full p-3 rounded bg-gray-200 text-black font-semibold placeholder-black/70 focus:ring-2 focus:ring-purple-500">
                    </div>

                    <!-- Venue Location -->
                    <div>
                        <label for="location" class="block text-gray-600 font-semibold mb-1">Venue Location:</label>
                        <input type="text" id="location" name="location" value="{{ old('location') }}" placeholder="No. 123, etc..."
                            class="w-full p-3 rounded bg-gray-200 text-black font-semibold placeholder-black/70 focus:ring-2 focus:ring-purple-500">
                    </div>

                    <!-- Number of Courts -->
                    <div>
                        <label for="no_court" class="block text-gray-600 font-semibold mb-1">Number of Courts:</label>
                        <input type="number" id="no_court" name="no_court" value="{{ old('no_court') }}" placeholder="Number of Courts"
                            class="w-full p-3 rounded bg-gray-200 text-black font-semibold placeholder-black/70 focus:ring-2 focus:ring-purple-500">
                    </div>
                </div>

                <div class="flex justify-center mt-6">
                    <button type="submit"
                        class="px-10 py-3 text-lg font-bold text-white rounded bg-[#62096e] hover:bg-[#4e0658] transition">
                        Add Venue
                    </button>
                </div>
            </form>

            <hr class="my-10 border-gray-400">

            <!-- VENUES LIST -->
            <h2 class="text-3xl font-bold text-[#7A5DCA]">VENUES LIST</h2>

            <!-- Tabs -->
            <div class="mt-4">
                <ul class="flex flex-wrap border-b">
                    <li class="mr-2">
                        <button class="inline-block py-2 px-4 text-blue-600 font-semibold border-b-2 border-blue-600 active-tab" data-tab="unarchived">Unarchived Venues</button>
                    </li>
                    <li>
                        <button class="inline-block py-2 px-4 text-gray-600 font-semibold border-b-2 border-transparent" data-tab="archived">Archived Venues</button>
                    </li>
                </ul>

                <!-- Tables -->
                <div class="tab-content mt-4">

                    <!-- Unarchived Venues -->
                    <div id="unarchived" class="venue-tab">
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-center border rounded-lg">
                                <thead class="bg-gray-200">
                                    <tr>
                                        <th class="p-3">Venue Name</th>
                                        <th class="p-3">Location</th>
                                        <th class="p-3">Courts</th>
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
                                                    <div class="flex flex-wrap justify-center gap-2">
                                                        <button class="px-3 py-1 bg-yellow-400 text-black rounded" data-bs-toggle="modal" data-bs-target="#editModal{{ $venue->id }}">Edit</button>
                                                        <form method="POST" action="{{ route('managevenue.archive', $venue->id) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded">Archive</button>
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

                    <!-- Archived Venues -->
                    <div id="archived" class="venue-tab hidden">
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-center border rounded-lg">
                                <thead class="bg-gray-200">
                                    <tr>
                                        <th class="p-3">Venue Name</th>
                                        <th class="p-3">Location</th>
                                        <th class="p-3">Courts</th>
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
                                                    <form method="POST" action="{{ route('managevenue.unarchive', $venue->id) }}">
                                                        @csrf
                                                        <button type="submit" class="px-3 py-1 bg-green-600 text-white rounded">Unarchive</button>
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

            <!-- EDIT MODALS -->
            @foreach ($venues as $venue)
                <div class="modal fade" id="editModal{{ $venue->id }}" tabindex="-1">
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
                                        <label class="font-semibold">Venue Name</label>
                                        <input type="text" class="form-control" name="name" value="{{ $venue->name }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="font-semibold">Address</label>
                                        <input type="text" class="form-control" name="location" value="{{ $venue->location }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="font-semibold">Number of Courts</label>
                                        <input type="number" class="form-control" name="no_court" value="{{ $venue->no_court }}" required>
                                    </div>
                                    <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded">Update Venue</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

    <script>
        // Simple tab switcher
        document.querySelectorAll('[data-tab]').forEach(btn => {
            btn.addEventListener('click', function() {
                const target = this.dataset.tab;
                document.querySelectorAll('.venue-tab').forEach(tab => tab.classList.add('hidden'));
                document.getElementById(target).classList.remove('hidden');
                
                document.querySelectorAll('[data-tab]').forEach(b => b.classList.remove('text-blue-600', 'border-blue-600', 'active-tab'));
                this.classList.add('text-blue-600', 'border-blue-600', 'active-tab');
            });
        });
    </script>

</x-admin-layout>
