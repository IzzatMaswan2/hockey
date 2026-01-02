@props(['tournaments'])

<div class="mt-10 bg-white rounded-2xl shadow p-6">
    <h2 class="text-xl font-bold mb-4 text-purple-700 text-center">Tournaments Joined</h2>

    <ul class="list-disc list-inside text-center space-y-1 text-gray-700">
        @foreach($tournaments as $tournament)
        <li>{{ $tournament['name'] }}</li>
        @endforeach
    </ul>
</div>
