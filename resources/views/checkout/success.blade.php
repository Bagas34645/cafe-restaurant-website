@extends('layouts.app')

@section('title', 'Pesanan Berhasil - Rajane Duren')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-body text-center py-5">
          <div class="mb-4">
            <i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>
          </div>

          <h2 class="mb-3">Pesanan Berhasil Dibuat!</h2>
          <p class="text-muted mb-4">Terima kasih telah berbelanja di Rajane Duren</p>

          <div class="row mb-4">
            <div class="col-md-6">
              <div class="mb-3">
                <strong>Nomor Pesanan:</strong><br>
                <span class="text-primary fs-5">{{ $order->order_number }}</span>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <strong>Total Pembayaran:</strong><br>
                <span class="text-success fs-5">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
              </div>
            </div>
          </div>

          <div class="alert alert-info">
            @if($order->payment_method === 'cod')
            <i class="fas fa-info-circle"></i>
            <strong>Pembayaran COD (Cash on Delivery)</strong><br>
            Kami akan menghubungi Anda dalam 1x24 jam untuk konfirmasi pesanan dan pengaturan pengiriman.
            Pembayaran dapat dilakukan saat barang sampai di lokasi Anda.
            @else
            <i class="fas fa-info-circle"></i>
            <strong>Pembayaran Online</strong><br>
            Pesanan Anda akan diproses setelah pembayaran dikonfirmasi.
            Kami akan mengirim update status pesanan melalui email.
            @endif
          </div>

          <div class="row mb-4">
            <div class="col-md-6">
              <h6>Detail Pelanggan:</h6>
              <div class="text-start">
                <p class="mb-1"><strong>Nama:</strong> {{ $order->customer_name }}</p>
                <p class="mb-1"><strong>Email:</strong> {{ $order->customer_email }}</p>
                <p class="mb-1"><strong>Telepon:</strong> {{ $order->customer_phone }}</p>
                <p class="mb-1"><strong>Alamat:</strong> {{ $order->customer_address }}</p>
              </div>
            </div>
            <div class="col-md-6">
              <h6>Pesanan:</h6>
              <div class="text-start">
                @foreach($order->orderItems as $item)
                <div class="d-flex justify-content-between">
                  <span>{{ $item->product_name }} ({{ $item->quantity }}x)</span>
                  <span>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                </div>
                @endforeach
                <hr>
                <div class="d-flex justify-content-between">
                  <strong>Total:</strong>
                  <strong>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong>
                </div>
              </div>
            </div>
          </div>

          @if($order->notes)
          <div class="alert alert-light">
            <strong>Catatan:</strong> {{ $order->notes }}
          </div>
          @endif

          <div class="mt-4">
            <a href="{{ route('products') }}" class="btn btn-primary me-2">
              <i class="fas fa-shopping-bag"></i> Belanja Lagi
            </a>
            <a href="{{ route('home') }}" class="btn btn-outline-secondary">
              <i class="fas fa-home"></i> Kembali ke Beranda
            </a>
          </div>

          <div class="mt-4 pt-4 border-top">
            <small class="text-muted">
              <i class="fas fa-phone"></i> Butuh bantuan? Hubungi kami di
              <a href="tel:+6281234567890">081234567890</a> atau
              <a href="mailto:info@rajanedurian.com">info@rajanedurian.com</a>
            </small>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection