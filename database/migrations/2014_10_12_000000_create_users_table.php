<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Check if the 'users' table does not exist before creating it
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id(); // Equivalent to auto-incrementing 'id' field
                $table->string('name'); // Field for user's name
                $table->string('email')->unique(); // Field for user's email (must be unique)
                $table->timestamp('email_verified_at')->nullable(); // Nullable field for email verification timestamp
                $table->string('teamName'); // Field for user's team name
                $table->string('country'); // Field for user's country
                $table->string('Img_User'); // Field for user image URL or path
                $table->string('password'); // Field for user's password
                $table->rememberToken(); // Token for password reset
                $table->timestamps(); // Timestamps for created_at and updated_at
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the 'users' table if it exists
        if (Schema::hasTable('users')) {
            Schema::dropIfExists('users');
        }
    }
};
