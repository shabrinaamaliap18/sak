@extends('layouts.master')
@section('title', 'Laravel')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class=" section-header">
                <h1>Tambah Honor</h1>
            </div>

            <form method="post" action="/lihathonor" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="nama_kader">Nama Kader</label>
                    <input type="text" class="form-control" id="nama_kader" placeholder="Masukkan Nama Kader"
                        name="nama_kader" required>


                </div>

                <div class="form-group">
                    <label for="daftar_kegiatan">Daftar Kegiatan</label>
                    <input type="text" class="form-control " id="daftar_kegiatan" placeholder="Masukkan Daftar Kegiatan"
                        name="daftar_kegiatan" required>
                </div>

                <div class="form-group">
                    <label for="no_rekening">No. Rekening</label>
                    <input type="text" class="form-control" id="no_rekening" placeholder="Masukkan No Rekening"
                        name="no_rekening" required>
                </div>

                <div class="form-group">
                    <label for="nominal">Nominal</label>
                    <input type="number" class="form-control" id="nominal" placeholder="Masukkan Nominal "
                        name="nominal" required>
                </div>

                <div class="form-group">
                    <label for="selip_gaji">Selip Gaji</label>
                    <input type="number" class="form-control" id="selip_gaji" placeholder="Masukkan Selip Gaji "
                        name="selip_gaji" required>
                </div>

                <button type="submit" class="btn btn-success">Tambah Honor</button>
                <a href="/lihathonor" class="btn btn-info">Kembali</a>
            </form>

        </div>
    </div>
</div>




@endsection

@push('page-scripts')
@endpush