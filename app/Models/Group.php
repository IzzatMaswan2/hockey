<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $table = 'group';
    protected $primaryKey = 'GroupID';
    public $timestamps = false; // Set to true if timestamps are used
    protected $fillable = [
        'TournamentID', 
        'Name', 
        'group_id',
        'team_id', 
        'played',
        'wins',
        'draws',
        'loses',
        'gf',
        'ga',
        'gd',
        'points',
        'so_bonus',
        'Description'
    ];

    public function tournament()
    {
        return $this->belongsTo(Tournament::class, 'TournamentID', 'TournamentID');
    }

    public function matchGroups()
    {
        return $this->hasMany(MatchGroup::class, 'GroupID', 'GroupID');
    }

    public function fixtures()
    {
        return $this->hasMany(Fixture::class, 'group_id');
    }

    public function tournaments()
    {
        return $this->belongsTo(Tournament::class);
    }

    // Define the relationship with Team
    public function team()
    {
        return $this->belongsTo(Team::class);
    }

        public function teams()
    {
        return $this->belongsToMany(Team::class);
    }
}
