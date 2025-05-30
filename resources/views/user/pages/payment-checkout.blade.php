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
                    console.log('success');
                    console.log(result);
                    window.location.href = '{{ route('order.success') }}';
                },
                onPending: function(result) {
                    console.log('pending');
                    console.log(result);
                    window.location.href = '{{ route('order.pending') }}';
                },
                onError: function(result) {
                    console.log('error');
                    console.log(result);
                    window.location.href = '{{ route('order.failed') }}';
                },
                onClose: function() {
                    alert('You closed the popup without finishing the payment');
                }
            });
        });
    </script>
@endsection
