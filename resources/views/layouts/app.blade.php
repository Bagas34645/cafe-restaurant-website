<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Sentra Durian Tegal')</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <style>
    .navbar-brand {
      font-size: 1.8rem;
      font-weight: bold;
    }

    .hero-section {
      background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');
      background-size: cover;
      background-position: center;
      min-height: 70vh;
      display: flex;
      align-items: center;
      color: white;
    }

    .card {
      border: none;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease;
    }

    .card:hover {
      transform: translateY(-5px);
    }

    .footer {
      background-color: #2c3e50;
      color: white;
      padding: 3rem 0 1rem;
    }

    .btn-primary {
      background-color: #e74c3c;
      border-color: #e74c3c;
    }

    .btn-primary:hover {
      background-color: #c0392b;
      border-color: #c0392b;
    }

    .star-rating {
      color: #ffc107;
    }

    /* Custom Pagination Styles */
    .pagination-nav .pagination {
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
      overflow: hidden;
    }

    .pagination-nav .page-link {
      border: none;
      padding: 12px 16px;
      color: #495057;
      background-color: #f8f9fa;
      transition: all 0.3s ease;
      font-weight: 500;
    }

    .pagination-nav .page-link:hover {
      background-color: #e9ecef;
      color: #e74c3c;
      transform: translateY(-2px);
    }

    .pagination-nav .page-item.active .page-link {
      background-color: #e74c3c;
      border-color: #e74c3c;
      color: white;
      box-shadow: 0 4px 8px rgba(231, 76, 60, 0.3);
    }

    .pagination-nav .page-item.disabled .page-link {
      background-color: #f8f9fa;
      color: #6c757d;
      opacity: 0.6;
    }

    .pagination-nav .page-item:first-child .page-link {
      border-top-left-radius: 10px;
      border-bottom-left-radius: 10px;
    }

    .pagination-nav .page-item:last-child .page-link {
      border-top-right-radius: 10px;
      border-bottom-right-radius: 10px;
    }

    .pagination-info {
      background-color: #f8f9fa;
      padding: 8px 16px;
      border-radius: 20px;
      display: inline-block;
    }
  </style>
  @stack('styles')
</head>

<body>
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="{{ route('home') }}">
        <i class="fas fa-leaf me-2"></i>Sentra Durian Tegal
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('about') }}">Tentang</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('gallery') }}">Galeri</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('products') }}">Produk</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('reviews') }}">Testimoni</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('contact') }}">Kontak</a>
          </li>
          <li class="nav-item">
            <a class="nav-link btn btn-outline-light ms-2 px-3" href="{{ route('admin.login') }}">Admin</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <main style="margin-top: 76px;">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{ session('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @yield('content')
  </main>

  <!-- Footer -->
  <footer class="footer mt-5">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <h5><i class="fas fa-leaf me-2"></i>Sentra Durian Tegal</h5>
          <p>Rajane Duren - Pusat Penjualan Durian Berkualitas</p>
          <p>Sentra Durian Tegal adalah pusat informasi dan distribusi durian unggulan langsung dari kebun terbaik di Tegal. Kami berkomitmen menyediakan durian berkualitas tinggi untuk konsumsi pribadi maupun kebutuhan bisnis Anda.</p>
        </div>
        <div class="col-md-4">
          <h5>Info Kontak</h5>
          <p><i class="fas fa-map-marker-alt me-2"></i>Tegal, Jawa Tengah</p>
          <p><i class="fas fa-phone me-2"></i>+62 123 456 789</p>
          <p><i class="fas fa-envelope me-2"></i>info@sentradurian.com</p>
        </div>
        <div class="col-md-4">
          <h5>Jam Buka</h5>
          <p><i class="fas fa-clock me-2"></i>Senin - Jumat: 08:00 - 18:00 WIB</p>
          <p><i class="fas fa-clock me-2"></i>Sabtu - Minggu: 08:00 - 20:00 WIB</p>
        </div>
      </div>
      <hr class="my-4">
      <div class="text-center">
        <p>&copy; {{ date('Y') }} Sentra Durian Tegal. All rights reserved.</p>
      </div>
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  @stack('scripts')
</body>

</html>