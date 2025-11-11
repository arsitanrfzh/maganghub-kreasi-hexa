<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        // 1. Ambil semua data kategori, urutkan dari yg terbaru
        $categories = Category::latest()->get();

        // 2. Kirim data ke view
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories',
        ]);

        // 2. Buat slug
        $validated['slug'] = Str::slug($validated['name']);

        // 3. Simpan ke database
        Category::create($validated);

        // 4. Redirect kembali ke halaman index
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        // Kirim data kategori yang mau diedit ke view
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        // 1. Validasi (mirip store, tapi 'unique' diabaikan untuk record yg sedang diedit)
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);

        // 2. Buat slug baru
        $validated['slug'] = Str::slug($validated['name']);

        // 3. Update data di database
        $category->update($validated);

        // 4. Redirect
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // 1. Hapus data dari database
        $category->delete();

        // 2. Redirect kembali ke halaman index
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus!');
    }
}
