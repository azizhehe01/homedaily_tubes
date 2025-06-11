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
        Schema::create('live_chat_massages', function (Blueprint $table) {
            $table->id('message_id');
            $table->foreignId('from_user_id')->constraint('users', 'user_id');
            $table->foreignId('to_user_id')->constraint('users', 'user_id');
            $table->text('message');
            $table->enum('message_type', ['text', 'image', 'file']);
            $table->enum('status', ['sent', 'delivered', 'read']);
            $table->dateTime('sent_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('live_chat_massages');
    }
};
