@extends('layouts.master')
@section('title', 'Laravel')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class=" section-header">
                <h1>Tambah User</h1>
            </div>

            <form method="post" action="/user" enctype="multipart/form-data">
                {{ csrf_field() }}


                <div class="form-group">
                    <label for="pegawai_id">Pilih Pegawai</label>

                    <select class="form-control" id=" pegawai_id" name=" pegawai_id" required>
                        <!-- <option selected>Pilih Pegawai User</option> -->
                        @foreach ($pegawai as $pegawai)
                        <option value="{{ $pegawai->id}}">{{$pegawai->id}} - {{$pegawai->nama_pegawai}}</option>
                        @endforeach
                    </select>


                    <!-- @error('pegawai_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror -->
                </div>


                <div> <label for="name">Nama User</label>
                    <input type="text" class="form-control  @error('name') is-invalid @enderror" id="name"
                        placeholder="Masukkan name user" name="name" required>
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div><br>


                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror " id="username"
                        placeholder="Masukkan username user" name="username" required>

                    @error('username')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="id-level">ID Level</label>
                    <!-- <input type="text" class="form-control" id="id-level" placeholder="Masukkan id-level user"
                        name="id-level" required> -->

                    <select class="form-control @error('level_user_id') is-invalid @enderror" id="level_user_id"
                        name="level_user_id" required>
                        <option selected>Pilih Level User</option>
                        @foreach ($level as $level)
                        <option value="{{ $level->id}}">{{$level->id}} - {{$level->nama_level_user}}</option>
                        @endforeach
                    </select>
                    @error('level_user_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control  @error('email') is-invalid @enderror" id="email"
                        placeholder="Masukkan email user" name="email" required>


                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        placeholder="Masukkan password rilis user" name="password" required>

                    @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">Tambah User</button>
                <a href="/user" class="btn btn-info">Kembali</a>
            </form>


        </div>
    </div>
</div>

@endsection

@push('page-scripts')
@endpush