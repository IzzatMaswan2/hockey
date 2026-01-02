<x-guest-layout>

    {{-- HERO --}}
    <section class="relative ">
        <div class="absolute inset-0">
            <img src="{{ asset('img/banner.jpeg') }}" alt="About Us Banner"
                 class="w-full h-full object-cover opacity-30">
            <div class="absolute inset-0 bg-black/50"></div>
        </div>

        <div class="relative max-w-5xl mx-auto px-4 py-24 text-center">
            <h1 class="text-4xl sm:text-5xl font-extrabold text-white">
                About Us
            </h1>

            <p class="mt-6 text-lg text-white max-w-3xl mx-auto font-semibold">
                Welcome to <span class="font-semibold text-white">Hoki Arena</span>,
                a premier platform for world-class Hoki tournaments.
                We unite elite teams, professional organizers,
                and unforgettable competitive experiences.
            </p>
        </div>
    </section>

    {{-- WHO WE ARE --}}
    <section class="bg-grey-50 py-16">
        <div class="max-w-6xl mx-auto px-4 grid grid-cols-1 md:grid-cols-2 gap-10 items-center">

            <div>
                <h2 class="text-3xl font-bold text-purple-700">
                    Who We Are
                </h2>
                <div class="h-1 w-16 bg-purple-600 my-4 rounded"></div>
                <p class="text-gray-800 leading-relaxed">
                    Hoki Arena is a premier venue and competitive platform
                    dedicated to delivering top-tier Hoki tournaments.
                    Our mission is to unite athletes, fans, and organizers
                    under a professional and innovative sports environment.
                    With experienced staff and world-class facilities,
                    we ensure flawless events and unforgettable moments.
                </p>
            </div>

            <div class="relative">
                <img src="{{ asset('img/about-who.png') }}" alt="Who We Are"
                     class="rounded-xl">
            </div>

        </div>
    </section>

    {{-- WHAT WE OFFER --}}
    <section class="bg-gray-100 py-16">
        <div class="max-w-6xl mx-auto px-4 grid grid-cols-1 md:grid-cols-2 gap-10 items-center">

            <div>
                <img src="{{ asset('img/about-who2.png') }}" alt="What We Offer"
                     class="rounded-xl ">
            </div>

            <div>
                <h2 class="text-3xl font-bold text-purple-700">
                    What We Offer
                </h2>
                <div class="h-1 w-16 bg-purple-600 my-4 rounded"></div>
                <p class="text-gray-800 leading-relaxed">
                    We deliver elite-level Hoki tournaments supported by
                    modern facilities, transparent management,
                    and a commitment to competitive excellence.
                    Our events provide a platform for teams to perform,
                    grow, and compete on an international stage.
                </p>
            </div>

        </div>
    </section>

    {{-- FEATURE HIGHLIGHTS --}}
    <section class="bg-white py-20">
        <div class="max-w-6xl mx-auto px-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach([
                ['title' => 'Elite Competition', 'desc' => 'World-class teams and players'],
                ['title' => 'Professional Events', 'desc' => 'Organized & reliable tournaments'],
                ['title' => 'Modern Facilities', 'desc' => 'State-of-the-art arenas'],
                ['title' => 'Global Community', 'desc' => 'Players & fans worldwide'],
            ] as $item)
                <div class="bg-white shadow-lg border-l-4 border-purple-600 rounded-xl p-6 text-center hover:shadow-xl transition">
                    <h3 class="text-lg font-bold text-purple-700 mb-2">{{ $item['title'] }}</h3>
                    <p class="text-gray-700 text-sm">{{ $item['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- IMAGE CALLOUT --}}
    <section class="bg-gray-100 py-20">
        <div class="max-w-5xl mx-auto px-4 grid grid-cols-1 md:grid-cols-2 gap-10 items-center">

            <img src="{{ asset('img/about-who3.png') }}" alt="Hoki Arena"
                 class="rounded-xl shadow-lg">

            <div>
                <h3 class="text-2xl font-bold text-purple-700">
                    A Home for Hoki Excellence
                </h3>
                <p class="mt-4 text-gray-800 leading-relaxed">
                    Hoki Arena exists to elevate the sport by creating
                    a professional, exciting, and inclusive environment
                    for competition. Every event is crafted to deliver
                    unforgettable experiences for players and spectators alike.
                </p>
            </div>

        </div>
    </section>

    {{-- FINAL CALLOUT --}}
    <section class="bg-purple-600 py-16">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-extrabold text-white">
                Experience the Future of Competitive Hoki
            </h2>
            <p class="mt-4 text-purple-100">
                Join us and be part of a growing global sports community.
            </p>
        </div>
    </section>

</x-guest-layout>
