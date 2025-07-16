<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = $this->getCartItems();
        $total = $cartItems->sum('subtotal');

        // Show login prompt for guest users
        if (!Auth::check()) {
            return view('cart.index', [
                'cartItems' => collect(),
                'total' => 0,
                'requireLogin' => true
            ]);
        }

        return view('cart.index', compact('cartItems', 'total'));
    }

    public function add(Request $request)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Silakan login terlebih dahulu untuk menambahkan produk ke keranjang',
                'redirect' => route('login')
            ], 401);
        }

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);

        if (!$product->is_available) {
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak tersedia'
            ]);
        }

        $userId = Auth::id();

        // Check if item already exists in cart
        $existingItem = Cart::where('product_id', $request->product_id)
            ->where('user_id', $userId)
            ->first();

        if ($existingItem) {
            $existingItem->update([
                'quantity' => $existingItem->quantity + $request->quantity
            ]);
        } else {
            Cart::create([
                'session_id' => null, // Always null for authenticated users
                'user_id' => $userId,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'price' => $product->price
            ]);
        }

        $cartCount = $this->getCartCount();

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil ditambahkan ke keranjang',
            'cart_count' => $cartCount
        ]);
    }

    public function update(Request $request, $id)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Silakan login terlebih dahulu'
            ], 401);
        }

        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem = Cart::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $cartItem->update(['quantity' => $request->quantity]);

        return response()->json([
            'success' => true,
            'message' => 'Keranjang berhasil diperbarui',
            'subtotal' => $cartItem->subtotal,
            'total' => $this->getCartItems()->sum('subtotal')
        ]);
    }

    public function remove($id)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Silakan login terlebih dahulu'
            ], 401);
        }

        $cartItem = Cart::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $cartItem->delete();

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil dihapus dari keranjang',
            'cart_count' => $this->getCartCount()
        ]);
    }

    public function clear()
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Silakan login terlebih dahulu'
            ], 401);
        }

        Cart::where('user_id', Auth::id())->delete();

        return response()->json([
            'success' => true,
            'message' => 'Keranjang berhasil dikosongkan'
        ]);
    }

    public function count()
    {
        return response()->json([
            'count' => $this->getCartCount()
        ]);
    }

    private function getCartItems()
    {
        if (!Auth::check()) {
            return collect(); // Return empty collection for guest users
        }

        return Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();
    }

    private function getCartCount()
    {
        if (!Auth::check()) {
            return 0; // Return 0 for guest users
        }

        return Cart::where('user_id', Auth::id())
            ->sum('quantity');
    }
}
