<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cards extends Model
{
    use HasFactory;

    
    
    // Define the attributes that are mass assignable
    protected $fillable = ['card_type', 'count'];
}
