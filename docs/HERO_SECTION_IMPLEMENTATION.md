# Implementasi Hero Section dengan Background Hijau dan Upload Gambar

## Perubahan yang Telah Dilakukan:

### 1. Background Color Hero Section

-   ✅ **Background hero section** diubah dari gambar menjadi **warna solid #1c5b40** (hijau tua)
-   ✅ Warna dipilih untuk memberikan nuansa natural dan elegan yang sesuai dengan tema durian

### 2. Struktur Hero Section Baru

-   ✅ **Layout 2 kolom**:
    -   Kolom kiri (8/12): Teks "Selamat Datang" + deskripsi + tombol
    -   Kolom kanan (4/12): Area untuk gambar yang dapat diupload melalui admin

### 3. Sistem Upload Gambar melalui Admin

-   ✅ **Database entry** untuk `home_hero_image` dibuat via seeder
-   ✅ **Admin panel** sudah support upload gambar melalui Content Management
-   ✅ **Key konten**: `home_hero_image` dengan tipe `image`

### 4. Fitur Tampilan Gambar

-   ✅ **Responsive design**: Gambar otomatis menyesuaikan ukuran layar
-   ✅ **Placeholder**: Jika belum ada gambar, tampil placeholder dengan instruksi upload
-   ✅ **Hover effect**: Gambar membesar sedikit saat di-hover
-   ✅ **Shadow & border radius**: Tampilan gambar lebih menarik

### 5. CSS Enhancement

-   ✅ **Custom styling** untuk hero section dengan background #1c5b40
-   ✅ **Hero image transition effects**
-   ✅ **Placeholder styling** yang konsisten dengan theme

## Cara Menggunakan:

### Untuk Admin:

1. Login ke admin panel: `/admin/login`
2. Masuk ke menu **"Manajemen Konten"**
3. Cari atau edit entry dengan key `home_hero_image`
4. Upload gambar (JPG/PNG, max 2MB, rekomendasi 400x400px)
5. Set status "Aktif"
6. Gambar otomatis muncul di hero section

### Untuk User:

-   Hero section sekarang memiliki background hijau yang elegan
-   Di sebelah kanan teks terdapat gambar yang dapat dikelola admin
-   Tampilan responsive di semua device

## File yang Dimodifikasi:

1. `resources/views/layouts/app.blade.php` - CSS hero section
2. `resources/views/home.blade.php` - Struktur HTML hero section
3. `database/seeders/HeroImageContentSeeder.php` - Entry database untuk admin

## Route Admin yang Digunakan:

-   `/admin/contents` - Manajemen konten
-   Key: `home_hero_image` - Untuk upload gambar hero

## Technical Notes:

-   Gambar disimpan di `storage/app/public/contents/`
-   Akses gambar via `asset('storage/' . $path)`
-   Model `Content` menangani upload dan display
-   Background color: `#1c5b40` (hijau tua natural)
