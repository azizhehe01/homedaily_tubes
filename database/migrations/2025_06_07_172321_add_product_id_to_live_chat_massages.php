<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('live_chat_massages', function (Blueprint $table) {
            $table->foreignId('product_id')
                ->after('to_user_id')
                ->constrained('products', 'product_id')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('live_chat_massages', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropColumn('product_id');
        });
    }
};
