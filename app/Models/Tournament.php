<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    use HasFactory;

    protected $table = 'tournament';
    protected $primaryKey = 'TournamentID';
    public $timestamps = false; // Set to true if timestamps are used
    protected $fillable = ['Name', 'StartDate', 'EndDate', 'Location'];

    public function groups()
    {
        return $this->hasMany(Group::class, 'TournamentID', 'TournamentID');
    }

    public function matchGroups()
    {
        return $this->hasMany(MatchGroup::class, 'TournamentID', 'TournamentID');
    }
}
