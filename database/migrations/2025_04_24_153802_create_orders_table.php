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
        Schema::create('orders', function (Blueprint $table) {
            // Mengubah primary key menjadi string karena order_id dari Midtrans bisa berupa string
            // Order ID ini akan menjadi ID unik pesanan Anda yang juga dikirim ke Midtrans
            $table->string('order_id')->primary();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('product_id'); // Tetap ada karena hanya 1 item per order
            $table->integer('quantity');             // Tetap ada karena hanya 1 item per order
            $table->decimal('total_price', 10, 2);   // Total harga untuk 1 item * quantity

            // --- Kolom Tambahan untuk Integrasi Midtrans ---
            $table->string('midtrans_transaction_id')->nullable()->unique(); // ID unik transaksi dari Midtrans
            $table->string('midtrans_status_code')->nullable(); // Kode status dari Midtrans (e.g., 200, 201, 202)
            $table->string('midtrans_fraud_status')->nullable(); // Status fraud dari Midtrans (e.g., accept, deny)
            $table->string('payment_type')->nullable(); // Tipe pembayaran (e.g., credit_card, gopay, bank_transfer)
            $table->string('va_number')->nullable(); // Nomor Virtual Account jika menggunakan VA
            $table->string('bank')->nullable(); // Nama bank jika menggunakan bank transfer
            $table->string('currency')->default('IDR'); // Mata uang (default IDR)
            $table->timestamp('transaction_time')->nullable(); // Waktu transaksi di Midtrans

            // payment_method bisa diisi dari payment_type Midtrans, atau bisa juga tetap umum
            $table->enum('payment_method', ['midtrans', 'paylater', 'manual_transfer'])->nullable();
            // Order status yang lebih komprehensif, mencakup status dari Midtrans
            $table->enum('order_status', [
                'pending',          // Menunggu pembayaran (awal)
                'settlement',       // Pembayaran berhasil (dari Midtrans)
                'processing',       // Pesanan sedang disiapkan
                'completed',        // Pesanan selesai (sudah dikirim/diterima)
                'denied',           // Pembayaran ditolak oleh Midtrans
                'expire',           // Pembayaran kadaluarsa di Midtrans
                'cancel',           // Pesanan dibatalkan (oleh user/admin)
                'refunded',         // Dana dikembalikan
                'challenge'         // Status dari Midtrans jika ada indikasi fraud
            ])->default('pending'); // Status default saat pesanan dibuat

            $table->dateTime('order_date')->useCurrent(); // Waktu pesanan dibuat
            $table->timestamps(); // created_at dan updated_at

            // --- Definisi Foreign Key ---
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
