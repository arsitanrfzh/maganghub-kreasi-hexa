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
}
