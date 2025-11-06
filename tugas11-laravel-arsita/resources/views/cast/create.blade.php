@extends('layouts.main')

@section('content')
    <div class="content-header">
        <h1 class="m-0">Tambah Cast</h1>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="/cast" method="POST">
                @csrf <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Umur</label>
                    <input type="number" name="umur" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Bio</label>
                    <textarea name="bio" class="form-control" rows="3" required></textarea>
                </div>
                
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="/cast" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection