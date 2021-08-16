@extends('layouts.master')
@section('title', 'Laravel')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class=" section-header">
                <h1>Data kegiatan</h1>
            </div>

            <form method="post" action="/alllaporan/update/{{$forms->id}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                @endif
                <h5>I. Lokasi Pendataan</h5>
                <div class="form-row">
                    <div class="col">
                        <label for="rt">Kecamatan</label>
                        <input type="text" id="kecamatan" name="kecamatan" class="form-control" placeholder="Kecamatan"
                            value="{{$forms->kecamatan}}">

                    </div>

                </div><br>

                <div class="form-row">

                    <div class="col-md-10">
                        <label for="rt">Kelurahan</label>
                        <input type="text" id="kelurahan" name="kelurahan" class="form-control" placeholder="Kelurahan"
                            value="{{$forms->kelurahan}}">
                    </div>

                    <div class="col-md-1">

                        <label for="rt">RT</label>
                        <input type="number" id="rt" name="rt" class="form-control" placeholder="rt"
                            value="{{$forms->rt}}">

                    </div>

                    <div class="col-md-1">
                        <label for="rt">RW</label>
                        <input type="number" id="rw" name="rw" class="form-control" placeholder="rw"
                            value="{{$forms->rw}}">

                    </div>

                </div><br><br>



                <h5>II. Data Keluarga</h5>

                <div class="form-row">
                    <div class="col">
                        <label for="no_kk">No. KK</label>
                        <input type="number" class="form-control" id="no_kk" name="no_kk" placeholder="Masukkan No KK"
                            id="no_kk" name="no_kk" value="{{$forms->no_kk}}">
                    </div>
                    <div class="col">
                        <label for="alamat_lengkap">Alamat Lengkap</label>
                        <input type="text" class="form-control" id="alamat_lengkap" name="alamat_lengkap"
                            placeholder="Masukkan Alamat Lengkap" value="{{$forms->alamat_lengkap}}">
                    </div>
                </div>

                <br>

                <div class="form-row">
                    <div class="col">
                        <label for="nama_kepala_kk">Nama Kepala KK</label>
                        <input type="text" class="form-control" id="nama_kepala_kk" name="nama_kepala_kk"
                            placeholder="Masukkan Nama Kepala KK" value="{{$forms->nama_kepala_kk}}">
                    </div>
                    <div class="col">
                        <label for="jumlah_anggota">Jumlah Anggota</label>
                        <input type="number" class="form-control" id="jumlah_anggota" name="jumlah_anggota"
                            placeholder="Masukkan Jumlah Anggota" value="{{$forms->jumlah_anggota}}">
                    </div>
                </div>
                <br>

                <div class="form-group">
                    <label for="status_rumah">Status Rumah</label>
                    <select class="form-control" id="status_rumah" name="status_rumah">
                        <option selected value="">Pilih Status Rumah</option>
                        <option {{ ($forms -> milik_sendiri) == 'milik_sendiri' ? 'selected' : '' }}
                            value="milik_sendiri">
                            Milik Sendiri
                        </option>
                        <option {{ ($forms -> sewa) == 'sewa' ? 'selected' : '' }} value="sewa">
                            Sewa
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="status_penduduk">Status Penduduk</label>
                    <select class="form-control" id="status_penduduk" name="status_penduduk">
                        <option selected value="">Pilih Status Penduduk</option>
                        <option {{ ($forms -> permanen) == 'permanen' ? 'selected' : '' }} value="permanen">
                            Permanen
                        </option>
                        <option {{ ($forms -> non_permanen) == 'non_permanen' ? 'selected' : '' }} value="non_permanen">
                            Non Permanen
                        </option>
                    </select>
                </div>

                <div class="table">
                    <div class="form-group">
                        <label for="alamat_asal">Alamat Asal</label>
                        <input type="text" id="alamat_asal" name="alamat_asal" class="form-control"
                            placeholder="Masukkan Alamat Asal" value="{{$forms->alamat_asal}}">
                    </div>

                    <div class="form-group">
                        <label for="tanggal_kedatangan">Tanggal Kedatangan</label>
                        <input type="date" id="tanggal_kedatangan" name="tanggal_kedatangan" class="form-control"
                            placeholder="Masukkan Alamat Lengkap" value="{{$forms->tanggal_kedatangan}}">
                    </div>
                </div>


                <h5>III. Identitas Penduduk</h5>
                @foreach ($penduduk as $penduduk)
                <div class="row">
                    <div class="col-lg-12">
                        <div id="inputFormRow">
                            <div class="form-group">

                                <div class="row">
                                    <div class="col-md-6 form-group"><input type="number" name="nik[]" id="nik[]"
                                            class="form-control m-input" placeholder="NIK" value="{{$penduduk->nik}}"
                                            autocomplete="off">
                                    </div>

                                    <div class="col-md-6 form-group mt-3 mt-md-0"><input type="text"
                                            name="nama_lengkap[]" id="nama_lengkap[]" class="form-control m-input"
                                            placeholder="Nama Lengkap" value="{{$penduduk->nama_lengkap}}"
                                            autocomplete="off">
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <select class="form-control" id="jenis_kelamin[]" name="jenis_kelamin[]">
                                            <option selected value="">Pilih Jenis Kelamin</option>
                                            <option {{ ($penduduk -> jenis_kelamin) == 'laki-laki' ? 'selected' : '' }}
                                                value="laki-laki">
                                                Laki - Laki
                                            </option>
                                            <option {{ ($penduduk -> jenis_kelamin) == 'perempuan' ? 'selected' : '' }}
                                                value="perempuan">
                                                Perempuan
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 form-group mt-3 mt-md-0"><input type="text"
                                            name="tempat_lahir[]" id="tempat_lahir[]" class="form-control m-input"
                                            placeholder="Tempat Lahir" value="{{$penduduk->tempat_lahir}}"
                                            autocomplete="off">
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6 form-group "><input type="date" name="tanggal_lahir[]"
                                            id="tanggal_lahir[]" class="form-control" class="input-group-addon"
                                            placeholder="MM/DD/YYYY" value="{{$penduduk->tanggal_lahir}}"
                                            autocomplete="off">
                                    </div>

                                    <div class="col-md-6 form-group mt-3 mt-md-0"><input type="number" name="telp[]"
                                            id="telp[]" class="form-control m-input" placeholder="No Telepon"
                                            value="{{$penduduk->telp}}" autocomplete="off">
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6 form-group"><input type="text" name="pekerjaan[]"
                                            id="pekerjaan[]" class="form-control m-input" placeholder="Pekerjaan"
                                            value="{{$penduduk->pekerjaan}}" autocomplete="off">
                                    </div>

                                    <div class="col-md-6 form-group mt-3 mt-md-0"><input type="text" name="pendidikan[]"
                                            id="pendidikan[]" class="form-control m-input" placeholder="Pendidikan"
                                            value="{{$penduduk->pendidikan}}" autocomplete="off">

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-12 "> <select class="form-control" id="status_kawin[]"
                                            name="status_kawin[]">
                                            <option selected value="">Pilih Status Kawin</option>
                                            <option {{ ($penduduk -> status_kawin) == 'belum_kawin' ? 'selected' : '' }}
                                                value="belum_kawin">
                                                Belum Kawin
                                            </option>
                                            <option {{ ($penduduk -> status_kawin) == 'kawin' ? 'selected' : '' }}
                                                value="kawin">
                                                Kawin
                                            </option>
                                        </select>
                                    </div>
                                </div>





                                <div class="input-group-append">
                                    <button id="removeRow" type="button" class=" btn btn-danger" style="
                                            text-align:center; width:100px">Hapus</button><br>
                                </div>
                            </div>
                        </div>

                        <div id="newRow"></div>
                        <button id="addRow" type="button" class="btn btn-info" style="
                                            text-align:center; width:100px">Tambah</button><br>
                    </div>
                </div><br>
                @endforeach



                <br>
                <h5>IV. Data Kegiatan</h5><br>


                <h5 for="opd">Pilih OPD</h5>
                <a id="dinkesbtn" style="width:1100px;color:white " class="btn btn-primary">Dinas Kesehatan</a>

                <div id="mydinkes" action="">
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#pelita">Pelita
                                (Pemantauan
                                Balita) </a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="form_lansia">Lansia &
                                Pra-Lansia</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#ibu">Pendamping Ibu
                                Hamil</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#posyandu_balita">Posyandu
                                Balita </a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#kampung_asi">Kampung ASI</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#posbindu">Posbindu </a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="posyandu_remaja">Posyandu
                                Remaja</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#jumantik">Jumantik </a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#form_tbc">TBC & Paliatif</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab"
                                href="#kesehatan_jiwa">KesehatanJiwa</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#rumah_sehat">Rumah Sehat</a>
                        </li>

                    </ul>


                    <div class="tab-content">




                        <!-- TBC -->


                        @foreach ($tbc as $tbc)
                        <div id="form_tbc" class="tab-pane fade">
                            <h4>I. Identitas</h4>
                            <div class="form-row">

                                <div class="col">
                                    <label for="nama_siswa_tbc">Nama</label>
                                    <input type="text" class="form-control" id="nama_siswa_tbc" name="nama_siswa_tbc"
                                        value="{{$tbc->nama_siswa_tbc}}" placeholder=" Masukkan Nama">
                                </div>

                                <div class="col">
                                    <label for="umur_tbc">Umur</label>
                                    <input type="number" class="form-control" id="umur" name="umur"
                                        placeholder="Masukkan Umur" value="{{$tbc->umur_tbc}}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label for="jenis_kelamin_tbc">Jenis Kelamin</label>
                                    <select class="form-control" id="jenis_kelamin_tbc[]" name="jenis_kelamin_tbc[]">
                                        <option selected value="">Pilih Jenis Kelamin</option>
                                        <option {{ ($tbc -> jenis_kelamin_tbc) == 'laki-laki' ? 'selected' : '' }}
                                            value="laki-laki">
                                            Laki - Laki
                                        </option>
                                        <option {{ ($tbc -> jenis_kelamin_tbc) == 'perempuan' ? 'selected' : '' }}
                                            value="perempuan">
                                            Perempuan
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col form-group">
                                    <label for="alamat_tbc">Alamat</label>
                                    <input type="text" class="form-control" id="alamat_tbc" name="alamat_tbc"
                                        placeholder="Masukkan Alamat" value="{{$tbc->alamat_tbc}}">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col form-group">
                                    <label for="gejala_tbc">Gejala TBC</label><br>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Batuk
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Sesak Napas
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Berkeringat Malam Hari Tanpa Kegiatan
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Demam Meriang > 1 Bulan
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Berat Badan turun
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Nafsu Makan Kurang
                                        </label>

                                    </div>


                                    <div class="row">
                                        <div class="col">
                                            <label for="riwayat_kontak_tbc">Riwayat Kontak TBC</label>
                                            <select class="form-control" id="riwayat_kontak_tbc[]"
                                                name="riwayat_kontak_tbc[]">
                                                <option selected value="">Pilih</option>
                                                <option {{ ($tbc -> riwayat_kontak_tbc) == 'Ada' ? 'selected' : '' }}
                                                    value="ada">
                                                    Ada
                                                </option>
                                                <option
                                                    {{ ($tbc -> riwayat_kontak_tbc) == 'Tidak Ada' ? 'selected' : '' }}
                                                    value="tidak">
                                                    Tidak Ada
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <label for="status_rujukan_tbc">Status Rujukan</label>
                                            <select class="form-control" id="status_rujukan_tbc[]"
                                                name="status_rujukan_tbc[]">
                                                <option selected value="">Pilih Status</option>
                                                <option
                                                    {{ ($tbc -> status_rujukan_tbc) == 'Dirujuk' ? 'selected' : '' }}
                                                    value="ya">
                                                    Ada
                                                </option>
                                                <option
                                                    {{ ($tbc -> riwayat_kontak_tbc) == 'Tidak Dirujuk' ? 'selected' : '' }}
                                                    value="tidak">
                                                    Tidak Dirujuk
                                                </option>
                                            </select>
                                        </div>

                                        <div class="col">
                                            <label for="status_fasyankes_rujukan">Fasyankes</label>
                                            <input type="text" class="form-control" id="status_fasyankes_rujukan"
                                                name="status_fasyankes_rujukan" placeholder="Masukkan Rujukan"
                                                value="{{$tbc->status_fasyankes_rujukan}}">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col form-group">
                                            <label for="hasil_pemeriksaan">Hasil PEmeriksaan</label>
                                            <select class="form-control" id="hasil_pemeriksaan[]"
                                                name="hasil_pemeriksaan[]">
                                                <option selected value="">Pilih Hasil</option>
                                                <option
                                                    {{ ($tbc -> hasil_pemeriksaan) == 'Sakit TBC' ? 'selected' : '' }}
                                                    value="ya">
                                                    Sakit TBC
                                                </option>
                                                <option
                                                    {{ ($tbc -> hasil_pemeriksaan) == 'Tidak TBC' ? 'selected' : '' }}
                                                    value="tidak">
                                                    Tidak TBC
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="gambar">Foto Kegiatan</label>
                                        <input type="file" class="form-control-file" id="foto_tbc"
                                            placeholder="Masukkan foto" name="foto_tbc">
                                    </div>
                                </div>
                            </div>

                        </div>
                        @endforeach



                        <!-- Pelita -->

                        <div id="pelita" class="tab-pane fade show active">
                            <h6>I. Identitas</h6>

                            <input type="hidden" value="1" id="id_pelita">
                            @foreach ($pelita as $pelita)
                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <input type="number" class="form-control" id="nik_pelita" placeholder="Masukkan NIK"
                                    name="nik_pelita" value="{{$pelita->nik_pelita}}">

                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label for="nama_lengkap">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama_pelita" name="nama_pelita"
                                        placeholder=" Masukkan Nama Lengkap" value="{{$pelita->nama_pelita}}">
                                </div>
                                <div class="col">
                                    <label for="nama_lengkap">Jenis Kelamin</label>
                                    <select class="form-control" id="jenis_kelamin_pelita" name="jenis_kelamin_pelita">
                                        <option selected value="">Pilih Jenis Kelamin</option>
                                        <option {{ ($pelita -> jenis_kelamin_pelita) == 'laki-laki' ? 'selected' : '' }}
                                            value="laki-laki">
                                            Laki - Laki
                                        </option>
                                        <option {{ ($pelita -> jenis_kelamin_pelita) == 'perempuan' ? 'selected' : '' }}
                                            value="perempuan">
                                            Perempuan
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <br>

                            <div class="form-row">
                                <div class="col">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input class="form-control" id="tanggal_lahir_pelita" name="tanggal_lahir_pelita"
                                        placeholder="MM/DD/YYYY" type="date"
                                        value="{{$pelita->tanggal_lahir_pelita}}" />
                                </div>
                                <div class="col">
                                    <label for="umur">Umur</label>
                                    <input type="number" class="form-control" id="umur_pelita" name="umur_pelita"
                                        placeholder="Masukkan Umur" value="{{$pelita->umur_pelita}}">
                                </div>
                            </div>
                            <br>

                            <div class="form-row">
                                <div class="col">
                                    <label for="berat_badan">Berat Badan Lahir</label>
                                    <input type="number" class="form-control" id="bb_lahir_pelita"
                                        name="bb_lahir_pelita" placeholder=" Masukkan Berat Badan Saat Lahir"
                                        value="{{$pelita->bb_lahir_pelita}}">
                                </div>
                                <div class="col">
                                    <label for="tinggi_badan">Tinggi Badan Lahir</label>
                                    <input type="number" class="form-control" id="pb_lahir_pelita"
                                        name="pb_lahir_pelita" placeholder="Masukkan Tinggi badan Saat Lahir"
                                        value="{{$pelita->pb_lahir_pelita}}">
                                </div>
                            </div>
                            <br>

                            <div class="form-row">
                                <div class="col">
                                    <label for="berat_badan">Berat Badan Sekarang</label>
                                    <input type="number" class="form-control" id="bb_pelita" name="bb_pelita"
                                        placeholder=" Masukkan Berat Badan Sekarang" value="{{$pelita->bb_pelita}}">
                                </div>
                                <div class="col">
                                    <label for="tinggi_badan">Tinggi Badan Sekarang</label>
                                    <input type="number" class="form-control" id="pb_pelita" name="pb_pelita"
                                        placeholder="Masukkan Tinggi badan Sekarang" value="{{$pelita->pb_pelita}}">
                                </div>
                            </div>
                            <br>

                            <div class="form-row">
                                <div class="col">
                                    <label for="lila">LILA</label>
                                    <input type="text" class="form-control" id="lila_pelita" name="lila_pelita"
                                        placeholder="Masukkan LILA" value="{{$pelita->lila_pelita}}">
                                </div>
                                <div class="col">
                                    <label for="">Cara Ukur Panjang Badan</label><br>
                                    <input type="radio" name="cara_ukur_pb_pelita" value="berdiri"
                                        id="cara_ukur_pb_pelita"
                                        {{$pelita->cara_ukur_pb_pelita== 'berdiri'? 'checked' : ''}}>Berdiri
                                    <label for="berdiri">Berdiri</label><br>
                                    <input type="radio" name="cara_ukur_pb_pelita" value="tidur"
                                        id="cara_ukur_pb_pelita"
                                        {{$pelita->cara_ukur_pb_pelita== 'tidur'? 'checked' : ''}}>Tidur
                                </div>
                            </div>


                            <h6>II. Data Orang Tua</h6>


                            <div class="form-row">
                                <div class="form-group">
                                    <label for="nik">NIK Ayah</label>
                                    <input type="number" class="form-control" id="nik_ayah_pelita"
                                        placeholder="Masukkan NIK Ayah" name="nik_ayah_pelita"
                                        value="{{$pelita->nik_ayah_pelita}}">

                                </div>
                                <div class="col">
                                    <label for="nama_lengkap">Nama Lengkap Ayah</label>
                                    <input type="text" class="form-control" id="nama_ayah_pelita"
                                        name="nama_ayah_pelita" placeholder=" Masukkan Nama Lengkap Ayah"
                                        value="{{$pelita->nama_ayah_pelita}}">
                                </div>
                            </div>




                            <div class="form-row">
                                <div class="form-group">
                                    <label for="nik">NIK Ibu</label>
                                    <input type="number" class="form-control" id="nik_ibu_pelita"
                                        placeholder="Masukkan NIK Ibu" name="nik_ibu_pelita"
                                        value="{{$pelita->nik_ibu_pelita}}">

                                </div>
                                <div class="col">
                                    <label for="nama_lengkap">Nama Lengkap Ibu</label>
                                    <input type="text" class="form-control" id="nama_ibu_pelita" name="nama_ibu_pelita"
                                        placeholder=" Masukkan Nama Lengkap Ibu" value="{{$pelita->nama_ibu_pelita}}">
                                </div>
                            </div>
                            <div class="form-row">

                                <div class="col-md-10">
                                    <label for="rt">Alamat Domisili</label>
                                    <input type="text" id="alamat_domisili_pelita" name="alamat_domisili_pelita"
                                        class="form-control" placeholder="Alamat Domisili Pelita"
                                        value="{{$pelita->alamat_domisili_pelita}}">
                                </div>

                                <div class="col-md-1">

                                    <label for="rt">RT</label>
                                    <input type="number" id="rt_pelita" name="rt_pelita" class="form-control"
                                        placeholder="rt" value="{{$pelita->rt_pelita}}">

                                </div>

                                <div class="col-md-1">
                                    <label for="rt">RW</label>
                                    <input type="number" id="rw_pelita" name="rw_pelita" class="form-control"
                                        placeholder="rw" value="{{$pelita->rw_pelita}}">

                                </div>

                            </div><br><br>


                            <div class="form-row">
                                <div class="col">
                                    <label for="nama_lengkap">Alamat KTP</label>
                                    <input type="text" class="form-control" id="alamat_ktp_pelita"
                                        name="alamat_ktp_pelita" placeholder=" Masukkan Alamat KTP Pelita"
                                        value="{{$pelita->alamat_ktp_pelita}}">
                                </div>
                                <div class="form-group">
                                    <label for="nik">No Hp Orang Tua</label>
                                    <input type="number" class="form-control" id="no_hp_ortu_pelita"
                                        placeholder="Masukkan NIK" name="no_hp_ortu_pelita"
                                        value="{{$pelita->no_hp_ortu_pelita}}">

                                </div>
                            </div>

                            <h6>III. Status Balita</h6>

                            <div class="form-row">
                                <div class="col">
                                    <label for="status">Status Pelita</label>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="status_pelita"
                                            name="status_pelita" value="Asi Eks">
                                        <label>ASI Eks</label><br>
                                        <input type="checkbox" class="form-check-input" id="status_pelita"
                                            name="status_pelita" value="Vit A Biru">
                                        <label>Vit A Biru</label><br>
                                        <input type="checkbox" class="form-check-input" id="status_pelita"
                                            name="status_pelita" value="Vit A Merah">
                                        <label>Vit A Merah</label><br>
                                        <input type="checkbox" class="form-check-input" id="status_pelita"
                                            name="status_pelita" value="Tabura">
                                        <label>Tabura</label><br>
                                        <input type="checkbox" class="form-check-input" id="status_pelita"
                                            name="status_pelita" value="PMT Biskuit">
                                        <label>PMT Biskuit</label><br>
                                        <input type="checkbox" class="form-check-input" id="status_pelita"
                                            name="status_pelita" value="PMT Penyuluhan">
                                        <label>PMT Penyuluhan</label><br>
                                    </div>
                                </div>

                                <div class="col">
                                    <label for="">Perkembangan Balita (BUKU KIA)</label><br>
                                    <input type="radio" name="perkembangan_balita_pelita" value="Tidak Sesuai"
                                        id="perkembangan_balita_pelita"
                                        {{$pelita->perkembangan_balita_pelita== 'Sesuai'? 'checked' : ''}}>
                                    Sesuai
                                    <label for="berdiri">Sesuai</label><br>
                                    <input type="radio" name="perkembangan_balita_pelita" value="Tidak Sesuai"
                                        id="perkembangan_balita_pelita"
                                        {{$pelita->perkembangan_balita_pelita== 'Tidak Sesuai'? 'checked' : ''}}>Tidak
                                    Sesuai
                                    <label for="tidur">Tidak Sesuai</label><br>
                                </div>

                            </div>



                            <div class="form-group">
                                <label for="gambar">Foto Kegiatan</label>
                                <input type="file" class="form-control-file" id="foto_pelita"
                                    placeholder="Masukkan foto" name="foto_pelita">
                            </div>

                            @endforeach
                        </div>

                        <!-- KP ASI -->
                        @foreach ($kpasi as $kpasi)
                        <div id="kampung_asi" class="tab-pane fade">
                            <h4>I. Identitas</h4>
                            <input type="hidden" value="1" id="id_kpasi">
                            <div class="form-group">
                                <label for="nik">Nama</label>
                                <input type="text" class="form-control" id="nama_kpasi" placeholder="Masukkan Nama"
                                    name="nama_kpasi" value="{{$kpasi->nama_kpasi}}">

                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label for="usia_kehamilan_kpasi">Usia Kehamilan</label>
                                    <input type="number" class="form-control" id="usia_kehamilan_kpasi"
                                        name="usia_kehamilan_kpasi" placeholder=" Masukkan Usia Kehamilan"
                                        value="{{$kpasi->usia_kehamilan_kpasi}}">
                                </div>
                                <div class="col">
                                    <label for="usia_bayi_kpasi">Usia Bayi</label>
                                    <input type="number" class="form-control" id="usia_bayi_kpasi"
                                        name="usia_bayi_kpasi" placeholder=" Masukkan Usia Bayi"
                                        value="{{$kpasi->usia_bayi_kpasi}}">
                                </div>
                            </div>
                            <br>



                            <div class="form-group">
                                <label for="">NIK Ibu</label><br>
                                <input type="number" class="form-control" id="nik_ibu_kpasi"
                                    placeholder="Masukkan NIK Ibu" name="nik_ibu_kpasi"
                                    value="{{$kpasi->nik_ibu_kpasi}}">
                            </div>


                            <div class="form-group">
                                <label for="">No.HP Ibu</label><br>
                                <input type="number" class="form-control" id="no_hp_kpasi"
                                    placeholder="Masukkan No.Hp Ibu" name="no_hp_kpasi" value="{{$kpasi->no_hp_kpasi}}">
                            </div>

                            <div class="form-group">
                                <label for="">Domisili</label><br>
                                <input type="text" class="form-control" id="nama_ibu_domisili_kpasi"
                                    placeholder="Domisili" name="nama_ibu_domisili_kpasi"
                                    value="{{$kpasi->nama_ibu_domisili_kpasi}}">
                            </div>

                            <div class="form-group">
                                <label for="">Alamat Domisili</label><br>
                                <input type="text" class="form-control" id="alamat_ibu_domisili_kpasi"
                                    placeholder="Alamat Lengkap Domisili" name="alamat_ibu_domisili_kpasi"
                                    value="{{$kpasi->alamat_ibu_domisili_kpasi}}">
                            </div>


                            <div class="form-group">
                                <label for="">Alamat KTP</label><br>
                                <input type="text" class="form-control" id="alamat_ibu_ktp_kpasi"
                                    placeholder="Alamat Lengkap Sesuai KTP" name="alamat_ibu_ktp_kpasi"
                                    value="{{$kpasi->alamat_ibu_ktp_kpasi}}">
                            </div>

                            <div class="form-group">
                                <label for="Pesan">Apakah ada permasalahan yang ditemukan pada saat kunjungan?</label>
                                <textarea class="form-control" id="permasalahan_kunjungan_kpasi"
                                    name="permasalahan_kunjungan_kpasi" rows="3"
                                    value="{{$kpasi->permasalahan_kunjungan_kpasi}}"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="Pesan">Penyuluhan yang disampaikan pada saat kunjungan ?</label>
                                <textarea class="form-control" id="penyuluhan_kunjungan_kpasi"
                                    name="penyuluhan_kunjungan_kpasi" rows="3"
                                    value="{{$kpasi->penyuluhan_kunjungan_kpasi}}"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="Pesan">Apakah ibu hamil/menyusui dirujuk ke Puskesmas</label>
                                <textarea class="form-control" id="status_rujukan_kpasi" name="status_rujukan_kpasi"
                                    rows="3" value="{{$kpasi->status_rujukan_kpasi}}"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="Pesan">Penyebab ibu hamil/menyusui dirujuk ke Puskesmas</label>
                                <textarea class="form-control" id="penyebab_dirujuk_kpasi" name="penyebab_dirujuk_kpasi"
                                    rows="3" value="{{$kpasi->penyebab_dirujuk_kpasi}}"></textarea>
                            </div>


                            <div class="form-group">
                                <label for="gambar">Foto Kegiatan</label>
                                <input type="file" class="form-control-file" id="foto_rs" placeholder="Masukkan foto"
                                    name="foto_rs" value="{{$kpasi->foto_kpasi}}">
                            </div>
                        </div>
                        @endforeach

                        <!-- Ibu Hamil -->
                        @foreach ($ibuhamil as   $ibuhamil)
                        <div id="ibu" class="tab-pane fade">

                            <h4>I. Identitas</h4>
                            <div class="form-row">
                                <div class="col">
                                    <label for="nama_ibu_hamil">Nama Ibu</label>
                                    <input type="text" class="form-control" id="nama_ibu_hamil" name="nama_ibu_hamil"
                                        placeholder=" Masukkan Nama Ibu" value="{{  $ibuhamil->nama_ibu_hamil}}">
                                </div>
                                <div class="col">
                                    <label for="umur_ibu_hamil">Umur Ibu</label>
                                    <input type="number" class="form-control" id="umur" name="umur"
                                        placeholder="Masukkan Umur" value="{{  $ibuhamil->umur_ibu_hamil}}">
                                </div>
                                <div class="col">
                                    <label for="nik_ibu_hamil">NIK Ibu</label>
                                    <input type="text" class="form-control" id="nik_ibu_hamil" name="nik_ibu_hamil"
                                        placeholder="Masukkan NIK Ibu" value="{{  $ibuhamil->nama_ibu_hamil}}">
                                </div>
                            </div>
                            <br>

                            <div class="form-row">
                                <div class="col">
                                    <label for="nama_suami">Nama Suami</label>
                                    <input type="text" class="form-control" id="nama_suami" name="nama_suami"
                                        placeholder="Masukkan Nama Suami" value="{{  $ibuhamil->nama_suami}}">
                                </div>
                                <div class=" col">
                                    <label for="nik_suami">NIK Suami</label>
                                    <input type="number" class="form-control" id="nik_suami" name="nik_suami"
                                        placeholder="Masukkan NIK Suami" value="{{  $ibuhamil->nik_suami}}">
                                </div>
                            </div>
                            <br>

                            <div class="form-group">
                                <label for="alamat_ibu_hamil">Alamat Ibu</label>
                                <input type="text" class="form-control" id="alamat_ibu_hamil"
                                    placeholder="Masukkan Alamat Ibu" name="alamat_ibu_hamil"
                                    value="{{  $ibuhamil->alamat_ibu_hamil}}">
                            </div> <br>

                            <h4>II. Status Kesehatan Sekarang</h4>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="kondisi_ibu_hamil">Kondisi Ibu Hamil</label>
                                    <select class="form-control" id="kondisi_ibu_hamil" name="kondisi_ibu_hamil">
                                        <option selected value="">Pilih Kondisi Ibu Hamil</option>
                                        <option {{ (  $ibuhamil -> kondisi_ibu_hamil) == 'hamil' ? 'selected' : '' }}
                                            value="hamil"> Hamil</option>
                                        <option {{ (  $ibuhamil -> kondisi_ibu_hamil) == 'nifas' ? 'selected' : '' }}
                                            value="nifas"> Nifas </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label for="kasus_ibu_hamil">Kasus Ibu Hamil</label>
                                    <textarea class="form-control" id="kasus_ibu_hamil" name="kasus_ibu_hamil"
                                        value="{{  $ibuhamil->kasus_ibu_hamil}}" rows="3"></textarea>

                                </div>
                                <div class="col">
                                    <label for="keterangan_ibu_hamil">Keterangan Ibu Hamil</label>
                                    <textarea class="form-control" id="keterangan_ibu_hamil" name="keterangan_ibu_hamil"
                                        value="{{  $ibuhamil->keterangan_ibu_hamil}}" rows=" 3"></textarea>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="gambar">Foto Kegiatan</label>
                                <input type="file" class="form-control-file" id="foto_ibu_hamil"
                                    placeholder="Masukkan foto" name="foto_ibu_hamil">
                            </div>

                        </div>
                        @endforeach

                        <!-- Posbindu -->
                        @foreach ($posbindu as $posbindu)
                        <div id="posbindu" class="tab-pane fade">
                            <h4>I. Identitas</h4>
                            <div class="form-row">
                                <div class="col">
                                    <label for="nama_lengkap_bindu">Nama Lengkap Bindu</label>
                                    <input type="text" class="form-control" id="nama_lengkap_bindu"
                                        name="nama_lengkap_bindu" value="{{$posbindu->nama_lengkap_bindu}}"
                                        placeholder=" Masukkan Nama Lengkap Bindu">
                                </div>
                                <div class="col">
                                    <label for="nama_bindu">Nama Bindu</label>
                                    <input type="text" class="form-control" id="nama_bindu" name="nama_bindu"
                                        value="{{$posbindu->nama_bindu}}" placeholder="Masukkan Nama Bindu">
                                </div>
                                <div class="col">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select class="form-control" id="jenis_kelamin_bindu" name="jenis_kelamin_bindu">
                                        <option selected value="">Pilih Jenis Kelamin</option>
                                        <option
                                            {{ ($posbindu -> jenis_kelamin_bindu) == 'laki-laki' ? 'selected' : '' }}
                                            value="laki-laki">
                                            Laki - Laki
                                        </option>
                                        <option
                                            {{ ($posbindu -> jenis_kelamin_bindu) == 'perempuan' ? 'selected' : '' }}
                                            value="perempuan">
                                            Perempuan
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <br>


                            <div class="table">
                                <b>II. Status Kesehatan Sekarang</b>
                                <table>
                                    <thead>
                                        <td width="300px">
                                        </td>
                                        <td width="200px" style="text-align: center;"> <b><label
                                                    for="ada">Ada</label></b></td>
                                        <td width="200px" style="text-align: center;"> <b><label for="tidak">Tidak
                                                    Ada</label></b></td>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <b> <label for="riwayat_ptm_keluarga_bindu">Riwayat PTM
                                                        Keluarga</label></b>
                                            </td>

                                            <td style="text-align: center;"> <input type="radio"
                                                    id="riwayat_ptm_keluarga_bindu" name="riwayat_ptm_keluarga_bindu"
                                                    value="ada"
                                                    {{$posbindu->riwayat_ptm_keluarga_bindu == 'ada'? 'checked' : ''}}>
                                            </td>
                                            <td style="text-align: center;"><input type="radio"
                                                    id="riwayat_ptm_keluarga_bindu" name="riwayat_ptm_keluarga_bindu"
                                                    value="tidak"
                                                    {{$posbindu->riwayat_ptm_keluarga_bindu == 'tidak'? 'checked' : ''}}>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <b> <label for="riwayat_ptm_sendiri_bindu">Riwayat PTM
                                                        Sendiri</label></b>
                                            </td>
                                            <td style="text-align: center;"> <input type="radio"
                                                    id="riwayat_ptm_sendiri_bindu" name="riwayat_ptm_sendiri_bindu"
                                                    value="ada"
                                                    {{$posbindu->riwayat_ptm_sendiri_bindu == 'ada'? 'checked' : ''}}>
                                            </td>
                                            <td style="text-align: center;"> <input type="radio"
                                                    id="riwayat_ptm_sendiri_bindu" name="riwayat_ptm_sendiri_bindu"
                                                    value="tidak"
                                                    {{$posbindu->riwayat_ptm_sendiri_bindu == 'tidak'? 'checked' : ''}}>
                                            </td>
                                        </tr><br>
                                    </tbody>
                                </table>

                            </div>
                            <div class="table">

                                <b>III. Resiko PTM</b>
                                <table>
                                    <thead>
                                        <td width="300px">
                                        </td>
                                        <td style="text-align: center;" width="200px"> <b><label for="ya">Ya</label>
                                        </td></b>
                                        <td style="text-align: center;" width="200px"> <b><label
                                                    for="tidak">Tidak</label></td></b>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <b> <label for="merokok_bindu">Merokok</label></b>
                                            </td>

                                            <td style="text-align: center;"> <input type="radio" id="merokok_bindu"
                                                    name="merokok_bindu" value="ya" {{$posbindu->merokok_bindu == 'ya'?
                                                'checked' : ''}}></td>
                                            <td style="text-align: center;"> <input type="radio" id="merokok_bindu"
                                                    name="merokok_bindu" value="tidak" {{$posbindu->merokok_bindu ==
                                                'tidak'? 'checked' : ''}}></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <b> <label for="kurang_aktivitas_fisik_bindu">Kurang Aktifitas
                                                        Fisik</label></b>
                                            </td>
                                            <td style="text-align: center;"> <input type="radio"
                                                    id="kurang_aktivitas_fisik_bindu"
                                                    name="kurang_aktivitas_fisik_bindu" value="ya"
                                                    {{$posbindu->kurang_aktivitas_fisik_bindu == 'ya'? 'checked' : ''}}>
                                            </td>
                                            <td style="text-align: center;"> <input type="radio"
                                                    id="kurang_aktivitas_fisik_bindu"
                                                    name="kurang_aktivitas_fisik_bindu" value="tidak" {{$posbindu->kurang_aktivitas_fisik_bindu == 'tidak'? 'checked' :
                                                ''}}></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <b> <label for="kurang_sayur_buah_bindu">Kurang Sayur Buah</label></b>
                                            </td>

                                            <td style="text-align: center;"> <input type="radio"
                                                    id="kurang_sayur_buah_bindu" name="kurang_sayur_buah_bindu"
                                                    value="ya" {{$posbindu->kurang_sayur_buah_bindu == 'ya'? 'checked' :
                                                ''}}></td>
                                            <td style="text-align: center;"> <input type="radio"
                                                    id="kurang_sayur_buah_bindu" name="kurang_sayur_buah_bindu"
                                                    value="tidak" {{$posbindu->kurang_sayur_buah_bindu == 'tidak'?
                                                'checked' : ''}}> </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <b> <label for="konsumsi_alkohol_bindu">Konsumsi Alkohol</label></b>
                                            </td>
                                            <td style="text-align: center;"> <input type="radio"
                                                    id="konsumsi_alkohol_bindu" name="konsumsi_alkohol_bindu" value="ya"
                                                    {{$posbindu->konsumsi_alkohol_bindu == 'ya'? 'checked' : ''}}></td>
                                            <td style="text-align: center;"> <input type="radio"
                                                    id="konsumsi_alkohol_bindu" name="konsumsi_alkohol_bindu"
                                                    value="tidak" {{$posbindu->konsumsi_alkohol_bindu == 'tidak'?
                                                'checked' : ''}}></td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table">
                                <table>
                                    <thead>
                                        <td width="300px">
                                        </td>
                                        <td style="text-align: center;" width="200px"> <b><label
                                                    for="normal">Normal</label></b></td>
                                        <td style="text-align: center;" width="200px"> <b><label
                                                    for="ht">HT</label><br></b></td>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <b> <label for="tekanan_darah_bindu">Tekanan Darah </label></b>
                                            </td>
                                            <td style="text-align: center;"> <input type="radio"
                                                    id="tekanan_darah_bindu" name="tekanan_darah_bindu" value="normal"
                                                    {{$posbindu->tekanan_darah_bindu == 'normal'? 'checked' : ''}}></td>
                                            <td style="text-align: center;"> <input type="radio"
                                                    id="tekanan_darah_bindu" name="tekanan_darah_bindu" value="ht"
                                                    {{$posbindu->tekanan_darah_bindu == 'ht'? 'checked' : ''}}></td><br>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table">
                                <table>
                                    <thead>
                                        <td width="300px">
                                        </td>
                                        <td style="text-align: center;" width="200px"> <b><label
                                                    for="normal">Normal</label></td>
                                        <td style="text-align: center;" width="200px"> <b> <label
                                                    for="lebih">Lebih</label></b></td>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <b> <label for="lingkar_perut_bindu">Lingkar Perut</label></b>
                                            </td>

                                            <td style="text-align: center;"><input type="radio" id="lingkar_perut_bindu"
                                                    name="lingkar_perut_bindu" value="normal"
                                                    {{$posbindu->lingkar_perut_bindu == 'normal'? 'checked' : ''}}>
                                            </td>
                                            <td style="text-align: center;"><input type="radio" id="lingkar_perut_bindu"
                                                    name="lingkar_perut_bindu" value="lebih"
                                                    {{$posbindu->lingkar_perut_bindu == 'lebih'? 'checked' : ''}}> </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <b> <label for="gula_darah_acak_bindu">Gula Darah Acak</label></b>
                                            </td>

                                            <td style="text-align: center;"> <input type="radio"
                                                    id="gula_darah_acak_bindu" name="gula_darah_acak_bindu"
                                                    value="normal" {{$posbindu->gula_darah_acak_bindu == 'normal'?
                                                'checked' : ''}}> </td>
                                            <td style="text-align: center;"> <input type="radio"
                                                    id="gula_darah_acak_bindu" name="gula_darah_acak_bindu"
                                                    value="lebih" {{$posbindu->gula_darah_acak_bindu == 'lebih'?
                                                'checked' : ''}}> </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <b> <label for="kolestrol_bindu">Kolesterol</label></b>
                                            </td>
                                            <td style="text-align: center;"> <input type="radio" id="kolestrol_bindu"
                                                    name="kolestrol_bindu" value="normal" {{$posbindu->kolestrol_bindu ==
                                                'normal'? 'checked' : ''}}> </td>
                                            <td style="text-align: center;"><input type="radio" id="kolestrol_bindu"
                                                    name="kolestrol_bindu" value="lebih" {{$posbindu->kolestrol_bindu ==
                                                'lebih'? 'checked' : ''}}> </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <br>
                            <div class="form-group">
                                <label for="gambar">Foto Kegiatan</label>
                                <input type="file" class="form-control-file" id="foto_posbindu"
                                    placeholder="Masukkan Foto Posbindu" value="{{$posbindu->foto_posbindu}}"
                                    name="foto_posbindu">
                            </div>
                        </div>
                        @endforeach

                        <!-- Jumantik -->
                        @foreach ($jumantik as $jumantik)

                        <div id="jumantik" class="tab-pane fade">
                            <h4>I. Pemeriksaan Dalam Rumah</h4><br>
                            <div class="form-row">
                                <div class="col">
                                    <b><label for="ada" style="padding-left:280px">Ada</label><label for="tidak"
                                            style="padding-left:70px">Tidak Ada</label><br></b>

                                    <div>
                                        <label for="jentik_bak_km" style="padding-right:129px">Jentik Bak Kamar
                                            Mandi</label>

                                        <input type="radio" id="jentik_bak_km" name="jentik_bak_km" value="ada"
                                            id="jentik_bak_km" {{$jumantik->jentik_bak_km == 'ada'? 'checked' : ''}}>
                                        &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; <input
                                            type="radio" id="jentik_bak_km" name="jentik_bak_km" value="tidak"
                                            {{$jumantik->jentik_bak_km== 'tidak'? 'checked' : ''}}>
                                    </div>

                                    <div>
                                        <label for="jentik_dispenser" style="padding-right:175px">Jentik
                                            Dispenser</label>

                                        <input type="radio" id="jentik_dispenser" name="jentik_dispenser" value="ada"
                                            id="jentik_dispenser"
                                            {{$jumantik->jentik_dispenser == 'ada'? 'checked' : ''}}> &nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio"
                                            id="jentik_dispenser" name="jentik_dispenser" value="tidak"
                                            {{$jumantik->jentik_dispenser== 'tidak'? 'checked' : ''}}>
                                    </div>

                                    <div>
                                        <label for="jentik_gentong" style="padding-right:165px">Jentik
                                            di Gentong</label>

                                        <input type="radio" id="jentik_gentong" name="jentik_gentong" value="ada"
                                            id="jentik_gentong" {{$jumantik->jentik_gentong == 'ada'? 'checked' : ''}}>
                                        &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input
                                            type="radio" id="jentik_gentong" name="jentik_gentong" value="tidak"
                                            {{$jumantik->jentik_gentong== 'tidak'? 'checked' : ''}}>
                                    </div>

                                    <div>
                                        <label for="jentik_tampungan_lemari_es" style="padding-right:75px">Jentik
                                            di Tampungan Lemari Es</label>

                                        <input type="radio" id="jentik_tampungan_lemari_es"
                                            name="jentik_tampungan_lemari_es" value="ada"
                                            id="jentik_tampungan_lemari_es"
                                            {{$jumantik->jentik_tampungan_lemari_es == 'ada'? 'checked' : ''}}>
                                        &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input
                                            type="radio" id="jentik_tampungan_lemari_es"
                                            name="jentik_tampungan_lemari_es" value="tidak"
                                            {{$jumantik->jentik_tampungan_lemari_es== 'tidak'? 'checked' : ''}}>
                                    </div><br>


                                    <!-- pemeriksaan luar -->
                                    <h4>II. Pemeriksaan Luar Rumah</h4>

                                    <div class="form-row">
                                        <div class="col">
                                            <b><label for="ada" style="padding-left:280px">Ada</label><label for="tidak"
                                                    style="padding-left:70px">Tidak
                                                    Ada</label><br></b>


                                            <div>
                                                <label for="jentik_tampungan_pot_bunga"
                                                    style="padding-right:160px">Jentik
                                                    di Pot Bunga</label>

                                                <input type="radio" id="jentik_tampungan_pot_bunga"
                                                    name="jentik_tampungan_pot_bunga" value="ada"
                                                    id="jentik_tampungan_pot_bunga"
                                                    {{$jumantik->jentik_tampungan_pot_bunga == 'ada'? 'checked' : ''}}>
                                                &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                                                <input type="radio" id="jentik_tampungan_pot_bunga"
                                                    name="jentik_tampungan_pot_bunga" value="tidak"
                                                    {{$jumantik->jentik_tampungan_pot_bunga== 'tidak'? 'checked' : ''}}>
                                            </div>

                                            <div>
                                                <label for="jentik_tampungan_minum_burung"
                                                    style="padding-right:46px">Jentik
                                                    di Tampungan Minum Burung</label>

                                                <input type="radio" id="jentik_tampungan_minum_burung"
                                                    name="jentik_tampungan_minum_burung" value="ada"
                                                    id="jentik_tampungan_minum_burung"
                                                    {{$jumantik->jentik_tampungan_minum_burung == 'ada'? 'checked' : ''}}>
                                                &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <input type="radio" id="jentik_tampungan_minum_burung"
                                                    name="jentik_tampungan_minum_burung" value="tidak"
                                                    {{$jumantik->jentik_tampungan_minum_burung== 'tidak'? 'checked' : ''}}>
                                            </div>

                                            <div>
                                                <label for="jentik_tampungan_barang" style="padding-right:56px">Jentik
                                                    di Tampungan Barang Bekas</label>

                                                <input type="radio" id="jentik_tampungan_barang_bekas"
                                                    name="jentik_tampungan_barang_bekas" value="ada"
                                                    id="jentik_tampungan_barang_bekas"
                                                    {{$jumantik->jentik_tampungan_barang_bekas == 'ada'? 'checked' : ''}}>
                                                &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <input type="radio" id="jentik_tampungan_barang_bekas"
                                                    name="jentik_tampungan_barang_bekas" value="tidak"
                                                    {{$jumantik->jentik_tampungan_barang_bekas== 'tidak'? 'checked' : ''}}>
                                            </div>

                                            <div>
                                                <label for="jentik_tampungan_lubang_pohon"
                                                    style="padding-right:50px">Jentik
                                                    di Tampungan Lubang Pohon</label>

                                                <input type="radio" id="jentik_tampungan_lubang_pohon"
                                                    name="jentik_tampungan_lubang_pohon" value="ada"
                                                    id="jentik_tampungan_lubang_pohon"
                                                    {{$jumantik->jentik_tampungan_lubang_pohon == 'ada'? 'checked' : ''}}>
                                                &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                                                &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; <input type="radio"
                                                    id="jentik_tampungan_lubang_pohon"
                                                    name="jentik_tampungan_lubang_pohon" value="tidak"
                                                    {{$jumantik->jentik_tampungan_lubang_pohon== 'tidak'? 'checked' : ''}}>
                                            </div><br>

                                            <!-- penyuluhan edukasi -->
                                            <h4>III. Pelaksanaan Edukasi PSN dan 3M</h4>

                                            <div class="form-row">
                                                <div class="col">
                                                    <b><label for="ada" style="padding-left:280px">Ada</label><label
                                                            for="tidak" style="padding-left:70px">Tidak
                                                            Ada</label><br></b>

                                                    <div>
                                                        <label for="penyuluhan_psn"
                                                            style="padding-right:175px">Penyuluhan
                                                            PSN</label>

                                                        <input type="radio" id="penyuluhan_psn" name="penyuluhan_psn"
                                                            value="ada" id="penyuluhan_psn"
                                                            {{$jumantik->penyuluhan_psn == 'ada'? 'checked' : ''}}>
                                                        &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; <input type="radio"
                                                            id="penyuluhan_psn" name="penyuluhan_psn" value="tidak"
                                                            {{$jumantik->penyuluhan_psn== 'tidak'? 'checked' : ''}}>
                                                    </div>

                                                    <div>
                                                        <label for="pemahaman_3m_plus"
                                                            style="padding-right:140px">Pemahaman
                                                            3M
                                                            Plus</label>

                                                        <input type="radio" id="pemahaman_3m_plus"
                                                            name="pemahaman_3m_plus" value="ada"
                                                            {{$jumantik->pemahaman_3m_plus == 'ada'? 'checked' : ''}}>
                                                        &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; <input type="radio"
                                                            id="pemahaman_3m_plus" name="pemahaman_3m_plus"
                                                            value="tidak"
                                                            {{$jumantik->pemahaman_3m_plus== 'tidak'? 'checked' : ''}}>
                                                    </div>

                                                    <br>

                                                    <div class="form-group">
                                                        <label for="gambar">Foto
                                                            Kegiatan</label>
                                                        <input type="file" class="form-control-file" id="foto_jumantik"
                                                            placeholder="Masukkan foto" name="foto_jumantik"
                                                            value="{{$jumantik->foto_jumantik}}" method="post"
                                                            enctype="multipart/form-data">


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <!-- Rumah Sehat -->

                        @foreach($rumahsehat as $rumahsehat)
                        <div id="rumah_sehat" class="tab-pane fade">
                            <h4>I. Identitas</h4>
                            <input type="hidden" value="1" id="id_rs">
                            <div class="form-group">
                                <label for="nik">Nama KK</label>
                                <input type="number" class="form-control" id="nama_kk_rs" placeholder="Masukkan Nama KK"
                                    name="nama_kk_rs" value="{{$rumahsehat->nama_kk_rs}}">

                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label for="jumlah">Jumlah KK</label>
                                    <input type="number" class="form-control" id="jumlah_kk_rs" name="jumlah_kk_rs"
                                        placeholder="Masukkan Jumlah KK" value="{{$rumahsehat->jumlah_kk_rs}}">
                                </div>
                                <div class="col">
                                    <label for="jumlah">Jumlah Jiwa</label>
                                    <input type="number" class="form-control" id="jumlah_jiwa_rs" name="jumlah_jiwa_rs"
                                        placeholder="Masukkan Jumlah Jiwa" value="{{$rumahsehat->jumlah_jiwa_rs}}">
                                </div>
                            </div>
                            <br>

                            <div class="form-row">
                                <div class="col">
                                    <label for="nama_lengkap">Alamat</label>
                                    <input type="text" class="form-control" id="alamat_rs" name="alamat_rs"
                                        placeholder=" Masukkan Alamat" value="{{$rumahsehat->alamat_rs}}">
                                </div>
                                <div class="form-group">
                                    <label for="kecamatan">Kecamatan</label>
                                    <input type="number" class="form-control" id="kecamatan_rs"
                                        placeholder="Masukkan Kecamatan" name="kecamatan_rs"
                                        value="{{$rumahsehat->kecamatan_rs}}">

                                </div>
                            </div>

                            <div class="form-row">

                                <div class="col-md-10">
                                    <label for="rt">Kelurahan</label>
                                    <input type="text" id="kelurahan_rs" name="kelurahan_rs" class="form-control"
                                        placeholder="Kelurahan" value="{{$rumahsehat->kelurahan_rs}}">
                                </div>

                                <div class="col-md-1">

                                    <label for="rt">RT</label>
                                    <input type="number" id="rt_rs" name="rt_rs" class="form-control" placeholder="rt"
                                        value="{{$rumahsehat->rt_rs}}">

                                </div>

                                <div class="col-md-1">
                                    <label for="rt">RW</label>
                                    <input type="number" id="rw_rs" name="rw_rs" class="form-control" placeholder="rw"
                                        value="{{$rumahsehat->rw_rs}}">

                                </div>

                            </div><br><br>

                            <h4>II. Keadaan Rumah</h4>

                            <div class="form-row">
                                <div class="col">
                                    <label for="">Jendela</label><br>
                                    <input type="radio" name="jendela_rs" value="2"
                                        {{$rumahsehat->jendela_rs == '2'? 'checked' : ''}}>
                                    <label for="berdiri">Ada, memenuhi syarat</label><br>
                                    <input type="radio" name="jendela_rs" value="1"
                                        {{$rumahsehat->jendela_rs == '1'? 'checked' : ''}}>
                                    <label for="tidur">Ada, tidak memenuhi syarat</label><br>
                                    <input type="radio" name="jendela_rs" value="0"
                                        {{$rumahsehat->jendela_rs == '0'? 'checked' : ''}}>
                                    <label for="tidur">Tidak ada</label><br>

                                </div>

                                <div class="col">
                                    <label for="">Ventilasi</label><br>
                                    <input type="radio" name="ventilasi_rs" value="2"
                                        {{$rumahsehat->ventilasi_rs == '2'? 'checked' : ''}}>
                                    <label for="berdiri">Ada, memenuhi syarat</label><br>
                                    <input type="radio" name="ventilasi_rs" value="1"
                                        {{$rumahsehat->ventilasi_rs == '1'? 'checked' : ''}}>
                                    <label for="tidur">Ada, tidak memenuhi syarat</label><br>
                                    <input type="radio" name="ventilasi_rs" value="0"
                                        {{$rumahsehat->ventilasi_rs == '0'? 'checked' : ''}}>
                                    <label for="tidur">Tidak ada</label><br>
                                </div>

                            </div><br>

                            <div class="form-row">
                                <div class="col">
                                    <label for="">Pencahayaan</label><br>
                                    <input type="radio" name="pencahayaan_rs" value="2"
                                        {{$rumahsehat->pencahayaan_rs == '2'? 'checked' : ''}}>
                                    <label for="berdiri">Ada, memenuhi syarat</label><br>
                                    <input type="radio" name="pencahayaan_rs" value="1"
                                        {{$rumahsehat->pencahayaan_rs == '1'? 'checked' : ''}}>
                                    <label for="tidur">Ada, tidak memenuhi syarat</label><br>
                                    <input type="radio" name="pencahayaan_rs" value="0"
                                        {{$rumahsehat->pencahayaan_rs == '0'? 'checked' : ''}}>
                                    <label for="tidur">Tidak ada</label><br>
                                </div>

                                <div class="col">
                                    <label for="">Lubang Asap Dapur</label><br>
                                    <input type="radio" name="lad_rs" value="2"
                                        {{$rumahsehat->lad_rs == '2'? 'checked' : ''}}>
                                    <label for="berdiri">Ada, memenuhi syarat</label><br>
                                    <input type="radio" name="lad_rs" value="1"
                                        {{$rumahsehat->lad_rs == '1'? 'checked' : ''}}>
                                    <label for="tidur">Ada, tidak memenuhi syarat</label><br>
                                    <input type="radio" name="lad_rs" value="0"
                                        {{$rumahsehat->lad_rs == '0'? 'checked' : ''}}>
                                    <label for="tidur">Tidak ada</label><br>
                                </div>

                            </div><br>


                            <div class="form-row">
                                <div class="col">
                                    <label for="">Kepadatan Penghuni</label><br>
                                    <input type="radio" name="kepadatan_penghuni_rs" value="2"
                                        {{$rumahsehat->kepadatan_penghuni_rs == '2'? 'checked' : ''}}>
                                    <label for="berdiri">Tidak padat penghuni</label><br>
                                    <input type="radio" name="kepadatan_penghuni_rs" value="0"
                                        {{$rumahsehat->kepadatan_penghuni_rs == '0'? 'checked' : ''}}>
                                    <label for="tidur">Padat penghuni</label><br>
                                </div>

                                <div class="col">
                                    <label for="">Kandang Hewan Peliharaan</label><br>
                                    <input type="radio" name="khp_rs" value="2"
                                        {{$rumahsehat->khp_rs == '2'? 'checked' : ''}}>
                                    <label for="berdiri">Terpisah/tidak punya peliharaan</label><br>
                                    <input type="radio" name="khp_rs" value="0"
                                        {{$rumahsehat->khp_rs == '0'? 'checked' : ''}}>
                                    <label for="tidur">Tidak terpisah</label><br>
                                </div>

                            </div><br>


                            <div class="form-group">
                                <label for="">KONSTRUKSI RUMAH</label><br>
                                <input type="radio" name="konstruksi_rumah_rs" value="2"
                                    {{$rumahsehat->kontruksi_rumah_rs == '2'? 'checked' : ''}}>
                                <label for="berdiri">Permanen</label><br>
                                <input type="radio" name="konstruksi_rumah_rs" value="1"
                                    {{$rumahsehat->kontruksi_rumah_rs == '1'? 'checked' : ''}}>
                                <label for="tidur">Semi Permanen</label><br>
                                <input type="radio" name="konstruksi_rumah_rs" value="0"
                                    {{$rumahsehat->kontruksi_rumah_rs == '0'? 'checked' : ''}}>
                                <label for="tidur">Tidak permanen</label><br>
                            </div>
                            <br>

                            <h4>III. Sarana Sanitasi</h4>
                            <div class="form-row">
                                <div class="col">
                                    <label for="">Sarana Air Bersih (SAB)</label><br>
                                    <input type="radio" name="sab_rs" value="4"
                                        {{$rumahsehat->sab_rs == '4'? 'checked' : ''}}>
                                    <label for="berdiri">Ada, layak sebagai air bersih</label><br>
                                    <input type="radio" name="sab_rs" value="2"
                                        {{$rumahsehat->sab_rs == '2'? 'checked' : ''}}>
                                    <label for="tidur">Ada, tidak layak sebagai air bersih</label><br>
                                    <input type="radio" name="sab_rs" value="0"
                                        {{$rumahsehat->sab_rs == '0'? 'checked' : ''}}>
                                    <label for="tidur">Tidak ada</label><br>
                                </div>

                                <div class="col">
                                    <label for="">Sarana Air Minum</label><br>
                                    <input type="radio" name="sam_rs" value="4"
                                        {{$rumahsehat->sam_rs == '4'? 'checked' : ''}}>
                                    <label for="berdiri">Ada, pengelolaan baik</label><br>
                                    <input type="radio" name="sam_rs" value="2"
                                        {{$rumahsehat->sam_rs == '2'? 'checked' : ''}}>
                                    <label for="tidur">Ada, pengelolaan kurang baik</label><br>
                                    <input type="radio" name="sam_rs" value="0"
                                        {{$rumahsehat->sam_rs == '0'? 'checked' : ''}}>
                                    <label for="tidur">Tidak layak sebagai air minum</label><br>
                                </div>

                            </div><br>


                            <div class="form-group">
                                <label for="">Jamban</label><br>
                                <input type="radio" name="jamban_rs" value="4"
                                    {{$rumahsehat->jamban_rs == '4'? 'checked' : ''}}>
                                <label for="berdiri">Jamban sehat permanen</label><br>
                                <input type="radio" name="jamban_rs" value="2"
                                    {{$rumahsehat->jamban_rs == '2'? 'checked' : ''}}>
                                <label for="tidur">Jamban sehat semi permanen</label><br>
                                <input type="radio" name="jamban_rs" value="1"
                                    {{$rumahsehat->jamban_rs == '1'? 'checked' : ''}}>
                                <label for="tidur">Jamban umum/bersama</label><br>
                                <input type="radio" name="jamban_rs" value="0"
                                    {{$rumahsehat->jamban_rs == '0'? 'checked' : ''}}>
                                <label for="tidur">Buang Air Besar Sembarangan (ke got, sungai, laut dll)</label><br>
                            </div>

                            <div class="form-row">
                                <div class="col">
                                    <label for="">Sarana Pembuangan Air Limbah</label><br>
                                    <input type="radio" name="spal_rs" value="2"
                                        {{$rumahsehat->spal_rs == '2'? 'checked' : ''}}>
                                    <label for="berdiri">Ada, memenuhi syarat</label><br>
                                    <input type="radio" name="spal_rs" value="1"
                                        {{$rumahsehat->spal_rs == '1'? 'checked' : ''}}>
                                    <label for="tidur">Ada, tidak memenuhi syarat</label><br>
                                    <input type="radio" name="spal_rs" value="0"
                                        {{$rumahsehat->spal_rs == '0'? 'checked' : ''}}>
                                    <label for="tidur">Tidak ada</label><br>
                                </div>

                                <div class="col">
                                    <label for="">Tempat Sampah</label><br>
                                    <input type="radio" name="tempat_sampah_rs" value="2"
                                        {{$rumahsehat->tempat_sampah_rs == '2'? 'checked' : ''}}>
                                    <label for="berdiri">Ada, memenuhi syarat</label><br>
                                    <input type="radio" name="tempat_sampah_rs" value="1"
                                        {{$rumahsehat->tempat_sampah_rs == '1'? 'checked' : ''}}>
                                    <label for="tidur">Ada, tidak memenuhi syarat</label><br>
                                    <input type="radio" name="tempat_sampah_rs" value="0"
                                        {{$rumahsehat->tempat_sampah_rs == '0'? 'checked' : ''}}>
                                    <label for="tidur">Tidak ada</label><br>
                                </div>

                            </div><br>

                            <h4>IV. Perilaku Penghuni</h4>
                            <div class="form-row">
                                <div class="col">
                                    <label for="">Bebas Jentik</label><br>
                                    <input type="radio" name="bebas_jentik_rs" value="1"
                                        {{$rumahsehat->bebas_jentik_rs == '1'? 'checked' : ''}}>
                                    <label for="tidur">Bebas Jentik</label><br>
                                    <input type="radio" name="bebas_jentik_rs" value="0"
                                        {{$rumahsehat->bebas_jentik_rs == '0'? 'checked' : ''}}>
                                    <label for="tidur">Ada Jentik</label><br>
                                </div>
                                <div class="col">
                                    <label for="">Bebas Tikus</label><br>
                                    <input type="radio" name="bebas_tikus_rs" value="1"
                                        {{$rumahsehat->bebas_tikus_rs == '1'? 'checked' : ''}}>
                                    <label for="tidur">Bebas Tikus</label><br>
                                    <input type="radio" name="bebas_tikus_rs" value="0"
                                        {{$rumahsehat->bebas_tikus_rs == '0'? 'checked' : ''}}>
                                    <label for="tidur">Ada Tikus</label><br>
                                </div>

                            </div><br>

                            <div class="form-row">
                                <div class="col">
                                    <label for="">Membersihkan Rumah dan Halaman</label><br>
                                    <input type="radio" name="pembersihan_halaman_rs" value="1"
                                        {{$rumahsehat->pembersihan_halaman_rs == '1'? 'checked' : ''}}>
                                    <label for="tidur">Setiap hari</label><br>
                                    <input type="radio" name="pembersihan_halaman_rs" value="0"
                                        {{$rumahsehat->pembersihan_halaman_rs == '0'? 'checked' : ''}}>
                                    <label for="tidur">Kadang-Kadang</label><br>
                                </div>
                                <div class="col">
                                    <label for="">Membersihkan Tinja Bayi dan Balita</label><br>
                                    <input type="radio" name="pembersihan_tinja_rs" value="1"
                                        {{$rumahsehat->pembersihan_tinja_rs == '1'? 'checked' : ''}}>
                                    <label for="tidur">Ke jamban</label><br>
                                    <input type="radio" name="pembersihan_tinja_rs" value="0"
                                        {{$rumahsehat->pembersihan_tinja_rs == '0'? 'checked' : ''}}>
                                    <label for="tidur">Ke sungai, kebun, sembarang tempat</label><br>
                                </div>

                            </div><br>

                            <div class="form-group">
                                <label for="">Membuang Sampah</label><br>
                                <input type="radio" name="membuang_sampah_rs" value="1"
                                    {{$rumahsehat->membuang_sampah_rs == '1'? 'checked' : ''}}>
                                <label for="tidur">Ke tempat sampah</label><br>
                                <input type="radio" name="membuang_sampah_rs" value="0"
                                    {{$rumahsehat->membuang_sampah_rs == '0'? 'checked' : ''}}>
                                <label for="tidur">Ke sungai, kebun, sembarang tempat</label><br>
                            </div>


                            <div class="form-group">
                                <label for="gambar">Foto Kegiatan</label>
                                <input type="file" class="form-control-file" id="foto_rs" placeholder="Masukkan foto"
                                    name="foto_rs">
                            </div>

                        </div>
                        @endforeach




                        <!-- Kesehatan -->
                        <div id="kesehatan_jiwa" class="tab-pane fade">
                            <h7>Kesehatan Jiwa</h7>
                            <p>Membuat navigasi tabs dan pills bootstrap.</p>
                        </div>


                        <!-- lansia -->
                        <div id="form_lansia" class="tab-pane fade">
                            <h7>Lansia</h7>
                            <p>Membuat navigasi tabs dan pills bootstrap.</p>
                        </div>

                        <!-- Posyandu Balita -->
                        <div id="posyandu_balita" class="tab-pane fade">
                            <h7>posyandu balita</h7>
                            <p>Membuat navigasi tabs dan pills bootstrap.</p>
                        </div>

                        <!-- KPASI -->
                        <div id="kampung_asi" class="tab-pane fade">
                            <h7>KPASI</h7>
                            <p>Membuat navigasi tabs dan pills bootstrap.</p>
                        </div>


                        <!-- Posbindu -->
                        <div id="posbindu" class="tab-pane fade">
                            <h7>posbindu</h7>
                            <p>Membuat navigasi tabs dan pills bootstrap.</p>
                        </div>

                        <!-- posyandu remaja -->
                        <div id="posyandu_remaja" class="tab-pane fade">
                            <h7>posyandu remaja</h7>
                            <p>Membuat navigasi tabs dan pills bootstrap.</p>
                        </div>


                        <!-- rumah sehat -->
                        <div id="rumah_sehat" class="tab-pane fade">
                            <h7>rumah sehat</h7>
                            <p>Membuat navigasi tabs dan pills bootstrap.</p>
                        </div>





                    </div>
                </div><br><br>



                <div>
                    <br>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div><br>


                <script type="text/javascript">
                // add row
                $("#addRow").click(function() {
                    var html = '';
                    html += '<div id="inputFormRow">';
                    html += '<div class="form-group">';
                    html +=
                        '<div class="row"> <div class="col-md-6 form-group"> <input type="number" name="nik[]" id="nik[]" class="form-control m-input"  placeholder="NIK" autocomplete="off"></div>';
                    html +=
                        '<div class="col-md-6 form-group mt-3 mt-md-0"><input type="text"  name="nama_lengkap[]" id="nama_lengkap[]"  class="form-control m-input"    placeholder="Nama Lengkap" autocomplete="off"></div></div>';
                    html +=
                        '<div class="row"> <div class="col-md-6 form-group"> <select class="form-control" id="jenis_kelamin[]" name="jenis_kelamin[]"> <option selected>Jenis Kelamin</option>  <option value="Laki_Laki">Laki - Laki</option>  <option value="Perempuan">Perempuan </option>  </select></div>';
                    html +=
                        '<div class="col-md-6 form-group mt-3 mt-md-0"><input type="text" name="tempat_lahir[]" id="tempat_lahir[]" class="form-control m-input"     placeholder="Tempat Lahir" autocomplete="off"></div></div>';

                    html +=
                        '<div class="row"><div class="col-md-6 form-group"><input type="date" name="tanggal_lahir[]" id="tanggal_lahir[]" class="form-control m-input"     placeholder="Tanggal Lahir" autocomplete="off"></div>';

                    html +=
                        '<div class="col-md-6 form-group mt-3 mt-md-0"><input type="number" name="telp[]"   id="telp[]" class="form-control m-input" placeholder="No Telepon" autocomplete="off"></div></div>';
                    html +=
                        '<div class="row"> <div class="col-md-6 form-group"> <input type="text" name="pekerjaan[]"    id="pekerjaan[]" class="form-control m-input" placeholder="Pekerjaan"  autocomplete="off"></div>';
                    html +=
                        '<div class="col-md-6 form-group mt-3 mt-md-0"><input type="text"  name="pendidikan[]" id="pendidikan[]" class="form-control m-input"  placeholder="Pendidikan" autocomplete="off"></div></div>';
                    html +=
                        '<div class="row">  <div class="form-group col-md-12 "> <select class="form-control"  id="status_kawin[]" name="status_kawin[]"> <option selected>Status Kawin</option>  <option value="Belum Kawin">Belum Kawin</option>  <option value="Sudah Kawin">Sudah Kawin </option></select></div></div>';



                    html += '<div class="input-group-append">';
                    html +=
                        '<button id="removeRow" style="text - align: center;width:100px" type="button " class="btn btn-danger " >Hapus</button>';
                    html += '</div>';
                    html += '</div>';

                    $('#newRow').append(html);

                });

                // remove row
                $(document).on('click', '#removeRow', function() {
                    $(this).closest('#inputFormRow').remove();
                });



                $(document).ready(function() {
                    $('#dinkesbtn').click(function() {
                        $('#mydinkes').toggle(500);
                    });
                });

                $(document).ready(function() {
                    $('#dp5abtn').click(function() {
                        $('#mydp5a').toggle(500);
                    });
                });

                $(document).ready(function() {
                    $('#dkrthbtn').click(function() {
                        $('#mydkrth').toggle(500);
                    });
                });

                $(window).load(function() {
                    $("#status_penduduk").change(function() {
                        console.log($(
                                "#status_penduduk option:selected"
                            )
                            .val());
                        if ($(
                                "#status_penduduk option:selected"
                            )
                            .val() ==
                            'permanen') {
                            $('.table').prop('hidden', 'true');
                        } else {
                            $('.table').prop('hidden', false);
                        }
                    });
                });
                </script>



                <style>
                #mydinkes {
                    display: none;
                    width: 1100px;
                    border: 3px solid #ccc;
                    padding: 20px;
                    background: #ffffff;
                }

                #mydp5a {
                    display: none;
                    width: 1100px;
                    border: 3px solid #ccc;
                    padding: 40px;
                    background: #ffffff;

                }

                #mydkrth {
                    display: none;
                    width: 1100px;
                    border: 3px solid #ccc;
                    padding: 40px;
                    background: #ffffff;
                }
                </style>

            </form>

        </div>
    </div>
</div>


@endsection

@push('page-scripts')
@endpush