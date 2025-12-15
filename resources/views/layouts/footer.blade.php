{{-- resources/views/components/footer.blade.php --}}
<footer class="w-full bg-gradient-to-r from-purple-900 to-black text-white text-sm md:text-base">
    {{-- Desktop Footer --}}
    <div class="hidden md:flex flex-wrap justify-between px-10 py-12">
        {{-- Logo --}}
        <div class="flex flex-col items-center md:items-start mb-6 md:mb-0">
            <img src="{{ asset('img/Logo Latest 1.png') }}" alt="Hoki Arena" class="w-30 h-24 mb-4">
        </div>

        {{-- Description --}}
        <div class="flex flex-col mb-6 md:mb-0">
            <h3 class="text-white font-bold text-lg mb-2 text-center md:text-left">Description</h3>
            <p class="text-white font-serif text-base">{{ $footer->tagline }}</p>
        </div>

        {{-- Useful Links --}}
        <div class="flex flex-col mb-6 md:mb-0">
            <h3 class="text-white font-bold text-lg mb-2 text-center md:text-left">Useful Links</h3>
            <ul class="space-y-1 font-serif">
                <li><a href="/" class="hover:underline">Home</a></li>
                <li><a href="/tournamentlist" class="hover:underline">Tournament</a></li>
                <li><a href="/forum" class="hover:underline">Forum</a></li>
                <li><a href="/about" class="hover:underline">About</a></li>
            </ul>
        </div>

        {{-- Contact Info --}}
        <div class="flex flex-col mb-6 md:mb-0">
            <h3 class="text-white font-bold text-lg mb-2 text-center md:text-left">Contact Info</h3>
            <ul class="space-y-1">
                <li>
                    <a href="javascript:void(0)" onclick="copyToClipboard('{{ $footer->phone }}')" class="flex items-center hover:underline">
                        <i class="bi bi-telephone-fill mr-2"></i>{{ $footer->phone }}
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)" onclick="copyToClipboard('{{ $footer->email }}')" class="flex items-center hover:underline">
                        <i class="bi bi-envelope-fill mr-2"></i>{{ $footer->email }}
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center hover:underline">
                        <i class="bi bi-geo-alt-fill mr-2"></i>{{ $footer->address }}
                    </a>
                </li>
            </ul>
        </div>

        {{-- Social Links --}}
        <div class="flex flex-col mb-6 md:mb-0">
            <h3 class="text-white font-bold text-lg mb-2 text-center md:text-left">Social Network</h3>
            <div class="flex space-x-4">
                <a href="#" class="hover:text-purple-300"><i class="bi bi-facebook"></i></a>
                <a href="#" class="hover:text-purple-300"><i class="bi bi-twitter"></i></a>
                <a href="#" class="hover:text-purple-300"><i class="bi bi-instagram"></i></a>
                <a href="#" class="hover:text-purple-300"><i class="bi bi-youtube"></i></a>
                <a href="#" class="hover:text-purple-300"><i class="bi bi-tiktok"></i></a>
            </div>
        </div>
    </div>

    {{-- Mobile Footer --}}
    <div class="md:hidden flex flex-col px-6 py-6 space-y-6">
        <div class="flex items-center mb-4">
            <img src="{{ asset('img/Logo Latest 1.png') }}" alt="Hoki Arena" class="w-30 h-24 mr-4">
            <p class="text-white font-serif">{{ $footer->tagline }}</p>
        </div>

        <div class="flex flex-wrap justify-between gap-4">
            <div class="w-1/2">
                <h3 class="text-white font-bold mb-2">Useful Links</h3>
                <ul class="space-y-1">
                    <li><a href="/" class="hover:underline">Home</a></li>
                    <li><a href="/tournamentlist" class="hover:underline">Tournament</a></li>
                    <li><a href="/forum" class="hover:underline">Forum</a></li>
                    <li><a href="/about" class="hover:underline">About</a></li>
                </ul>
            </div>

            <div class="w-1/2">
                <h3 class="text-white font-bold mb-2">Contact Info</h3>
                <ul class="space-y-1 justify-right">
                    <li><a href="javascript:void(0)" onclick="copyToClipboard('{{ $footer->phone }}')" class="flex items-center hover:underline"><i class="bi bi-telephone-fill mr-2"></i>{{ $footer->phone }}</a></li>
                    <li><a href="javascript:void(0)" onclick="copyToClipboard('{{ $footer->email }}')" class="flex items-center hover:underline"><i class="bi bi-envelope-fill mr-2"></i>{{ $footer->email }}</a></li>
                    <li><a href="#" class="flex items-center hover:underline"><i class="bi bi-geo-alt-fill mr-2"></i>{{ $footer->address }}</a></li>
                </ul>
            </div>
        </div>

        <div class="flex justify-around">
            <a href="#" class="hover:text-purple-300"><i class="bi bi-facebook"></i></a>
            <a href="#" class="hover:text-purple-300"><i class="bi bi-twitter"></i></a>
            <a href="#" class="hover:text-purple-300"><i class="bi bi-instagram"></i></a>
            <a href="#" class="hover:text-purple-300"><i class="bi bi-youtube"></i></a>
            <a href="#" class="hover:text-purple-300"><i class="bi bi-tiktok"></i></a>
        </div>
    </div>

    {{-- Footer Bottom --}}
    {{-- Footer Bottom --}}
    <div x-data="{ privacyOpen: false, termsOpen: false }" class="border-t border-gray-600 mt-8 pt-4 px-6 flex flex-col md:flex-row justify-between text-gray-300 text-sm">
        <p>&copy; 2024, Inc. All rights reserved.</p>

        <div class="flex space-x-4 mt-2 md:mt-0">
            <button @click="privacyOpen = true" class="text-gray-300 hover:text-purple-300 underline">Privacy Policy</button>
            <button @click="termsOpen = true" class="text-gray-300 hover:text-purple-300 underline">Terms & Conditions</button>
        </div>

        <!-- Privacy Policy Modal -->
        <div x-show="privacyOpen" x-transition class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" style="display: none;">
            <div class="bg-gradient-to-r from-purple-900 to-black rounded-xl w-11/12 md:w-2/3 max-h-[90vh] overflow-y-auto p-6 relative">
                <button @click="privacyOpen = false" class="absolute top-4 right-4 text-white text-2xl font-bold hover:text-purple-300">&times;</button>
                <h2 class="text-2xl font-bold text-white mb-4">Privacy Policy</h2>
                <p class="text-white font-serif whitespace-pre-wrap">{{ $footer->privacy }}</p>
            </div>
        </div>

        <!-- Terms & Conditions Modal -->
        <div x-show="termsOpen" x-transition class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" style="display: none;">
            <div class="bg-gradient-to-r from-purple-900 to-black rounded-xl w-11/12 md:w-2/3 max-h-[90vh] overflow-y-auto p-6 relative">
                <button @click="termsOpen = false" class="absolute top-4 right-4 text-white text-2xl font-bold hover:text-purple-300">&times;</button>
                <h2 class="text-2xl font-bold text-white mb-4">Terms & Conditions</h2>
                <p class="text-white font-serif whitespace-pre-wrap">{{ $footer->term }}</p>
            </div>
        </div>
    </div>


    {{-- Add this at the bottom of your footer.blade.php --}}

<!-- Modals Wrapper -->
<div x-data="{ privacyOpen: false, termsOpen: false }">

    <!-- Privacy Policy Modal -->
    <div
        x-show="privacyOpen"
        x-transition
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
        style="display: none;"
    >
        <div class="bg-gradient-to-r from-purple-900 to-black rounded-xl w-11/12 md:w-2/3 max-h-[90vh] overflow-y-auto p-6 relative">
            <button
                @click="privacyOpen = false"
                class="absolute top-4 right-4 text-white text-2xl font-bold hover:text-purple-300"
            >&times;</button>
            <h2 class="text-2xl font-bold text-white mb-4">Privacy Policy</h2>
            <p class="text-white font-serif whitespace-pre-wrap">{{ $footer->privacy }}</p>
        </div>
    </div>

    <!-- Terms & Conditions Modal -->
    <div
        x-show="termsOpen"
        x-transition
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
        style="display: none;"
    >
        <div class="bg-gradient-to-r from-purple-900 to-black rounded-xl w-11/12 md:w-2/3 max-h-[90vh] overflow-y-auto p-6 relative">
            <button
                @click="termsOpen = false"
                class="absolute top-4 right-4 text-white text-2xl font-bold hover:text-purple-300"
            >&times;</button>
            <h2 class="text-2xl font-bold text-white mb-4">Terms & Conditions</h2>
            <p class="text-white font-serif whitespace-pre-wrap">{{ $footer->term }}</p>
        </div>
    </div>

    <!-- Trigger Buttons -->
    {{-- <div class="flex space-x-4 mt-4 md:mt-0">
        <button
            @click="privacyOpen = true"
            class="text-gray-300 hover:text-purple-300 underline"
        >Privacy Policy</button>
        <button
            @click="termsOpen = true"
            class="text-gray-300 hover:text-purple-300 underline"
        >Terms & Conditions</button>
    </div> --}}

</div>


</footer>

<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(() => alert(text + ' copied to clipboard!'));
}
</script>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js" defer></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

