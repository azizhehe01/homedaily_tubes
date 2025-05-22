@extends('user.components.layout')

@section('content')
<div class="container mx-auto px-4 py-8">
  <!-- Profile Section -->
  <section class="bg-white rounded-lg shadow p-6 mb-8">
    <div class="flex flex-col md:flex-row items-center md:items-start">
      <div class="relative mb-4 md:mb-0">
        <img src="https://images.unsplash.com/photo-1628157588251-4d75b1e1a106?ixlib=rb-4.0.3&auto=format&fit=crop&w=96&h=96&q=80" alt="Profile Picture" class="w-24 h-24 rounded-full border-4 border-orange-100 shadow-md">
      </div>
      <div class="flex-1 md:ml-6 text-center md:text-left">
        <h1 class="text-2xl font-bold mb-1">{{ Auth::user()->name }}</h1>
        <p class="text-gray-600 mb-3 flex items-center justify-center md:justify-start">
          <i data-lucide="mail" class="w-4 h-4 mr-2 text-orange-500"></i> {{ Auth::user()->email }}
        </p>

        <!-- Achievement Badges -->
        <div class="flex flex-wrap gap-2 justify-center md:justify-start mb-4">
          <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full flex items-center">
            <i data-lucide="award" class="w-3 h-3 mr-1"></i> Pembeli Aktif
          </span>
          <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full flex items-center">
            <i data-lucide="badge-check" class="w-3 h-3 mr-1"></i> Terverifikasi
          </span>
        </div>
        
        <!-- Current Address Section -->
        <div class="bg-gray-50 p-3 rounded-lg mb-3">
          <div class="flex justify-between items-start">
            <h3 class="text-sm font-medium text-gray-500 mb-1">Alamat Saat Ini</h3>
            <span class="bg-orange-100 text-orange-800 text-xs px-2 py-0.5 rounded-full">Rumah</span>
          </div>
          <p class="text-sm text-gray-700 mb-1">Surya Nugraha • 62855659718873</p>
          <p class="text-sm text-gray-700">Kp. Pangadegan Girang No. 03 Rt/Rw 01/06 Desa Pegelaran Kec Pegelaran Kab Cianjur Jawabarat Indonesia 43266</p>
          <button id="change-address-btn" class="mt-2 text-orange-500 text-sm font-medium flex items-center hover:underline">
            <i data-lucide="edit-3" class="w-3 h-3 mr-1"></i> Ubah Alamat
          </button>
        </div>
      </div>
      <button class="mt-4 md:mt-0 bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 flex items-center">
        <i data-lucide="pencil" class="w-4 h-4 mr-2"></i> Edit Profile
      </button>
    </div>
  </section>

  <!-- Transaction History -->
  <section class="bg-white rounded-lg shadow p-6 mb-8">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
      <h2 class="text-xl font-bold flex items-center">
        <i data-lucide="history" class="w-5 h-5 mr-2 text-orange-500"></i> Riwayat Transaksi
      </h2>
      
      <!-- Product Filters - Hidden by default -->
      <div id="product-filters" class="flex flex-wrap gap-2 hidden">
        <button class="px-3 py-1 bg-orange-500 text-white rounded-lg text-sm flex items-center filter-btn" data-filter="all">
          <i data-lucide="filter" class="w-3 h-3 mr-1"></i> Semua
        </button>
        <button class="px-3 py-1 bg-gray-200 text-gray-700 rounded-lg text-sm hover:bg-gray-300 flex items-center filter-btn" data-filter="pending">
          <i data-lucide="clock" class="w-3 h-3 mr-1"></i> Belum Bayar
        </button>
        <button class="px-3 py-1 bg-gray-200 text-gray-700 rounded-lg text-sm hover:bg-gray-300 flex items-center filter-btn" data-filter="packing">
          <i data-lucide="package" class="w-3 h-3 mr-1"></i> Sedang Dikemas
        </button>
        <button class="px-3 py-1 bg-gray-200 text-gray-700 rounded-lg text-sm hover:bg-gray-300 flex items-center filter-btn" data-filter="shipping">
          <i data-lucide="truck" class="w-3 h-3 mr-1"></i> Dikirim
        </button>
        <button class="px-3 py-1 bg-gray-200 text-gray-700 rounded-lg text-sm hover:bg-gray-300 flex items-center filter-btn" data-filter="completed">
          <i data-lucide="check-circle" class="w-3 h-3 mr-1"></i> Selesai
        </button>
      </div>

      <!-- Service Filters - Hidden by default -->
      <div id="service-filters" class="flex flex-wrap gap-2 hidden">
        <button class="px-3 py-1 bg-orange-500 text-white rounded-lg text-sm flex items-center filter-btn" data-filter="all">
          <i data-lucide="filter" class="w-3 h-3 mr-1"></i> Semua
        </button>
        <button class="px-3 py-1 bg-gray-200 text-gray-700 rounded-lg text-sm hover:bg-gray-300 flex items-center filter-btn" data-filter="pending">
          <i data-lucide="clock" class="w-3 h-3 mr-1"></i> Menunggu Konfirmasi
        </button>
        <button class="px-3 py-1 bg-gray-200 text-gray-700 rounded-lg text-sm hover:bg-gray-300 flex items-center filter-btn" data-filter="scheduled">
          <i data-lucide="calendar" class="w-3 h-3 mr-1"></i> Terjadwal
        </button>
        <button class="px-3 py-1 bg-gray-200 text-gray-700 rounded-lg text-sm hover:bg-gray-300 flex items-center filter-btn" data-filter="ongoing">
          <i data-lucide="pen-tool" class="w-3 h-3 mr-1"></i> Sedang Dikerjakan
        </button>
        <button class="px-3 py-1 bg-gray-200 text-gray-700 rounded-lg text-sm hover:bg-gray-300 flex items-center filter-btn" data-filter="completed">
          <i data-lucide="check-circle" class="w-3 h-3 mr-1"></i> Selesai
        </button>
      </div>
    </div>
    
    <!-- Transaction Type Tabs -->
    <div class="flex border-b mb-4">
      <button class="py-2 px-4 border-b-2 border-orange-500 text-orange-500 font-medium transaction-type-btn active" data-type="all">
        Semua
      </button>
      <button class="py-2 px-4 border-b-2 border-transparent hover:text-orange-500 transaction-type-btn" data-type="product">
        Produk
      </button>
      <button class="py-2 px-4 border-b-2 border-transparent hover:text-orange-500 transaction-type-btn" data-type="service">
        Jasa
      </button>
    </div>
    
    <div class="overflow-x-auto">
      <table class="w-full text-left">
        <thead class="bg-gray-50">
          <tr>
            <th class="py-3 px-4 font-semibold text-gray-700">No. Pesanan</th>
            <th class="py-3 px-4 font-semibold text-gray-700">Tanggal</th>
            <th class="py-3 px-4 font-semibold text-gray-700">Item</th>
            <th class="py-3 px-4 font-semibold text-gray-700">Jumlah</th>
            <th class="py-3 px-4 font-semibold text-gray-700">Total</th>
            <th class="py-3 px-4 font-semibold text-gray-700">Status</th>
            <th class="py-3 px-4 font-semibold text-gray-700">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
          <!-- Produk Transactions -->
          <tr class="hover:bg-gray-50 transition-colors" data-status="completed" data-type="product">
            <td class="py-3 px-4 font-medium">#12345</td>
            <td class="py-3 px-4">15 Mei 2025</td>
            <td class="py-3 px-4 flex items-center">
              <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-4.0.3&auto=format&fit=crop&w=40&h=40&q=80" 
                   alt="Meryl Lounge Chair" 
                   class="w-10 h-10 object-cover rounded-lg mr-3">
              <div>
                <p>Meryl Lounge Chair</p>
                <span class="text-xs text-gray-500">Produk</span>
              </div>
            </td>
            <td class="py-3 px-4">1</td>
            <td class="py-3 px-4 font-medium">Rp200,000</td>
            <td class="py-3 px-4">
              <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full flex items-center w-fit">
                <i data-lucide="check-circle" class="w-3 h-3 mr-1"></i> Selesai
              </span>
            </td>
            <td class="py-3 px-4 relative">
              <button class="text-orange-500 hover:text-orange-700 transaction-menu-btn" data-index="0">
                <i data-lucide="more-vertical" class="w-5 h-5"></i>
              </button>
              <div class="transaction-menu hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10 py-1">
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                  <i data-lucide="eye" class="w-4 h-4 inline mr-2"></i> Lihat Detail
                </a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                  <i data-lucide="file-text" class="w-4 h-4 inline mr-2"></i> Lihat Invoice
                </a>
              </div>
            </td>
          </tr>
          <tr class="hover:bg-gray-50 transition-colors" data-status="shipping" data-type="product">
            <td class="py-3 px-4 font-medium">#12346</td>
            <td class="py-3 px-4">10 Mei 2025</td>
            <td class="py-3 px-4 flex items-center">
              <img src="https://images.unsplash.com/photo-1600585152915-d208bec867a1?ixlib=rb-4.0.3&auto=format&fit=crop&w=40&h=40&q=80" 
                   alt="Sofa Minimalis" 
                   class="w-10 h-10 object-cover rounded-lg mr-3">
              <div>
                <p>Sofa Minimalis</p>
                <span class="text-xs text-gray-500">Produk</span>
              </div>
            </td>
            <td class="py-3 px-4">1</td>
            <td class="py-3 px-4 font-medium">Rp1,500,000</td>
            <td class="py-3 px-4">
              <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full flex items-center w-fit">
                <i data-lucide="truck" class="w-3 h-3 mr-1"></i> Dikirim
              </span>
            </td>
            <td class="py-3 px-4 relative">
              <button class="text-orange-500 hover:text-orange-700 transaction-menu-btn" data-index="1">
                <i data-lucide="more-vertical" class="w-5 h-5"></i>
              </button>
              <div class="transaction-menu hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10 py-1">
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 product-tracking-btn">
                  <i data-lucide="eye" class="w-4 h-4 inline mr-2"></i> Lihat Detail
                </a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                  <i data-lucide="file-text" class="w-4 h-4 inline mr-2"></i> Lihat Invoice
                </a>
              </div>
            </td>
          </tr>
          <tr class="hover:bg-gray-50 transition-colors" data-status="packing" data-type="product">
            <td class="py-3 px-4 font-medium">#12347</td>
            <td class="py-3 px-4">8 Mei 2025</td>
            <td class="py-3 px-4 flex items-center">
              <img src="https://images.unsplash.com/photo-1542372147193-a7aca54189cd?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
                   alt="Coffee Table" 
                   class="w-10 h-10 object-cover rounded-lg mr-3">
              <div>
                <p>Coffee Table</p>
                <span class="text-xs text-gray-500">Produk</span>
              </div>
            </td>
            <td class="py-3 px-4">2</td>
            <td class="py-3 px-4 font-medium">Rp750,000</td>
            <td class="py-3 px-4">
              <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full flex items-center w-fit">
                <i data-lucide="package" class="w-3 h-3 mr-1"></i> Sedang Dikemas
              </span>
            </td>
            <td class="py-3 px-4 relative">
              <button class="text-orange-500 hover:text-orange-700 transaction-menu-btn" data-index="2">
                <i data-lucide="more-vertical" class="w-5 h-5"></i>
              </button>
              <div class="transaction-menu hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10 py-1">
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                  <i data-lucide="eye" class="w-4 h-4 inline mr-2"></i> Lihat Detail
                </a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                  <i data-lucide="file-text" class="w-4 h-4 inline mr-2"></i> Lihat Invoice
                </a>
              </div>
            </td>
          </tr>
          
          <!-- Service Transactions -->
          <tr class="hover:bg-gray-50 transition-colors" data-status="completed" data-type="service">
            <td class="py-3 px-4 font-medium">#S12349</td>
            <td class="py-3 px-4">18 Mei 2025</td>
            <td class="py-3 px-4 flex items-center">
              <img src="https://images.unsplash.com/photo-1581783898377-1c85bf937427?ixlib=rb-4.0.3&auto=format&fit=crop&w=40&h=40&q=80" 
                   alt="Pemasangan AC" 
                   class="w-10 h-10 object-cover rounded-lg mr-3">
              <div>
                <p>Pemasangan AC</p>
                <span class="text-xs text-gray-500">Jasa</span>
              </div>
            </td>
            <td class="py-3 px-4">1</td>
            <td class="py-3 px-4 font-medium">Rp350,000</td>
            <td class="py-3 px-4">
              <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full flex items-center w-fit">
                <i data-lucide="check-circle" class="w-3 h-3 mr-1"></i> Selesai
              </span>
            </td>
            <td class="py-3 px-4 relative">
              <button class="text-orange-500 hover:text-orange-700 transaction-menu-btn" data-index="4">
                <i data-lucide="more-vertical" class="w-5 h-5"></i>
              </button>
              <div class="transaction-menu hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10 py-1">
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                  <i data-lucide="eye" class="w-4 h-4 inline mr-2"></i> Lihat Detail
                </a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                  <i data-lucide="file-text" class="w-4 h-4 inline mr-2"></i> Lihat Invoice
                </a>
              </div>
            </td>
          </tr>
          <tr class="hover:bg-gray-50 transition-colors" data-status="scheduled" data-type="service">
            <td class="py-3 px-4 font-medium">#S12350</td>
            <td class="py-3 px-4">20 Mei 2025</td>
            <td class="py-3 px-4 flex items-center">
              <img src="https://images.unsplash.com/photo-1584622650111-993a426fbf0a?ixlib=rb-4.0.3&auto=format&fit=crop&w=40&h=40&q=80" 
                   alt="Pembersihan Sofa" 
                   class="w-10 h-10 object-cover rounded-lg mr-3">
              <div>
                <p>Pembersihan Sofa</p>
                <span class="text-xs text-gray-500">Jasa</span>
              </div>
            </td>
            <td class="py-3 px-4">1</td>
            <td class="py-3 px-4 font-medium">Rp250,000</td>
            <td class="py-3 px-4">
              <span class="bg-indigo-100 text-indigo-800 text-xs px-2 py-1 rounded-full flex items-center w-fit">
                <i data-lucide="calendar" class="w-3 h-3 mr-1"></i> Terjadwal
              </span>
            </td>
            <td class="py-3 px-4 relative">
              <button class="text-orange-500 hover:text-orange-700 transaction-menu-btn" data-index="5">
                <i data-lucide="more-vertical" class="w-5 h-5"></i>
              </button>
              <div class="transaction-menu hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10 py-1">
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 service-tracking-btn">
                  <i data-lucide="eye" class="w-4 h-4 inline mr-2"></i> Lihat Detail
                </a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                  <i data-lucide="file-text" class="w-4 h-4 inline mr-2"></i> Lihat Invoice
                </a>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </section>

  <!-- Wishlist Section -->
  <section class="bg-white rounded-lg shadow p-6 mb-8">
    <h2 class="text-xl font-bold mb-6 flex items-center">
      <i data-lucide="heart" class="w-5 h-5 mr-2 text-orange-500"></i> Wishlist (5)
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
      <!-- Item 1 -->
      <div class="border rounded-lg overflow-hidden hover:shadow-lg transition-shadow">
        <div class="relative">
          <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&h=400&q=80" alt="Meryl Lounge Chair" class="w-full h-48 object-cover">
          <button class="absolute top-2 right-2 bg-white p-2 rounded-full shadow-md text-red-500 hover:bg-red-500 hover:text-white">
            <i data-lucide="heart" class="w-4 h-4"></i>
          </button>
        </div>
        <div class="p-4">
          <h3 class="font-semibold text-lg mb-1">Meryl Lounge Chair</h3>
          <div class="flex items-center mb-2">
            <div class="flex text-yellow-400">
              <i data-lucide="star" class="w-4 h-4 fill-current"></i>
              <i data-lucide="star" class="w-4 h-4 fill-current"></i>
              <i data-lucide="star" class="w-4 h-4 fill-current"></i>
              <i data-lucide="star" class="w-4 h-4 fill-current"></i>
              <i data-lucide="star" class="w-4 h-4 fill-current"></i>
            </div>
            <span class="text-gray-500 text-sm ml-2">(24)</span>
          </div>
          <p class="text-orange-500 font-bold text-lg mb-3">Rp200,000</p>
          <button class="w-full bg-orange-500 text-white py-2 rounded-lg hover:bg-orange-600 flex items-center justify-center">
            <i data-lucide="shopping-cart" class="w-4 h-4 mr-1"></i> Beli
          </button>
        </div>
      </div>
      <!-- Item 2 -->
      <div class="border rounded-lg overflow-hidden hover:shadow-lg transition-shadow">
        <div class="relative">
          <img src="https://images.unsplash.com/photo-1600585152915-d208bec867a1?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&h=400&q=80" alt="Sofa Minimalis" class="w-full h-48 object-cover">
          <button class="absolute top-2 right-2 bg-white p-2 rounded-full shadow-md text-red-500 hover:bg-red-500 hover:text-white">
            <i data-lucide="heart" class="w-4 h-4"></i>
          </button>
        </div>
        <div class="p-4">
          <h3 class="font-semibold text-lg mb-1">Sofa Minimalis</h3>
          <div class="flex items-center mb-2">
            <div class="flex text-yellow-400">
              <i data-lucide="star" class="w-4 h-4 fill-current"></i>
              <i data-lucide="star" class="w-4 h-4 fill-current"></i>
              <i data-lucide="star" class="w-4 h-4 fill-current"></i>
              <i data-lucide="star" class="w-4 h-4 fill-current"></i>
              <i data-lucide="star" class="w-4 h-4 fill-current"></i>
            </div>
            <span class="text-gray-500 text-sm ml-2">(18)</span>
          </div>
          <p class="text-orange-500 font-bold text-lg mb-3">Rp1,500,000</p>
          <button class="w-full bg-orange-500 text-white py-2 rounded-lg hover:bg-orange-600 flex items-center justify-center">
            <i data-lucide="shopping-cart" class="w-4 h-4 mr-1"></i> Beli
          </button>
        </div>
      </div>
    </div>
  </section>

  <!-- Order Tracking -->
  <section class="bg-white rounded-lg shadow p-6 mb-8">
    <h2 class="text-xl font-bold mb-6 flex items-center">
      <i data-lucide="truck" class="w-5 h-5 mr-2 text-orange-500"></i> Tracking Pesanan
    </h2>
    
    <!-- Tracking Type Tabs -->
    <div class="flex border-b mb-4">
      <button class="py-2 px-4 border-b-2 border-orange-500 text-orange-500 font-medium tracking-type-btn active" data-type="product">
        Produk
      </button>
      <button class="py-2 px-4 border-b-2 border-transparent hover:text-orange-500 tracking-type-btn" data-type="service">
        Jasa
      </button>
    </div>
    
    <div class="space-y-6">
      <!-- Product Order Card -->
      <div class="border rounded-lg p-4 hover:shadow-md transition-shadow tracking-card" data-type="product">
        <div class="flex justify-between items-center mb-4">
          <p class="font-semibold text-lg">#12346 - Sofa Minimalis</p>
          <p class="text-yellow-600 font-medium flex items-center">
            <i data-lucide="truck" class="w-4 h-4 mr-1"></i> Dikirim
          </p>
        </div>
        <div class="relative">
          <div class="absolute w-1 border-l-2 border-dashed border-gray-300 h-full left-5 top-0 z-0"></div>
          <div class="space-y-6">
            <!-- Step 1: Pesanan Dikonfirmasi -->
            <div class="flex items-start relative">
              <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white z-10">
                <i data-lucide="check" class="w-5 h-5"></i>
              </div>
              <div class="ml-6">
                <p class="font-semibold text-gray-800">Pesanan Dikonfirmasi</p>
                <p class="text-gray-500 text-sm">10 Mei 2025, 14:00 WIB</p>
              </div>
            </div>
            <!-- Step 2: Sedang Dikemas -->
            <div class="flex items-start relative">
              <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white z-10">
                <i data-lucide="package" class="w-5 h-5"></i>
              </div>
              <div class="ml-6">
                <p class="font-semibold text-gray-800">Sedang Dikemas</p>
                <p class="text-gray-500 text-sm">11 Mei 2025, 09:00 WIB</p>
              </div>
            </div>
            <!-- Step 3: Dikirim -->
            <div class="flex items-start relative">
              <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white z-10">
                <i data-lucide="truck" class="w-5 h-5"></i>
              </div>
              <div class="ml-6">
                <p class="font-semibold text-gray-800">Dikirim</p>
                <p class="text-gray-500 text-sm">12 Mei 2025, 13:30 WIB</p>
              </div>
            </div>
            <!-- Step 4: Sampai Tujuan -->
            <div class="flex items-start relative">
              <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center text-gray-600 z-10">
                <i data-lucide="home" class="w-5 h-5"></i>
              </div>
              <div class="ml-6">
                <p class="font-semibold text-gray-800">Sampai Tujuan</p>
                <p class="text-gray-500 text-sm">Estimasi 15 Mei 2025</p>
              </div>
            </div>
          </div>
        </div>
        <div class="mt-4">
          <button class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 flex items-center product-tracking-btn">
            <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Lihat Detail
          </button>
        </div>
      </div>
      
      <!-- Service Order Card -->
      <div class="border rounded-lg p-4 hover:shadow-md transition-shadow tracking-card hidden" data-type="service">
        <div class="flex justify-between items-center mb-4">
          <p class="font-semibold text-lg">#S12350 - Pembersihan Sofa</p>
          <p class="text-indigo-600 font-medium flex items-center">
            <i data-lucide="calendar" class="w-4 h-4 mr-1"></i> Terjadwal
          </p>
        </div>
        <div class="relative">
          <div class="absolute w-1 border-l-2 border-dashed border-gray-300 h-full left-5 top-0 z-0"></div>
          <div class="space-y-6">
            <!-- Step 1: Pesanan Dikonfirmasi -->
            <div class="flex items-start relative">
              <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white z-10">
                <i data-lucide="check" class="w-5 h-5"></i>
              </div>
              <div class="ml-6">
                <p class="font-semibold text-gray-800">Pesanan Dikonfirmasi</p>
                <p class="text-gray-500 text-sm">20 Mei 2025, 10:00 WIB</p>
              </div>
            </div>
            <!-- Step 2: Jadwal Ditetapkan -->
            <div class="flex items-start relative">
              <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white z-10">
                <i data-lucide="calendar" class="w-5 h-5"></i>
              </div>
              <div class="ml-6">
                <p class="font-semibold text-gray-800">Jadwal Ditetapkan</p>
                <p class="text-gray-500 text-sm">20 Mei 2025, 14:30 WIB</p>
              </div>
            </div>
            <!-- Step 3: Teknisi Dalam Perjalanan -->
            <div class="flex items-start relative">
              <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center text-gray-600 z-10">
                <i data-lucide="user" class="w-5 h-5"></i>
              </div>
              <div class="ml-6">
                <p class="font-semibold text-gray-800">Teknisi Dalam Perjalanan</p>
                <p class="text-gray-500 text-sm">Jadwal: 22 Mei 2025, 09:00 WIB</p>
              </div>
            </div>
            <!-- Step 4: Layanan Selesai -->
            <div class="flex items-start relative">
              <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center text-gray-600 z-10">
                <i data-lucide="check-circle" class="w-5 h-5"></i>
              </div>
              <div class="ml-6">
                <p class="font-semibold text-gray-800">Layanan Selesai</p>
                <p class="text-gray-500 text-sm">Estimasi: 22 Mei 2025</p>
              </div>
            </div>
          </div>
        </div>
        <div class="mt-4">
          <button class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 flex items-center service-tracking-btn">
            <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Lihat Detail
          </button>
        </div>
      </div>
    </div>
  </section>

  <!-- Address Management Section -->
  <section class="bg-white rounded-lg shadow p-6 mt-8">
    <div class="flex justify-between items-center mb-6">
      <h2 class="text-xl font-bold flex items-center">
        <i data-lucide="map-pin" class="w-5 h-5 mr-2 text-orange-500"></i> Daftar Alamat
      </h2>
      <button id="add-address-btn" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg flex items-center">
        <i data-lucide="plus" class="w-4 h-4 mr-2"></i> Tambah Alamat
      </button>
    </div>

    <div class="relative mb-6">
      <i data-lucide="search" class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
      <input type="text" placeholder="Cari Alamat" class="w-full pl-10 py-2 bg-gray-50 border-none rounded-lg">
    </div>

    <h3 class="text-lg font-semibold text-orange-500 mb-4">Semua Alamat</h3>

    <div class="space-y-4">
      <!-- Address Card 1 -->
      <div class="border rounded-lg p-4 hover:shadow-md transition-shadow" data-address-id="1">
        <div class="flex justify-between items-start">
          <h4 class="text-orange-500 font-semibold">Rumah</h4>
          <button class="edit-address-btn" data-index="0">
            <i data-lucide="edit" class="w-5 h-5 text-gray-400 cursor-pointer"></i>
          </button>
        </div>

        <div class="mt-2">
          <p class="font-semibold">Surya Nugraha</p>
          <p class="text-gray-500">62855659718873</p>
        </div>

        <p class="mt-2 text-gray-700">Kp. Pangadegan Girang No. 03 Rt/Rw 01/06 Desa Pegelaran Kec Pegelaran Kab Cianjur Jawabarat Indonesia 43266</p>

        <div class="flex items-center mt-2">
          <i data-lucide="map-pin" class="w-4 h-4 text-orange-500 mr-1"></i>
          <span class="text-orange-500 text-sm">Sudah Pinpoint</span>
        </div>

        <button class="w-full mt-3 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
          Ubah Alamat
        </button>
      </div>

      <!-- Address Card 2 -->
      <div class="border rounded-lg p-4 hover:shadow-md transition-shadow" data-address-id="2">
        <div class="flex justify-between items-start">
          <h4 class="text-orange-500 font-semibold">Kos</h4>
          <button class="edit-address-btn" data-index="1">
            <i data-lucide="edit" class="w-5 h-5 text-gray-400 cursor-pointer"></i>
          </button>
        </div>

        <div class="mt-2">
          <p class="font-semibold">Surya Nugraha</p>
          <p class="text-gray-500">62855659718873</p>
        </div>

        <p class="mt-2 text-gray-700">Ciganitri Mukti V No.45 Rt06/Rw11 Desa. Cipagalo Kec. Bojongsong Kab. Bandung 40288</p>

        <div class="flex items-center mt-2">
          <i data-lucide="map-pin" class="w-4 h-4 text-orange-500 mr-1"></i>
          <span class="text-orange-500 text-sm">Sudah Pinpoint</span>
        </div>

        <button class="w-full mt-3 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
          Ubah Alamat
        </button>
      </div>

      <!-- Address Card 3 -->
      <div class="border rounded-lg p-4 hover:shadow-md transition-shadow" data-address-id="3">
        <div class="flex justify-between items-start">
          <h4 class="text-orange-500 font-semibold">Rumah</h4>
          <button class="edit-address-btn" data-index="2">
            <i data-lucide="edit" class="w-5 h-5 text-gray-400 cursor-pointer"></i>
          </button>
        </div>

        <div class="mt-2">
          <p class="font-semibold">Alya Aulla</p>
          <p class="text-gray-500">628212465780</p>
        </div>

        <p class="mt-2 text-gray-700">Jl. A Makahanap G14 Komplek Dwikora, Perum Taman Galaksi, Halim Perdana Kusuma</p>

        <button class="w-full mt-3 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
          Ubah Alamat
        </button>
      </div>
    </div>
  </section>
</div>

<!-- Address Dialog -->
<div id="address-dialog" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden opacity-0 transition-opacity duration-200">
  <div class="bg-white rounded-lg w-full max-w-md p-6 transform scale-95 transition-transform duration-200">
    <div class="flex justify-between items-center mb-4">
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
          <input id="name" name="name" required class="w-full px-3 py-2 border border-gray-300 rounded-md" />
        </div>
        <div class="grid gap-2">
          <label for="phone" class="text-sm font-medium">Nomor Telepon</label>
          <input id="phone" name="phone" required class="w-full px-3 py-2 border border-gray-300 rounded-md" />
        </div>
        <div class="grid gap-2">
          <label for="address" class="text-sm font-medium">Alamat Lengkap</label>
          <textarea id="address" name="address" required rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md"></textarea>
        </div>
        <div class="grid gap-2">
          <label for="label" class="text-sm font-medium">Label (Rumah/Kos)</label>
          <input id="label" name="label" required class="w-full px-3 py-2 border border-gray-300 rounded-md" />
        </div>
      </div>
      <div class="flex justify-end gap-2">
        <button type="button" id="cancel-btn" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
          Batal
        </button>
        <button type="submit" class="px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white rounded-md">
          Simpan
        </button>
      </div>
    </form>
  </div>
</div>

<!-- Product Tracking Detail Dialog -->
<div id="product-tracking-dialog" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden opacity-0 transition-opacity duration-200">
  <div class="bg-white rounded-lg w-full max-w-2xl p-6 transform scale-95 transition-transform duration-200 max-h-[90vh] overflow-y-auto">
    <div class="flex justify-between items-center mb-4">
      <h3 class="text-lg font-semibold">Detail Pengiriman Produk</h3>
      <button class="close-tracking-dialog text-gray-500 hover:text-gray-700">
        <i data-lucide="x" class="w-5 h-5"></i>
      </button>
    </div>
    
    <div class="border-b pb-4 mb-4">
      <div class="flex justify-between items-start mb-2">
        <div>
          <p class="font-semibold text-lg">#12346 - Sofa Minimalis</p>
          <p class="text-gray-500">Tanggal Pembelian: 10 Mei 2025</p>
        </div>
        <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full flex items-center">
          <i data-lucide="truck" class="w-3 h-3 mr-1"></i> Dikirim
        </span>
      </div>
    </div>
    
    <div class="mb-6">
      <h4 class="font-semibold mb-2">Informasi Pengiriman</h4>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
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
      <h4 class="font-semibold mb-2">Alamat Pengiriman</h4>
      <div class="p-3 bg-gray-50 rounded-lg">
        <p class="font-medium">Surya Nugraha</p>
        <p>62855659718873</p>
        <p class="mt-1">Ciganitri Mukti V No.45 Rt06/Rw11 Desa. Cipagalo Kec. Bojongsong Kab. Bandung 40288</p>
      </div>
    </div>
    
    <div class="mb-6">
      <h4 class="font-semibold mb-2">Produk</h4>
      <div class="flex items-center p-3 bg-gray-50 rounded-lg">
        <img src="https://images.unsplash.com/photo-1600585152915-d208bec867a1?ixlib=rb-4.0.3&auto=format&fit=crop&w=80&h=80&q=80" alt="Sofa Minimalis" class="w-16 h-16 object-cover rounded mr-3">
        <div>
          <p class="font-medium">Sofa Minimalis</p>
          <p class="text-gray-500">1 x Rp1,500,000</p>
        </div>
      </div>
    </div>
    
    <div>
      <h4 class="font-semibold mb-2">Status Pengiriman</h4>
      <div class="relative pl-6">
        <!-- Fixed the vertical line positioning to be centered with the status circles -->
        <div class="absolute w-1 border-l-2 border-dashed border-gray-300 h-full left-4 top-0 z-0"></div>
        <div class="space-y-6">
          <div class="relative">
            <div class="absolute -left-4 w-8 h-8 bg-green-500 rounded-full flex items-center justify-center text-white z-10">
              <i data-lucide="check" class="w-4 h-4"></i>
            </div>
            <div class="ml-6">
              <p class="font-semibold text-gray-800">Pesanan Dikonfirmasi</p>
              <p class="text-gray-500 text-sm">10 Mei 2025, 14:00 WIB</p>
              <p class="text-gray-600 text-sm mt-1">Pesanan Anda telah dikonfirmasi dan sedang diproses.</p>
            </div>
          </div>
          <div class="relative">
            <div class="absolute -left-4 w-8 h-8 bg-green-500 rounded-full flex items-center justify-center text-white z-10">
              <i data-lucide="package" class="w-4 h-4"></i>
            </div>
            <div class="ml-6">
              <p class="font-semibold text-gray-800">Sedang Dikemas</p>
              <p class="text-gray-500 text-sm">11 Mei 2025, 09:00 WIB</p>
              <p class="text-gray-600 text-sm mt-1">Pesanan Anda sedang dikemas dan akan segera dikirim.</p>
            </div>
          </div>
          <div class="relative">
            <div class="absolute -left-4 w-8 h-8 bg-green-500 rounded-full flex items-center justify-center text-white z-10">
              <i data-lucide="truck" class="w-4 h-4"></i>
            </div>
            <div class="ml-6">
              <p class="font-semibold text-gray-800">Dikirim</p>
              <p class="text-gray-500 text-sm">12 Mei 2025, 13:30 WIB</p>
              <p class="text-gray-600 text-sm mt-1">Pesanan Anda telah dikirim dan sedang dalam perjalanan.</p>
            </div>
          </div>
          <div class="relative">
            <div class="absolute -left-4 w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center text-gray-600 z-10">
              <i data-lucide="home" class="w-4 h-4"></i>
            </div>
            <div class="ml-6">
              <p class="font-semibold text-gray-800">Sampai Tujuan</p>
              <p class="text-gray-500 text-sm">Estimasi 15 Mei 2025</p>
              <p class="text-gray-600 text-sm mt-1">Pesanan Anda akan segera tiba di alamat tujuan.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="mt-6 flex justify-end">
      <button class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 mr-2">
        Hubungi Kurir
      </button>
      <button class="px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white rounded-md">
        Lacak Pengiriman
      </button>
    </div>
  </div>
</div>

<!-- Service Tracking Detail Dialog -->
<div id="service-tracking-dialog" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden opacity-0 transition-opacity duration-200">
  <div class="bg-white rounded-lg w-full max-w-2xl p-6 transform scale-95 transition-transform duration-200 max-h-[90vh] overflow-y-auto">
    <div class="flex justify-between items-center mb-4">
      <h3 class="text-lg font-semibold">Detail Layanan</h3>
      <button class="close-tracking-dialog text-gray-500 hover:text-gray-700">
        <i data-lucide="x" class="w-5 h-5"></i>
      </button>
    </div>
    
    <div class="border-b pb-4 mb-4">
      <div class="flex justify-between items-start mb-2">
        <div>
          <p class="font-semibold text-lg">#S12350 - Pembersihan Sofa</p>
          <p class="text-gray-500">Tanggal Pemesanan: 20 Mei 2025</p>
        </div>
        <span class="bg-indigo-100 text-indigo-800 text-xs px-2 py-1 rounded-full flex items-center">
          <i data-lucide="calendar" class="w-3 h-3 mr-1"></i> Terjadwal
        </span>
      </div>
    </div>
    
    <div class="mb-6">
      <h4 class="font-semibold mb-2">Informasi Layanan</h4>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
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
      <h4 class="font-semibold mb-2">Alamat Layanan</h4>
      <div class="p-3 bg-gray-50 rounded-lg">
        <p class="font-medium">Surya Nugraha</p>
        <p>62855659718873</p>
        <p class="mt-1">Ciganitri Mukti V No.45 Rt06/Rw11 Desa. Cipagalo Kec. Bojongsong Kab. Bandung 40288</p>
      </div>
    </div>
    
    <div class="mb-6">
      <h4 class="font-semibold mb-2">Detail Layanan</h4>
      <div class="p-3 bg-gray-50 rounded-lg">
        <div class="flex justify-between mb-2">
          <p>Pembersihan Sofa (3 Seater)</p>
          <p class="font-medium">Rp250,000</p>
        </div>
        <div class="border-t pt-2 flex justify-between">
          <p class="font-medium">Total</p>
          <p class="font-medium">Rp250,000</p>
        </div>
      </div>
    </div>
    
    <div>
      <h4 class="font-semibold mb-2">Status Layanan</h4>
      <div class="relative pl-6">
        <div class="absolute w-1 border-l-2 border-dashed border-gray-300 h-full left-4 top-0 z-0"></div>
        <div class="space-y-6">
          <div class="relative">
            <div class="absolute -left-4 w-8 h-8 bg-green-500 rounded-full flex items-center justify-center text-white z-10">
              <i data-lucide="check" class="w-4 h-4"></i>
            </div>
            <div class="ml-6">
              <p class="font-semibold text-gray-800">Pesanan Dikonfirmasi</p>
              <p class="text-gray-500 text-sm">20 Mei 2025, 10:00 WIB</p>
              <p class="text-gray-600 text-sm mt-1">Pesanan layanan Anda telah dikonfirmasi.</p>
            </div>
          </div>
          <div class="relative">
            <div class="absolute -left-4 w-8 h-8 bg-green-500 rounded-full flex items-center justify-center text-white z-10">
              <i data-lucide="calendar" class="w-4 h-4"></i>
            </div>
            <div class="ml-6">
              <p class="font-semibold text-gray-800">Jadwal Ditetapkan</p>
              <p class="text-gray-500 text-sm">20 Mei 2025, 14:30 WIB</p>
              <p class="text-gray-600 text-sm mt-1">Jadwal layanan telah ditetapkan untuk 22 Mei 2025, 09:00 WIB.</p>
            </div>
          </div>
          <div class="relative">
            <div class="absolute -left-4 w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center text-gray-600 z-10">
              <i data-lucide="user" class="w-4 h-4"></i>
            </div>
            <div class="ml-6">
              <p class="font-semibold text-gray-800">Teknisi Dalam Perjalanan</p>
              <p class="text-gray-500 text-sm">Jadwal: 22 Mei 2025, 09:00 WIB</p>
              <p class="text-gray-600 text-sm mt-1">Teknisi akan datang ke lokasi Anda sesuai jadwal.</p>
            </div>
          </div>
          <div class="relative">
            <div class="absolute -left-4 w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center text-gray-600 z-10">
              <i data-lucide="check-circle" class="w-4 h-4"></i>
            </div>
            <div class="ml-6">
              <p class="font-semibold text-gray-800">Layanan Selesai</p>
              <p class="text-gray-500 text-sm">Estimasi: 22 Mei 2025</p>
              <p class="text-gray-600 text-sm mt-1">Layanan akan selesai setelah teknisi menyelesaikan pekerjaan.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="mt-6 flex justify-end">
      <button class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 mr-2">
        Hubungi Teknisi
      </button>
      <button class="px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white rounded-md">
        Konfirmasi Selesai
      </button>
    </div>
  </div>
</div>

@endsection



@section('scripts')
<script>
    // Inisialisasi setelah DOM siap
    document.addEventListener("DOMContentLoaded", function() {
        // Inisialisasi ikon Lucide
        lucide.createIcons();

        // --- Variabel DOM untuk fitur transaksi dan tracking ---
        const productTrackingBtns = document.querySelectorAll('.product-tracking-btn');
        const serviceTrackingBtns = document.querySelectorAll('.service-tracking-btn');
        const productTrackingDialog = document.getElementById('product-tracking-dialog');
        const serviceTrackingDialog = document.getElementById('service-tracking-dialog');
        const closeTrackingBtns = document.querySelectorAll('.close-tracking-dialog');
        const trackingTypeBtns = document.querySelectorAll('.tracking-type-btn');
        const trackingCards = document.querySelectorAll('.tracking-card');
        const filterBtns = document.querySelectorAll('.filter-btn');
        const transactionTypeBtns = document.querySelectorAll('.transaction-type-btn');
        const transactionRows = document.querySelectorAll('tbody tr');

        // --- Tab Riwayat Transaksi (Semua/Produk/Jasa) ---
        transactionTypeBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                // Reset style aktif pada semua tombol tab
                transactionTypeBtns.forEach(b => {
                    b.classList.remove('border-orange-500', 'text-orange-500');
                    b.classList.add('border-transparent');
                });
                // Aktifkan tab yang dipilih
                this.classList.remove('border-transparent');
                this.classList.add('border-orange-500', 'text-orange-500');
                // Filter baris transaksi sesuai tipe
                const type = this.getAttribute('data-type');
                transactionRows.forEach(row => {
                    if (type === 'all') {
                        row.classList.remove('hidden');
                    } else {
                        const rowType = row.getAttribute('data-type');
                        if (rowType === type) {
                            row.classList.remove('hidden');
                        } else {
                            row.classList.add('hidden');
                        }
                    }
                });
            });
        });

        //Event listener untuk tombol Ubah Alamat agar mengarah ke alamat
        const changeAddressBtn = document.getElementById('change-address-btn');

        changeAddressBtn.addEventListener('click', function() {
      // Scroll ke Address Seso
        const addressSection = document.querySelector('section:last-child');
        if (addressSection) {
            addressSection.scrollIntoView({ behavior: 'smooth' });
        }
        });

        // --- Tab Tracking Pesanan (Produk/Jasa) ---
        trackingTypeBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                // Reset style aktif pada semua tombol tab tracking
                trackingTypeBtns.forEach(b => {
                    b.classList.remove('border-orange-500', 'text-orange-500');
                    b.classList.add('border-transparent');
                });
                // Aktifkan tab yang dipilih
                this.classList.add('border-orange-500', 'text-orange-500');
                this.classList.remove('border-transparent');
                // Tampilkan tracking card sesuai tipe
                const type = this.getAttribute('data-type');
                trackingCards.forEach(card => {
                    if (card.getAttribute('data-type') === type) {
                        card.classList.remove('hidden');
                    } else {
                        card.classList.add('hidden');
                    }
                });
            });
        });

        

        // --- Buka dialog tracking produk ---
        productTrackingBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                productTrackingDialog.classList.remove('hidden');
                setTimeout(() => {
                    productTrackingDialog.classList.add('opacity-100');
                    productTrackingDialog.querySelector('.transform').classList.add('scale-100');
                    productTrackingDialog.querySelector('.transform').classList.remove('scale-95');
                }, 10);
            });
        });

        // --- Buka dialog tracking jasa ---
        serviceTrackingBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                serviceTrackingDialog.classList.remove('hidden');
                setTimeout(() => {
                    serviceTrackingDialog.classList.add('opacity-100');
                    serviceTrackingDialog.querySelector('.transform').classList.add('scale-100');
                    serviceTrackingDialog.querySelector('.transform').classList.remove('scale-95');
                }, 10);
            });
        });

        // --- Tutup dialog tracking (produk/jasa) ---
        closeTrackingBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const dialog = btn.closest('.fixed');
                dialog.classList.remove('opacity-100');
                dialog.querySelector('.transform').classList.remove('scale-100');
                dialog.querySelector('.transform').classList.add('scale-95');
                setTimeout(() => {
                    dialog.classList.add('hidden');
                }, 200);
            });
        });

        // --- Filter status transaksi (Belum Bayar, Dikirim, Selesai, dll) ---
        filterBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                // Reset style aktif pada semua filter
                filterBtns.forEach(b => {
                    b.classList.remove('bg-orange-500', 'text-white');
                    b.classList.add('bg-gray-200', 'text-gray-700');
                });
                // Aktifkan filter yang dipilih
                this.classList.remove('bg-gray-200', 'text-gray-700');
                this.classList.add('bg-orange-500', 'text-white');
                // Filter baris transaksi sesuai status & tipe
                const filter = this.getAttribute('data-filter');
                const activeTab = document.querySelector('.transaction-type-btn.text-orange-500').getAttribute('data-type');
                transactionRows.forEach(row => {
                    const rowType = row.getAttribute('data-type');
                    const rowStatus = row.getAttribute('data-status');
                    if (filter === 'all' && rowType === activeTab) {
                        row.classList.remove('hidden');
                    } else if (rowStatus === filter && rowType === activeTab) {
                        row.classList.remove('hidden');
                    } else {
                        row.classList.add('hidden');
                    }
                });
            });
        });

        // --- Tutup dialog tracking jika klik di luar konten dialog ---
        [productTrackingDialog, serviceTrackingDialog].forEach(dialog => {
            dialog.addEventListener('click', (e) => {
                if (e.target === dialog) {
                    dialog.classList.remove('opacity-100');
                    dialog.querySelector('.transform').classList.remove('scale-100');
                    dialog.querySelector('.transform').classList.add('scale-95');
                    setTimeout(() => {
                        dialog.classList.add('hidden');
                    }, 200);
                }
            });
        });

        // --- Tampilkan filter sesuai tab transaksi (Produk/Jasa) ---
        const productFilters = document.getElementById('product-filters');
        const serviceFilters = document.getElementById('service-filters');
        transactionTypeBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const type = this.getAttribute('data-type');
                productFilters.classList.add('hidden');
                serviceFilters.classList.add('hidden');
                if (type === 'product') {
                    productFilters.classList.remove('hidden');
                } else if (type === 'service') {
                    serviceFilters.classList.remove('hidden');
                }
            });
        });

        // --- Manajemen Alamat (Tambah/Edit) ---
        const elements = {
            addressDialog: document.getElementById('address-dialog'),
            addAddressBtn: document.getElementById('add-address-btn'),
            closeDialogBtn: document.getElementById('close-dialog'),
            cancelBtn: document.getElementById('cancel-btn'),
            addressForm: document.getElementById('address-form'),
            editAddressBtns: document.querySelectorAll('.edit-address-btn'),
        };

        // Fungsi membuka dialog alamat (mode tambah/edit)
        function openAddressDialog(isEdit = false, addressData = null) {
            elements.addressDialog.classList.remove('hidden');
            setTimeout(() => {
                elements.addressDialog.classList.add('opacity-100');
                elements.addressDialog.querySelector('.transform').classList.add('scale-100');
                elements.addressDialog.querySelector('.transform').classList.remove('scale-95');
            }, 10);

            // Jika mode edit, isi form dengan data alamat
            if (isEdit && addressData) {
                document.getElementById('name').value = addressData.name;
                document.getElementById('phone').value = addressData.phone;
                document.getElementById('address').value = addressData.address;
                document.getElementById('label').value = addressData.label;
                document.getElementById('dialog-title').textContent = 'Edit Alamat';
            } else {
                // Jika tambah, reset form
                elements.addressForm.reset();
                document.getElementById('dialog-title').textContent = 'Tambah Alamat';
            }
        }

        // Fungsi menutup dialog alamat
        function closeAddressDialog() {
            elements.addressDialog.classList.remove('opacity-100');
            elements.addressDialog.querySelector('.transform').classList.remove('scale-100');
            elements.addressDialog.querySelector('.transform').classList.add('scale-95');
            setTimeout(() => {
                elements.addressDialog.classList.add('hidden');
            }, 200);
        }

        // Event: klik tombol tambah alamat
        elements.addAddressBtn.addEventListener('click', () => openAddressDialog());

        // Event: klik tombol tutup/batal dialog alamat
        elements.closeDialogBtn.addEventListener('click', closeAddressDialog);
        elements.cancelBtn.addEventListener('click', closeAddressDialog);

        // Event: klik tombol edit alamat
        elements.editAddressBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                // Ambil data alamat dari card yang dipilih
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

        // Event: submit form alamat (tambah/edit)
        elements.addressForm.addEventListener('submit', function(e) {
            e.preventDefault();
            // Ambil data dari form
            const formData = {
                name: this.name.value,
                phone: this.phone.value,
                address: this.address.value,
                label: this.label.value
            };
            // --- TODO: Kirim data ke backend di sini ---
            console.log('Form submitted:', formData);
            closeAddressDialog();
        });
    });

        // --- Fitur Kebab Menu (tombol tiga titik pada transaksi) ---
        // Ambil semua tombol menu transaksi dan menu-nya
        const transactionMenuBtns = document.querySelectorAll('.transaction-menu-btn');
        const transactionMenus = document.querySelectorAll('.transaction-menu');

        // Fungsi untuk menutup semua menu
        function closeAllMenus() {
            transactionMenus.forEach(menu => {
                menu.classList.add('hidden');
            });
        }

        // Event listener untuk toggle (buka/tutup) menu saat tombol diklik
        transactionMenuBtns.forEach((btn, index) => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation(); // Mencegah event klik bubble ke document
                closeAllMenus(); // Tutup menu lain yang sedang terbuka
                transactionMenus[index].classList.toggle('hidden');
            });
        });

        // Tutup semua menu jika klik di luar menu
        document.addEventListener('click', function() {
            closeAllMenus();
        });

        // Mencegah menu tertutup jika klik di dalam menu
        transactionMenus.forEach(menu => {
            menu.addEventListener('click', function(e) {
                e.stopPropagation(); // Mencegah event klik bubble ke document
            });
        });
</script>
@endsection