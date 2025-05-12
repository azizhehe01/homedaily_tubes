@extends('admin.layouts.app')

@section('title', 'Add Products')

@section('content')
    <div class="container py-6">
        @include('admin.layouts.page-title', [
            'title' => 'Add Products',
            'subtitle' => 'Menu',
        ])

        <div class="p-6">
            <div class="grid gap-6 lg:grid-cols-2">
                <div>
                    <label for="simpleinput" class="inline-block mb-2 text-sm font-medium text-default-800">Text</label>
                    <input type="text" id="simpleinput" class="form-input">
                </div>

                <div>
                    <label for="example-email" class="inline-block mb-2 text-sm font-medium text-default-800">Email</label>
                    <input type="email" id="example-email" name="example-email" class="form-input" placeholder="Email">
                </div>

                <div>
                    <label for="example-password"
                        class="inline-block mb-2 text-sm font-medium text-default-800">Password</label>
                    <input type="password" id="example-password" class="form-input" value="password">
                </div>

                <div>
                    <label for="password" class="inline-block mb-2 text-sm font-medium text-default-800">Show/Hide
                        Password</label>
                    <div class="flex">
                        <input type="password" id="password" class="form-input" placeholder="Enter your password">
                        <div class="input-group-text" data-password="false">
                            <span class="password-eye">*</span>
                        </div>
                    </div>
                </div>

                <div>
                    <label for="example-select" class="inline-block mb-2 text-sm font-medium text-default-800">Input
                        Select</label>
                    <select class="form-select" id="example-select">
                        @for ($i = 1; $i <= 5; $i++)
                            <option>{{ $i }}</option>
                        @endfor
                    </select>
                </div>

                <div>
                    <label for="example-multiselect" class="inline-block mb-2 text-sm font-medium text-default-800">Multiple
                        Select</label>
                    <select id="example-multiselect" multiple class="form-input">
                        @for ($i = 1; $i <= 5; $i++)
                            <option>{{ $i }}</option>
                        @endfor
                    </select>
                </div>

                {{-- Add other form fields here... --}}
            </div>
        </div>
    </div>
@endsection

@push('css')
    @vite('resources/css/app.css')
@endpush

@push('scripts')
    @vite('resources/js/app.js')
    <script>
        // Add any page specific JavaScript here
    </script>
@endpush
