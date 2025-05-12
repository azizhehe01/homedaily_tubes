@extends('admin.layouts.app')

@section('title', 'Products List')

@section('content')
    <div class="container-fluid py-6 px-4">  {{-- Changed to container-fluid and added px-4 --}}
        @include('admin.layouts.page-title', [
            'title' => 'Products List',
            'subtitle' => 'Manage your products',
        ])

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-50 text-green-700 border border-green-200 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="p-4 flex justify-between items-center border-b">
                <div class="flex-1">
                    <h3 class="text-lg font-medium text-default-700">All Products</h3>
                </div>
                <div>
                    <a href="{{ route('admin.pages.input-products') }}" 
                       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                        <iconify-icon icon="material-symbols:add" class="mr-1"></iconify-icon>
                        Add Product
                    </a>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full divide-y divide-gray-200">  {{-- Changed min-w-full to w-full --}}
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-16">ID</th>  {{-- Added fixed width --}}
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-48">Name</th>  {{-- Added fixed width --}}
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-20">Image</th>  {{-- Added fixed width --}}
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-32">Price</th>  {{-- Added fixed width --}}
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-24">Stock</th>  {{-- Added fixed width --}}
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-40">Category</th>  {{-- Added fixed width --}}
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                            <th scope="col" class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider w-24">Actions</th>  {{-- Added fixed width --}}
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($products as $product)
                            <tr>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">{{ $product->product_id }}</td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $product->name }}</td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    @if($product->image)
                                        <img src="{{ asset('storage/'.$product->image) }}" alt="Product Image" class="h-12 w-12 object-cover rounded-md">
                                    @else
                                        <span class="text-sm text-gray-400 italic">No image</span>
                                    @endif
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">{{ $product->stock }}</td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $product->category->category_name ?? 'N/A' }}
                                </td>
                                <td class="px-4 py-4 text-sm text-gray-500">
                                    <div class="line-clamp-2">  {{-- Changed to show 2 lines --}}
                                        {{ $product->description }}
                                    </div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-3">  {{-- Increased space between icons --}}
                                        <a href="{{ route('admin.pages.products.edit', $product->product_id) }}" 
                                           class="p-1 text-indigo-600 hover:text-indigo-900 transition-colors rounded hover:bg-indigo-50"
                                           title="Edit">
                                            <iconify-icon icon="uil:edit" width="20"></iconify-icon>  {{-- Increased icon size --}}
                                        </a>
                                        <form action="{{ route('admin.pages.products.destroy', $product->product_id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1 text-red-600 hover:text-red-900 transition-colors rounded hover:bg-red-50" title="Delete" onclick="return confirm('Are you sure?')">
                                                <iconify-icon icon="mdi:delete-outline" width="20"></iconify-icon>  {{-- Increased icon size --}}
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-4 text-center text-sm text-gray-500">
                                    No products found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($products->hasPages())
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
        document.addEventListener('DOMContentLoaded', function () {
            const deleteForms = document.querySelectorAll('form[action*="destroy"]');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function (e) {
                    if (!confirm('Are you sure you want to delete this product?')) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>
@endpush