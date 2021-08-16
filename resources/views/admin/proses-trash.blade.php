@extends('layouts.master')
@section('title', 'Laravel')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <h1 class="list">Daftar User</h1>


            <div class="row">
                <form action="/proses" method="get" class="form-inline">
                    @csrf
                    <div class="col-12">
                        <!-- <input type="text" class="form-control" name="q" placeholder="Cari buku disini"
                            value="{{ old('search') }}">
                        <button type="submit" class="btn btn-primary my-3" value="search">Cari Buku</button> -->
                </form>

                <br>
                <a href="/proses/kembalikan_semua" class="btn btn-success btn-sm" onclick="return confirm('Apakah anda yakin data ini akan dikembalikan semua?')">Kembalikan Semua</a>&nbsp;&nbsp;

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
                    <th scope="col">Nama Workflow</th>
                    <th scope="col">Schema sebelum</th>
                    <th scope="col">Schema sesudah</th>
                    <th scope="col">Urutan</th>
                    <th width="100px" scope="col">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($proses as $as)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{ $as->nama_workflow}}</td>
                    <td>{{ $as->nama_schema}}</td>
                    <td>{{ $as->nama_schema}}</td>
                    <td>{{ $as->urutan}}</td>

                    <td>
                                <a class="btn btn-info btn-sm" href="/schema/kembalikan/{{$as->id}}" onclick="return confirm('Apakah anda yakin untuk mengembalikan data ini?')">Kembalikan</a>
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