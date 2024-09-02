<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('countries')) {
            Schema::create('countries', function (Blueprint $table) {
                $table->increments('country_id');
                $table->string('country_name', 100);
                $table->string('country_code', 2);
                $table->unique('country_code');
            });
        }
        
    }

    public function down()
    {
        Schema::dropIfExists('countries');
    }
}
