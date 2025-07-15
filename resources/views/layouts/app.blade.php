<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Cafe Restaurant')</title>

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
  </style>
  @stack('styles')
</head>

<body>
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="{{ route('home') }}">
        <i class="fas fa-utensils me-2"></i>Cafe Restaurant
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
            <a class="nav-link" href="{{ route('about') }}">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('gallery') }}">Gallery</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('products') }}">Menu</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('reviews') }}">Reviews</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('contact') }}">Contact</a>
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
          <h5><i class="fas fa-utensils me-2"></i>Cafe Restaurant</h5>
          <p>Experience the finest dining with our carefully crafted menu and exceptional service in a warm, welcoming atmosphere.</p>
        </div>
        <div class="col-md-4">
          <h5>Contact Info</h5>
          <p><i class="fas fa-map-marker-alt me-2"></i>123 Restaurant Street, City</p>
          <p><i class="fas fa-phone me-2"></i>+1 234 567 8900</p>
          <p><i class="fas fa-envelope me-2"></i>info@caferestaurant.com</p>
        </div>
        <div class="col-md-4">
          <h5>Opening Hours</h5>
          <p><i class="fas fa-clock me-2"></i>Monday - Friday: 8:00 AM - 10:00 PM</p>
          <p><i class="fas fa-clock me-2"></i>Saturday - Sunday: 9:00 AM - 11:00 PM</p>
        </div>
      </div>
      <hr class="my-4">
      <div class="text-center">
        <p>&copy; {{ date('Y') }} Cafe Restaurant. All rights reserved.</p>
      </div>
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  @stack('scripts')
</body>

</html>