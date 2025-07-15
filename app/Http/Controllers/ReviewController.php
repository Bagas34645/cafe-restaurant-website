<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource for public view.
     */
    public function index()
    {
        $reviews = Review::where('is_approved', true)->latest()->paginate(10);
        return view('reviews.index', compact('reviews'));
    }

    /**
     * Display reviews for admin management.
     */
    public function admin()
    {
        $reviews = Review::latest()->paginate(10);
        return view('admin.reviews.index', compact('reviews'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        Review::create([
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'is_approved' => false
        ]);

        return redirect()->route('reviews')->with('success', 'Terima kasih atas ulasan Anda! Ulasan akan dipublikasikan setelah disetujui.');
    }

    /**
     * Approve a review.
     */
    public function approve(Review $review)
    {
        $review->update(['is_approved' => !$review->is_approved]);

        $status = $review->is_approved ? 'approved' : 'unapproved';
        return redirect()->route('admin.reviews.index')->with('success', "Review has been {$status}!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        $review->delete();
        return redirect()->route('admin.reviews.index')->with('success', 'Review deleted successfully!');
    }
}
