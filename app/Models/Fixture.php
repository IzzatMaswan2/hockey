<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fixture extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'fixtures';

    public $timestamps = false;

    // Define the fillable attributes
    protected $fillable = [
        'team_id_1',
        'team_id_2',
        'group_id',
        'date',
        'time',
        'score',
        'agreed',
        'match',
    ];

    // Define the relationship with the Team model for team_id_1
    public function team1()
    {
        return $this->belongsTo(Team::class, 'team_id_1');
    }

    // Define the relationship with the Team model for team_id_2
    public function team2()
    {
        return $this->belongsTo(Team::class, 'team_id_2');
    }

    // Define the relationship with the Group model
    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }
}
