<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
    $orders = Order::with(['user', 'products'])->get()->map(function($order) {
        return [
            'id' => $order->order_id,
            'name' => $order->user->name ?? 'No User',
            'order_date' => $order->order_date ?? $order->created_at->format('Y-m-d'),
            'total_price' => $order->total_price,
            'payment_method' => $order->payment_method ?? 'Pending',
            'status' => [
                'text' => strtolower($order->order_status), // Make sure this matches one of the conditions
                'class' => $this->getStatusClass($order->order_status),
                
            ],
            'product_name' => $order->products->name,
            'order_id' => $order->order_id,
            'products' => $order->products
        ];
    });
    return view('admin.pages.orders', compact('orders'));
    
    }

private function getStatusClass($status)
{
    return match ($status) {
        'pending' => 'bg-red-400 text-white-600',
        'paid' => 'bg-green-400 text-white-100',
        'packing' => 'bg-yellow-100 text-yellow-800',
        'shipping' => 'bg-indigo-100 text-indigo-800',
        'completed' => 'bg-green-100 text-green-800',
        default => 'bg-gray-100 text-gray-800'
    };
}

public function updateStatus(Request $request, $orderId)
{
    try {
        $order = Order::findOrFail($orderId);
        
        // Define valid status transitions
        $validTransitions = [
            'paid' => 'packing',
            'packing' => 'shipping',
            'shipping' => 'completed'
        ];

        // Validate status transition
        if (!isset($validTransitions[$order->order_status]) || 
            $validTransitions[$order->order_status] !== $request->status) {
            return back()->with('error', 'Invalid status transition');
        }

        $order->order_status = $request->status;
        $order->save();

        return back()->with('success', 'Status pesanan berhasil diperbarui');
    } catch (\Exception $e) {
        return back()->with('error', 'Gagal memperbarui status pesanan');
    }
}
}
