<x-admin-layout :title="'Entrant Detail'">
    @include('layouts.sidebar')

    <div class="container-fluid py-5">

        <!-- Header -->
        <div class="text-center mb-5">
            <h1 class="display-4 text-purple-700 fw-bold">Entrant Detail</h1>
            <p class="text-muted">All information about this entrant and their team lineup</p>
        </div>

        <!-- Tournament Info Cards -->
        <div class="row g-4 mb-5">
            @php
                $infoCards = [
                    ['title' => 'Tournament Name', 'value' => $participant->tournament->name ?? '-'],
                    ['title' => 'Category', 'value' => $participant->category->name ?? '-'],
                    ['title' => 'Venue', 'value' => $participant->tournament->venue->name ?? '-'],
                    ['title' => 'Dates', 'value' => ($participant->tournament->start_date ?? '-') . ' - ' . ($participant->tournament->end_date ?? '-')],
                    ['title' => 'Group', 'value' => $participant->group_name ?? '-'],
                    ['title' => 'Description', 'value' => $participant->tournament->description ?? '-'],
                ];
            @endphp

            @foreach($infoCards as $card)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-sm h-100 border-0 rounded-3">
                    <div class="card-body">
                        <h5 class="card-title text-purple-700 fw-semibold">{{ $card['title'] }}</h5>
                        <p class="card-text text-muted">{{ $card['value'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Team Colours -->
        <div class="card mb-5 shadow-sm rounded-3">
            <div class="card-body">
                <h2 class="h4 text-purple-700 fw-bold mb-4">Team Colours</h2>
                <div class="d-flex flex-wrap gap-3">
                    @foreach(['shirt', 'short', 'gk_shirt'] as $colorKey)
                    <div class="d-flex align-items-center gap-2">
                        <span class="rounded-circle border" style="width:24px; height:24px; background-color: {{ $teamColors[$colorKey] }}"></span>
                        <span class="text-muted text-capitalize">{{ str_replace('_', ' ', $colorKey) }}: {{ $teamColors[$colorKey] }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Player Lineup -->
        <div class="card mb-5 shadow-sm rounded-3">
            <div class="card-body">
                <h2 class="h4 text-purple-700 fw-bold mb-4">Player Lineup</h2>
                <div class="row g-4">
                    @forelse($participant->team->players as $player)
                    <div class="col-6 col-sm-4 col-md-3">
                        <div class="card text-center h-100 border-0 shadow-sm rounded-3">
                            <div class="card-body d-flex flex-column align-items-center">
                                <div class="rounded-circle bg-purple-200 text-white fw-bold d-flex justify-content-center align-items-center mb-3"
                                     style="width:60px; height:60px; font-size:1.25rem;">
                                    {{ $player->jerseyNumber ?? '-' }}
                                </div>
                                <p class="fw-semibold mb-1">{{ $player->name ?? $player->displayName ?? '-' }}</p>
                                <p class="text-muted small mb-0">Match Player: Yes</p>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center text-muted">
                        No players found
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Export PDF Button -->
        <div class="mb-5 text-end">
            {{-- <div class=" bg-purple-700 text-white px-4 py-2 rounded-lg inline-block mb-3">
                Generate PDF

            </div> --}}
            <a href="{{ route('pdf.teamlineup', $participant->id) }}" class="bg-purple-700 text-white px-4 py-2 rounded-lg inline-block mb-3">
                Export PDF
            </a>
        </div>

    </div>

    @push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
        document.querySelector('.btn-purple').addEventListener('click', (e) => {
            e.preventDefault();
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF({ orientation: 'portrait', unit: 'mm', format: 'a4' });
            doc.html(document.querySelector('body'), {
                callback: function(doc) {
                    doc.save('participant_detail.pdf');
                },
                x: 10,
                y: 10,
                width: 190,
                windowWidth: document.body.scrollWidth
            });
        });
    </script>
    @endpush

    <style>
        .text-purple-700 { color: #6b21a8 !important; }
        .btn-purple { background-color: #6b21a8; color: white; }
        .btn-purple:hover { background-color: #5a1a90; color: white; }
    </style>

</x-admin-layout>
