@extends('layouts.master')
@section('title', 'Laravel')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class=" section-header">
                <h1>Edit User</h1>
            </div>

            <form method="post" action="/user/update/{{$user->id}}">

                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="form-group">
                    <label for="pegawai_id">Pilih Pegawai</label>

                    <select class="form-control @error('pegawai_id') is-invalid @enderror" id="pegawai_id"
                        name="pegawai_id" readonly>
                        @foreach ($pegawai as $pegawai)
                        <option value=" {{ $user->pegawai_id }}" @if($pegawai->id==$user->pegawai_id)
                            selected='selected'
                            @endif >{{ $pegawai->id}} - {{ $pegawai->nama_pegawai}}</option>
                        @endforeach

                        @error('pegawai_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </select>

                </div>

                <div class="form-group">
                    <label for="name">Nama User</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        placeholder="Masukkan name user" name="name" value=" {{ $user->name }}" required>
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>


                <div class=" form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                        placeholder="Masukkan username user" name="username" value=" {{ $user->username }}" required>
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
                        <!-- <option value="{{ $user->id}}">{{$level->id}} - {{$level->nama_level_user}}</option> -->
                        <option value="{{ $user->level_user_id }}" @if($level->id==$user->level_user_id)
                            selected='selected'
                            @endif >{{ $level->id}} - {{ $level->nama_level_user}}</option>
                        @endforeach
                    </select>

                    @error('level_user_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror


                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                        placeholder="Masukkan email user" name="email" value=" {{ $user->email }}" required>
                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Konformasi Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror " id="password"
                        placeholder="Masukkan password  user" name="password" value="" required>

                    @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">Edit User</button>
                <a href="/user" class="btn btn-info">Kembali</a>
            </form>


        </div>
    </div>
</div>

@endsection

@push('page-scripts')
@endpush