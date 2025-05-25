@php
use Illuminate\Support\Str;
@endphp


@extends('admin_jasa.layouts.app')

@section('title', 'Add Products')

@section('content')
    <div class="container py-6">
        @include('admin_jasa.layouts.page-title', [
            'title' => 'Add Services',
            'subtitle' => 'Menu',
        ])

        <div class="p-6 bg-white rounded-lg shadow">
            <form action="{{ route('admin_jasa.pages.store-products') }}" method="POST" enctype="multipart/form-data" id="product-form">
                @csrf
                
                <!-- Error Message Container -->
                @if($errors->any())
                    <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-600 rounded-lg">
                        <h4 class="font-bold">Please fix these errors:</h4>
                        <ul class="list-disc list-inside mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="grid gap-6 lg:grid-cols-2">
                    <!-- Nama Produk -->
                    <div>
                        <label for="name" class="inline-block mb-2 text-sm font-medium text-default-800">Product Name*</label>
                        <input type="text" id="name" name="name" 
                               class="form-input @error('name') border-red-500 @enderror" 
                               value="{{ old('name') }}"
                               required>
                        @error('name')
                            <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Harga -->
                    <div>
                        <label for="price" class="inline-block mb-2 text-sm font-medium text-default-800">Price*</label>
                        <input type="number" id="price" name="price" step="0.01" min="0" 
                               class="form-input @error('price') border-red-500 @enderror"
                               value="{{ old('price') }}"
                               required>
                        @error('price')
                            <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Stok -->
                    <div>
                        <label for="stock" class="inline-block mb-2 text-sm font-medium text-default-800">Stock*</label>
                        <input type="number" id="stock" name="stock" min="0" 
                               class="form-input @error('stock') border-red-500 @enderror"
                               value="{{ old('stock') }}"
                               required>
                        @error('stock')
                            <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Kategori (Foreign Key) -->
                    <div>
                        <label for="category_id" class="inline-block mb-2 text-sm font-medium text-default-800">Product Category*</label>
                        <select id="category_id" name="category_id" 
                                class="form-select @error('category_id') border-red-500 @enderror"
                                required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                 @if(Str::contains(strtolower($category->category_name), 'jasa'))
                                    <option value="{{ $category->category_id }}" 
                                            @selected(old('category_id') == $category->category_id)>
                                        {{ $category->category_name }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <!-- Gambar Produk -->
                    <div class="lg:col-span-2">
                        <label class="inline-block mb-2 text-sm font-medium text-default-800">Product Images (Max 3)*</label>
                        <input type="file" id="images" name="images[]" multiple 
                               class="form-input @error('images') border-red-500 @enderror"
                               accept="image/jpeg,image/png,image/jpg,image/gif">
                        <p class="mt-1 text-sm text-gray-500">Format: JPEG, PNG, JPG, GIF (Max: 2MB per image, Max 3 files)</p>
                        @error('images')
                            <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                        @enderror

                        <!-- Preview Container -->
                        <div id="image-preview" class="mt-4 grid grid-cols-3 gap-4 hidden"></div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="lg:col-span-2">
                        <label for="description" class="inline-block mb-2 text-sm font-medium text-default-800">Description</label>
                        <textarea id="description" name="description" rows="4" 
                                  class="form-input @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <button type="submit" class="px-6 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors">
                        Save Product
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('css')
    @vite('resources/css/app.css')
    <style>
        .form-input.error, .form-select.error {
            border-color: #ef4444;
        }
    </style>
@endpush

@push('scripts')
    @vite('resources/js/app.js')
    <script>
        // Client-side validation
        document.getElementById('product-form').addEventListener('submit', function(e) {
            let isValid = true;
            const requiredFields = ['name', 'price', 'stock', 'category', 'category_id'];
            
            // Reset error states
            requiredFields.forEach(field => {
                const element = document.getElementById(field);
                element.classList.remove('border-red-500', 'error');
                const errorElement = element.nextElementSibling;
                if (errorElement && errorElement.classList.contains('text-red-500')) {
                    errorElement.textContent = '';
                }
            });

            // Validate required fields
            requiredFields.forEach(field => {
                const element = document.getElementById(field);
                if (!element.value) {
                    element.classList.add('border-red-500', 'error');
                    const errorElement = element.nextElementSibling;
                    if (errorElement && errorElement.classList.contains('text-red-500')) {
                        errorElement.textContent = 'This field is required';
                    }
                    isValid = false;
                }
            });

            // Validate price format
            const price = document.getElementById('price');
            if (price.value && isNaN(parseFloat(price.value))) {
                price.classList.add('border-red-500', 'error');
                const errorElement = price.nextElementSibling;
                if (errorElement && errorElement.classList.contains('text-red-500')) {
                    errorElement.textContent = 'Please enter a valid price';
                }
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault();
                
                // Scroll to first error
                const firstError = document.querySelector('.error');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }
        });

        // Preview image before upload
        const imageInput = document.getElementById('image');
        if (imageInput) {
            imageInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        // You can add image preview logic here if needed
                        console.log('Selected file:', event.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
    </script>

    <script>
        document.getElementById('images').addEventListener('change', function(e) {
            const previewContainer = document.getElementById('image-preview');
            previewContainer.innerHTML = '';
            
            if (this.files.length > 0) {
                previewContainer.classList.remove('hidden');
                
                // Limit to 3 files
                const files = Array.from(this.files).slice(0, 3);
                
                files.forEach((file, index) => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const previewDiv = document.createElement('div');
                        previewDiv.className = 'relative';
                        
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'w-full h-32 object-cover rounded border';
                        
                        const badge = document.createElement('div');
                        badge.className = 'absolute top-2 right-2 bg-blue-500 text-white text-xs px-2 py-1 rounded';
                        badge.textContent = index === 0 ? 'Primary' : 'Additional';
                        
                        previewDiv.appendChild(img);
                        previewDiv.appendChild(badge);
                        previewContainer.appendChild(previewDiv);
                    }
                    reader.readAsDataURL(file);
                });
            } else {
                previewContainer.classList.add('hidden');
            }
        });
    </script>
@endpush