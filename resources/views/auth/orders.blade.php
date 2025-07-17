@extends('layouts.app')

@section('title', 'Riwayat Pesanan - Sentra Durian Tegal')

@section('content')
<div class="container py-5">
  <div class="row">
    <div class="col-md-3">
      <div class="card">
        <div class="card-body text-center">
          <i class="fas fa-user-circle display-3 text-primary mb-3"></i>
          <h5>{{ Auth::user()->name }}</h5>
          <p class="text-muted">{{ Auth::user()->email }}</p>
        </div>
        <div class="list-group list-group-flush">
          <a href="{{ route('profile') }}" class="list-group-item list-group-item-action">
            <i class="fas fa-user me-2"></i>Profil
          </a>
          <a href="{{ route('orders.history') }}" class="list-group-item list-group-item-action active">
            <i class="fas fa-history me-2"></i>Riwayat Pesanan
          </a>
        </div>
      </div>
    </div>

    <div class="col-md-9">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h4><i class="fas fa-history me-2"></i>Riwayat Pesanan</h4>
          <span class="badge bg-primary">{{ $orders->total() }} pesanan</span>
        </div>
        <div class="card-body">
          @if($orders->count() > 0)
          @foreach($orders as $order)
          <div class="card mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
              <div>
                <strong>Order #{{ $order->order_number }}</strong>
                <small class="text-muted ms-2">{{ $order->created_at->format('d M Y, H:i') }}</small>
              </div>
              <div>
                @switch($order->status)
                @case('pending')
                <span class="badge bg-warning">Menunggu Pembayaran</span>
                @break
                @case('paid')
                <span class="badge bg-info">Dibayar</span>
                @break
                @case('processing')
                <span class="badge bg-primary">Diproses</span>
                @break
                @case('shipped')
                <span class="badge bg-secondary">Dikirim</span>
                @break
                @case('delivered')
                <span class="badge bg-success">Selesai</span>
                @break
                @case('cancelled')
                <span class="badge bg-danger">Dibatalkan</span>
                @break
                @default
                <span class="badge bg-light text-dark">{{ ucfirst($order->status) }}</span>
                @endswitch
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-8">
                  <h6>Detail Pesanan:</h6>
                  @foreach($order->items as $item)
                  <div class="d-flex justify-content-between align-items-center mb-2">
                    <div class="d-flex align-items-center">
                      @if($item->product && $item->product->image)
                      <img src="{{ asset('storage/' . $item->product->image) }}"
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
                        <br>
                        <small class="text-muted">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</small>
                      </div>
                    </div>
                    <div>
                      <strong>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</strong>
                    </div>
                  </div>
                  @endforeach

                  <hr>

                  <div class="row">
                    <div class="col-6">
                      <p class="mb-1"><strong>Pengiriman:</strong></p>
                      <p class="text-muted mb-1">{{ $order->customer_name }}</p>
                      <p class="text-muted mb-1">{{ $order->customer_phone }}</p>
                      <p class="text-muted">{{ $order->customer_address }}</p>
                    </div>
                    <div class="col-6 text-end">
                      <p class="mb-1">Subtotal: Rp {{ number_format($order->subtotal, 0, ',', '.') }}</p>
                      <p class="mb-1">Ongkir: Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</p>
                      <h5 class="text-primary">Total: Rp {{ number_format($order->total, 0, ',', '.') }}</h5>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 text-end">
                  @if($order->status === 'pending')
                  <a href="{{ route('payment.midtrans', $order->id) }}" class="btn btn-primary btn-sm mb-2">
                    <i class="fas fa-credit-card me-1"></i>Bayar Sekarang
                  </a>
                  @endif

                  @if(in_array($order->status, ['delivered']))
                  <button class="btn btn-outline-primary btn-sm mb-2" onclick="reorderItems({{ $order->id }})">
                    <i class="fas fa-redo me-1"></i>Pesan Lagi
                  </button>
                  @endif

                  @if($order->status === 'pending')
                  <button class="btn btn-outline-danger btn-sm" onclick="cancelOrder({{ $order->id }})">
                    <i class="fas fa-times me-1"></i>Batalkan
                  </button>
                  @endif
                </div>
              </div>
            </div>
          </div>
          @endforeach

          <!-- Pagination -->
          <div class="d-flex justify-content-center">
            {{ $orders->links() }}
          </div>
          @else
          <div class="text-center py-5">
            <i class="fas fa-shopping-bag display-1 text-muted mb-3"></i>
            <h4>Belum Ada Pesanan</h4>
            <p class="text-muted">Anda belum pernah melakukan pemesanan.</p>
            <a href="{{ route('products') }}" class="btn btn-primary">
              <i class="fas fa-shopping-cart me-2"></i>Mulai Belanja
            </a>
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
  function reorderItems(orderId) {
    if (confirm('Apakah Anda ingin menambahkan semua produk dari pesanan ini ke keranjang?')) {
      fetch(`/orders/${orderId}/reorder`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            alert('Produk berhasil ditambahkan ke keranjang!');
            window.location.href = '{{ route("cart.index") }}';
          } else {
            alert('Terjadi kesalahan: ' + data.message);
          }
        })
        .catch(error => {
          console.error('Error:', error);
          alert('Terjadi kesalahan saat menambahkan produk ke keranjang.');
        });
    }
  }

  function cancelOrder(orderId) {
    if (confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')) {
      fetch(`/orders/${orderId}/cancel`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            alert('Pesanan berhasil dibatalkan.');
            location.reload();
          } else {
            alert('Terjadi kesalahan: ' + data.message);
          }
        })
        .catch(error => {
          console.error('Error:', error);
          alert('Terjadi kesalahan saat membatalkan pesanan.');
        });
    }
  }
</script>
@endpush

@push('styles')
<style>
  .card {
    border-radius: 10px;
    border: none;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  }

  .list-group-item.active {
    background-color: #e74c3c;
    border-color: #e74c3c;
  }

  .badge {
    font-size: 0.8em;
  }
</style>
@endpush
@endsection