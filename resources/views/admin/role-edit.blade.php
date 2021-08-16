@extends('layouts.master')
@section('title', 'Laravel')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class=" section-header">
                <h1>Edit Role</h1>
            </div>

            <form method="post" action="/role/{{$role->id}}">

                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="form-group">
                    <label for="judul">Edit Role</label>
                    <input type="text" class="form-control @error('nama_level_user') is-invalid @enderror"
                        id="nama_level_user" placeholder="Masukkan nama role baru" name="nama_level_user"
                        value="{{$role->nama_level_user}}" required>
                    @error('nama_level_user')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">Edit Role</button>
                <a href="/role" class="btn btn-info">Kembali</a>


            </form>


        </div>
    </div>
</div>

@endsection

@push('page-scripts')
@endpush