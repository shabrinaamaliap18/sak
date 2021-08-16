@extends('layouts.master')
@section('title', 'Laravel')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class=" section-header">
                <h1>Daftar Honor</h1>
            </div>



            <div class="cari">
                <form action="/lihathonor/cari" method="get" class="form-inline">
                    @csrf
                    <div class="col-12">
                        <input type="text" class="form-control" name="cari" placeholder="Cari Nama Kader"
                            value="{{ old('cari') }}">
                        <button type="submit" class="btn btn-primary my-3 fa fa-search" value="cari"></button>
                </form>
            </div>
        </div>


        <a href="/lihathonor/tambah" class="btn btn-info">Tambah Honor</a> &nbsp;&nbsp;
        <a href="/lihathonor/trash" class="btn btn-warning fas fa-trash"></a>&nbsp;&nbsp;
        <a href="/lihathonor " class="btn btn-info fas fa-redo"></a><br> <br>


        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif


        <table class="table">
            <thead class="table table-hover">
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Nama Kader</th>
                    <th scope="col">Daftar Kegiatan</th>
                    <th scope="col">No. Rekening</th>
                    <th scope="col">Nominal</th>
                    <th scope="col">Selip Gaji</th>

                    <th width="250px" scope="col">Aksi</th>
                </tr>
            </thead>
            </thead>

            <tbody>
                @foreach($lihathonor as $as)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{ $as->nama_kader}}</td>
                    <td>{{ $as->daftar_kegiatan}}</td>
                    <td>{{ $as->no_rekening}}</td>
                    <td>{{ $as->nominal}}</td>
                    <td>{{ $as->selip_gaji}}</td>

                    <td><br>
                        <a class="fas fa-edit" href="/lihathonor/edit/{{$as->id}}"></a>
                        &nbsp;&nbsp;
                        <a class="fas fa-trash" href="/lihathonor/hapus/{{$as->id}}"
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