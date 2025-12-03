<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    use HasFactory;

    protected $table = 'approvals';

    protected $fillable = [
        'Match_groupID',
        'match_id',
        'ScoreA',
        'ScoreB',
        'approval_count',
        'managerA_approved',
        'managerB_approved',
        'both_approved',
    ];

    public function matchGroup()
    {
        return $this->belongsTo(MatchGroup::class, 'Match_groupID', 'Match_groupID');
    }

    public function match()
    {
        return $this->belongsTo(MatchGroup::class, 'match_id', 'id');
    }
}
