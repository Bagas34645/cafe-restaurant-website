# Shopping Cart & Payment System Setup Guide

Panduan setup dan testing untuk fitur shopping cart, checkout, dan integrasi pembayaran.

## Setup Development Environment

### 1. Clone & Install Dependencies

```bash
# Clone repository
git clone <repository-url>
cd cafe-restaurant-website

# Install PHP dependencies
composer install

# Install Node.js dependencies (if needed)
npm install
```

### 2. Environment Configuration

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Configure database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cafe-restaurant-website
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 3. Midtrans Configuration

Daftar akun di [Midtrans](https://midtrans.com) dan dapatkan credentials:

```env
# Midtrans Sandbox Configuration
MIDTRANS_SERVER_KEY=SB-Mid-server-xxxxxxxxxxxxxxxx
MIDTRANS_CLIENT_KEY=SB-Mid-client-xxxxxxxxxxxxxxxx
MIDTRANS_IS_PRODUCTION=false
MIDTRANS_IS_SANITIZED=true
MIDTRANS_IS_3DS=true
```

### 4. Database Setup

```bash
# Create database
mysql -u root -p
CREATE DATABASE cafe_restaurant_website;

# Run migrations
php artisan migrate

# Seed sample data (optional)
php artisan db:seed
```

### 5. Storage Setup

```bash
# Create storage link for public access
php artisan storage:link

# Set proper permissions
chmod -R 755 storage
chmod -R 755 bootstrap/cache
```

## Midtrans Integration Setup

### 1. Dashboard Configuration

1. Login ke [Midtrans Dashboard](https://dashboard.midtrans.com)
2. Pilih environment **Sandbox** untuk testing
3. Copy **Server Key** dan **Client Key**

### 1. Dashboard Configuration

1. Login ke [Midtrans Dashboard](https://dashboard.midtrans.com)
2. Pilih environment **Sandbox** untuk testing
3. Copy **Server Key** dan **Client Key**

### 2. Notification URL Handling

**Penting**: Midtrans Dashboard terbaru tidak memiliki field "Payment Notification URL" secara eksplisit. Notification akan handled secara otomatis melalui:

1. **Automatic Detection**: Midtrans akan mendeteksi notification endpoint dari domain yang sama
2. **Route tersedia**: `/payment/midtrans/notification` (sudah dibuat di kode)
3. **Programmatic Setup**: Notification URL di-set langsung dalam kode saat create transaction

### 3. Redirection Settings (Opsional)

Di Midtrans Dashboard, Anda bisa set:

-   **Finish URL**: `https://your-domain.com/payment/success`
-   **Error Payment URL**: `https://your-domain.com/payment/failed`

Atau biarkan kosong karena sudah di-handle dalam kode.

### 4. Testing Notification (Development)

Untuk testing di localhost, gunakan ngrok:

```bash
# Install ngrok
npm install -g ngrok

# Expose localhost
ngrok http 8000

# Gunakan URL ngrok sebagai base URL
# Contoh: https://abc123.ngrok.io/payment/midtrans/notification
```

### 2. Testing Credentials

Gunakan kartu kredit testing berikut:

-   **Card Number**: 4811 1111 1111 1114
-   **CVV**: 123
-   **Expiry**: 01/25

### 3. Bank Transfer Testing

-   **BCA VA**: 12345678901
-   **Mandiri**: 1234567890123
-   **BNI**: 1234567890

## Testing Guide

### 1. Shopping Cart Testing

#### Add to Cart

1. Buka halaman products: `http://localhost:8000/products`
2. Pilih produk yang available
3. Set quantity dan klik "Add to Cart"
4. Verify cart counter update di navbar
5. Check cart page: `http://localhost:8000/cart`

#### Cart Management

1. Update quantity menggunakan +/- buttons
2. Remove individual items
3. Clear entire cart
4. Verify calculations correct

### 2. Checkout Process Testing

#### Customer Information

1. Isi semua field yang required:
    - Nama lengkap
    - Email
    - No. telepon
    - Alamat lengkap

#### Payment Method Selection

1. Test Midtrans payment gateway
2. Test Cash on Delivery (COD)

### 3. Midtrans Payment Testing

#### Credit Card Payment

1. Pilih metode pembayaran "Payment Gateway"
2. Complete checkout form
3. Pada Midtrans popup, pilih "Credit Card"
4. Gunakan test card: 4811 1111 1111 1114
5. CVV: 123, Expiry: 01/25
6. Verify redirect ke success page

#### Bank Transfer Testing

1. Pilih "Bank Transfer" di Midtrans popup
2. Pilih bank (BCA, Mandiri, BNI, dll)
3. Copy virtual account number
4. Use Midtrans simulator untuk testing payment

#### E-Wallet Testing

1. Pilih e-wallet (GoPay, OVO, DANA)
2. Follow testing flow
3. Verify status updates

#### Payment Success/Failed Pages

1. Test success page: `http://localhost:8000/payment/success?order_id=ORD20250716001`
2. Test failed page: `http://localhost:8000/payment/failed?order_id=ORD20250716001`
3. Verify order details display correctly
4. Test redirect buttons functionality

### 4. COD Testing

1. Pilih "Cash on Delivery" di checkout
2. Complete order
3. Verify order status "processing"
4. Check admin panel untuk confirmation

### 5. Admin Panel Testing

#### Access Admin

1. Login: `http://localhost:8000/admin/login`
2. Default credentials (create admin user first):

```php
// Create admin user via tinker
php artisan tinker
$user = new App\Models\User();
$user->name = 'Admin';
$user->email = 'admin@example.com';
$user->password = bcrypt('password');
$user->is_admin = true;
$user->save();
```

#### Order Management

1. Navigate to "Order Management"
2. View orders list
3. Filter by status, payment method
4. Search by order number/customer
5. View order details
6. Update order status
7. Export orders to CSV

## API Testing with Postman

### 1. Cart API Endpoints

```
POST /cart/add
Content-Type: application/json
{
    "product_id": 1,
    "quantity": 2,
    "_token": "csrf_token"
}

GET /cart/count

PATCH /cart/{id}
{
    "quantity": 3,
    "_token": "csrf_token"
}

DELETE /cart/{id}
{
    "_token": "csrf_token"
}
```

### 2. Checkout API

```
POST /checkout
{
    "customer_name": "John Doe",
    "customer_email": "john@example.com",
    "customer_phone": "081234567890",
    "customer_address": "Jl. Example No. 123",
    "payment_method": "midtrans",
    "notes": "Please deliver quickly",
    "_token": "csrf_token"
}
```

### 3. Payment API Endpoints

```
GET /payment/midtrans/{orderId} - Create Midtrans payment
POST /payment/midtrans/notification - Webhook notification
GET /payment/success?order_id={orderNumber} - Payment success page
GET /payment/failed?order_id={orderNumber} - Payment failed page
GET /payment/midtrans/finish - Midtrans finish redirect
GET /payment/midtrans/unfinish - Midtrans unfinish redirect
GET /payment/midtrans/error - Midtrans error redirect
```

## Troubleshooting

### 1. Common Issues

#### Cart tidak update

-   Check CSRF token
-   Verify jQuery loaded
-   Check browser console for errors
-   Verify routes configured correctly

#### Midtrans payment gagal

-   Check server key dan client key
-   Verify notification URL accessible
-   Check Midtrans dashboard untuk error logs
-   Ensure SSL certificate valid (production)
-   Test redirect URLs (success/failed pages)

#### Redirect pages tidak muncul

-   Check routes untuk payment.success dan payment.failed
-   Verify view files exist di resources/views/payment/
-   Check controller methods success() dan failed()
-   Verify order parameter passed correctly

#### Order tidak terbuat

-   Check database connection
-   Verify foreign key constraints
-   Check validation errors
-   Review server logs

### 2. Debug Tools

#### Laravel Debug

```bash
# Enable debug mode
APP_DEBUG=true

# Check logs
tail -f storage/logs/laravel.log

# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
```

#### Database Debug

```bash
# Check migrations
php artisan migrate:status

# Reset database
php artisan migrate:fresh

# Check seeded data
php artisan tinker
>>> App\Models\Product::count()
>>> App\Models\Order::with('orderItems')->get()
```

### 3. Performance Optimization

#### Database Optimization

```php
// Add indexes untuk better performance
Schema::table('carts', function (Blueprint $table) {
    $table->index(['session_id', 'user_id']);
});

Schema::table('orders', function (Blueprint $table) {
    $table->index(['order_number', 'status']);
});
```

#### Caching

```php
// Cache cart count
Cache::remember("cart_count_{$sessionId}", 300, function() {
    return Cart::where('session_id', $sessionId)->sum('quantity');
});
```

## Production Deployment

### 1. Environment Configuration

```env
APP_ENV=production
APP_DEBUG=false
MIDTRANS_IS_PRODUCTION=true
```

### 2. Security Checklist

-   [ ] Update Midtrans keys untuk production
-   [ ] Set proper redirect URLs dengan HTTPS
-   [ ] Configure SSL certificate
-   [ ] Set proper file permissions
-   [ ] Enable CSRF protection
-   [ ] Configure rate limiting
-   [ ] Test notification webhook dengan proper domain
-   [ ] Verify redirect URLs accessibility

### 3. Performance Checklist

-   [ ] Enable caching (Redis/Memcached)
-   [ ] Optimize database queries
-   [ ] Configure CDN untuk static assets
-   [ ] Enable compression
-   [ ] Set up monitoring

## Monitoring & Analytics

### 1. Order Tracking

-   Monitor order conversion rates
-   Track payment method usage
-   Analyze cart abandonment

### 2. Error Monitoring

-   Set up error tracking (Sentry/Bugsnag)
-   Monitor Midtrans notification failures
-   Track API response times

### 3. Business Metrics

-   Daily/monthly revenue
-   Popular products
-   Customer behavior analysis

## Support & Maintenance

### 1. Regular Tasks

-   Monitor payment notifications
-   Check failed transactions
-   Update order statuses
-   Clean up abandoned carts

### 2. Updates

-   Keep Midtrans SDK updated
-   Monitor Laravel security updates
-   Review payment gateway changes

### 3. Backup Strategy

-   Regular database backups
-   Order data archival
-   Transaction logs retention
