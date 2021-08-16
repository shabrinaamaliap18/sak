@extends('layouts.master')
@section('title', 'Laravel')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class=" section-header">
                <h1>Daftar User</h1>
            </div>
            <p class="list1">Mendaftarkan User Baru pada setiap role</p>

            <div class="cari">
                <form action="/user/cari" method="get" class="form-inline">
                    @csrf
                    <div class="col-12">
                        <input type="text" class="form-control" name="cari" placeholder="Cari Nama User"
                            value="{{ old('cari') }}">
                        <button type="submit" class="btn btn-primary my-3 fa fa-search" value="cari"></button>
                </form>
            </div>
        </div>

        <a href="/user/tambah" class="btn btn-info">Tambah user</a>&nbsp;&nbsp; <a href="/user/trash"
            class="btn btn-warning fas fa-trash"></a>
        &nbsp;&nbsp;
        <a href="/user " class="btn btn-info fas fa-redo"></a><br> <br>



        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif


        <table class="table table-striped">
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
                @if(!empty($user) && $user->count())
                @foreach($user as $us)
                <tr>
                    <th scope="row">{{$loop->iteration + $skipped}}</th>
                    <td>{{ $us->nama_pegawai}}</td>
                    <td>{{ $us->name}}</td>
                    <td>{{ $us->username}}</td>
                    <td>{{ $us->nama_level_user}}</td>
                    <td>{{ $us->email}}</td>
                    <td>
                        <a class="fas fa-edit" href="/user/edit/{{$us->id}}"></a>
                        &nbsp;&nbsp;
                        <a class="fas fa-trash" href="/user/hapus/{{$us->id}}"
                            onclick="return confirm('Apakah anda yakin data ini akan dihapus?')"></a>
                    </td>

                </tr>
                @endforeach
                @endif


            </tbody>
            <table>

                {!! $user->links() !!}
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