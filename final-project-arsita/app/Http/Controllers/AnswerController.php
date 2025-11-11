<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Question;
use App\Models\Answer;

class AnswerController extends Controller
{
    public function store(Request $request, Question $question)
    {
        // 1. Validasi
        $validated = $request->validate([
            'body' => 'required|string|min:5', // Jawaban minimal 5 karakter
        ]);

        // 2. Buat dan simpan jawaban
        $question->answers()->create([
            'body' => $validated['body'],
            'user_id' => Auth::id(), // ID user yg sedang login
        ]);

        // 3. Redirect kembali ke halaman pertanyaan
        return redirect()->route('questions.show', $question->id)->with('success', 'Jawaban berhasil dikirim!');
    }

    public function destroy(Answer $answer)
    {
        // Cek apakah user yg login adalah pemilik jawaban
        if (Auth::id() !== $answer->user_id) {
            abort(403, 'ANDA TIDAK PUNYA HAK AKSES');
        }

        // 2. Hapus jawaban
        $answer->delete();

        // 3. Redirect kembali ke halaman pertanyaan
        // Ambil question->id dari relasi $answer->question
        return redirect()->route('questions.show', $answer->question_id)->with('success', 'Jawaban berhasil dihapus!');
    }
}
