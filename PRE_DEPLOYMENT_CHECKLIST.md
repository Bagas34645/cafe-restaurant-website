# Pre-Deployment Checklist

Checklist lengkap untuk memastikan aplikasi siap untuk production deployment.

## ✅ Code Quality & Cleanup

- [x] Hapus semua file debug dan testing dari root directory
- [x] Organisir dokumentasi ke folder `docs/`
- [x] Update README.md dengan informasi yang relevan
- [x] Hapus file demo dari public directory
- [x] Pastikan tidak ada `dd()`, `var_dump()`, atau `console.log()` di production code
- [x] Commit semua perubahan dengan pesan yang jelas

## ✅ Documentation

- [x] README.md updated dengan panduan instalasi
- [x] DEPLOYMENT.md dengan panduan lengkap VPS deployment
- [x] CONTRIBUTING.md dengan guidelines development
- [x] CHANGELOG.md untuk tracking perubahan
- [x] docs/README.md sebagai index dokumentasi

## 🔄 Configuration & Environment

- [ ] Setup .env untuk production dengan:
  - [ ] `APP_ENV=production`
  - [ ] `APP_DEBUG=false`
  - [ ] Database credentials yang benar
  - [ ] Mail configuration
  - [ ] Midtrans configuration (jika menggunakan payment)
- [ ] Generate application key: `php artisan key:generate`
- [ ] Pastikan APP_URL sesuai dengan domain production

## 🗄️ Database

- [ ] Backup database development jika diperlukan
- [ ] Test migration di environment staging: `php artisan migrate --force`
- [ ] Siapkan database seeder untuk production: `php artisan db:seed --force`
- [ ] Verifikasi koneksi database production

## 🔐 Security

- [ ] Pastikan storage dan cache directories writable (755/777)
- [ ] Setup SSL certificate untuk HTTPS
- [ ] Update security headers di web server
- [ ] Nonaktifkan directory listing di web server
- [ ] Pastikan .env tidak accessible dari web

## 📦 Dependencies & Build

- [ ] Install production dependencies: `composer install --optimize-autoloader --no-dev`
- [ ] Build assets: `npm run build`
- [ ] Cache configuration: `php artisan config:cache`
- [ ] Cache routes: `php artisan route:cache`
- [ ] Cache views: `php artisan view:cache`

## 🌐 Web Server

- [ ] Setup Apache/Nginx virtual host
- [ ] Configure document root ke `public/`
- [ ] Setup URL rewriting (.htaccess/nginx rules)
- [ ] Test web server configuration
- [ ] Setup logrotate untuk application logs

## 🔧 Laravel Specific

- [ ] Create storage symlink: `php artisan storage:link`
- [ ] Set proper file permissions:
  ```bash
  chown -R www-data:www-data /path/to/project
  chmod -R 755 /path/to/project
  chmod -R 777 storage bootstrap/cache
  ```
- [ ] Test queue workers jika menggunakan jobs
- [ ] Setup task scheduling jika menggunakan cron jobs

## 🧪 Testing

- [ ] Test basic functionality di staging environment
- [ ] Test form submissions (contact, reviews)
- [ ] Test file uploads (gallery, products)
- [ ] Test authentication (admin & customer)
- [ ] Test shopping cart dan checkout process
- [ ] Test responsive design di berbagai device

## 📊 Monitoring & Backup

- [ ] Setup application monitoring (logs, errors)
- [ ] Configure automatic database backup
- [ ] Setup file backup strategy
- [ ] Monitor disk space dan resource usage
- [ ] Test backup restoration process

## 🚀 Go-Live

- [ ] Final testing di production environment
- [ ] Update DNS records jika menggunakan domain baru
- [ ] Remove atau disable maintenance mode
- [ ] Verify all external integrations working
- [ ] Send test notifications (contact form, etc.)

## 📞 Post-Deployment

- [ ] Monitor error logs setelah go-live
- [ ] Test semua fitur customer-facing
- [ ] Verify admin panel functionality
- [ ] Check performance metrics
- [ ] Dokumentasikan access credentials untuk team

---

## Deployment Commands Summary

### Development to Production
```bash
# 1. Merge to main branch
./merge-to-main.sh

# 2. Push to remote repository
git push origin main

# 3. On production server
git clone/pull repository
composer install --optimize-autoloader --no-dev
npm install && npm run build
cp .env.example .env && nano .env
php artisan key:generate
php artisan migrate --force
php artisan db:seed --force
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 4. Set permissions
chown -R www-data:www-data /var/www/project
chmod -R 755 /var/www/project
chmod -R 777 storage bootstrap/cache
```

### Update Deployment
```bash
git pull origin main
composer install --optimize-autoloader --no-dev
npm install && npm run build
php artisan migrate --force
php artisan config:clear && php artisan config:cache
php artisan route:clear && php artisan route:cache
php artisan view:clear && php artisan view:cache
```

## 🆘 Emergency Contacts

- **Developer**: [Your contact info]
- **Server Admin**: [Server admin contact]
- **Database Admin**: [DB admin contact]

## 📋 Rollback Plan

Jika deployment gagal:
1. Restore database dari backup
2. Revert ke commit sebelumnya: `git revert HEAD`
3. Clear semua cache
4. Restart web server

---

**Note**: Centang setiap item sebelum melanjutkan ke step berikutnya. Deployment yang successful memerlukan perhatian detail pada setiap langkah.
