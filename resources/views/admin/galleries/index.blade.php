@extends('layouts.admin')

@section('title', 'Gallery Management - Admin Panel')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h1 class="h3">Gallery Management</h1>
  <a href="{{ route('admin.galleries.create') }}" class="btn btn-primary">
    <i class="fas fa-plus me-2"></i>Add New Gallery Item
  </a>
</div>

@if($galleries->count() > 0)
<div class="card">
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-hover mb-0">
        <thead class="table-dark">
          <tr>
            <th>Image</th>
            <th>Title</th>
            <th>Description</th>
            <th>Status</th>
            <th>Created</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($galleries as $gallery)
          <tr>
            <td>
              @if($gallery->path_gambar)
              <img src="{{ asset('storage/' . $gallery->path_gambar) }}"
                alt="{{ $gallery->judul }}"
                class="rounded"
                style="width: 60px; height: 60px; object-fit: cover;">
              @else
              <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                <i class="fas fa-image text-muted"></i>
              </div>
              @endif
            </td>
            <td>
              <strong>{{ $gallery->judul }}</strong>
            </td>
            <td>
              <span class="text-muted">{{ Str::limit($gallery->deskripsi, 50) }}</span>
            </td>
            <td>
              <span class="badge bg-{{ $gallery->aktif ? 'success' : 'secondary' }}">
                {{ $gallery->aktif ? 'Aktif' : 'Tidak Aktif' }}
              </span>
            </td>
            <td>
              <small class="text-muted">{{ $gallery->created_at->format('M d, Y') }}</small>
            </td>
            <td>
              <div class="btn-group gap-2" role="group">
                <a href="{{ route('admin.galleries.show', $gallery) }}" class="btn btn-sm btn-outline-primary">
                  <i class="fas fa-eye"></i>
                </a>
                <a href="{{ route('admin.galleries.edit', $gallery) }}" class="btn btn-sm btn-outline-warning">
                  <i class="fas fa-edit"></i>
                </a>
                <form action="{{ route('admin.galleries.destroy', $gallery) }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-outline-danger"
                    onclick="return confirm('Are you sure you want to delete this gallery item?')">
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
    {{ $galleries->links('pagination.admin') }}
  </div>
</div>
@else
<div class="card">
  <div class="card-body text-center py-5">
    <i class="fas fa-images fa-5x text-muted mb-4"></i>
    <h4 class="text-muted">No Gallery Items Found</h4>
    <p class="text-muted mb-4">Start by adding your first gallery item to showcase your restaurant.</p>
    <a href="{{ route('admin.galleries.create') }}" class="btn btn-primary">
      <i class="fas fa-plus me-2"></i>Add First Gallery Item
    </a>
  </div>
</div>
@endif
@endsection