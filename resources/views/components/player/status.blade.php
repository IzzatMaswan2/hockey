@props(['status'])

<div class="bg-white rounded-2xl shadow p-6">
    <h2 class="text-xl font-bold mb-6 text-purple-700">Player Status</h2>

    <ul class="space-y-3 text-gray-700">
        @foreach($status as $key => $value)
            <li>
                <strong>{{ $key }}:</strong> 
                @if(is_array($value))
                    {{ implode(', ', $value) }}
                @else
                    {{ $value }}
                @endif
            </li>
        @endforeach
    </ul>
</div>
