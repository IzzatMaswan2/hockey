<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    use HasFactory;

    public $timestamps = false; // Disable timestamps
        
    protected $fillable = [
        'id',
        'player_id',
        'match_id',
        'scored_goals',
        'penalty_corner',
        'goal_time'
        ];

}
