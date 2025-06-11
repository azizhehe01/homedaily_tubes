<!-- Start Sidebar -->
<aside id="app-menu"
    class="hs-overlay fixed inset-y-0 start-0 z-60 hidden w-sidenav min-w-sidenav -translate-x-full transform overflow-y-auto bg-body transition-all duration-300 hs-overlay-open:translate-x-0 lg:bottom-0 lg:end-auto lg:z-30 lg:block lg:translate-x-0 rtl:translate-x-full rtl:hs-overlay-open:translate-x-0 rtl:lg:translate-x-0 print:hidden [--body-scroll:true] [--overlay-backdrop:true] lg:[--overlay-backdrop:false]">
    <div class="sticky top-0 flex items-center justify-center h-16 px-6">
        <a href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('assets/images/logo-black.png') }}" alt="logo" class="flex h-10">
        </a>
    </div>

    <div class="h-[calc(100%-64px)] p-4 lg:ps-8" data-simplebar>
        <ul class="admin-menu hs-accordion-group flex w-full flex-col gap-1.5">
            <li class="menu-item">
                <a class="flex items-center px-3 py-2 text-sm font-medium transition-all rounded-md group gap-x-4 text-default-700 hover:bg-default-900/5"
                    href="{{ route('admin.dashboard') }}">
                    <i data-lucide="airplay" class="size-5"></i>
                    Dashboard
                </a>
            </li>

            <li class="menu-item hs-accordion">
                <a href="javascript:void(0)"
                    class="flex items-center px-3 py-2 text-sm font-medium transition-all rounded-md hs-accordion-toggle group gap-x-4 text-default-700 hover:bg-default-900/5 hs-accordion-active:bg-default-900/5 hs-accordion-active:text-default-700">
                    <iconify-icon icon="icon-park-outline:ad-product" class="text-xl text-gray-900"></iconify-icon>
                    <span class="menu-text"> Products </span>
                    <span
                        class="text-sm transition-all i-tabler-chevron-right ms-auto hs-accordion-active:rotate-90"></span>
                </a>

                <div id="productsNav"
                    class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300">
                    <ul class="mt-2 space-y-2">
                        <li class="menu-item">
                            <a href="{{ route('admin.pages.products') }}"
                                class="flex items-center gap-x-3.5 rounded-md px-3 py-2 text-sm font-medium text-default-700 hover:bg-default-900/5">
                                <iconify-icon icon="material-symbols:list-rounded"
                                    class="text-xl text-gray-600"></iconify-icon>
                                <span class="menu-text">Daftar Products</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('admin.pages.input-products') }}"
                                class="flex items-center gap-x-3.5 rounded-md px-3 py-2 text-sm font-medium text-default-700 hover:bg-default-900/5">
                                <iconify-icon icon="material-symbols:add-ad-outline"
                                    class="text-xl text-gray-600"></iconify-icon>
                                <span class="menu-text">Tambah Products</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="menu-item hs-accordion">
                <a href="javascript:void(0)"
                    class="flex items-center px-3 py-2 text-sm font-medium transition-all rounded-md hs-accordion-toggle group gap-x-4 text-default-700 hover:bg-default-900/5 hs-accordion-active:bg-default-900/5 hs-accordion-active:text-default-700">
                    <iconify-icon icon="tabler:stack-2" class="text-xl text-gray-900"></iconify-icon>
                    <span class="menu-text"> Categories </span>
                    <span
                        class="text-sm transition-all i-tabler-chevron-right ms-auto hs-accordion-active:rotate-90"></span>
                </a>

                <div id="categoriesNav"
                    class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300">
                    <ul class="mt-2 space-y-2">
                        <li class="menu-item">
                            <a href="{{ route('admin.pages.categories') }}"
                                class="flex items-center gap-x-3.5 rounded-md px-3 py-2 text-sm font-medium text-default-700 hover:bg-default-900/5">
                                <iconify-icon icon="material-symbols:list-rounded"
                                    class="text-xl text-gray-600"></iconify-icon>
                                <span class="menu-text">Daftar Categories</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('admin.pages.input-categories') }}"
                                class="flex items-center gap-x-3.5 rounded-md px-3 py-2 text-sm font-medium text-default-700 hover:bg-default-900/5">
                                <iconify-icon icon="material-symbols:add-ad-outline"
                                    class="text-xl text-gray-600"></iconify-icon>
                                <span class="menu-text">Tambah Categories</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="menu-item">
                <a href="{{ route('admin.pages.users') }}"
                    class="flex items-center px-3 py-2 text-sm font-medium transition-all rounded-md group gap-x-4 text-default-700 hover:bg-default-900/5 hs-accordion-active:bg-default-900/5">
                    <iconify-icon icon="gravity-ui:person" class="text-2xl text-gray-600"></iconify-icon>
                    <span class="menu-text"> Users </span>
                </a>
            </li>

            <li class="menu-item">
                <a href="{{ route('admin.pages.chat') }}"
                    class="flex items-center px-3 py-2 text-sm font-medium transition-all rounded-md group gap-x-4 text-default-700 hover:bg-default-900/5">
                    <i data-lucide="message-circle" class="size-5"></i>
                    <span class="menu-text">Chat</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="{{ route('admin.pages.orders') }}"
                    class="flex items-center px-3 py-2 text-sm font-medium transition-all rounded-md group gap-x-4 text-default-700 hover:bg-default-900/5 hs-accordion-active:bg-default-900/5">
                    <iconify-icon icon="lets-icons:order" class="text-2xl text-gray-600"></iconify-icon>
                    <span class="menu-text"> Orders </span>
                </a>
            </li>

            <li class="menu-item">
                <a href="{{ route('admin.pages.transactions') }}"
                    class="flex items-center px-3 py-2 text-sm font-medium transition-all rounded-md group gap-x-4 text-default-700 hover:bg-default-900/5 hs-accordion-active:bg-default-900/5">
                    <iconify-icon icon="si:money-duotone" class="text-2xl text-gray-600"></iconify-icon>
                    <span class="menu-text"> Transactions </span>
                </a>
            </li>

            <li class="mt-auto menu-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="flex items-center w-full px-3 py-2 text-sm font-medium transition-all rounded-md group gap-x-4 text-default-700 hover:bg-default-900/5">
                        <i data-lucide="log-out" class="size-5"></i>
                        <span class="menu-text">Logout</span>
                    </button>
                </form>
            </li>
        </ul>
    </div>
</aside>
<!-- End Sidebar -->

<!-- Mobile Nav Start -->
<div class="flex md:hidden">
    <div
        class="fixed bottom-0 z-50 flex items-center justify-between w-full h-16 gap-4 px-5 bg-white border-b shadow-md border-default-100">

        <a href="#" class="flex flex-col items-center justify-center gap-1 text-default-600">
            <i data-lucide="gauge" class="size-5"></i>
            <span class="text-xs font-semibold">Home</span>
        </a>
        <a href="#" class="flex flex-col items-center justify-center gap-1 text-default-600">
            <i data-lucide="search" class="size-5"></i>
            <span class="text-xs font-semibold">Search</span>
        </a>
        <a href="#" class="flex flex-col items-center justify-center gap-1 text-default-600">
            <i data-lucide="compass" class="size-5"></i>
            <span class="text-xs font-semibold">Explore</span>
        </a>
        <a href="#" class="flex flex-col items-center justify-center gap-1 text-default-600">
            <i data-lucide="bell" class="size-5"></i>
            <span class="text-xs font-semibold">Alerts</span>
        </a>
        <a href="#" class="flex flex-col items-center justify-center gap-1 text-default-600">
            <i data-lucide="circle-user" class="size-5"></i>
            <span class="text-xs font-semibold">Profile</span>
        </a>
    </div>
</div>
<!-- Mobile Nav End -->

@push('scripts')
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js">
        window.addEventListener('toggle-chat', () => {
            window.Livewire.emit('toggleChat');
        });
    </script>
@endpush
