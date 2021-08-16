@extends('layouts.master')
@section('title', 'Laravel')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class=" section-header">
                <h1>Daftar Menu</h1>
            </div>
            <p class="list1">Mendaftarkan menu </p>



            <div class="cari">
                <form action="/menu/cari" method="get" class="form-inline">
                    @csrf
                    <div class="col-12">
                        <input type="text" class="form-control" name="cari" placeholder="Cari Nama Menu"
                            value="{{ old('cari') }}">
                        <button type="submit" class="btn btn-primary my-3 fa fa-search" value="cari"></button>
                </form>
            </div>
        </div>

        <a href="/menu/tambah" class="btn btn-info"> Tambah Menu</a>&nbsp;&nbsp; <a href="/menu/trash"
            class="btn btn-warning fas fa-trash"></a>
        &nbsp;&nbsp;
        <a href="/menu " class="btn btn-info fas fa-redo"></a><br> <br>
        <!-- style="background-color: #7962ea" -->

        <br>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Perhatian!</strong> Melakukan pengubahan dan penghapusan menu tidak bisa dilakukan jika menu sedang
            diakses!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>


        @if (session('status'))
        <div class="alert alert-info">
            {{ session('status') }}
        </div>
        @endif


        <table class="table table-striped">
            <thead class="table table-hover">
                <tr>
                    <th width="50px">No.</th>
                    <th width="50px">Nama Menu</th>
                    <th width="50px">Level Menu</th>
                    <th width="50px">Master Menu</th>
                    <th width="50px">Url</th>
                    <th width="50px">Aktif</th>
                    <th width="50px">No. Urut</th>
                    <th width="100px">Aksi</th>

                </tr>
            </thead>

            <tbody>
                @if(!empty($menu) && $menu->count())
                @foreach($menu as $as)
                <tr>
                    <th scope="row">{{$loop->iteration + $skipped}}</th>
                    <td>{{ $as->nama_menu}}</td>
                    <td>{{ $as->level_menu}}</td>
                    <td>{{ $as->master_menu}}</td>
                    <td>{{ $as->url}}</td>
                    <td>{{ $as->aktif}}</td>
                    <td>{{ $as->no_urut}}</td>

                    <td>
                        <a class="fas fa-edit" href="/menu/edit/{{$as->id}}"></a>
                        &nbsp;&nbsp;
                        <a class="fas fa-trash" href="/menu/hapus/{{$as->id}}"
                            onclick="return confirm('Apakah anda yakin data ini akan dihapus?')"></a>
                    </td>

                </tr>
                @endforeach
                @endif


            </tbody>
            <table>
                {!! $menu->links() !!}
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