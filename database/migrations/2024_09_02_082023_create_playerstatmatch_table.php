<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayerstatmatchTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('playerstatmatch')) {
            Schema::create('playerstatmatch', function (Blueprint $table) {
                $table->increments('PlayerStatMatchID');
                $table->unsignedInteger('PlayerID');
                $table->unsignedInteger('Match_groupID');
                $table->time('Time')->nullable();
                $table->unsignedInteger('StatID');
                $table->string('Reason', 100)->nullable();
                $table->integer('Score')->default(0);
    
                $table->foreign('PlayerID')->references('PlayerID')->on('player');
                $table->foreign('Match_groupID')->references('Match_groupID')->on('match_group');
                $table->foreign('StatID')->references('StatID')->on('stat');
            });
        }
        }

    public function down()
    {
        Schema::dropIfExists('playerstatmatch');
    }
}
