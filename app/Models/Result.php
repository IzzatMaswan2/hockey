<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $table = 'result';  // Specify the table name if it's not 'results'
    
    protected $fillable = [
        'team_id', 
        'opponent_team_id',
        'result', 
        'date', 
        'start_time',
        'end_time',
        'venue'
    ];
}
