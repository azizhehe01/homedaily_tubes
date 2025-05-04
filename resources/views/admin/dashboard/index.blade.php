@extends('admin.layouts.app')

@section('content')
    <div class="grid gap-6 mb-6 xl:grid-cols-4 md:grid-cols-2">
        @include('admin.dashboard.partials.stats-cards')
    </div>

    <div class="grid gap-6 mb-6 xl:grid-cols-3">
        @include('admin.dashboard.partials.sales-chart')
        @include('admin.dashboard.partials.recent-buyers-chart')
    </div>

    <div class="grid gap-6 xl:grid-cols-2">
        @include('admin.dashboard.partials.recent-buyers-table')
        @include('admin.dashboard.partials.account-transactions')
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Vector Map Js -->
    <script src="{{ asset('assets/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>

    <!-- Dashboard Project Page js -->
    <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>

    <script>
        // Add any dashboard specific JavaScript here
    </script>
@endpush
