@extends('layouts.master')
@section('title', 'Laravel')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class=" section-header">
                <h1>Edit Pegawai</h1>
            </div>

            <form method="post" enctype="multipart/form-data" action="/pegawai/{{$pegawai->id}}">

                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="form-group">
                    <label for="judul">Nama Pegawai</label>
                    <input type="text" class="form-control @error('nama_pegawai') is-invalid @enderror"
                        id="nama_pegawai" placeholder="Masukkan nama pegawai baru" name="nama_pegawai"
                        value="{{$pegawai->nama_pegawai}}">

                    @error('nama_pegawai')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="judul">NIP</label>
                    <input type="number" class="form-control @error('nip') is-invalid @enderror" id="NIP"
                        placeholder="Masukkan NIP pegawai baru" name="NIP" value="{{$pegawai->NIP}}" required>
                    @error('nip')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="judul">NIK</label>
                    <input type="number" class="form-control @error('nik') is-invalid @enderror" id="NIK"
                        placeholder="Masukkan NIK pegawai baru" name="NIK" value="{{$pegawai->NIK}}" required>
                    @error('nik')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="judul">Jenis Kelamin</label>
                    <select class="form-control @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin"
                        name="jenis_kelamin" required>
                        <option {{ ($pegawai -> jenis_kelamin) == 'Laki_Laki' ? 'selected' : '' }} value="Laki_Laki">
                            Laki - Laki
                        </option>
                        <option {{ ($pegawai -> jenis_kelamin) == 'Perempuan' ? 'selected' : '' }} value="Perempuan">
                            Perempuan
                        </option>

                    </select>

                    @error('jenis_kelamin')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="jabatan">Jabatan</label>
                    <select class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" name="jabatan"
                        required>
                        <option {{ ($pegawai -> jabatan) == 'kader' ? 'selected' : '' }} value="kader">
                            Kader
                        </option>
                        <option {{ ($pegawai -> jabatan) == 'koordinator' ? 'selected' : '' }} value="koordinator">
                            Koordinator
                        </option>
                        <option {{ ($pegawai -> jabatan) == 'opd' ? 'selected' : '' }} value="opd">
                            OPD
                        </option>

                    </select>

                    @error('opd')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="input-group-addon">
                    </div>
                    <label for="judul">Tanggal Lahir</label>
                    <input class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir"
                        name="tanggal_lahir" placeholder="MM/DD/YYYY" type="date" value="{{$pegawai->tanggal_lahir}}" />
                    @error('tanggal_lahir')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>




                <div class="form-group">
                    <label for="image">Foto Pegawai</label>

                    <input type="file" class="form-control-file" id="foto_pegawai" placeholder="Masukkan foto"
                        name="foto_pegawai" value="{{$pegawai->foto_pegawai}}" method="post"
                        enctype="multipart/form-data">

                    @error('foto_pegawai')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>



                <button type="submit" class="btn btn-success">Edit Pegawai</button>
                <a href="/pegawai" class="btn btn-info">Kembali</a> <br> <br> <br>

                <div class=" section-header">
                    <h1>Manajemen Tim</h1>
                </div>



                <div class="panel" id="panel panel-footer">
                    <table class="table table-light">

                        <thead>
                            <tr>
                                <th><a href='/tim/edit/{{$pegawai->id}}' class="btn btn-info"><i
                                            class="fas fa-plus"></i></a></th>
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

                    </table>
                </div>









            </form>



            <script type="text/javascript">
            $(window).load(function() {
                $("#jabatan").change(function() {
                    console.log($("#jabatan option:selected").val());
                    if ($("#jabatan option:selected").val() == 'koordinator') {
                        $('.table').prop('hidden', 'true');
                    } else if ($("#jabatan option:selected").val() == 'opd') {
                        $('.table').prop('hidden', 'true');
                    } else {
                        $('.table').prop('hidden', false);
                    }
                });
            });
            </script>

        </div>
    </div>
</div>
@endsection

@push('page-scripts')
@endpush