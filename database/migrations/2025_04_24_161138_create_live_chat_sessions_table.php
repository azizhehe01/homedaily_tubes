<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // /**
    //  * Run the migrations.
    //  */
    // public function up(): void
    // {
    //     Schema::create('live_chat_sessions', function (Blueprint $table) {
    //         $table->id('session_id');
    //         $table->unsignedBigInteger('user_id');
    //         $table->unsignedBigInteger('admin_id')->nullable();
    //         $table->enum('status', ['active', 'closed']);
    //         $table->dateTime('closed_at')->nullable();
    //         $table->timestamps();

    //         // kaga ussah jelasin  lagi tau  lah yangh  di bawah ubntuk apa
    //         $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
    //     });
    // }

    // /**
    //  * Reverse the migrations.
    //  */
    // public function down(): void
    // {
    //     Schema::dropIfExists('live_chat_sessions');
    // }


    public function up()
    {
        Schema::create('live_chat_sessions', function (Blueprint $table) {
            $table->id('session_id');
            // Change string to unsignedBigInteger to match products.product_id
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->string('status')->default('active');
            $table->timestamp('closed_at')->nullable();
            $table->timestamps();

            // Add indexes before foreign keys
            $table->index('product_id');

            // Add foreign key constraints
            $table->foreign('product_id')
                ->references('product_id')
                ->on('products')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('user_id')
                ->on('users')
                ->onDelete('set null');

            $table->foreign('admin_id')
                ->references('user_id')
                ->on('users')
                ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('live_chat_sessions');
    }
};
