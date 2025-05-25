@extends('admin.layouts.app')

@section('title', 'Product Detail')

@section('content')
    <div style="padding: 1.5rem; max-width: 1200px; margin: 0 auto;">
        @include('admin.layouts.page-title', [
            'title' => 'Product Detail',
            'subtitle' => 'Detailed information about the product',
        ])

        @if(session('success'))
            <div style="margin-bottom: 1rem; padding: 1rem; background-color: #f0fdf4; color: #166534; border: 1px solid #bbf7d0; border-radius: 0.5rem;">
                {{ session('success') }}
            </div>
        @endif

        <div style="background-color: white; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); overflow: hidden;">
            <!-- Back Button -->
            <div style="padding: 1rem; border-bottom: 1px solid #e5e7eb;">
                <a href="{{ route('admin.pages.products') }}" 
                   style="display: inline-flex; align-items: center; padding: 0.5rem 1rem; background-color: #e5e7eb; color: #374151; font-size: 0.875rem; font-weight: 500; border-radius: 0.5rem; transition: background-color 0.2s;">
                    <iconify-icon icon="mdi:arrow-left" style="margin-right: 0.25rem;"></iconify-icon>
                    Back to Products
                </a>
            </div>

            <!-- Product Detail Content -->
            <div style="padding: 1.5rem; display: grid; grid-template-columns: 1fr; gap: 2rem;">
                @if($product->images->count() > 0)
                <!-- Product Images -->
                <div>
                    <!-- Primary Image -->
                    <div style="
                        background-image: url('https://images.unsplash.com/photo-1620336655052-b57986f5a26a?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTF8fGNhcnRvb258ZW58MHx8MHx8fDA%3D');
                        background-size: cover;
                        background-position: center;
                        background-repeat: no-repeat;
                        border-radius: 0.5rem;
                        padding: 1rem;
                        margin-bottom: 1rem;
                        height: 20rem;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                    ">
                        @if($primaryImage = $product->images->where('is_primary', true)->first())
                            <img src="{{ asset('storage/'.$primaryImage->path) }}" 
                                 alt="Primary Product Image" 
                                 style="height: 100%; width: 100%; object-fit: contain; border-radius: 0.375rem;">
                        @else
                            <div style="text-align: center; color: #9ca3af; font-style: italic;">
                                <iconify-icon icon="mdi:image-off" width="48"></iconify-icon>
                                <p>No primary image</p>
                            </div>
                        @endif
                    </div>

                    <!-- Thumbnail Gallery -->
                    @if($product->images->count() > 1)
                        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 0.5rem;">
                            @foreach($product->images as $image)
                                <div style="background-color:rgb(21, 3, 155); border-radius: 0.25rem; padding: 0.25rem; height: 6rem; display: flex; justify-content: center; align-items: center; border: 1px solid #e5e7eb;">
                                    <img src="{{ asset('storage/'.$image->path) }}" 
                                         alt="Product Thumbnail" 
                                         style="height: 100%; width: 100%; object-fit: cover; border-radius: 0.125rem; cursor: pointer;"
                                         onclick="this.closest('div').parentElement.previousElementSibling.querySelector('img').src = this.src">
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                @endif

                <!-- Product Information -->
                <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                    <!-- Basic Info -->
                    <div>
                        <h2 style="font-size: 1.5rem; font-weight: 700; color: #111827;">{{ $product->name }}</h2>
                        <p style="font-size: 1.125rem; color: #2563eb; font-weight: 600; margin-top: 0.5rem;">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </p>
                    </div>

                    <!-- Stock & Category -->
                    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem;">
                        <div>
                            <p style="font-size: 0.875rem; color: #6b7280;">Stock</p>
                            <?php $stockColor = $product->stock > 0 ? '#16a34a' : '#dc2626'; ?>

                            <p style="font-size: 1.125rem; font-weight: 500; color: <?= $stockColor; ?>;">
                                {{ $product->stock }} {{ $product->stock > 0 ? 'available' : 'out of stock' }}
                            </p>
                        </div>
                        <div>
                            <p style="font-size: 0.875rem; color: #6b7280;">Category</p>
                            <p style="font-size: 1.125rem; font-weight: 500; color: #111827;">
                                {{ $product->category->category_name ?? 'Uncategorized' }}
                            </p>
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <p style="font-size: 0.875rem; color: #6b7280; margin-bottom: 0.5rem;">Description</p>
                        <div style="color: #374151; white-space: pre-line;">
                            {{ $product->description }}
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div style="display: flex; gap: 1rem; padding-top: 1rem;">
                        <a href="{{ route('admin.pages.products.edit', $product->product_id) }}" 
                           style="display: inline-flex; align-items: center; padding: 0.5rem 1rem; background-color: #4f46e5; color: white; font-size: 0.875rem; font-weight: 500; border-radius: 0.5rem; transition: background-color 0.2s;">
                            <iconify-icon icon="uil:edit" style="margin-right: 0.25rem;"></iconify-icon>
                            Edit Product
                        </a>
                        <form action="{{ route('admin.pages.products.destroy', $product->product_id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    style="display: inline-flex; align-items: center; padding: 0.5rem 1rem; background-color: #dc2626; color: white; font-size: 0.875rem; font-weight: 500; border-radius: 0.5rem; transition: background-color 0.2s; border: none; cursor: pointer;"
                                    onclick="return confirm('Are you sure you want to delete this product?')">
                                <iconify-icon icon="mdi:delete-outline" style="margin-right: 0.25rem;"></iconify-icon>
                                Delete Product
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Additional Information Section -->
            <div style="padding: 1.5rem; border-top: 1px solid #e5e7eb;">
                <h3 style="font-size: 1.125rem; font-weight: 500; color: #111827; margin-bottom: 1rem;">Additional Information</h3>
                <div style="display: grid; grid-template-columns: repeat(1, 1fr); gap: 1.5rem;">
                    <div style="background-color: #f9fafb; padding: 1rem; border-radius: 0.5rem;">
                        <p style="font-size: 0.875rem; color: #6b7280;">Product ID</p>
                        <p style="font-weight: 500;">{{ $product->product_id }}</p>
                    </div>
                    <div style="background-color: #f9fafb; padding: 1rem; border-radius: 0.5rem;">
                        <p style="font-size: 0.875rem; color: #6b7280;">Images Count</p>
                        <p style="font-weight: 500;">{{ $product->images->count() }}</p>
                    </div>
                    <div style="background-color: #f9fafb; padding: 1rem; border-radius: 0.5rem;">
                        <p style="font-size: 0.875rem; color: #6b7280;">Created At</p>
                        <p style="font-weight: 500;">{{ $product->created_at->format('d M Y H:i') }}</p>
                    </div>
                    <div style="background-color: #f9fafb; padding: 1rem; border-radius: 0.5rem;">
                        <p style="font-size: 0.875rem; color: #6b7280;">Last Updated</p>
                        <p style="font-weight: 500;">{{ $product->updated_at->format('d M Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
@endpush