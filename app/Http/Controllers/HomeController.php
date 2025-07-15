<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Review;
use App\Models\Content;

class HomeController extends Controller
{
    public function index()
    {
        $featuredGalleries = Gallery::aktif()->urutkan()->take(6)->get();
        $featuredProducts = Product::where('is_available', true)->take(8)->get();
        $approvedReviews = Review::where('is_approved', true)->take(6)->get();

        // Get home page content from CMS
        $homeContents = Content::active()->bySection('home')->orderBy('order')->get();

        return view('home', compact('featuredGalleries', 'featuredProducts', 'approvedReviews', 'homeContents'));
    }

    public function about()
    {
        // Get about page content from CMS
        $aboutContents = Content::active()->bySection('about')->orderBy('order')->get();

        return view('about', compact('aboutContents'));
    }
}
