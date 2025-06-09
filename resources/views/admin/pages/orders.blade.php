@extends('admin.layouts.app')

@section('title', 'Orders')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Order Management</h1>
        <div class="bg-white rounded-xl shadow-lg">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-4 text-sm font-bold text-gray-700 uppercase tracking-wider text-start">Order ID</th>
                            <th class="px-6 py-4 text-sm font-bold text-gray-700 uppercase tracking-wider text-start">Name</th>
                            <th class="px-6 py-4 text-sm font-bold text-gray-700 uppercase tracking-wider text-start">Date</th>
                            <th class="px-6 py-4 text-sm font-bold text-gray-700 uppercase tracking-wider text-start">Price</th>
                            <th class="px-6 py-4 text-sm font-bold text-gray-700 uppercase tracking-wider text-start">Payment</th>
                            <th class="px-6 py-4 text-sm font-bold text-gray-700 uppercase tracking-wider text-start">Status</th>
                            <th class="px-6 py-4 text-sm font-bold text-gray-700 uppercase tracking-wider text-start">Products</th>
                            <th class="px-6 py-4 text-sm font-bold text-gray-700 uppercase tracking-wider text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($orders ?? [] as $order)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $order['id'] }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $order['name'] }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $order['order_date'] }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    Rp{{ number_format($order['total_price'], 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $order['payment_method'] }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full {{ $order['status']['class'] }}">
                                        {{ $order['status']['text'] }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    <span class="inline-flex px-3 py-1 text-xs bg-gray-100 rounded-lg">
                                        {{ $order['product_name']}}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-end gap-2">
                                        @if($order['status']['text'] === 'paid')
                                            <form action="{{ route('admin.orders.update-status', $order['id']) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="packing">
                                                <button type="submit" class="inline-flex items-center px-4 py-2 text-xs font-medium text-yellow-700 bg-yellow-100 rounded-lg hover:bg-yellow-200 transition-colors">
                                                    Kemas
                                                </button>
                                            </form>
                                        @elseif($order['status']['text'] === 'packing')
                                            <form action="{{ route('admin.orders.update-status', $order['id']) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="shipping">
                                                <button type="submit" class="inline-flex items-center px-4 py-2 text-xs font-medium text-purple-700 bg-purple-100 rounded-lg hover:bg-purple-200 transition-colors">
                                                    Kirim
                                                </button>
                                            </form>
                                        @elseif($order['status']['text'] === 'shipping')
                                            <form action="{{ route('admin.orders.update-status', $order['id']) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="completed">
                                                <button type="submit" class="inline-flex items-center px-4 py-2 text-xs font-medium text-green-700 bg-green-100 rounded-lg hover:bg-green-200 transition-colors">
                                                    Selesai
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('admin.dashboard.partials.order-modal')
@endsection
