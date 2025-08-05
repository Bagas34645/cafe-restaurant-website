<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Review;
use App\Models\Contact;
use App\Models\Content;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use App\Models\Visitor;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        // Data untuk grafik pengunjung 30 hari terakhir
        $days = collect(range(0, 29))->map(function ($i) {
            return now()->subDays(29 - $i)->format('Y-m-d');
        });
        $visitorCounts = DB::table('visitors')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->where('created_at', '>=', now()->subDays(29)->startOfDay())
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count', 'date');

        $visitorChart = [
            'labels' => $days->map(fn($d) => date('d M', strtotime($d)))->toArray(),
            'data' => $days->map(fn($d) => $visitorCounts[$d] ?? 0)->toArray(),
        ];

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
            // Statistik pengunjung
            'visitors_total' => Visitor::count(),
            'visitors_today' => Visitor::whereDate('created_at', Carbon::today())->count(),
            'visitors_week' => Visitor::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count(),
            'visitors_month' => Visitor::whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->count(),
        ];

        $recentGalleries = Gallery::latest()->take(5)->get();
        $recentProducts = Product::latest()->take(5)->get();
        $pendingReviews = Review::where('is_approved', false)->latest()->take(5)->get();
        $unreadContacts = Contact::where('is_read', false)->latest()->take(5)->get();
        $recentContents = Content::latest()->take(5)->get();
        $recentOrders = Order::with('orderItems')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentGalleries', 'recentProducts', 'pendingReviews', 'unreadContacts', 'recentContents', 'recentOrders', 'visitorChart'));
    }
}
