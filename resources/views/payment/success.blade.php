@extends('layouts.app')

@section('title', 'Payment Success - Rajane Duren')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card border-success">
        <div class="card-header bg-success text-white text-center">
          <h4><i class="fas fa-check-circle"></i> Pembayaran Berhasil!</h4>
        </div>
        <div class="card-body text-center">
          @if($order)
          <h5>Terima kasih atas pesanan Anda!</h5>
          <p class="text-muted">Pesanan Anda telah berhasil diproses.</p>

          <div class="order-details mt-4">
            <div class="row">
              <div class="col-md-6">
                <strong>Nomor Pesanan:</strong><br>
                <span class="text-primary fs-5">{{ $order->order_number }}</span>
              </div>
              <div class="col-md-6">
                <strong>Total Pembayaran:</strong><br>
                <span class="text-success fs-5">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-6">
                <strong>Pelanggan:</strong><br>
                {{ $order->customer_name }}
              </div>
              <div class="col-md-6">
                <strong>Status:</strong><br>
                @if($order->status === 'paid')
                <span class="badge bg-success">Dibayar</span>
                @else
                <span class="badge bg-warning">{{ ucfirst($order->status) }}</span>
                @endif
              </div>
            </div>
          </div>

          <div class="mt-4">
            <div class="alert alert-info">
              <i class="fas fa-info-circle"></i>
              Email konfirmasi telah dikirim ke <strong>{{ $order->customer_email }}</strong>
            </div>
          </div>

          <div class="order-items mt-4">
            <h6>Detail Pesanan:</h6>
            <div class="table-responsive">
              <table class="table table-sm">
                <thead>
                  <tr>
                    <th>Produk</th>
                    <th class="text-center">Qty</th>
                    <th class="text-end">Subtotal</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($order->orderItems as $item)
                  <tr>
                    <td>{{ $item->product_name }}</td>
                    <td class="text-center">{{ $item->quantity }}</td>
                    <td class="text-end">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr class="table-active">
                    <th colspan="2">Total:</th>
                    <th class="text-end">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
          @else
          <h5>Informasi Pesanan Tidak Tersedia</h5>
          <p class="text-muted">Kami sedang memproses pembayaran Anda. Silakan cek email untuk konfirmasi.</p>
          @endif

          <div class="mt-4">
            <a href="{{ route('products') }}" class="btn btn-primary me-2">
              <i class="fas fa-shopping-bag"></i> Belanja Lagi
            </a>
            <a href="{{ route('home') }}" class="btn btn-outline-secondary">
              <i class="fas fa-home"></i> Kembali ke Beranda
            </a>
          </div>

          <div class="mt-4">
            <div class="alert alert-light">
              <strong>Butuh Bantuan?</strong><br>
              Hubungi kami di: <strong>javatani00@gmail.com</strong><br>
              Atau WhatsApp: <strong>+62 812-3456-7890</strong>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection