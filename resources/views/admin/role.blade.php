@extends('layouts.master')
@section('title', 'Laravel')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class=" section-header">
                <h1>Daftar Role</h1>
            </div>
            <p class="list1">Mendaftarkan Role</p>


            <div class="cari">
                <form action="/role/cari" method="get" class="form-inline">
                    @csrf
                    <div class="col-12">
                        <input type="text" class="form-control" name="cari" placeholder="Cari Nama Role"
                            value="{{ old('cari') }}">
                        <button type="submit" class="btn btn-primary my-3 fa fa-search" value="cari"></button>
                </form>
            </div>
        </div>
        <a href="/role/tambah" class="btn btn-info">Tambah role</a>&nbsp;&nbsp; <a href="/role/trash"
            class="btn btn-warning fas fa-trash"></a>

        &nbsp;&nbsp;
        <a href="/role" class="btn btn-info fas fa-redo"></a><br> <br>



        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif


        <table class="table table-striped">
            <thead class="table table-hover">
                <tr>
                    <th width="300px">No.</th>
                    <th width="300px">Nama Role</th>
                    <th width="300px">Aksi</th>
                </tr>
            </thead>
            </thead>

            <tbody>
                @foreach($role as $as)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{ $as->nama_level_user}}</td>
                    <td>
                        <a class="fas fa-edit" href="/role/edit/{{$as->id}}"></a>
                        &nbsp;&nbsp;
                        <a class="fas fa-plus" href="/akses/show/{{$as->id}}"></a>
                        &nbsp;&nbsp; <a class="fas fa-trash" href="/role/hapus/{{$as->id}}"
                            onclick="return confirm('Apakah anda yakin data ini akan dihapus?')"></a>
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