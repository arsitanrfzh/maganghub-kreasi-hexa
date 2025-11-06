@extends('layouts.main')

@section('content')
    <div class="content-header">
        <h1 class="m-0">Edit Cast</h1>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="/cast/{{ $cast->id }}" method="POST">
                @csrf
                @method('PUT') <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" value="{{ $cast->nama }}" required>
                </div>
                <div class="form-group">
                    <label>Umur</label>
                    <input type="number" name="umur" class="form-control" value="{{ $cast->umur }}" required>
                </div>
                <div class="form-group">
                    <label>Bio</label>
                    <textarea name="bio" class="form-control" rows="3" required>{{ $cast->bio }}</textarea>
                </div>
                
                <button type="submit" class="btn btn-warning">Update</button>
                <a href="/cast" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection