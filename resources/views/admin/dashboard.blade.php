@extends('layouts.admin')

@section('title', 'Admin Dashboard - Sentra Durian Tegal')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h1 class="h3">Dashboard</h1>
  <div class="text-muted">
    <i class="fas fa-calendar-alt me-1"></i>{{ date('l, F j, Y') }}
  </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-5">
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card stat-card">
      <div class="card-body">
        <div class="d-flex justify-content-between">
          <div>
            <h6 class="card-title text-uppercase mb-1">Gallery Items</h6>
            <h2 class="mb-0">{{ $stats['galleries'] }}</h2>
          </div>
          <div class="align-self-center">
            <i class="fas fa-images fa-2x opacity-75"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card stat-card success">
      <div class="card-body">
        <div class="d-flex justify-content-between">
          <div>
            <h6 class="card-title text-uppercase mb-1">Menu Items</h6>
            <h2 class="mb-0">{{ $stats['products'] }}</h2>
          </div>
          <div class="align-self-center">
            <i class="fas fa-utensils fa-2x opacity-75"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card stat-card warning">
      <div class="card-body">
        <div class="d-flex justify-content-between">
          <div>
            <h6 class="card-title text-uppercase mb-1">Pending Reviews</h6>
            <h2 class="mb-0">{{ $stats['pending_reviews'] }}</h2>
          </div>
          <div class="align-self-center">
            <i class="fas fa-star fa-2x opacity-75"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card stat-card info">
      <div class="card-body">
        <div class="d-flex justify-content-between">
          <div>
            <h6 class="card-title text-uppercase mb-1">Unread Messages</h6>
            <h2 class="mb-0">{{ $stats['unread_contacts'] }}</h2>
          </div>
          <div class="align-self-center">
            <i class="fas fa-envelope fa-2x opacity-75"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Quick Actions -->
<div class="row mb-5">
  <div class="col-12">
    <div class="card shadow-sm border-0">
      <div class="card-header bg-gradient">
        <h5 class="mb-0"><i class="fas fa-bolt me-2"></i>Quick Actions</h5>
      </div>
      <div class="card-body">
        <div class="row g-3">
          <div class="col-xl-3 col-lg-6 col-md-6 mb-3">
            <a href="{{ route('admin.galleries.create') }}" class="btn btn-primary btn-lg w-100 d-flex align-items-center justify-content-center text-nowrap">
              <i class="fas fa-plus me-2"></i>
              <span class="action-text">Add Gallery Item</span>
            </a>
          </div>
          <div class="col-xl-3 col-lg-6 col-md-6 mb-3">
            <a href="{{ route('admin.products.create') }}" class="btn btn-success btn-lg w-100 d-flex align-items-center justify-content-center text-nowrap">
              <i class="fas fa-plus me-2"></i>
              <span class="action-text">Add Menu Item</span>
            </a>
          </div>
          <div class="col-xl-3 col-lg-6 col-md-6 mb-3">
            <a href="{{ route('admin.reviews.index') }}" class="btn btn-warning btn-lg w-100 d-flex align-items-center justify-content-center text-nowrap">
              <i class="fas fa-eye me-2"></i>
              <span class="action-text">Reviews</span>
            </a>
          </div>
          <div class="col-xl-3 col-lg-6 col-md-6 mb-3">
            <a href="{{ route('admin.contacts.index') }}" class="btn btn-info btn-lg w-100 d-flex align-items-center justify-content-center text-nowrap">
              <i class="fas fa-envelope me-2"></i>
              <span class="action-text">Messages</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <!-- Recent Gallery Items -->
  <div class="col-lg-6 mb-4">
    <div class="card shadow-sm border-0">
      <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-images me-2"></i>Recent Gallery Items</h5>
        <a href="{{ route('admin.galleries.index') }}" class="btn btn-sm btn-outline-light">
          <i class="fas fa-eye me-1"></i>View All
        </a>
      </div>
      <div class="card-body p-0">
        @if($recentGalleries->count() > 0)
        @foreach($recentGalleries as $gallery)
        <div class="d-flex align-items-center p-3 border-bottom hover-bg-light transition-all">
          @if($gallery->path_gambar)
          <div class="position-relative me-3">
            <img src="{{ asset('storage/' . $gallery->path_gambar) }}"
              alt="{{ $gallery->judul }}"
              class="rounded-3 shadow-sm"
              style="width: 60px; height: 60px; object-fit: cover;">
            <div class="position-absolute top-0 start-0 w-100 h-100 rounded-3 bg-dark opacity-0 hover-opacity-10 transition-all"></div>
          </div>
          @else
          <div class="bg-light rounded-3 me-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px;">
            <i class="fas fa-image text-muted fs-5"></i>
          </div>
          @endif
          <div class="flex-grow-1 min-width-0">
            <h6 class="mb-1 fw-semibold text-truncate">{{ $gallery->judul }}</h6>
            <div class="d-flex align-items-center">
              <i class="fas fa-clock me-1 text-muted" style="font-size: 0.75rem;"></i>
              <small class="text-muted">{{ $gallery->created_at->diffForHumans() }}</small>
            </div>
          </div>
          <div class="ms-2">
            <span class="badge {{ $gallery->aktif ? 'bg-success' : 'bg-secondary' }} px-3 py-2">
              <i class="fas {{ $gallery->aktif ? 'fa-check-circle' : 'fa-times-circle' }} me-1"></i>
              {{ $gallery->aktif ? 'Aktif' : 'Tidak Aktif' }}
            </span>
          </div>
        </div>
        @endforeach
        @else
        <div class="text-center py-5">
          <i class="fas fa-images text-muted mb-3" style="font-size: 3rem; opacity: 0.3;"></i>
          <p class="text-muted mb-0">Belum ada item galeri</p>
          <small class="text-muted">Klik "Add Gallery Item" untuk menambah</small>
        </div>
        @endif
      </div>
    </div>
  </div>

  <!-- Recent Products -->
  <div class="col-lg-6 mb-4">
    <div class="card shadow-sm border-0">
      <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-utensils me-2"></i>Recent Menu Items</h5>
        <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-outline-light">
          <i class="fas fa-eye me-1"></i>View All
        </a>
      </div>
      <div class="card-body p-0">
        @if($recentProducts->count() > 0)
        @foreach($recentProducts as $product)
        <div class="d-flex align-items-center p-3 border-bottom hover-bg-light transition-all">
          @if($product->image_path)
          <div class="position-relative me-3">
            <img src="{{ asset('storage/' . $product->image_path) }}"
              alt="{{ $product->name }}"
              class="rounded-3 shadow-sm"
              style="width: 60px; height: 60px; object-fit: cover;">
            <div class="position-absolute top-0 start-0 w-100 h-100 rounded-3 bg-dark opacity-0 hover-opacity-10 transition-all"></div>
          </div>
          @else
          <div class="bg-light rounded-3 me-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px;">
            <i class="fas fa-utensils text-muted fs-5"></i>
          </div>
          @endif
          <div class="flex-grow-1 min-width-0">
            <h6 class="mb-1 fw-semibold text-truncate">{{ $product->name }}</h6>
            <div class="d-flex align-items-center">
              <span class="text-success fw-bold me-2">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
              <span class="text-muted">•</span>
              <i class="fas fa-clock ms-2 me-1 text-muted" style="font-size: 0.75rem;"></i>
              <small class="text-muted">{{ $product->created_at->diffForHumans() }}</small>
            </div>
          </div>
          <div class="ms-2">
            <span class="badge {{ $product->is_available ? 'bg-success' : 'bg-danger' }} px-3 py-2">
              <i class="fas {{ $product->is_available ? 'fa-check-circle' : 'fa-times-circle' }} me-1"></i>
              {{ $product->is_available ? 'Available' : 'Unavailable' }}
            </span>
          </div>
        </div>
        @endforeach
        @else
        <div class="text-center py-5">
          <i class="fas fa-utensils text-muted mb-3" style="font-size: 3rem; opacity: 0.3;"></i>
          <p class="text-muted mb-0">Belum ada menu item</p>
          <small class="text-muted">Klik "Add Menu Item" untuk menambah</small>
        </div>
        @endif
      </div>
    </div>
  </div>
</div>

<div class="row">
  <!-- Pending Reviews -->
  <div class="col-lg-6 mb-4">
    <div class="card shadow-sm border-0">
      <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-star me-2"></i>Pending Reviews</h5>
        <a href="{{ route('admin.reviews.index') }}" class="btn btn-sm btn-outline-dark">
          <i class="fas fa-eye me-1"></i>View All
        </a>
      </div>
      <div class="card-body p-0">
        @if($pendingReviews->count() > 0)
        @foreach($pendingReviews as $review)
        <div class="p-3 border-bottom hover-bg-light transition-all">
          <div class="d-flex justify-content-between align-items-start mb-2">
            <h6 class="mb-1 fw-semibold">{{ $review->customer_name }}</h6>
            <div class="text-warning">
              @for($i = 1; $i <= 5; $i++)
                <i class="fas fa-star{{ $i <= $review->rating ? '' : '-o' }}" style="font-size: 0.875rem;"></i>
                @endfor
            </div>
          </div>
          <p class="text-muted mb-2 small">{{ Str::limit($review->comment, 80) }}</p>
          <div class="d-flex align-items-center">
            <i class="fas fa-clock me-1 text-muted" style="font-size: 0.75rem;"></i>
            <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
          </div>
        </div>
        @endforeach
        @else
        <div class="text-center py-5">
          <i class="fas fa-star text-muted mb-3" style="font-size: 3rem; opacity: 0.3;"></i>
          <p class="text-muted mb-0">Belum ada review yang perlu disetujui</p>
          <small class="text-muted">Review baru akan muncul di sini</small>
        </div>
        @endif
      </div>
    </div>
  </div>

  <!-- Unread Messages -->
  <div class="col-lg-6 mb-4">
    <div class="card shadow-sm border-0">
      <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-envelope me-2"></i>Unread Messages</h5>
        <a href="{{ route('admin.contacts.index') }}" class="btn btn-sm btn-outline-light">
          <i class="fas fa-eye me-1"></i>View All
        </a>
      </div>
      <div class="card-body p-0">
        @if($unreadContacts->count() > 0)
        @foreach($unreadContacts as $contact)
        <div class="p-3 border-bottom hover-bg-light transition-all">
          <div class="d-flex justify-content-between align-items-start mb-2">
            <h6 class="mb-1 fw-semibold text-truncate me-2">{{ $contact->name }}</h6>
            <span class="badge bg-info px-2 py-1 text-nowrap">{{ $contact->subject }}</span>
          </div>
          <p class="text-muted mb-2 small">{{ Str::limit($contact->message, 80) }}</p>
          <div class="d-flex align-items-center">
            <i class="fas fa-clock me-1 text-muted" style="font-size: 0.75rem;"></i>
            <small class="text-muted">{{ $contact->created_at->diffForHumans() }}</small>
          </div>
        </div>
        @endforeach
        @else
        <div class="text-center py-5">
          <i class="fas fa-envelope text-muted mb-3" style="font-size: 3rem; opacity: 0.3;"></i>
          <p class="text-muted mb-0">Belum ada pesan yang belum dibaca</p>
          <small class="text-muted">Pesan baru akan muncul di sini</small>
        </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection