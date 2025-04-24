@extends('admin.layout')

@section('content')
<div class="container">
    <h1>Daftar Jasa/Produk </h1>
    
    <a href="{{ route('service.create') }}" class="btn btn-primary mb-3">Tambah Jasa/Baru produk baru </a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Category</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($services as $service)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $service->name }}</td>
                <td>{{ $service->description }}</td>
                <td>Rp {{ number_format($service->price, 0, ',', '.') }}</td>
                <td>{{$service->category ? $service->category->name : 'Tidak ada kategori' }}</td>
                <td>
                    <a href="{{ route('service.edit', $service->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('service.destroy', $service->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection