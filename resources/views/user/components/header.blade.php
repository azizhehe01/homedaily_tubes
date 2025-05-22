<header class="container flex items-center justify-between px-4 py-4 mx-auto">
    <a href="/" class="flex items-center gap-2">
        <img src="{{ asset('assets/images/iconlogo.svg') }}" alt="HomeDaily Logo" class="w-10 h-10">
        <span class="text-xl font-bold">HomeDaily</span>
    </a>
    <nav class="items-center hidden gap-8 md:flex">
        <a href="/"
            class="font-medium {{ request()->is('/') ? 'text-orange-600' : 'text-gray-900' }} hover:text-orange-600">Home</a>
        <a href="/produk"
            class="font-medium {{ request()->is('produk*') ? 'text-orange-600' : 'text-gray-900' }} hover:text-orange-600">Produk</a>
        <a href="/jasa"
            class="font-medium {{ request()->is('jasa*') ? 'text-orange-600' : 'text-gray-900' }} hover:text-orange-600">Jasa</a>
        <a href="/about-us"
            class="font-medium {{ request()->is('about-us*') ? 'text-orange-600' : 'text-gray-900' }} hover:text-orange-600">About
            Us</a>

        @guest
            <div class="flex items-center gap-4">
                <a href="{{ route('login') }}"
                    class="px-4 py-2 font-medium text-white transition-colors bg-orange-600 rounded-lg hover:bg-orange-700">
                    Login
                </a>
                <a href="{{ route('register') }}"
                    class="px-4 py-2 font-medium text-orange-600 transition-colors border border-orange-600 rounded-lg hover:bg-orange-50">
                    Register
                </a>
            </div>
        @else
            <div class="flex items-center gap-4">
                <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}"
                    class="w-10 h-10 rounded-full">
                <span class="font-medium text-gray-900">{{ Auth::user()->name }}</span>
            </div>
        @endguest
    </nav>
</header>
