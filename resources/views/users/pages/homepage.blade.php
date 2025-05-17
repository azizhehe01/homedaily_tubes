@extends('users.components.layout')

@section('title', 'Welcome to HomeDaily')
@section('description', 'Find the best furniture for your home')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-[#152c5b] mb-8">Featured Products</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Product Card -->
        <a href="{{ route('product.detail', ['id' => 1]) }}" class="group">
            <div class="border rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                <img src="https://via.placeholder.com/400x300" alt="Modern Comfort Sofa" class="w-full h-64 object-cover">
                <div class="p-4">
                    <h2 class="text-xl font-semibold text-[#152c5b] group-hover:text-[#ea8c00]">Modern Comfort Sofa</h2>
                    <p class="text-gray-500 mt-2">Premium Quality | Handcrafted</p>
                    <p class="text-[#ea8c00] font-semibold mt-2">$599.99</p>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection