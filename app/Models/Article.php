<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $table = 'articles'; // specify the table name if it's different from the plural of the model name

    protected $fillable = [
        'title',
        'image',
        'place',
        'content',
        'summary',
        'date_news',
        'author_id',
        'status',
    ];

}
