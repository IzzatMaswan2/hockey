<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referee extends Model
{
    use HasFactory;

    protected $table = 'referees';
    protected $primaryKey = 'id';
    public $timestamps = false; // Set to true if timestamps are used
    protected $fillable = ['Name', 'Role'];

    public function scoringMatches()
    {
        return $this->hasMany(MatchGroup::class, 'ScoringJudgeID', 'id');
    }

    public function timingMatches()
    {
        return $this->hasMany(MatchGroup::class, 'TimingJudgeID', 'id');
    }
}

