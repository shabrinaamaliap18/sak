@extends('layouts.master')
@section('title', 'Laravel')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class=" section-header">
                <h1>Daftar Proses</h1>
            </div>


            <div class="cari">
                <form action="/proses/cari" method="get" class="form-inline">
                    @csrf
                    <div class="col-12">
                        <input type="text" class="form-control" name="cari" placeholder="Cari Workflow"
                            value="{{ old('cari') }}">
                        <button type="submit" class="btn btn-primary my-3 fa fa-search" value="cari"></button>
                </form>
            </div>
        </div>

        <a href="/proses/tambah" class="btn btn-info">Tambah proses</a>&nbsp;&nbsp; <a href="/proses/trash"
            class="btn btn-warning fas fa-trash"></a>
        <a href="/proses " class="btn btn-info fas fa-redo"></a><br> <br>



        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif

        <table class="table table-striped">
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
                    <td>{{ $as->schema_sebelum}}</td>
                    <td>{{ $as->schema_sesudah}}</td>
                    <td>{{ $as->urutan}}</td>

                    <td>
                        <a class="fas fa-edit" href="/proses/edit/{{$as->id}}"></a>
                        &nbsp;&nbsp;
                        <a class="fas fa-trash" href="/proses/hapus/{{$as->id}}"
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