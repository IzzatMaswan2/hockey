<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Team;
use App\Models\Competition;

class exportTeamPdf extends Controller
{
    public function exportTeamPdf($id)
    {
        $competition = Competition::with(['team.players', 'tournament.venue', 'category'])
            ->findOrFail($id);

        $team = $competition->team;
        $tournament = $competition->tournament;
        $category = $competition->category;
        $players = $team->players;

        $fileName = preg_replace('/[^A-Za-z0-9_\-]/', '_', $team->name) . '_LineUp.pdf';

        $pdf = Pdf::loadView('pdf.teamlineup', [
            'competition' => $competition,
            'team'        => $team,
            'tournament'  => $tournament,
            'category'    => $category,
            'players'     => $players
        ])->setPaper('A4', 'portrait');

        return $pdf->stream($fileName);
    }

}
