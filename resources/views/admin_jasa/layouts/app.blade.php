<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Jasa') | Admin jasa</title>

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Jsvectormap plugin css -->
    <link href="{{ asset('admin/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Include CSS files -->
    @include('admin_jasa.layouts.title-meta')
    @include('admin_jasa.layouts.head-css')

    <!-- Additional CSS -->
    @stack('css')
</head>

<body>
    <div class="wrapper">
        @include('admin_jasa.layouts.sidebar')

        <!-- Start Page Content here -->
        <div class="page-content">
            @include('admin_jasa.layouts.topbar')

            <main>
                <div class="container py-6">
                    @include('admin_jasa.layouts.page-title', [
                        'subtitle' => 'Menu',
                        'title' => 'Dashboard Jasa',
                    ])

                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    @include('admin_jasa.layouts.footer-scripts')

    <!-- JavaScript -->
    <script src="{{ asset('admin/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('admin/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('admin/js/pages/dashboard.js') }}"></script>

    @stack('scripts')
</body>

</html>
