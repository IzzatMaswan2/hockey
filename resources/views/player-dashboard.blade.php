<x-admin-layout :title="'Player Dashboard'">

<main class="flex-1 min-h-screen bg-gray-100 p-6">

    <!-- HEADER -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-purple-700">Player Dashboard</h1>
            <p class="text-gray-600 mt-1">Overview of player performance & daily activity</p>
        </div>

        <div class="mt-4 md:mt-0 bg-white rounded-xl shadow px-4 py-3 flex items-center gap-4">
            <img src="{{ $teamDetails['logo'] ?? asset('img/default-team.png') }}" class="w-12 h-12 rounded-lg" alt="Team Logo">
            <div>
                <p class="font-semibold">{{ Auth::user()->fullName }}</p>
                <p class="text-sm text-gray-500">{{ Auth::user()->position }} • #{{ Auth::user()->jerseyNumber }}</p>
            </div>
        </div>
    </div>

    <!-- KPI STATS -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8">
        <x-player.kpi-card title="Matches Played" value="18" color="purple"/>
        <x-player.kpi-card title="Goals" value="7" color="purple"/>
        <x-player.kpi-card title="Assists" value="5" color="purple"/>
        <x-player.kpi-card title="Training Sessions" value="42" color="purple"/>
    </div>

    <!-- MAIN CONTENT GRID -->
    <div class="grid lg:grid-cols-3 gap-8">

        <!-- DAILY ACTIVITY -->
        <x-player.daily-activity :activities="$activities"/>

        <!-- PLAYER STATUS -->
        <x-player.status :status="$statuses"/>

    </div>

    <!-- RECENT ACTIVITY -->
    <x-player.activity-log :logs="$activityLog"/>

    <!-- TOURNAMENTS -->
    <x-player.tournaments :tournaments="$tournaments"/>

</main>
</x-admin-layout>
