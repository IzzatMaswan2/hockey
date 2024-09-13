<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MeetTeam extends Model
{
    // Set the table name
    protected $table = 'meet_team';

    // Primary key field
    protected $primaryKey = 'meet_id';

    // Indicates if the primary key is auto-incrementing
    public $incrementing = false;

    // Define the fillable fields for mass assignment
    protected $fillable = ['name', 'position', 'img', 'link1', 'link2', 'link3', 'icon_link1', 'icon_link2', 'icon_link3', 'home_id'];

    // Set the key type to integer
    protected $keyType = 'int';

    // Define the relationship with Home
    public function home()
    {
        return $this->belongsTo(Home::class, 'home_id', 'home_id');
    }
}
