<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title', 'Rajane Duren')</title>
  <meta name="description" content="@yield('meta_description', 'Sentra Durian Tegal - Pusat Durian dan Bibit Berkualitas di Tegal')">
  <meta name="robots" content="@yield('meta_robots', 'index, follow')">

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{ asset('Durian.ico') }}">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <!-- Eco Nature Theme CSS -->
  <link href="{{ asset('css/eco-nature-theme.css') }}" rel="stylesheet">
  <!-- Custom CSS -->
  <style>
    @media (max-width: 991.98px) {
      .navbar-collapse {
        opacity: 0;
        transform: translateY(-20px);
        transition: opacity 0.3s, transform 0.3s;
      }
      .navbar-collapse.show {
        opacity: 1;
        transform: translateY(0);
      }
      .navbar-collapse .navbar-nav > li {
        opacity: 1;
        transform: none;
        transition: none;
      }
    }
    /* Prevent horizontal overflow */
    body {
      overflow-x: hidden;
    }

    /* Animasi isi menu pada mobile navbar (hamburger menu) dihandle oleh .navbar-collapse */

    .navbar {
      width: 100%;
      max-width: 100vw;
    }

    /* Add spacing between fixed navbar and main content */
    main {
      padding-top: 80px;
      /* Adjust this value based on navbar height */
    }

    /* Remove top padding for pages with hero-section */
    main:has(.hero-section) {
      padding-top: 0;
    }

    /* Alternative for browsers that don't support :has() */
    .has-hero main {
      padding-top: 0;
    }

    .navbar-brand {
      font-size: 1.8rem;
      font-weight: bold;
    }

    .hero-section {
      background: #1c5b40;
      min-height: 100vh;
      display: flex;
      align-items: center;
      color: #FFFFFF;
    }

    .hero-section .hero-image {
      transition: transform 0.3s ease;
    }

    .hero-section .hero-image:hover {
      transform: scale(1.05);
    }

    .hero-section .placeholder-image {
      background: rgba(255, 255, 255, 0.1);
      border: 2px dashed rgba(255, 255, 255, 0.3);
      border-radius: 10px;
    }

    .hero-section h1,
    .hero-section .display-4 {
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
    }

    .hero-section p,
    .hero-section .lead {
      text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
    }

    .card {
      border: none;
      box-shadow: 0 4px 6px rgba(47, 163, 101, 0.1);
      transition: transform 0.3s ease;
      background-color: #DFF5EA;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 15px rgba(47, 163, 101, 0.15);
    }

    .footer {
      background: linear-gradient(135deg, #1C5B40 0%, #2FA365 100%);
      color: #FFFFFF;
      padding: 3rem 0 1rem;
    }

    .btn-primary {
      background-color: #2FA365;
      border-color: #2FA365;
    }

    .btn-primary:hover {
      background-color: #1C5B40;
      border-color: #1C5B40;
    }

    .star-rating {
      color: #ffc107;
    }

    /* Custom Pagination Styles */
    .pagination-nav .pagination {
      box-shadow: 0 2px 10px rgba(47, 163, 101, 0.1);
      border-radius: 10px;
      overflow: hidden;
    }

    .pagination-nav .page-link {
      border: none;
      padding: 12px 16px;
      color: #9FA8A3;
      background-color: #FFFFFF;
      transition: all 0.3s ease;
      font-weight: 500;
    }

    .pagination-nav .page-link:hover {
      background-color: #DFF5EA;
      color: #2FA365;
      transform: translateY(-2px);
    }

    .pagination-nav .page-item.active .page-link {
      background-color: #2FA365;
      border-color: #2FA365;
      color: #FFFFFF;
      box-shadow: 0 4px 8px rgba(47, 163, 101, 0.3);
    }

    .pagination-nav .page-item.disabled .page-link {
      background-color: #FFFFFF;
      color: #9FA8A3;
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
      background-color: #DFF5EA;
      padding: 8px 16px;
      border-radius: 20px;
      display: inline-block;
      color: #2C2C2C;
    }

    /* Cart Icon Styles */
    .cart-icon-full {
      position: relative;
    }

    .cart-icon-full .fa-exclamation-circle {
      position: absolute;
      top: -8px;
      right: -8px;
      font-size: 0.7em;
      color: #2FA365 !important;
      border-radius: 50%;
      animation: pulse 1.5s infinite;
    }

    .cart-notification {
      position: absolute;
      top: 10%;
      left: 50%;
      transform: translate(-50%, -50%);
      font-size: 0.8em;
      color: #2FA365 !important;
      animation: pulse 1.5s infinite;
      z-index: 1;
    }

    @keyframes pulse {
      0% {
        transform: scale(1);
      }

      50% {
        transform: scale(1.2);
      }

      100% {
        transform: scale(1);
      }
    }

    /* Active Navigation Styles */
    .navbar-nav .nav-link {
      transition: all 0.3s ease;
      border-radius: 8px;
      margin: 0 4px;
      position: relative;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .navbar-nav .nav-link i {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 16px;
      height: 16px;
    }

    .navbar-nav .nav-link:hover {
      color: #DFF5EA !important;
      transform: translateY(-2px);
    }

    .navbar-nav .nav-link:hover i {
      color: #DFF5EA !important;
      transform: scale(1.1);
    }

    .navbar-nav .nav-link.active {
      color: #2FA365 !important;
      font-weight: 600;
      transform: translateY(-1px);
    }

    .navbar-nav .nav-link.active i {
      color: #2FA365 !important;
      animation: activeIcon 0.6s ease;
    }

    @keyframes activeIcon {
      0% {
        transform: scale(1) rotate(0deg);
      }

      50% {
        transform: scale(1.2) rotate(5deg);
      }

      100% {
        transform: scale(1) rotate(0deg);
      }
    }

    /* Dropdown active state */
    .navbar-nav .dropdown-toggle.active {
      color: #2FA365 !important;
      font-weight: 600;
    }

    .navbar-nav .dropdown-toggle.active i {
      color: #2FA365 !important;
    }

    .navbar-nav .dropdown-toggle {
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .navbar-nav .dropdown-toggle i {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 16px;
      height: 16px;
    }

    /* Active indicator line */
    .navbar-nav .nav-link.active::after {
      content: '';
      position: absolute;
      bottom: -2px;
      left: 50%;
      transform: translateX(-50%);
      width: 80%;
      height: 3px;
      background-color: #2FA365;
      border-radius: 2px;
      animation: slideIn 0.3s ease;
    }

    @keyframes slideIn {
      from {
        width: 0%;
      }

      to {
        width: 80%;
      }
    }

    /* Dropdown menu active state */
    .dropdown-menu .dropdown-item.active {
      color: #2FA365 !important;
      font-weight: 600;
    }

    .dropdown-menu .dropdown-item.active i {
      color: #2FA365 !important;
    }

    .dropdown-menu .dropdown-item:hover {
      color: #2FA365;
      transition: all 0.3s ease;
    }

    .dropdown-menu .dropdown-item:hover i {
      color: #2FA365;
      transform: scale(1.1);
    }

    .dropdown-menu .dropdown-item {
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .dropdown-menu .dropdown-item i {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 16px;
      height: 16px;
    }

    /* Navbar Responsive Styles */
    .navbar {
      padding: 0.5rem 0;
    }

    .navbar-brand {
      font-size: 1.1rem;
      font-weight: 600;
    }

    .navbar-nav .nav-link {
      padding: 0.375rem 0.5rem;
      margin: 0 0.25rem;
      border-radius: 0.375rem;
      transition: all 0.3s ease;
      white-space: nowrap;
    }

    .navbar-nav .nav-link:hover {
      background-color: rgba(255, 255, 255, 0.1);
      transform: translateY(-1px);
    }

    .navbar-nav .nav-link.active {
      background-color: rgba(255, 255, 255, 0.15);
      font-weight: 500;
    }

    .navbar-nav .nav-link.btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      min-width: auto;
      font-size: 0.875rem;
      line-height: 1.25;
    }

    .navbar-nav .nav-link.btn-outline-light {
      border-color: #2FA365;
      color: #2FA365;
      background-color: transparent;
    }

    .navbar-nav .nav-link.btn-outline-light:hover {
      background-color: #2FA365;
      border-color: #2FA365;
      color: #ffffff;
      transform: translateY(-1px);
    }

    .navbar-nav .nav-link.btn-outline-success {
      border-color: #ffffff;
      color: #ffffff;
      background-color: transparent;
    }

    .navbar-nav .nav-link.btn-outline-success:hover {
      background-color: rgba(255, 255, 255, 0.1);
      border-color: #ffffff;
      color: #ffffff;
      transform: scale(1.1);
    }

    .navbar-nav .nav-link.btn-success {
      background-color: #2FA365;
      border-color: #2FA365;
      color: #ffffff;
    }

    .navbar-nav .nav-link.btn-success:hover {
      background-color: rgba(255, 255, 255, 0.1);
      border-color: #2FA365;
      color: #ffffff;
      transform: scale(1.1);
    }

    .navbar-nav .nav-link.btn-primary {
      background-color: #2FA365;
      border-color: #2FA365;
      color: #ffffff;
    }

    .navbar-nav .nav-link.btn-primary:hover {
      background-color: #1C5B40;
      border-color: #1C5B40;
      color: #ffffff;
      transform: translateY(-1px);
    }

    /* Mobile optimizations */
    @media (max-width: 991.98px) {
      .navbar-nav {
        padding: 0.5rem 0;
      }

      .navbar-nav .nav-link {
        padding: 0.5rem 0.75rem;
        margin: 0.125rem 0;
        border-radius: 0.375rem;
      }

      .navbar-nav .nav-link.btn {
        margin: 0.25rem 0;
        text-align: center;
        justify-content: center;
      }

      .navbar-collapse {
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        margin-top: 0.5rem;
        padding-top: 0.5rem;
        z-index: 1051;
        background: #1C5B40;
        overflow: visible !important;
      }

      /* Prevent horizontal scroll on mobile */
      .container-fluid {
        max-width: 100%;
        overflow-x: hidden;
        overflow: visible !important;
        padding-left: 1rem !important;
        padding-right: 1rem !important;
      }

      .navbar {
        overflow: visible !important;
      }
    }

    /* Small screen optimizations */
    @media (max-width: 575.98px) {
      .navbar-brand {
        font-size: 1rem;
      }

      .navbar-nav .nav-link {
        font-size: 0.875rem;
        padding: 0.5rem;
      }

      .navbar-nav .nav-link.btn {
        font-size: 0.8rem;
        padding: 0.375rem 0.75rem;
      }

      /* Better spacing for user dropdown on mobile */
      .navbar-nav .dropdown-toggle {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 150px;
      }
    }

    /* Dropdown positioning fix */
    .navbar-nav .dropdown-menu {
      border: 1px solid rgba(0, 0, 0, 0.15);
      box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
      background-color: #ffffff;
      border-radius: 0.375rem;
      min-width: 180px;
      z-index: 1050;
    }

    /* Fix dropdown position for right-aligned navbar items */
    .navbar-nav.ms-auto .dropdown-menu {
      right: 0;
      left: auto;
      transform: translateX(0);
    }

    /* Bootstrap dropdown-menu-end class enhancement */
    .dropdown-menu-end {
      --bs-position: end;
    }

    /* Prevent dropdown from going off-screen on small devices */
    @media (max-width: 991.98px) {
      .navbar-nav .dropdown-menu {
        position: static !important;
        transform: none !important;
        border: none;
        box-shadow: none;
        background-color: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 0.375rem;
        margin-top: 0.5rem;
        width: 100%;
        max-width: none;
      }

      .navbar-nav .dropdown-item {
        color: #ffffff !important;
        padding: 0.5rem 1rem;
        border-radius: 0.25rem;
        margin-bottom: 0.125rem;
      }

      .navbar-nav .dropdown-item:hover {
        background-color: rgba(255, 255, 255, 0.2);
        color: #ffffff !important;
      }

      .navbar-nav .dropdown-item.active {
        background-color: rgba(255, 255, 255, 0.2);
        color: #2FA365 !important;
      }

      .navbar-nav .dropdown-divider {
        border-color: rgba(255, 255, 255, 0.2);
        margin: 0.5rem 0;
      }
    }

    /* Ensure dropdown stays within viewport on larger screens */
    @media (min-width: 992px) {

      .navbar-nav.ms-auto .dropdown-menu,
      .navbar-nav.ms-auto .dropdown-menu-end {
        right: 0;
        left: auto;
        margin-top: 0.5rem;
      }

      /* Prevent dropdown from going off right edge */
      .navbar-nav .dropdown-menu {
        max-width: calc(100vw - 2rem);
      }
    }

    /* Medium screens - tablet landscape */
    @media (max-width: 1199.98px) and (min-width: 992px) {
      .navbar-nav.ms-auto .dropdown-menu {
        min-width: 160px;
        right: 0;
        left: auto;
      }
    }

    /* Extra small screens */
    @media (max-width: 375px) {
      .container-fluid {
        padding-left: 0.75rem !important;
        padding-right: 0.75rem !important;
      }

      .navbar-brand {
        font-size: 0.9rem;
      }

      .navbar-nav .dropdown-menu {
        margin-left: -0.5rem;
        margin-right: -0.5rem;
      }
    }
  </style>
  @stack('styles')
</head>

<body>
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #1C5B40;">
    <div class="container-fluid px-3">
      <a class="navbar-brand" href="{{ route('home') }}">
        <i class="fas fa-leaf me-2"></i>
        <span class="d-none d-sm-inline">Sentra Durian Tegal</span>
        <span class="d-sm-none">Sentra Durian Tegal</span>
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}" href="{{ route('home') }}">
              <i class="fas fa-home me-1"></i><span>Beranda</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteName() == 'about' ? 'active' : '' }}" href="{{ route('about') }}">
              <i class="fas fa-info-circle me-1"></i><span>Tentang</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteName() == 'gallery' ? 'active' : '' }}" href="{{ route('gallery') }}">
              <i class="fas fa-images me-1"></i><span>Galeri</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteName() == 'products' ? 'active' : '' }}" href="{{ route('products') }}">
              <i class="fas fa-box me-1"></i><span>Produk</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteName() == 'reviews' ? 'active' : '' }}" href="{{ route('reviews') }}">
              <i class="fas fa-star me-1"></i><span>Testimoni</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteName() == 'contact' ? 'active' : '' }}" href="{{ route('contact') }}">
              <i class="fas fa-envelope me-1"></i><span>Kontak</span>
            </a>
          </li>
          <!-- Keranjang di navbar dihapus sesuai permintaan -->
        </ul>

        <ul class="navbar-nav ms-auto">
          @guest
          <!-- Tombol login dan register di navbar dihapus sesuai permintaan -->
          @else
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ in_array(Route::currentRouteName(), ['profile', 'orders.history']) ? 'active' : '' }}" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-user me-1"></i><span class="d-md-inline d-none">{{ Auth::user()->name }}</span><span class="d-md-none">User</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                  <i class="fas fa-user-cog"></i>Admin Panel
                </a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li>
                <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
                  @csrf
                  <button type="submit" class="dropdown-item">
                    <i class="fas fa-sign-out-alt"></i>Logout
                  </button>
                </form>
              </li>
            </ul>
          </li>
          @endguest
        </ul>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <main>
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
          <p><i class="fas fa-map-marker-alt me-2"></i>Kalikangkung Kulon, Kalikangkung, Pangkah, Kabupaten Tegal, Jawa Tengah 52471</p>
          <p><i class="fas fa-phone me-2"></i>+62 812-3456-7890</p>
          <p><i class="fas fa-envelope me-2"></i>javatani00@gmail.com</p>
          <p><i class="fab fa-instagram me-2"></i>instagram.com/rajaneduren_/</p>
        </div>
        <div class="col-md-4">
          <h5>Jam Buka</h5>
          <p><i class="fas fa-clock me-2"></i>Setiap Hari: 08:00 - 22:00 WIB</p>
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
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script>
    $(document).ready(function() {
      // Update cart icon based on cart status
      function updateCartIcon() {
        $.get('/cart/count', function(response) {
          const cartCount = response.count || 0;

          if (cartCount > 0) {
            // Show exclamation icon (cart has items)
            $('.cart-icon-empty').hide();
            $('.cart-icon-full').show();
          } else {
            // Show normal cart icon (cart is empty)
            $('.cart-icon-empty').show();
            $('.cart-icon-full').hide();
          }
        }).fail(function() {
          // If request fails, show normal cart icon
          $('.cart-icon-empty').show();
          $('.cart-icon-full').hide();
        });
      }

      // Update cart icon on page load
      updateCartIcon();

      // Update cart icon when items are added/removed (can be called from other pages)
      window.updateCartIcon = updateCartIcon;
    });
  </script>

  @stack('scripts')
</body>

</html>