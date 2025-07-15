@extends('layouts.app')

@section('title', 'Tentang Kami - Rajane Duren')

@section('content')
<!-- About Hero Section -->
<section class="py-5 bg-light">
  <div class="container">
    <div class="text-center mb-5">
      <h1 class="display-4 fw-bold">Tentang Kami</h1>
      <p class="lead text-muted">Pelajari kisah kami sebagai pusat durian berkualitas terbaik di Tegal</p>
    </div>
  </div>
</section>

<!-- Our Story Section -->
<section class="py-5">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6">
        <h2 class="display-5 fw-bold mb-4">Kisah Kami</h2>
        <p class="lead mb-4">Didirikan dengan visi menjadi pusat distribusi durian terbaik di Tegal, Sentra Durian Tegal telah melayani masyarakat dengan komitmen kualitas dan kepuasan pelanggan selama bertahun-tahun.</p>
        <p>Dimulai dari kebun keluarga kecil, kami telah berkembang menjadi destinasi utama bagi pecinta durian yang mencari kualitas terbaik. Kami bangga dengan jaringan petani durian terpilih di Tegal yang menghasilkan buah dengan rasa dan aroma khas yang tak tertandingi.</p>
        <p>Tim ahli kami memastikan setiap durian yang kami distribusikan telah melalui proses seleksi ketat untuk menjamin kepuasan dan kepercayaan pelanggan.</p>
      </div>
      <div class="col-lg-6">
        <img src="{{ asset('images/durian-farm.jpg') }}"
          alt="Kebun Durian Tegal" class="img-fluid rounded shadow">
      </div>
    </div>
  </div>
</section>

<!-- Our Mission Section -->
<section class="py-5 bg-light">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 mx-auto text-center">
        <h2 class="display-5 fw-bold mb-5">Misi Kami</h2>
        <div class="row">
          <div class="col-md-4 mb-4">
            <div class="card border-0 h-100">
              <div class="card-body text-center">
                <i class="fas fa-seedling fa-3x text-primary mb-3"></i>
                <h5 class="card-title">Kualitas</h5>
                <p class="card-text">Kami hanya menyediakan durian pilihan dari kebun terbaik dengan standar kualitas tinggi dan proses seleksi yang ketat.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 mb-4">
            <div class="card border-0 h-100">
              <div class="card-body text-center">
                <i class="fas fa-users fa-3x text-primary mb-3"></i>
                <h5 class="card-title">Pelayanan</h5>
                <p class="card-text">Tim ahli kami siap memberikan pelayanan terbaik dan konsultasi untuk membantu Anda memilih durian sesuai kebutuhan.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 mb-4">
            <div class="card border-0 h-100">
              <div class="card-body text-center">
                <i class="fas fa-leaf fa-3x text-primary mb-3"></i>
                <h5 class="card-title">Keberlanjutan</h5>
                <p class="card-text">Kami berkomitmen mendukung petani lokal dan praktik pertanian berkelanjutan untuk durian berkualitas terbaik.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Chef's Section -->
<section class="py-5">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="display-5 fw-bold">Tim Ahli Kami</h2>
      <p class="lead text-muted">Para profesional berpengalaman di balik kualitas durian terbaik</p>
    </div>

    <div class="row">
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="card border-0 text-center">
          <img src="{{ asset('images/team-pak-budi.jpg') }}"
            alt="Pak Budi - Ahli Durian" class="card-img-top rounded-circle mx-auto mt-3" style="width: 150px; height: 150px; object-fit: cover;">
          <div class="card-body">
            <h5 class="card-title">Pak Budi Santoso</h5>
            <p class="text-muted">Ahli Durian Senior</p>
            <p class="card-text">Dengan pengalaman lebih dari 20 tahun dalam budidaya durian, Pak Budi ahli dalam menilai kualitas dan kematangan durian terbaik.</p>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 mb-4">
        <div class="card border-0 text-center">
          <img src="{{ asset('images/team-ibu-sari.jpg') }}"
            alt="Ibu Sari - Manajer Operasional" class="card-img-top rounded-circle mx-auto mt-3" style="width: 150px; height: 150px; object-fit: cover;">
          <div class="card-body">
            <h5 class="card-title">Ibu Sari Wulandari</h5>
            <p class="text-muted">Manajer Operasional</p>
            <p class="card-text">Ibu Sari mengawasi seluruh operasional distribusi dan memastikan setiap pelanggan mendapat pelayanan terbaik dan durian berkualitas.</p>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 mb-4">
        <div class="card border-0 text-center">
          <img src="{{ asset('images/team-mas-andi.jpg') }}"
            alt="Mas Andi - Koordinator Petani" class="card-img-top rounded-circle mx-auto mt-3" style="width: 150px; height: 150px; object-fit: cover;">
          <div class="card-body">
            <h5 class="card-title">Mas Andi Prasetyo</h5>
            <p class="text-muted">Koordinator Petani</p>
            <p class="card-text">Mas Andi menjalin hubungan erat dengan petani durian di seluruh Tegal untuk memastikan pasokan durian terbaik sepanjang musim.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Call to Action -->
<section class="py-5 bg-primary text-white">
  <div class="container text-center">
    <h2 class="display-5 fw-bold mb-4">Rasakan Kualitas Durian Terbaik</h2>
    <p class="lead mb-4">Kunjungi Sentra Durian Tegal dan rasakan sendiri kelezatan durian pilihan dari kebun terbaik di Tegal.</p>
    <a href="{{ route('contact') }}" class="btn btn-light btn-lg me-3">Hubungi Kami</a>
    <a href="{{ route('products') }}" class="btn btn-outline-light btn-lg">Lihat Produk Durian</a>
  </div>
</section>
@endsection