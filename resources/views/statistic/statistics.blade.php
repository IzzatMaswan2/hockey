<x-admin-layout>
    <div class="flex min-h-screen bg-gray-100 w-full">

        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Main Content -->
        <main class="flex-1 p-6">

            <!-- Header -->
            <div class="bg-white rounded-2xl shadow p-6 mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Match Statistics</h2>
                <p class="text-gray-500 mt-1">Fill in the statistics of the match and manage events</p>
            </div>

            <!-- Match Overview -->
            <div class="bg-purple-700 rounded-2xl shadow p-6 mb-6 text-white">
                <div class="grid grid-cols-1 md:grid-cols-3 items-center text-center gap-4">
                    @php
                        // dd($TeamA->logoURL);
                    @endphp
                    <!-- Team A -->
                    <div class="flex flex-col items-center gap-2">
                        <img src="{{ asset('storage/' . $TeamA->LogoURL) }}" alt="{{$TeamA->name}} Logo" class="w-24 h-24 object-contain">
                        <h3 class="font-semibold text-xl">{{$Teams[($match->TeamAID)-1]->name}}</h3>
                        <div class="text-3xl font-bold">{{$match->ScoreA ?? 'N/A'}}</div>
                    </div>

                    <!-- VS -->
                    <div class="flex flex-col justify-center items-center">
                        <span class="text-2xl font-bold">VS</span>
                        <span class="text-sm mt-1">{{$match->Venue}} | {{$match->Date}} ({{$match->start_time}} - {{$match->end_time}})</span>
                    </div>

                    <!-- Team B -->
                    <div class="flex flex-col items-center gap-2">
                        <img src="{{ asset('storage/' . $TeamB->LogoURL) }}" alt="{{$TeamB->name}} Logo" class="w-24 h-24 object-contain">
                        <h3 class="font-semibold text-xl">{{$Teams[($match->TeamBID)-1]->name}}</h3>
                        <div class="text-3xl font-bold">{{$match->ScoreB ?? 'N/A'}}</div>
                    </div>
                </div>
            </div>

            <!-- Add Statistic Form -->
            <div class="bg-white rounded-2xl shadow p-6 mb-6">
                <form method="POST" action="{{ route('statistics.store', $match->Match_groupID) }}">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 font-semibold mb-1" for="PlayerID">Player:</label>
                            <select class="border-gray-300 rounded-lg w-full p-2" id="PlayerID" name="PlayerID">
                                <option value="">Select a Player</option>
                                @foreach ($combinedPlayers as $player)
                                    <option value="{{ $player['id'] }}">{{ $player['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-1" for="Time">Minute of Event:</label>
                            <input type="text" class="border-gray-300 rounded-lg w-full p-2" id="Time" name="Time" value="00:00:00" placeholder="e.g., 00:00:15" required>
                            <small class="text-gray-500 text-sm">Enter time in the format HH:MM:SS.</small>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-1" for="StatID">Statistic:</label>
                            <select class="border-gray-300 rounded-lg w-full p-2" id="StatID" name="StatID">
                                <option value="">Select the Statistic</option>
                                @foreach ($stats as $stat)
                                    <option value="{{ $stat['StatID'] }}">{{ $stat['Description'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-1" for="Reason">Reason:</label>
                            <input type="text" class="border-gray-300 rounded-lg w-full p-2" id="Reason" name="Reason" maxlength="100">
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition">Save</button>
                    </div>
                </form>
            </div>

            <!-- Existing Statistics Table -->
            <div class="bg-white rounded-2xl shadow p-6">
                <h3 class="text-xl font-semibold mb-4">Existing Statistics & Events</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 table-auto">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Player</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Time</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Description</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Reason</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($statistics as $statistic)
                                <tr>
                                    <td class="px-4 py-2">{{ $players[$statistic->PlayerID]->displayName ?? 'Unknown' }}</td>
                                    <td class="px-4 py-2">{{ $statistic->Time }}</td>
                                    <td class="px-4 py-2">{{ $stats[($statistic->StatID)-1]->Description ?? 'None' }}</td>
                                    <td class="px-4 py-2">{{ $statistic->Reason }}</td>
                                    <td class="px-4 py-2 space-x-2">
                                        <a href="{{ route('statistics.edit', $statistic->PlayerStatMatchID) }}" class="bg-yellow-400 hover:bg-yellow-500 text-white px-2 py-1 rounded text-sm">Edit</a>
                                        <form method="POST" action="{{ route('statistics.destroy', $statistic->PlayerStatMatchID) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this event?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-2 py-1 rounded text-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>
</x-admin-layout>
