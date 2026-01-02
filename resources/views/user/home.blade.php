<x-guest-layout>

    {{-- HERO --}}
    <section class="relative min-h-[90vh] flex items-center overflow-hidden">
        <!-- Background image remains unchanged -->
        <div class="absolute inset-0 -z-10">
            <img
                src="{{ asset('img/banner.jpeg') }}"
                alt="Banner"
                class="w-full h-full object-cover"
            />
            <div class="absolute inset-0 bg-black/50"></div>
        </div>

        <!-- Hero content remains the same -->
        <div class="relative max-w-7xl mx-auto px-4 text-center">
            <span class="block text-sm sm:text-base uppercase tracking-widest text-indigo-400 mb-4">
                {{ $homeArr['home']->banner_s_header }}
            </span>

            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white leading-tight drop-shadow-lg">
                {{ $homeArr['home']->banner_b_header }}
            </h1>

            <p class="mt-6 max-w-2xl mx-auto text-slate-200 text-lg drop-shadow">
                {{ $homeArr['home']->banner_paragraph }}
            </p>

            <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center">
                <a
                    href="{{ route('register') }}"
                    class="inline-flex justify-center rounded-full bg-indigo-600 px-10 py-3 font-semibold text-white hover:bg-indigo-500 transition"
                >
                    Register Now
                </a>

                @guest
                    <a
                        href="{{ route('login') }}"
                        class="inline-flex justify-center rounded-full border border-white/40 px-10 py-3 font-semibold text-white hover:bg-white hover:text-slate-900 transition"
                    >
                        Login
                    </a>
                @endguest
            </div>
        </div>
    </section>

    {{-- ACHIEVEMENTS --}}
    <section class="relative py-24 bg-[#f8f9fd]">
        <div class="relative max-w-7xl mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-center text-purple-700 mb-16">
                Our Achievements
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @forelse ($homeArr['Achievement'] as $achievement)
                    <div class="bg-white border border-[#d4af37] rounded-xl p-8 text-center shadow hover:shadow-lg transition">
                        <div class="text-4xl text-[#d4af37] mb-4">
                            <i class="{{ $achievement->icon }}"></i>
                        </div>
                        <h4 class="font-semibold text-purple-700 mb-2">
                            {{ $achievement->title }}
                        </h4>
                        <p class="text-gray-600 text-sm">
                            {{ $achievement->description }}
                        </p>
                    </div>
                @empty
                    <p class="col-span-full text-center text-gray-500">
                        No achievements found.
                    </p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- REGISTER YOUR TEAM --}}
    <section class="relative">
        <div class="w-full mx-auto flex flex-col md:flex-row items-center relative">

            <!-- Left Section -->
            <div class="relative h-96 flex-1 flex items-center justify-center bg-white">
                <img src="{{ asset('img/banner.jpeg') }}" alt="Liga Hoki"
                     class="absolute inset-0 w-full h-full object-cover">
                <div class="absolute inset-0 bg-black/50"></div>

                <div class="relative z-10 text-center px-4">
                    <h2 class="text-4xl font-extrabold mb-4 text-white">
                        Register Your Team
                    </h2>
                    <p class="text-lg text-slate-200 mb-8">
                        Secure your spot in the next tournament
                    </p>
                    <form id="registerTeamForm">
                        <button
                            type="submit"
                            class="rounded-full bg-yellow-500 px-10 py-3 font-semibold hover:bg-yellow-400 transition"
                        >
                            Get Started
                        </button>
                    </form>
                </div>

                <!-- On mobile, right image appears behind -->
                <img src="{{ asset('img/liga-hoki.jpeg') }}" alt="Liga Hoki"
                     class="absolute inset-0 w-full h-full object-cover md:hidden">
                <div class="absolute inset-0 bg-black/10 md:hidden"></div>
            </div>

            <!-- Right Section (only visible on md+) -->
            <div class="relative h-96 flex-1 overflow-hidden hidden md:flex items-center justify-center">
                <img src="{{ asset('img/liga-hoki.jpeg') }}" alt="Liga Hoki" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-green-900/30"></div>
            </div>

            <!-- Goalkeeper (hidden on small screens) -->
            <div class="absolute inset-0 flex justify-center items-center pointer-events-none hidden md:flex">
                <img src="{{ asset('img/goalkeeper.png') }}" alt="Goalkeeper" class="w-72 md:w-80 z-20">
            </div>
        </div>
    </section>

    {{-- TEAM --}}
    <section class="py-24 bg-[#f8f9fd]">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-center text-purple-700 mb-16">
                Meet Our Team
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                @forelse ($homeArr['meet'] as $meet)
                    <div class="bg-white border border-[#d4af37] rounded-xl p-8 text-center shadow hover:shadow-lg transition">
                        <div class="w-32 h-32 mx-auto rounded-full bg-cover bg-center ring-4 ring-[#d4af37] mb-4"
                             style="background-image: url('{{ $meet->img }}');">
                        </div>

                        <h4 class="font-semibold text-purple-700">
                            {{ $meet->name }}
                        </h4>
                        <p class="text-gray-600 mb-4">
                            {{ $meet->position }}
                        </p>

                        <div class="flex justify-center gap-4 text-xl text-gray-600">
                            @if($meet->icon_link1)<i class="{{ $meet->icon_link1 }} hover:text-[#d4af37]"></i>@endif
                            @if($meet->icon_link2)<i class="{{ $meet->icon_link2 }} hover:text-[#d4af37]"></i>@endif
                            @if($meet->icon_link3)<i class="{{ $meet->icon_link3 }} hover:text-[#d4af37]"></i>@endif
                        </div>
                    </div>
                @empty
                    <p class="col-span-full text-center text-gray-500">
                        No team members found.
                    </p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- FAQ --}}
    <section class="py-24 bg-[#f8f9fd]">
        <div class="max-w-4xl mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-center text-purple-700 mb-12">
                Frequently Asked Questions
            </h2>

            <div class="space-y-4" x-data="{ open: null }">
                @foreach ($faqs as $index => $faq)
                    <div class="bg-white border border-[#d4af37] rounded-xl overflow-hidden shadow">
                        <button
                            @click="open === {{ $index }} ? open = null : open = {{ $index }}"
                            class="w-full flex justify-between items-center px-6 py-5 text-left focus:outline-none"
                        >
                            <span class="font-semibold text-purple-700">
                                {{ $faq->question }}
                            </span>

                            <svg
                                :class="open === {{ $index }} ? 'rotate-45' : ''"
                                class="w-5 h-5 text-[#d4af37] transition-transform duration-300"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4"/>
                            </svg>
                        </button>

                        <div
                            x-show="open === {{ $index }}"
                            x-collapse
                            class="px-6 pb-5 text-gray-700"
                        >
                            {{ $faq->answer }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

</x-guest-layout>
