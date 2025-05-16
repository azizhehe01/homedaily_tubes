@php
    use Illuminate\Support\Str;
@endphp

@extends('admin.layouts.app')

@section('title', 'Daftar Kategori Produk')

@section('content')
    <div class="py-4">
        @include('admin.layouts.page-title', [
            'title' => 'Daftar Kategori Produk',
            'subtitle' => 'Manajemen Kategori',
        ])

        @if (session('success'))
            <div class="p-4 mb-4 text-green-700 bg-green-100 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex justify-end mb-4">
            <a href="{{ route('admin.pages.input-categories') }}"
                class="flex items-center px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">
                <iconify-icon icon="mdi:plus" class="mr-2"></iconify-icon>
                Tambah Kategori
            </a>
        </div>

        <div class="overflow-x-auto">
            <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden border rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-sm text-start text-default-500">ID</th>
                                <th scope="col" class="px-6 py-3 text-sm text-start text-default-500">Nama Kategori</th>
                                <th scope="col" class="px-6 py-3 text-sm text-start text-default-500">Deskripsi</th>
                                <th scope="col" class="px-6 py-3 text-sm text-start text-default-500">Tanggal Dibuat</th>
                                <th scope="col" class="px-6 py-3 text-sm text-end text-default-500">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($categories ?? [] as $category)
                                <tr>
                                    <td class="px-6 py-4 text-sm font-medium whitespace-nowrap text-default-800">
                                        {{ $category->category_id }}
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium whitespace-nowrap text-default-800">
                                        {{ $category->category_name }}
                                    </td>
                                    <td class="px-6 py-4 text-sm whitespace-nowrap text-default-800">
                                        {{ $category->description ? Str::limit($category->description, 50) : '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm whitespace-nowrap text-default-800">
                                        {{ $category->created_at->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium whitespace-nowrap text-end">
                                        <a href="{{ route('admin.pages.categories.edit', $category->category_id) }}"
                                            class="mr-3 text-primary hover:text-sky-700">
                                            <iconify-icon icon="uil:edit" width="20"></iconify-icon>
                                        </a>
                                        <form action="{{ route('admin.pages.categories.destroy', $category->category_id) }}"
                                            method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-primary hover:text-sky-700"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                                <iconify-icon icon="mdi:delete-outline" width="20"></iconify-icon>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @if (($categories ?? collect())->isEmpty())
                        <div class="p-4 text-center text-gray-500">
                            Tidak ada kategori produk ditemukan.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
@endpush
