<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Review;
use App\Models\Contact;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'galleries' => Gallery::count(),
            'products' => Product::count(),
            'pending_reviews' => Review::where('is_approved', false)->count(),
            'unread_contacts' => Contact::where('is_read', false)->count(),
        ];

        $recentGalleries = Gallery::latest()->take(5)->get();
        $recentProducts = Product::latest()->take(5)->get();
        $pendingReviews = Review::where('is_approved', false)->latest()->take(5)->get();
        $unreadContacts = Contact::where('is_read', false)->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentGalleries', 'recentProducts', 'pendingReviews', 'unreadContacts'));
    }
}
