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
        'TeamAID', 
        'TeamBID', 
        'GroupID',
        'match_status', 
        'Date', 
        'Category', 
        'ScoreA',
        'ScoreB', 
        'Venue', 
        'ScoringJudgeID', 
        'TimingJudgeID'
    ];


    public function teamA()
    {
        return $this->belongsTo(Team::class, 'TeamAID', 'TeamID');
    }

    public function teamB()
    {
        return $this->belongsTo(Team::class, 'TeamBID', 'TeamID');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'GroupID', 'GroupID');
    }

    public function scoringJudge()
    {
        return $this->belongsTo(Judge::class, 'ScoringJudgeID', 'JudgeID');
    }

    public function timingJudge()
    {
        return $this->belongsTo(Judge::class, 'TimingJudgeID', 'JudgeID');
    }
}
