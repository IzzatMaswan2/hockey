<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Team extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'teams'; 
    protected $primaryKey = 'teamID';
    protected $fillable = [
        'name',
        'country',
        'manager_name',
        'manager_id',
        'LogoURL',
        'Description',
        'total_player',
        ];
    
        // Define relationship to the User (Manager)
        public function manager()
        {
            return $this->belongsTo(User::class, 'manager_id');
        }
    
    

    public function players()
    {
        return $this->hasMany(Player::class, 'teamID', 'teamID');
    }

    public function matchGroupsAsTeamA()
    {
        return $this->hasMany(MatchGroup::class, 'TeamAID', 'teamID');
    }

    public function matchGroupsAsTeamB()
    {
        return $this->hasMany(MatchGroup::class, 'TeamBID', 'teamID');
    }

    public function tournament()
{
    return $this->belongsTo(Tournament::class, 'tournament_id');
}

public function competitions()
{
    return $this->hasMany(Competition::class, 'teamID','team_id'); // Adjust according to your foreign key
}


public function tournaments()
{
    return $this->hasManyThrough(Tournament::class, Competition::class, 'team_id', 'id', 'teamID', 'tournament_id');
}


}

