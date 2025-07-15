# Content Management System (CMS) - Sentra Durian Tegal

## Overview

Sistem Content Management System (CMS) telah diimplementasikan untuk mengelola konten website secara dinamis tanpa perlu mengubah kode secara langsung. Sistem ini memungkinkan admin untuk mengubah teks, judul, deskripsi, gambar, dan elemen konten lainnya melalui interface admin.

## Fitur Utama

### 1. Manajemen Konten Dinamis

-   **Teks**: Judul, deskripsi, paragraf
-   **Gambar**: Upload dan manajemen gambar
-   **Section**: Pengelompokan konten berdasarkan halaman
-   **Metadata**: Data tambahan dalam format JSON
-   **Status**: Aktif/tidak aktif untuk setiap konten

### 2. Tipe Konten

-   **Text**: Konten teks biasa
-   **Image**: Konten gambar dengan upload
-   **Section**: Bagian khusus halaman
-   **Hero**: Bagian banner/hero
-   **Feature**: Fitur atau kartu khusus

### 3. Pengelompokan Section

-   **Home**: Konten halaman beranda
-   **About**: Konten halaman tentang kami
-   **Contact**: Konten halaman kontak
-   **Footer**: Konten footer website
-   **General**: Konten umum

## Struktur Database

### Tabel `contents`

```sql
- id (Primary Key)
- key (String, Unique) - Identifier unik untuk konten
- title (String, Nullable) - Judul untuk admin
- content (Text, Nullable) - Isi konten
- image_path (String, Nullable) - Path gambar
- meta_data (JSON, Nullable) - Data tambahan
- type (String) - Tipe konten
- section (String) - Section halaman
- order (Integer) - Urutan tampil
- is_active (Boolean) - Status aktif
- created_at, updated_at (Timestamps)
```

## Cara Penggunaan

### 1. Menambah Konten Baru

1. Login ke admin panel
2. Pilih "Content Management" dari menu
3. Klik "Tambah Konten"
4. Isi form dengan data:
    - **Key**: Identifier unik (contoh: `home_hero_title`)
    - **Judul**: Deskripsi untuk admin
    - **Tipe**: Pilih tipe konten
    - **Section**: Pilih section halaman
    - **Konten**: Isi konten
    - **Gambar**: Upload jika tipe image
    - **Urutan**: Nomor urutan
    - **Status**: Aktif/tidak aktif

### 2. Mengedit Konten

1. Buka "Content Management"
2. Klik tombol edit pada konten yang ingin diubah
3. Ubah data sesuai kebutuhan
4. Simpan perubahan

### 3. Menghapus Konten

1. Buka "Content Management"
2. Klik tombol hapus pada konten
3. Konfirmasi penghapusan

## Implementasi di View

### Helper Functions

Sistem CMS menyediakan helper functions untuk memudahkan penggunaan:

```php
// Mendapatkan konten berdasarkan key
cms_content('home_hero_title', 'Default Title')

// Mendapatkan konten dengan metadata
cms_content_with_meta('about_mission_quality_title')

// Mendapatkan URL gambar
cms_image('about_story_image', 'images/default.jpg')

// Mendapatkan semua konten dalam section
cms_section('home')
```

### Contoh Penggunaan di Blade Template

#### 1. Konten Teks Sederhana

```php
<h1>{{ cms_content('home_hero_title', 'Selamat Datang') }}</h1>
<p>{{ cms_content('home_hero_subtitle', 'Deskripsi default') }}</p>
```

#### 2. Konten Gambar

```php
<img src="{{ cms_image('about_story_image', 'images/default.jpg') }}"
     alt="Story Image"
     class="img-fluid">
```

#### 3. Konten dengan Metadata

```php
@php
  $qualityMeta = cms_content_with_meta('about_mission_quality_title');
  $icon = $qualityMeta->meta_data['icon'] ?? 'fas fa-star';
@endphp
<i class="{{ $icon }}"></i>
<h5>{{ cms_content('about_mission_quality_title', 'Kualitas') }}</h5>
```

## Konten Default yang Tersedia

### Halaman Home

-   `home_hero_title`: Judul hero section
-   `home_hero_subtitle`: Subtitle hero section
-   `home_featured_title`: Judul produk unggulan
-   `home_featured_subtitle`: Subtitle produk unggulan

### Halaman About

-   `about_hero_title`: Judul hero about
-   `about_hero_subtitle`: Subtitle hero about
-   `about_story_title`: Judul kisah kami
-   `about_story_content`: Konten kisah kami
-   `about_story_image`: Gambar kisah kami
-   `about_mission_title`: Judul misi kami
-   `about_mission_quality_title`: Judul kualitas
-   `about_mission_quality_content`: Konten kualitas
-   `about_mission_service_title`: Judul pelayanan
-   `about_mission_service_content`: Konten pelayanan
-   `about_mission_innovation_title`: Judul inovasi
-   `about_mission_innovation_content`: Konten inovasi

### Halaman Contact

-   `contact_title`: Judul halaman kontak
-   `contact_subtitle`: Subtitle halaman kontak

### Footer

-   `footer_description`: Deskripsi footer

## Keamanan

### Validasi Input

-   Key unik untuk setiap konten
-   Validasi tipe file untuk upload gambar
-   Sanitasi input untuk mencegah XSS
-   Validasi ukuran file (maksimal 2MB)

### Authorization

-   Hanya admin yang dapat mengakses CMS
-   Middleware `admin` melindungi semua route admin
-   Session-based authentication

## Backup dan Restore

### Export Konten

```bash
php artisan db:seed --class=ContentSeeder
```

### Backup Database

```bash
# Backup SQLite database
cp database/database.sqlite database/backup_$(date +%Y%m%d_%H%M%S).sqlite
```

## Tips Penggunaan

### 1. Penamaan Key

-   Gunakan format: `{section}_{element}_{type}`
-   Contoh: `home_hero_title`, `about_story_content`
-   Hindari spasi, gunakan underscore

### 2. Manajemen Gambar

-   Upload gambar dengan resolusi optimal
-   Gunakan format JPG/PNG untuk kompatibilitas
-   Kompres gambar sebelum upload

### 3. Organisasi Konten

-   Gunakan urutan (order) untuk mengatur posisi
-   Kelompokkan konten berdasarkan section
-   Berikan judul yang jelas untuk memudahkan pengelolaan

### 4. Performance

-   Konten di-cache secara otomatis
-   Gunakan `is_active` untuk menyembunyikan konten sementara
-   Hindari konten yang terlalu panjang

## Troubleshooting

### 1. Konten Tidak Muncul

-   Pastikan konten dalam status aktif
-   Periksa key konten sudah benar
-   Cek apakah helper function dipanggil dengan benar

### 2. Gambar Tidak Tampil

-   Pastikan symbolic link storage sudah dibuat: `php artisan storage:link`
-   Cek path gambar di database
-   Pastikan file gambar ada di storage/app/public

### 3. Error saat Upload

-   Periksa ukuran file (maksimal 2MB)
-   Pastikan format file didukung (JPG, PNG, GIF)
-   Cek permission direktori storage

## Update dan Maintenance

### 1. Menambah Tipe Konten Baru

1. Update enum di validation ContentController
2. Update view form create/edit
3. Update helper functions jika diperlukan

### 2. Menambah Section Baru

1. Update dropdown section di form
2. Tambahkan icon di dashboard jika diperlukan
3. Buat seeder untuk konten default section baru

### 3. Migration Tambahan

Jika perlu menambah kolom baru:

```bash
php artisan make:migration add_new_column_to_contents_table
```

## Kesimpulan

Sistem CMS ini memberikan fleksibilitas penuh untuk mengelola konten website tanpa perlu mengubah kode. Dengan interface yang user-friendly dan sistem yang aman, admin dapat dengan mudah mengupdate konten sesuai kebutuhan bisnis.

Untuk bantuan lebih lanjut atau pengembangan fitur tambahan, silakan merujuk pada dokumentasi Laravel atau hubungi developer.
