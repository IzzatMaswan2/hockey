<x-guest-layout>

    <div class="py-16 flex justify-center">

        <div class="w-full max-w-3xl text-center relative p-12 rounded-2xl bg-[url('/img/logreg.jpg')] bg-center bg-cover shadow-xl">

            {{-- Header --}}
            <h1 class="inline-block bg-gradient-to-r from-blue-700/80 via-blue-600/70 to-blue-700/80 border-4 border-yellow-400 text-yellow-300 text-3xl md:text-4xl font-extrabold rounded-3xl px-8 py-3 mb-10 shadow-lg font-poppins tracking-wide text-shadow-md">
                Tournaments List
            </h1>

            {{-- Success Message --}}
            @if(session('success'))
                <div class="mb-6 px-6 py-4 bg-blue-500 text-white rounded-lg shadow-md">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Tournament Cards --}}
            <div class="flex flex-col items-center gap-6 px-4">
                @foreach($tournaments as $tournament)
                    <a href="{{ route('tournamentlist.details', ['id' => $tournament->id]) }}"
                       class="flex flex-col md:flex-row w-full max-w-2xl bg-blue-600/40 backdrop-blur-sm text-white border-2 border-yellow-400 rounded-xl p-6 md:p-8 shadow-lg hover:shadow-2xl transition transform hover:scale-105 no-underline overflow-hidden">

                        {{-- Image Column --}}
                        <div class="flex-shrink-0">
                            <img src="{{ asset('storage/' . $tournament->image) }}" 
                                 alt="{{ $tournament->name }}" 
                                 class="w-36 h-36 md:w-40 md:h-40 object-cover rounded-lg border-4 border-yellow-400 shadow-md">
                        </div>

                        {{-- Info Column --}}
                        <div class="flex-1 flex flex-col justify-center text-center md:text-left mt-4 md:mt-0 ml-0 md:ml-6 space-y-2">
                            <h2 class="text-2xl md:text-3xl font-bold mb-0 text-yellow-300 drop-shadow-lg hover:text-shadow-lg transition">
                                {{ $tournament->name }}
                            </h2>
                            <p class="text-yellow-100 text-opacity-90 text-base md:text-lg">
                                {{ $tournament->description }}
                            </p>
                        </div>

                    </a>
                @endforeach
            </div>

        </div>

    </div>

    {{-- Optional Custom CSS for hover text glow --}}
    <style>
        .hover\:text-shadow-lg:hover {
            text-shadow: 2px 2px 8px rgba(255, 255, 0, 0.6);
        }
    </style>

</x-guest-layout>
