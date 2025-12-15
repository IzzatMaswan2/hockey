<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Panel' }}</title>

    <script src="https://kit.fontawesome.com/771de58f02.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    {{-- <script src="//unpkg.com/alpinejs" defer></script> --}}
    {{-- <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> --}}
    {{-- <script src="https://kit.fontawesome.com/771de58f02.js" crossorigin="anonymous"></script> --}}
    {{-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet"> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/echarts@5.2.2/dist/echarts.min.js"></script> --}}
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

    {{-- @stack('styles')    --}}
    <style>
        [x-cloak] { display: none !important; }

    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    {{-- Navbar --}}
    @include('layouts.navbar')

    {{-- Notification / Alerts --}}
    <div class="fixed top-5 right-5 z-50 space-y-2">
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
    </div>

    {{-- Main content wrapper --}}
    <div class="flex flex-1">
        {{ $slot }}
    </div>

    {{-- @stack('scripts') --}}
    @include('layouts.footer', ['footer' => $footer])

    <script>
        function copyToClipboard(text) {
            const tempInput = document.createElement('input');
            document.body.appendChild(tempInput);
            tempInput.value = text;
            tempInput.select();
            document.execCommand('copy');
            document.body.removeChild(tempInput);
            alert(text + " copied to clipboard!");
        }
    </script>
</body>
</html>
