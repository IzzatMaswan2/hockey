<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerStatMatch extends Model
{
    use HasFactory;

    protected $table = 'playerstatmatch';
    protected $primaryKey = 'PlayerStatMatchID';
    public $timestamps = false; // Set to true if timestamps are used
    protected $fillable = ['PlayerID', 'Match_groupID', 'Time', 'StatID', 'Reason', 'Score'];

    public function player()
    {
        return $this->belongsTo(Player::class, 'PlayerID', 'PlayerID');
    }

    public function matchGroup()
    {
        return $this->belongsTo(MatchGroup::class, 'Match_groupID', 'Match_groupID');
    }

    public function stat()
    {
        return $this->belongsTo(Stat::class, 'StatID', 'StatID');
    }
}

