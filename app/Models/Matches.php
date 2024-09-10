<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matches extends Model
{    
    use HasFactory;
    // Define the table name if it doesn't follow Laravel's naming convention
    protected $table = 'matches'; // Optional if the table is named 'matches'

    // Specify the fields that are mass assignable
    protected $fillable = [
        'team_a', 
        'team_b', 
        'date',
        'start_time', 
        'end_time',
        'venue',
        'group',
        'scoring_judging',
        'timing_judging',
    ];
}
