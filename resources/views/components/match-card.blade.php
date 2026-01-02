@props([
    'teamA',
    'teamB',
    'meta' => [],
    'scoreA' => null,
    'scoreB' => null,
    'actionUrl' => null,
    'actionLabel' => null,
    'scoreColor' => 'text-gray-800',
])

<div class="w-full flex justify-center">
    <div class="w-full flex flex-col md:flex-row items-center justify-between
                bg-white/80 backdrop-blur rounded-xl p-4 shadow-md
                space-y-4 md:space-y-0 md:space-x-6">

        {{-- TEAM A --}}
        <div class="flex flex-col items-center md:items-start space-y-2 w-32">
            @if(!empty($teamA->logoURL))
                <img src="{{ asset('storage/'.$teamA->logoURL) }}"
                     class="w-20 h-20 object-cover rounded-lg">
            @else
                <div class="w-20 h-20 flex items-center justify-center
                            bg-gray-200 text-gray-700 font-bold rounded-lg">
                    {{ collect(explode(' ', $teamA->Name))->take(2)->map(fn($w)=>$w[0])->join('') }}
                </div>
            @endif

            <h3 class="text-lg font-semibold text-center md:text-left">
                {{ $teamA->Name ?? 'TBA' }}
            </h3>

            @if(!is_null($scoreA))
                <div class="text-xl font-bold {{ $scoreColor }}">
                    {{ $scoreA }}
                </div>
            @endif
        </div>

        {{-- META --}}
        <div class="flex flex-col items-center text-center space-y-1">
            @foreach($meta as $line)
                <div class="text-sm font-medium">{{ $line }}</div>
            @endforeach

            <div class="text-2xl font-extrabold">vs</div>

            @if($actionUrl)
                <a href="{{ $actionUrl }}"
                   class="px-3 py-1 rounded-full text-sm font-semibold
                          bg-indigo-600 text-white hover:bg-indigo-500 transition">
                    {{ $actionLabel }}
                </a>
            @endif
        </div>

        {{-- TEAM B --}}
        <div class="flex flex-col items-center md:items-end space-y-2 w-32">
            @if(!empty($teamB->logoURL))
                <img src="{{ asset('storage/'.$teamB->logoURL) }}"
                     class="w-20 h-20 object-cover rounded-lg">
            @else
                <div class="w-20 h-20 flex items-center justify-center
                            bg-gray-200 text-gray-700 font-bold rounded-lg">
                    {{ collect(explode(' ', $teamB->Name))->take(2)->map(fn($w)=>$w[0])->join('') }}
                </div>
            @endif

            <h3 class="text-lg font-semibold text-center md:text-right">
                {{ $teamB->Name ?? 'TBA' }}
            </h3>

            @if(!is_null($scoreB))
                <div class="text-xl font-bold {{ $scoreColor }}">
                    {{ $scoreB }}
                </div>
            @endif
        </div>

    </div>
</div>
