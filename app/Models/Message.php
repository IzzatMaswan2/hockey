<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $table = 'message';
    public $timestamps = false;
    protected $primaryKey = 'message_id';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = ['name', 'phone_number', 'email', 'message'];
}
