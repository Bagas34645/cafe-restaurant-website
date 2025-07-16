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
    public function index()
    {
        $products = Product::where('is_available', true)->latest()->paginate(12);
        $categories = Product::select('category')->distinct()->whereNotNull('category')->pluck('category');

        return view('products.index', compact('products', 'categories'));
    }

    /**
     * Display a listing of the resource for admin.
     */
    public function adminIndex()
    {
        $products = Product::latest()->paginate(10);
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
        return view('admin.products.show', compact('product'));
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
}
