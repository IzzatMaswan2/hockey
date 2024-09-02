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
    protected $fillable = ['TournamentID', 'Name', 'Description'];

    public function tournament()
    {
        return $this->belongsTo(Tournament::class, 'TournamentID', 'TournamentID');
    }

    public function matchGroups()
    {
        return $this->hasMany(MatchGroup::class, 'GroupID', 'GroupID');
    }
}
