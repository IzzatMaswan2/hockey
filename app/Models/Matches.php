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
        'id',
        'team1_id', 
        'team2_id', 
        'category_id',
        'date',
        'match_status',
        'knockout',
        'stage',
        'side',
        'side2',
        'start_time', 
        'end_time',
        'venue_id',
        'group_id',
        'tournament_id',
        'score1',
        'score2',
        'scoring_refereeID',
        'timing_refereeID',
        'approval_count',
        'both_approved',
        'error'
    ];

    public function team1()
    {
        return $this->belongsTo(Team::class, 'team1_id', 'teamID'); 
    }

    public function team2()
    {
        return $this->belongsTo(Team::class, 'team2_id', 'teamID'); 
    }

    public function groupcreate()
    {
        return $this->belongsTo(GroupCreate::class, 'group_id', 'GroupID');
    }

    public function venue()
    {
        return $this->belongsTo(Venue::class, 'venue_id', 'id');
    }

    public function scoringReferee()
    {
        return $this->belongsTo(Referee::class, 'scoring_refereeID', 'id');
    }

    public function timingReferee()
    {
        return $this->belongsTo(Referee::class, 'timing_refereeID', 'id');
    }

    public function approvals()
    {
        return $this->hasMany(Approval::class, 'match_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(TournamentCategory::class, 'category_id');
    }
}
