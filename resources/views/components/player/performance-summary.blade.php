@props(['stats'])

<div class="space-y-4">
    @foreach($stats as $stat)
    <div>
        <p class="text-gray-700 mb-1">{{ $stat['label'] }}</p>
        <div class="w-full bg-gray-200 rounded-full h-4">
            <div class="bg-purple-600 h-4 rounded-full" style="width: {{ $stat['value'] }}%"></div>
        </div>
    </div>
    @endforeach
</div>
