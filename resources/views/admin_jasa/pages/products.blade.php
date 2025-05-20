@php
use Illuminate\Support\Str;
@endphp

@extends('admin_jasa.layouts.app')

@section('title', 'Products List')

@section('content')
    <div class="px-4 py-6 container-fluid"> {{-- Changed to container-fluid and added px-4 --}}
        @include('admin_jasa.layouts.page-title', [
            'title' => 'Jasa List',
            'subtitle' => 'atur data jasa lo',
        ])

        @if (session('success'))
            <div class="p-4 mb-4 text-green-700 border border-green-200 rounded-lg bg-green-50">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-hidden bg-white rounded-lg shadow">
            <div class="flex items-center justify-between p-4 border-b">
                <div class="flex-1">
                    <h3 class="text-lg font-medium text-default-700">All Products</h3>
                </div>
                <div>
                    <a href="{{ route('admin_jasa.pages.input-products') }}"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-colors bg-blue-600 rounded-lg hover:bg-blue-700">
                        <iconify-icon icon="material-symbols:add" class="mr-1"></iconify-icon>
                        Tambahkan jasa
                    </a>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full divide-y divide-gray-200"> {{-- Changed min-w-full to w-full --}}
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="w-16 px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                ID</th> {{-- Added fixed width --}}
                            <th scope="col"
                                class="w-48 px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Name</th> {{-- Added fixed width --}}
                            <th scope="col"
                                class="w-20 px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Image</th> {{-- Added fixed width --}}
                            <th scope="col"
                                class="w-32 px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Price</th> {{-- Added fixed width --}}
                            <th scope="col"
                                class="w-24 px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Stock</th> {{-- Added fixed width --}}
                            <th scope="col"
                                class="w-40 px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Category</th> {{-- Added fixed width --}}
                            <th scope="col"
                                class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Description</th>
                            <th scope="col"
                                class="w-24 px-4 py-3 text-xs font-medium tracking-wider text-right text-gray-500 uppercase">
                                Actions</th> {{-- Added fixed width --}}
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($products->filter(function($product) {
                                    return Str::contains(strtolower($product->category->category_name), 'jasa');}) as $product)
                            <tr>
                                <td class="px-4 py-4 text-sm text-gray-500 whitespace-nowrap">{{ $product->product_id }}
                                </td>
                                <td class="px-4 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                                    {{ $product->name }}</td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    @if ($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image"
                                            class="object-cover w-12 h-12 rounded-md">
                                    @else
                                        <span class="text-sm italic text-gray-400">No image</span>
                                    @endif
                                </td>
                                <td class="px-4 py-4 text-sm text-gray-500 whitespace-nowrap">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-4 text-sm text-gray-500 whitespace-nowrap">{{ $product->stock }}</td>
                                <td class="px-4 py-4 text-sm text-gray-500 whitespace-nowrap">
                                    {{ $product->category->category_name }}
                                </td>
                                <td class="px-4 py-4 text-sm text-gray-500">
                                    <div class="line-clamp-2"> {{-- Changed to show 2 lines --}}
                                        {{ $product->description }}
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-sm font-medium text-right whitespace-nowrap">
                                    <div class="flex justify-end space-x-3"> {{-- Increased space between icons --}}
                                        <a href="{{ route('admin_jasa.pages.products.edit', $product->product_id) }}"
                                            class="p-1 text-indigo-600 transition-colors rounded hover:text-indigo-900 hover:bg-indigo-50"
                                            title="Edit">
                                            <iconify-icon icon="uil:edit" width="20"></iconify-icon>
                                            {{-- Increased icon size --}}
                                        </a>
                                        <a href="{{ route('admin_jasa.pages.products.detail', $product->product_id) }}"
                                            class="p-1 text-blue-600 transition-colors rounded hover:text-blue-900 hover:bg-blue-50"
                                            title="View Detail">
                                            <iconify-icon icon="mdi:eye-outline" width="20"></iconify-icon>
                                        </a>
                                        <form action="{{ route('admin_jasa.pages.products.destroy', $product->product_id) }}"
                                            method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-1 text-red-600 transition-colors rounded hover:text-red-900 hover:bg-red-50"
                                                title="Delete" onclick="return confirm('Are you sure?')">
                                                <iconify-icon icon="mdi:delete-outline" width="20"></iconify-icon>
                                                {{-- Increased icon size --}}
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-4 text-sm text-center text-gray-500">
                                    No products found in "jasa" category
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($products->hasPages())
                <div class="px-4 py-3 border-t">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js "></script>
    <script>
        // Confirm before deleting
        document.addEventListener('DOMContentLoaded', function() {
            const deleteForms = document.querySelectorAll('form[action*="destroy"]');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    if (!confirm('Are you sure you want to delete this product?')) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>
@endpush
