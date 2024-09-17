<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;
    // Specify the table name
    protected $table = 'faqs';

    // Define the fillable fields for mass assignment
    protected $fillable = ['question', 'answer'];
}