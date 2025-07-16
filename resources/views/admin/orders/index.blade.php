@extends('layouts.admin')

@section('title', 'Manajemen Pesanan')

@section('content')
<div class="container-fluid">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Manajemen Pesanan</h1>
    <a href="{{ route('admin.orders.export', request()->all()) }}" class="btn btn-success">
      <i class="fas fa-download"></i> Export CSV
    </a>
  </div>

  <!-- Filters -->
  <div class="card mb-4">
    <div class="card-body">
      <form method="GET" action="{{ route('admin.orders.index') }}" class="row g-3">
        <div class="col-md-3">
          <label for="search" class="form-label">Cari</label>
          <input type="text" class="form-control" id="search" name="search"
            value="{{ request('search') }}" placeholder="Nomor pesanan, nama, email...">
        </div>
        <div class="col-md-3">
          <label for="status" class="form-label">Status</label>
          <select class="form-select" id="status" name="status">
            <option value="">Semua Status</option>
            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="paid" {{ request('status') === 'paid' ? 'selected' : '' }}>Paid</option>
            <option value="processing" {{ request('status') === 'processing' ? 'selected' : '' }}>Processing</option>
            <option value="shipped" {{ request('status') === 'shipped' ? 'selected' : '' }}>Shipped</option>
            <option value="delivered" {{ request('status') === 'delivered' ? 'selected' : '' }}>Delivered</option>
            <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
          </select>
        </div>
        <div class="col-md-3">
          <label for="payment_method" class="form-label">Metode Pembayaran</label>
          <select class="form-select" id="payment_method" name="payment_method">
            <option value="">Semua Metode</option>
            <option value="midtrans" {{ request('payment_method') === 'midtrans' ? 'selected' : '' }}>Payment Gateway</option>
            <option value="cod" {{ request('payment_method') === 'cod' ? 'selected' : '' }}>Cash on Delivery</option>
          </select>
        </div>
        <div class="col-md-3 d-flex align-items-end">
          <button type="submit" class="btn btn-primary me-2">
            <i class="fas fa-search"></i> Filter
          </button>
          <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-times"></i> Reset
          </a>
        </div>
      </form>
    </div>
  </div>

  <!-- Orders Table -->
  <div class="card">
    <div class="card-body">
      @if($orders->count() > 0)
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Nomor Pesanan</th>
              <th>Pelanggan</th>
              <th>Total</th>
              <th>Pembayaran</th>
              <th>Status</th>
              <th>Tanggal</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($orders as $order)
            <tr>
              <td>
                <strong>{{ $order->order_number }}</strong>
              </td>
              <td>
                <div>
                  <strong>{{ $order->customer_name }}</strong><br>
                  <small class="text-muted">{{ $order->customer_email }}</small><br>
                  <small class="text-muted">{{ $order->customer_phone }}</small>
                </div>
              </td>
              <td>
                <strong class="text-success">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong>
              </td>
              <td>
                @if($order->payment_method === 'midtrans')
                <span class="badge bg-info">Payment Gateway</span>
                @else
                <span class="badge bg-warning">Cash on Delivery</span>
                @endif
              </td>
              <td>
                <form method="POST" action="{{ route('admin.orders.update-status', $order->id) }}" class="d-inline">
                  @csrf
                  @method('PATCH')
                  <select name="status" class="form-select form-select-sm status-select" data-order-id="{{ $order->id }}">
                    <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="paid" {{ $order->status === 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                    <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                    <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                  </select>
                </form>
              </td>
              <td>
                <small>
                  {{ $order->created_at->format('d/m/Y H:i') }}<br>
                  <span class="text-muted">{{ $order->created_at->diffForHumans() }}</span>
                </small>
              </td>
              <td>
                <div class="btn-group btn-group-sm" role="group">
                  <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-outline-primary" title="Detail">
                    <i class="fas fa-eye"></i>
                  </a>
                  <button type="button" class="btn btn-outline-danger delete-btn"
                    data-order-id="{{ $order->id }}"
                    data-order-number="{{ $order->order_number }}" title="Hapus">
                    <i class="fas fa-trash"></i>
                  </button>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      <div class="d-flex justify-content-center mt-4">
        {{ $orders->appends(request()->query())->links() }}
      </div>
      @else
      <div class="text-center py-5">
        <i class="fas fa-shopping-cart fa-5x text-muted mb-4"></i>
        <h3 class="text-muted">Tidak ada pesanan ditemukan</h3>
        <p class="text-muted">Belum ada pesanan yang dibuat atau sesuai dengan filter.</p>
      </div>
      @endif
    </div>
  </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Apakah Anda yakin ingin menghapus pesanan <strong id="orderNumber"></strong>?</p>
        <p class="text-danger"><small>Tindakan ini tidak dapat dibatalkan.</small></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <form id="deleteForm" method="POST" class="d-inline">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
  $(document).ready(function() {
    // Auto-submit status change
    $('.status-select').change(function() {
      $(this).closest('form').submit();
    });

    // Delete confirmation
    $('.delete-btn').click(function() {
      let orderId = $(this).data('order-id');
      let orderNumber = $(this).data('order-number');

      $('#orderNumber').text(orderNumber);
      $('#deleteForm').attr('action', '/admin/orders/' + orderId);
      $('#deleteModal').modal('show');
    });
  });
</script>
@endpush
@endsection