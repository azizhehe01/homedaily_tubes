<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BookingController extends Controller
{



    public function showBookingForm()
    {
        // Get authenticated user's address
        $userAddress = Address::where('user_id', Auth::user()->user_id)->first();

        return view('user.pages.booking-page', compact('userAddress'));
    }

    public function storeAddress(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string'
        ]);

        $address = Address::updateOrCreate(
            ['user_id' => Auth::user()->user_id],
            [
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'email' => Auth::user()->email,
                'phone' => $validated['phone'],
                'address' => $validated['address']
            ]
        );

        return redirect()->back()->with('success', 'Address saved successfully');
    }

    public function editAddress()
    {
        $userAddress = Address::where('user_id', Auth::user()->user_id)->firstOrFail();
        return view('user.pages.edit-address', compact('userAddress'));
    }

    public function updateAddress(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string'
        ]);

        $address = Address::where('user_id', Auth::user()->user_id)->firstOrFail();
        $address->update($validated);

        return redirect()->route('booking.form')->with('success', 'Address updated successfully');
    }

    public function processBooking()
    {
        // Add your booking process logic here
        return redirect()->route('booking.confirmation');
    }
}
