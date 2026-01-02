<x-guest-layout>

    {{-- PAGE HEADER --}}
    <section class="py-12 bg-gray-700/20">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-3xl font-bold text-white mb-2 drop-shadow-md">Select a Tournament</h1>
            <p class="text-white">Choose a tournament to view the match schedule</p>
        </div>
    </section>

    {{-- TOURNAMENT LIST --}}
    <section class="py-12 bg-purple-100/30">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach($tournaments as $tournament)
                    <a href="{{ route('fixture.index', $tournament->id) }}" 
                       class="flex flex-col items-center justify-center bg-gray-200/40 rounded-3xl shadow-lg hover:shadow-2xl transition transform hover:-translate-y-1 p-6">
                        <div class="w-40 h-40 bg-gray-400/50 rounded-2xl mb-4 flex items-center justify-center text-2xl font-bold text-gray-900 shadow-inner">
                            {{ Str::limit($tournament->name, 2, '') }}
                        </div>
                        <h3 class="text-lg font-semibold text-purple-900 text-center drop-shadow-md">{{ $tournament->name }}</h3>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

</x-guest-layout>
