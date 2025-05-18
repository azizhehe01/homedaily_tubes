{{-- <!-- Topbar Start -->
<header class="flex items-center h-16 bg-white app-header md:hidden lg:bg-opacity-10 backdrop-blur-sm">
    <div class="container flex items-center gap-4">
        <!-- Topbar Brand Logo -->
        <a href="{{ route('admin.dashboard') }}" class="flex md:hidden">
            <img src="{{ asset('assets/images/logo-small.png') }}" class="h-6" alt="Small logo">
        </a>

        <!-- Sidenav Menu Toggle Button -->
        <button id="button-toggle-menu" class="p-2 rounded-full cursor-pointer text-default-500 hover:text-default-600"
            data-hs-overlay="#app-menu" aria-label="Toggle navigation">
            <i class="text-2xl i-tabler-menu-2"></i>
        </button>

        <!-- Language Dropdown Button -->
        <div class="ms-auto hs-dropdown relative inline-flex [--placement:bottom-right]">
            <button type="button" class="inline-flex items-center hs-dropdown-toggle">
                <img src="{{ asset('assets/images/flags/us.jpg') }}" alt="user-image" class="w-6 h-4">
            </button>

            <div
                class="hs-dropdown-menu duration mt-2 min-w-48 rounded-lg border border-default-200 bg-white p-2 opacity-0 shadow-md transition-[opacity,margin] hs-dropdown-open:opacity-100 hidden">
                @foreach (['germany', 'italy', 'spain', 'russia'] as $country)
                    <a href="#"
                        class="flex items-center gap-2.5 py-2 px-3 rounded-md text-sm text-default-800 hover:bg-gray-100">
                        <img src="{{ asset("assets/images/flags/{$country}.jpg") }}" alt="{{ $country }} flag"
                            class="h-4">
                        <span class="align-middle">{{ ucfirst($country) }}</span>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Fullscreen Toggle Button -->
        <div class="hidden md:flex">
            <button data-toggle="fullscreen" type="button" class="p-2 nav-link">
                <span class="sr-only">Fullscreen Mode</span>
                <span class="flex items-center justify-center size-6">
                    <i class="i-tabler-maximize text-2xl flex group-[-fullscreen]:hidden"></i>
                    <i class="i-tabler-minimize text-2xl hidden group-[-fullscreen]:flex"></i>
                </span>
            </button>
        </div>

        <!-- Profile Dropdown Button -->
        <div class="relative">
            <div class="hs-dropdown relative inline-flex [--placement:bottom-right]">
                <button type="button" class="flex items-center gap-2 hs-dropdown-toggle nav-link">
                    <img src="{{ asset('assets/images/users/avatar-4.jpg') }}" alt="user-image"
                        class="h-10 rounded-full">
                    <span>{{ Auth::user()->name ?? 'User' }}</span>
                    <i class="text-sm i-tabler-chevron-down ms-2"></i>
                </button>
                <div
                    class="hs-dropdown-menu duration mt-2 min-w-48 rounded-lg border border-default-200 bg-white p-2 opacity-0 shadow-md transition-[opacity,margin] hs-dropdown-open:opacity-100 hidden">
                    <a href="{{ route('admin.profile') }}"
                        class="flex items-center px-3 py-2 text-sm rounded-md text-default-800 hover:bg-gray-100">
                        Profile
                    </a>
                    <a href="{{ route('admin.settings') }}"
                        class="flex items-center px-3 py-2 text-sm rounded-md text-default-800 hover:bg-gray-100">
                        Settings
                    </a>
                    <hr class="my-2">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="flex items-center w-full px-3 py-2 text-sm rounded-md text-default-800 hover:bg-gray-100">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Topbar End --> --}}
