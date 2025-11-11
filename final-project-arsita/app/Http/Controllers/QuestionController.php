<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Question;


class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua pertanyaan, urutkan dari yg terbaru
        $questions = Question::with('user', 'category')->latest()->get();

        return view('questions.index', compact('questions'));
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
    public function show(Question $question)
    {
        return view('questions.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        // Cek apakah user yg login adalah pemilik pertanyaan
        if (Auth::id() !== $question->user_id) {
            abort(403, 'ANDA TIDAK PUNYA HAK AKSES');
        }

        // Ambil kategori untuk dropdown
        $categories = Category::all();

        return view('questions.edit', compact('question', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question)
    {
        // Cek apakah user yg login adalah pemilik pertanyaan
        if (Auth::id() !== $question->user_id) {
            abort(403, 'ANDA TIDAK PUNYA HAK AKSES');
        }

        // 1. Validasi data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'body' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $question->image; // Ambil path gambar lama

        // 2. Handle upload gambar BARU (jika ada)
        if ($request->hasFile('image')) {
            // Hapus gambar LAMA dari storage (jika ada)
            if ($question->image) {
                Storage::delete('public/' . $question->image);
            }

            // Simpan gambar BARU
            $imagePath = $request->file('image')->store('images/questions', 'public');
        }

        // 3. Update data di database
        $question->update([
            'title' => $validated['title'],
            'category_id' => $validated['category_id'],
            'body' => $validated['body'],
            'image' => $imagePath,
        ]);

        // 4. Redirect kembali ke halaman detail
        return redirect()->route('questions.show', $question->id)->with('success', 'Pertanyaan berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        // Cek apakah user yg login adalah pemilik pertanyaan
        if (Auth::id() !== $question->user_id) {
            abort(403, 'ANDA TIDAK PUNYA HAK AKSES');
        }

        // 1. Hapus gambar dari storage (jika ada)
        if ($question->image) {
            Storage::delete('public/' . $question->image);
        }

        // 2. Hapus data pertanyaan dari database
        // Jawaban yg terkait akan ikut terhapus karena 'onDelete('cascade')' di migrasi
        $question->delete();

        // 3. Redirect (misal, ke halaman index questions)
        return redirect()->route('questions.index')->with('success', 'Pertanyaan berhasil dihapus!');
    }
}
