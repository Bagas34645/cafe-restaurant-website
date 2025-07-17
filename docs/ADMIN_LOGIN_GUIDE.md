# Admin Login System - Cafe Restaurant Website

## Fitur Yang Telah Dibuat

✅ **Halaman Login Admin** - `/admin/login`
✅ **Autentikasi Admin** - Sistem login yang aman
✅ **Middleware Admin** - Perlindungan untuk halaman admin
✅ **Logout Functionality** - Tombol logout di dashboard
✅ **User Management** - Kolom `is_admin` di database
✅ **Default Admin User** - User admin default sudah dibuat

## Cara Menggunakan

### 1. Akses Halaman Login

-   Buka browser dan kunjungi: `http://localhost:8000/admin/login`
-   Atau klik tombol "Admin" di menu navigasi website

### 2. Login sebagai Admin

Gunakan kredensial default:

-   **Email**: `admin@email.com`
-   **Password**: `admin123`

### 3. Mengakses Dashboard Admin

Setelah login berhasil, Anda akan diarahkan ke dashboard admin di `/admin`

### 4. Logout

Klik tombol "Logout" di header dashboard atau di sidebar untuk keluar dari sistem

## Struktur File Yang Dibuat/Dimodifikasi

### Controllers

-   `app/Http/Controllers/AuthController.php` - Handle login/logout admin
-   `app/Http/Middleware/AdminMiddleware.php` - Middleware proteksi admin

### Views

-   `resources/views/admin/auth/login.blade.php` - Halaman login admin
-   `resources/views/layouts/admin.blade.php` - Layout admin (ditambah header + logout)
-   `resources/views/layouts/app.blade.php` - Layout utama (update link admin)

### Database

-   `database/migrations/2025_07_15_124648_add_is_admin_to_users_table.php` - Tambah kolom is_admin
-   `database/seeders/AdminUserSeeder.php` - Seeder untuk user admin default
-   `app/Models/User.php` - Update model User

### Routes

-   `routes/web.php` - Ditambah routes untuk login/logout admin + middleware

## Keamanan

1. **Middleware Protection** - Semua routes admin dilindungi middleware `admin`
2. **Session Management** - Logout akan menghapus session dengan aman
3. **Admin Check** - User harus memiliki `is_admin = true` untuk akses admin
4. **CSRF Protection** - Semua form menggunakan CSRF token
5. **Password Hashing** - Password di-hash menggunakan bcrypt

## Membuat Admin User Baru

### Melalui Database Seeder

```bash
php artisan db:seed --class=AdminUserSeeder
```

### Melalui Tinker

```bash
php artisan tinker
```

```php
User::create([
    'name' => 'Nama Admin',
    'email' => 'admin@example.com',
    'password' => Hash::make('password123'),
    'is_admin' => true,
    'email_verified_at' => now(),
]);
```

### Manual Database

Update user yang sudah ada:

```sql
UPDATE users SET is_admin = 1 WHERE email = 'email@example.com';
```

## Testing

1. Jalankan server development:

```bash
php artisan serve
```

2. Buka browser dan test:
    - Kunjungi `/admin/login`
    - Login dengan kredensial admin
    - Verifikasi redirect ke dashboard
    - Test logout functionality
    - Coba akses `/admin` tanpa login (harus redirect ke login)

## Catatan Penting

-   User biasa (non-admin) tidak bisa mengakses halaman admin
-   Admin yang sudah login akan otomatis diarahkan ke dashboard jika mengakses halaman login
-   Sistem menggunakan Laravel Auth bawaan dengan custom middleware
-   Semua routes admin sudah terlindungi dan memerlukan autentikasi

## Customize

Untuk mengubah tampilan login atau menambah fitur:

1. **Ubah tampilan login**: Edit `resources/views/admin/auth/login.blade.php`
2. **Tambah validasi**: Modifikasi `AuthController.php`
3. **Ubah redirect**: Update route atau controller logic
4. **Tambah field user**: Buat migration baru dan update model
