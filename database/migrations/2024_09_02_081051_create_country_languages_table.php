<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountryLanguagesTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('country_languages')) {
            Schema::create('country_languages', function (Blueprint $table) {
                $table->increments('country_language_id');
                $table->unsignedInteger('country_id')->nullable();
                $table->unsignedInteger('language_id')->nullable();
                
                $table->foreign('country_id')->references('country_id')->on('countries')->onDelete('set null');
                $table->foreign('language_id')->references('language_id')->on('languages')->onDelete('set null');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('country_languages');
    }
}
