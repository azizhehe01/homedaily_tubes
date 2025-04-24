@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0">Product Details</h2>
        </div>
        <div class="card-body">
            @if($product->image)
                <div class="text-center mb-4">
                    <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded" style="max-height: 300px;">
                </div>
            @endif
            
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Product Name:</div>
                <div class="col-md-9">{{ $product->name }}</div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Description:</div>
                <div class="col-md-9">{{ $product->description ?? '-' }}</div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Price:</div>
                <div class="col-md-9">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Stock:</div>
                <div class="col-md-9">{{ $product->stock }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Category :</div>
                <div class="col-md-9">{{ $product->category }}</div>
            </div>
            
            <div class="mt-4 d-flex gap-2">
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this product?')">Delete</button>
                </form>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
    </div>
@endsection