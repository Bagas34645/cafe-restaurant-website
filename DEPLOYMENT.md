# Panduan Deployment ke VPS

Panduan lengkap untuk deploy aplikasi Sentra Durian Tegal ke VPS production.

## 📋 Prerequisites VPS

### Server Requirements
- **OS**: Ubuntu 20.04 LTS atau lebih baru
- **PHP**: 8.2 atau lebih tinggi
- **Database**: MySQL 8.0 atau MariaDB 10.6+
- **Web Server**: Apache 2.4 atau Nginx
- **Memory**: Minimal 2GB RAM
- **Storage**: Minimal 20GB untuk aplikasi dan database

### Software yang Dibutuhkan
```bash
# Update system
sudo apt update && sudo apt upgrade -y

# Install PHP 8.2 dan ekstensi
sudo apt install php8.2 php8.2-fpm php8.2-mysql php8.2-mbstring php8.2-xml php8.2-bcmath php8.2-json php8.2-zip php8.2-curl php8.2-gd -y

# Install MySQL
sudo apt install mysql-server -y

# Install Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Install Node.js & NPM
curl -fsSL https://deb.nodesource.com/setup_18.x | sudo -E bash -
sudo apt-get install -y nodejs

# Install Git
sudo apt install git -y
```

## 🚀 Langkah Deployment

### 1. Setup Database

```bash
# Login ke MySQL
sudo mysql -u root -p

# Buat database dan user
CREATE DATABASE sentra_durian_tegal;
CREATE USER 'sentra_user'@'localhost' IDENTIFIED BY 'password_yang_kuat';
GRANT ALL PRIVILEGES ON sentra_durian_tegal.* TO 'sentra_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

### 2. Clone dan Setup Project

```bash
# Pindah ke direktori web
cd /var/www/

# Clone repository
sudo git clone https://github.com/Bagas34645/cafe-restaurant-website.git sentra-durian-tegal
cd sentra-durian-tegal

# Set ownership
sudo chown -R www-data:www-data /var/www/sentra-durian-tegal
sudo chmod -R 755 /var/www/sentra-durian-tegal
```

### 3. Install Dependencies

```bash
# Install PHP dependencies
composer install --optimize-autoloader --no-dev

# Install Node dependencies dan build assets
npm install
npm run build
```

### 4. Environment Configuration

```bash
# Copy environment file
cp .env.example .env

# Edit configuration
nano .env
```

**Konfigurasi `.env` untuk production:**
```env
APP_NAME="Sentra Durian Tegal"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://sentradurian.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sentra_durian_tegal
DB_USERNAME=sentra_user
DB_PASSWORD=password_yang_kuat

# Konfigurasi Mail untuk notifikasi
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@sentradurian.com
MAIL_FROM_NAME="${APP_NAME}"

# Midtrans Configuration (untuk payment)
MIDTRANS_MERCHANT_ID=your_merchant_id
MIDTRANS_CLIENT_KEY=your_client_key
MIDTRANS_SERVER_KEY=your_server_key
MIDTRANS_IS_PRODUCTION=true
MIDTRANS_IS_SANITIZED=true
MIDTRANS_IS_3DS=true
```

### 5. Generate Application Key dan Setup Database

```bash
# Generate application key
php artisan key:generate

# Run database migrations
php artisan migrate --force

# Seed database dengan data default
php artisan db:seed --force

# Create storage symlink
php artisan storage:link

# Cache configuration untuk performance
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 6. Set Permissions

```bash
# Set proper permissions
sudo chown -R www-data:www-data /var/www/sentra-durian-tegal
sudo chmod -R 755 /var/www/sentra-durian-tegal
sudo chmod -R 777 /var/www/sentra-durian-tegal/storage
sudo chmod -R 777 /var/www/sentra-durian-tegal/bootstrap/cache
```

### 7. Web Server Configuration

#### Apache Configuration

```bash
# Buat virtual host
sudo nano /etc/apache2/sites-available/sentra-durian-tegal.conf
```

**Content file:**
```apache
<VirtualHost *:80>
    ServerName sentradurian.com
    ServerAlias www.sentradurian.com
    DocumentRoot /var/www/sentra-durian-tegal/public

    <Directory /var/www/sentra-durian-tegal/public>
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/sentra-durian-error.log
    CustomLog ${APACHE_LOG_DIR}/sentra-durian-access.log combined
</VirtualHost>
```

```bash
# Enable site dan module
sudo a2ensite sentra-durian-tegal.conf
sudo a2enmod rewrite
sudo systemctl restart apache2
```

#### Nginx Configuration (Alternative)

```bash
# Buat server block
sudo nano /etc/nginx/sites-available/sentra-durian-tegal
```

**Content file:**
```nginx
server {
    listen 80;
    server_name sentradurian.com www.sentradurian.com;
    root /var/www/sentra-durian-tegal/public;

    index index.php index.html index.htm;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
    }

    location ~ /\.ht {
        deny all;
    }
}
```

```bash
# Enable site
sudo ln -s /etc/nginx/sites-available/sentra-durian-tegal /etc/nginx/sites-enabled/
sudo systemctl restart nginx
```

### 8. SSL Certificate (Opsional tapi Direkomendasikan)

```bash
# Install Certbot
sudo apt install certbot python3-certbot-apache -y

# Atau untuk Nginx
sudo apt install certbot python3-certbot-nginx -y

# Generate SSL certificate
sudo certbot --apache -d sentradurian.com -d www.sentradurian.com

# Atau untuk Nginx
sudo certbot --nginx -d sentradurian.com -d www.sentradurian.com
```

## 🔄 Update Deployment

### Script Auto-Deploy

Buat script untuk update otomatis:

```bash
# Buat file deploy script
sudo nano /var/www/sentra-durian-tegal/deploy.sh
```

**Content script:**
```bash
#!/bin/bash

# Masuk ke direktori project
cd /var/www/sentra-durian-tegal

# Backup database
mysqldump -u sentra_user -p sentra_durian_tegal > backup_$(date +%Y%m%d_%H%M%S).sql

# Pull perubahan dari Git
git pull origin main

# Install/update dependencies
composer install --optimize-autoloader --no-dev
npm install
npm run build

# Database migration
php artisan migrate --force

# Clear dan rebuild cache
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

php artisan config:cache
php artisan route:cache
php artisan view:cache

# Set permissions
chown -R www-data:www-data /var/www/sentra-durian-tegal
chmod -R 755 /var/www/sentra-durian-tegal
chmod -R 777 /var/www/sentra-durian-tegal/storage
chmod -R 777 /var/www/sentra-durian-tegal/bootstrap/cache

echo "Deployment selesai!"
```

```bash
# Make executable
sudo chmod +x /var/www/sentra-durian-tegal/deploy.sh
```

## 🔍 Monitoring & Maintenance

### Log Monitoring
```bash
# Check Laravel logs
tail -f /var/www/sentra-durian-tegal/storage/logs/laravel.log

# Check Apache logs
tail -f /var/log/apache2/sentra-durian-error.log

# Check Nginx logs
tail -f /var/log/nginx/error.log
```

### Performance Optimization
```bash
# Enable OPcache untuk PHP
sudo nano /etc/php/8.2/apache2/php.ini

# Tambahkan/edit:
opcache.enable=1
opcache.memory_consumption=128
opcache.max_accelerated_files=4000
opcache.revalidate_freq=60

# Restart web server
sudo systemctl restart apache2
```

### Backup Database
```bash
# Setup cron job untuk backup harian
sudo crontab -e

# Tambahkan line:
0 2 * * * mysqldump -u sentra_user -p'password' sentra_durian_tegal > /var/backups/sentra_durian_$(date +\%Y\%m\%d).sql
```

## 🚨 Troubleshooting

### Common Issues

1. **Permission denied errors**
   ```bash
   sudo chown -R www-data:www-data /var/www/sentra-durian-tegal
   sudo chmod -R 755 /var/www/sentra-durian-tegal
   sudo chmod -R 777 storage bootstrap/cache
   ```

2. **Database connection failed**
   - Check `.env` configuration
   - Verify MySQL service: `sudo systemctl status mysql`
   - Check database credentials

3. **Images not loading**
   ```bash
   php artisan storage:link
   sudo chmod -R 755 public/storage
   ```

4. **500 Internal Server Error**
   ```bash
   php artisan config:clear
   php artisan cache:clear
   tail -f storage/logs/laravel.log
   ```

## 📞 Support

Jika mengalami masalah saat deployment, periksa:
1. Server logs untuk error messages
2. Laravel logs di `storage/logs/laravel.log`
3. File permissions pada direktori storage dan bootstrap/cache
4. Konfigurasi web server (Apache/Nginx)
5. Database connection dan credentials
