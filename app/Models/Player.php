<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $table = 'players';
    protected $primaryKey = 'PlayerID';
    public $timestamps = false; // Set to true if timestamps are used
    protected $fillable = [
        'Name',
        'fullName',
        'contact',
        'jerseyNumber', 
        'TeamID', 
        'field_status', 
        'Position', 
        'Birthdate', 
        'Nationality'
    ];

    public function team()
    {
        return $this->belongsTo(Team::class, 'TeamID', 'TeamID');
    }

    public function playerStatMatches()
    {
        return $this->hasMany(PlayerStatMatch::class, 'PlayerID', 'PlayerID');
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class);
    }
}
