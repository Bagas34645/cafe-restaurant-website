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
    <div class="card">
      <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-bolt me-2"></i>Quick Actions</h5>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-3 mb-3">
            <a href="{{ route('admin.galleries.create') }}" class="btn btn-primary btn-lg w-100">
              <i class="fas fa-plus me-2"></i>Add Gallery Item
            </a>
          </div>
          <div class="col-md-3 mb-3">
            <a href="{{ route('admin.products.create') }}" class="btn btn-success btn-lg w-100">
              <i class="fas fa-plus me-2"></i>Add Menu Item
            </a>
          </div>
          <div class="col-md-3 mb-3">
            <a href="{{ route('admin.reviews.index') }}" class="btn btn-warning btn-lg w-100">
              <i class="fas fa-eye me-2"></i>Review Management
            </a>
          </div>
          <div class="col-md-3 mb-3">
            <a href="{{ route('admin.contacts.index') }}" class="btn btn-info btn-lg w-100">
              <i class="fas fa-envelope me-2"></i>View Messages
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
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-images me-2"></i>Recent Gallery Items</h5>
        <a href="{{ route('admin.galleries.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
      </div>
      <div class="card-body">
        @if($recentGalleries->count() > 0)
        @foreach($recentGalleries as $gallery)
        <div class="d-flex align-items-center mb-3">
          @if($gallery->image_path)
          <img src="{{ asset('storage/' . $gallery->image_path) }}"
            alt="{{ $gallery->title }}"
            class="rounded me-3"
            style="width: 50px; height: 50px; object-fit: cover;">
          @else
          <div class="bg-light rounded me-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
            <i class="fas fa-image text-muted"></i>
          </div>
          @endif
          <div class="flex-grow-1">
            <h6 class="mb-1">{{ $gallery->title }}</h6>
            <small class="text-muted">{{ $gallery->created_at->diffForHumans() }}</small>
          </div>
          <span class="badge bg-{{ $gallery->is_active ? 'success' : 'secondary' }}">
            {{ $gallery->is_active ? 'Active' : 'Inactive' }}
          </span>
        </div>
        @endforeach
        @else
        <p class="text-muted text-center">No gallery items found.</p>
        @endif
      </div>
    </div>
  </div>

  <!-- Recent Products -->
  <div class="col-lg-6 mb-4">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-utensils me-2"></i>Recent Menu Items</h5>
        <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-outline-success">View All</a>
      </div>
      <div class="card-body">
        @if($recentProducts->count() > 0)
        @foreach($recentProducts as $product)
        <div class="d-flex align-items-center mb-3">
          @if($product->image_path)
          <img src="{{ asset('storage/' . $product->image_path) }}"
            alt="{{ $product->name }}"
            class="rounded me-3"
            style="width: 50px; height: 50px; object-fit: cover;">
          @else
          <div class="bg-light rounded me-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
            <i class="fas fa-utensils text-muted"></i>
          </div>
          @endif
          <div class="flex-grow-1">
            <h6 class="mb-1">{{ $product->name }}</h6>
            <small class="text-muted">${{ number_format($product->price, 2) }} • {{ $product->created_at->diffForHumans() }}</small>
          </div>
          <span class="badge bg-{{ $product->is_available ? 'success' : 'secondary' }}">
            {{ $product->is_available ? 'Available' : 'Unavailable' }}
          </span>
        </div>
        @endforeach
        @else
        <p class="text-muted text-center">No menu items found.</p>
        @endif
      </div>
    </div>
  </div>
</div>

<div class="row">
  <!-- Pending Reviews -->
  <div class="col-lg-6 mb-4">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-star me-2"></i>Pending Reviews</h5>
        <a href="{{ route('admin.reviews.index') }}" class="btn btn-sm btn-outline-warning">View All</a>
      </div>
      <div class="card-body">
        @if($pendingReviews->count() > 0)
        @foreach($pendingReviews as $review)
        <div class="border-bottom pb-3 mb-3">
          <div class="d-flex justify-content-between align-items-start mb-2">
            <h6 class="mb-1">{{ $review->customer_name }}</h6>
            <div class="text-warning">
              @for($i = 1; $i <= 5; $i++)
                <i class="fas fa-star{{ $i <= $review->rating ? '' : '-o' }}"></i>
                @endfor
            </div>
          </div>
          <p class="text-muted mb-2">{{ Str::limit($review->comment, 80) }}</p>
          <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
        </div>
        @endforeach
        @else
        <p class="text-muted text-center">No pending reviews.</p>
        @endif
      </div>
    </div>
  </div>

  <!-- Unread Messages -->
  <div class="col-lg-6 mb-4">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-envelope me-2"></i>Unread Messages</h5>
        <a href="{{ route('admin.contacts.index') }}" class="btn btn-sm btn-outline-info">View All</a>
      </div>
      <div class="card-body">
        @if($unreadContacts->count() > 0)
        @foreach($unreadContacts as $contact)
        <div class="border-bottom pb-3 mb-3">
          <div class="d-flex justify-content-between align-items-start mb-2">
            <h6 class="mb-1">{{ $contact->name }}</h6>
            <span class="badge bg-info">{{ $contact->subject }}</span>
          </div>
          <p class="text-muted mb-2">{{ Str::limit($contact->message, 80) }}</p>
          <small class="text-muted">{{ $contact->created_at->diffForHumans() }}</small>
        </div>
        @endforeach
        @else
        <p class="text-muted text-center">No unread messages.</p>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection