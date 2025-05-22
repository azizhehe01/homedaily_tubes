@extends('user.components.layout')

@section('content')
    <!-- Title -->
    <h2 class="mb-2 text-2xl font-bold text-center text-gray-800">Order Information</h2>
    <p class="mb-32 text-center text-gray-500">Please fill up the blank fields below</p>

    <!-- Property Image/Info and Form Side by Side -->
    <div class="flex flex-col max-w-4xl gap-32 mx-auto mb-6 md:flex-row">
        <!-- Property Image and Info -->
        <div class="flex-1">
            <img src="{{ asset('storage/products/pyj8AplgKs7G9mL0ffwWiWlEACP29CBMFZTKJEY9.png') }}" alt="Property Image"
                class="object-cover w-full h-64 mb-6 rounded-lg">
            <div class="flex justify-between">
                <div>
                    <p class="text-lg font-semibold text-gray-800">Podo Wae</p>
                    <p class="text-sm text-gray-500">Madiun, Indonesia</p>
                </div>
                <p class="text-lg font-semibold text-gray-800">$480 USD <span class="text-sm font-normal">per 2
                        nights</span></p>
            </div>
        </div>

        <!-- Form or Display Section -->
        <div class="flex-1">
            @if (!$userAddress)
                <!-- Show Form when no address exists -->
                <form action="{{ route('booking.address.store') }}" method="POST" id="booking-address-form">
                    @csrf
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-semibold text-gray-700" for="first-name">First Name</label>
                        <input type="text" name="first_name" id="first-name" value="{{ auth()->user()->name }}"
                            class="w-full p-3 text-gray-700 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                            readonly>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-semibold text-gray-700" for="last-name">Last Name</label>
                        <input type="text" name="last_name" id="last-name"
                            class="w-full p-3 text-gray-700 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                            required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-semibold text-gray-700" for="email">Email Address</label>
                        <input type="email" name="email" id="email" value="{{ auth()->user()->email }}"
                            class="w-full p-3 text-gray-700 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                            readonly>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-semibold text-gray-700" for="phone">Phone Number</label>
                        <input type="tel" name="phone" id="phone"
                            class="w-full p-3 text-gray-700 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                            required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-semibold text-gray-700" for="address">Address</label>
                        <textarea name="address" id="address" rows="3"
                            class="w-full p-3 text-gray-700 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required></textarea>
                    </div>

                    <div class="max-w-sm mx-auto">
                        <button type="submit"
                            class="w-full p-3 font-semibold text-white transition duration-200 bg-orange-600 rounded-lg hover:bg-orange-700">
                            Save Address
                        </button>
                    </div>
                </form>
            @else
                <!-- Show Address Information when exists -->
                <div class="p-6 border rounded-lg">
                    <h3 class="mb-4 text-lg font-semibold">Delivery Information</h3>
                    <div class="mb-4">
                        <p class="text-sm text-gray-500">Recipient</p>
                        <p class="font-medium">{{ $userAddress->first_name }} {{ $userAddress->last_name }}</p>
                    </div>
                    <div class="mb-4">
                        <p class="text-sm text-gray-500">Phone Number</p>
                        <p class="font-medium">{{ $userAddress->phone }}</p>
                    </div>
                    <div class="mb-4">
                        <p class="text-sm text-gray-500">Email</p>
                        <p class="font-medium">{{ $userAddress->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Address</p>
                        <p class="font-medium">{{ $userAddress->address }}</p>
                    </div>
                </div>

                <div class="flex max-w-sm gap-4 mx-auto mt-6">
                    <button onclick="window.location.href='{{ route('booking.process') }}'"
                        class="flex-1 p-3 font-semibold text-white transition duration-200 bg-orange-600 rounded-lg hover:bg-orange-700">
                        Continue
                    </button>
                    <button onclick="window.location.href='{{ route('booking.address.edit') }}'"
                        class="flex-1 p-3 font-semibold text-gray-700 transition duration-200 bg-gray-200 rounded-lg hover:bg-gray-300">
                        Edit
                    </button>
                </div>
            @endif
        </div>
    </div>
@endsection
