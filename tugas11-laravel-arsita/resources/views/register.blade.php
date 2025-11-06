@extends('layouts.main')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Halaman Registrasi</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Form Registrasi</h3>
                </div>
                <form action="/welcome" method="POST">
                    @csrf <div class="card-body">
                        
                        <div class="form-group">
                            <label for="first_name">Nama Depan</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Masukkan nama depan Anda">
                        </div>

                        <div class="form-group">
                            <label for="last_name">Nama Belakang</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Masukkan nama belakang Anda">
                        </div>
                        
                        </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            </div>
    </div>
    @endsection