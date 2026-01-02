<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Jiwa Hockey' }}</title>

    <!-- Icons -->
    <script src="https://kit.fontawesome.com/771de58f02.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Global CSS / JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Page-specific CSS -->
    {{ $styles ?? '' }}

    <!-- Page-specific CSS -->
    @stack('style')

    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>

<body class="bg-grey-50 min-h-screen flex flex-col">
    {{-- @include('components.side-nav') --}}
    @include('layouts.navbar')

<div class="fixed top-5 right-5 z-50 space-y-2">
    @foreach (['success','error','warning','info'] as $type)
        @if(session($type))
            <div 
                x-data="{ show: true }"
                x-show="show"
                x-init="setTimeout(() => show = false, 3000)"
                class="px-4 py-2 bg-{{ $type === 'success' ? 'green' : ($type === 'error' ? 'red' : ($type === 'warning' ? 'yellow' : 'blue')) }}-500 text-white rounded shadow-md flex justify-between items-center space-x-2"
            >
                <span>{{ session($type) }}</span>
                <button @click="show = false" class="ml-4 text-white font-bold">&times;</button>
            </div>
        @endif
    @endforeach
</div>


    <div class="w-full flex flex-col">
        {{ $slot }}
    </div>


    <!-- Page-specific scripts -->
    {{ $scripts ?? '' }}

    @stack('scripts')


    @include('profile.partials.footer')
</body>
</html>
