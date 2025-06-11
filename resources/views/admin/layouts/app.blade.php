<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') | Admin</title>

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Jsvectormap plugin css -->
    <link href="{{ asset('admin/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Include CSS files -->
    @include('admin.layouts.title-meta')
    @include('admin.layouts.head-css')

    <!-- Additional CSS -->
    @stack('css')

    {{-- style livewire --}}
    @livewireStyles


    <style>
        #chat-widget {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            z-index: 9999;
            width: 400px;
            height: 600px;
            margin-right: var(--sidebar-width, 240px);
            transition: margin-right 0.3s ease;
        }

        .sidebar-collapsed #chat-widget {
            margin-right: var(--sidebar-collapsed-width, 70px);
        }
    </style>
</head>

<body>
    <div class="wrapper">
        @include('admin.layouts.sidebar')

        <!-- Start Page Content here -->
        <div class="page-content">
            @include('admin.layouts.topbar')

            <main>
                <div class="container py-6">
                    @include('admin.layouts.page-title', [
                        'subtitle' => 'Menu',
                        'title' => 'Dashboard',
                    ])
                    @auth
                        <div id="chat-widget">
                            @livewire('chat')
                        </div>
                    @endauth
                    @yield('content')
                </div>
            </main>
        </div>

    </div>




    @include('admin.layouts.footer-scripts')

    {{-- livewire script --}}
    @livewireScripts
    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('echo:chat,MessageSent', e => {
                window.livewire.emit('messageReceived', e);
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const wrapper = document.querySelector('.wrapper');
            const chatWidget = document.getElementById('chat-widget');

            if (wrapper && chatWidget) {
                const observer = new MutationObserver((mutations) => {
                    mutations.forEach((mutation) => {
                        if (mutation.attributeName === 'class') {
                            const isSidebarCollapsed = wrapper.classList.contains(
                                'sidebar-collapsed');
                            document.body.classList.toggle('sidebar-collapsed', isSidebarCollapsed);
                        }
                    });
                });

                observer.observe(wrapper, {
                    attributes: true
                });
            }
        });
    </script>

    <!-- JavaScript -->
    <script src="{{ asset('admin/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('admin/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('admin/js/pages/dashboard.js') }}"></script>

    @stack('scripts')


</body>

</html>
