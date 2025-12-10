<x-admin-layout>
    <div class="flex min-h-screen w-full">
        @include('layouts.sidebar')
        
        <div class="flex-1 p-6">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-lg rounded-lg p-6">
                <h3 class="text-2xl font-bold text-purple-700 mb-6">EDIT MATCH</h3>

                <form action="{{ route('matches.update', $matches->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Teams -->
                    <div class="grid grid-cols-12 gap-4 mb-4 items-center">
                        <div class="col-span-5">
                            <label for="team1_name" class="block font-semibold mb-1">Competing Team 1</label>
                            <input type="text" name="team1_name" id="team1_name" 
                                value="{{ $matches->team1->name }}" 
                                placeholder="Enter Team 1 Name"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
                        </div>

                        <div class="col-span-2 text-center font-bold text-lg">
                            VS
                        </div>

                        <div class="col-span-5">
                            <label for="team2_name" class="block font-semibold mb-1">Competing Team 2</label>
                            <input type="text" name="team2_name" id="team2_name" 
                                value="{{ $matches->team2->name }}" 
                                placeholder="Enter Team 2 Name"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
                        </div>
                    </div>

                    <!-- Date & Time -->
                    <div class="grid grid-cols-12 gap-4 mb-4">
                        <div class="col-span-4">
                            <label for="date" class="block font-semibold mb-1">Date</label>
                            <input type="date" name="date" id="date" 
                                value="{{ $matches->date }}" 
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
                        </div>
                        <div class="col-span-4">
                            <label for="start_time" class="block font-semibold mb-1">Start Time</label>
                            <input type="time" name="start_time" id="start_time" 
                                value="{{ $matches->start_time }}" 
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
                        </div>
                        <div class="col-span-4">
                            <label for="end_time" class="block font-semibold mb-1">End Time</label>
                            <input type="time" name="end_time" id="end_time" 
                                value="{{ $matches->end_time }}" 
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
                        </div>
                    </div>

                    <!-- Group -->
                    <div class="mb-4">
                        <label for="group" class="block font-semibold mb-1">Group</label>
                        <input type="text" name="group" id="group" 
                            value="{{ $matches->groupcreate->Name }}" 
                            placeholder="Enter Group Name"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
                    </div>

                    <!-- Venue -->
                    <div class="mb-6">
                        <label for="venue" class="block font-semibold mb-1">Venue</label>
                        <select name="venue" id="venue" 
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
                            <option value="">Select Venue</option>
                            @foreach($venues as $venue)
                                <option value="{{ $venue->id }}" @if($matches->venue_id == $venue->id) selected @endif>{{ $venue->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="history.back()"
                            class="px-4 py-2 rounded-lg bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold">
                            <i class="fa-solid fa-arrow-left mr-2"></i> Back
                        </button>
                        <button type="submit"
                            class="px-4 py-2 rounded-lg bg-green-600 hover:bg-green-700 text-white font-semibold">
                            UPDATE MATCH
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
