<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactPhoneNumber extends Model
{
    use HasFactory;
    protected $table = 'contactphone';
    protected $primaryKey = 'phone_id'; // Primary key
    public $timestamps = false;
    protected $fillable = ['contact_id', 'phone_number'];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
