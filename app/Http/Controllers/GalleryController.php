<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'aktif' => 'boolean'
        ]);

        $imagePath = $request->file('image')->store('galleries', 'public');

        Gallery::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'path_gambar' => $imagePath,
            'kategori' => $request->kategori,
            'urutan' => $request->urutan ?? 0,
            'aktif' => $request->has('aktif')
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
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|string|in:umum,durian,kebun,proses,fasilitas',
            'urutan' => 'nullable|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'aktif' => 'boolean'
        ]);

        $data = [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
            'urutan' => $request->urutan ?? 0,
            'aktif' => $request->has('aktif')
        ];

        if ($request->hasFile('image')) {
            // Delete old image
            if ($gallery->path_gambar) {
                Storage::disk('public')->delete($gallery->path_gambar);
            }

            $data['path_gambar'] = $request->file('image')->store('galleries', 'public');
        }

        $gallery->update($data);

        return redirect()->route('admin.galleries.index')->with('success', 'Item gallery berhasil diperbarui!');
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
