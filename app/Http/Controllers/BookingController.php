<?php

// namespace App\Http\Controllers;

// use App\Models\Address;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;


// class BookingController extends Controller
// {



//     public function showBookingForm()
//     {
//         // Get authenticated user's address
//         $userAddress = Address::where('user_id', Auth::user()->user_id)->first();

//         return view('user.pages.booking-page', compact('userAddress'));
//     }

//     public function storeAddress(Request $request)
//     {
//         $validated = $request->validate([
//             'first_name' => 'required|string|max:255',
//             'last_name' => 'required|string|max:255',
//             'phone' => 'required|string|max:15',
//             'address' => 'required|string'
//         ]);

//         $address = Address::updateOrCreate(
//             ['user_id' => Auth::user()->user_id],
//             [
//                 'first_name' => $validated['first_name'],
//                 'last_name' => $validated['last_name'],
//                 'email' => Auth::user()->email,
//                 'phone' => $validated['phone'],
//                 'address' => $validated['address']
//             ]
//         );

//         return redirect()->back()->with('success', 'Address saved successfully');
//     }

//     public function editAddress()
//     {
//         $userAddress = Address::where('user_id', Auth::user()->user_id)->firstOrFail();
//         return view('user.pages.edit-address', compact('userAddress'));
//     }

//     public function updateAddress(Request $request)
//     {
//         $validated = $request->validate([
//             'first_name' => 'required|string|max:255',
//             'last_name' => 'required|string|max:255',
//             'phone' => 'required|string|max:15',
//             'address' => 'required|string'
//         ]);

//         $address = Address::where('user_id', Auth::user()->user_id)->firstOrFail();
//         $address->update($validated);

//         return redirect()->route('booking.form')->with('success', 'Address updated successfully');
//     }

//     public function processBooking()
//     {
//         // Add your booking process logic here
//         return redirect()->route('booking.confirmation');
//     }
// }

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
            return redirect()->route('home')->with('error', 'No product selected for booking');
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
}
