@props(['activities'])

<div class="lg:col-span-2 bg-white rounded-2xl shadow p-6">
    <h2 class="text-xl font-bold mb-6 text-purple-700">Today’s Physical Activity</h2>

    <div class="grid md:grid-cols-3 gap-6">
        @foreach($activities as $act)
        <div class="border rounded-xl p-4 text-center">
            <p class="text-sm text-gray-500">{{ $act['title'] }}</p>
            <p class="text-2xl font-bold">{{ $act['value'] }}</p>
            @isset($act['unit'])
            <p class="text-xs text-gray-400">{{ $act['unit'] }}</p>
            @endisset
        </div>
        @endforeach
    </div>
</div>
