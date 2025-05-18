<!DOCTYPE html>
<html lang="en">
@include('user.components.head')
<body class="min-h-screen bg-white">
    <!-- Header -->
    <header class="container mx-auto px-4 py-4 flex items-center justify-between">
        <a href="/" class="flex items-center gap-2">
            <img src="{{ asset('assets/images/iconlogo.svg') }}" alt="HomeDaily Logo" class="w-10 h-10">
            <span class="font-bold text-xl">HomeDaily</span>
        </a>
        <nav class="hidden md:flex items-center gap-8">
            <a href="/" class="text-[#ea8c00] font-medium">Home</a>
            <a href="/produk" class="text-gray-700 font-medium">Produk</a>
            <a href="/jasa" class="text-gray-700 font-medium">Jasa</a>
            <a href="/about-us" class="text-gray-700 font-medium">About Us</a>
            <a href="{{ route('login') }}" 
                class="text-[#ea8c00] font-medium">
                Login
            </a>
        </nav>
    </header>

    @yield('content')

    <!-- Footer -->
    <footer class="container mx-auto px-4 py-16 mt-16 border-t border-gray-200">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <h3 class="text-[#152c5b] font-bold text-xl mb-4">
                    Home<span class="text-[#ea8c00]">Daily</span>
                </h3>
                <p class="text-gray-500 mb-2">Quality furniture for your everyday living.</p>
            </div>

            <div>
                <h3 class="text-[#152c5b] font-medium mb-4">Shop</h3>
                <ul class="space-y-2 text-gray-500">
                    <li>New Arrivals</li>
                    <li>Best Sellers</li>
                    <li>Discounts & Deals</li>
                </ul>
            </div>

            <div>
                <h3 class="text-[#152c5b] font-medium mb-4">About Us</h3>
                <ul class="space-y-2 text-gray-500">
                    <li>Our Story</li>
                    <li>Sustainability</li>
                    <li>Terms & Conditions</li>
                </ul>
            </div>

            <div>
                <h3 class="text-[#152c5b] font-medium mb-4">Customer Service</h3>
                <p class="text-gray-500 mb-2">support@homedaily.id</p>
                <p class="text-gray-500 mb-2">021 - 2208 - 1996</p>
                <p class="text-gray-500">HomeDaily, Kemang, Jakarta</p>
            </div>
        </div>

        <div class="text-center text-gray-500 text-sm mt-16">Copyright 2023 • All rights reserved • HomeDaily</div>
    </footer>

    @yield('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            lucide.createIcons();
        });
    </script>
</body>
</html>