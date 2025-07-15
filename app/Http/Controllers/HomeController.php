<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Review;

class HomeController extends Controller
{
    public function index()
    {
        $featuredGalleries = Gallery::where('is_active', true)->take(6)->get();
        $featuredProducts = Product::where('is_available', true)->take(8)->get();
        $approvedReviews = Review::where('is_approved', true)->take(6)->get();

        return view('home', compact('featuredGalleries', 'featuredProducts', 'approvedReviews'));
    }

    public function about()
    {
        return view('about');
    }
}
