{{-- x-layout-admin --}}
{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Panel' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/771de58f02.js" crossorigin="anonymous"></script>
    <script src="//unpkg.com/alpinejs" defer></script> --}}

    {{-- @stack('styles') --}}
{{-- </head>
<body class="bg-gray-100 w-full "> --}}

    {{-- Navbar --}}
    {{-- @include('layouts.navbar') --}}

    {{-- Notification / Alerts --}}
    {{-- <div class="fixed top-5 right-5 z-50 space-y-2">
        @if(session('success'))
            <div class="px-4 py-2 bg-green-500 text-white rounded shadow-md">
                <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="px-4 py-2 bg-red-500 text-white rounded shadow-md">
                <i class="fas fa-times-circle mr-2"></i> {{ session('error') }}
            </div>
        @endif
        @if(session('warning'))
            <div class="px-4 py-2 bg-yellow-500 text-white rounded shadow-md">
                <i class="fas fa-exclamation-triangle mr-2"></i> {{ session('warning') }}
            </div>
        @endif
        @if(session('info'))
            <div class="px-4 py-2 bg-blue-500 text-white rounded shadow-md">
                <i class="fas fa-info-circle mr-2"></i> {{ session('info') }}
            </div>
        @endif
    </div> --}}

    {{-- Main content wrapper --}}
    {{-- <div class="flex flex-1"> --}}
        {{-- Sidebar included separately in pages --}}
        {{-- {{ $slot }}
    </div> --}}

    {{-- @stack('scripts') --}}
{{-- </body>
</html> --}}
