<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    use HasFactory;

    protected $table = 'manager';  // Specify the table name if it's not 'results'
    
    protected $fillable = [
        'id', 
        'name',
        'team_id',
        'age', 
        'state'
    ];
}
