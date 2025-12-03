<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'group';

    public $timestamps = false;


    // Define the fillable attributes
    protected $fillable = [
            'tournament_id', 
            'groupcreateID',
            'teamID', 
            'category_id',
            'played',
            'wins',
            'draws',
            'loses',
            'gf',
            'ga',
            'gd',
            'points',
            'so_bonus'
         // Add other fields as necessary
    ];

    // Define the relationship with the Fixture model
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
        return $this->belongsTo(Team::class, 'teamID');
    }

    public function groupcreate()
    {
        return $this->belongsTo(GroupCreate::class, 'groupcreateID', 'GroupID');
    }

    public function category()
    {
        return $this->belongsTo(TournamentCategory::class, 'category_id');
    }
    

    
}
