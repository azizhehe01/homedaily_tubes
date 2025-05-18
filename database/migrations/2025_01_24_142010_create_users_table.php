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
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('name', 255);
            $table->string('email', 255)->unique();
            $table->string('password', 255)->nullable()->comment('Password will be null if user signs up with Google');
            $table->string('google_id', 255)->nullable()->comment('Google authentication ID, used when signing in with Google');
            $table->string('phone_number', 15)->nullable();
            $table->text('address')->nullable();
            $table->string('profile_picture', 255)->nullable();
            $table->enum('role', ['user', 'admin','admin_jasa'])->default('user'); //default nya user ya
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
