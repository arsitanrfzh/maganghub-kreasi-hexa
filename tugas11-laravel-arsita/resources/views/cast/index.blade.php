@extends('layouts.main') @section('content')
    <div class="content-header">
        <h1 class="m-0">Daftar Cast</h1>
    </div>

    <div class="card">
        <div class="card-header">
            <a href="/cast/create" class="btn btn-primary">Tambah Cast Baru</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Nama</th>
                        <th>Umur</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($casts as $cast)
                        <tr>
                            <td>{{ $loop->iteration }}</td> <td>{{ $cast->nama }}</td>
                            <td>{{ $cast->umur }}</td>
                            <td>
                                <a href="/cast/{{ $cast->id }}" class="btn btn-info btn-sm">Detail</a>
                                
                                <a href="/cast/{{ $cast->id }}/edit" class="btn btn-warning btn-sm">Edit</a>
                                
                                <form action="/cast/{{ $cast->id }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE') <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection