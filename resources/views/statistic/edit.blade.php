<x-admin-layout>
    <div class="flex min-h-screen bg-gray-100 w-full">

        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Main Content -->
        <main class="flex-1 p-6">

            <!-- Header -->
            <div class="bg-white rounded-2xl shadow p-6 mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Edit Statistic</h2>
                <p class="text-gray-500 mt-1">Update the statistic for this match</p>
            </div>

            <!-- Edit Statistic Form -->
            <div class="bg-white rounded-2xl shadow p-6">
                <form method="POST" action="{{ route('statistics.update', $statistic->PlayerStatMatchID) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="Match_groupID" value="{{ $statistic->Match_groupID }}">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Player -->
                        <div>
                            <label class="block text-gray-700 font-semibold mb-1" for="PlayerID">Player Name:</label>
                            <select class="border-gray-300 rounded-lg w-full p-2" id="PlayerID" name="PlayerID">
                                @foreach ($combinedPlayers as $player)
                                    <option value="{{ $player['id'] }}" {{ $player['id'] == $statistic->PlayerID ? 'selected' : '' }}>
                                        {{ $player['name'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Time -->
                        <div>
                            <label class="block text-gray-700 font-semibold mb-1" for="Time">Time (HH:MM:SS):</label>
                            <input type="text" class="border-gray-300 rounded-lg w-full p-2" id="Time" name="Time" value="{{ $statistic->Time }}">
                        </div>

                        <!-- Statistic -->
                        <div>
                            <label class="block text-gray-700 font-semibold mb-1" for="StatID">Statistic:</label>
                            <select class="border-gray-300 rounded-lg w-full p-2" id="StatID" name="StatID">
                                @foreach ($stats as $stat)
                                    <option value="{{ $stat['StatID'] }}" {{ $stat['StatID'] == $statistic->StatID ? 'selected' : '' }}>
                                        {{ $stat['Description'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Reason -->
                        <div>
                            <label class="block text-gray-700 font-semibold mb-1" for="Reason">Reason:</label>
                            <input type="text" class="border-gray-300 rounded-lg w-full p-2" id="Reason" name="Reason" value="{{ $statistic->Reason }}" maxlength="100">
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition">
                            Update
                        </button>
                    </div>
                </form>
            </div>

        </main>
    </div>
</x-admin-layout>
