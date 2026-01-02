<x-guest-layout>

    {{-- HERO --}}
    <section class="relative bg-gray-600">
        <div class="absolute inset-0">
            <img src="{{ asset('img/contact.png') }}" alt="Contact"
                 class="w-full h-full object-cover opacity-30">
            <div class="absolute inset-0 bg-gray-600/70"></div>
        </div>

        <div class="relative max-w-5xl mx-auto px-4 py-24 text-center">
            <h1 class="text-4xl sm:text-5xl font-extrabold text-white">
                Contact Us
            </h1>
            <p class="mt-4 text-lg text-purple-100">
                Need help with something? We’re here for you.
            </p>

            <button
                onclick="document.getElementById('message').scrollIntoView({behavior:'smooth'})"
                class="mt-8 inline-flex items-center justify-center rounded-lg bg-white text-purple-700 px-8 py-3 font-semibold hover:bg-green-50 transition"
            >
                Contact Us
            </button>
        </div>
    </section>

    {{-- CONTACT INFO --}}
    <section class="bg-gray-50 py-20">
        <div class="max-w-6xl mx-auto px-4">

            <div class="text-center mb-14">
                <h2 class="text-3xl font-bold text-purple-700">
                    Contact Information
                </h2>
                <p class="mt-2 text-purple-800">
                    Know more about us
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                {{-- PHONE --}}
                <div class="bg-white border border-purple-200 rounded-xl p-8 text-center shadow-sm hover:shadow-md transition">
                    <div class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-full bg-green-600/10">
                        <i class="bi bi-telephone-fill text-2xl text-purple-600"></i>
                    </div>

                    <h3 class="text-lg font-bold text-purple-700 mb-2">
                        Our Number
                    </h3>

                    @foreach($phones as $phone)
                        <p class="text-purple-800">{{ $phone }}</p>
                    @endforeach

                    <button
                        onclick="copyToClipboard('{{ $phone }}')"
                        class="mt-4 text-sm font-medium text-purple-600 hover:text-purple-500"
                    >
                        Copy Number
                    </button>
                </div>

                {{-- LOCATION --}}
                <div class="bg-white border border-purple-200 rounded-xl p-8 text-center shadow-sm hover:shadow-md transition">
                    <div class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-full bg-purple-600/10">
                        <i class="bi bi-geo-alt-fill text-2xl text-purple-600"></i>
                    </div>

                    <h3 class="text-lg font-bold text-purple-700 mb-2">
                        Our Location
                    </h3>

                    <p class="text-purple-800 text-sm leading-relaxed">
                        {{ $contact->location }}
                    </p>

                    <button
                        onclick="openLocation()"
                        class="mt-4 text-sm font-medium text-purple-600 hover:text-purple-500"
                    >
                        Open in Google Maps
                    </button>
                </div>

                {{-- EMAIL --}}
                <div class="bg-white border border-purple-200 rounded-xl p-8 text-center shadow-sm hover:shadow-md transition">
                    <div class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-full bg-purple-600/10">
                        <i class="bi bi-envelope-fill text-2xl text-purple-600"></i>
                    </div>

                    <h3 class="text-lg font-bold text-purple-700 mb-2">
                        Our Email
                    </h3>

                    @foreach($emails as $email)
                        <p class="text-purple-800">{{ $email }}</p>
                    @endforeach

                    <button
                        onclick="copyToClipboard('{{ $email }}')"
                        class="mt-4 text-sm font-medium text-purple-600 hover:text-purple-500"
                    >
                        Copy Email
                    </button>
                </div>

            </div>
        </div>
    </section>

    {{-- MESSAGE FORM --}}
    <section id="message" class="bg-purple-100 py-20">
        <div class="max-w-4xl mx-auto px-4">

            <div class="text-center mb-12">
                <p class="text-sm uppercase tracking-widest text-purple-600">
                    Have a question?
                </p>
                <h2 class="text-3xl font-extrabold text-purple-700 mt-2">
                    Drop Us a Message
                </h2>
            </div>

            <form
                action="{{ route('contact.store') }}"
                method="POST"
                class="bg-white border border-purple-200 rounded-xl p-8 space-y-6 shadow-sm"
            >
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <input type="text" name="name" placeholder="Name" value="{{ old('name') }}" required
                           class="w-full rounded-lg border border-purple-300 px-4 py-3 text-purple-900 placeholder-purple-500 focus:border-green-600 focus:ring-green-500">

                    <input type="text" name="phone" placeholder="Phone Number" value="{{ old('phone') }}" required
                           class="w-full rounded-lg border border-purple-300 px-4 py-3 text-purple-900 placeholder-purple-500 focus:border-green-600 focus:ring-green-500">

                    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required
                           class="w-full rounded-lg border border-purple-300 px-4 py-3 text-purple-900 placeholder-purple-500 focus:border-green-600 focus:ring-green-500">
                </div>

                <textarea name="subject" rows="6" placeholder="Your message..." required
                          class="w-full rounded-lg border border-purple-300 px-4 py-3 text-purple-900 placeholder-purple-500 focus:border-green-600 focus:ring-green-500">{{ old('subject') }}</textarea>

                <button type="submit"
                        class="w-full rounded-lg bg-purple-600 py-3 font-semibold text-white hover:bg-purple-500 transition">
                    Send Message
                </button>
            </form>

        </div>
    </section>

    {{-- SIMPLE JS --}}
    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                alert('Copied: ' + text);
            });
        }

        function openLocation() {
            window.open(
                'https://www.google.com/maps/place/Stadium+Hoki+Tun+Razak',
                '_blank'
            );
        }
    </script>

</x-guest-layout>
