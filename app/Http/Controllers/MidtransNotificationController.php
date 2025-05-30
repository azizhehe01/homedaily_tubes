<?php

namespace App\Http\Controllers;

use App\Models\Order; // Import model Order Anda
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Notification;
use Illuminate\Support\Facades\Log; // Untuk logging

class MidtransNotificationController extends Controller
{
    public function receive(Request $request)
    {
        // Set konfigurasi Midtrans untuk notifikasi
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');

        try {
            // Dapatkan notifikasi dari Midtrans
            $notification = new Notification();

            $transactionStatus = $notification->transaction_status;
            $orderId = $notification->order_id;
            $fraudStatus = $notification->fraud_status;

            // Cari pesanan di database Anda berdasarkan order_id
            $order = Order::where('order_id', $orderId)->first();

            if (!$order) {
                // Log jika pesanan tidak ditemukan
                Log::warning('Midtrans Notification: Order ID not found in database.', ['order_id' => $orderId]);
                return response()->json(['message' => 'Order not found'], 404);
            }

            // --- Logika untuk memperbarui status pesanan berdasarkan notifikasi Midtrans ---
            if ($transactionStatus == 'capture') {
                if ($fraudStatus == 'challenge') {
                    $order->order_status = 'challenge';
                } else if ($fraudStatus == 'accept') {
                    $order->order_status = 'settlement';
                }
            } else if ($transactionStatus == 'settlement') {
                $order->order_status = 'settlement';
            } else if ($transactionStatus == 'pending') {
                $order->order_status = 'pending';
            } else if ($transactionStatus == 'deny') {
                $order->order_status = 'denied';
            } else if ($transactionStatus == 'expire') {
                $order->order_status = 'expire';
            } else if ($transactionStatus == 'cancel') {
                $order->order_status = 'cancel';
            } else if ($transactionStatus == 'refund' || $transactionStatus == 'partial_refund') {
                $order->order_status = 'refunded';
            }

            // Update kolom Midtrans lainnya
            $order->midtrans_transaction_id = $notification->transaction_id;
            $order->midtrans_status_code = $notification->status_code;
            $order->midtrans_fraud_status = $fraudStatus;
            $order->payment_type = $notification->payment_type;
            $order->transaction_time = $notification->transaction_time;

            // Untuk Virtual Account
            if (isset($notification->va_numbers[0])) {
                $order->va_number = $notification->va_numbers[0]->va_number;
                $order->bank = $notification->va_numbers[0]->bank;
            }

            // Set payment_method jika statusnya settlement atau challenge
            if ($order->order_status == 'settlement' || $order->order_status == 'challenge') {
                $order->payment_method = 'midtrans'; // atau sesuaikan jika ada metode lain
            }


            $order->save();

            // Log sukses
            Log::info('Midtrans Notification: Order status updated successfully.', ['order_id' => $orderId, 'new_status' => $order->order_status]);

            // Beri respon 200 OK ke Midtrans
            return response()->json(['message' => 'Notification received and processed'], 200);
        } catch (\Exception $e) {
            // Log error jika ada masalah saat memproses notifikasi
            Log::error('Midtrans Notification Error: ' . $e->getMessage(), ['request' => $request->all()]);
            return response()->json(['message' => 'Error processing notification'], 500);
        }
    }
}
