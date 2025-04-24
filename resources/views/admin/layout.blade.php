<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - Jasa Home Service')</title>

    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
        <img src="{{ asset('images/logohomedaily-removebg-preview.png') }}" alt="HomeDaily Logo" class="logo-image">
            <h4 class="brand-title">HomeDaily</h4>
        </div>
        <nav>
            <a href="{{ route('admin.dashboard') }}" class="nav-link">
                <i class="fas fa-home"></i> <span>Dashboard</span>
            </a>
            <a href="{{ route('service.index') }}" class="nav-link">
                <i class="fas fa-cogs"></i> <span>Produk atau Jasa</span>
            </a>
            <a href="{{ route('categories.index')   }}" class="nav-link">
            <i class="fas fa-cogs"> </i> <span>Kategori</span>
            </a>
    
</nav>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="nav-link logout-btn">
                    <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
                </button>
            </form>
        </nav>
    </div>

    <div class="main-content">
        <header class="top-bar">
            <div class="breadcrumb">
                <i class="fas fa-bars menu-toggle"></i>
                <h2>@yield('title', 'Dashboard')</h2>
            </div>
            <div class="user-info">
                <i class="fas fa-user-circle"></i>
                <span>Admin</span>
            </div>
        </header>

        <main class="content">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @yield('content')
        </main>
    </div>
</body>
</html>
