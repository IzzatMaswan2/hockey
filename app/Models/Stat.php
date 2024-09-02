<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    use HasFactory;

    protected $table = 'stat';
    protected $primaryKey = 'StatID';
    public $timestamps = false; // Set to true if timestamps are used
    protected $fillable = ['Type', 'Description'];

    public function playerStatMatches()
    {
        return $this->hasMany(PlayerStatMatch::class, 'StatID', 'StatID');
    }
}
