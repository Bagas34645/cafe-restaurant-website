# 🌿 Quick Start Guide - Tema Hijau Alam

## Aktivasi Tema Baru

### 1. ✅ File yang Sudah Diupdate

Tema hijau alam sudah diimplementasikan pada file-file berikut:

-   ✅ `/public/css/eco-nature-theme.css` - Tema CSS utama
-   ✅ `/resources/views/layouts/app.blade.php` - Layout website utama
-   ✅ `/resources/views/layouts/admin.blade.php` - Layout admin panel
-   ✅ `/resources/views/admin/auth/login.blade.php` - Halaman login admin

### 2. 🎨 Skema Warna

| Element         | Warna Lama              | Warna Baru               | Penggunaan           |
| --------------- | ----------------------- | ------------------------ | -------------------- |
| Primary Button  | `#e74c3c` (Merah)       | `#2FA365` (Hijau)        | Tombol utama, link   |
| Hover State     | `#c0392b` (Merah Gelap) | `#1C5B40` (Hijau Gelap)  | Hover button, footer |
| Background Card | `#f8f9fa` (Abu-abu)     | `#DFF5EA` (Hijau Muda)   | Background kartu     |
| Navbar          | `bg-dark`               | `#1C5B40` (Hijau Gelap)  | Navigation bar       |
| Text Secondary  | `#6c757d`               | `#9FA8A3` (Gray Natural) | Label, teks sekunder |

### 3. 🚀 Cara Menjalankan

```bash
# 1. Pastikan berada di directory project
cd /path/to/cafe-restaurant-website

# 2. Jalankan server Laravel
php artisan serve

# 3. Buka browser ke http://localhost:8000
```

### 4. 🔍 Preview Halaman yang Terpengaruh

-   **Homepage** - Hero section dengan overlay hijau, button primary hijau
-   **Products** - Card background hijau muda, pagination hijau
-   **Gallery** - Grid layout dengan accent hijau
-   **Contact** - Form dengan focus color hijau
-   **Admin Panel** - Sidebar hijau gelap, dashboard dengan accent hijau
-   **Login Admin** - Background gradient hijau

### 5. 🎯 Fitur Utama Tema Baru

-   **Navbar**: Background hijau gelap (`#1C5B40`) dengan hover light green
-   **Buttons**: Primary green (`#2FA365`) dengan hover dark green (`#1C5B40`)
-   **Cards**: Background light green (`#DFF5EA`) dengan border halus
-   **Footer**: Gradient hijau dengan teks putih
-   **Hero Section**: Overlay gradient hijau untuk natural look
-   **Admin Panel**: Sidebar hijau dengan accent consistent
-   **Forms**: Focus state dengan border dan shadow hijau

### 6. 📱 Responsive Design

-   ✅ Mobile responsive tetap terjaga
-   ✅ Tablet layout optimal
-   ✅ Desktop full experience
-   ✅ Touch-friendly untuk mobile devices

### 7. 🛠 Customization

Untuk mengubah warna, edit variabel CSS di `/public/css/eco-nature-theme.css`:

```css
:root {
    --eco-primary: #2fa365; /* Ubah warna primary */
    --eco-secondary: #1c5b40; /* Ubah warna secondary */
    --eco-background-light: #dff5ea; /* Ubah background ringan */
    /* ... variabel lainnya */
}
```

### 8. 🔧 Troubleshooting

**Jika tema tidak muncul:**

1. Clear browser cache (Ctrl+F5)
2. Pastikan file CSS ada di `/public/css/eco-nature-theme.css`
3. Check console browser untuk error loading CSS

**Jika warna tidak sesuai:**

1. Periksa variabel CSS di file eco-nature-theme.css
2. Pastikan tidak ada CSS override di file lain
3. Check specificity CSS

### 9. 🌟 Manfaat Tema Baru

-   **Brand Image**: Lebih sesuai dengan produk durian yang natural
-   **User Experience**: Warna hijau lebih menenangkan mata
-   **Modern Look**: Tampilan contemporary dan profesional
-   **Eco-Friendly**: Mendukung image ramah lingkungan
-   **Accessibility**: Kontras warna yang baik untuk readability

### 10. 💡 Tips Penggunaan

-   Gunakan `btn-primary` untuk aksi utama (akan otomatis hijau)
-   Gunakan `bg-light` untuk background section (akan otomatis light green)
-   Untuk text secondary gunakan class `text-muted` (akan otomatis gray natural)
-   Badge dan notifikasi gunakan `bg-info` untuk accent aqua

---

**🎉 Tema hijau alam siap digunakan!**

_Untuk pertanyaan atau customization lebih lanjut, check dokumentasi lengkap di `TEMA_HIJAU_ALAM_IMPLEMENTASI.md`_
