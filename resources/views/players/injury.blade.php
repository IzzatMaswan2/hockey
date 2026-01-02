<x-admin-layout :title="'Injury & Recovery'">

<main class="flex-1 min-h-screen bg-gray-100 p-6">

<h1 class="text-3xl font-bold text-purple-700 mb-6">Injury & Recovery</h1>

<div class="grid lg:grid-cols-2 gap-6">

    <!-- INJURY REPORTS -->
    <div class="bg-white rounded-2xl shadow p-6">
        <h2 class="text-xl font-bold mb-4 text-purple-700">Current Injuries</h2>
        <x-player.injury-list :injuries="$injuries"/>
    </div>

    <!-- RECOVERY LOG -->
    <div class="bg-white rounded-2xl shadow p-6">
        <h2 class="text-xl font-bold mb-4 text-purple-700">Recovery Log</h2>
        <x-player.recovery-log :recoveries="$recoveries"/>
    </div>

</div>

</main>
</x-admin-layout>
