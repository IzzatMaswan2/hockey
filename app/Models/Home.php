<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    // Set the table name
    protected $table = 'home';

    // Primary key field
    protected $primaryKey = 'home_id';

    // Indicates if the primary key is auto-incrementing
    public $incrementing = true;

    // Define the fillable fields for mass assignment
    protected $fillable = ['banner_s_header', 'banner_b_header', 'banner_paragraph'];

    // Define the relationship with Achivement
    public function achivements()
    {
        return $this->hasMany(Achivement::class, 'home_id', 'home_id');
    }

    // Define the relationship with MeetTeam
    public function meetTeams()
    {
        return $this->hasMany(MeetTeam::class, 'home_id', 'home_id');
    }
}

