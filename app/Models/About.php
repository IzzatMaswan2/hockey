<?php

// app/Models/Article.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;
    protected $primaryKey = 'about_id';
    public $timestamps = false;
    protected $fillable = [
        'banner',
        'we_are',
        'we_offer'
    ];
}

