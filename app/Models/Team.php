<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Team extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'teams'; // Use the name of your existing table

    // Specify the primary key if it's not the default 'id'
    protected $primaryKey = 'teamID'; // Adjust if your primary key is different

    // If the table does not use timestamps, set this to false
    public $timestamps = false; // Set to false if your table does not have created_at and updated_at columns

    // Specify the fillable attributes
    protected $fillable = [
        'Name', 
        'contact',
        'country',
        'LogoURL', 
        'Description', 
        'CoachName',
        'total_player',
    ]; 
    // Adjust the fillable attributes based on your table columns

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
}
