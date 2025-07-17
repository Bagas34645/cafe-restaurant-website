<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Review;
use App\Models\Contact;
use App\Models\Content;
use App\Models\Order;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'galleries' => Gallery::count(),
            'products' => Product::count(),
            'pending_reviews' => Review::where('is_approved', false)->count(),
            'unread_contacts' => Contact::where('is_read', false)->count(),
            'contents' => Content::count(),
            'active_contents' => Content::where('is_active', true)->count(),
            'total_orders' => Order::count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'paid_orders' => Order::where('status', 'paid')->count(),
            'monthly_revenue' => Order::where('status', 'paid')
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->sum('total_amount'),
        ];

        $recentGalleries = Gallery::latest()->take(5)->get();
        $recentProducts = Product::latest()->take(5)->get();
        $pendingReviews = Review::where('is_approved', false)->latest()->take(5)->get();
        $unreadContacts = Contact::where('is_read', false)->latest()->take(5)->get();
        $recentContents = Content::latest()->take(5)->get();
        $recentOrders = Order::with('orderItems')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentGalleries', 'recentProducts', 'pendingReviews', 'unreadContacts', 'recentContents', 'recentOrders'));
    }
}
