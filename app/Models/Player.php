<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $table = 'players';
    protected $primaryKey = 'id';
    public $timestamps = false; // Set to true if timestamps are used
    protected $fillable = [
        'user_id',        // Foreign key referencing the users table
        'name',
        'displayName',
        'contact',
        'jerseyNumber',
        'position',
        'formationPosition',
        'dob',
        'field_status',
        'email',
        'teamID',
        'manager_id',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'teamID', 'teamID');
    }

    public function playerStatMatches()
    {
        return $this->hasMany(PlayerStatMatch::class, 'PlayerID', 'PlayerID');
    }

    public function formations()
    {
        return $this->belongsToMany(Formation::class);
    }
}
