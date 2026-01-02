@props(['logs'])

<div class="mt-10 bg-white rounded-2xl shadow p-6">
    <h2 class="text-xl font-bold mb-6 text-purple-700">Recent Activity Log</h2>

    <div class="space-y-4">
        @foreach($logs as $log)
        <div class="flex justify-between border-b pb-2">
            <p>{{ $log['activity'] }}</p>
            <span class="text-sm text-gray-500">{{ $log['time'] }}</span>
        </div>
        @endforeach
    </div>
</div>
