@extends('admin.layouts.app')

@section('title', 'Edit Kategori Produk')

@section('content')
    <div class="container py-6">
        @include('admin.layouts.page-title', [
            'title' => 'Edit Kategori Produk',
            'subtitle' => 'Menu',
        ])

        <div class="p-6 bg-white rounded-lg shadow">
            <form action="{{ route('admin.pages.categories.update', $category->category_id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="grid gap-6 lg:grid-cols-1">
                    <div>
                        <label for="category_name" class="inline-block mb-2 text-sm font-medium text-default-800">Nama Kategori*</label>
                        <input type="text" id="category_name" name="category_name" class="form-input" 
                               placeholder="Masukkan nama kategori" required
                               value="{{ old('category_name', $category->category_name) }}">
                        @error('category_name')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="inline-block mb-2 text-sm font-medium text-default-800">Deskripsi</label>
                        <textarea id="description" name="description" class="form-input" rows="4" 
                                  placeholder="Masukkan deskripsi kategori (opsional)">{{ old('description', $category->description) }}</textarea>
                        @error('description')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.pages.categories') }}" class="px-4 py-2 ml-2 text-gray-700 bg-gray-200 rounded hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection