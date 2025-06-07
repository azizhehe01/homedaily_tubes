<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Str;



class BookingController extends Controller
{
    public function __construct()
    {
        // Config::$serverKey = config('midtrans.server_key');
        // Config::$isProduction = config('midtrans.is_production');
        // Config::$isSanitized = true;
        // Config::$is3ds = true;

        // Debug logging
        Log::info('Setting up Midtrans configuration');

        // Make sure we're using sandbox credentials
        $serverKey = config('midtrans.server_key');
        if (!str_starts_with($serverKey, 'SB-') && !config('midtrans.is_production')) {
            Log::warning('Server key does not have SB- prefix in sandbox mode');
        }

        Config::$serverKey = $serverKey;
        Config::$isProduction = false; // Force sandbox mode
        Config::$isSanitized = true;
        Config::$is3ds = true;

        Log::info('Midtrans configured with:', [
            'server_key' => substr($serverKey, 0, 12) . '...', // Only log prefix for security
            'is_production' => Config::$isProduction
        ]);
    }

    public function createBooking(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'quantity' => 'required|integer|min:1'
        ]);

        // Store booking data in session
        session([
            'booking' => [
                'product_id' => $request->product_id,
                'quantity' => $request->quantity
            ]
        ]);

        // Redirect to booking form
        return redirect()->route('booking.form');
    }


    public function showBookingForm(Request $request)
    {
        // Get user's address
        $userAddress = Address::where('user_id', Auth::user()->user_id)->first();

        // Get product from session if coming from "Buy Now"
        $product = null;
        if ($request->session()->has('booking')) {
            $booking = $request->session()->get('booking');
            $product = Product::find($booking['product_id']);
        }

        if (!$product) {
            return redirect()->route('user.index')->with('error', 'No product selected for booking');
        }

        return view('user.pages.booking-page', compact('userAddress', 'product'));
    }


    public function storeAddress(Request $request)
    {
        $validated = $request->validate([
            'recipient_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'full_address' => 'required|string',
            'postal_code' => 'required|string|max:10',
            'city' => 'required|string|max:255',
            'province' => 'required|string|max:255',
        ]);

        $address = Address::updateOrCreate(
            ['user_id' => Auth::user()->user_id],
            [
                'recipient_name' => $validated['recipient_name'],
                'phone_number' => $validated['phone_number'],
                'full_address' => $validated['full_address'],
                'postal_code' => $validated['postal_code'],
                'city' => $validated['city'],
                'province' => $validated['province'],
            ]
        );

        return redirect()->route('booking.form')
            ->with('success', 'Address saved successfully');
    }

    public function updateAddress(Request $request)
    {
        $validated = $request->validate([
            'recipient_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'full_address' => 'required|string',
            'postal_code' => 'required|string|max:10',
            'city' => 'required|string|max:255',
            'province' => 'required|string|max:255',
        ]);

        $address = Address::where('user_id', Auth::user()->user_id)->firstOrFail();
        $address->update($validated);

        return redirect()->route('booking.form')
            ->with('success', 'Address updated successfully');
    }

    public function editAddress()
    {
        // No need to fetch data since we already have it in the view
        return back();
    }


    public function processBooking(Request $request)
    {
        // Get booking data from session
        $booking = $request->session()->get('booking');
        if (!$booking) {
            return redirect()->back()->with('error', 'No booking information found');
        }

        $product = Product::find($booking['product_id']);
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }

        $user = Auth::user();
        $userAddress = Address::where('user_id', $user->user_id)->first();
        if (!$userAddress) {
            return redirect()->back()->with('error', 'Please add your delivery address first');
        }

        $totalPrice = $product->price * $booking['quantity'];

        // Create order
        $orderId = 'INV-' . Str::upper(Str::random(8)) . '-' . time();
        $order = Order::create([
            'order_id' => $orderId,
            'user_id' => $user->user_id,
            'product_id' => $product->product_id,
            'quantity' => $booking['quantity'],
            'total_price' => $totalPrice,
            'payment_method' => null,
            'order_status' => 'pending',
            'order_date' => now(),
        ]);

        // Prepare Midtrans parameters
        $params = [
            'transaction_details' => [
                'order_id' => $order->order_id,
                'gross_amount' => (int)$order->total_price, // Convert to integer
            ],
            'customer_details' => [
                'first_name' => $userAddress->recipient_name,
                'email' => $user->email,
                'phone' => $userAddress->phone_number,
                'shipping_address' => [
                    'first_name' => $userAddress->recipient_name,
                    'address' => $userAddress->full_address,
                    'city' => $userAddress->city,
                    'postal_code' => $userAddress->postal_code,
                    'phone' => $userAddress->phone_number,
                    'country_code' => 'IDN'
                ]
            ],
            'item_details' => [
                [
                    'id' => $product->product_id,
                    'price' => (int)$product->price,
                    'quantity' => $booking['quantity'],
                    'name' => $product->name,
                ]
            ]
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            $request->session()->forget('booking');

            return view('user.pages.payment-checkout', compact('snapToken', 'order'));
        } catch (\Exception $e) {
            Log::error('Midtrans Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to process payment: ' . $e->getMessage());
        }
    }



    public function testMidtransConfig()
    {
        try {
            // Verify both keys are present
            if (empty(config('midtrans.server_key')) || empty(config('midtrans.client_key'))) {
                throw new \Exception('Missing Midtrans credentials');
            }

            // Verify server key format
            if (!str_starts_with(config('midtrans.server_key'), 'SB-Mid-server-')) {
                throw new \Exception('Invalid server key format. Must start with SB-Mid-server- in sandbox mode');
            }

            // Verify client key format
            if (!str_starts_with(config('midtrans.client_key'), 'SB-Mid-client-')) {
                throw new \Exception('Invalid client key format. Must start with SB-Mid-client- in sandbox mode');
            }

            $params = [
                'transaction_details' => [
                    'order_id' => 'TEST-' . time(),
                    'gross_amount' => 10000,
                ]
            ];

            $snapToken = Snap::getSnapToken($params);
            dd([
                'success' => true,
                'snap_token' => $snapToken,
                'config' => [
                    'server_key' => substr(Config::$serverKey, 0, 13) . '...',
                    'client_key' => substr(config('midtrans.client_key'), 0, 13) . '...',
                    'is_production' => Config::$isProduction
                ]
            ]);
        } catch (\Exception $e) {
            dd([
                'error' => $e->getMessage(),
                'config' => [
                    'server_key' => substr(Config::$serverKey, 0, 13) . '...',
                    'client_key' => substr(config('midtrans.client_key'), 0, 13) . '...',
                    'is_production' => Config::$isProduction
                ]
            ]);
        }
    }

    public function getOrders()
    {
    $orders = Order::with(['products'])
    ->where('user_id', Auth::user()->user_id)
    ->orderBy('created_at', 'desc')
    ->get()
    ->map(function ($order) {
        return [
            'order_id' => $order->order_id,
            'date' => $order->created_at->format('d M Y'),
            'product' => [
                'name' => $order->products->name,
                'image' => $order->products->images->where('is_primary', true)->first()?->path,
                'type' => 'Produk'
            ],
            'quantity' => $order->quantity,
            'total_price' => $order->total_price,
            'status' => $this->getStatusBadge($order->order_status)
        ];
    });
            
        return view('user.pages.user-profile', compact('orders'));
    }

    public function updateStatus(Request $request, $orderId)
    {
        Log::info('Updating order status', [
            'order_id' => $orderId,
            'request_data' => $request->all()
        ]);

        try {
            $order = Order::findOrFail($orderId);

            $validated = $request->validate([
                'status' => 'required|string',
                'transaction_id' => 'required|string',
                'payment_type' => 'required|string',
                'transaction_time' => 'required'
            ]);

            $order->update([
                'order_status' => $validated['status'],
                'midtrans_transaction_id' => $validated['transaction_id'],
                'payment_type' => $validated['payment_type'],
                'transaction_time' => $validated['transaction_time'],
                'payment_method' => 'midtrans'
            ]);

            // Update product stock
            $product = $order->products;
            $product->decrement('stock', $order->quantity);

            Log::info('Order status updated successfully', ['order' => $order]);

            return response()->json([
                'success' => true,
                'message' => 'Status pesanan berhasil diperbarui',
                'order' => $order
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to update order status', [
                'error' => $e->getMessage(),
                'order_id' => $orderId,
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui status pesanan: ' . $e->getMessage()
            ], 500);
        }
    }


    private function getOrderStatus($status)
    {
        return match ($status) {
            'completed' => [
            'text' => 'Selesai',
            'class' => 'text-green-800 bg-green-100',
            'icon' => 'check-circle',
            'code' => 'completed'  
        ],
        'paid' => [
            'text' => 'Dibayar',
            'class' => 'text-emerald-800 bg-emerald-100',
            'icon' => 'credit-card',
            'code' => 'paid'
        ],
        'shipping' => [
            'text' => 'Dikirim',
            'class' => 'text-yellow-800 bg-yellow-100',
            'icon' => 'truck',
            'code' => 'shipping'  
        ],
        'packing' => [
            'text' => 'Sedang Dikemas',
            'class' => 'text-blue-800 bg-blue-100',
            'icon' => 'package',
            'code' => 'packing'  
        ],
        'pending' => [
            'text' => 'Menunggu Pembayaran',
            'class' => 'text-orange-800 bg-orange-100',
            'icon' => 'clock',
            'code' => 'pending'  
        ],
        default => [
            'text' => 'Processing',
            'class' => 'text-gray-800 bg-gray-100',
            'icon' => 'loader',
            'code' => 'processing'  
        ],
        };
    }
}
