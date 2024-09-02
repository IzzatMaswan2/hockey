<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Judge extends Model
{
    use HasFactory;

    protected $table = 'judge';
    protected $primaryKey = 'JudgeID';
    public $timestamps = false; // Set to true if timestamps are used
    protected $fillable = ['Name', 'Role'];

    public function scoringMatches()
    {
        return $this->hasMany(MatchGroup::class, 'ScoringJudgeID', 'JudgeID');
    }

    public function timingMatches()
    {
        return $this->hasMany(MatchGroup::class, 'TimingJudgeID', 'JudgeID');
    }
}
