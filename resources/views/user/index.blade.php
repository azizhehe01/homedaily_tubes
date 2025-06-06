@php
use Illuminate\Support\Str;
@endphp

@extends('user.components.layout') 

@section('content')

    <!-- Hero Section -->
    <section class="container px-4 py-16 mx-auto md:py-24">
        <div class="flex flex-col items-center md:flex-row">
            <!-- Left Content -->
            <div class="w-full pr-0 mb-10 md:w-1/2 md:pr-12 md:mb-0">
                <h1 class="mb-6 text-4xl font-bold leading-tight text-gray-900 md:text-5xl">
                    Forget Busy Work,<br>
                    Start Your Home Needs.
                </h1>
                <p class="max-w-md mb-8 text-gray-500">
                    We provide what you need to enjoy your homies. Time to make another layout.
                </p>
                <button
                    class="px-8 py-3 font-medium text-white transition duration-300 bg-orange-600 rounded-md shadow-md hover:bg-orange-700">
                    Show Me Now
                </button>

                <!-- Stats -->
                <div class="flex mt-16 space-x-10">
                    <!-- Travelers -->
                    <div class="flex flex-col items-start">
                        <div class="mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-pink-600" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </div>
                        <p class="text-xl font-bold text-gray-900">Thousand <span
                                class="text-base font-normal text-gray-500">Product</span></p>
                    </div>

                    <!-- Treasure -->
                    <div class="flex flex-col items-start">
                        <div class="mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-red-500" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                            </svg>
                        </div>
                        <p class="text-xl font-bold text-gray-900">More <span
                                class="text-base font-normal text-gray-500">Reliable</span></p>
                    </div>

                    <!-- Cities -->
                    <div class="flex flex-col items-start">
                        <div class="mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-purple-600" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                        </div>
                        <p class="text-xl font-bold text-gray-900">Safety <span
                                class="text-base font-normal text-gray-500">shipping</span></p>
                    </div>
                </div>
            </div>

            <!-- Right Image -->
            <div class="w-full md:w-1/2">
                <div class="relative">
                    <div class="absolute inset-0 transform translate-x-4 translate-y-4 bg-white rounded-3xl"></div>
                    <img src="{{ asset('assets/images/homedailyxolivia.jpg') }}"
                        class="relative z-10 w-full h-auto shadow-xl rounded-3xl" alt="Furniture">
                </div>
            </div>
    </section>


    {{-- most picked section --}}
    <section>
        <div class="container p-4 mx-auto">
            <h2 class="mb-4 text-2xl font-bold text-black-600">Recommend Product</h2>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                @forelse($recommendedProducts->filter(function($product) {return !Str::contains(strtolower($product->category->category_name), 'jasa');})->take(9) as $product)
                    <a href="{{ route('user.product.detail', $product->product_id) }}" class="block {{ $loop->first ? 'lg:col-span-2 lg:row-span-2 h-full min-h-[400px]' : 'h-64' }} relative overflow-hidden bg-gray-800 rounded-lg hover:opacity-90 transition-opacity">
                        @if($product->images->where('is_primary', true)->first())
                        <img src="{{ asset('storage/'.$product->images->where('is_primary', true)->first()->path) }}" 
                             alt="{{ $product->name }}"
                             class="absolute inset-0 z-0 object-cover w-full h-full"
                             loading="lazy">
                        @elseif($product->images->first())
                        <img src="{{ asset('storage/'.$product->images->first()->path) }}" 
                             alt="{{ $product->name }}"
                             class="absolute inset-0 z-0 object-cover w-full h-full"
                             loading="lazy">
                        @else
                        <div class="flex items-center justify-center w-full h-full bg-gray-200">
                            <span class="text-gray-500">No Image Available</span>
                        </div>
                        @endif

                        <div class="absolute bottom-0 left-0 right-0 z-10 p-4 bg-gradient-to-t from-black/60 to-transparent">
                            <h3 class="{{ $loop->first ? 'text-2xl' : 'text-lg' }} font-semibold text-white">{{ $product->name }}</h3>
                            <p class="text-sm text-white">{{ $product->category->category_name ?? 'Uncategorized' }}</p>
                        </div>
                        <div class="absolute top-0 right-0 z-10 flex items-center justify-center py-3 pl-8 {{ $loop->first ? 'text-3xl' : 'text-2xl' }} font-bold text-white bg-yellow-600/90 rounded-bl-full w-72">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </div>
                    </a>
                @empty
                    <div class="col-span-full text-center">
                        <p class="text-gray-500">No recommended products available</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>


    {{-- home services section --}}
    <section>
        <div class="container px-4 py-16 mx-auto">
            <h2 class="mb-6 text-xl font-semibold text-black-600 ">Our Home Services</h2>
            <div class="grid grid-cols-1 gap-6 md:grid-cols-4">
                @forelse ($recommendedProducts->filter(function($product) {return Str::contains(strtolower($product->category->category_name), 'jasa');}) as $product)
                <a href="{{ route('user.product.detail', $product->product_id) }}" class="block w-full rounded-lg shadow-sm card bg-base-100 hover:shadow-md transition-shadow">
                    <figure>
                        @if($product->images->where('is_primary', true)->first())
                        <img src="{{ asset('storage/'.$product->images->where('is_primary', true)->first()->path) }}" alt="{{ $product->name }}" class="object-cover w-full h-48 rounded-lg" />
                        @elseif($product->images->first())
                        <img src="{{ asset('storage/'.$product->images->first()->path) }}" alt="{{ $product->name }}" class="object-cover w-full h-48 rounded-lg" />
                        @else
                        <div class="flex items-center justify-center w-full h-48 bg-gray-200">
                            <span class="text-gray-500">No Image Available</span>
                        </div>
                        @endif
                    </figure>
                    <div class="p-3 mt-5 card-body">
                        <h2 class="text-lg card-title">{{ $product->name }}</h2>
                        <p class="text-sm text-gray-600">{{ $product->category->category_name ?? 'Uncategorized' }}</p>
                        <p class="mt-2 font-bold text-orange-500">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    </div>
                </a>
            @empty
                <div class="col-span-full text-center">
                    <p class="text-gray-500">No recommended products available</p>
                </div>
            @endforelse
            </div>
        </div>
    </section>

    {{-- Top Products for you --}}
    <section x-data="{ activeCategory: null }">
        <div class="container px-4 py-6 pr-8 mx-auto">
            <h2 class="mb-4 text-xl font-semibold text-gray-800">Produk Teratas untuk Anda</h2>
            
            <!-- Tombol Kategori -->
            <div class="flex flex-wrap items-center gap-10">
                <!-- Tombol Semua Produk -->
                <button
                    @click="activeCategory = null"
                    :class="activeCategory === null ? 'bg-orange-500 text-white' : 'text-gray-500 border-gray-500 hover:bg-orange-100'"
                    class="flex items-center px-6 py-3 text-base border rounded-full btn">
                    Semua Produk
                </button>
    
                <!-- Tombol Kategori Dinamis -->
                @php
                    $displayedCategories = [];
                @endphp
                
                @foreach($recommendedProducts as $product)
                    @if(!in_array($product->category->category_name, $displayedCategories))
                        <button
                            @click="activeCategory = '{{ $product->category->category_name }}'"
                            :class="activeCategory === '{{ $product->category->category_name }}' ? 'bg-orange-500 text-white' : 'bg-transparent text-orange-500 border-orange-500 hover:bg-gray-100'"
                            class="flex items-center px-6 py-3 text-base border rounded-full btn">
                            {{ $product->category->category_name }}
                        </button>
                        @php 
                            $displayedCategories[] = $product->category->category_name;
                        @endphp
                    @endif
                @endforeach
    
                <!-- Tombol Filter -->
                <button
                    class="flex items-center px-6 py-3 text-base text-gray-500 border border-gray-500 rounded-full btn btn-outline hover:bg-orange-100">
                    Filter
                    <span class="iconify" data-icon="octicon:filter-16" width="20" height="20"></span>
                </button>
            </div>
    
            <!-- Grid Produk -->
            <div class="grid grid-cols-1 gap-6 mt-16 md:grid-cols-4">
                @foreach($recommendedProducts as $product)
                    <a 
                        href="{{ route('user.product.detail', $product->product_id) }}"
                        x-show="activeCategory === null || activeCategory === '{{ $product->category->category_name }}'"
                        x-transition
                        class="block w-full rounded-lg shadow-sm card bg-base-100 hover:shadow-md transition-shadow"
                    >
                        <figure>
                            @if($product->images->where('is_primary', true)->first())
                                <img src="{{ asset('storage/'.$product->images->where('is_primary', true)->first()->path) }}" 
                                     alt="{{ $product->name }}"
                                     class="object-cover w-full h-48 rounded-lg">
                            @elseif($product->images->first())
                                <img src="{{ asset('storage/'.$product->images->first()->path) }}" 
                                     alt="{{ $product->name }}"
                                     class="object-cover w-full h-48 rounded-lg">
                            @else
                                <div class="flex items-center justify-center w-full h-48 bg-gray-200 rounded-lg">
                                    <span class="text-gray-500">Tidak Ada Gambar</span>
                                </div>
                            @endif
                        </figure>
                        <div class="p-3 mt-5 card-body">
                            <h2 class="text-lg card-title">{{ $product->name }}</h2>
                            <p class="text-sm text-gray-600">{{ $product->category->category_name ?? 'Tanpa Kategori' }}</p>
                            <p class="mt-2 font-bold text-orange-500">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        </div>
                    </a>
                @endforeach
    
                <!-- Tampilan Jika Kosong -->
                <template x-if="!Array.from(document.querySelectorAll('[x-show]')).some(el => el.style.display !== 'none')">
                    <div class="col-span-4 text-center py-8">
                        <p class="text-gray-500">Tidak ada produk dalam kategori ini</p>
                    </div>
                </template>
            </div>
        </div>
    </section>
    @endsection

