@extends('user.components.layout')

@section('content')
    <!-- Title -->
    <h2 class="mb-2 text-2xl font-bold text-center text-gray-800">Order Information</h2>
    <p class="mb-32 text-center text-gray-500">Please fill up the blank fields below</p>

    <!-- Product Info and Form Side by Side -->
    <div class="flex flex-col max-w-4xl gap-32 mx-auto mb-6 md:flex-row">
        <!-- Product Info -->
        <div class="flex-1">
            @if ($product->images->where('is_primary', true)->first())
                <img src="{{ asset('storage/' . $product->images->where('is_primary', true)->first()->path) }}"
                    alt="{{ $product->name }}" class="object-cover w-full h-64 mb-6 rounded-lg">
            @endif
            <div class="flex justify-between">
                <div>
                    <p class="text-lg font-semibold text-gray-800">{{ $product->name }}</p>
                    <p class="text-sm text-gray-500">{{ $product->category->category_name ?? 'Uncategorized' }}</p>
                </div>
                <p class="text-lg font-semibold text-gray-800">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                    <span class="text-sm font-normal">× {{ $booking['quantity'] ?? 1 }}</span>
                </p>
            </div>
            <!-- Total Price -->
            <div class="pt-4 mt-4 border-t">
                <div class="flex justify-between">
                    <p class="font-medium text-gray-700">Total Price</p>
                    <p class="font-semibold text-orange-600">
                        Rp {{ number_format($product->price * ($booking['quantity'] ?? 1), 0, ',', '.') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Form or Display Section -->
        <div class="flex-1">
            @if (!$userAddress)
                <!-- Show Form when no address exists -->
                <form action="{{ route('booking.address.store') }}" method="POST" id="booking-address-form">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                    <input type="hidden" name="quantity" value="{{ $booking['quantity'] ?? 1 }}">

                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-semibold text-gray-700" for="recipient_name">Nama
                            Lengkap</label>
                        <input type="text" name="recipient_name" id="recipient_name" value="{{ auth()->user()->name }}"
                            class="w-full p-3 text-gray-700 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                            readonly>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-semibold text-gray-700" for="phone_number">Phone
                            Number</label>
                        <input type="tel" name="phone_number" id="phone_number"
                            class="w-full p-3 text-gray-700 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                            required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-semibold text-gray-700" for="full_address">Complete
                            Address</label>
                        <textarea name="full_address" id="full_address" rows="3"
                            class="w-full p-3 text-gray-700 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-semibold text-gray-700" for="postal_code">Postal Code</label>
                        <input type="text" name="postal_code" id="postal_code"
                            class="w-full p-3 text-gray-700 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                            required>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-gray-700" for="city">City</label>
                            <input type="text" name="city" id="city"
                                class="w-full p-3 text-gray-700 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                                required>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-gray-700" for="province">Province</label>
                            <input type="text" name="province" id="province"
                                class="w-full p-3 text-gray-700 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                                required>
                        </div>
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
                <div class="">
                    <h3 class="mb-4 text-lg font-semibold">Delivery Information</h3>
                    <div class="mb-4">
                        <p class="text-sm text-gray-500">Recipient</p>
                        <p class="font-medium">{{ $userAddress->recipient_name }}</p>
                    </div>
                    <div class="mb-4">
                        <p class="text-sm text-gray-500">Phone Number</p>
                        <p class="font-medium">{{ $userAddress->phone_number }}</p>
                    </div>
                    <div class="mb-4">
                        <p class="text-sm text-gray-500">Address</p>
                        <p class="font-medium">{{ $userAddress->full_address }}</p>
                    </div>
                    <div class="mb-4">
                        <p class="text-sm text-gray-500">City</p>
                        <p class="font-medium">{{ $userAddress->city }}, {{ $userAddress->province }}
                            {{ $userAddress->postal_code }}</p>
                    </div>
                </div>

                <div class="flex gap-4 mx-auto mt-6">
                    <form action="{{ route('booking.process') }}" method="POST" class="flex-1">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                        <input type="hidden" name="quantity" value="{{ $booking['quantity'] ?? 1 }}">
                        <button type="submit"
                            class="w-full p-3 font-semibold text-white transition duration-200 bg-orange-600 rounded-lg hover:bg-orange-700">
                            Continue to Payment
                        </button>
                    </form>
                    <button onclick="openEditAddressModal()"
                        class="flex-1 p-3 font-semibold text-gray-700 transition duration-200 bg-gray-200 rounded-lg hover:bg-gray-300">
                        Edit Address
                    </button>
                </div>
            @endif
        </div>
    </div>

    <!-- Edit Address Modal -->
    <div id="editAddressModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <!-- Modal panel -->
            <div
                class="relative inline-block p-6 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="absolute top-0 right-0 pt-4 pr-4">
                    <button type="button" class="text-gray-400 hover:text-gray-500" onclick="closeEditAddressModal()">
                        <span class="sr-only">Close</span>
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="sm:flex sm:items-start">
                    <div class="w-full mt-3 text-center sm:mt-0 sm:text-left">
                        <h3 class="mb-4 text-lg font-semibold text-gray-900">Edit Address</h3>
                        <form id="editAddressForm" action="{{ route('booking.address.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-semibold text-gray-700"
                                    for="edit_recipient_name">Nama
                                    Lengkap</label>
                                <input type="text" name="recipient_name" id="edit_recipient_name"
                                    value="{{ $userAddress->recipient_name ?? '' }}"
                                    class="w-full p-3 text-gray-700 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                                    required>
                            </div>
                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-semibold text-gray-700"
                                    for="edit_phone_number">Phone
                                    Number</label>
                                <input type="tel" name="phone_number" id="edit_phone_number"
                                    value="{{ $userAddress->phone_number ?? '' }}"
                                    class="w-full p-3 text-gray-700 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                                    required>
                            </div>
                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-semibold text-gray-700"
                                    for="edit_full_address">Complete
                                    Address</label>
                                <textarea name="full_address" id="edit_full_address" rows="3"
                                    class="w-full p-3 text-gray-700 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>{{ $userAddress->full_address ?? '' }}</textarea>
                            </div>
                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-semibold text-gray-700"
                                    for="edit_postal_code">Postal
                                    Code</label>
                                <input type="text" name="postal_code" id="edit_postal_code"
                                    value="{{ $userAddress->postal_code ?? '' }}"
                                    class="w-full p-3 text-gray-700 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                                    required>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block mb-2 text-sm font-semibold text-gray-700"
                                        for="edit_city">City</label>
                                    <input type="text" name="city" id="edit_city"
                                        value="{{ $userAddress->city ?? '' }}"
                                        class="w-full p-3 text-gray-700 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                                        required>
                                </div>
                                <div>
                                    <label class="block mb-2 text-sm font-semibold text-gray-700"
                                        for="edit_province">Province</label>
                                    <input type="text" name="province" id="edit_province"
                                        value="{{ $userAddress->province ?? '' }}"
                                        class="w-full p-3 text-gray-700 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                                        required>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                    <button type="submit" form="editAddressForm"
                        class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-orange-600 border border-transparent rounded-md shadow-sm hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Save Changes
                    </button>
                    <button type="button" onclick="closeEditAddressModal()"
                        class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 sm:mt-0 sm:w-auto sm:text-sm">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function openEditAddressModal() {
            // Simply show the modal since data is already in the form
            document.getElementById('editAddressModal').classList.remove('hidden');
        }

        function closeEditAddressModal() {
            document.getElementById('editAddressModal').classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('editAddressModal').addEventListener('click', function(event) {
            if (event.target === this) {
                closeEditAddressModal();
            }
        });
    </script>
@endsection
