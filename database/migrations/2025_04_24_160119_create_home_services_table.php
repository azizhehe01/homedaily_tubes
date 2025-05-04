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
        Schema::create('home_services', function (Blueprint $table) {
            $table->id('service_id');
            $table->unsignedBigInteger('user_id');
            $table->dateTime('schedule');
            $table->text('address');
            $table->enum('status', ['pending', 'processing', 'completed', 'canceled']);

            $table->timestamps();

            // pendefiniian foreignkey
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_services');
    }
};
