@props(['recoveries'])

<ul class="space-y-3 text-gray-700">
    @forelse($recoveries as $rec)
    <li>
        <strong>{{ $rec['date'] }}:</strong> {{ $rec['activity'] }} ({{ $rec['duration'] }})
    </li>
    @empty
    <li>No recovery logs available.</li>
    @endforelse
</ul>
