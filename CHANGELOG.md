# Changelog

Semua perubahan penting pada project ini akan didokumentasikan dalam file ini.

## [Unreleased]

### Added
- Sistem manajemen galeri lengkap dengan CRUD operations
- Katalog produk durian dengan kategori dan pencarian
- Sistem testimoni pelanggan dengan approval admin
- Form kontak dengan manajemen pesan admin
- Dashboard admin dengan statistik dan overview
- Sistem keranjang belanja untuk pelanggan
- Integrasi pembayaran dengan Midtrans
- Autentikasi customer dan admin terpisah
- Sistem order management untuk admin
- Upload dan manajemen gambar produk/galeri
- Responsive design dengan Bootstrap 5
- Sample data seeding untuk development

### Features
- **Galeri**: Upload, edit, delete foto dengan status publish/draft
- **Produk**: Manajemen katalog durian dengan kategori dan harga
- **Review**: Sistem persetujuan testimoni pelanggan
- **Kontak**: Form kontak dengan notifikasi admin
- **Cart**: Keranjang belanja dengan session storage
- **Payment**: Integrasi Midtrans untuk pembayaran online
- **Orders**: Manajemen pesanan dengan status tracking
- **Auth**: Dual authentication system (customer & admin)

### Technical
- Laravel 12.x dengan PHP 8.2+
- Database migrations dan seeders
- Image storage dengan Laravel Storage
- AJAX untuk keranjang dan pencarian
- CSV export untuk data order
- Middleware untuk proteksi route admin
- Validation untuk semua form input

## [1.0.0] - 2024-12-XX

### Initial Release
- Setup basic Laravel project structure
- Basic CRUD functionality for all modules
- Admin panel implementation
- Public website with all required pages

---

## Format Versioning

Project ini mengikuti [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

### Types of Changes
- **Added**: Untuk fitur baru
- **Changed**: Untuk perubahan pada fitur yang sudah ada
- **Deprecated**: Untuk fitur yang akan dihapus di versi mendatang
- **Removed**: Untuk fitur yang sudah dihapus
- **Fixed**: Untuk bug fixes
- **Security**: Untuk perbaikan keamanan
