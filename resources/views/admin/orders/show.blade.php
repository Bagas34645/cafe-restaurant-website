@extends('layouts.admin')

@section('title', 'Detail Pesanan')

@section('content')
<div class="container-fluid">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Detail Pesanan #{{ $order->order_number }}</h1>
    <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary">
      <i class="fas fa-arrow-left"></i> Kembali
    </a>
  </div>

  <div class="row">
    <!-- Order Information -->
    <div class="col-md-8">
      <div class="card mb-4">
        <div class="card-header">
          <h5><i class="fas fa-shopping-cart"></i> Informasi Pesanan</h5>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <table class="table table-sm table-borderless">
                <tr>
                  <td><strong>Nomor Pesanan:</strong></td>
                  <td>{{ $order->order_number }}</td>
                </tr>
                <tr>
                  <td><strong>Status:</strong></td>
                  <td>
                    <form method="POST" action="{{ route('admin.orders.update-status', $order->id) }}" class="d-inline">
                      @csrf
                      @method('PATCH')
                      <select name="status" class="form-select form-select-sm status-select" style="width: auto; display: inline-block;">
                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="paid" {{ $order->status === 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                        <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                      </select>
                    </form>
                  </td>
                </tr>
                <tr>
                  <td><strong>Metode Pembayaran:</strong></td>
                  <td>
                    @if($order->payment_method === 'midtrans')
                    <span class="badge bg-info">Payment Gateway</span>
                    @else
                    <span class="badge bg-warning">Cash on Delivery</span>
                    @endif
                  </td>
                </tr>
                <tr>
                  <td><strong>Total:</strong></td>
                  <td><strong class="text-success">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong></td>
                </tr>
              </table>
            </div>
            <div class="col-md-6">
              <table class="table table-sm table-borderless">
                <tr>
                  <td><strong>Tanggal Pesanan:</strong></td>
                  <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                </tr>
                @if($order->paid_at)
                <tr>
                  <td><strong>Tanggal Pembayaran:</strong></td>
                  <td>{{ $order->paid_at->format('d/m/Y H:i') }}</td>
                </tr>
                @endif
                @if($order->midtrans_transaction_id)
                <tr>
                  <td><strong>Transaction ID:</strong></td>
                  <td>{{ $order->midtrans_transaction_id }}</td>
                </tr>
                <tr>
                  <td><strong>Midtrans Status:</strong></td>
                  <td>
                    @if($order->midtrans_status === 'settlement' || $order->midtrans_status === 'capture')
                    <span class="badge bg-success">{{ ucfirst($order->midtrans_status) }}</span>
                    @elseif($order->midtrans_status === 'pending')
                    <span class="badge bg-warning">{{ ucfirst($order->midtrans_status) }}</span>
                    @else
                    <span class="badge bg-danger">{{ ucfirst($order->midtrans_status) }}</span>
                    @endif
                  </td>
                </tr>
                @endif
              </table>
            </div>
          </div>

          @if($order->notes)
          <div class="mt-3">
            <strong>Catatan:</strong>
            <div class="border p-2 mt-1 bg-light rounded">
              {{ $order->notes }}
            </div>
          </div>
          @endif
        </div>
      </div>

      <!-- Order Items -->
      <div class="card">
        <div class="card-header">
          <h5><i class="fas fa-list"></i> Item Pesanan</h5>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>Produk</th>
                  <th class="text-center">Harga</th>
                  <th class="text-center">Qty</th>
                  <th class="text-end">Subtotal</th>
                </tr>
              </thead>
              <tbody>
                @foreach($order->orderItems as $item)
                <tr>
                  <td>
                    <div class="d-flex align-items-center">
                      @if($item->product && $item->product->image_path)
                      <img src="{{ asset('storage/' . $item->product->image_path) }}"
                        alt="{{ $item->product_name }}"
                        class="rounded me-3"
                        style="width: 50px; height: 50px; object-fit: cover;">
                      @else
                      <div class="bg-light rounded me-3 d-flex align-items-center justify-content-center"
                        style="width: 50px; height: 50px;">
                        <i class="fas fa-image text-muted"></i>
                      </div>
                      @endif
                      <div>
                        <strong>{{ $item->product_name }}</strong>
                        @if($item->product)
                        <br><small class="text-muted">{{ $item->product->category }}</small>
                        @endif
                      </div>
                    </div>
                  </td>
                  <td class="text-center">Rp {{ number_format($item->product_price, 0, ',', '.') }}</td>
                  <td class="text-center">{{ $item->quantity }}</td>
                  <td class="text-end"><strong>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</strong></td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr class="table-active">
                  <th colspan="3" class="text-end">Total:</th>
                  <th class="text-end text-success">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Customer Information -->
    <div class="col-md-4">
      <div class="card">
        <div class="card-header">
          <h5><i class="fas fa-user"></i> Informasi Pelanggan</h5>
        </div>
        <div class="card-body">
          <table class="table table-sm table-borderless">
            <tr>
              <td><strong>Nama:</strong></td>
              <td>{{ $order->customer_name }}</td>
            </tr>
            <tr>
              <td><strong>Email:</strong></td>
              <td>
                <a href="mailto:{{ $order->customer_email }}">{{ $order->customer_email }}</a>
              </td>
            </tr>
            <tr>
              <td><strong>Telepon:</strong></td>
              <td>
                <a href="tel:{{ $order->customer_phone }}">{{ $order->customer_phone }}</a>
              </td>
            </tr>
            <tr>
              <td><strong>Alamat:</strong></td>
              <td>{{ $order->customer_address }}</td>
            </tr>
          </table>

          <div class="mt-3">
            <a href="mailto:{{ $order->customer_email }}" class="btn btn-outline-primary btn-sm me-2">
              <i class="fas fa-envelope"></i> Email
            </a>
            <a href="tel:{{ $order->customer_phone }}" class="btn btn-outline-success btn-sm">
              <i class="fas fa-phone"></i> Telepon
            </a>
          </div>
        </div>
      </div>

      <!-- Quick Actions -->
      <div class="card mt-4">
        <div class="card-header">
          <h5><i class="fas fa-tools"></i> Aksi Cepat</h5>
        </div>
        <div class="card-body">
          <div class="d-grid gap-2">
            @if($order->status === 'pending' && $order->payment_method === 'cod')
            <form method="POST" action="{{ route('admin.orders.update-status', $order->id) }}">
              @csrf
              @method('PATCH')
              <input type="hidden" name="status" value="processing">
              <button type="submit" class="btn btn-success w-100">
                <i class="fas fa-check"></i> Konfirmasi COD
              </button>
            </form>
            @endif

            @if($order->status === 'processing')
            <form method="POST" action="{{ route('admin.orders.update-status', $order->id) }}">
              @csrf
              @method('PATCH')
              <input type="hidden" name="status" value="shipped">
              <button type="submit" class="btn btn-info w-100">
                <i class="fas fa-shipping-fast"></i> Tandai Dikirim
              </button>
            </form>
            @endif

            @if($order->status === 'shipped')
            <form method="POST" action="{{ route('admin.orders.update-status', $order->id) }}">
              @csrf
              @method('PATCH')
              <input type="hidden" name="status" value="delivered">
              <button type="submit" class="btn btn-success w-100">
                <i class="fas fa-check-circle"></i> Tandai Selesai
              </button>
            </form>
            @endif

            @if(!in_array($order->status, ['delivered', 'cancelled']))
            <button type="button" class="btn btn-outline-danger w-100" data-bs-toggle="modal" data-bs-target="#cancelModal">
              <i class="fas fa-times"></i> Batalkan Pesanan
            </button>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Cancel Modal -->
<div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cancelModalLabel">Batalkan Pesanan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Apakah Anda yakin ingin membatalkan pesanan <strong>{{ $order->order_number }}</strong>?</p>
        <p class="text-warning"><small>Pastikan untuk menghubungi pelanggan terlebih dahulu.</small></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <form method="POST" action="{{ route('admin.orders.update-status', $order->id) }}" class="d-inline">
          @csrf
          @method('PATCH')
          <input type="hidden" name="status" value="cancelled">
          <button type="submit" class="btn btn-danger">Batalkan Pesanan</button>
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
  });
</script>
@endpush
@endsection