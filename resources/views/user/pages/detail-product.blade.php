@include('user.components.head')
@extends('user.components.layout') 


@section('content')
    <!-- Breadcrumb -->
    <div class="container mx-auto px-4 py-4 flex items-center gap-2 text-sm text-gray-500">
        <a href="/">Home</a>
        <span>/</span>
        <a href="/furniture">Furniture</a>
        <span>/</span>
        <span class="text-gray-700">Modern Sofa</span>
    </div>

    <!-- Product Title -->
    <div class="container mx-auto px-4 text-center mb-8">
        <h1 class="text-3xl font-bold text-[#152c5b] mb-1">Modern Comfort Sofa</h1>
        <p class="text-gray-500">Premium Quality | Handcrafted</p>
    </div>

    <!-- Product Images -->
    <div class="container mx-auto px-4 mb-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="md:col-span-2">
                <img src="https://placehold.co/600x400" alt="Modern Sofa Main View" class="w-full h-full object-cover rounded-lg">
            </div>
            <div class="grid grid-rows-2 gap-4">
                <img src="https://placehold.co/300x200" alt="Modern Sofa Side View" class="w-full h-full object-cover rounded-lg">
                <img src="https://placehold.co/300x200" alt="Modern Sofa Detail View" class="w-full h-full object-cover rounded-lg">
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column -->
            <div class="lg:col-span-2">
        <div class="mb-10">
          <h2 class="text-xl font-bold text-[#152c5b] mb-4">About this furniture</h2>
          <div class="text-gray-500 space-y-4">
            <p>
              This modern sofa combines comfort with contemporary design. Featuring premium upholstery and expert
              craftsmanship, it's designed to be the centerpiece of your living space. The clean lines and
              minimalist aesthetic make it versatile enough to complement any interior style.
            </p>
            <p>
              The frame is constructed from kiln-dried hardwood for durability, while the cushions are filled with
              high-density foam wrapped in a layer of feather and down for the perfect balance of support and
              softness. The legs are made from solid walnut with a natural finish that showcases the beautiful grain
              of the wood.
            </p>
            <p>
              Available in multiple fabric options, this sofa can be customized to suit your personal style. The
              modular design allows for flexible arrangement, making it ideal for both small apartments and spacious
              homes.
            </p>
          </div>
        </div>

        <!-- Features -->
        <div class="grid grid-cols-2 md:grid-cols-3 gap-6 mb-10">
          <div class="flex flex-col items-center">
            <div class="w-12 h-12 rounded-full bg-[#f5f6f8] flex items-center justify-center mb-2">
              <i data-lucide="check" class="text-[#152c5b]"></i>
            </div>
            <p class="font-medium text-[#152c5b]">Premium Fabric</p>
          </div>
          <div class="flex flex-col items-center">
            <div class="w-12 h-12 rounded-full bg-[#f5f6f8] flex items-center justify-center mb-2">
              <i data-lucide="check" class="text-[#152c5b]"></i>
            </div>
            <p class="font-medium text-[#152c5b]">Solid Wood Frame</p>
          </div>
          <div class="flex flex-col items-center">
            <div class="w-12 h-12 rounded-full bg-[#f5f6f8] flex items-center justify-center mb-2">
              <i data-lucide="check" class="text-[#152c5b]"></i>
            </div>
            <p class="font-medium text-[#152c5b]">Ergonomic Design</p>
          </div>
          <div class="flex flex-col items-center">
            <div class="w-12 h-12 rounded-full bg-[#f5f6f8] flex items-center justify-center mb-2">
              <i data-lucide="check" class="text-[#152c5b]"></i>
            </div>
            <p class="font-medium text-[#152c5b]">Easy Assembly</p>
          </div>
          <div class="flex flex-col items-center">
            <div class="w-12 h-12 rounded-full bg-[#f5f6f8] flex items-center justify-center mb-2">
              <i data-lucide="check" class="text-[#152c5b]"></i>
            </div>
            <p class="font-medium text-[#152c5b]">Stain Resistant</p>
          </div>
          <div class="flex flex-col items-center">
            <div class="w-12 h-12 rounded-full bg-[#f5f6f8] flex items-center justify-center mb-2">
              <i data-lucide="check" class="text-[#152c5b]"></i>
            </div>
            <p class="font-medium text-[#152c5b]">5-Year Warranty</p>
          </div>
        </div>

        <!-- Specifications -->
        <div class="mb-10">
          <h2 class="text-xl font-bold text-[#152c5b] mb-4">Specifications</h2>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="border border-gray-200 rounded-lg p-4">
              <h3 class="font-medium text-[#152c5b] mb-2">Dimensions</h3>
              <ul class="text-gray-500 space-y-1">
                <li>Width: 220 cm</li>
                <li>Depth: 95 cm</li>
                <li>Height: 85 cm</li>
                <li>Seat Height: 45 cm</li>
              </ul>
            </div>
            <div class="border border-gray-200 rounded-lg p-4">
              <h3 class="font-medium text-[#152c5b] mb-2">Materials</h3>
              <ul class="text-gray-500 space-y-1">
                <li>Frame: Kiln-dried hardwood</li>
                <li>Upholstery: 100% polyester</li>
                <li>Cushion: High-density foam</li>
                <li>Legs: Solid walnut</li>
              </ul>
            </div>
          </div>
        </div>

        <!-- You May Also Like -->
        <div class="mb-10">
          <h2 class="text-xl font-bold text-[#152c5b] mb-6">You May Also Like</h2>
          <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="relative">
              <img
                src="https://placehold.co/200x150"
                alt="Coffee Table"
                class="w-full h-32 object-cover rounded-lg"
              />
              <div class="mt-2">
                <h3 class="font-medium text-[#152c5b]">Coffee Table</h3>
                <p class="text-sm text-gray-500">Rp 1,200,000</p>
              </div>
            </div>
            <div class="relative">
              <img
                src="https://placehold.co/200x150"
                alt="Side Table"
                class="w-full h-32 object-cover rounded-lg"
              />
              <div class="mt-2">
                <h3 class="font-medium text-[#152c5b]">Side Table</h3>
                <p class="text-sm text-gray-500">Rp 850,000</p>
              </div>
            </div>
            <div class="relative">
              <img
                src="https://placehold.co/200x150"
                alt="Floor Lamp"
                class="w-full h-32 object-cover rounded-lg"
              />
              <div class="absolute top-2 left-2 bg-[#ea8c00] text-white text-xs px-2 py-1 rounded">Sale</div>
              <div class="mt-2">
                <h3 class="font-medium text-[#152c5b]">Floor Lamp</h3>
                <p class="text-sm text-gray-500">Rp 750,000</p>
              </div>
            </div>
            <div class="relative">
              <img
                src="https://placehold.co/200x150"
                alt="Throw Pillows"
                class="w-full h-32 object-cover rounded-lg"
              />
              <div class="mt-2">
                <h3 class="font-medium text-[#152c5b]">Throw Pillows</h3>
                <p class="text-sm text-gray-500">Rp 350,000</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Testimonial -->
        <div class="border border-gray-200 rounded-2xl p-6 mb-10 relative">
          <div class="flex flex-col md:flex-row gap-6">
            <div class="w-full md:w-1/3">
              <img
                src="https://placehold.co/250x300"
                alt="Happy Customer"
                class="w-full h-64 object-cover rounded-2xl"
              />
            </div>
            <div class="w-full md:w-2/3 flex flex-col justify-center">
              <h3 class="text-xl font-bold text-[#152c5b] mb-2">Satisfied Customer</h3>
              <div class="flex mb-2">
                <svg class="w-5 h-5 text-[#ffcc47]" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
                <svg class="w-5 h-5 text-[#ffcc47]" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
                <svg class="w-5 h-5 text-[#ffcc47]" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
                <svg class="w-5 h-5 text-[#ffcc47]" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
                <svg class="w-5 h-5 text-[#ffcc47]" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
              </div>
              <p class="text-[#152c5b] text-lg font-medium mb-2">
                This sofa completely transformed my living room. The quality is exceptional and it's even more
                comfortable than I expected!
              </p>
              <p class="text-gray-500 mb-4">Anggi, Interior Designer</p>
              <button class="bg-[#ea8c00] text-white px-4 py-2 rounded w-40">Read Full Review</button>
            </div>
          </div>
        </div>
            </div>

            <!-- Right Column - Purchase Card -->
            <div class="lg:col-span-1">
                <div class="sticky top-4 bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
          <h2 class="text-lg font-medium text-gray-500 mb-2">Price</h2>
          <h3 class="text-[#ea8c00] text-2xl font-bold mb-6">Rp 4,280,000</h3>

          <div class="mb-6">
            <p class="text-[#152c5b] font-medium mb-2">Quantity</p>
            <div class="flex items-center">
              <button id="decreaseBtn" class="w-8 h-8 bg-[#e74c3c] text-white flex items-center justify-center rounded">
                <i data-lucide="minus" class="w-4 h-4"></i>
              </button>
              <div id="quantityDisplay" class="w-12 h-8 flex items-center justify-center border-t border-b border-gray-300">1</div>
              <button id="increaseBtn" class="w-8 h-8 bg-[#1abc9c] text-white flex items-center justify-center rounded">
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

          <div class="flex gap-3 mb-6">
            <button class="flex-1 bg-[#ea8c00] text-white py-3 rounded-md font-medium">Add to Cart</button>
            <button class="flex-1 border border-[#ea8c00] text-[#ea8c00] py-3 rounded-md font-medium">
              Buy Now
            </button>
          </div>

          <div class="text-sm text-gray-500">
            <p>Usually ships within 3-5 business days</p>
          </div>
        </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const decreaseBtn = document.getElementById('decreaseBtn');
        const increaseBtn = document.getElementById('increaseBtn');
        const quantityDisplay = document.getElementById('quantityDisplay');
        let quantity = 1;

        decreaseBtn.addEventListener('click', function() {
            if (quantity > 1) {
                quantity--;
                quantityDisplay.textContent = quantity;
            }
        });

        increaseBtn.addEventListener('click', function() {
            quantity++;
            quantityDisplay.textContent = quantity;
        });

        // Initialize Lucide icons
        lucide.createIcons();
    });
</script>
@endsection