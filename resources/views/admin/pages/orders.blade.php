@extends('admin.layouts.app')

@section('title', 'Orders')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="bg-white rounded-xl shadow-lg">
            <div class="overflow-hidden">
                <table class="w-full table-auto">
                    <thead class="bg-gray-100 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-sm font-semibold text-gray-700 uppercase tracking-wider text-start">Order ID</th>
                            <th class="px-6 py-4 text-sm font-semibold text-gray-700 uppercase tracking-wider text-start">Name</th>
                            <th class="px-6 py-4 text-sm font-semibold text-gray-700 uppercase tracking-wider text-start">Date</th>
                            <th class="px-6 py-4 text-sm font-semibold text-gray-700 uppercase tracking-wider text-start">Price</th>
                            <th class="px-6 py-4 text-sm font-semibold text-gray-700 uppercase tracking-wider text-start">Payment</th>
                            <th class="px-6 py-4 text-sm font-semibold text-gray-700 uppercase tracking-wider text-start">Status</th>
                            <th class="px-6 py-4 text-sm font-semibold text-gray-700 uppercase tracking-wider text-start">Products</th>
                            <th class="px-6 py-4 text-sm font-semibold text-gray-700 uppercase tracking-wider text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($orders ?? [] as $order)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">#{{ $order['id'] }}</td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $order['name'] }}</td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $order['order_date'] }}</td>
                                <td class="px-6 py-4 text-sm font-bold text-gray-900">
                                    Rp{{ number_format($order['total_price'], 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $order['payment_method'] }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-full {{ $order['status']['class'] }}">
                                        {{ $order['status']['text'] }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                    <span class="inline-flex items-center px-3 py-1.5 text-xs bg-gray-100 rounded-lg">
                                        {{ $order['product_name']}}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-end">
                                    <div class="flex justify-end gap-2">
                                        @if($order['status']['text'] === 'paid')
                                            <button type="submit" class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-yellow-700 bg-yellow-100 rounded hover:bg-yellow-200">
                                                Kemas
                                            </button>
                                        @elseif($order['status']['text'] === 'packing')
                                            <button type="submit" class="inline-flex items-center px-3 py-1.5 text-xs font-medium bg-purple-100 rounded hover:bg-purple-200">
                                                Kirim
                                            </button>
                                        @elseif($order['status']['text'] === 'shipping')
                                            <button type="submit" class="inline-flex items-center px-3 py-1.5 text-xs font-medium bg-green-100 rounded hover:bg-green-200">
                                                Selesai
                                            </button>
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
@endsection

@push('scripts')
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
@endpush