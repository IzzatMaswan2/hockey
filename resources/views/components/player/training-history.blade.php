@props(['history'])

<div class="space-y-4">
    @forelse($history as $item)
    <div class="flex justify-between border-b pb-2">
        <p>{{ $item['activity'] }}</p>
        <span class="text-sm text-gray-500">{{ $item['date'] }}</span>
    </div>
    @empty
    <p class="text-gray-500">No training history available.</p>
    @endforelse
</div>
