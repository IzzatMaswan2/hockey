@props(['matches'])

<div class="overflow-x-auto">
    <table class="min-w-full bg-white rounded-xl shadow overflow-hidden">
        <thead class="bg-indigo-600 text-white">
            <tr>
                <th class="px-4 py-2 text-left">Date</th>
                <th class="px-4 py-2 text-left">Opponent</th>
                <th class="px-4 py-2 text-center">Result</th>
                <th class="px-4 py-2 text-center">Score</th>
            </tr>
        </thead>
        <tbody>
            @foreach($matches as $match)
            <tr class="odd:bg-white even:bg-gray-100">
                <td class="px-4 py-2">{{ $match['date'] }}</td>
                <td class="px-4 py-2">{{ $match['opponent'] }}</td>
                <td class="px-4 py-2 text-center">{{ $match['result'] }}</td>
                <td class="px-4 py-2 text-center">{{ $match['score'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
