<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    use HasFactory;
    protected $table = 'tournaments';
    protected $fillable = [
                            'id',
                            'name',
                            'no_team',
                            'no_group',
                            'category',
                            'start_date',
                            'end_date',
                            'start_time',
                            'end_time',
                            'venue_id',
                            'regclose_date',
                            'description'
                            ,'image'
                        ];
    
    public function groups()
    {
        return $this->hasMany(Group::class, 'TournamentID', 'TournamentID');
    }
    public function matchGroups()
    {
        return $this->hasMany(MatchGroup::class, 'TournamentID', 'TournamentID');
    }
    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }
    public function teams()
    {
        return $this->belongsToMany(Team::class, 'competitions', 'tournament_id', 'team_id');
    }

    public function categories()
    {
        return $this->hasMany(TournamentCategory::class, 'tournament_id', 'id');
    }
}
