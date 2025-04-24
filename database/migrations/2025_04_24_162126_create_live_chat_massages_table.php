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
            $table->unsignedBigInteger('session_id');
            $table->unsignedBigInteger('sender_id');
            $table->unsignedBigInteger('receiver_id')->nullable();
            $table->text('message_content');
            $table->enum('message_type', ['text', 'image', 'file']);
            $table->enum('status', ['sent', 'delivered', 'read']); 
            $table->dateTime('sent_at');
            $table->timestamps();

            // dah  males gua  nulis nya pahamin sendiri aja
            $table->foreign('session_id')->references('session_id')->on('live_chat_sessions')->onDelete('cascade');
            $table->foreign('sender_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('receiver_id')->references('user_id')->on('users')->onDelete('set null');
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
