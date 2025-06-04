@extends('user.components.layout')

@section('content')
    <div class="container px-4 py-8 mx-auto">
        <div class="max-w-2xl mx-auto">
            <h1 class="mb-4 text-2xl font-bold">Payment Details</h1>

            <!-- Order Summary -->
            <div class="p-6 mb-6 bg-white rounded-lg shadow">
                <h2 class="mb-4 text-lg font-semibold">Order Summary</h2>
                <div class="pb-4 mb-4 border-b">
                    <p>Order ID: {{ $order->order_id }}</p>
                    <p>Total Amount: Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                </div>
            </div>

            <!-- Payment Button -->
            <div class="text-center">
                <button id="pay-button" class="px-6 py-3 font-semibold text-white bg-orange-600 rounded-lg">
                    Pay Now
                </button>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{ config('midtrans.snap_url') }}"
        data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script type="text/javascript">
        const payButton = document.querySelector('#pay-button');
        payButton.addEventListener('click', function(e) {
            e.preventDefault();

            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    console.log('Payment success:', result);

                    // Send status update to server
                    fetch('{{ route('order.update-status', $order->order_id) }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                status: 'paid',
                                transaction_id: result.transaction_id,
                                payment_type: result.payment_type,
                                transaction_time: result.transaction_time
                            })
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log('Status updated successfully:', data);
                            // Redirect to profile page after successful update
                            window.location.href =
                                '{{ route('user.profile') }}#transactions-section';
                        })
                        .catch(error => {
                            console.error('Error updating status:', error);
                            // Store payment info in localStorage
                            localStorage.setItem('pendingPayment', JSON.stringify({
                                orderId: '{{ $order->order_id }}',
                                result: result
                            }));
                            alert('Payment successful! The order status will be updated shortly.');
                            window.location.href =
                                '{{ route('user.profile') }}#transactions-section';
                        });
                },
                onPending: function(result) {
                    console.log('Payment pending:', result);
                    window.location.href = '{{ route('user.profile') }}#transactions-section';
                },
                onError: function(result) {
                    console.error('Payment error:', result);
                    alert('Payment failed. Please try again.');
                },
                onClose: function() {
                    console.log('Payment popup closed');
                }
            });
        });
    </script>
@endsection
