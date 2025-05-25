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
                @if($primaryImage = $product->images->where('is_primary', true)->first())
                    <img src="{{ asset('storage/' . $primaryImage->path) }}" 
                         alt="{{ $product->name }}"
                         class="object-cover w-full h-full rounded-lg"
                         id="mainProductImage">
                @elseif($product->images->first())
                    <img src="{{ asset('storage/' . $product->images->first()->path) }}" 
                         alt="{{ $product->name }}"
                         class="object-cover w-full h-full rounded-lg"
                         id="mainProductImage">
                @else
                    <div class="flex items-center justify-center w-full h-64 bg-gray-100 rounded-lg">
                        <span class="text-gray-500">No Image Available</span>
                    </div>
                @endif
            </div>
            
            <!-- Thumbnail Gallery -->
            <div class="grid grid-rows-2 gap-4">
                @foreach($product->images->where('is_primary', false)->take(2) as $image)
                    <img src="{{ asset('storage/' . $image->path) }}" 
                         alt="{{ $product->name }} - {{ $loop->iteration }}"
                         class="object-cover w-full h-full rounded-lg cursor-pointer hover:opacity-90 transition-opacity"
                         onclick="document.getElementById('mainProductImage').src = this.src">
                @endforeach
                
                <!-- Fallback if less than 2 additional images -->
                @for($i = 0; $i < 2 - $product->images->where('is_primary', false)->count(); $i++)
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
                <div class="mb-10">
                    <h2 class="text-xl font-bold text-[#152c5b] mb-4">About this furniture</h2>
                    <div class="space-y-4 text-gray-500">
                        <p>{{ $product->description ?? 'No description available' }}</p>
                    </div>
                </div>

                <!-- Features -->
                <div class="grid grid-cols-2 gap-6 mb-10 md:grid-cols-3">
                    @foreach([
                        'Premium Fabric',
                        'Solid Wood Frame', 
                        'Ergonomic Design',
                        'Easy Assembly',
                        'Stain Resistant',
                        '5-Year Warranty'
                    ] as $feature)
                        <div class="flex flex-col items-center">
                            <div class="w-12 h-12 rounded-full bg-[#f5f6f8] flex items-center justify-center mb-2">
                                <i data-lucide="check" class="text-[#152c5b]"></i>
                            </div>
                            <p class="font-medium text-[#152c5b]">{{ $feature }}</p>
                        </div>
                    @endforeach
                </div>

                <!-- Specifications -->
                <div class="mb-10">
                    <h2 class="text-xl font-bold text-[#152c5b] mb-4">Specifications</h2>
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div class="p-4 border border-gray-200 rounded-lg">
                            <h3 class="font-medium text-[#152c5b] mb-2">Dimensions</h3>
                            <ul class="space-y-1 text-gray-500">
                                <li>Width: {{ $product->width ?? 'N/A' }} cm</li>
                                <li>Depth: {{ $product->depth ?? 'N/A' }} cm</li>
                                <li>Height: {{ $product->height ?? 'N/A' }} cm</li>
                                <li>Weight: {{ $product->weight ?? 'N/A' }} kg</li>
                            </ul>
                        </div>
                        <div class="p-4 border border-gray-200 rounded-lg">
                            <h3 class="font-medium text-[#152c5b] mb-2">Materials</h3>
                            <ul class="space-y-1 text-gray-500">
                                <li>Frame: {{ $product->frame_material ?? 'N/A' }}</li>
                                <li>Upholstery: {{ $product->upholstery_material ?? 'N/A' }}</li>
                                <li>Cushion: {{ $product->cushion_material ?? 'N/A' }}</li>
                                <li>Legs: {{ $product->legs_material ?? 'N/A' }}</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- You May Also Like -->
                <div class="mb-10">
                    <h2 class="text-xl font-bold text-[#152c5b] mb-6">Anda juga suka ini</h2>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @forelse($recommendedProducts as $relatedProduct)
                            <a href="{{ route('user.product.detail', $relatedProduct->product_id) }}" class="relative block">
                                @if ($primaryImage = $relatedProduct->images->where('is_primary', true)->first())
                                    <img src="{{ asset('storage/' . $primaryImage->path) }}"
                                        alt="{{ $relatedProduct->name }}" 
                                        class="w-full h-32 object-cover rounded-lg">
                                @elseif($relatedProduct->images->first())
                                    <img src="{{ asset('storage/' . $relatedProduct->images->first()->path) }}"
                                        alt="{{ $relatedProduct->name }}" 
                                        class="w-full h-32 object-cover rounded-lg">
                                @else
                                    <div class="w-full h-32 bg-gray-200 rounded-lg flex items-center justify-center">
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

                <!-- Testimonial -->
                <div class="relative p-6 mb-10 border border-gray-200 rounded-2xl">
                    <div class="flex flex-col gap-6 md:flex-row">
                        <div class="w-full md:w-1/3">
                            <img src="https://placehold.co/250x300" alt="Happy Customer"
                                class="object-cover w-full h-64 rounded-2xl" />
                        </div>
                        <div class="flex flex-col justify-center w-full md:w-2/3">
                            <h3 class="text-xl font-bold text-[#152c5b] mb-2">Satisfied Customer</h3>
                            <div class="flex mb-2">
                                @for($i = 0; $i < 5; $i++)
                                <svg class="w-5 h-5 text-[#ffcc47]" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                @endfor
                            </div>
                            <p class="text-[#152c5b] text-lg font-medium mb-2">
                                This product completely transformed my space. The quality is exceptional and it's even more
                                comfortable than I expected!
                            </p>
                            <p class="mb-4 text-gray-500">Happy Customer</p>
                            <button class="bg-[#ea8c00] text-white px-4 py-2 rounded w-40">Read Full Review</button>
                        </div>
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

                    <div class="mb-6">
                        <div class="flex items-center gap-2 mb-3">
                            <i data-lucide="truck" class="w-5 h-5 text-[#152c5b]"></i>
                            <span class="text-[#152c5b] font-medium">Free Shipping</span>
                        </div>
                        <div class="flex items-center gap-2 mb-3">
                            <i data-lucide="refresh-cw" class="w-5 h-5 text-[#152c5b]"></i>
                            <span class="text-[#152c5b] font-medium">30-Day Returns</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i data-lucide="shield" class="w-5 h-5 text-[#152c5b]"></i>
                            <span class="text-[#152c5b] font-medium">5-Year Warranty</span>
                        </div>
                    </div>

                    <form class="flex gap-3 mb-6" action="#" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                        <input type="hidden" name="quantity" id="quantityInput" value="1">
                        <button type="submit" class="flex-1 bg-[#ea8c00] text-white py-3 rounded-md font-medium hover:bg-[#d17d00] transition-colors">
                            Add to Cart
                        </button>
                        <button type="button" class="flex-1 border border-[#ea8c00] text-[#ea8c00] py-3 rounded-md font-medium hover:bg-[#fff5e6] transition-colors">
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
            
            // Thumbnail click handler
            document.querySelectorAll('.thumbnail').forEach(thumb => {
                thumb.addEventListener('click', function() {
                    document.getElementById('mainProductImage').src = this.src;
                });
            });
        });
    </script>
@endsection