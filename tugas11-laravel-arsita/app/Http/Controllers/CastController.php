<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cast;

class CastController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $casts = Cast::all(); // 1. Ambil semua data cast
        return view('cast.index', ['casts' => $casts]); // 2. Kirim ke view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cast.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi data (langkah baik, meski tidak diminta)
        $request->validate([
            'nama' => 'required|string|max:45',
            'umur' => 'required|integer',
            'bio' => 'required'
        ]);

        // 2. Simpan data baru
        Cast::create([
            'nama' => $request->input('nama'),
            'umur' => $request->input('umur'),
            'bio' => $request->input('bio')
        ]);

        // 3. Arahkan kembali ke halaman index
        return redirect('/cast')->with('success', 'Data cast berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $cast = Cast::find($id); // 1. Cari cast berdasarkan ID
        return view('cast.show', ['cast' => $cast]); // 2. Kirim ke view
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $cast = Cast::find($id); // 1. Cari data cast yang mau diedit
        return view('cast.edit', ['cast' => $cast]); // 2. Kirim ke view (form-nya)
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // 1. Validasi
        $request->validate([
            'nama' => 'required|string|max:45',
            'umur' => 'required|integer',
            'bio' => 'required'
        ]);

        // 2. Cari data dan update
        $cast = Cast::find($id);
        $cast->update([
            'nama' => $request->input('nama'),
            'umur' => $request->input('umur'),
            'bio' => $request->input('bio')
        ]);

        // 3. Redirect
        return redirect('/cast')->with('success', 'Data cast berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cast = Cast::find($id);
        $cast->delete(); // 1. Hapus data

        return redirect('/cast')->with('success', 'Data cast berhasil dihapus!');
    }
}
