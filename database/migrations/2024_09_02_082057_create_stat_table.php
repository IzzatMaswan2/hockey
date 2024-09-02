<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('stat')) {
            Schema::create('stat', function (Blueprint $table) {
                $table->increments('StatID');
                $table->string('Type', 20);
                $table->string('Description', 50);
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('stat');
    }
}
