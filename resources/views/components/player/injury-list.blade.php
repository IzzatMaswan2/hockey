@props(['injuries'])

<ul class="space-y-3 text-gray-700">
    @forelse($injuries as $injury)
    <li>
        <strong>{{ $injury['name'] }}:</strong> {{ $injury['status'] }}
        @isset($injury['notes']) - {{ $injury['notes'] }} @endisset
    </li>
    @empty
    <li>No injuries reported.</li>
    @endforelse
</ul>
