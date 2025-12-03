<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    // Define the table name if it's not the default pluralized version
    protected $table = 'matches';

    // Define the columns that can be mass-assigned
    protected $fillable = [
        'team1_name',
        'team2_name',
        'date',
        'start_time',
        'end_time',
        'group',
        'venue',
        'tournament_id',
        'scoring_judge',
        'timing_judge',
        'team1_score', // Additional column for scores
        'team2_score', // Additional column for scores
        'scoring_player_a', // Additional column for player names
        'scoring_player_b', // Additional column for player names
    ];

    // Example relationship if a game belongs to a tournament
    public function tournament()
    {
        return $this->belongsTo(Tournament::class);
    }
}