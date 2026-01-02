{{-- resources/views/layouts/sidebar-manager.blade.php --}}

<aside
    x-data="{ openMenu: null, mobileOpen: false }"
    class="bg-gradient-to-b from-gray-900 to-gray-800 text-white shadow-xl
           w-64 min-h-screen p-4 hidden md:flex flex-col"
>

    {{-- LOGO --}}
    <div class="flex items-center justify-center mb-6">
        <img src="{{ asset('img/Logo Latest 1.png') }}"
             class="w-14 h-14 rounded-full shadow-md"
             alt="Logo">
    </div>

    {{-- DASHBOARD --}}
    <a href="/manager-dashboard"
       class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-700 transition">
        <i class="fas fa-tachometer-alt text-purple-400 w-5"></i>
        <span class="font-semibold">Dashboard</span>
    </a>

    {{-- PLAYER MANAGEMENT --}}
    <a href="/manageplayer"
       class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-700 transition mt-2">
        <i class="fas fa-users text-green-400 w-5"></i>
        <span class="font-semibold">Manage Players</span>
    </a>

    {{-- MATCH MANAGEMENT --}}
    <a href="/match-score"
       class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-700 transition mt-2">
        <i class="fas fa-calendar-alt text-yellow-400 w-5"></i>
        <span class="font-semibold">Manage Match</span>
    </a>

    {{-- COMMENTED FEATURES (KEPT AS REQUESTED) --}}
    {{--
    <a href="/formation"
       class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-700 transition mt-2">
        <i class="fas fa-project-diagram w-5"></i>
        Manage Formations
    </a>

    <a href="/line-up"
       class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-700 transition mt-2">
        <i class="fas fa-list w-5"></i>
        Line-Up
    </a>
    --}}
</aside>

{{-- MOBILE BOTTOM NAVIGATION --}}
<div
    x-data="{ mobileOpen: false }"
    class="md:hidden fixed bottom-0 left-0 w-full bg-gray-900 text-white shadow-2xl z-50"
>
    <div class="flex justify-around py-3 text-xs">

        <a href="/manager-dashboard" class="flex flex-col items-center">
            <i class="fas fa-home text-lg"></i>
            <span>Home</span>
        </a>

        <a href="/manageplayer" class="flex flex-col items-center">
            <i class="fas fa-users text-lg"></i>
            <span>Players</span>
        </a>

        <a href="/match-score" class="flex flex-col items-center">
            <i class="fas fa-calendar-alt text-lg"></i>
            <span>Matches</span>
        </a>

        <button @click="mobileOpen = !mobileOpen"
                class="flex flex-col items-center">
            <i class="fas fa-bars text-lg"></i>
            <span>More</span>
        </button>

    </div>

    {{-- MOBILE DRAWER --}}
    <div
        x-show="mobileOpen"
        x-transition
        class="fixed bottom-14 left-0 w-full bg-gray-800 text-white p-4 rounded-t-2xl shadow-2xl"
    >
        <button @click="mobileOpen = false"
                class="w-full text-center text-gray-300 mb-3">
            <i class="fas fa-times text-xl"></i>
        </button>

        <div class="space-y-2">
            <a href="/manager-dashboard" class="block p-2 rounded bg-gray-700">
                Dashboard
            </a>
            <a href="/manageplayer" class="block p-2 rounded bg-gray-700">
                Manage Players
            </a>
            <a href="/match-score" class="block p-2 rounded bg-gray-700">
                Manage Match
            </a>

            {{-- COMMENTED LINKS --}}
            {{--
            <a href="/formation" class="block p-2 rounded bg-gray-700">
                Manage Formations
            </a>
            <a href="/line-up" class="block p-2 rounded bg-gray-700">
                Line-Up
            </a>
            --}}
        </div>
    </div>
</div>

<script src="//unpkg.com/alpinejs" defer></script>
