<x-admin-layout :title="'Matches & Performance'">

<main class="flex-1 min-h-screen bg-gray-100 p-6">

<h1 class="text-3xl font-bold text-purple-700 mb-6">Matches & Performance</h1>

<div class="grid lg:grid-cols-3 gap-6">

    <!-- UPCOMING MATCHES -->
    <div class="lg:col-span-2 bg-white rounded-2xl shadow p-6">
        <h2 class="text-xl font-bold mb-4 text-purple-700">Upcoming Matches</h2>
        <x-player.matches-table :matches="$upcomingMatches"/>
    </div>

    <!-- PLAYER PERFORMANCE SUMMARY -->
    <div class="bg-white rounded-2xl shadow p-6">
        <h2 class="text-xl font-bold mb-4 text-purple-700">Performance Summary</h2>
        <x-player.performance-summary :stats="$performanceStats"/>
    </div>

</div>

<!-- PAST MATCHES -->
<div class="mt-6 bg-white rounded-2xl shadow p-6">
    <h2 class="text-xl font-bold mb-4 text-purple-700">Past Matches</h2>
    <x-player.matches-table :matches="$pastMatches"/>
</div>

</main>
</x-admin-layout>
