@extends('layouts.master')
@section('title', 'Laravel')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <h1 class="list">Daftar Honor</h1>


            <div class="row">
                <form action="/lihathonor" method="get" class="form-inline">
                    @csrf
                    <div class="col-12">
                        <!-- <input type="text" class="form-control" name="q" placeholder="Cari buku disini"
                            value="{{ old('search') }}">
                        <button type="submit" class="btn btn-primary my-3" value="search">Cari Buku</button> -->
                </form>

                <br>
                <a href="/lihathonor/kembalikan_semua" class="btn btn-success btn-sm"
                    onclick="return confirm('Apakah anda yakin data ini akan dikembalikan semua?')">Kembalikan
                    Semua</a>&nbsp;&nbsp;

                <br><br>


                @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                @endif

                <table class="table">
                    <thead class="table-light">
                        <!-- <tr style="background-color: #ADD8E6;"> -->
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


                    <tbody>
                        @foreach($lihathonor as $as)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{ $as->nama_kader}}</td>
                            <td>{{ $as->daftar_kegiatan}}</td>
                            <td>{{ $as->no_rekening}}</td>
                            <td>{{ $as->nominal}}</td>
                            <td>{{ $as->selip_gaji}}</td>
                            <td><a class="btn btn-info btn-sm" href="/lihathonor/kembalikan/{{$as->id}}"
                                    onclick="return confirm('Apakah anda yakin untuk mengembalikan data ini?')">Kembalikan</a>
                                &nbsp;&nbsp;

                            </td>

                        </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>


@endsection

@push('page-scripts')
@endpush