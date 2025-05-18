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
                                        {{ $order->id ?? '1' }}</td>
                                    <td class="px-6 py-4 text-sm font-medium whitespace-nowrap text-default-800">
                                        {{ $order->name ?? 'Lindsay Walton' }}</td>
                                    <td class="px-6 py-4 text-sm whitespace-nowrap text-default-800">
                                        {{ $order->order_date ?? '2025-04-30' }}</td>
                                    <td class="px-6 py-4 text-sm whitespace-nowrap text-default-800">
                                        ${{ $order->total_price ?? '50' }}</td>
                                    <td class="px-6 py-4 text-sm whitespace-nowrap text-default-800">
                                        {{ $order->payment_method ?? 'Credit Card' }}</td>
                                    <td class="px-6 py-4 text-sm whitespace-nowrap text-default-800">
                                        {{ $order->status ?? 'Completed' }}</td>
                                    <td class="px-6 py-4 text-sm whitespace-nowrap text-default-800">
                                        <ul>
                                            @foreach ($order->products ?? [] as $product)
                                                <li class="flex items-center {{ !$loop->first ? 'mt-2' : '' }} space-x-4">
                                                    <img src="{{ $product->image ?? 'https://via.placeholder.com/50' }}"
                                                        alt="Product Image" class="w-12 h-12 rounded" />
                                                    <div>
                                                        <p class="text-sm font-medium">
                                                            {{ $product->name ?? 'Product ' . $loop->iteration }}</p>
                                                        <p class="text-xs text-gray-500">{{ $product->quantity ?? '2' }} pcs
                                                            x ${{ $product->price ?? '25' }}</p>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium whitespace-nowrap text-end">
                                        <a class="text-primary hover:text-sky-700" href="#"
                                            data-hs-overlay="#modal-one">
                                            <iconify-icon icon="uil:edit" width="20"></iconify-icon>
                                        </a>
                                        <a class="text-primary hover:text-sky-700" href="#">
                                            <iconify-icon icon="iconamoon:eye" width="20"></iconify-icon>
                                        </a>
                                        <a class="text-primary hover:text-sky-700" href="#">
                                            <iconify-icon icon="mdi:delete-outline" width="20"></iconify-icon>
                                        </a>
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
