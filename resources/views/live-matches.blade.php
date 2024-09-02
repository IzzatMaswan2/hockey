<!-- resources/views/live-matches.blade.php -->
{{-- 
@extends('components.layout')

@section('content')
<div id="LIVE" class="scheduletabcontent mtabcontent">
    @foreach ($liveMatches as $match)
        <div class="matchtab">
            <div class="tabm">
                <img src="{{ $match->teamA->LogoURL }}" alt="Team A Logo" class="teamlogo left">
                <div class="matchcontent">
                    <h3>{{ $match->teamA->Name }}</h3>
                    <div class="livescore">{{ $match->ScoreA }}</div>
                </div>
            </div>

            <div class="vs-container">
                <div class="vs">vs</div>
                <div class="timer">48:00 minutes</div> <!-- Update timer dynamically if needed -->
                <a href="/livematch" class="lineup-button">Live Score</a>
            </div>

            <div class="tabm">
                <div class="matchcontent">
                    <h3>{{ $match->teamB->Name }}</h3>
                    <div class="livescore">{{ $match->ScoreB }}</div>
                </div>
                <img src="{{ $match->teamB->LogoURL }}" alt="Team B Logo" class="teamlogo right">
            </div>
        </div>
    @endforeach
</div>
@endsection --}}
