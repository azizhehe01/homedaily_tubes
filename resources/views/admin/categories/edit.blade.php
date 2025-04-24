@extends('admin.layout')

@section('content')
<div class="container">
    <h1>Edit Kategori</h1>

    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Nama Kategori</label>
            <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
        </div>

        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="description" class="form-control" rows="3">{{ $category->description }}</textarea>
        </div>

        <div class="form-group">
            <label>Tipe</label>
            <select name="type" class="form-control" required>
                <option value="">Pilih Tipe</option>
                <option value="produk" {{ $category->type == 'produk' ? 'selected' : '' }}>Produk</option>
                <option value="jasa" {{ $category->type == 'jasa' ? 'selected' : '' }}>Jasa</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Update
        </button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </form>
</div>
@endsection