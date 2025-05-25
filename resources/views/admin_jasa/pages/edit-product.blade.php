@extends('admin_jasa.layouts.app')

@section('title', 'Edit Product')

@section('content')
    <div class="container py-6">
        @include('admin_jasa.layouts.page-title', [
            'title' => 'Edit Product',
            'subtitle' => 'Menu',
        ])

        <div class="p-6 bg-white rounded-lg shadow">
            <form action="{{ route('admin_jasa.pages.products.update', $product) }}" method="POST" enctype="multipart/form-data" id="product-form">
                @csrf
                @method('PUT')
                
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
                    <!-- Form fields tetap sama seperti sebelumnya -->
                     <div>
                        <label for="name" class="inline-block mb-2 text-sm font-medium text-default-800">Product Name*</label>
                        <input type="text" id="name" name="name" 
                               class="form-input @error('name') border-red-500 @enderror" 
                               value="{{ old('name', $product->name) }}"
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
                               value="{{ old('price', $product->price) }}"
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
                               value="{{ old('stock', $product->stock) }}"
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
                                <option value="{{ $category->category_id }}" 
                                        @selected(old('category_id', $product->category_id) == $category->category_id)>
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- ... -->             
                    <!-- Gambar Produk -->
                    <div class="lg:col-span-2">
                        <label class="inline-block mb-2 text-sm font-medium text-gray-800">Product Images</label>
                        
                        <!-- Current Images -->
                        @if($product->images->count() > 0)
                            <div class="mb-4">
                                <p class="mb-2 text-sm text-gray-500">Current Images (Click to delete)</p>
                                <div class="flex flex-wrap gap-3">
                                    @foreach($product->images as $image)
                                        <div class="relative group" style="width: 6rem; height: 6rem;">
                                            <img src="{{ asset('storage/' . $image->path) }}" 
                                                 class="w-full h-full object-cover rounded border-2 {{ $image->is_primary ? 'border-blue-500' : 'border-transparent' }}">

                                            <!-- Primary badge -->
                                            @if($image->is_primary)
                                                <span class="mt-1 absolute top-1 left-1 bg-blue-500 text-white text-xs px-1 rounded">Primary</span>
                                            @endif

                                            <!-- Hover actions (using inline style) -->
                                            <div style="position: absolute; inset: 0; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 0.5rem; background-color: rgba(0,0,0,0.5); opacity: 0; transition: opacity 0.2s ease;"
                                                 class="group-hover:opacity-100">
                                                <!-- Delete checkbox -->
                                                <div style="display: flex; align-items: center;">
                                                    <input type="checkbox" 
                                                           name="deleted_images[]" 
                                                           value="{{ $image->image_id }}"
                                                           style="border-radius: 9999px; color: #dc2626; outline: none; box-shadow: 0 0 0 2px #ef4444;">
                                                    <span style="margin-left: 0.25rem; color: white; font-size: 0.75rem;">Delete</span>
                                                </div>

                                                <!-- Set as primary radio -->
                                                <div style="display: flex; align-items: center;">
                                                    <input type="radio" 
                                                           name="primary_image" 
                                                           value="{{ $image->image_id }}"
                                                           {{ $image->is_primary ? 'checked' : '' }}
                                                           style="border-radius: 9999px; color: #2563eb; focus:ring-2 focus:ring-blue-500">
                                                    <span style="margin-left: 0.25rem; color: white; font-size: 0.75rem;">Set Primary</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    <style>
                                        .group:hover .group-hover\:opacity-100 {
                                            opacity: 1 !important;
                                        }
                                    </style>
                                </div>
                                <p class="mt-8 text-xs text-gray-500">Check images you want to delete</p>
                            </div>
                        @endif
                        
                        <!-- New Images -->
                        <div class="mt-4">
                            <label class="block mb-2 text-sm font-medium text-gray-800">Add New Images (Max 3)</label>
                            <input type="file" id="new_images" name="new_images[]" multiple
                                   class="block w-full text-sm text-gray-500
                                          file:mr-4 file:py-2 file:px-4
                                          file:rounded-lg file:border-0
                                          file:text-sm file:font-semibold
                                          file:bg-blue-50 file:text-blue-700
                                          hover:file:bg-blue-100
                                          @error('new_images') border-red-500 @enderror"
                                   accept="image/jpeg,image/png,image/jpg,image/gif">
                            <p class="mt-1 text-sm text-gray-500">Format: JPEG, PNG, JPG, GIF (Max: 2MB per image)</p>
                            @error('new_images')
                                <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                            @enderror
                            
                            <!-- Image Preview -->
                            <div id="image-preview" class="mt-4 grid grid-cols-3 gap-4 hidden">
                                <!-- Preview akan muncul di sini -->
                            </div>
                        </div>
                    </div>

                    <!-- Deskripsi dan tombol submit tetap sama -->
                    <div class="lg:col-span-2">
                        <label for="description" class="inline-block mb-2 text-sm font-medium text-default-800">Description</label>
                        <textarea id="description" name="description" rows="4" 
                                  class="form-input @error('description') border-red-500 @enderror">{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- ... -->
                </div>
                <div class="flex justify-end mt-6 gap-3">
                    <a href="{{ route('admin_jasa.pages.products') }}" class="px-6 py-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 transition-colors">
                        Cancel
                    </a>
                    <button type="submit" class="px-6 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors">
                        Update Product
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    @vite('resources/js/app.js')
    <script>
        // Client-side validation
        document.getElementById('product-form').addEventListener('submit', function(e) {
            const errorClasses = ['border-red-500', 'ring-red-500', 'ring-1'];
            const resetClasses = ['border-gray-300', 'ring-blue-500'];
            
            // Reset semua error state
            document.querySelectorAll('.form-input, .form-select').forEach(el => {
                el.classList.remove(...errorClasses);
                el.classList.add(...resetClasses);
                const errorElement = el.nextElementSibling;
                if (errorElement && errorElement.classList.contains('text-red-500')) {
                    errorElement.textContent = '';
                }
            });

            let isValid = true;
            const requiredFields = ['name', 'price', 'stock', 'category_id'];
            
            requiredFields.forEach(field => {
                const element = document.getElementById(field);
                if (element && !element.value) {
                    element.classList.remove(...resetClasses);
                    element.classList.add(...errorClasses);
                    const errorElement = element.nextElementSibling;
                    if (errorElement) {
                        errorElement.textContent = 'This field is required';
                    }
                    isValid = false;
                }
            });

            if (!isValid) {
                e.preventDefault();
                document.querySelector('.error')?.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }
        });

        // Preview new images before upload
        document.getElementById('new_images').addEventListener('change', function(e) {
            const previewContainer = document.getElementById('image-preview');
            previewContainer.innerHTML = '';
            
            if (this.files.length > 0) {
                previewContainer.classList.remove('hidden');
                
                Array.from(this.files).slice(0, 3).forEach((file, index) => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const previewDiv = document.createElement('div');
                        previewDiv.className = 'relative border rounded-lg overflow-hidden';
                        
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'w-full h-32 object-cover';
                        
                        const badge = document.createElement('div');
                        badge.className = 'absolute top-2 right-2 bg-blue-500 text-white text-xs px-2 py-1 rounded-full';
                        badge.textContent = 'New';
                        
                        previewDiv.appendChild(img);
                        previewDiv.appendChild(badge);
                        previewContainer.appendChild(previewDiv);
                    };
                    reader.readAsDataURL(file);
                });
            } else {
                previewContainer.classList.add('hidden');
            }
        });
    </script>
@endpush