<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ContentController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 15); // Default 15 items per page
        $perPage = in_array($perPage, [10, 15, 25, 50, 100]) ? $perPage : 15;

        $contents = Content::orderBy('section')->orderBy('order')->paginate($perPage);

        return view('admin.contents.index', compact('contents'));
    }

    public function create()
    {
        return view('admin.contents.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'key' => 'required|string|unique:contents,key',
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'type' => 'required|string|in:text,image,section,hero,feature',
            'section' => 'required|string|max:255',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
            'meta_data' => 'nullable|array'
        ]);

        $content = new Content();
        $content->key = $validated['key'];
        $content->title = $validated['title'] ?? null;
        $content->content = $validated['content'] ?? null;
        $content->type = $validated['type'];
        $content->section = $validated['section'];
        $content->order = $validated['order'] ?? 0;
        $content->is_active = $request->boolean('is_active', true);
        $content->meta_data = $validated['meta_data'] ?? null;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('contents', 'public');
            $content->image_path = $path;
        }

        $content->save();

        return redirect()->route('admin.contents.index')->with('success', 'Konten berhasil dibuat!');
    }

    public function show(Content $content)
    {
        return view('admin.contents.show', compact('content'));
    }

    public function edit(Content $content)
    {
        return view('admin.contents.edit', compact('content'));
    }

    public function update(Request $request, Content $content)
    {
        $validated = $request->validate([
            'key' => 'required|string|unique:contents,key,' . $content->id,
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'type' => 'required|string|in:text,image,section,hero,feature',
            'section' => 'required|string|max:255',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
            'meta_data' => 'nullable|array'
        ]);

        $content->key = $validated['key'];
        $content->title = $validated['title'] ?? null;
        $content->content = $validated['content'] ?? null;
        $content->type = $validated['type'];
        $content->section = $validated['section'];
        $content->order = $validated['order'] ?? 0;
        $content->is_active = $request->boolean('is_active', true);
        $content->meta_data = $validated['meta_data'] ?? null;

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($content->image_path) {
                Storage::disk('public')->delete($content->image_path);
            }
            $path = $request->file('image')->store('contents', 'public');
            $content->image_path = $path;
        }

        $content->save();

        return redirect()->route('admin.contents.index')->with('success', 'Konten berhasil diperbarui!');
    }

    public function destroy(Content $content)
    {
        // Delete image if exists
        if ($content->image_path) {
            Storage::disk('public')->delete($content->image_path);
        }

        $content->delete();

        return redirect()->route('admin.contents.index')->with('success', 'Konten berhasil dihapus!');
    }

    // Method untuk mendapatkan konten berdasarkan section (untuk API)
    public function getBySection($section)
    {
        $contents = Content::active()->bySection($section)->orderBy('order')->get();
        return response()->json($contents);
    }
}
