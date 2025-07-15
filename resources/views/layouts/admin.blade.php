<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Admin Panel - Sentra Durian Tegal')</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <style>
    .sidebar {
      min-height: 100vh;
      background-color: #2c3e50;
    }

    .sidebar .nav-link {
      color: #bdc3c7;
      padding: 1rem 1.5rem;
      border-radius: 0;
    }

    .sidebar .nav-link:hover,
    .sidebar .nav-link.active {
      color: white;
      background-color: #34495e;
    }

    .main-content {
      margin-left: 0;
    }

    @media (min-width: 992px) {
      .main-content {
        margin-left: 250px;
      }
    }

    .stat-card {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      border-radius: 10px;
    }

    .stat-card.warning {
      background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }

    .stat-card.success {
      background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }

    .stat-card.info {
      background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
    }

    .sidebar .nav-link.btn {
      background: none;
      border: none;
      color: #bdc3c7;
      text-align: left;
      transition: all 0.3s ease;
    }

    .sidebar .nav-link.btn:hover {
      color: white;
      background-color: #34495e;
    }
  </style>
  @stack('styles')
</head>

<body>
  <div class="d-flex">
    <!-- Sidebar -->
    <nav class="sidebar bg-dark position-fixed d-lg-block d-none" style="width: 250px; z-index: 1000;">
      <div class="p-3">
        <h5 class="text-white">
          <i class="fas fa-utensils me-2"></i>Admin Panel
        </h5>
      </div>

      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('admin.galleries.*') ? 'active' : '' }}" href="{{ route('admin.galleries.index') }}">
            <i class="fas fa-images me-2"></i>Gallery Management
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}" href="{{ route('admin.products.index') }}">
            <i class="fas fa-utensils me-2"></i>Product Management
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}" href="{{ route('admin.reviews.index') }}">
            <i class="fas fa-star me-2"></i>Review Management
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}" href="{{ route('admin.contacts.index') }}">
            <i class="fas fa-envelope me-2"></i>Contact Messages
          </a>
        </li>
        <li class="nav-item mt-4">
          <a class="nav-link" href="{{ route('home') }}" target="_blank">
            <i class="fas fa-external-link-alt me-2"></i>View Website
          </a>
        </li>
        <li class="nav-item">
          <form method="POST" action="{{ route('admin.logout') }}" class="d-inline">
            @csrf
            <button type="submit" class="nav-link btn btn-link text-start w-100 border-0"
              onclick="return confirm('Apakah Anda yakin ingin logout?')"
              style="color: #bdc3c7; padding: 1rem 1.5rem;">
              <i class="fas fa-sign-out-alt me-2"></i>Logout
            </button>
          </form>
        </li>
      </ul>
    </nav>

    <!-- Mobile Toggle Button -->
    <button class="btn btn-dark d-lg-none position-fixed" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMobile" style="top: 10px; left: 10px; z-index: 1050;">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Mobile Sidebar -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebarMobile">
      <div class="offcanvas-header bg-dark text-white">
        <h5 class="offcanvas-title">
          <i class="fas fa-utensils me-2"></i>Admin Panel
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
      </div>
      <div class="offcanvas-body bg-dark p-0">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
              <i class="fas fa-tachometer-alt me-2"></i>Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.galleries.*') ? 'active' : '' }}" href="{{ route('admin.galleries.index') }}">
              <i class="fas fa-images me-2"></i>Gallery Management
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}" href="{{ route('admin.products.index') }}">
              <i class="fas fa-utensils me-2"></i>Product Management
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}" href="{{ route('admin.reviews.index') }}">
              <i class="fas fa-star me-2"></i>Review Management
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}" href="{{ route('admin.contacts.index') }}">
              <i class="fas fa-envelope me-2"></i>Contact Messages
            </a>
          </li>
          <li class="nav-item mt-4">
            <a class="nav-link" href="{{ route('home') }}" target="_blank">
              <i class="fas fa-external-link-alt me-2"></i>View Website
            </a>
          </li>
          <li class="nav-item">
            <form method="POST" action="{{ route('admin.logout') }}" class="d-inline">
              @csrf
              <button type="submit" class="nav-link btn btn-link text-start w-100 border-0"
                onclick="return confirm('Apakah Anda yakin ingin logout?')"
                style="color: #bdc3c7; padding: 1rem 1.5rem;">
                <i class="fas fa-sign-out-alt me-2"></i>Logout
              </button>
            </form>
          </li>
        </ul>
      </div>
    </div>

    <!-- Main Content -->
    <main class="main-content flex-grow-1 p-4">
      <!-- Admin Header -->
      <div class="d-flex justify-content-between align-items-center mb-4 bg-light p-3 rounded">
        <div>
          <h6 class="mb-0">Selamat datang, <strong>{{ Auth::user()->name }}</strong></h6>
          <small class="text-muted">{{ Auth::user()->email }}</small>
        </div>
        <div class="d-flex align-items-center">
          <span class="badge bg-success me-2">
            <i class="fas fa-circle me-1"></i>Online
          </span>
          <form method="POST" action="{{ route('admin.logout') }}" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-outline-danger btn-sm"
              onclick="return confirm('Apakah Anda yakin ingin logout?')">
              <i class="fas fa-sign-out-alt me-1"></i>Logout
            </button>
          </form>
        </div>
      </div>

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
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  @stack('scripts')
</body>

</html>