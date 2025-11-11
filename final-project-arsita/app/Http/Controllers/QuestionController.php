<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Question;


class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil semua kategori untuk ditampilkan di dropdown
        $categories = Category::all();

        // Kirim data kategori ke view
        return view('questions.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id', // Pastikan kategori ada di tabel
            'body' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Opsional, maks 2MB
        ]);

        // 2. Handle upload gambar (jika ada)
        $imagePath = null;
        if ($request->hasFile('image')) {
            // Simpan gambar ke folder 'public/images/questions'
            // 'store' akan membuat nama file acak yg unik
            $imagePath = $request->file('image')->store('images/questions', 'public');
        }

        // 3. Simpan data ke database
        Question::create([
            'title' => $validated['title'],
            'category_id' => $validated['category_id'],
            'body' => $validated['body'],
            'image' => $imagePath, // Simpan path gambar (atau null jika tidak ada)
            'user_id' => Auth::id(), // Ambil ID user yang sedang login
        ]);

        // 4. Redirect ke halaman (misal, ke dashboard)
        // Nanti kita akan ganti ini ke halaman index questions
        return redirect()->route('dashboard')->with('success', 'Pertanyaan berhasil dipublikasikan!');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
