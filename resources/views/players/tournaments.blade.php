<x-admin-layout :title="'Tournaments'">

<main class="flex-1 min-h-screen bg-gray-100 p-6">

<h1 class="text-3xl font-bold text-purple-700 mb-6">Tournaments</h1>

<!-- ACTIVE TOURNAMENTS -->
<div class="bg-white rounded-2xl shadow p-6 mb-6">
    <h2 class="text-xl font-bold mb-4 text-purple-700">Active Tournaments</h2>
    <x-player.tournament-list :tournaments="$activeTournaments"/>
</div>

<!-- PAST TOURNAMENTS -->
<div class="bg-white rounded-2xl shadow p-6 mb-6">
    <h2 class="text-xl font-bold mb-4 text-purple-700">Past Tournaments</h2>
    <x-player.tournament-list :tournaments="$pastTournaments"/>
</div>

</main>
</x-admin-layout>
