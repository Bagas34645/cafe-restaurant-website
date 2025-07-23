@extends('layouts.admin')

@section('title', 'Product Management - Admin Panel')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h1 class="h3">Product Management</h1>
  <form action="{{ route('admin.products.index') }}" method="GET" class="d-flex align-items-center gap-2" style="max-width: 350px;">
    <input type="text" name="search" class="form-control" placeholder="Search products..." value="{{ request('search') }}" autocomplete="off">
    <button type="submit" class="btn btn-outline-secondary"><i class="fas fa-search"></i></button>
  </form>
  <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
    <i class="fas fa-plus me-2"></i>Add New Product
  </a>
</div>

@if($products->count() > 0)
<div class="card">
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-hover mb-0">
        <thead class="table-dark">
          <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Category</th>
            <th>Status</th>
            <th>Created</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($products as $product)
          <tr>
            <td>
              @if($product->image_path)
              <img src="{{ asset('storage/' . $product->image_path) }}"
                alt="{{ $product->name }}"
                class="rounded"
                style="width: 60px; height: 60px; object-fit: cover;">
              @else
              <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                <i class="fas fa-utensils text-muted"></i>
              </div>
              @endif
            </td>
            <td>
              <strong>{{ $product->name }}</strong>
              <br>
              <small class="text-muted">{{ Str::limit($product->description, 40) }}</small>
            </td>
            <td>
              <strong class="text-success">Rp{{ number_format($product->price, 0, ',', '.') }}</strong>
            </td>
            <td>
              @if($product->category)
              <span class="badge bg-secondary">{{ $product->category }}</span>
              @else
              <span class="text-muted">-</span>
              @endif
            </td>
            <td>
              <span class="badge bg-{{ $product->is_available ? 'success' : 'secondary' }}">
                {{ $product->is_available ? 'Available' : 'Unavailable' }}
              </span>
            </td>
            <td>
              <small class="text-muted">{{ $product->created_at->format('M d, Y') }}</small>
            </td>
            <td>
              <div class="btn-group gap-2" role="group">
                <a href="{{ route('admin.products.show', $product) }}" class="btn btn-sm btn-outline-primary">
                  <i class="fas fa-eye"></i>
                </a>
                <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-outline-warning">
                  <i class="fas fa-edit"></i>
                </a>
                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-outline-danger"
                    onclick="return confirm('Are you sure you want to delete this product?')">
                    <i class="fas fa-trash"></i>
                  </button>
                </form>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Pagination -->
<div class="d-flex justify-content-center mt-4">
  <div class="pagination-wrapper">
    {{ $products->links('pagination.admin') }}
  </div>
</div>
@else
<div class="card">
  <div class="card-body text-center py-5">
    <i class="fas fa-utensils fa-5x text-muted mb-4"></i>
    <h4 class="text-muted">No Products Found</h4>
    <p class="text-muted mb-4">Start by adding your first menu item to showcase your offerings.</p>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
      <i class="fas fa-plus me-2"></i>Add First Product
    </a>
  </div>
</div>
@endif
@endsection