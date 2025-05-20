<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('live_chat_massages', function (Blueprint $table) {
            $table->string('image_path')->nullable()->after('message_content');
        });
    }

    public function down(): void
    {
        Schema::table('live_chat_massages', function (Blueprint $table) {
            $table->dropColumn('image_path');
        });
    }
};
