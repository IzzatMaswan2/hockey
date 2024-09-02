<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('group')) {
            Schema::create('group', function (Blueprint $table) {
                $table->increments('GroupID');
                $table->unsignedInteger('TournamentID');
                $table->string('Name', 50);
                $table->text('Description')->nullable();
    
                $table->foreign('TournamentID')->references('TournamentID')->on('tournament');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('group');
    }
}
