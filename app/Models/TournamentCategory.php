<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TournamentCategory extends Model
{
    use HasFactory;

    protected $table = 'tournament_category';

    protected $fillable = [
        'tournament_id',
        'name',
        'description',
        'max_teams',
        'number_group',
    ];

    // A category belongs to a tournament
    public function tournament()
    {
        return $this->belongsTo(Tournament::class, 'tournament_id');
    }

    // A category has many registered teams
    public function competition()
    {
        return $this->hasMany(Competition::class, 'category_id');
    }

    // A category has many group stages
    public function groups()
    {
        return $this->hasMany(GroupCreate::class, 'category_id');
    }

    // A category has many matches (combined group + knockout)
    public function matches()
    {
        return $this->hasMany(Matches::class, 'category_id');
    }
}
