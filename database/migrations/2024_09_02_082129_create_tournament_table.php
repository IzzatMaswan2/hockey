<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTournamentTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('tournament')) {
            Schema::create('tournament', function (Blueprint $table) {
                $table->increments('TournamentID');
                $table->string('Name', 100);
                $table->date('StartDate');
                $table->date('EndDate');
                $table->string('Location', 100)->nullable();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('tournament');
    }
}
