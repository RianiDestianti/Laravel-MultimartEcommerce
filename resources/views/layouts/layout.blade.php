<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - MultiMart</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        
        .navbar {
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 12px 0;
            background: linear-gradient(135deg, #3a1c71, #d76d77, #ffaf7b);
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.6rem;
            letter-spacing: 1px;
        }
        
        .nav-link {
            font-weight: 500;
            margin: 0 10px;
            transition: all 0.3s;
            position: relative;
        }
        
        .nav-link:after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            display: block;
            margin-top: 5px;
            right: 0;
            background: #fff;
            transition: width 0.3s ease;
        }
        
        .nav-link:hover:after {
            width: 100%;
            left: 0;
        }
        
        .hero-section {
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://source.unsplash.com/random/1200x400/?supermarket');
            background-size: cover;
            color: white;
            padding: 80px 0;
            margin-bottom: 40px;
            border-radius: 0 0 20px 20px;
        }
        
        .card {
            border: none;
            transition: transform 0.3s, box-shadow 0.3s;
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        
        .card-img-top {
            height: 220px;
            object-fit: cover;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #3a1c71, #d76d77);
            border: none;
            padding: 10px 20px;
            border-radius: 50px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
            background: linear-gradient(135deg, #4a2c81, #e77d87);
        }
        
        .page-header {
            border-bottom: 2px solid #f8f9fa;
            padding-bottom: 15px;
            margin-bottom: 30px;
            position: relative;
        }
        
        .page-header:after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 80px;
            height: 2px;
            background: linear-gradient(135deg, #3a1c71, #d76d77);
        }
        
        footer {
            background: #343a40;
            color: #fff;
            padding: 40px 0 20px;
            margin-top: 50px;
        }
        
        .form-control, .form-select {
            border-radius: 8px;
            padding: 12px 15px;
            border: 1px solid #ced4da;
        }
        
        .form-label {
            font-weight: 500;
            margin-bottom: 8px;
        }
        
        .product-price {
            font-size: 1.2rem;
            font-weight: 700;
            color: #d76d77;
        }
        
        .badge-category {
            background: linear-gradient(135deg, #3a1c71, #d76d77);
            color: white;
            font-weight: 500;
            padding: 5px 10px;
            border-radius: 50px;
        }
        
        .search-box {
            position: relative;
            margin-bottom: 30px;
        }
        
        .search-box input {
            padding-left: 40px;
            border-radius: 50px;
        }
        
        .search-box i {
            position: absolute;
            left: 15px;
            top: 14px;
            color: #aaa;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('products.index') }}">
                <i class="fas fa-shopping-cart me-2"></i>MultiMart
            </a>
            <button id="darkModeToggle">☀️</button>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.index') }}">
                            <i class="fas fa-home me-1"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.create') }}">
                            <i class="fas fa-plus-circle me-1"></i> Tambah Produk
                        </a>
                    </li>
                    <li class="nav-item">
    <a class="nav-link" href="{{ route('products.riwayat') }}">
        <i class="fas fa-receipt"></i> Riwayat Pesanan
    </a>
</li>

                    <li class="nav-item">
    <a class="nav-link" href="{{ route('products.akun') }}">
        <i class="fas fa-user me-1"></i> Akun
    </a>
</li>
                </ul>
            </div>
        </div>
    </nav>
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

   
    <!-- Hero Section (Only on home page) -->
    @if(request()->routeIs('products.index'))
    <div class="hero-section">
        <div class="container text-center">
        @if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<h1>Selamat datang, {{ session('user_name') }}</h1>
            <h1 class="display-4 mb-3">Selamat Datang di MultiMart</h1>
            
            <p class="lead mb-4">Temukan berbagai produk berkualitas dengan harga terbaik</p>
            <form action="{{ route('products.index') }}" method="GET" class="mb-3 d-flex">
        <input type="text" name="search" class="form-control me-2" placeholder="Cari produk..." value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary">Cari</button>
    </form>
        </div>
    </div>
    @endif

    <div class="container mt-4">
        @if(!request()->routeIs('products.index'))
        <div class="page-header">
            <h2>@yield('page-title', 'Judul Halaman')</h2>
        </div>
        @endif
        
        @yield('content')
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5 class="mb-3">MultiMart</h5>
                    <p>Toko online terpercaya dengan berbagai produk berkualitas dan harga terjangkau.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="mb-3">Link Cepat</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-decoration-none text-white-50">Tentang Kami</a></li>
                        <li><a href="#" class="text-decoration-none text-white-50">Kebijakan Privasi</a></li>
                        <li><a href="#" class="text-decoration-none text-white-50">Syarat & Ketentuan</a></li>
                        <li><a href="#" class="text-decoration-none text-white-50">Hubungi Kami</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="mb-3">Hubungi Kami</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-map-marker-alt me-2"></i> Jl. Contoh No. 123, Jakarta</li>
                        <li><i class="fas fa-phone me-2"></i> (021) 123-4567</li>
                        <li><i class="fas fa-envelope me-2"></i> info@multimart.com</li>
                    </ul>
                    <div class="mt-3">
                        <a href="#" class="text-white me-2"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white me-2"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white me-2"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
            </div>
            <div class="text-center pt-3 mt-3 border-top border-secondary">
                <p class="text-white-50">© 2025 MultiMart. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/darkmode.js') }}"></script>
    <!-- <script src="/js/darkmode.js"></script> -->
     
     


</body>
</html>