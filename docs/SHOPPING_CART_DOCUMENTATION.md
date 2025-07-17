# Shopping Cart, Checkout & Payment Integration Documentation

Dokumentasi implementasi fitur shopping cart, checkout, dan integrasi pembayaran dengan Midtrans serta Cash on Delivery untuk website Cafe Restaurant.

## Fitur yang Telah Diimplementasi

### 1. Shopping Cart System

-   ✅ **Add to Cart**: Menambahkan produk ke keranjang belanja
-   ✅ **View Cart**: Melihat semua item dalam keranjang
-   ✅ **Update Quantity**: Mengubah jumlah item dalam keranjang
-   ✅ **Remove Item**: Menghapus item dari keranjang
-   ✅ **Clear Cart**: Mengosongkan seluruh keranjang
-   ✅ **Cart Counter**: Badge counter di navbar yang menampilkan jumlah item
-   ✅ **Session-based Cart**: Keranjang tersimpan dalam session untuk guest users
-   ✅ **User-based Cart**: Keranjang tersimpan untuk user yang login

### 2. Checkout System

-   ✅ **Customer Information Form**: Form untuk data pelanggan
-   ✅ **Order Summary**: Ringkasan pesanan sebelum checkout
-   ✅ **Payment Method Selection**: Pilihan metode pembayaran
-   ✅ **Order Notes**: Catatan tambahan untuk pesanan
-   ✅ **Order Creation**: Pembuatan pesanan dengan nomor unik
-   ✅ **Order Items**: Detail item pesanan tersimpan

### 3. Payment Integration

#### Midtrans Payment Gateway

-   ✅ **Snap Integration**: Menggunakan Midtrans Snap untuk payment
-   ✅ **Multiple Payment Methods**:
    -   Transfer Bank (BCA, Mandiri, BNI, BRI, dll)
    -   E-Wallet (GoPay, OVO, DANA, LinkAja)
    -   Kartu Kredit/Debit
    -   Convenience Store (Alfamart/Indomaret)
-   ✅ **Payment Notification**: Webhook untuk update status pembayaran
-   ✅ **Transaction Status Handling**: Handle berbagai status transaksi
-   ✅ **Redirect Handling**: Handle finish, unfinish, dan error pages

#### Cash on Delivery (COD)

-   ✅ **COD Option**: Opsi pembayaran tunai saat barang sampai
-   ✅ **Order Processing**: Pesanan COD langsung berstatus "processing"
-   ✅ **Manual Confirmation**: Admin dapat konfirmasi pesanan COD

### 4. Order Management (Admin)

-   ✅ **Order List**: Daftar semua pesanan dengan filter
-   ✅ **Order Details**: Detail lengkap pesanan
-   ✅ **Status Management**: Update status pesanan
-   ✅ **Search & Filter**: Pencarian berdasarkan nomor pesanan, nama, email
-   ✅ **Export Orders**: Export data pesanan ke CSV
-   ✅ **Quick Actions**: Aksi cepat untuk konfirmasi, pengiriman, dll
-   ✅ **Customer Contact**: Link langsung untuk email/telepon customer

## Database Structure

### Tables Created

1. **carts**
    - id, session_id, user_id, product_id, quantity, price, timestamps
2. **orders**
    - id, order_number, customer_name, customer_email, customer_phone
    - customer_address, total_amount, payment_method, status
    - midtrans_transaction_id, midtrans_status, notes, paid_at, timestamps
3. **order_items**
    - id, order_id, product_id, product_name, product_price
    - quantity, subtotal, timestamps

## Configuration

### Environment Variables (.env)

```env
# Midtrans Configuration
MIDTRANS_SERVER_KEY=your_server_key_here
MIDTRANS_CLIENT_KEY=your_client_key_here
MIDTRANS_IS_PRODUCTION=false
MIDTRANS_IS_SANITIZED=true
MIDTRANS_IS_3DS=true
```

### Services Configuration (config/services.php)

```php
'midtrans' => [
    'server_key' => env('MIDTRANS_SERVER_KEY'),
    'client_key' => env('MIDTRANS_CLIENT_KEY'),
    'is_production' => env('MIDTRANS_IS_PRODUCTION', false),
    'is_sanitized' => env('MIDTRANS_IS_SANITIZED', true),
    'is_3ds' => env('MIDTRANS_IS_3DS', true),
],
```

## Routes Structure

### Public Routes

-   `GET /cart` - View shopping cart
-   `POST /cart/add` - Add item to cart
-   `PATCH /cart/{id}` - Update cart item quantity
-   `DELETE /cart/{id}` - Remove cart item
-   `DELETE /cart` - Clear cart
-   `GET /cart/count` - Get cart items count

### Checkout Routes

-   `GET /checkout` - Checkout form
-   `POST /checkout` - Process checkout
-   `GET /checkout/success/{orderNumber}` - Success page

### Payment Routes

-   `GET /payment/midtrans/{orderId}` - Midtrans payment page
-   `POST /payment/midtrans/notification` - Midtrans webhook
-   `GET /payment/midtrans/finish` - Payment success redirect
-   `GET /payment/midtrans/unfinish` - Payment pending redirect
-   `GET /payment/midtrans/error` - Payment error redirect

### Admin Routes

-   `GET /admin/orders` - Order list
-   `GET /admin/orders/{order}` - Order details
-   `PATCH /admin/orders/{order}/status` - Update order status
-   `DELETE /admin/orders/{order}` - Delete order
-   `GET /admin/orders/export/csv` - Export orders

## Key Features Implementation

### 1. Add to Cart Functionality

```javascript
// Products page - Add to cart button with quantity selector
$(".add-to-cart-btn").click(function () {
    let productId = $(this).data("product-id");
    let quantity = $(this).closest(".card-body").find(".quantity-input").val();

    $.ajax({
        url: "/cart/add",
        method: "POST",
        data: { product_id: productId, quantity: quantity, _token: csrf_token },
        success: function (response) {
            // Update cart counter and show success message
        },
    });
});
```

### 2. Order Number Generation

```php
// Automatic order number generation with format: ORD{YYYYMMDD}{0001}
public static function generateOrderNumber()
{
    $prefix = 'ORD';
    $date = now()->format('Ymd');
    $lastOrder = self::whereDate('created_at', today())
        ->orderBy('id', 'desc')->first();

    $sequence = $lastOrder ? intval(substr($lastOrder->order_number, -4)) + 1 : 1;

    return $prefix . $date . str_pad($sequence, 4, '0', STR_PAD_LEFT);
}
```

### 3. Midtrans Integration

```php
// Payment processing with Midtrans Snap
$transactionData = [
    'transaction_details' => [
        'order_id' => $order->order_number,
        'gross_amount' => (int) $order->total_amount
    ],
    'item_details' => $itemDetails,
    'customer_details' => $customerDetails
];

$snapToken = Snap::getSnapToken($transactionData);
```

## User Interface

### 1. Product Listing

-   Add to cart button dengan quantity selector
-   Stock availability indicator
-   Real-time cart counter update

### 2. Shopping Cart

-   Item list dengan foto produk
-   Quantity controls (+/- buttons)
-   Real-time subtotal calculation
-   Remove item functionality
-   Order summary dengan total

### 3. Checkout Form

-   Customer information form
-   Payment method selection (visual cards)
-   Order summary sidebar
-   Form validation

### 4. Admin Dashboard

-   Order statistics cards
-   Recent orders list
-   Revenue tracking
-   Quick status updates

## Security Features

### 1. CSRF Protection

-   All forms protected dengan CSRF tokens
-   Midtrans notification webhook excluded dari CSRF

### 2. Input Validation

-   Server-side validation untuk semua form inputs
-   Client-side validation untuk user experience

### 3. Order Security

-   Order numbers unique dan tidak mudah ditebak
-   Status validation sebelum payment processing

## Testing Checklist

### Cart Functionality

-   [ ] Add item to cart
-   [ ] Update item quantity
-   [ ] Remove item from cart
-   [ ] Clear entire cart
-   [ ] Cart persistence across sessions

### Checkout Process

-   [ ] Fill customer information
-   [ ] Select payment method
-   [ ] Create order successfully
-   [ ] Receive order confirmation

### Payment Testing

-   [ ] Midtrans sandbox payment
-   [ ] COD order creation
-   [ ] Payment notification handling
-   [ ] Status updates

### Admin Features

-   [ ] View orders list
-   [ ] Filter and search orders
-   [ ] Update order status
-   [ ] Export orders data

## Deployment Notes

1. **Midtrans Configuration**

    - Update server/client keys untuk production
    - Set `MIDTRANS_IS_PRODUCTION=true` untuk live environment

2. **Webhook URL**

    - Set notification URL di Midtrans dashboard: `{your-domain}/payment/midtrans/notification`

3. **File Permissions**

    - Ensure storage direktori writable untuk uploaded images

4. **Database**
    - Run migrations: `php artisan migrate`
    - Seed sample data jika diperlukan

## Future Enhancements

1. **Email Notifications**

    - Order confirmation emails
    - Status update notifications

2. **Inventory Management**

    - Stock tracking
    - Low stock alerts

3. **Advanced Features**

    - Promo codes/discounts
    - Shipping cost calculation
    - Multiple delivery addresses

4. **Analytics**
    - Sales reports
    - Customer analytics
    - Product performance tracking
