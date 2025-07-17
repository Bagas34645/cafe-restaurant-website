# Perubahan Migrasi Gallery untuk Sentra Durian Tegal

## Perubahan yang Dilakukan

### 1. Struktur Tabel Gallery (Bahasa Indonesia)

-   `title` → `judul`
-   `description` → `deskripsi`
-   `image_path` → `path_gambar`
-   `is_active` → `aktif`
-   **Baru**: `kategori` (umum, durian, kebun, proses, fasilitas)
-   **Baru**: `urutan` (untuk mengurutkan tampilan gallery)

### 2. Model Gallery

-   Updated fillable fields sesuai dengan field baru
-   Ditambahkan scope untuk query yang lebih mudah:
    -   `aktif()` - mengambil gallery yang aktif
    -   `kategori($kategori)` - filter berdasarkan kategori
    -   `urutkan()` - mengurutkan berdasarkan field urutan
-   Ditambahkan helper methods:
    -   `getUrlGambar()` - mendapatkan URL gambar lengkap
    -   `getKategoriTersedia()` - daftar kategori yang tersedia

### 3. Data Seeder

Konten gallery disesuaikan untuk Sentra Durian Tegal dengan kategori:

-   **Kebun**: Pemandangan kebun durian
-   **Durian**: Berbagai varietas durian (Montong, Bawor)
-   **Proses**: Pemetikan, penyortiran, quality control
-   **Fasilitas**: Area persemaian, fasilitas penyortiran
-   **Umum**: Tim petani, dll

### 4. Kategori Gallery

-   `umum` - Konten umum seperti tim, profil
-   `durian` - Foto-foto buah durian dan varietasnya
-   `kebun` - Pemandangan kebun dan area pertanian
-   `proses` - Proses pemetikan, pengolahan, pengemasan
-   `fasilitas` - Fasilitas dan infrastruktur

## File yang Diubah

1. `/database/migrations/2025_07_15_121021_create_galleries_table.php`
2. `/database/migrations/2025_07_15_130000_update_galleries_table_for_sentra_durian.php` (baru)
3. `/database/seeders/GallerySeeder.php`
4. `/app/Models/Gallery.php`
5. `/app/Http/Controllers/GalleryController.php` - ✅ FIXED
6. `/app/Http/Controllers/HomeController.php` - ✅ FIXED (query limit 6)
7. `/resources/views/admin/galleries/index.blade.php` - ✅ FIXED
8. `/resources/views/admin/galleries/show.blade.php` - ✅ FIXED
9. `/resources/views/admin/galleries/create.blade.php` - ✅ FIXED
10. `/resources/views/admin/galleries/edit.blade.php` - ✅ FIXED
11. `/resources/views/admin/dashboard.blade.php` - ✅ FIXED
12. `/resources/views/gallery/index.blade.php` - ✅ FIXED
13. `/resources/views/home.blade.php` - ✅ FIXED

## Cara Menjalankan Migrasi

```bash
php artisan migrate:fresh --seed
```

Atau jika ingin menjalankan migrasi secara terpisah:

```bash
php artisan migrate
php artisan db:seed --class=GallerySeeder
```

## Contoh Penggunaan Model

```php
// Mengambil semua gallery aktif yang diurutkan
$galleries = Gallery::aktif()->urutkan()->get();

// Mengambil gallery berdasarkan kategori
$durianGallery = Gallery::aktif()->kategori('durian')->urutkan()->get();

// Mengambil URL gambar
foreach ($galleries as $gallery) {
    echo $gallery->getUrlGambar();
}

// Mendapatkan daftar kategori
$kategoris = Gallery::getKategoriTersedia();
```

## Status Perbaikan Error MySQL

✅ **FIXED**: Error `SQLSTATE[42S22]: Column not found: 1054 Unknown column 'is_active'` sudah teratasi.

### Perubahan untuk Mengatasi Error MySQL:

1. **GalleryController**: Mengubah query dari `where('is_active', true)` menjadi scope `aktif()`
2. **HomeController**: ✅ FIXED - Query `Gallery::where('is_active', true)->take(6)` diubah menjadi `Gallery::aktif()->urutkan()->take(6)`
3. **Views**: Mengganti semua referensi field lama (`title`, `description`, `image_path`, `is_active`) dengan field baru (`judul`, `deskripsi`, `path_gambar`, `aktif`)
4. **Forms**: Memperbarui form create dan edit dengan field bahasa Indonesia dan dropdown kategori
5. **Validation**: Menambahkan validasi untuk kategori dan field baru

### Verifikasi:

-   ✅ Model berfungsi dengan baik
-   ✅ Scope `aktif()`, `kategori()`, dan `urutkan()` berjalan normal
-   ✅ Query controller tidak lagi menggunakan field lama
-   ✅ Semua view sudah menggunakan field bahasa Indonesia
-   ✅ Data seeder berhasil populate 10 item gallery Sentra Durian Tegal
