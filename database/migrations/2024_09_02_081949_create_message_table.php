<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('message')) {
            Schema::create('message', function (Blueprint $table) {
                $table->increments('message_id');
                $table->string('name', 50);
                $table->string('phone_number', 12);
                $table->string('email', 50);
                $table->text('message');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('message');
    }
}
