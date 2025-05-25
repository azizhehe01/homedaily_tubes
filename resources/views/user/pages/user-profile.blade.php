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
                    data-section="wishlist-section">
                    <i data-lucide="heart" class="inline w-4 h-4 mr-2"></i>Wishlist
                </button>

                <button class="px-6 py-3 font-medium border-b-2 border-transparent section-tab hover:text-orange-500"
                    data-section="address-section">
                    <i data-lucide="map-pin" class="inline w-4 h-4 mr-2"></i>Daftar Alamat
                </button>
            </div>
        </div>

        <!-- Profile Section -->
        <section id="profile-section" class="p-6 mb-8 bg-white rounded-lg shadow">
            <div class="flex flex-col items-center md:flex-row md:items-start">
                <div class="relative mb-4 md:mb-0">
                    <img src="https://images.unsplash.com/photo-1628157588251-4d75b1e1a106?ixlib=rb-4.0.3&auto=format&fit=crop&w=96&h=96&q=80"
                        alt="Profile Picture" class="mb-5 border-4 border-orange-100 rounded shadow-md h-60 w-60">

                    <button
                        class="flex items-center justify-center px-4 py-2 mt-4 text-white bg-orange-500 rounded-lg w-60 hover:bg-orange-600">
                        <i data-lucide="pencil" class="w-4 h-4 mr-2"></i>
                        Tambah Foto Profil
                    </button>

                    <button
                        class="flex items-center justify-center px-4 py-2 mt-4 text-white bg-orange-500 rounded-lg w-60 hover:bg-orange-600">
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
                                    <p class="text-base font-medium text-gray-700">Muhamad Surya Nugraha</p>
                                </div>
                                <div class="flex flex-col">
                                    <label class="text-sm text-gray-500">Nomor Telepon</label>
                                    <p class="text-base font-medium text-gray-700">62855659718873</p>
                                </div>
                                <div class="flex flex-col">
                                    <label class="text-sm text-gray-500">Email</label>
                                    <p class="text-base font-medium text-gray-700">suryanugraha355@gmail.com</p>
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

        <!-- Wishlist Section -->
        <section id="wishlist-section" class="hidden p-6 mb-8 bg-white rounded-lg shadow">
            <h2 class="flex items-center mb-6 text-xl font-bold">
                <i data-lucide="heart" class="w-5 h-5 mr-2 text-orange-500"></i> Wishlist (5)
            </h2>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                <!-- Item 1 -->
                <div class="overflow-hidden transition-shadow border rounded-lg hover:shadow-lg">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&h=400&q=80"
                            alt="Meryl Lounge Chair" class="object-cover w-full h-48">
                        <button
                            class="absolute p-2 text-red-500 bg-white rounded-full shadow-md top-2 right-2 hover:bg-red-500 hover:text-white">
                            <i data-lucide="heart" class="w-4 h-4"></i>
                        </button>
                    </div>
                    <div class="p-4">
                        <h3 class="mb-1 text-lg font-semibold">Meryl Lounge Chair</h3>
                        <div class="flex items-center mb-2">
                            <div class="flex text-yellow-400">
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                            </div>
                            <span class="ml-2 text-sm text-gray-500">(24)</span>
                        </div>
                        <p class="mb-3 text-lg font-bold text-orange-500">Rp200,000</p>
                        <button
                            class="flex items-center justify-center w-full py-2 text-white bg-orange-500 rounded-lg hover:bg-orange-600">
                            <i data-lucide="shopping-cart" class="w-4 h-4 mr-1"></i> Beli
                        </button>
                    </div>
                </div>
                <!-- Item 2 -->
                <div class="overflow-hidden transition-shadow border rounded-lg hover:shadow-lg">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1600585152915-d208bec867a1?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&h=400&q=80"
                            alt="Sofa Minimalis" class="object-cover w-full h-48">
                        <button
                            class="absolute p-2 text-red-500 bg-white rounded-full shadow-md top-2 right-2 hover:bg-red-500 hover:text-white">
                            <i data-lucide="heart" class="w-4 h-4"></i>
                        </button>
                    </div>
                    <div class="p-4">
                        <h3 class="mb-1 text-lg font-semibold">Sofa Minimalis</h3>
                        <div class="flex items-center mb-2">
                            <div class="flex text-yellow-400">
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                            </div>
                            <span class="ml-2 text-sm text-gray-500">(18)</span>
                        </div>
                        <p class="mb-3 text-lg font-bold text-orange-500">Rp1,500,000</p>
                        <button
                            class="flex items-center justify-center w-full py-2 text-white bg-orange-500 rounded-lg hover:bg-orange-600">
                            <i data-lucide="shopping-cart" class="w-4 h-4 mr-1"></i> Beli
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Address Management Section -->
        <section id="address-section" class="hidden p-6 mt-8 bg-white rounded-lg shadow">
            <div class="flex items-center justify-between mb-6">
                <h2 class="flex items-center text-xl font-bold">
                    <i data-lucide="map-pin" class="w-5 h-5 mr-2 text-orange-500"></i> Daftar Alamat
                </h2>
                <button id="add-address-btn"
                    class="flex items-center px-4 py-2 text-white bg-orange-500 rounded-lg hover:bg-orange-600">
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
                <!-- Address Card 1 -->
                <div class="p-4 transition-shadow border rounded-lg hover:shadow-md" data-address-id="1">
                    <div class="flex items-start justify-between">
                        <h4 class="font-semibold text-orange-500">Rumah</h4>
                        <button class="edit-address-btn" data-index="0">
                            <i data-lucide="edit" class="w-5 h-5 text-gray-400 cursor-pointer"></i>
                        </button>
                    </div>

                    <div class="mt-2">
                        <p class="font-semibold">Surya Nugraha</p>
                        <p class="text-gray-500">62855659718873</p>
                    </div>

                    <p class="mt-2 text-gray-700">Kp. Pangadegan Girang No. 03 Rt/Rw 01/06 Desa Pegelaran Kec Pegelaran Kab
                        Cianjur Jawabarat Indonesia 43266</p>

                    <div class="flex items-center mt-2">
                        <i data-lucide="map-pin" class="w-4 h-4 mr-1 text-orange-500"></i>
                        <span class="text-sm text-orange-500">Sudah Pinpoint</span>
                    </div>

                    <button class="w-full py-2 mt-3 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50">
                        Ubah Alamat
                    </button>
                </div>

                <!-- Address Card 2 -->
                <div class="p-4 transition-shadow border rounded-lg hover:shadow-md" data-address-id="2">
                    <div class="flex items-start justify-between">
                        <h4 class="font-semibold text-orange-500">Kos</h4>
                        <button class="edit-address-btn" data-index="1">
                            <i data-lucide="edit" class="w-5 h-5 text-gray-400 cursor-pointer"></i>
                        </button>
                    </div>

                    <div class="mt-2">
                        <p class="font-semibold">Surya Nugraha</p>
                        <p class="text-gray-500">62855659718873</p>
                    </div>

                    <p class="mt-2 text-gray-700">Ciganitri Mukti V No.45 Rt06/Rw11 Desa. Cipagalo Kec. Bojongsong Kab.
                        Bandung 40288</p>

                    <div class="flex items-center mt-2">
                        <i data-lucide="map-pin" class="w-4 h-4 mr-1 text-orange-500"></i>
                        <span class="text-sm text-orange-500">Sudah Pinpoint</span>
                    </div>

                    <button class="w-full py-2 mt-3 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50">
                        Ubah Alamat
                    </button>
                </div>

                <!-- Address Card 3 -->
                <div class="p-4 transition-shadow border rounded-lg hover:shadow-md" data-address-id="3">
                    <div class="flex items-start justify-between">
                        <h4 class="font-semibold text-orange-500">Rumah</h4>
                        <button class="edit-address-btn" data-index="2">
                            <i data-lucide="edit" class="w-5 h-5 text-gray-400 cursor-pointer"></i>
                        </button>
                    </div>

                    <div class="mt-2">
                        <p class="font-semibold">Alya Aulla</p>
                        <p class="text-gray-500">628212465780</p>
                    </div>

                    <p class="mt-2 text-gray-700">Jl. A Makahanap G14 Komplek Dwikora, Perum Taman Galaksi, Halim Perdana
                        Kusuma</p>

                    <button class="w-full py-2 mt-3 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50">
                        Ubah Alamat
                    </button>
                </div>
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

            <form id="profile-form">
                <div class="grid gap-4 py-4">
                    <div class="grid gap-2">
                        <label for="profile-name" class="text-sm font-medium">Nama Lengkap</label>
                        <input id="profile-name" name="name" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md" value="Muhamad Surya Nugraha" />
                    </div>
                    <div class="grid gap-2">
                        <label for="profile-phone" class="text-sm font-medium">Nomor Telepon</label>
                        <input id="profile-phone" name="phone" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md" value="62855659718873" />
                    </div>
                    <div class="grid gap-2">
                        <label for="profile-email" class="text-sm font-medium">Email</label>
                        <input id="profile-email" name="email" type="email" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md"
                            value="suryanugraha355@gmail.com" />
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

    <!-- Address Dialog -->
    <div id="address-dialog"
        class="fixed inset-0 z-50 flex items-center justify-center hidden transition-opacity duration-200 bg-black bg-opacity-50 opacity-0">
        <div class="w-full max-w-md p-6 transition-transform duration-200 transform scale-95 bg-white rounded-lg">
            <div class="flex items-center justify-between mb-4">
                <h3 id="dialog-title" class="text-lg font-semibold">Tambah Alamat</h3>
                <button id="close-dialog" class="text-gray-500 hover:text-gray-700">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <form id="address-form">
                <div class="grid gap-4 py-4">
                    <div class="grid gap-2">
                        <label for="name" class="text-sm font-medium">Nama</label>
                        <!-- Form inputs -->
                        <input id="name" name="name" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md" />
                    </div>
                    <div class="grid gap-2">
                        <label for="phone" class="text-sm font-medium">Nomor Telepon</label>
                        <input id="phone" name="phone" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md" />
                    </div>
                    <div class="grid gap-2">
                        <label for="address" class="text-sm font-medium">Alamat Lengkap</label>
                        <textarea id="address" name="address" required rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md"></textarea>
                    </div>
                    <div class="grid gap-2">
                        <label for="label" class="text-sm font-medium">Label (Rumah/Kos)</label>
                        <input id="label" name="label" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md" />
                    </div>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" id="cancel-btn"
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
        document.addEventListener("DOMContentLoaded", function() {
            // Initialize Lucide icons
            lucide.createIcons();

            // DOM Elements
            const elements = {
                addressDialog: document.getElementById('address-dialog'),
                addAddressBtn: document.getElementById('add-address-btn'),
                closeDialogBtn: document.getElementById('close-dialog'),
                cancelBtn: document.getElementById('cancel-btn'),
                addressForm: document.getElementById('address-form'),
                editAddressBtns: document.querySelectorAll('.edit-address-btn')
            };

            // Profile dialog functionality
            const profileElements = {
                dialog: document.getElementById('profile-dialog'),
                editBtn: document.getElementById('edit-profile-btn'),
                closeBtn: document.getElementById('close-profile-dialog'),
                cancelBtn: document.getElementById('cancel-profile-btn'),
                form: document.getElementById('profile-form')
            };

            // Open profile dialog
            function openProfileDialog() {
                profileElements.dialog.classList.remove('hidden');
                setTimeout(() => {
                    profileElements.dialog.classList.remove('opacity-0');
                    profileElements.dialog.querySelector('.transform').classList.remove('scale-95');
                    profileElements.dialog.querySelector('.transform').classList.add('scale-100');
                }, 10);
            }

            // Close profile dialog
            function closeProfileDialog() {
                profileElements.dialog.classList.add('opacity-0');
                profileElements.dialog.querySelector('.transform').classList.remove('scale-100');
                profileElements.dialog.querySelector('.transform').classList.add('scale-95');
                setTimeout(() => {
                    profileElements.dialog.classList.add('hidden');
                }, 200);
            }

            // Add event listeners
            profileElements.editBtn.addEventListener('click', openProfileDialog);
            profileElements.closeBtn.addEventListener('click', closeProfileDialog);
            profileElements.cancelBtn.addEventListener('click', closeProfileDialog);

            // Handle form submission
            profileElements.form.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = {
                    name: this.name.value,
                    phone: this.phone.value,
                    email: this.email.value
                };
                console.log('Profile updated:', formData);
                closeProfileDialog();
                // TODO: Update the profile display with new values
                // You would typically make an API call here to update the backend
            });

            // Close when clicking outside
            profileElements.dialog.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeProfileDialog();
                }
            });


            // Open dialog function
            function openAddressDialog(isEdit = false, addressData = null) {
                elements.addressDialog.classList.remove('hidden');
                elements.addressDialog.classList.remove('opacity-0');
                elements.addressDialog.querySelector('.transform').classList.remove('scale-95');
                elements.addressDialog.querySelector('.transform').classList.add('scale-100');

                if (isEdit && addressData) {
                    document.getElementById('name').value = addressData.name;
                    document.getElementById('phone').value = addressData.phone;
                    document.getElementById('address').value = addressData.address;
                    document.getElementById('label').value = addressData.label;
                    document.getElementById('dialog-title').textContent = 'Edit Alamat';
                } else {
                    elements.addressForm.reset();
                    document.getElementById('dialog-title').textContent = 'Tambah Alamat';
                }
            }

            // Close dialog function
            function closeAddressDialog() {
                elements.addressDialog.classList.add('opacity-0');
                elements.addressDialog.querySelector('.transform').classList.remove('scale-100');
                elements.addressDialog.querySelector('.transform').classList.add('scale-95');

                setTimeout(() => {
                    elements.addressDialog.classList.add('hidden');
                }, 200);
            }

            // Product tracking dialog functionality
            const trackingElements = {
                dialog: document.getElementById('product-tracking-dialog'),
                viewButtons: document.querySelectorAll('.view-tracking-btn'),
                closeButtons: document.querySelectorAll('.close-tracking-dialog')
            };

            // Open tracking dialog
            function openTrackingDialog() {
                trackingElements.dialog.classList.remove('hidden');
                setTimeout(() => {
                    trackingElements.dialog.classList.remove('opacity-0');
                    trackingElements.dialog.querySelector('.transform').classList.remove('scale-95');
                    trackingElements.dialog.querySelector('.transform').classList.add('scale-100');
                }, 10);
            }

            // Close tracking dialog
            function closeTrackingDialog() {
                trackingElements.dialog.classList.add('opacity-0');
                trackingElements.dialog.querySelector('.transform').classList.remove('scale-100');
                trackingElements.dialog.querySelector('.transform').classList.add('scale-95');
                setTimeout(() => {
                    trackingElements.dialog.classList.add('hidden');
                }, 200);
            }

            // Add click handlers to view buttons
            trackingElements.viewButtons.forEach(btn => {
                btn.addEventListener('click', openTrackingDialog);
            });

            // Add click handlers to close buttons
            trackingElements.closeButtons.forEach(btn => {
                btn.addEventListener('click', closeTrackingDialog);
            });

            // Close when clicking outside
            trackingElements.dialog.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeTrackingDialog();
                }
            });


            // Add event listeners
            elements.addAddressBtn.addEventListener('click', () => openAddressDialog());
            elements.closeDialogBtn.addEventListener('click', closeAddressDialog);
            elements.cancelBtn.addEventListener('click', closeAddressDialog);

            // Edit address button handlers
            elements.editAddressBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const card = this.closest('.border');
                    const addressData = {
                        name: card.querySelector('p.font-semibold').textContent,
                        phone: card.querySelector('p.text-gray-500').textContent,
                        address: card.querySelector('p.mt-2.text-gray-700').textContent,
                        label: card.querySelector('h4').textContent
                    };
                    openAddressDialog(true, addressData);
                });
            });

            // Handle form submission
            elements.addressForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = {
                    name: this.name.value,
                    phone: this.phone.value,
                    address: this.address.value,
                    label: this.label.value
                };
                console.log('Form submitted:', formData);
                closeAddressDialog();
            });

            // Close dialog when clicking outside
            elements.addressDialog.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeAddressDialog();
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get all tab buttons and sections
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
                }
            }

            // Add click handlers to tabs
            tabButtons.forEach(tab => {
                tab.addEventListener('click', () => {
                    const targetSection = tab.getAttribute('data-section');
                    switchTab(targetSection);
                });
            });

            // Show profile section by default
            const defaultSection = 'profile-section';
            switchTab(defaultSection);
        });
    </script>
@endsection
