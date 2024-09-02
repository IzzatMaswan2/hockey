<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('articles')) {
            Schema::create('articles', function (Blueprint $table) {
                $table->increments('article_id');
                $table->string('title');
                $table->text('content');
                $table->unsignedInteger('author_id')->nullable();
                $table->timestamps();
                $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
    
                // Foreign key constraints
                $table->foreign('author_id')->references('id')->on('users')->onDelete('set null');
            });
        }
        
    }

    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
