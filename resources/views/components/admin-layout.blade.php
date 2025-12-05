<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Dashboard' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    @vite('resources/css/app.css')
    {{-- <script src="https://kit.fontawesome.com/771de58f02.js" crossorigin="anonymous"></script> --}}
    @stack('head')
</head>
<body>
    <div class="tw-slot">
        @include('layouts.navbar')
    </div>
    

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-2 bg-secondary">
                @include('layouts.sidebar')
            </div>

            <!-- Main Content -->
            <div class="col-10">
                <div class="tw-slot tw-p-6 tw-bg-gray-100">
                    {{ $slot }}
                </div>
            </div>


        </div>
    </div>

    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @stack('scripts')
</body>
</html>
