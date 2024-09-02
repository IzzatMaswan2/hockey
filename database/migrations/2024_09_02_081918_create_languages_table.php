<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLanguagesTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('languages')) {
            Schema::create('languages', function (Blueprint $table) {
                $table->increments('language_id');
                $table->string('language_name', 100);
                $table->string('language_code', 2);
                $table->unique('language_code');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('languages');
    }
}
