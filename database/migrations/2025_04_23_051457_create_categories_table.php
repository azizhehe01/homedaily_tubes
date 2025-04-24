<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->enum('type', ['produk', 'jasa']);
            $table->timestamps();
        });

        // Add category_id to services table
        Schema::table('service', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->constrained();
        });
    }

    public function down(): void
    {
        Schema::table('service', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
        Schema::dropIfExists('categories');
    }
};