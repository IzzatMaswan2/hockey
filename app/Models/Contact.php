<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contact';
    protected $primaryKey = 'contact_id';
    public $timestamps = false;

    protected $fillable = ['location'];

    public function phoneNumbers()
    {
        return $this->hasMany(ContactPhoneNumber::class, 'contact_id', 'contact_id');
    }

    public function emails()
    {
        return $this->hasMany(ContactEmail::class, 'contact_id', 'contact_id');
    }
}

