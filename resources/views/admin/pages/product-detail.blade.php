@extends('admin.layouts.app')

@section('title', 'Product Detail')

@section('content')
    <div class="container-fluid py-6 px-4">
        @include('admin.layouts.page-title', [
            'title' => 'Product Detail',
            'subtitle' => 'Detailed information about the product',
        ])

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-50 text-green-700 border border-green-200 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <!-- Back Button -->
            <div class="p-4 border-b">
                <a href="{{ route('admin.pages.products') }}" 
                   class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-300 transition-colors">
                    <iconify-icon icon="mdi:arrow-left" class="mr-1"></iconify-icon>
                    Back to Products
                </a>
            </div>

            <!-- Product Detail Content -->
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Product Image -->
                <div class="bg-gray-50 rounded-lg p-4 flex justify-center items-center">
                    @if($product->image)
                        <img src="{{ asset('storage/'.$product->image) }}" 
                             alt="Product Image" 
                             class="h-64 w-full object-contain rounded-md">
                    @else
                        <div class="text-center text-gray-400 italic">
                            <iconify-icon icon="mdi:image-off" width="48"></iconify-icon>
                            <p>No image available</p>
                        </div>
                    @endif
                </div>

                <!-- Product Information -->
                <div class="space-y-6">
                    <!-- Basic Info -->
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">{{ $product->name }}</h2>
                        <p class="text-lg text-blue-600 font-semibold mt-2">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </p>
                    </div>

                    <!-- Stock & Category -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Stock</p>
                            <p class="text-lg font-medium {{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                                {{ $product->stock }} {{ $product->stock > 0 ? 'available' : 'out of stock' }}
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Category</p>
                            <p class="text-lg font-medium text-gray-900">
                                {{ $product->category->category_name ?? 'Uncategorized' }}
                            </p>
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <p class="text-sm text-gray-500 mb-2">Description</p>
                        <div class="prose max-w-none text-gray-700">
                            {!! nl2br(e($product->description)) !!}
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex space-x-4 pt-4">
                        <a href="{{ route('admin.pages.products.edit', $product->product_id) }}" 
                           class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors">
                            <iconify-icon icon="uil:edit" class="mr-1"></iconify-icon>
                            Edit Product
                        </a>
                        <form action="{{ route('admin.pages.products.destroy', $product->product_id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition-colors"
                                    onclick="return confirm('Are you sure you want to delete this product?')">
                                <iconify-icon icon="mdi:delete-outline" class="mr-1"></iconify-icon>
                                Delete Product
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Additional Information Section -->
            <div class="p-6 border-t">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Additional Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-500">Product ID</p>
                        <p class="font-medium">{{ $product->product_id }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-500">Created At</p>
                        <p class="font-medium">{{ $product->created_at->format('d M Y H:i') }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-500">Last Updated</p>
                        <p class="font-medium">{{ $product->updated_at->format('d M Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
@endpush