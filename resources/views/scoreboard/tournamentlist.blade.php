<x-admin-layout>
    <div class="flex min-h-screen w-full">
        <!-- Sidebar -->
        {{-- <aside class="w-1/4 bg-gray-400 p-6"> --}}
            @include('layouts.sidebar')
        {{-- </aside> --}}

        <!-- Main Content -->
        <main class="flex-1 p-6 bg-gray-100">
            <!-- Header -->
            <div class="mb-6 bg-white rounded-2xl p-6 shadow">
                <h4 class="text-2xl font-bold mb-2">Select a Tournament</h4>
                <p class="text-gray-500">Choose a tournament to view matches and scoreboard</p>
            </div>

            <!-- Tournament List -->
            <div class="bg-white rounded-2xl shadow p-6">
                <h5 class="text-xl font-semibold mb-4">Tournaments</h5>
                <ul class="space-y-2">
                    @foreach($tournaments as $tournament)
                        <li class="border border-gray-200 rounded-lg hover:bg-purple-50 transition">
                            <a href="{{ route('scoreboard.filterMatches', $tournament->id) }}" class="block px-4 py-3 text-gray-700 font-medium hover:text-purple-700">
                                {{ $tournament->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </main>
    </div>
</x-admin-layout>
