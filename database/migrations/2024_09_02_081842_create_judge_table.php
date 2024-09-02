<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJudgeTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('judge')) {
            Schema::create('judge', function (Blueprint $table) {
                $table->increments('JudgeID');
                $table->string('Name');
                $table->string('Role', 50);
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('judge');
    }
}
