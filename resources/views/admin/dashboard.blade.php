@extends('admin.layout')

@section('content')
<div class="container">
    <h1 class="my-4">Admin Dashboard</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Welcome to the Admin Panel</h5>
                </div>
                <div class="card-body">
                    <p>Manage your services efficiently from this dashboard.</p>
                    <a href="{{ route('service.index') }}" class="btn btn-primary">Manage Services</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection