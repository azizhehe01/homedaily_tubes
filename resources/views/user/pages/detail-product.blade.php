@extends('user.components.layout')

@section('content')
    <!-- Breadcrumb -->
    <div class="container flex items-center gap-2 px-4 py-4 mx-auto text-sm text-gray-500">
        <a href="/">Home</a>
        <span>/</span>
        <a href="/furniture">Furniture</a>
        <span>/</span>
        <span class="text-gray-700">{{ $product->name }}</span>
    </div>

    <!-- Product Title -->
    <div class="container px-4 mx-auto mb-8 text-center">
        <h1 class="text-3xl font-bold text-[#152c5b] mb-1">{{ $product->name }}</h1>
        <p class="text-gray-500">Premium Quality | {{ $product->category->category_name ?? 'Uncategorized' }}</p>
    </div>

    <!-- Product Images -->
    <div class="container px-4 mx-auto mb-12">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
            <!-- Main Image (Primary) -->
            <div class="md:col-span-2">
                @if ($primaryImage = $product->images->where('is_primary', true)->first())
                    <img src="{{ asset('storage/' . $primaryImage->path) }}" alt="{{ $product->name }}"
                        class="object-cover w-full h-[500px] rounded-lg border-gray" id="mainProductImage">
                @elseif($product->images->first())
                    <img src="{{ asset('storage/' . $product->images->first()->path) }}" alt="{{ $product->name }}"
                        class="object-cover w-full h-[500] rounded-lg border-gray" id="mainProductImage">
                @else
                    <div class="flex items-center justify-center w-full h-64 bg-gray-100 rounded-lg">
                        <span class="text-gray-500">No Image Available</span>
                    </div>
                @endif
            </div>

            <!-- Thumbnail Gallery -->
            <div class="grid grid-rows-2 gap-4">
                @foreach ($product->images->where('is_primary', false)->take(2) as $image)
                    <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $product->name }} - {{ $loop->iteration }}"
                        class="object-cover w-full h-[245px] rounded-lg cursor-pointer hover:opacity-90 transition-opacity"
                        onclick="document.getElementById('mainProductImage').src = this.src">
                @endforeach

                <!-- Fallback if less than 2 additional images -->
                @for ($i = 0; $i < 2 - $product->images->where('is_primary', false)->count(); $i++)
                    <div class="flex items-center justify-center bg-gray-100 rounded-lg">
                        <span class="text-gray-500">No Image</span>
                    </div>
                @endfor
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container px-4 mx-auto">
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
            <!-- Left Column -->
            <div class="lg:col-span-2">
                <!-- About Product -->
                <div class="mb-10">
                    <h2 class="text-xl font-bold text-[#152c5b] mb-4">About this product</h2>
                    <div class="space-y-4 text-gray-500">
                        <p>{{ $product->description ?? 'No description available' }}</p>
                    </div>
                </div>

                <!-- Features -->
                <div class="grid grid-cols-2 gap-6 mb-10 md:grid-cols-3">
                    @foreach (['Premium Quality', 'Solid Material', 'Modern Design', 'Easy Assembly', 'Long Lasting', 'Warranty'] as $feature)
                        <div class="flex flex-col items-center">
                            <div class="w-12 h-12 rounded-full bg-[#f5f6f8] flex items-center justify-center mb-2">
                                <i data-lucide="check" class="text-[#152c5b]"></i>
                            </div>
                            <p class="font-medium text-[#152c5b]">{{ $feature }}</p>
                        </div>
                    @endforeach
                </div>

                <!-- Similar Products -->
                <div class="mb-10">
                    <h2 class="text-xl font-bold text-[#152c5b] mb-6">Similar Products</h2>
                    <div class="grid grid-cols-2 gap-4 md:grid-cols-4">
                        @forelse($recommendedProducts as $relatedProduct)
                            <a href="{{ route('user.product.detail', $relatedProduct->product_id) }}"
                                class="block transition-transform hover:scale-105">
                                @if ($primaryImage = $relatedProduct->images->where('is_primary', true)->first())
                                    <img src="{{ asset('storage/' . $primaryImage->path) }}"
                                        alt="{{ $relatedProduct->name }}" class="object-cover w-full h-32 rounded-lg">
                                @else
                                    <div class="flex items-center justify-center w-full h-32 bg-gray-200 rounded-lg">
                                        <span class="text-gray-500">No Image</span>
                                    </div>
                                @endif
                                <div class="mt-2">
                                    <h3 class="font-medium text-[#152c5b] truncate">{{ $relatedProduct->name }}</h3>
                                    <p class="text-sm text-gray-500">
                                        Rp {{ number_format($relatedProduct->price, 0, ',', '.') }}
                                    </p>
                                </div>
                            </a>
                        @empty
                            <div class="col-span-full text-center py-8">
                                <p class="text-gray-500">Tidak ada produk sejenis lainnya</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Right Column - Purchase Card -->
            <div class="lg:col-span-1">
                <div class="sticky p-6 bg-white border border-gray-200 shadow-sm top-4 rounded-2xl">
                    <h2 class="mb-2 text-lg font-medium text-gray-500">Price</h2>
                    <h3 class="text-[#ea8c00] text-2xl font-bold mb-6">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </h3>

                    <div class="mb-6">
                        <p class="text-[#152c5b] font-medium mb-2">Stock Available</p>
                        <p class="{{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                            {{ $product->stock > 0 ? 'In Stock (' . $product->stock . ' units)' : 'Out of Stock' }}
                        </p>
                    </div>

                    <div class="mb-6">
                        <p class="text-[#152c5b] font-medium mb-2">Quantity</p>
                        <div class="flex items-center">
                            <button id="decreaseBtn"
                                class="w-8 h-8 bg-[#e74c3c] text-white flex items-center justify-center rounded">
                                <i data-lucide="minus" class="w-4 h-4"></i>
                            </button>
                            <div id="quantityDisplay"
                                class="flex items-center justify-center w-12 h-8 border-t border-b border-gray-300">1</div>
                            <button id="increaseBtn"
                                class="w-8 h-8 bg-[#1abc9c] text-white flex items-center justify-center rounded">
                                <i data-lucide="plus" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </div>

                    <form action="{{ route('booking.create') }}" method="POST" class="flex gap-3 mb-6">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                        <input type="hidden" name="quantity" id="quantityInput" value="1">
                        <button type="submit"
                            class="w-full border border-[#ea8c00] text-[#ea8c00] py-3 rounded-md font-medium hover:bg-[#fff5e6] transition-colors">
                            Buy Now
                        </button>
                    </form>

                    <div class="text-sm text-gray-500">
                        <p>Usually ships within 3-5 business days</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @auth
        @include('user.components.chat-bubble')
    @endauth
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Quantity control
            const decreaseBtn = document.getElementById('decreaseBtn');
            const increaseBtn = document.getElementById('increaseBtn');
            const quantityDisplay = document.getElementById('quantityDisplay');
            const quantityInput = document.getElementById('quantityInput');
            let quantity = 1;

            decreaseBtn.addEventListener('click', function() {
                if (quantity > 1) {
                    quantity--;
                    quantityDisplay.textContent = quantity;
                    quantityInput.value = quantity;
                }
            });

            increaseBtn.addEventListener('click', function() {
                quantity++;
                quantityDisplay.textContent = quantity;
                quantityInput.value = quantity;
            });

            // Initialize Lucide icons
            lucide.createIcons();
        });
    </script>
@endsection
