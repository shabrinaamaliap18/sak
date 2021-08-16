@extends('layouts.master')
@section('title', 'Laravel')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class=" section-header">
                <h1>Tambah Role</h1>
            </div>

            <form method="post" action="/role" enctype="multipart/form-data">
                @csrf


                <div class="form-group">
                    <label for="judul">Menambahkan Role</label>
                    <input type="text" class="form-control @error('nama_level_user') is-invalid @enderror"
                        id="nama_level_user" placeholder="Masukkan nama role" name="nama_level_user" required>

                    @error('nama_level_user')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">Tambah Role</button>
                <a href="/role" class="btn btn-info">Kembali</a>
            </form>


        </div>
    </div>
</div>

@endsection

@push('page-scripts')
@endpush