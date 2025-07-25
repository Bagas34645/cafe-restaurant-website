<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::where('is_available', true);

        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('description', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('category', 'LIKE', "%{$searchTerm}%");
            });
        }

        // Category filter
        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        $products = $query->latest()->paginate(12)->appends($request->query());
        $categories = Product::select('category')->distinct()->whereNotNull('category')->pluck('category');

        return view('products.index', compact('products', 'categories'));
    }

    /**
     * Display a listing of the resource for admin.
     */
    public function adminIndex()
    {
        $query = Product::query();
        // Search functionality for admin
        if (request()->filled('search')) {
            $searchTerm = request('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('description', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('category', 'LIKE', "%{$searchTerm}%");
            });
        }
        $products = $query->latest()->paginate(10)->appends(request()->query());
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Add logging for debugging
        \Log::info('Product store started', [
            'has_file' => $request->hasFile('image'),
            'request_data' => $request->except(['image'])
        ]);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_available' => 'sometimes|boolean'
        ]);

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category' => $request->category,
            'is_available' => (bool) $request->input('is_available', 0)
        ];

        if ($request->hasFile('image')) {
            try {
                // Create products directory if it doesn't exist
                $productsDir = storage_path('app/public/products');
                if (!file_exists($productsDir)) {
                    mkdir($productsDir, 0755, true);
                    \Log::info('Created products directory', ['path' => $productsDir]);
                }

                $data['image_path'] = $request->file('image')->store('products', 'public');
                \Log::info('Image stored successfully', ['path' => $data['image_path']]);
            } catch (\Exception $e) {
                \Log::error('Image upload failed during store', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);

                return redirect()->back()
                    ->withInput()
                    ->withErrors(['image' => 'Failed to upload image: ' . $e->getMessage()]);
            }
        }

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        // For admin, show admin view
        if (request()->is('admin/*')) {
            return view('admin.products.show', compact('product'));
        }

        // For public, show public product detail
        $relatedProducts = Product::where('is_available', true)
            ->where('category', $product->category)
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();

        // Load reviews with user information
        $product->load(['approvedReviews.user']);

        return view('products.show', compact('product', 'relatedProducts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // Add logging for debugging
        \Log::info('Product update started', [
            'product_id' => $product->id,
            'has_file' => $request->hasFile('image'),
            'request_data' => $request->except(['image'])
        ]);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_available' => 'sometimes|boolean'
        ]);

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock_quantity' => $request->stock,
            'category' => $request->category,
            'is_available' => (bool) $request->input('is_available', 0)
        ];

        if ($request->hasFile('image')) {
            // Log file details
            $file = $request->file('image');
            \Log::info('Image file details', [
                'original_name' => $file->getClientOriginalName(),
                'mime_type' => $file->getMimeType(),
                'size' => $file->getSize(),
                'is_valid' => $file->isValid(),
                'error' => $file->getError()
            ]);

            try {
                // Create products directory if it doesn't exist
                $productsDir = storage_path('app/public/products');
                if (!file_exists($productsDir)) {
                    mkdir($productsDir, 0755, true);
                    \Log::info('Created products directory', ['path' => $productsDir]);
                }

                // Delete old image
                if ($product->image_path) {
                    Storage::disk('public')->delete($product->image_path);
                    \Log::info('Deleted old image', ['path' => $product->image_path]);
                }

                // Store new image
                $imagePath = $request->file('image')->store('products', 'public');
                $data['image_path'] = $imagePath;

                \Log::info('New image stored', ['path' => $imagePath]);
            } catch (\Exception $e) {
                \Log::error('Image upload failed', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);

                return redirect()->back()
                    ->withInput()
                    ->withErrors(['image' => 'Failed to upload image: ' . $e->getMessage()]);
            }
        }

        $product->update($data);

        \Log::info('Product updated successfully', ['product_id' => $product->id]);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->image_path) {
            Storage::disk('public')->delete($product->image_path);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }

    /**
     * Search products via API for autocomplete/live search
     */
    public function search(Request $request)
    {
        $searchTerm = $request->get('q', '');

        if (strlen($searchTerm) < 2) {
            return response()->json(['suggestions' => []]);
        }

        $products = Product::where('is_available', true)
            ->where(function ($query) use ($searchTerm) {
                $query->where('name', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('description', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('category', 'LIKE', "%{$searchTerm}%");
            })
            ->select('id', 'name', 'category', 'price')
            ->limit(10)
            ->get();

        return response()->json([
            'suggestions' => $products->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'category' => $product->category,
                    'price' => 'Rp' . number_format($product->price, 0, ',', '.'),
                    'url' => route('products') . '?search=' . urlencode($product->name)
                ];
            })
        ]);
    }
}
