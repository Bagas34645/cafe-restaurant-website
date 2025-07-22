@extends('layouts.admin')

@section('title', 'Product Details - Admin Panel')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h1 class="h3">Product Details</h1>
  <div class="d-flex gap-2">
    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning">
      <i class="fas fa-edit me-2"></i>Edit
    </a>
    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
      <i class="fas fa-arrow-left me-2"></i>Back to Products
    </a>
  </div>
</div>

<div class="row">
  <div class="col-lg-8">
    <div class="card">
      <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Product Information</h5>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-8 mb-3">
            <label class="form-label fw-bold">Product Name:</label>
            <p class="mb-0 h5">{{ $product->name }}</p>
          </div>
          <div class="col-md-4 mb-3">
            <label class="form-label fw-bold">Price:</label>
            <p class="mb-0 h5 text-success">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label fw-bold">Description:</label>
          <p class="mb-0">{{ $product->description }}</p>
        </div>

        <div class="mb-3">
          <label class="form-label fw-bold">Stock:</label>
          <p class="mb-0">
            @if(isset($product->stock_quantity))
              <span class="badge bg-info fs-6">{{ $product->stock_quantity }} item</span>
            @else
              <span class="text-muted">Not set</span>
            @endif
          </p>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">Category:</label>
            <p class="mb-0">
              @if($product->category)
              <span class="badge bg-secondary fs-6">{{ $product->category }}</span>
              @else
              <span class="text-muted">No category assigned</span>
              @endif
            </p>
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">Availability:</label>
            <p class="mb-0">
              <span class="badge bg-{{ $product->is_available ? 'success' : 'secondary' }} fs-6">
                {{ $product->is_available ? 'Available' : 'Unavailable' }}
              </span>
            </p>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">Created:</label>
            <p class="mb-0">{{ $product->created_at->format('F j, Y \a\t g:i A') }}</p>
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">Last Updated:</label>
            <p class="mb-0">{{ $product->updated_at->format('F j, Y \a\t g:i A') }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="card">
      <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-image me-2"></i>Product Image</h5>
      </div>
      <div class="card-body text-center">
        @if($product->image_path)
        <img src="{{ asset('storage/' . $product->image_path) }}"
          alt="{{ $product->name }}"
          class="img-fluid rounded shadow"
          style="max-height: 400px;">
        @else
        <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 200px;">
          <div class="text-center text-muted">
            <i class="fas fa-utensils fa-3x mb-2"></i>
            <p>No image available</p>
          </div>
        </div>
        @endif
      </div>
    </div>

    <div class="card mt-4">
      <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-cogs me-2"></i>Actions</h5>
      </div>
      <div class="card-body">
        <div class="d-grid gap-2">
          <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning">
            <i class="fas fa-edit me-2"></i>Edit Product
          </a>

          <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger w-100"
              onclick="return confirm('Are you sure you want to delete this product? This action cannot be undone.')">
              <i class="fas fa-trash me-2"></i>Delete Product
            </button>
          </form>

          @if($product->is_available)
          <a href="{{ route('products') }}" target="_blank" class="btn btn-success">
            <i class="fas fa-external-link-alt me-2"></i>View on Website
          </a>
          @endif
        </div>
      </div>
    </div>

    <!-- Product Statistics -->
    <div class="card mt-4">
      <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Statistics</h5>
      </div>
      <div class="card-body">
        <div class="row text-center">
          <div class="col-12 mb-2">
            <small class="text-muted">Product ID</small>
            <div class="fw-bold">#{{ $product->id }}</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection