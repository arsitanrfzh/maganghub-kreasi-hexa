<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- Tampilkan judul pertanyaan sebagai header --}}
            {{ $question->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="mb-6">
                        <div class="text-sm text-gray-600 mb-2">
                            Ditanyakan oleh: **{{ $question->user->name }}** |
                            Kategori: **{{ $question->category->name }}** |
                            Pada: {{ $question->created_at->format('d M Y, H:i') }}
                        </div>

                        @if ($question->image)
                        <div class="my-4">
                            <img src="{{ asset('storage/' . $question->image) }}" alt="Gambar Pertanyaan" class="rounded-lg max-w-full h-auto">
                        </div>
                        @endif

                        @if ($question->user_id == Auth::id())
                        <div class="flex items-center space-x-4 my-4">
                            <a href="{{ route('questions.edit', $question->id) }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 ...">
                                Edit
                            </a>

                            <form class="inline-block" action="{{ route('questions.destroy', $question->id) }}" method="POST" onsubmit="return confirm('Anda yakin?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 ...">
                                    Hapus
                                </button>
                            </form>
                        </div>
                        @endif

                        <div class="text-gray-800 text-base leading-relaxed">
                            {!! nl2br(e($question->body)) !!}
                        </div>

                        <hr classclass="my-6">

                        <h3 class="font-semibold text-lg mb-4">Jawaban:</h3>
                        <div class="space-y-4">
                            {{-- Daftar jawaban akan di-loop di sini --}}
                            <p class="text-gray-500">Belum ada jawaban.</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
</x-app-layout>