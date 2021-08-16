@extends('layouts.master')
@section('title', 'Laravel')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <h1 class="list">Daftar User</h1>


            <div class="row">
                <form action="/user" method="get" class="form-inline">
                    @csrf
                    <div class="col-12">
                        <!-- <input type="text" class="form-control" name="q" placeholder="Cari buku disini"
                            value="{{ old('search') }}">
                        <button type="submit" class="btn btn-primary my-3" value="search">Cari Buku</button> -->
                </form>

                <br>
                <a href="/user/kembalikan_semua" class="btn btn-success btn-sm"
                    onclick="return confirm('Apakah anda yakin data ini akan dikembalikan semua?')">Kembalikan
                    Semua</a>&nbsp;&nbsp;

                <br><br>


                @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                @endif

                <table class="table">
                    <thead class="table table-hover">
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Nama Pegawai</th>
                            <th scope="col">Nama User</th>
                            <th scope="col">Username</th>
                            <th scope="col">Role</th>
                            <th scope="col">Email</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($user as $us)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{ $us->nama_pegawai}}</td>
                            <td>{{ $us->name}}</td>
                            <td>{{ $us->username}}</td>
                            <td>{{ $us->nama_level_user}}</td>
                            <td>{{ $us->email}}</td>
                            <td>
                                <a class="btn btn-info btn-sm" href="/schema/kembalikan/{{$us->id}}"
                                    onclick="return confirm('Apakah anda yakin untuk mengembalikan data ini?')">Kembalikan</a>
                                &nbsp;&nbsp;

                            </td>

                        </tr>
                        @endforeach


                    </tbody>
                    <table>
            </div>
        </div>

    </div>


    @endsection

    @push('page-scripts')
    @endpush