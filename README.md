# Sentra Durian Tegal Website

Website pemasaran berbasis Laravel untuk Sentra Durian Tegal - Rajane Duren, pusat penjualan durian berkualitas dengan sistem manajemen admin yang komprehensif.

## 🚀 Fitur Utama

### Halaman Publik
- **Beranda**: Produk durian unggulan, preview galeri, dan testimoni
- **Tentang Kami**: Informasi perusahaan, misi, dan tim
- **Galeri**: Koleksi foto kebun durian dan fasilitas
- **Produk**: Katalog durian dengan kategori dan detail harga
- **Testimoni**: Review pelanggan dan form pengiriman testimoni
- **Kontak**: Form kontak, lokasi, dan FAQ

### Panel Admin
- **Dashboard**: Statistik dan overview data
- **Manajemen Galeri**: CRUD operasi untuk item galeri
- **Manajemen Produk**: CRUD operasi untuk produk durian
- **Manajemen Review**: Approve/reject testimoni pelanggan
- **Manajemen Kontak**: Kelola pesan dari pelanggan

### Teknologi
- ✅ Laravel 12.x dengan PHP 8.2+
- ✅ Responsive design dengan Bootstrap 5
- ✅ Upload dan manajemen gambar
- ✅ Sistem persetujuan review
- ✅ Pagination dan filtering data
- ✅ Sample data untuk development

## 📋 Instalasi

### Prerequisites
- PHP 8.2 atau lebih tinggi
- Composer
- Node.js & NPM
- MySQL atau SQLite

### Langkah Instalasi

1. **Clone repository**
   ```bash
   git clone <repository-url>
   cd cafe-restaurant-website
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Setup environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Konfigurasi database**
   
   Update file `.env` dengan kredensial database:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=sentra_durian_tegal
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

5. **Migrasi dan seeding database**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

6. **Setup storage symlink**
   ```bash
   php artisan storage:link
   ```

7. **Jalankan development server**
   ```bash
   php artisan serve
   npm run dev
   ```

## 🎯 Penggunaan

### Website Publik
- Kunjungi `http://localhost:8000` untuk melihat website utama
- Navigasi melalui menu utama untuk mengakses halaman berbeda
- Kirim testimoni melalui halaman Reviews
- Kirim pesan melalui halaman Contact

### Panel Admin
- Akses panel admin di `http://localhost:8000/admin`
- Kelola galeri, produk, review, dan pesan kontak
- Lihat statistik dashboard dan aktivitas terbaru

## 📁 Struktur Project

```
app/
├── Http/Controllers/
│   ├── AdminController.php      # Dashboard admin
│   ├── ContactController.php    # Manajemen kontak
│   ├── GalleryController.php    # CRUD galeri
│   ├── HomeController.php       # Halaman utama
│   ├── ProductController.php    # CRUD produk
│   └── ReviewController.php     # Manajemen review
├── Models/
│   ├── Contact.php             # Model pesan kontak
│   ├── Gallery.php             # Model galeri
│   ├── Product.php             # Model produk
│   └── Review.php              # Model review
database/
├── migrations/                 # Schema database
└── seeders/                   # Data sample
resources/
├── views/                     # Template Blade
└── assets/                    # CSS & JS
```

## 🗄️ Database Schema

### Tabel Utama
- **galleries**: Menyimpan item galeri dengan gambar dan deskripsi
- **products**: Menyimpan produk durian dengan kategori dan harga
- **reviews**: Menyimpan testimoni pelanggan dengan status persetujuan
- **contacts**: Menyimpan pesan kontak dengan status baca

## 📚 Dokumentasi

Dokumentasi lengkap tersedia di folder `docs/`:
- [Panduan Setup](docs/SETUP_TESTING_GUIDE.md)
- [Dokumentasi CMS](docs/CMS_DOCUMENTATION.md)
- [Panduan Admin](docs/ADMIN_LOGIN_GUIDE.md)
- [Daftar Lengkap Dokumentasi](docs/README.md)

## 🚀 Deploy ke Production

1. **Setup server** dengan PHP 8.2+, Composer, dan web server (Apache/Nginx)
2. **Upload files** ke server menggunakan Git atau FTP
3. **Install dependencies** di server:
   ```bash
   composer install --optimize-autoloader --no-dev
   npm install && npm run build
   ```
4. **Setup environment** production di `.env`
5. **Migrasi database** di server
6. **Setup permissions** untuk direktori storage dan bootstrap/cache

## 📄 License

Project ini menggunakan [MIT License](LICENSE).
