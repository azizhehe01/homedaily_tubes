@extends('admin.layouts.app')

@section('title', 'Orders')

@section('content')
    <div class="py-4 table-orders">
        <div class="overflow-x-auto">
            <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden border rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-sm text-start text-default-500">Order ID</th>
                                <th scope="col" class="px-6 py-3 text-sm text-start text-default-500">Name</th>
                                <th scope="col" class="px-6 py-3 text-sm text-start text-default-500">Order Date</th>
                                <th scope="col" class="px-6 py-3 text-sm text-start text-default-500">Total Price</th>
                                <th scope="col" class="px-6 py-3 text-sm text-start text-default-500">Payment Method</th>
                                <th scope="col" class="px-6 py-3 text-sm text-start text-default-500">Order Status</th>
                                <th scope="col" class="px-6 py-3 text-sm text-start text-default-500">Products</th>
                                <th scope="col" class="px-6 py-3 text-sm text-end text-default-500">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($orders ?? [] as $order)
                                <tr>
                                    <td class="px-6 py-4 text-sm font-medium whitespace-nowrap text-default-800">
                                        {{ $order['id'] }}
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium whitespace-nowrap text-default-800">
                                        {{ $order['name'] }}
                                    </td>
                                    <td class="px-6 py-4 text-sm whitespace-nowrap text-default-800">
                                        {{ $order['order_date'] }}
                                    </td>
                                    <td class="px-6 py-4 text-sm whitespace-nowrap text-default-800">
                                        Rp{{ number_format($order['total_price'], 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 text-sm whitespace-nowrap text-default-800">
                                        {{ $order['payment_method'] }}
                                    </td>
                                    <td class="px-6 py-4 text-sm whitespace-nowrap text-default-800">
                                        <span class="px-2 py-1 text-xs rounded-full {{ $order['status']['class'] }}">
                                            {{ $order['status']['text'] }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm whitespace-nowrap text-default-800">
                                        <span class="px-2 py-1 text-xs rounded-full {{ $order['status']['class'] }}">
                                            {{ $order['status']['text'] }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium whitespace-nowrap text-end">
                                        <div class="flex justify-end space-x-2">
                                            @if($order['status']['text'] === 'paid')
                                                <form action="{{ route('admin.orders.update-status', $order['order_id']) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="packing">
                                                    <button type="submit" class="px-3 py-1 text-sm text-yellow-700 bg-yellow-100 rounded-md hover:bg-yellow-200">
                                                        Kemas Pesanan
                                                    </button>
                                                </form>
                                            @elseif($order['status']['text'] === 'packing')
                                                <form action="{{ route('admin.orders.update-status', $order['order_id']) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="shipping">
                                                    <button type="submit" class="px-3 py-1 text-sm text-purple-700 bg-purple-100 rounded-md hover:bg-purple-200">
                                                        Kirim Pesanan
                                                    </button>
                                                </form>
                                            @endif
                                            
                                            <a class="text-primary hover:text-sky-700" href="#">
                                                <iconify-icon icon="iconamoon:eye" width="20"></iconify-icon>
                                            </a>
                                        </div>
                                    </td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    @include('admin.dashboard.partials.order-modal')
@endsection

@push('scripts')
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
@endpush
