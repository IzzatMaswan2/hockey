<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlyFieldTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('ply_field')) {
            Schema::create('ply_field', function (Blueprint $table) {
                $table->increments('ply_fieldID');
                $table->string('name', 50);
                $table->string('description', 255);
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('ply_field');
    }
}
