<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchGroupTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('match_group')) {
            Schema::create('match_group', function (Blueprint $table) {
                $table->increments('Match_groupID');
                $table->unsignedInteger('TournamentID');
                $table->unsignedInteger('TeamAID');
                $table->unsignedInteger('TeamBID');
                $table->unsignedInteger('GroupID')->nullable();
                $table->tinyInteger('match_status')->default(0);
                $table->dateTime('Date');
                $table->string('Category', 50);
                $table->integer('ScoreA')->default(0);
                $table->integer('ScoreB')->default(0);
                $table->string('Venue', 255);
                $table->unsignedInteger('ScoringJudgeID')->nullable();
                $table->unsignedInteger('TimingJudgeID')->nullable();
    
                $table->foreign('GroupID')->references('GroupID')->on('group')->onDelete('set null');
                $table->foreign('TeamAID')->references('teamID')->on('team');
                $table->foreign('TeamBID')->references('teamID')->on('team');
                $table->foreign('ScoringJudgeID')->references('JudgeID')->on('judge')->onDelete('set null');
                $table->foreign('TimingJudgeID')->references('JudgeID')->on('judge')->onDelete('set null');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('match_group');
    }
}
