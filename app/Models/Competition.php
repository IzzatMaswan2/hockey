<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    use HasFactory;
    protected $table = 'competitions';
    protected $fillable = ['id','team_id', 'tournament_id', 'category_id'];




    public function tournament()
    {
        return $this->belongsTo(Tournament::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id', 'teamID'); // Ensure these keys match your database
    }
}
