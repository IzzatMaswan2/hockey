<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tournaments</title>
    <link href="{{ asset('css/tournamentlist.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
</head>
<body>
@include('components.side-nav')
@include('profile.partials.navbar')

    <div class="content">

        <div class="container1">
            <h1>Tournaments List</h1>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="tournament-list">
                @foreach($tournaments as $tournament)
                <a href="{{ route('tournamentlist.details', ['id' => $tournament->id]) }}" class="tournament-card tournament-button2">
                    <div class="tournament-image-column">
                        <img src="{{ asset('storage/' . $tournament->image) }}" alt="{{ $tournament->name }}" class="tournament-image">
                    </div>
                    <div class="tournament-info">
                        <h2 style="">{{ $tournament->name }}</h2>
                        <p><strong>{{ $tournament->description }}</strong></p>
                    </div>
                </a>
                @endforeach
            </div>


        </div>
    </div>
 @include('profile.partials.footer')
</body>


