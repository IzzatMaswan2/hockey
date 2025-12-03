<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    protected $table = 'footer'; 
    protected $primaryKey = 'footer_id';
    public $incrementing = true; 
    protected $fillable = [
        'tagline',
        'phone',
        'email',
        'address',
        'privacy',
        'term',
        'logo',
    ];

    protected $casts = [
        'address' => 'string',
        'privacy' => 'string',
        'term' => 'string',
    ];
}
