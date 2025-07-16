<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\Admin\OrderController;

use App\Http\Controllers\ContentController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews');
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Cart Routes
Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/add', [CartController::class, 'add'])->name('add');
    Route::patch('/{id}', [CartController::class, 'update'])->name('update');
    Route::delete('/{id}', [CartController::class, 'remove'])->name('remove');
    Route::delete('/', [CartController::class, 'clear'])->name('clear');
    Route::get('/count', [CartController::class, 'count'])->name('count');
});

// Checkout Routes
Route::prefix('checkout')->name('checkout.')->group(function () {
    Route::get('/', [CheckoutController::class, 'index'])->name('index');
    Route::post('/', [CheckoutController::class, 'store'])->name('store');
    Route::get('/success/{orderNumber}', [CheckoutController::class, 'success'])->name('success');
});

// Payment Routes
Route::prefix('payment')->name('payment.')->group(function () {
    Route::get('/midtrans/{orderId}', [PaymentController::class, 'midtrans'])->name('midtrans');
    Route::get('/midtrans/finish', [PaymentController::class, 'finish'])->name('midtrans.finish');
    Route::get('/midtrans/unfinish', [PaymentController::class, 'unfinish'])->name('midtrans.unfinish');
    Route::get('/midtrans/error', [PaymentController::class, 'error'])->name('midtrans.error');
    Route::get('/success', [PaymentController::class, 'success'])->name('success');
    Route::get('/failed', [PaymentController::class, 'failed'])->name('failed');
});

// Midtrans notification webhook (no CSRF protection needed)
Route::post('/payment/midtrans/notification', [PaymentController::class, 'notification'])->name('payment.midtrans.notification');

// Customer Authentication Routes
Route::get('/login', [CustomerAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [CustomerAuthController::class, 'login']);
Route::get('/register', [CustomerAuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [CustomerAuthController::class, 'register']);
Route::post('/logout', [CustomerAuthController::class, 'logout'])->name('logout');

// Customer Profile Routes (protected)
Route::middleware('customer')->group(function () {
    Route::get('/profile', [CustomerAuthController::class, 'profile'])->name('profile');
    Route::patch('/profile', [CustomerAuthController::class, 'updateProfile'])->name('profile.update');
    Route::get('/orders/history', [CustomerAuthController::class, 'orderHistory'])->name('orders.history');
});

// Admin Authentication Routes
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    // Gallery Management
    Route::get('galleries', [GalleryController::class, 'adminIndex'])->name('galleries.index');
    Route::resource('galleries', GalleryController::class)->except(['index']);

    // Product Management
    Route::get('products', [ProductController::class, 'adminIndex'])->name('products.index');
    Route::resource('products', ProductController::class)->except(['index']);

    // Review Management
    Route::get('reviews', [ReviewController::class, 'admin'])->name('reviews.index');
    Route::patch('reviews/{review}/approve', [ReviewController::class, 'approve'])->name('reviews.approve');
    Route::delete('reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

    // Contact Management
    Route::get('contacts', [ContactController::class, 'admin'])->name('contacts.index');
    Route::patch('contacts/{contact}/mark-read', [ContactController::class, 'markAsRead'])->name('contacts.mark-read');
    Route::delete('contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');

    // Order Management
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::patch('orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.update-status');
    Route::delete('orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
    Route::get('orders/export/csv', [OrderController::class, 'export'])->name('orders.export');

    // Content Management
    Route::resource('contents', ContentController::class);
});
