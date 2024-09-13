<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    // Set the table name
    protected $table = 'achievement';

    // Primary key field
    protected $primaryKey = 'achievement_id';

    // Indicates if the primary key is auto-incrementing
    public $incrementing = false;

    // Define the fillable fields for mass assignment
    protected $fillable = ['title', 'description', 'icon', 'home_id'];

    // Set the key type to integer
    protected $keyType = 'int';

    // Define the relationship with Home
    public function home()
    {
        return $this->belongsTo(Home::class, 'home_id', 'home_id');
    }
}
