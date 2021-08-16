@extends('layouts.master')
@section('title', 'Laravel')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class=" section-header">
                <h1>Daftar State</h1>
            </div>
            <p class="list1">Mendaftarkan State</p>

            <div class="cari">
                <form action="/schema/cari" method="get" class="form-inline">
                    @csrf
                    <div class="col-12">
                        <input type="text" class="form-control" name="cari" placeholder="Cari Nama State" value="{{ old('cari') }}">
                        <button type="submit" class="btn btn-primary my-3 fa fa-search" value="cari"></button>
                </form>
            </div>
        </div>

        <a href="/schema/tambah" class="btn btn-info">Tambah State</a>&nbsp;&nbsp; <a href="/schema/trash" class="btn btn-warning fas fa-trash"></a>
        <a href="/schema " class="btn btn-info fas fa-redo"></a><br> <br>



        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif


        <table class="table">
            <thead class="table table-hover">
                <tr>
                    <th width="300px">No.</th>
                    <th width="300px">Nama State</th>
                    <th width="300px">Aksi</th>
                </tr>
            </thead>


            <tbody>
                @foreach($schema as $as)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{ $as->nama_schema}}</td>
                    <td>
                        <a class="fas fa-edit" href="/schema/edit/{{$as->id}}"></a>
                        &nbsp;&nbsp;
                        <a class="fas fa-trash" href="/schema/hapus/{{$as->id}}" onclick="return confirm('Apakah anda yakin data ini akan dihapus?')"></a>
                    </td>

                </tr>
                @endforeach


            </tbody>
            <table>
    </div>
</div>

</div>

<style>
    .cari {
        float: right;

    }
</style>


@endsection

@push('page-scripts')
@endpush