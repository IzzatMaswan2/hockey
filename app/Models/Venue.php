<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    use HasFactory;
    protected $table = 'venues';
    public $timestamps = true;
    protected $fillable = [
        'name',         // Name of the venue
        'location',     // Location of the venue
        'no_court',     // Number of courts at the venue
    ];
}
