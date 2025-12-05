<x-admin-layout :title="'Entrant Detail'">

<div class="tw-container tw-mx-auto tw-px-6 tw-py-8 tw-space-y-10">

    <!-- Header -->
    <div class="tw-text-center">
        <h1 class="tw-text-4xl tw-font-extrabold tw-text-purple-700 tw-mb-2">Entrant Detail</h1>
        <p class="tw-text-gray-600">All information about this entrant and their team lineup</p>
    </div>

    <!-- Tournament Info Cards -->
    <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-3 tw-gap-6">
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
        <div class="tw-bg-gradient-to-r tw-from-purple-100 tw-to-purple-50 tw-shadow-lg tw-rounded-xl tw-p-5 hover:tw-scale-105 tw-transform tw-transition tw-duration-300">
            <h3 class="tw-font-semibold tw-text-purple-700 tw-text-lg tw-mb-2">{{ $card['title'] }}</h3>
            <p class="tw-text-gray-700">{{ $card['value'] }}</p>
        </div>
        @endforeach
    </div>

    <!-- Team Colours -->
    <div class="tw-bg-white tw-shadow-lg tw-rounded-xl tw-p-6">
        <h2 class="tw-text-2xl tw-font-bold tw-text-purple-700 tw-mb-4">Team Colours</h2>
        <div class="tw-flex tw-flex-wrap tw-gap-6">
            @foreach(['shirt', 'short', 'gk_shirt'] as $colorKey)
            <div class="tw-flex tw-items-center tw-gap-2">
                <span class="tw-w-6 tw-h-6 tw-rounded-full tw-border tw-border-gray-300" style="background-color: {{ $teamColors[$colorKey] }}"></span>
                <span class="tw-font-medium tw-text-gray-700 tw-capitalize">{{ str_replace('_', ' ', $colorKey) }}: {{ $teamColors[$colorKey] }}</span>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Player Lineup -->
    <div class="tw-bg-white tw-shadow-lg tw-rounded-xl tw-p-6">
        <h2 class="tw-text-2xl tw-font-bold tw-text-purple-700 tw-mb-6">Player Lineup</h2>

        <div class="tw-grid tw-grid-cols-1 sm:tw-grid-cols-2 md:tw-grid-cols-3 lg:tw-grid-cols-4 tw-gap-6">
            @forelse($participant->team->players as $player)
            <div class="tw-bg-purple-50 tw-rounded-xl tw-shadow-md tw-p-4 tw-flex tw-flex-col tw-items-center hover:tw-scale-105 tw-transition tw-transform tw-duration-300">
                <div class="tw-w-16 tw-h-16 tw-bg-purple-200 tw-rounded-full tw-flex tw-items-center tw-justify-center tw-text-white tw-font-bold tw-text-xl tw-mb-3">
                    {{ $player->jerseyNumber ?? '-' }}
                </div>
                <p class="tw-text-gray-800 tw-font-semibold tw-text-center">{{ $player->name ?? $player->displayName ?? '-' }}</p>
                <p class="tw-text-gray-500 tw-text-sm tw-mt-1">Match Player: Yes</p>
            </div>
            @empty
            <p class="tw-text-gray-500 tw-col-span-full tw-text-center">No players found</p>
            @endforelse
        </div>
    </div>

    <!-- Export PDF Button -->
    <a style="margin-top: 10px; display: inline-block; align-self: right;" href="{{ route('pdf.teamlineup', $participant->id) }}">
        <button id="exportBtn"
            class="tw-bg-purple-600 tw-text-white tw-px-6 tw-py-3 tw-rounded-xl tw-font-semibold hover:tw-bg-purple-700 tw-transition-colors">
            Export PDF
        </button>
    </a>


</div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
    document.getElementById('exportBtn').addEventListener('click', () => {
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

</x-admin-layout>
