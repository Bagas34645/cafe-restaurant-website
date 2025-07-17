# Implementasi Aturan Login untuk Keranjang Belanja

## Overview

Implementasi aturan yang mengharuskan pengguna untuk login terlebih dahulu sebelum dapat menambahkan produk ke keranjang belanja.

## Perubahan yang Dilakukan

### 1. Route Protection (routes/web.php)

-   Menambahkan middleware `customer` untuk route-route cart yang memerlukan autentikasi:
    -   `POST /cart/add` - Menambah produk ke keranjang
    -   `PATCH /cart/{id}` - Update quantity produk
    -   `DELETE /cart/{id}` - Hapus produk dari keranjang
    -   `DELETE /cart/` - Kosongkan keranjang
-   Route `GET /cart/` dan `GET /cart/count` tetap dapat diakses tanpa login

### 2. Controller Updates (app/Http/Controllers/CartController.php)

#### Method `add()`

-   Menambahkan validasi autentikasi di awal method
-   Return response JSON dengan status 401 jika user belum login
-   Menghapus logika session-based cart, sekarang hanya user-based
-   Menyertakan redirect URL dalam response error

#### Method `update()` dan `remove()`

-   Menambahkan validasi autentikasi
-   Memastikan user hanya bisa mengupdate/menghapus item mereka sendiri
-   Menggunakan `where('user_id', Auth::id())` untuk security

#### Method `clear()`

-   Hanya menghapus cart items milik user yang sedang login
-   Menambahkan validasi autentikasi

#### Method `index()`

-   Menampilkan halaman login requirement untuk guest users
-   Menggunakan flag `requireLogin` untuk view

#### Private Methods `getCartItems()` dan `getCartCount()`

-   Return empty collection/0 untuk guest users
-   Hanya mengambil data cart untuk authenticated users

### 3. View Updates (resources/views/products/index.blade.php)

#### Tombol Add to Cart

-   Menggunakan `@auth` directive untuk menampilkan tombol yang berbeda
-   Authenticated users: Tombol "Add to Cart" normal
-   Guest users: Tombol "Login untuk Menambah ke Keranjang" yang membuka modal

#### Modal Login

-   Menambahkan modal yang menjelaskan perlunya login
-   Menyediakan link ke halaman login dan register
-   Modal ditampilkan ketika guest user mencoba add to cart via JavaScript

#### JavaScript Updates

-   Menangani response 401 dari server
-   Menampilkan modal login untuk guest users
-   Menampilkan pesan error yang sesuai

### 4. Cart View Updates (resources/views/cart/index.blade.php)

-   Menambahkan kondisi untuk menampilkan pesan login requirement
-   Guest users akan melihat halaman yang meminta mereka untuk login
-   Menyediakan tombol login dan register

## Fitur Keamanan

### 1. Middleware Protection

-   Menggunakan `CustomerMiddleware` yang memastikan:
    -   User sudah login (bukan guest)
    -   User bukan admin (admin tidak bisa mengakses customer features)

### 2. Data Isolation

-   Setiap user hanya bisa melihat dan memodifikasi cart items mereka sendiri
-   Menggunakan `user_id` filter di semua query cart

### 3. Session Security

-   Menghilangkan session-based cart untuk menghindari session hijacking
-   Semua cart operations require authenticated user

## User Experience

### 1. Guest Users

-   Dapat melihat halaman produk
-   Tombol "Login untuk Menambah ke Keranjang" yang jelas
-   Modal informative saat mencoba add to cart
-   Easy access ke halaman login/register

### 2. Authenticated Users

-   Experience tetap sama seperti sebelumnya
-   Dapat menambah, update, dan hapus cart items
-   Cart count tetap ter-update real-time

### 3. Error Handling

-   Pesan error yang user-friendly
-   Toast notifications untuk feedback
-   Graceful handling untuk AJAX requests

## Testing

### Manual Testing Steps

1. **Guest User:**

    - Akses `/products`
    - Verify tombol menampilkan "Login untuk Menambah ke Keranjang"
    - Click tombol, verify modal muncul
    - Akses `/cart`, verify pesan login requirement

2. **Authenticated User:**

    - Login sebagai customer
    - Akses `/products`
    - Verify tombol "Add to Cart" normal
    - Test add, update, remove cart items
    - Verify cart count updates

3. **Admin User:**
    - Login sebagai admin
    - Akses `/cart/add` via direct request
    - Verify redirect ke admin dashboard

### API Testing

```bash
# Test add to cart without login
curl -X POST http://localhost:8001/cart/add \
  -H "Content-Type: application/json" \
  -d '{"product_id": 1, "quantity": 1}'

# Expected: 401 Unauthorized with redirect info
```

## Security Considerations

### 1. CSRF Protection

-   Semua cart operations menggunakan CSRF token
-   JavaScript menggunakan Laravel's built-in CSRF handling

### 2. Input Validation

-   Product ID dan quantity tetap divalidasi
-   Database constraints tetap ditegakkan

### 3. Authorization

-   User isolation menggunakan user_id
-   Middleware protection untuk semua protected routes

## Deployment Notes

### Database Migration

Tidak diperlukan migration tambahan karena:

-   Kolom `user_id` sudah ada di table carts
-   Kolom `session_id` tetap ada untuk kompatibilitas

### Configuration

Tidak ada perubahan konfigurasi khusus yang diperlukan.

### Rollback Plan

Jika perlu rollback:

1. Restore `routes/web.php` untuk menghapus middleware protection
2. Restore `CartController.php` ke versi sebelumnya
3. Restore view files ke versi sebelumnya

## Future Enhancements

### 1. Session Migration

-   Migrate cart items from session ke user account saat login
-   Merge session cart dengan user cart

### 2. Wishlist Feature

-   Implement wishlist untuk guest users
-   Convert wishlist to cart saat login

### 3. Cart Persistence

-   Auto-save cart periodically
-   Cart recovery setelah session timeout

### 4. Social Login

-   Integrate dengan Google/Facebook login
-   Seamless cart experience

## Kesimpulan

Implementasi ini berhasil menambahkan aturan login requirement untuk cart operations sambil mempertahankan user experience yang baik. Guest users mendapat guidance yang jelas untuk login, sementara authenticated users mendapat experience yang seamless.

Keamanan ditingkatkan dengan data isolation dan middleware protection, sementara kompatibilitas dengan existing data structure tetap terjaga.
