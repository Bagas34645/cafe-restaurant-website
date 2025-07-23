<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Admin Panel - Sentra Durian Tegal')</title>

  <!-- Favicon Admin -->
  <link rel="icon" type="image/x-icon" href="{{ asset('admin.ico') }}">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <!-- Eco Nature Theme CSS -->
  <link href="{{ asset('css/eco-nature-theme.css') }}" rel="stylesheet">
  <!-- Custom CSS -->
  <style>
    .sidebar {
      min-height: 100vh;
      background-color: #1C5B40;
    }

    .sidebar .nav-link {
      color: #DFF5EA;
      padding: 1rem 1.5rem;
      border-radius: 0;
    }

    .sidebar .nav-link:hover,
    .sidebar .nav-link.active {
      color: #FFFFFF;
      background-color: #2FA365;
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
      background: linear-gradient(135deg, #2FA365 0%, #1C5B40 100%);
      color: #FFFFFF;
      border-radius: 10px;
    }

    .stat-card.warning {
      background: linear-gradient(135deg, #A3E0E0 0%, #2FA365 100%);
      color: #2C2C2C;
    }

    .stat-card.success {
      background: linear-gradient(135deg, #2FA365 0%, #DFF5EA 100%);
      color: #2C2C2C;
    }

    .stat-card.info {
      background: linear-gradient(135deg, #DFF5EA 0%, #A3E0E0 100%);
      color: #2C2C2C;
    }

    /* Enhanced Dashboard Cards */
    .hover-bg-light:hover {
      background-color: #DFF5EA !important;
      transition: all 0.3s ease;
    }

    .transition-all {
      transition: all 0.3s ease;
    }

    .hover-opacity-10:hover {
      opacity: 0.1 !important;
    }

    .min-width-0 {
      min-width: 0;
    }

    .card {
      transition: all 0.3s ease;
    }

    .card:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1) !important;
    }

    .badge {
      font-size: 0.75rem;
      font-weight: 500;
    }

    .text-truncate {
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
    }

    .text-nowrap {
      white-space: nowrap !important;
    }

    /* Responsive improvements for admin dashboard */
    @media (max-width: 768px) {
      .card-header h5 {
        font-size: 0.9rem;
      }

      .btn-sm {
        font-size: 0.75rem;
        padding: 0.25rem 0.5rem;
      }

      .badge {
        font-size: 0.7rem;
      }
    }

    /* Quick Actions Styling */
    .bg-gradient {
      background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
      border-bottom: 1px solid #dee2e6;
    }

    .action-text {
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .btn-lg {
      min-height: 60px;
      padding: 0.75rem 1rem;
      font-size: 1rem;
      font-weight: 500;
      border-radius: 0.5rem;
      transition: all 0.3s ease;
    }

    .btn-lg:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    /* Responsive text for Quick Actions */
    @media (max-width: 1200px) {
      .action-text {
        font-size: 0.9rem;
      }
    }

    @media (max-width: 992px) {
      .action-text {
        font-size: 0.85rem;
      }
    }

    @media (max-width: 768px) {
      .btn-lg {
        min-height: 50px;
        font-size: 0.875rem;
        padding: 0.5rem 0.75rem;
      }

      .action-text {
        font-size: 0.8rem;
      }
    }

    .sidebar .nav-link.btn {
      background: none;
      border: none;
      color: #DFF5EA;
      text-align: left;
      transition: all 0.3s ease;
    }

    .sidebar .nav-link.btn:hover {
      color: #FFFFFF;
      background-color: #2FA365;
    }

    /* Custom Pagination Styles - Enhanced for Admin */
    .pagination-wrapper {
      max-width: 600px;
      margin: 0 auto;
    }

    .pagination-nav .pagination {
      box-shadow: 0 2px 15px rgba(47, 163, 101, 0.08);
      border-radius: 12px;
      overflow: hidden;
      background: #FFFFFF;
      padding: 8px;
    }

    .pagination-nav .page-link {
      border: none;
      padding: 12px 16px;
      color: #9FA8A3;
      background-color: transparent;
      transition: all 0.3s ease;
      font-weight: 500;
      border-radius: 8px;
      margin: 0 2px;
      position: relative;
    }

    .pagination-nav .page-link:hover {
      background-color: #DFF5EA;
      color: #2FA365;
      transform: translateY(-1px);
      box-shadow: 0 2px 8px rgba(47, 163, 101, 0.15);
    }

    .pagination-nav .page-link:focus {
      box-shadow: 0 0 0 3px rgba(47, 163, 101, 0.1);
      background-color: #DFF5EA;
      color: #2FA365;
    }

    .pagination-nav .page-item.active .page-link {
      background-color: #2FA365;
      border-color: #2FA365;
      color: #FFFFFF;
      box-shadow: 0 4px 12px rgba(47, 163, 101, 0.3);
      transform: translateY(-1px);
    }

    .pagination-nav .page-item.disabled .page-link {
      background-color: transparent;
      color: #9FA8A3;
      opacity: 0.6;
      cursor: not-allowed;
    }

    .pagination-nav .page-item.disabled .page-link:hover {
      transform: none;
      box-shadow: none;
      background-color: transparent;
    }

    .pagination-info small {
      background: linear-gradient(135deg, #DFF5EA 0%, #A3E0E0 100%);
      border: 1px solid #2FA365;
      color: #2C2C2C;
      font-weight: 500;
    }

    /* Mobile responsive */
    @media (max-width: 768px) {
      .pagination-nav .page-link {
        padding: 10px 12px;
        font-size: 0.875rem;
      }

      .pagination-nav .pagination {
        padding: 6px;
      }

      .pagination-wrapper {
        max-width: 100%;
      }
    }
  </style>
  @stack('styles')
</head>

<body>
  <div class="d-flex">
    <!-- Sidebar -->
    <nav class="sidebar position-fixed d-lg-block d-none" style="width: 250px; z-index: 1000; background-color: #1C5B40;">
      <div class="p-3">
        <h5 class="text-white">
          <i class="fa-solid fa-user me-2"></i>Admin Panel
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
            <i class="fab fa-product-hunt me-2"></i>Product Management
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
        <!-- Order Management dihapus dari sidebar admin -->
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('admin.contents.*') ? 'active' : '' }}" href="{{ route('admin.contents.index') }}">
            <i class="fas fa-edit me-2"></i>Content Management
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
              style="color: #DFF5EA; padding: 1rem 1.5rem;">
              <i class="fas fa-sign-out-alt me-2"></i>Logout
            </button>
          </form>
        </li>
      </ul>
    </nav>

    <!-- Mobile Toggle Button -->
    <button class="btn d-lg-none position-fixed" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMobile" style="top: 10px; left: 10px; z-index: 1050; background-color: #1C5B40; color: #FFFFFF;">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Mobile Sidebar -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebarMobile">
      <div class="offcanvas-header text-white" style="background-color: #1C5B40;">
        <h5 class="offcanvas-title">
          <i class="fa-solid fa-user me-2"></i>Admin Panel
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
      </div>
      <div class="offcanvas-body p-0" style="background-color: #1C5B40;">
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
              <i class="fab fa-product-hunt me-2"></i>Product Management
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
          <!-- Order Management dihapus dari sidebar admin (mobile) -->
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.contents.*') ? 'active' : '' }}" href="{{ route('admin.contents.index') }}">
              <i class="fas fa-edit me-2"></i>Content Management
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
                style="color: #DFF5EA; padding: 1rem 1.5rem;">
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
      <div class="d-flex justify-content-between align-items-center mb-4 p-3 rounded" style="background-color: #DFF5EA;">
        <div>
          <h6 class="mb-0" style="color: #2C2C2C;">Selamat datang, <strong>{{ Auth::user()->name }}</strong></h6>
          <small style="color: #9FA8A3;">{{ Auth::user()->email }}</small>
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
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  @stack('scripts')
</body>

</html>