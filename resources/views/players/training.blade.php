<x-admin-layout :title="'Training & Fitness'">

<main class="flex-1 min-h-screen bg-gray-100 p-6">

<h1 class="text-3xl font-bold text-purple-700 mb-6">Training & Fitness</h1>

<div class="grid lg:grid-cols-3 gap-6">

    <!-- DAILY LOGS -->
    <div class="lg:col-span-2 bg-white rounded-2xl shadow p-6">
        <h2 class="text-xl font-bold mb-4 text-purple-700">Today's Training</h2>
        <div class="grid md:grid-cols-3 gap-4">
            @foreach($todayExercises as $exercise)
            <div class="border rounded-xl p-4 text-center">
                <p class="text-sm text-gray-500">{{ $exercise['name'] }}</p>
                <p class="text-2xl font-bold">{{ $exercise['value'] }}</p>
                <p class="text-xs text-gray-400">{{ $exercise['unit'] }}</p>
            </div>
            @endforeach
        </div>
    </div>

    <!-- GOALS & PROGRESS -->
    <div class="bg-white rounded-2xl shadow p-6">
        <h2 class="text-xl font-bold mb-4 text-purple-700">Goals & Progress</h2>
        @foreach($goals as $goal)
        <div class="mb-4">
            <p class="text-gray-700">{{ $goal['title'] }}</p>
            <div class="w-full bg-gray-200 rounded-full h-4">
                <div class="bg-purple-600 h-4 rounded-full" style="width: {{ $goal['progress'] }}%"></div>
            </div>
        </div>
        @endforeach
    </div>

</div>

<!-- HISTORY / CALENDAR -->
<div class="mt-6 bg-white rounded-2xl shadow p-6">
    <h2 class="text-xl font-bold mb-4 text-purple-700">Training History</h2>
    <x-player.training-history :history="$history"/>
</div>

</main>
</x-admin-layout>
