<x-admin-layout>
    <div class="flex w-full min-h-screen">

        {{-- Sidebar --}}
        @include('layouts.sidebar')

        {{-- Main Content --}}
        <main class="flex-1 p-6 bg-gray-100">

            <!-- Header -->
            <div class="bg-white rounded-2xl shadow p-6 mb-6">
                <h4 class="text-2xl font-bold text-gray-800">Select a Tournament</h4>
                <p class="text-gray-500">Choose a tournament to view matches and statistics</p>
            </div>

            <!-- Tournament List -->
            <div class="bg-white rounded-2xl shadow p-6">
                <h5 class="text-xl font-semibold mb-4">Tournaments</h5>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b bg-gray-50">
                                <th class="p-3 font-semibold text-gray-700">Tournament Name</th>
                                <th class="p-3 font-semibold text-gray-700 text-center">Actions</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y">
                        @foreach($tournaments as $tournament)
                            <tr class="hover:bg-purple-50 transition">
                                <td class="p-3 text-gray-800 font-medium">
                                    {{ $tournament->name }}
                                </td>

                                <td class="p-3 text-center space-x-2">

                                    <!-- View Matches Button -->
                                    <a href="{{ route('stat.matches.index', $tournament->id) }}"
                                       class="inline-block px-4 py-1.5 bg-blue-600 text-white rounded-lg text-sm shadow hover:bg-blue-700 transition">
                                        View Matches
                                    </a>

                                    <!-- Knockout Matches Button -->
                                    @if ($knockout->has($tournament->id))
                                        @php $tournament_id = $tournament->id; @endphp
                                        <a href="{{ route('knockout.match', $tournament_id) }}"
                                           class="inline-block px-4 py-1.5 bg-gray-700 text-white rounded-lg text-sm shadow hover:bg-gray-800 transition">
                                            Knockout Matches
                                        </a>
                                    @endif
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
