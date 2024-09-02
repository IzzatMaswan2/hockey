<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('team')) {
            Schema::create('team', function (Blueprint $table) {
                $table->increments('TeamID');
                $table->string('Name', 100);
                $table->string('country', 50);
                $table->string('LogoURL', 255)->nullable();
                $table->text('Description')->nullable();
                $table->string('CoachName', 100)->nullable();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('team');
    }
}
