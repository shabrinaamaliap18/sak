@extends('layouts.master')
@section('title', 'Laravel')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class=" section-header">
                <h1>Daftar Tim</h1>
            </div>
            <p class="list1">Mendaftarkan Tim</p>



            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif

            <table class="table table-striped">
                <thead class="table table-hover">
                    <tr>
                        <th width="300px">No.</th>
                        <th width="300px">Dikoordinasikan Oleh</th>
                        <th width="300px">Aksi</th>
                    </tr>
                </thead>


                <tbody>
                    @foreach($tim as $as)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{ $as->nama_pegawai}}</td>
                        <td>

                            &nbsp;&nbsp; <a class="fas fa-trash" href="/tim/hapus/{{$as->id}}"
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