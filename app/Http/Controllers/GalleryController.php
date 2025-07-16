<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = Gallery::aktif()->urutkan()->paginate(12);
        return view('gallery.index', compact('galleries'));
    }

    /**
     * Display a listing of the resource for admin.
     */
    public function adminIndex()
    {
        $galleries = Gallery::latest()->paginate(10);
        return view('admin.galleries.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.galleries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|string|in:umum,durian,kebun,proses,fasilitas',
            'urutan' => 'nullable|integer|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'aktif' => 'nullable|boolean'
        ]);

        $imagePath = $request->file('image')->store('galleries', 'public');

        Gallery::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'path_gambar' => $imagePath,
            'kategori' => $request->kategori,
            'urutan' => $request->urutan ?? 0,
            'aktif' => $request->has('aktif') && $request->aktif
        ]);

        return redirect()->route('admin.galleries.index')->with('success', 'Item gallery berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        return view('admin.galleries.show', compact('gallery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        return view('admin.galleries.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $gallery)
    {
        Log::info('Gallery update started', [
            'gallery_id' => $gallery->id,
            'has_file' => $request->hasFile('image'),
            'request_data' => $request->except(['image'])
        ]);

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|string|in:umum,durian,kebun,proses,fasilitas',
            'urutan' => 'nullable|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'aktif' => 'nullable|boolean'
        ]);

        $data = [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
            'urutan' => $request->urutan ?? 0,
            'aktif' => $request->has('aktif') && $request->aktif
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            Log::info('Image file details', [
                'original_name' => $file->getClientOriginalName(),
                'mime_type' => $file->getMimeType(),
                'size' => $file->getSize(),
                'is_valid' => $file->isValid(),
                'error' => $file->getError()
            ]);

            // Validate image file again
            if (!$file->isValid()) {
                Log::error('Invalid image file', ['error' => $file->getError()]);
                return back()->withErrors(['image' => 'File gambar tidak valid atau rusak. Error: ' . $file->getError()]);
            }

            // Delete old image if exists
            if ($gallery->path_gambar && Storage::disk('public')->exists($gallery->path_gambar)) {
                Log::info('Deleting old image', ['path' => $gallery->path_gambar]);
                Storage::disk('public')->delete($gallery->path_gambar);
            }

            // Store new image
            try {
                $imagePath = $file->store('galleries', 'public');
                Log::info('New image stored', ['path' => $imagePath]);
                $data['path_gambar'] = $imagePath;
            } catch (\Exception $e) {
                Log::error('Failed to store image', ['error' => $e->getMessage()]);
                return back()->withErrors(['image' => 'Gagal mengupload gambar: ' . $e->getMessage()]);
            }
        }

        try {
            $gallery->update($data);
            Log::info('Gallery updated successfully', ['gallery_id' => $gallery->id]);
            return redirect()->route('admin.galleries.index')->with('success', 'Item gallery berhasil diperbarui!');
        } catch (\Exception $e) {
            Log::error('Failed to update gallery', ['error' => $e->getMessage()]);
            return back()->withErrors(['error' => 'Gagal memperbarui gallery: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        if ($gallery->path_gambar) {
            Storage::disk('public')->delete($gallery->path_gambar);
        }

        $gallery->delete();

        return redirect()->route('admin.galleries.index')->with('success', 'Item gallery berhasil dihapus!');
    }
}
