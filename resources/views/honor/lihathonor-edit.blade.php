@extends('layouts.master')
@section('title', 'Laravel')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class=" section-header">
                <h1>Edit Honor</h1>
            </div>

            <form method="post" action="/lihathonor/{{$lihathonor->id}}">

                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="form-group">
                    <label for="nama_kader">Nama Kader</label>
                    <input type="text" class="form-control @error('nama_kader') is-invalid @enderror" id="nama_kader"
                        placeholder="Masukkan Nama Kader" name="nama_kader" value="{{$lihathonor->nama_kader}}">

                    @error('nama_kader')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="daftar_kegiatan">Daftar Kegiatan</label>
                    <input type="text" class="form-control @error('daftar_kegiatan') is-invalid @enderror"
                        id="daftar_kegiatan" placeholder="Masukkan Nama Kegiatan" name="daftar_kegiatan"
                        value="{{$lihathonor->daftar_kegiatan}}" required>
                    @error('daftar_kegiatan')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="no_rekenening">No. Rekening</label>
                    <input type="number" class="form-control @error('no_rekenening') is-invalid @enderror"
                        id="no_rekenening" placeholder="Masukka No Rekening" name="no_rekening"
                        value="{{$lihathonor->no_rekening}}" required>
                    @error('no_rekenening')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="nominal">Nominal</label>
                    <input type="number" class="form-control @error('nominal') is-invalid @enderror" id="nominal"
                        placeholder="Masukkan Nominal " name="nominal" value="{{$lihathonor->nominal}}" required>
                    @error('nominal')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="selip_gaji">Selip Gaji</label>
                    <input type="number" class="form-control @error('selip_gaji') is-invalid @enderror" id="selip_gaji"
                        placeholder="Masukkan Selip Gaji " name="selip_gaji" value="{{$lihathonor->selip_gaji}}"
                        required>
                    @error('selip_gaji')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>



                <button type="submit" class="btn btn-success">Edit Honor</button>
                <a href="/lihathonor" class="btn btn-info">Kembali</a> <br> <br> <br>

            </form>


        </div>
    </div>
</div>
@endsection

@push('page-scripts')
@endpush