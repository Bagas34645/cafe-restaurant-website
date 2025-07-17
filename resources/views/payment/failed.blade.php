@extends('layouts.app')

@section('title', 'Payment Failed - Rajane Duren')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card border-danger">
        <div class="card-header bg-danger text-white text-center">
          <h4><i class="fas fa-times-circle"></i> Pembayaran Gagal</h4>
        </div>
        <div class="card-body text-center">
          @if($order)
          <h5>Pembayaran tidak dapat diselesaikan</h5>
          <p class="text-muted">Terjadi masalah saat memproses pembayaran untuk pesanan {{ $order->order_number }}.</p>

          <div class="order-details mt-4">
            <div class="row">
              <div class="col-md-6">
                <strong>Nomor Pesanan:</strong><br>
                <span class="text-primary fs-5">{{ $order->order_number }}</span>
              </div>
              <div class="col-md-6">
                <strong>Jumlah:</strong><br>
                <span class="fs-5">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-6">
                <strong>Pelanggan:</strong><br>
                {{ $order->customer_name }}
              </div>
              <div class="col-md-6">
                <strong>Status:</strong><br>
                <span class="badge bg-warning">{{ ucfirst($order->status) }}</span>
              </div>
            </div>
          </div>

          <div class="mt-4">
            <div class="alert alert-info">
              <i class="fas fa-info-circle"></i>
              Pesanan Anda masih dalam status pending. Anda dapat mencoba pembayaran lagi atau menghubungi customer service kami.
            </div>
          </div>

          <div class="mt-4">
            <a href="{{ route('payment.midtrans', $order->id) }}" class="btn btn-primary me-2">
              <i class="fas fa-credit-card"></i> Coba Bayar Lagi
            </a>
            <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary">
              <i class="fas fa-shopping-cart"></i> Kembali ke Keranjang
            </a>
          </div>
          @else
          <h5>Informasi Pembayaran Tidak Tersedia</h5>
          <p class="text-muted">Silakan hubungi customer service kami untuk bantuan.</p>

          <div class="mt-4">
            <a href="{{ route('products') }}" class="btn btn-primary">
              <i class="fas fa-shopping-bag"></i> Lanjut Belanja
            </a>
          </div>
          @endif

          <div class="mt-4">
            <div class="alert alert-warning">
              <strong>Butuh Bantuan?</strong><br>
              Hubungi customer service kami di:<br>
              <strong>Email:</strong> javatani00@gmail.com<br>
              <strong>WhatsApp:</strong> +62 812-3456-7890<br>
              <strong>Jam Layanan:</strong> 08:00 - 22:00 WIB
            </div>
          </div>

          <div class="mt-3">
            <h6>Kemungkinan Penyebab:</h6>
            <ul class="text-start text-muted">
              <li>Saldo atau limit kartu tidak mencukupi</li>
              <li>Koneksi internet terputus saat transaksi</li>
              <li>Transaksi dibatalkan oleh pengguna</li>
              <li>Masalah teknis dari bank atau payment gateway</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection