@extends('layouts.main')

@section('content')
    <div class="content-header">
        <h1 class="m-0">Detail Cast</h1>
    </div>

    <div class="card">
        <div class="card-body">
            <h3>{{ $cast->nama }}</h3>
            
            <p><strong>Umur:</strong> {{ $cast->umur }} tahun</p>
            
            <p><strong>Bio:</strong></p>
            <p>{{ $cast->bio }}</p>
            
            <a href="/cast" class="btn btn-secondary mt-3">Kembali</a>
        </div>
    </div>
@endsection