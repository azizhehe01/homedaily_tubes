@extends('user.components.layout')

@section('content')
    <div class="container px-4 py-8 mx-auto">
        <!-- Tab Navigation -->
        <div class="container px-4 mx-auto mb-6">
            <div class="flex overflow-x-auto border-b">
                <button class="px-6 py-3 font-medium text-orange-500 border-b-2 border-orange-500 section-tab active"
                    data-section="profile-section">
                    <i data-lucide="user" class="inline w-4 h-4 mr-2"></i>Profile
                </button>
                <button class="px-6 py-3 font-medium border-b-2 border-transparent section-tab hover:text-orange-500"
                    data-section="transactions-section">
                    <i data-lucide="history" class="inline w-4 h-4 mr-2"></i>Riwayat Transaksi
                </button>

                <button class="px-6 py-3 font-medium border-b-2 border-transparent section-tab hover:text-orange-500"
                    data-section="address-section">
                    <i data-lucide="map-pin" class="inline w-4 h-4 mr-2"></i>Daftar Alamat
                </button>
            </div>
        </div>

        <!-- Profile Section -->
        <section id="profile-section" class="p-6 mb-8 rounded-lg shadow" style="background-image: url('https://images.unsplash.com/photo-1727580674761-3aae55f53cad?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8eW91am98ZW58MHx8MHx8fDA%3D'); background-size: cover; background-position: center;">
            <div class="flex flex-col items-center md:flex-row md:items-start">
                <div class="relative mb-4 md:mb-0">
                    <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('images      /default-profile.jpg') }}" alt="Profile Picture"  class="h-60 w-60">

                    <button
                        class="flex items-center justify-center px-4 py-2 mt-4 text-white bg-orange-500 rounded-lg w-60 hover:bg-orange-600">
                        <i data-lucide="pencil" class="w-4 h-4 mr-2"></i>
                        Tambah Foto Profil
                    </button>
                    <button
                        id="ubahPasswordBtn"
                        class="flex items-center justify-center px-4 py-2 mt-4 text-white bg-orange-500 rounded-lg w-60 hover:bg-orange-600 transition-colors">
                        <i data-lucide="pencil" class="w-4 h-4 mr-2"></i>
                        Ubah Kata Sandi
                    </button>
                </div>
                <div class="flex-1 w-full text-center md:text-left md:ml-6 md:w-2/3">
                    <div class="w-full h-full p-6 rounded-lg bg-gray-50" style="height: calc(240px + 88px)">
                        <!--Biodata -->
                        <div class="flex flex-col justify-between h-full">
                            <div class="space-y-6">
                                <div class="flex flex-col">
                                    <label class="text-sm text-gray-500">Nama Lengkap</label>
                                    <p class="text-base font-medium text-gray-700">
                                        {{ Auth::user()->name }}  <!-- Ambil nama user -->
                                    </p>
                                </div>
                                <div class="flex flex-col">
                                    <label class="text-sm text-gray-500">Nomor Telepon</label>
                                    <p class="text-base font-medium text-gray-700">
                                        {{ Auth::user()->phone_number ?? ' kaga  ada no telp kocak 😭' }}  <!-- Nomor telepon (jika ada) -->
                                    </p>
                                </div>
                                <div class="flex flex-col">
                                    <label class="text-sm text-gray-500">Email</label>
                                    <p class="text-base font-medium text-gray-700">
                                        {{ Auth::user()->email }}  <!-- Email user -->
                                    </p>
                                </div>
                            </div>
                            <button id="edit-profile-btn"
                                class="flex items-center justify-center w-full px-4 py-2 mt-4 text-white bg-orange-500 rounded-lg hover:bg-orange-600">
                                <i data-lucide="user-pen" class="w-4 h-4 mr-2"></i>
                                Edit Profil
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Transaction History -->
        <section id="transactions-section" class="hidden p-6 mb-8 bg-white rounded-lg shadow">
            <div class="flex flex-col items-start justify-between gap-4 mb-6 md:flex-row md:items-center">
                <h2 class="flex items-center text-xl font-bold">
                    <i data-lucide="history" class="w-5 h-5 mr-2 text-orange-500"></i> Riwayat Transaksi
                </h2>

                <!-- Product Filters - Hidden by default -->
                <div id="product-filters" class="flex flex-wrap hidden gap-2">
                    <button class="flex items-center px-3 py-1 text-sm text-white bg-orange-500 rounded-lg filter-btn"
                        data-filter="all">
                        <i data-lucide="filter" class="w-3 h-3 mr-1"></i> Semua
                    </button>
                    <button
                        class="flex items-center px-3 py-1 text-sm text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 filter-btn"
                        data-filter="pending">
                        <i data-lucide="clock" class="w-3 h-3 mr-1"></i> Belum Bayar
                    </button>
                    <button
                        class="flex items-center px-3 py-1 text-sm text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 filter-btn"
                        data-filter="packing">
                        <i data-lucide="package" class="w-3 h-3 mr-1"></i> Sedang Dikemas
                    </button>
                    <button
                        class="flex items-center px-3 py-1 text-sm text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 filter-btn"
                        data-filter="shipping">
                        <i data-lucide="truck" class="w-3 h-3 mr-1"></i> Dikirim
                    </button>
                    <button
                        class="flex items-center px-3 py-1 text-sm text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 filter-btn"
                        data-filter="completed">
                        <i data-lucide="check-circle" class="w-3 h-3 mr-1"></i> Selesai
                    </button>
                </div>

                <!-- Service Filters - Hidden by default -->
                <div id="service-filters" class="flex flex-wrap hidden gap-2">
                    <button class="flex items-center px-3 py-1 text-sm text-white bg-orange-500 rounded-lg filter-btn"
                        data-filter="all">
                        <i data-lucide="filter" class="w-3 h-3 mr-1"></i> Semua
                    </button>
                    <button
                        class="flex items-center px-3 py-1 text-sm text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 filter-btn"
                        data-filter="pending">
                        <i data-lucide="clock" class="w-3 h-3 mr-1"></i> Menunggu Konfirmasi
                    </button>
                    <button
                        class="flex items-center px-3 py-1 text-sm text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 filter-btn"
                        data-filter="scheduled">
                        <i data-lucide="calendar" class="w-3 h-3 mr-1"></i> Terjadwal
                    </button>
                    <button
                        class="flex items-center px-3 py-1 text-sm text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 filter-btn"
                        data-filter="ongoing">
                        <i data-lucide="pen-tool" class="w-3 h-3 mr-1"></i> Sedang Dikerjakan
                    </button>
                    <button
                        class="flex items-center px-3 py-1 text-sm text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 filter-btn"
                        data-filter="completed">
                        <i data-lucide="check-circle" class="w-3 h-3 mr-1"></i> Selesai
                    </button>
                </div>
            </div>

            <!-- Transaction Type Tabs -->
            <div class="flex mb-4 border-b">
                <button
                    class="px-4 py-2 font-medium text-orange-500 border-b-2 border-orange-500 transaction-type-btn active"
                    data-type="all">
                    Semua
                </button>
                <button class="px-4 py-2 border-b-2 border-transparent hover:text-orange-500 transaction-type-btn"
                    data-type="product">
                    Produk
                </button>
                <button class="px-4 py-2 border-b-2 border-transparent hover:text-orange-500 transaction-type-btn"
                    data-type="service">
                    Jasa
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 font-semibold text-gray-700">No. Pesanan</th>
                            <th class="px-4 py-3 font-semibold text-gray-700">Tanggal</th>
                            <th class="px-4 py-3 font-semibold text-gray-700">Item</th>
                            <th class="px-4 py-3 font-semibold text-gray-700">Jumlah</th>
                            <th class="px-4 py-3 font-semibold text-gray-700">Total</th>
                            <th class="px-4 py-3 font-semibold text-gray-700">Status</th>
                            <th class="px-4 py-3 font-semibold text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <!-- Produk Transactions -->
                        <tr class="transition-colors hover:bg-gray-50" data-status="completed" data-type="product">
                            <td class="px-4 py-3 font-medium">#12345</td>
                            <td class="px-4 py-3">15 Mei 2025</td>
                            <td class="flex items-center px-4 py-3">
                                <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-4.0.3&auto=format&fit=crop&w=40&h=40&q=80"
                                    alt="Meryl Lounge Chair" class="object-cover w-10 h-10 mr-3 rounded-lg">
                                <div>
                                    <p>Meryl Lounge Chair</p>
                                    <span class="text-xs text-gray-500">Produk</span>
                                </div>
                            </td>
                            <td class="px-4 py-3">1</td>
                            <td class="px-4 py-3 font-medium">Rp200,000</td>
                            <td class="px-4 py-3">
                                <span
                                    class="flex items-center px-2 py-1 text-xs text-green-800 bg-green-100 rounded-full w-fit">
                                    <i data-lucide="check-circle" class="w-3 h-3 mr-1"></i> Selesai
                                </span>
                            </td>
                            <td class="relative px-4 py-3">
                                <button
                                    class="block w-full px-4 py-2 text-sm text-left text-gray-700 view-tracking-btn hover:bg-gray-100">
                                    <i data-lucide="eye" class="inline w-4 h-4 mr-2"></i> Lihat Detail
                                </button>
                            </td>
                        </tr>
                        <tr class="transition-colors hover:bg-gray-50" data-status="shipping" data-type="product">
                            <td class="px-4 py-3 font-medium">#12346</td>
                            <td class="px-4 py-3">10 Mei 2025</td>
                            <td class="flex items-center px-4 py-3">
                                <img src="https://images.unsplash.com/photo-1600585152915-d208bec867a1?ixlib=rb-4.0.3&auto=format&fit=crop&w=40&h=40&q=80"
                                    alt="Sofa Minimalis" class="object-cover w-10 h-10 mr-3 rounded-lg">
                                <div>
                                    <p>Sofa Minimalis</p>
                                    <span class="text-xs text-gray-500">Produk</span>
                                </div>
                            </td>
                            <td class="px-4 py-3">1</td>
                            <td class="px-4 py-3 font-medium">Rp1,500,000</td>
                            <td class="px-4 py-3">
                                <span
                                    class="flex items-center px-2 py-1 text-xs text-yellow-800 bg-yellow-100 rounded-full w-fit">
                                    <i data-lucide="truck" class="w-3 h-3 mr-1"></i> Dikirim
                                </span>
                            </td>
                            <td class="relative px-4 py-3">
                                <button
                                    class="block w-full px-4 py-2 text-sm text-left text-gray-700 view-tracking-btn hover:bg-gray-100">
                                    <i data-lucide="eye" class="inline w-4 h-4 mr-2"></i> Lihat Detail
                                </button>
                            </td>
                        </tr>
                        <tr class="transition-colors hover:bg-gray-50" data-status="packing" data-type="product">
                            <td class="px-4 py-3 font-medium">#12347</td>
                            <td class="px-4 py-3">8 Mei 2025</td>
                            <td class="flex items-center px-4 py-3">
                                <img src="https://images.unsplash.com/photo-1542372147193-a7aca54189cd?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                    alt="Coffee Table" class="object-cover w-10 h-10 mr-3 rounded-lg">
                                <div>
                                    <p>Coffee Table</p>
                                    <span class="text-xs text-gray-500">Produk</span>
                                </div>
                            </td>
                            <td class="px-4 py-3">2</td>
                            <td class="px-4 py-3 font-medium">Rp750,000</td>
                            <td class="px-4 py-3">
                                <span
                                    class="flex items-center px-2 py-1 text-xs text-blue-800 bg-blue-100 rounded-full w-fit">
                                    <i data-lucide="package" class="w-3 h-3 mr-1"></i> Sedang Dikemas
                                </span>
                            </td>
                            <td class="relative px-4 py-3">
                                <button
                                    class="block w-full px-4 py-2 text-sm text-left text-gray-700 view-tracking-btn hover:bg-gray-100">
                                    <i data-lucide="eye" class="inline w-4 h-4 mr-2"></i> Lihat Detail
                                </button>
                            </td>
                        </tr>

                        <!-- Service Transactions -->
                        <tr class="transition-colors hover:bg-gray-50" data-status="completed" data-type="service">
                            <td class="px-4 py-3 font-medium">#S12349</td>
                            <td class="px-4 py-3">18 Mei 2025</td>
                            <td class="flex items-center px-4 py-3">
                                <img src="https://images.unsplash.com/photo-1581783898377-1c85bf937427?ixlib=rb-4.0.3&auto=format&fit=crop&w=40&h=40&q=80"
                                    alt="Pemasangan AC" class="object-cover w-10 h-10 mr-3 rounded-lg">
                                <div>
                                    <p>Pemasangan AC</p>
                                    <span class="text-xs text-gray-500">Jasa</span>
                                </div>
                            </td>
                            <td class="px-4 py-3">1</td>
                            <td class="px-4 py-3 font-medium">Rp350,000</td>
                            <td class="px-4 py-3">
                                <span
                                    class="flex items-center px-2 py-1 text-xs text-green-800 bg-green-100 rounded-full w-fit">
                                    <i data-lucide="check-circle" class="w-3 h-3 mr-1"></i> Selesai
                                </span>
                            </td>
                            <td class="relative px-4 py-3">
                                <button
                                    class="block w-full px-4 py-2 text-sm text-left text-gray-700 view-tracking-btn hover:bg-gray-100">
                                    <i data-lucide="eye" class="inline w-4 h-4 mr-2"></i> Lihat Detail
                                </button>
                            </td>
                        </tr>
                        <tr class="transition-colors hover:bg-gray-50" data-status="scheduled" data-type="service">
                            <td class="px-4 py-3 font-medium">#S12350</td>
                            <td class="px-4 py-3">20 Mei 2025</td>
                            <td class="flex items-center px-4 py-3">
                                <img src="https://images.unsplash.com/photo-1584622650111-993a426fbf0a?ixlib=rb-4.0.3&auto=format&fit=crop&w=40&h=40&q=80"
                                    alt="Pembersihan Sofa" class="object-cover w-10 h-10 mr-3 rounded-lg">
                                <div>
                                    <p>Pembersihan Sofa</p>
                                    <span class="text-xs text-gray-500">Jasa</span>
                                </div>
                            </td>
                            <td class="px-4 py-3">1</td>
                            <td class="px-4 py-3 font-medium">Rp250,000</td>
                            <td class="px-4 py-3">
                                <span
                                    class="flex items-center px-2 py-1 text-xs text-indigo-800 bg-indigo-100 rounded-full w-fit">
                                    <i data-lucide="calendar" class="w-3 h-3 mr-1"></i> Terjadwal
                                </span>
                            </td>
                            <td class="relative px-4 py-3">
                                <button
                                    class="block w-full px-4 py-2 text-sm text-left text-gray-700 view-tracking-btn hover:bg-gray-100">
                                    <i data-lucide="eye" class="inline w-4 h-4 mr-2"></i> Lihat Detail
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Address Management Section -->
         @if(session('address_success'))
            <div class="p-4 mb-6 text-green-800 bg-green-100 rounded-lg">
                <div class="flex items-center">
                    <i data-lucide="check-circle" class="w-5 h-5 mr-2"></i>
                    {{ session('address_success') }}
                </div>
            </div>
        @endif

        @if(session('address_error'))
            <div class="p-4 mb-6 text-red-800 bg-red-100 rounded-lg">
                <div class="flex items-center">
                    <i data-lucide="alert-circle" class="w-5 h-5 mr-2"></i>
                    {{ session('address_error') }}
                </div>
            </div>
        @endif
        <section id="address-section" class="hidden p-6 mt-8 bg-white rounded-lg shadow">
            <div class="flex items-center justify-between mb-6">
                <h2 class="flex items-center text-xl font-bold">
                    <i data-lucide="map-pin" class="w-5 h-5 mr-2 text-orange-500"></i> Daftar Alamat
                </h2>
                <button id="add-address-btn"
                    class="flex items-center px-4 py-2 text-white bg-orange-500 rounded-lg hover:bg-orange-600"
                    onclick="switchTab('address-section')">
                    <i data-lucide="plus" class="w-4 h-4 mr-2"></i> Tambah Alamat
                </button>
            </div>

            <div class="relative mb-6">
                <i data-lucide="search" class="absolute text-gray-400 transform -translate-y-1/2 left-3 top-1/2"></i>
                <input type="text" placeholder="Cari Alamat"
                    class="w-full py-2 pl-10 border-none rounded-lg bg-gray-50">
            </div>

            <h3 class="mb-4 text-lg font-semibold text-orange-500">Semua Alamat</h3>

            <div class="space-y-4">
                @forelse(Auth::user()->addresses as $address)
                <div class="p-4 transition-shadow border rounded-lg hover:shadow-md" data-address-id="{{ $address->id }}">
                    <div class="flex items-start justify-between">
                        <h4 class="font-semibold text-orange-500">{{ $address->label ?? 'Alamat' }}</h4>
                        <div class="flex gap-2">
                            <form action="{{ route('user.profile.address.destroy', ['address_id' => $address->address_id]) }}" method="POST" class="delete-address-form">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="delete-address-btn">
                                    <i data-lucide="trash-2" class="w-5 h-5 text-gray-400 cursor-pointer hover:text-red-500"></i>
                                </button>
                            </form>
                        </div>
                    </div>
            
                    <div class="mt-2">
                        <p class="font-semibold">{{ $address->recipient_name }}</p>  
                        <p class="text-gray-500">{{ $address->phone_number }}</p>
                    </div>
            
                    <p class="mt-2 text-gray-700">
                        {{ $address->full_address }}, 
                        {{ $address->city }}, 
                        {{ $address->province }} 
                        @if($address->postal_code)
                            {{ $address->postal_code }}
                        @endif
                    </p>
            
                    <div class="flex items-center mt-2">
                        <i data-lucide="map-pin" class="w-4 h-4 mr-1 text-orange-500"></i>
                        <span class="text-sm text-orange-500">Alamat Utama</span>
                    </div>
            
                    <button class="w-full py-2 mt-3 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50 set-default-address" data-address-id="{{ $address->id }}">
                        Jadikan Alamat Utama
                    </button>
                </div>
                @empty
                <div class="p-4 text-center text-gray-500 border border-dashed rounded-lg">
                    <i data-lucide="map-pin-off" class="w-8 h-8 mx-auto mb-2 text-gray-400"></i>
                    <p>Belum ada alamat yang tersimpan</p>
                </div>
                @endforelse
            </div>
        </section>
    </div>


    <!-- Profile Dialog -->
    <div id="profile-dialog"
        class="fixed inset-0 z-50 flex items-center justify-center hidden transition-opacity duration-200 bg-black bg-opacity-50 opacity-0">
        <div class="w-full max-w-md p-6 transition-transform duration-200 transform scale-95 bg-white rounded-lg">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold">Edit Profil</h3>
                <button id="close-profile-dialog" class="text-gray-500 hover:text-gray-700">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <form id="profile-form" method="POST" action="{{ route('user.profile.update') }}">
                @csrf
                @method('PUT')

                <div class="grid gap-4 py-4">
                    <div class="grid gap-2">
                        <label for="profile-name" class="text-sm font-medium">Nama Lengkap</label>
                        <input id="profile-name" name="name" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md" 
                            value="{{ Auth::user()->name }}" />
                    </div>
                    <div class="grid gap-2">
                        <label for="profile-phone" class="text-sm font-medium">Nomor Telepon</label>
                        <input id="profile-phone" name="phone_number" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md" 
                            value="{{ Auth::user()->phone_number }}" />
                    </div>
                    <div class="grid gap-2">
                        <label for="profile-email" class="text-sm font-medium">Email</label>
                        <input id="profile-email" name="email" type="email" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md"
                            value="{{ Auth::user()->email }}" />
                    </div>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" id="cancel-profile-btn"
                        class="px-4 py-2 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 text-white bg-orange-500 rounded-md hover:bg-orange-600">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Photo Upload Dialog -->
    <div id="photo-dialog"
        class="fixed inset-0 z-50 flex items-center justify-center hidden transition-opacity duration-200 bg-black bg-opacity-50 opacity-0">
        <div class="w-full max-w-md p-6 transition-transform duration-200 transform scale-95 bg-white rounded-lg">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold">Ubah Foto Profil</h3>
                <button id="close-photo-dialog" class="text-gray-500 hover:text-gray-700">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <form id="photo-form" method="POST" action="{{ route('user.profile.photo.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="grid gap-4 py-4">
                    <div class="flex flex-col items-center justify-center gap-4">
                        <!-- Foto Preview -->
                        <div class="relative w-32 h-32 overflow-hidden bg-gray-100 rounded-full">
                            <img id="photo-preview" src="{{ Auth::user()->avatar ? asset('storage/profiles/'.Auth::user()->avatar) : 'https://via.placeholder.com/128' }}" 
                                class="object-cover w-full h-full" alt="Profile Preview">
                        </div>

                        <!-- File Input -->
                        <div class="w-full">
                            <label for="profile-photo" class="block text-sm font-medium text-gray-700 mb-2">
                                Pilih Foto Baru
                            </label>
                            <input type="file" id="profile-photo" name="avatar" accept="image/*"
                                class="block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-md file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-orange-50 file:text-orange-700
                                    hover:file:bg-orange-100">
                        </div>

                        <!-- Informasi -->
                        <p class="text-xs text-gray-500">
                            Format: JPG, PNG maksimal 2MB
                        </p>
                    </div>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" id="cancel-photo-btn"
                        class="px-4 py-2 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 text-white bg-orange-500 rounded-md hover:bg-orange-600">
                        Simpan Foto
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <div id="passwordModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-md overflow-hidden">
            <!-- Header -->
            <div class="flex justify-between items-center p-6 border-b">
                <h3 class="text-xl font-bold text-gray-800">Ganti Password</h3>
                <button id="closeModal" type="button" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <span class="iconify" data-icon="mdi:close"></span>
                </button>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('user.profile.password.update') }}">
                @csrf
                @method('PUT')

                <!-- Tampilkan error validasi -->
                @if ($errors->any())
                    <div class="p-4 mx-4 mt-4 text-sm text-red-600 bg-red-100 rounded-md">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <div class="p-6 space-y-4">
                    <!-- Current Password -->
                    <div class="space-y-2">
                        <label for="current_password" class="block text-gray-700">Password Sekarang</label>
                        <div class="relative">
                            <input 
                                id="current_password"
                                name="current_password"
                                type="password" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                                placeholder="Masukkan password saat ini"
                                autofocus >
                            <button 
                                type="button"
                                onclick="togglePassword('current_password')"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                <span class="iconify" data-icon="mdi:eye"></span>
                            </button>
                        </div>
                    </div>

                    <!-- New Password -->
                    <div class="space-y-2">
                        <label for="new_password" class="block text-gray-700">Password Baru</label>
                        <div class="relative">
                            <input 
                                id="new_password"
                                name="new_password"
                                type="password" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                                placeholder="Password minimal 8 karakter"
                                title="Minimal 8 karakter, mengandung huruf dan angka">
                            <button 
                                type="button"
                                onclick="togglePassword('new_password')"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                <span class="iconify" data-icon="mdi:eye"></span>
                            </button>
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="space-y-2">
                        <label for="confirm_password" class="block text-gray-700">Konfirmasi Password</label>
                        <div class="relative">
                            <input 
                                id="confirm_password"
                                name="confirm_password"
                                type="password" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                                placeholder="Ketik ulang password baru">
                            <button 
                                type="button"
                                onclick="togglePassword('confirm_password')"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                <span class="iconify" data-icon="mdi:eye"></span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="flex justify-end gap-3 p-6 border-t bg-gray-50">
                    <button type="button" onclick="document.getElementById('passwordModal').classList.add('hidden')" 
                        class="px-5 py-2 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2 text-white bg-orange-500 rounded-lg hover:bg-orange-600 transition-colors">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Address Dialog -->
    <div id="address-dialog" class="fixed inset-0 z-50 flex items-center justify-center hidden transition-opacity duration-200 bg-black bg-opacity-50 opacity-0">
        <div class="w-full max-w-md p-6 transition-transform duration-200 transform scale-95 bg-white rounded-lg">
            <div class="flex items-center justify-between mb-4">
                <h3 id="dialog-title" class="text-lg font-semibold">
                    {{ isset($edit_address) ? 'Edit Alamat' : 'Tambah Alamat' }}
                </h3>
                <button id="close-dialog" class="text-gray-500 hover:text-gray-700">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <form id="address-form" method="POST" 
                  action="{{ isset($edit_address) ? route('user.profile.address.update', $edit_address->id) : route('user.profile.address.store') }}">
                @csrf
                @if(isset($edit_address))
                    @method('PUT')
                @endif

                <div class="grid gap-4 py-4">
                    <!-- Nama Penerima -->
                    <div class="grid gap-2">
                        <label for="recipient_name" class="text-sm font-medium">Nama Penerima*</label>
                        <input id="recipient_name" name="recipient_name" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md" 
                            value="{{ old('recipient_name', $edit_address->recipient_name ?? '') }}"
                            placeholder="Nama lengkap penerima"/>
                        @error('recipient_name', 'address')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nomor Telepon -->
                    <div class="grid gap-2">
                        <label for="phone_number" class="text-sm font-medium">Nomor Telepon*</label>
                        <input id="phone_number" name="phone_number" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md"
                            value="{{ old('phone_number', $edit_address->phone_number ?? '') }}"
                            placeholder="Contoh: 081234567890"/>
                        @error('phone_number', 'address')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Provinsi -->
                    <div class="grid gap-2">
                        <label for="province" class="text-sm font-medium">Provinsi*</label>
                        <input id="province" name="province" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md"
                            value="{{ old('province', $edit_address->province ?? '') }}"
                            placeholder="Contoh: Jawa Barat"/>
                        @error('province', 'address')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kota/Kabupaten -->
                    <div class="grid gap-2">
                        <label for="city" class="text-sm font-medium">Kota/Kabupaten*</label>
                        <input id="city" name="city" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md"
                            value="{{ old('city', $edit_address->city ?? '') }}"
                            placeholder="Contoh: Bandung"/>
                        @error('city', 'address')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kode Pos -->
                    <div class="grid gap-2">
                        <label for="postal_code" class="text-sm font-medium">Kode Pos</label>
                        <input id="postal_code" name="postal_code"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md"
                            value="{{ old('postal_code', $edit_address->postal_code ?? '') }}"
                            placeholder="Contoh: 40132"/>
                        @error('postal_code', 'address')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Alamat Lengkap -->
                    <div class="grid gap-2">
                        <label for="full_address" class="text-sm font-medium">Alamat Lengkap*</label>
                        <textarea id="full_address" name="full_address" required rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md" 
                            placeholder="Contoh: Jl. Merdeka No. 10, RT 01/RW 02, Kec. Bandung Kulon">{{ old('full_address', $edit_address->full_address ?? '') }}</textarea>
                        @error('full_address', 'address')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Error Message -->
                    @if ($errors->address->any())
                        <div class="p-2 text-sm text-red-600 bg-red-100 rounded-md">
                            @foreach ($errors->address->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="flex justify-end gap-2">
                    <button type="button" id="cancel-btn"
                        class="px-4 py-2 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 text-white bg-orange-500 rounded-md hover:bg-orange-600">
                        {{ isset($edit_address) ? 'Update Alamat' : 'Simpan Alamat' }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Product Tracking Detail Dialog -->
    <div id="product-tracking-dialog"
        class="fixed inset-0 z-50 flex items-center justify-center hidden transition-opacity duration-200 bg-black bg-opacity-50 opacity-0">
        <div
            class="bg-white rounded-lg w-full max-w-2xl p-6 transform scale-95 transition-transform duration-200 max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold">Detail Pengiriman Produk</h3>
                <button class="text-gray-500 close-tracking-dialog hover:text-gray-700">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <div class="pb-4 mb-4 border-b">
                <div class="flex items-start justify-between mb-2">
                    <div>
                        <p class="text-lg font-semibold">#12346 - Sofa Minimalis</p>
                        <p class="text-gray-500">Tanggal Pembelian: 10 Mei 2025</p>
                    </div>
                    <span class="flex items-center px-2 py-1 text-xs text-yellow-800 bg-yellow-100 rounded-full">
                        <i data-lucide="truck" class="w-3 h-3 mr-1"></i> Dikirim
                    </span>
                </div>
            </div>

            <div class="mb-6">
                <h4 class="mb-2 font-semibold">Informasi Pengiriman</h4>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <p class="text-sm text-gray-500">Kurir</p>
                        <p class="font-medium">JNE Express</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">No. Resi</p>
                        <p class="font-medium">JP0123456789</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Estimasi Tiba</p>
                        <p class="font-medium">15 Mei 2025</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Berat</p>
                        <p class="font-medium">15 kg</p>
                    </div>
                </div>
            </div>

            <div class="mb-6">
                <h4 class="mb-2 font-semibold">Alamat Pengiriman</h4>
                <div class="p-3 rounded-lg bg-gray-50">
                    <p class="font-medium">Surya Nugraha</p>
                    <p>62855659718873</p>
                    <p class="mt-1">Ciganitri Mukti V No.45 Rt06/Rw11 Desa. Cipagalo Kec. Bojongsong Kab. Bandung 40288
                    </p>
                </div>
            </div>

            <div class="mb-6">
                <h4 class="mb-2 font-semibold">Produk</h4>
                <div class="flex items-center p-3 rounded-lg bg-gray-50">
                    <img src="https://images.unsplash.com/photo-1600585152915-d208bec867a1?ixlib=rb-4.0.3&auto=format&fit=crop&w=80&h=80&q=80"
                        alt="Sofa Minimalis" class="object-cover w-16 h-16 mr-3 rounded">
                    <div>
                        <p class="font-medium">Sofa Minimalis</p>
                        <p class="text-gray-500">1 x Rp1,500,000</p>
                    </div>
                </div>
            </div>

            <div>
                <h4 class="mb-2 font-semibold">Status Pengiriman</h4>
                <div class="relative pl-6">
                    <!-- Fixed the vertical line positioning to be centered with the status circles -->
                    <div class="absolute top-0 z-0 w-1 h-full border-l-2 border-gray-300 border-dashed left-4"></div>
                    <div class="space-y-6">
                        <div class="relative">
                            <div
                                class="absolute z-10 flex items-center justify-center w-8 h-8 text-white bg-green-500 rounded-full -left-4">
                                <i data-lucide="check" class="w-4 h-4"></i>
                            </div>
                            <div class="ml-6">
                                <p class="font-semibold text-gray-800">Pesanan Dikonfirmasi</p>
                                <p class="text-sm text-gray-500">10 Mei 2025, 14:00 WIB</p>
                                <p class="mt-1 text-sm text-gray-600">Pesanan Anda telah dikonfirmasi dan sedang diproses.
                                </p>
                            </div>
                        </div>
                        <div class="relative">
                            <div
                                class="absolute z-10 flex items-center justify-center w-8 h-8 text-white bg-green-500 rounded-full -left-4">
                                <i data-lucide="package" class="w-4 h-4"></i>
                            </div>
                            <div class="ml-6">
                                <p class="font-semibold text-gray-800">Sedang Dikemas</p>
                                <p class="text-sm text-gray-500">11 Mei 2025, 09:00 WIB</p>
                                <p class="mt-1 text-sm text-gray-600">Pesanan Anda sedang dikemas dan akan segera dikirim.
                                </p>
                            </div>
                        </div>
                        <div class="relative">
                            <div
                                class="absolute z-10 flex items-center justify-center w-8 h-8 text-white bg-green-500 rounded-full -left-4">
                                <i data-lucide="truck" class="w-4 h-4"></i>
                            </div>
                            <div class="ml-6">
                                <p class="font-semibold text-gray-800">Dikirim</p>
                                <p class="text-sm text-gray-500">12 Mei 2025, 13:30 WIB</p>
                                <p class="mt-1 text-sm text-gray-600">Pesanan Anda telah dikirim dan sedang dalam
                                    perjalanan.</p>
                            </div>
                        </div>
                        <div class="relative">
                            <div
                                class="absolute z-10 flex items-center justify-center w-8 h-8 text-gray-600 bg-gray-200 rounded-full -left-4">
                                <i data-lucide="home" class="w-4 h-4"></i>
                            </div>
                            <div class="ml-6">
                                <p class="font-semibold text-gray-800">Sampai Tujuan</p>
                                <p class="text-sm text-gray-500">Estimasi 15 Mei 2025</p>
                                <p class="mt-1 text-sm text-gray-600">Pesanan Anda akan segera tiba di alamat tujuan.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end mt-6">
                <button class="px-4 py-2 mr-2 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50">
                    Hubungi Kurir
                </button>
                <button class="px-4 py-2 text-white bg-orange-500 rounded-md hover:bg-orange-600">
                    Lacak Pengiriman
                </button>
            </div>
        </div>
    </div>

    <!-- Service Tracking Detail Dialog -->
    <div id="service-tracking-dialog"
        class="fixed inset-0 z-50 flex items-center justify-center hidden transition-opacity duration-200 bg-black bg-opacity-50 opacity-0">
        <div
            class="bg-white rounded-lg w-full max-w-2xl p-6 transform scale-95 transition-transform duration-200 max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold">Detail Layanan</h3>
                <button class="text-gray-500 close-tracking-dialog hover:text-gray-700">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <div class="pb-4 mb-4 border-b">
                <div class="flex items-start justify-between mb-2">
                    <div>
                        <p class="text-lg font-semibold">#S12350 - Pembersihan Sofa</p>
                        <p class="text-gray-500">Tanggal Pemesanan: 20 Mei 2025</p>
                    </div>
                    <span class="flex items-center px-2 py-1 text-xs text-indigo-800 bg-indigo-100 rounded-full">
                        <i data-lucide="calendar" class="w-3 h-3 mr-1"></i> Terjadwal
                    </span>
                </div>
            </div>

            <div class="mb-6">
                <h4 class="mb-2 font-semibold">Informasi Layanan</h4>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <p class="text-sm text-gray-500">Jenis Layanan</p>
                        <p class="font-medium">Pembersihan Sofa</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Jadwal Layanan</p>
                        <p class="font-medium">22 Mei 2025, 09:00 WIB</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Durasi Estimasi</p>
                        <p class="font-medium">2 jam</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Teknisi</p>
                        <p class="font-medium">Budi Santoso</p>
                    </div>
                </div>
            </div>

            <div class="mb-6">
                <h4 class="mb-2 font-semibold">Alamat Layanan</h4>
                <div class="p-3 rounded-lg bg-gray-50">
                    <p class="font-medium">Surya Nugraha</p>
                    <p>62855659718873</p>
                    <p class="mt-1">Ciganitri Mukti V No.45 Rt06/Rw11 Desa. Cipagalo Kec. Bojongsong Kab. Bandung 40288
                    </p>
                </div>
            </div>

            <div class="mb-6">
                <h4 class="mb-2 font-semibold">Detail Layanan</h4>
                <div class="p-3 rounded-lg bg-gray-50">
                    <div class="flex justify-between mb-2">
                        <p>Pembersihan Sofa (3 Seater)</p>
                        <p class="font-medium">Rp250,000</p>
                    </div>
                    <div class="flex justify-between pt-2 border-t">
                        <p class="font-medium">Total</p>
                        <p class="font-medium">Rp250,000</p>
                    </div>
                </div>
            </div>

            <div>
                <h4 class="mb-2 font-semibold">Status Layanan</h4>
                <div class="relative pl-6">
                    <div class="absolute top-0 z-0 w-1 h-full border-l-2 border-gray-300 border-dashed left-4"></div>
                    <div class="space-y-6">
                        <div class="relative">
                            <div
                                class="absolute z-10 flex items-center justify-center w-8 h-8 text-white bg-green-500 rounded-full -left-4">
                                <i data-lucide="check" class="w-4 h-4"></i>
                            </div>
                            <div class="ml-6">
                                <p class="font-semibold text-gray-800">Pesanan Dikonfirmasi</p>
                                <p class="text-sm text-gray-500">20 Mei 2025, 10:00 WIB</p>
                                <p class="mt-1 text-sm text-gray-600">Pesanan layanan Anda telah dikonfirmasi.</p>
                            </div>
                        </div>
                        <div class="relative">
                            <div
                                class="absolute z-10 flex items-center justify-center w-8 h-8 text-white bg-green-500 rounded-full -left-4">
                                <i data-lucide="calendar" class="w-4 h-4"></i>
                            </div>
                            <div class="ml-6">
                                <p class="font-semibold text-gray-800">Jadwal Ditetapkan</p>
                                <p class="text-sm text-gray-500">20 Mei 2025, 14:30 WIB</p>
                                <p class="mt-1 text-sm text-gray-600">Jadwal layanan telah ditetapkan untuk 22 Mei 2025,
                                    09:00 WIB.</p>
                            </div>
                        </div>
                        <div class="relative">
                            <div
                                class="absolute z-10 flex items-center justify-center w-8 h-8 text-gray-600 bg-gray-200 rounded-full -left-4">
                                <i data-lucide="user" class="w-4 h-4"></i>
                            </div>
                            <div class="ml-6">
                                <p class="font-semibold text-gray-800">Teknisi Dalam Perjalanan</p>
                                <p class="text-sm text-gray-500">Jadwal: 22 Mei 2025, 09:00 WIB</p>
                                <p class="mt-1 text-sm text-gray-600">Teknisi akan datang ke lokasi Anda sesuai jadwal.</p>
                            </div>
                        </div>
                        <div class="relative">
                            <div
                                class="absolute z-10 flex items-center justify-center w-8 h-8 text-gray-600 bg-gray-200 rounded-full -left-4">
                                <i data-lucide="check-circle" class="w-4 h-4"></i>
                            </div>
                            <div class="ml-6">
                                <p class="font-semibold text-gray-800">Layanan Selesai</p>
                                <p class="text-sm text-gray-500">Estimasi: 22 Mei 2025</p>
                                <p class="mt-1 text-sm text-gray-600">Layanan akan selesai setelah teknisi menyelesaikan
                                    pekerjaan.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end mt-6">
                <button class="px-4 py-2 mr-2 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50">
                    Hubungi Teknisi
                </button>
                <button class="px-4 py-2 text-white bg-orange-500 rounded-md hover:bg-orange-600">
                    Konfirmasi Selesai
                </button>
            </div>
        </div>
    </div>
    
@endsection




@section('scripts')
    <script>
        // Profile dialog functionality (pure open/close)
        document.addEventListener("DOMContentLoaded", function() {
            // DOM Elements
            const profileDialog = document.getElementById('profile-dialog');
            const editProfileBtn = document.getElementById('edit-profile-btn');
            const closeProfileBtn = document.getElementById('close-profile-dialog');
            const cancelProfileBtn = document.getElementById('cancel-profile-btn');

            // Open modal
            function openProfileDialog() {
                profileDialog.classList.remove('hidden');
                setTimeout(() => {
                    profileDialog.classList.remove('opacity-0');
                    profileDialog.querySelector('.transform').classList.remove('scale-95');
                    profileDialog.querySelector('.transform').classList.add('scale-100');   
                }, 10);
            }

            // Close modal
            function closeProfileDialog() {
                profileDialog.classList.add('opacity-0');
                profileDialog.querySelector('.transform').classList.remove('scale-100');
                profileDialog.querySelector('.transform').classList.add('scale-95');
                setTimeout(() => {
                    profileDialog.classList.add('hidden');
                }, 200);
            }

            // Event listeners
            editProfileBtn?.addEventListener('click', openProfileDialog);
            closeProfileBtn?.addEventListener('click', closeProfileDialog);
            cancelProfileBtn?.addEventListener('click', closeProfileDialog);

            // Close when clicking outside modal
            profileDialog?.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeProfileDialog();
                }
            });
        });

        // Modal tambah foto profil
        document.addEventListener('DOMContentLoaded', function() {
            // Tombol Tambah Foto Profil
            const photoBtn = document.querySelector('.bg-orange-500.w-60');
            const photoDialog = document.getElementById('photo-dialog');
            const closePhotoDialog = document.getElementById('close-photo-dialog');
            const cancelPhotoBtn = document.getElementById('cancel-photo-btn');

            // Preview gambar saat dipilih
            const photoInput = document.getElementById('profile-photo');
            const photoPreview = document.getElementById('photo-preview');

            // Buka modal
            photoBtn?.addEventListener('click', () => {
                photoDialog.classList.remove('hidden');
                setTimeout(() => {
                    photoDialog.classList.remove('opacity-0');
                    photoDialog.querySelector('.transform').classList.remove('scale-95');
                }, 20);
            });

            // Tutup modal
            function closePhotoModal() {
                photoDialog.classList.add('opacity-0');
                photoDialog.querySelector('.transform').classList.add('scale-95');
                setTimeout(() => photoDialog.classList.add('hidden'), 200);
            }

            closePhotoDialog?.addEventListener('click', closePhotoModal);
            cancelPhotoBtn?.addEventListener('click', closePhotoModal);

            // Preview gambar
            photoInput?.addEventListener('change', function(e) {
                if (e.target.files && e.target.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        photoPreview.src = event.target.result;
                    };
                    reader.readAsDataURL(e.target.files[0]);
                }
            });
        });

        // Modal ubah password
        function togglePassword(id) {
            const input = document.getElementById(id);
            const icon = input.nextElementSibling.querySelector('.iconify');

            if (input.type === 'password') {
                input.type = 'text';
                icon.setAttribute('data-icon', 'mdi:eye-off');
            } else {
                input.type = 'password';
                icon.setAttribute('data-icon', 'mdi:eye');
            }
        }

        document.getElementById('ubahPasswordBtn')?.addEventListener('click', () => {
            document.getElementById('passwordModal').classList.remove('hidden');
        });

        document.getElementById('closeModal')?.addEventListener('click', () => {
            document.getElementById('passwordModal').classList.add('hidden');
        });

        @if(session('password_error'))
            document.getElementById('passwordModal').classList.remove('hidden');
        @endif

        // Modal alamat dan tab section
        document.addEventListener('DOMContentLoaded', function() {
            // ==================== Modal Alamat ====================
            const addressDialog = document.getElementById('address-dialog');
            const addAddressBtn = document.getElementById('add-address-btn');
            const closeDialogBtn = document.getElementById('close-dialog');
            const cancelBtn = document.getElementById('cancel-btn');
            const addressForm = document.getElementById('address-form');

            // Fungsi buka modal alamat
            function openAddressDialog() {
                addressDialog.classList.remove('hidden');
                setTimeout(() => {
                    addressDialog.classList.remove('opacity-0');
                    addressDialog.querySelector('.transform').classList.remove('scale-95');
                    addressDialog.querySelector('.transform').classList.add('scale-100');
                }, 10);
            }
        
            // Fungsi tutup modal alamat
            function closeAddressDialog() {
                addressDialog.classList.add('opacity-0');
                addressDialog.querySelector('.transform').classList.remove('scale-100');
                addressDialog.querySelector('.transform').classList.add('scale-95');
                setTimeout(() => {
                    addressDialog.classList.add('hidden');
                }, 200);
            }

            // Event listeners untuk modal alamat
            if (addAddressBtn) {
                addAddressBtn.addEventListener('click', function() {
                    // Reset form dan set ke mode tambah
                    if (addressForm) {
                        addressForm.reset();
                        addressForm.action = "{{ route('user.profile.address.store') }}";
                        const methodInput = addressForm.querySelector('input[name="_method"]');
                        if (methodInput) methodInput.value = 'POST';
                        document.getElementById('dialog-title').textContent = 'Tambah Alamat';
                    }
                    openAddressDialog();
                });
            }

            closeDialogBtn?.addEventListener('click', closeAddressDialog);
            cancelBtn?.addEventListener('click', closeAddressDialog);
        
            // Tutup modal ketika klik di luar
            addressDialog?.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeAddressDialog();
                }
            });

            // ==================== Tab Section ====================
            const tabButtons = document.querySelectorAll('.section-tab');
            const sections = document.querySelectorAll('section[id$="-section"]');

            // Function to switch tabs and sections
            function switchTab(targetSection) {
                // Remove active state from all tabs
                tabButtons.forEach(tab => {
                    tab.classList.remove('active', 'border-orange-500', 'text-orange-500');
                    tab.classList.add('border-transparent');
                });

                // Hide all sections
                sections.forEach(section => {
                    section.classList.add('hidden');
                });

                // Activate clicked tab and show corresponding section
                const activeTab = document.querySelector(`[data-section="${targetSection}"]`);
                const activeSection = document.getElementById(targetSection);

                if (activeTab && activeSection) {
                    activeTab.classList.add('active', 'border-orange-500', 'text-orange-500');
                    activeTab.classList.remove('border-transparent');
                    activeSection.classList.remove('hidden');

                    // Update URL hash untuk tetap di section setelah refresh
                    window.location.hash = targetSection;
                }
            }

            // Add click handlers to tabs
            tabButtons.forEach(tab => {
                tab.addEventListener('click', () => {
                    const targetSection = tab.getAttribute('data-section');
                    switchTab(targetSection);
                });
            });

            // Buka section sesuai hash URL (untuk tetap di section alamat setelah submit)
            if (window.location.hash) {
                const targetSection = window.location.hash.substring(1);
                const targetTab = document.querySelector(`[data-section="${targetSection}"]`);

                if (targetTab) {
                    switchTab(targetSection);

                    // Auto-scroll ke section setelah beberapa milidetik
                    setTimeout(() => {
                        const section = document.getElementById(targetSection);
                        if (section) {
                            section.scrollIntoView({ behavior: 'smooth' });
                        }
                    }, 100);
                }
            } else {
                // Show profile section by default
                switchTab('profile-section');
            }

            // ==================== Form Submission Handling ====================
            if (addressForm) {
                addressForm.addEventListener('submit', function(e) {
                    // Anda bisa tambahkan loading spinner atau validasi tambahan di sini
                    // Contoh:
                    const submitBtn = this.querySelector('button[type="submit"]');
                    if (submitBtn) {
                        submitBtn.disabled = true;
                        submitBtn.innerHTML = '<span class="flex items-center justify-center"><i data-lucide="loader-2" class="w-4 h-4 mr-2 animate-spin"></i> Memproses...</span>';
                    }

                    // Set timeout untuk auto-close modal setelah submit
                    setTimeout(closeAddressDialog, 500);
                });
            }

            // ==================== Delete Address Confirmation ====================
            document.querySelectorAll('.delete-address-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    if (confirm('Apakah Anda yakin ingin menghapus alamat ini?')) {
                        // Tampilkan loading
                        this.innerHTML = '<i data-lucide="loader-2" class="w-5 h-5 animate-spin"></i>';

                        // Submit form
                        this.closest('form').submit();
                    }
                });
            });
        });

        // Inisialisasi Lucide Icons setelah konten dimuat
        document.addEventListener('DOMContentLoaded', function() {
            if (window.lucide) {
                lucide.createIcons();
            }
        });
    </script>
@endsection
