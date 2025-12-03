<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class MatchGroup extends Model
{
    use  HasFactory;


    protected $table = 'match_group';
    protected $primaryKey = 'Match_groupID';
    public $timestamps = false; 
    protected $fillable = [
        'TournamentID', 
        'category_id',
        'TeamAID', 
        'TeamBID', 
        'GroupID',
        'match_status', 
        'Date', 
        'start_time',
        'end_time',
        'Category', 
        'ScoreA',
        'ScoreB', 
        'Venue', 
        'ScoringRefereeID', 
        'TimingRefereeID',
        'approval_count',
        'both_approved',
        'error'
    ];

    public function tournament()
    {
        return $this->belongsTo(Tournament::class, 'TournamentID', 'id');
    }
    public function teamA()
    {
        return $this->belongsTo(Team::class, 'TeamAID', 'teamID');
    }

    public function teamB()
    {
        return $this->belongsTo(Team::class, 'TeamBID', 'teamID');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'GroupID', 'GroupID');
    }

    public function scoringReferee()
    {
        return $this->belongsTo(Referee::class, 'ScoringRefereeID', 'id');
    }

    public function timingReferee()
    {
        return $this->belongsTo(Referee::class, 'TimingRefereeID', 'id');
    }

    public function approvals()
    {
        return $this->hasMany(Approval::class, 'Match_groupID', 'Match_groupID');
    }

    public function category()
    {
        return $this->belongsTo(TournamentCategory::class, 'category_id', 'id');
    }

    public function groupcreate()
    {
        return $this->belongsTo(GroupCreate::class, 'GroupID', 'GroupID');
    }
}
