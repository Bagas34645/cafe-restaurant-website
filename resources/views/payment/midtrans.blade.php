@extends('layouts.app')

@section('title', 'Pembayaran - Rajane Duren')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <h5><i class="fas fa-credit-card"></i> Pembayaran</h5>
        </div>
        <div class="card-body">
          <div class="row mb-4">
            <div class="col-md-6">
              <h6>Detail Pesanan:</h6>
              <p><strong>Nomor Pesanan:</strong> {{ $order->order_number }}</p>
              <p><strong>Total:</strong> <span class="text-primary fs-5">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span></p>
            </div>
            <div class="col-md-6">
              <h6>Pelanggan:</h6>
              <p><strong>Nama:</strong> {{ $order->customer_name }}</p>
              <p><strong>Email:</strong> {{ $order->customer_email }}</p>
            </div>
          </div>

          <div class="text-center">
            <button id="pay-button" class="btn btn-primary btn-lg">
              <i class="fas fa-credit-card"></i> Bayar Sekarang
            </button>
          </div>

          <div class="mt-4">
            <div class="alert alert-info">
              <i class="fas fa-info-circle"></i>
              <strong>Metode Pembayaran yang Tersedia:</strong>
              <ul class="mb-0 mt-2">
                <li>Transfer Bank (BCA, Mandiri, BNI, BRI, dll)</li>
                <li>E-Wallet (GoPay, OVO, DANA, LinkAja)</li>
                <li>Kartu Kredit/Debit</li>
                <li>Alfamart/Indomaret</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Midtrans Snap JS -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>

<script type="text/javascript">
  document.getElementById('pay-button').onclick = function() {
    // SnapToken acquired from previous step
    snap.pay('{{ $snapToken }}', {
      // Optional
      onSuccess: function(result) {
        console.log(result);
        window.location.href = '{{ route("payment.midtrans.finish") }}?order_id={{ $order->order_number }}';
      },
      // Optional
      onPending: function(result) {
        console.log(result);
        window.location.href = '{{ route("payment.midtrans.unfinish") }}?order_id={{ $order->order_number }}';
      },
      // Optional
      onError: function(result) {
        console.log(result);
        window.location.href = '{{ route("payment.midtrans.error") }}?order_id={{ $order->order_number }}';
      }
    });
  };
</script>
@endsection