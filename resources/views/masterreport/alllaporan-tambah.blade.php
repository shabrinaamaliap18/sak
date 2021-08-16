@extends('layouts.master')
@section('title', 'Laravel')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class=" section-header">
                <h1>Data kegiatan</h1>
            </div>

            <form method="post" action="/alllaporan" enctype="multipart/form-data">
                @csrf

                @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                @endif


                <div class="form-row">
                    <div class="col">
                        <label for="rt">Kecamatan</label>
                        <select name="kecamatan" class="form-control" style="width:250px">
                            <option value="">--- Select Kecamatan ---</option>
                            @foreach ($kecamatan as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>

                    </div>
                </div><br>

                <div class="form-row">
                    <div class="col-md-10">
                        <label for="rt">Kelurahan</label>
                        <select name="kelurahan" class="form-control" style="width:250px">
                            <option>--- Select Kelurahan ---</option>
                        </select>
                </div>
                </div>
                <br>

                <h5>I. Lokasi Pendataan</h5>
                <div class="form-row">
                    <div class="col">
                        <label for="rt">Kecamatan</label>
                        <input type="text" id="kecamatan" name="kecamatan" class="form-control" placeholder="Kecamatan">

                    </div>
                </div><br>

                <div class="form-row">
                    <div class="col-md-10">
                        <label for="rt">Kelurahan</label>
                        <input type="text" id="kelurahan" name="kelurahan" class="form-control" placeholder="Kelurahan">
                    </div>
                    <div class="col-md-1">
                        <label for="rt">RT</label>
                        <input type="number" id="rt" name="rt" class="form-control" placeholder="rt">
                    </div>
                    <div class="col-md-1">
                        <label for="rt">RW</label>
                        <input type="number" id="rw" name="rw" class="form-control" placeholder="rw">
                    </div>
                </div><br><br>



                <h5>II. Data Keluarga</h5>
                <div class="form-row">
                    <div class="col">
                        <label for="no_kk">No. KK</label>
                        <input type="number" class="form-control" id="no_kk" name="no_kk" placeholder="Masukkan No KK"
                            id="kecamatan" name="kecamatan">
                    </div>
                    <div class="col">
                        <label for="alamat_lengkap">Alamat Lengkap</label>
                        <input type="text" class="form-control" id="alamat_lengkap" name="alamat_lengkap"
                            placeholder="Masukkan Alamat Lengkap">
                    </div>
                </div>
                <br>
                <div class="form-row">
                    <div class="col">
                        <label for="nama_kepala_kk">Nama Kepala KK</label>
                        <input type="text" class="form-control" id="nama_kepala_kk" name="nama_kepala_kk"
                            placeholder="Masukkan Nama Kepala KK">
                    </div>
                    <div class="col">
                        <label for="jumlah_anggota">Jumlah Anggota</label>
                        <input type="number" class="form-control" id="jumlah_anggota" name="jumlah_anggota"
                            placeholder="Masukkan Jumlah Anggota">
                    </div>
                </div>
                <br>

                <div class="form-group">
                    <label for="status_rumah">Status Rumah</label>
                    <select class="form-control" id="status_rumah" name="status_rumah">
                        <option selected value="">Pilih Status Rumah</option>
                        <option value="milik_sendiri">Milik_Sendiri</option>
                        <option value="sewa">Sewa</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="status_penduduk">Status Penduduk</label>
                    <select class="form-control" id="status_penduduk" name="status_penduduk">
                        <option selected value="">Pilih Status Penduduk</option>
                        <option value="permanen">Permanen</option>
                        <option value="non_permanen">Non Permanen</option>
                    </select>
                </div>

                <div class="table">
                    <div class="form-group">
                        <label for="alamat_asal">Alamat Asal</label>
                        <input type="text" id="alamat_asal" name="alamat_asal" class="form-control"
                            placeholder="Masukkan Alamat Asal">
                    </div>

                    <div class="form-group">
                        <label for="tanggal_kedatangan">Tanggal Kedatangan</label>
                        <input type="date" id="tanggal_kedatangan" name="tanggal_kedatangan" class="form-control"
                            placeholder="Masukkan Alamat Lengkap">
                    </div>
                </div>


                <h5>III. Identitas Penduduk</h5>
                <div class="row">
                    <div class="col-lg-12">
                        <div id="inputFormRow">
                            <div class="form-group">

                                <div class="row">
                                    <div class="col-md-6 form-group"><input type="number" name="nik[]" id="nik[]"
                                            class="form-control m-input" placeholder="NIK" autocomplete="off">
                                    </div>

                                    <div class="col-md-6 form-group mt-3 mt-md-0"><input type="text"
                                            name="nama_lengkap[]" id="nama_lengkap[]" class="form-control m-input"
                                            placeholder="Nama Lengkap" autocomplete="off">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <select class="form-control" id="jenis_kelamin[]" name="jenis_kelamin[]">
                                            <option selected value="">Pilih Jenis Kelamin</option>
                                            <option value="Laki_Laki">Laki - Laki</option>
                                            <option value="Perempuan">Perempuan </option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 form-group mt-3 mt-md-0"><input type="text"
                                            name="tempat_lahir[]" id="tempat_lahir[]" class="form-control m-input"
                                            placeholder="Tempat Lahir" autocomplete="off">
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6 form-group "><input type="date" name="tanggal_lahir[]"
                                            id="tanggal_lahir[]" class="form-control" class="input-group-addon"
                                            placeholder="Tanggal Lahir" autocomplete="off">
                                    </div>

                                    <div class="col-md-6 form-group mt-3 mt-md-0"><input type="number" name="telp[]"
                                            id="telp[]" class="form-control m-input" placeholder="No Telepon"
                                            autocomplete="off">
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6 form-group"><input type="text" name="pekerjaan[]"
                                            id="pekerjaan[]" class="form-control m-input" placeholder="Pekerjaan"
                                            autocomplete="off">
                                    </div>

                                    <div class="col-md-6 form-group mt-3 mt-md-0"><input type="text" name="pendidikan[]"
                                            id="pendidikan[]" class="form-control m-input" placeholder="Pendidikan"
                                            autocomplete="off">

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-12 "> <select class="form-control" id="status_kawin[]"
                                            name="status_kawin[]">
                                            <option selected value="">Pilih Status Kawin</option>
                                            <option value="Belum Kawin">Belum Kawin</option>
                                            <option value="Sudah Kawin">Sudah Kawin </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="input-group-append">
                                    <button id="removeRow" type="button" class=" btn btn-danger" style="
                                            text-align:center; width:100px">Hapus</button>
                                </div>
                            </div>
                        </div>

                        <div id="newRow"></div>
                        <button id="addRow" type="button" class="btn btn-info" style="
                                            text-align:center; width:100px">Tambah</button>
                    </div>
                </div>

                <br>
                <h5>IV. Data Kegiatan</h5><br>

                <!-- FORM DINKES -->
                <h5 for="opd">Pilih OPD</h5>
                <a id="dinkesbtn" style="color:white " class="btn btn-block btn-primary">Dinas Kesehatan</a>

                <div id="mydinkes" action="">
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#pelita">Pelita
                                (Pemantauan
                                Balita) </a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="form_lansia">Lansia &
                                Pra-Lansia</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#form_ibu_hamil">Pendamping Ibu
                                Hamil</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#posyandu_balita">Posyandu
                                Balita </a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#kampung_asi">Kampung ASI</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#posbindu">Posbindu </a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab"
                                href="posyandu_remaja">PosyanduRemaja</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#jumantik">Jumantik </a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#form_tbc">TBC & Paliatif</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab"
                                href="#kesehatan_jiwa">KesehatanJiwa</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#rumah_sehat">Rumah Sehat</a>
                        </li>

                    </ul>


                    <div class="tab-content">

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

                        <!-- Posbindu -->
                        <div id="posbindu" class="tab-pane fade">
                            <h4>I. Identitas</h4>
                            <div class="form-row">
                                <div class="col">
                                    <label for="nama_lengkap_bindu">Nama Lengkap Bindu</label>
                                    <input type="text" class="form-control" id="nama_lengkap_bindu"
                                        name="nama_lengkap_bindu" placeholder=" Masukkan Nama Lengkap Bindu">
                                </div>
                                <div class="col">
                                    <label for="nama_bindu">Nama Bindu</label>
                                    <input type="text" class="form-control" id="nama_bindu" name="nama_bindu"
                                        placeholder="Masukkan Nama Bindu">
                                </div>
                                <div class="col">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select class="form-control" id="jenis_kelamin_bindu" name="jenis_kelamin_bindu">
                                        <option selected value="">Pilih Jenis Kelamin</option>
                                        <option value="laki-laki">Laki - Laki</option>
                                        <option value="perempuan">Perempuan </option>
                                    </select>
                                </div>
                            </div>
                            
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
                                                    value="ada">
                                            </td>
                                            <td style="text-align: center;"><input type="radio"
                                                    id="riwayat_ptm_keluarga_bindu" name="riwayat_ptm_keluarga_bindu"
                                                    value="tidak">
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <b> <label for="riwayat_ptm_sendiri_bindu">Riwayat PTM
                                                        Sendiri</label></b>
                                            </td>
                                            <td style="text-align: center;"> <input type="radio"
                                                    id="riwayat_ptm_sendiri_bindu" name="riwayat_ptm_sendiri_bindu"
                                                    value="ada">
                                            </td>
                                            <td style="text-align: center;"> <input type="radio"
                                                    id="riwayat_ptm_sendiri_bindu" name="riwayat_ptm_sendiri_bindu"
                                                    value="tidak">
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
                                                    name="merokok_bindu" value="ya"></td>
                                            <td style="text-align: center;"> <input type="radio" id="merokok_bindu"
                                                    name="merokok_bindu" value="tidak"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <b> <label for="kurang_aktivitas_fisik_bindu">Kurang Aktifitas
                                                        Fisik</label></b>
                                            </td>
                                            <td style="text-align: center;"> <input type="radio"
                                                    id="kurang_aktivitas_fisik_bindu"
                                                    name="kurang_aktivitas_fisik_bindu" value="ya"></td>
                                            <td style="text-align: center;"> <input type="radio"
                                                    id="kurang_aktivitas_fisik_bindu"
                                                    name="kurang_aktivitas_fisik_bindu" value="tidak"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <b> <label for="kurang_sayur_buah_bindu">Kurang Sayur Buah</label></b>
                                            </td>

                                            <td style="text-align: center;"> <input type="radio"
                                                    id="kurang_sayur_buah_bindu" name="kurang_sayur_buah_bindu"
                                                    value="ya"></td>
                                            <td style="text-align: center;"> <input type="radio"
                                                    id="kurang_sayur_buah_bindu" name="kurang_sayur_buah_bindu"
                                                    value="tidak"> </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <b> <label for="konsumsi_alkohol_bindu">Konsumsi Alkohol</label></b>
                                            </td>
                                            <td style="text-align: center;"> <input type="radio"
                                                    id="konsumsi_alkohol_bindu" name="konsumsi_alkohol_bindu"
                                                    value="ya"></td>
                                            <td style="text-align: center;"> <input type="radio"
                                                    id="konsumsi_alkohol_bindu" name="konsumsi_alkohol_bindu"
                                                    value="tidak"></td>

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
                                                    id="tekanan_darah_bindu" name="tekanan_darah_bindu" value="normal">
                                            </td>
                                            <td style="text-align: center;"> <input type="radio"
                                                    id="tekanan_darah_bindu" name="tekanan_darah_bindu" value="ht"></td>
                                            <br>
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
                                                    name="lingkar_perut_bindu" value="normal"> </td>
                                            <td style="text-align: center;"><input type="radio" id="lingkar_perut_bindu"
                                                    name="lingkar_perut_bindu" value="lebih"> </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <b> <label for="gula_darah_acak_bindu">Gula Darah Acak</label></b>
                                            </td>

                                            <td style="text-align: center;"> <input type="radio"
                                                    id="gula_darah_acak_bindu" name="gula_darah_acak_bindu"
                                                    value="normal"> </td>
                                            <td style="text-align: center;"> <input type="radio"
                                                    id="gula_darah_acak_bindu" name="gula_darah_acak_bindu"
                                                    value="lebih"> </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <b> <label for="kolestrol_bindu">Kolesterol</label></b>
                                            </td>
                                            <td style="text-align: center;"> <input type="radio" id="kolestrol_bindu"
                                                    name="kolestrol_bindu" value="normal"> </td>
                                            <td style="text-align: center;"><input type="radio" id="kolestrol_bindu"
                                                    name="kolestrol_bindu" value="lebih"> </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <br>
                            <div class="form-group">
                                <label for="gambar">Foto Kegiatan</label>
                                <input type="file" class="form-control-file" id="foto_posbindu"
                                    placeholder="Masukkan Foto Posbindu" name="foto_posbindu">
                            </div>
                        </div>



                        <!-- Posyandu Remaja -->
                        <div id="posyandu_remaja" class="tab-pane fade">

                            <h4>I. Identitas</h4>
                            <input type="hidden" value="1" id="id_posyandu">
                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <input type="number" class="form-control" id="nik_remaja" placeholder="Masukkan NIK "
                                    name="nik_remaja">
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label for="nama_lengkap">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama_lengkap_remaja"
                                        name="nama_lengkap_remaja" placeholder=" Masukkan Nama Lengkap">
                                </div>
                                <div class="col">
                                    <label for="umur">Umur</label>
                                    <input type="number" class="form-control" id="umur" name="umur"
                                        placeholder="Masukkan Umur">
                                </div>
                            </div>
                            <br>

                            <div class="form-row">
                                <div class="col">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="tempat_lahir_remaja"
                                        name="tempat_lahir_remaja" placeholder="Masukkan Tempat Lahir">
                                </div>
                                <div class="col">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input class="form-control" id="tanggal_lahir_remaja" name="tanggal_lahir_remaja"
                                        placeholder="MM/DD/YYYY" type="date" />
                                </div>
                            </div>
                            <br>

                            <div class="form-group">
                                <label for="no_telp">No. Telepon</label>
                                <input type="text" class="form-control" id="telp_remaja"
                                    placeholder="Masukkan No Telepon " name="telp_remaja">

                            </div><br>

                            <h6>II. Status Kesehatan Sekarang</h6>
                            <div class="form-row">
                                <div class="col">
                                    <label for="keluhan_utama">Keluhan Utama</label>
                                    <input type="text" id="keluhan_utama" name="keluhan_utama" class="form-control"
                                        placeholder="Masukkan Keluhan Utama">
                                </div>
                                <div class="col">
                                    <label for="cara_mengatasi">Cara Mengatasi Keluhan</label>
                                    <input type="text" class="form-control" id="cara_mengatasi" name="cara_mengatasi"
                                        placeholder="Cara Mengatasi Keluhan">
                                </div>
                            </div>
                            <br>

                            <div class="form-group">
                                <label for="obat_obatan">Obat-Obatan</label>
                                <input type="text" class="form-control " id="obat_obatan" placeholder="Masukkan Obat"
                                    name="obat_obatan">

                            </div><br>

                            <h6>III. Asesmen Gizi</h6>
                            <div class="form-row">
                                <div class="col">
                                    <label for="berat_badan">Berat Badan</label>
                                    <input type="number" class="form-control" id="berat_badan" name="berat_badan"
                                        placeholder=" Masukkan Berat Badan">
                                </div>
                                <div class="col">
                                    <label for="tinggi_badan">Tinggi Badan</label>
                                    <input type="number" class="form-control" id="tinggi_badan" name="tinggi_badan"
                                        placeholder="Masukkan Tinggi badan">
                                </div>
                            </div>
                            <br>


                            <div class="form-row">
                                <div class="col">
                                    <label for="lila">LILA</label>
                                    <input type="text" class="form-control" id="lila" name="lila"
                                        placeholder="Masukkan LILA">
                                </div>
                                <div class="col">
                                    <label for="anemia">Anemia</label>
                                    <input type="text" class="form-control" id="anemia" name="anemia"
                                        placeholder="Masukkan Anemia">
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="gambar">Foto Kegiatan</label>
                                <input type="file" class="form-control-file" id="foto_kegiatan"
                                    placeholder="Masukkan foto" name="foto_kegiatan">
                            </div>

                        </div>

                        <!-- Ibu Hamil -->
                        <div id="form_ibu_hamil" class="tab-pane fade">

                            <h4>I. Identitas</h4>
                            <div class="form-row">
                                <div class="col">
                                    <label for="nama_ibu_hamil">Nama Ibu</label>
                                    <input type="text" class="form-control" id="nama_ibu_hamil" name="nama_ibu_hamil"
                                        placeholder=" Masukkan Nama Ibu">
                                </div>
                                <div class="col">
                                    <label for="umur_ibu_hamil">Umur Ibu</label>
                                    <input type="number" class="form-control" id="umur" name="umur"
                                        placeholder="Masukkan Umur">
                                </div>
                                <div class="col">
                                    <label for="nik_ibu_hamil">NIK Ibu</label>
                                    <input type="text" class="form-control" id="nik_ibu_hamil" name="nik_ibu_hamil"
                                        placeholder="Masukkan NIK Ibu">
                                </div>
                            </div>
                            <br>

                            <div class="form-row">
                                <div class="col">
                                    <label for="nama_suami">Nama Suami</label>
                                    <input type="text" class="form-control" id="nama_suami" name="nama_suami"
                                        placeholder="Masukkan Nama Suami">
                                </div>
                                <div class="col">
                                    <label for="nik_suami">NIK Suami</label>
                                    <input type="number" class="form-control" id="nik_suami" name="nik_suami"
                                        placeholder="Masukkan NIK Suami">
                                </div>
                            </div>
                            <br>

                            <div class="form-group">
                                <label for="alamat_ibu_hamil">Alamat Ibu</label>
                                <input type="text" class="form-control" id="alamat_ibu_hamil"
                                    placeholder="Masukkan Alamat Ibu" name="alamat_ibu_hamil">
                            </div> <br>
                            <h4>II. Status Kesehatan Sekarang</h4>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="kondisi_ibu_hamil">Kondisi Ibu Hamil</label>
                                    <select class="form-control" id="kondisi_ibu_hamil" name="kondisi_ibu_hamil">
                                        <option selected value="">Pilih Kondisi Ibu Hamil</option>
                                        <option value="hamil">Hamil</option>
                                        <option value="nifas">Nifas </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label for="kasus_ibu_hamil">Kasus Ibu Hamil</label>
                                    <textarea class="form-control" id="kasus_ibu_hamil" name="kasus_ibu_hamil"
                                        rows="3"></textarea>

                                </div>
                                <div class="col">
                                    <label for="keterangan_ibu_hamil">Keterangan Ibu Hamil</label>
                                    <textarea class="form-control" id="keterangan_ibu_hamil" name="keterangan_ibu_hamil"
                                        rows="3"></textarea>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="gambar">Foto Kegiatan</label>
                                <input type="file" class="form-control-file" id="foto_ibu_hamil"
                                    placeholder="Masukkan foto" name="foto_ibu_hamil">
                            </div>
                        </div>

                        <!-- Pelita -->
                        <div id="pelita" class="tab-pane fade show active">
                            <h4>I. Identitas</h4>
                            <input type="hidden" value="1" id="id_pelita">
                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <input type="number" class="form-control" id="nik_pelita" placeholder="Masukkan NIK"
                                    name="nik_pelita">

                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label for="nama_lengkap">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama_pelita" name="nama_pelita"
                                        placeholder=" Masukkan Nama Lengkap">
                                </div>
                                <div class="col">
                                    <label for="nama_lengkap">Jenis Kelamin</label>
                                    <select class="form-control" id="jenis_kelamin_pelita" name="jenis_kelamin_pelita">
                                        <option selected value="">Pilih Jenis Kelamin</option>
                                        <option value="Laki_Laki">Laki - Laki</option>
                                        <option value="Perempuan">Perempuan </option>
                                    </select>
                                </div>
                            </div>
                            <br>

                            <div class="form-row">
                                <div class="col">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input class="form-control" id="tanggal_lahir_pelita" name="tanggal_lahir_pelita"
                                        placeholder="MM/DD/YYYY" type="date" />
                                </div>
                                <div class="col">
                                    <label for="umur">Umur</label>
                                    <input type="number" class="form-control" id="umur_pelita" name="umur_pelita"
                                        placeholder="Masukkan Umur">
                                </div>
                            </div>
                            <br>

                            <div class="form-row">
                                <div class="col">
                                    <label for="berat_badan">Berat Badan Lahir</label>
                                    <input type="number" class="form-control" id="bb_lahir_pelita"
                                        name="bb_lahir_pelita" placeholder=" Masukkan Berat Badan Saat Lahir">
                                </div>
                                <div class="col">
                                    <label for="tinggi_badan">Tinggi Badan Lahir</label>
                                    <input type="number" class="form-control" id="pb_lahir_pelita"
                                        name="pb_lahir_pelita" placeholder="Masukkan Tinggi badan Saat Lahir">
                                </div>
                            </div>
                            <br>

                            <div class="form-row">
                                <div class="col">
                                    <label for="berat_badan">Berat Badan Sekarang</label>
                                    <input type="number" class="form-control" id="bb_pelita" name="bb_pelita"
                                        placeholder=" Masukkan Berat Badan Sekarang">
                                </div>
                                <div class="col">
                                    <label for="tinggi_badan">Tinggi Badan Sekarang</label>
                                    <input type="number" class="form-control" id="pb_pelita" name="pb_pelita"
                                        placeholder="Masukkan Tinggi badan Sekarang">
                                </div>
                            </div>
                            <br>

                            <div class="form-row">
                                <div class="col">
                                    <label for="lila">LILA</label>
                                    <input type="text" class="form-control" id="lila_pelita" name="lila_pelita"
                                        placeholder="Masukkan LILA">
                                </div>
                                <div class="col">
                                    <label for="">Cara Ukur Panjang Badan</label><br>
                                    <input type="radio" name="cara_ukur_pb_pelita" value="Berdiri">
                                    <label for="berdiri">Berdiri</label><br>
                                    <input type="radio" name="cara_ukur_pb_pelita" value="Tidur">
                                    <label for="tidur">Tidur</label><br>
                                </div>
                            </div>


                            <h4>II. Data Orang Tua</h4>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="nik">NIK Ayah</label>
                                    <input type="number" class="form-control" id="nik_ayah_pelita"
                                        placeholder="Masukkan NIK Ayah" name="nik_ayah_pelita">

                                </div>
                                <div class="col">
                                    <label for="nama_lengkap">Nama Lengkap Ayah</label>
                                    <input type="text" class="form-control" id="nama_ayah_pelita"
                                        name="nama_ayah_pelita" placeholder=" Masukkan Nama Lengkap Ayah">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="nik">NIK Ibu</label>
                                    <input type="number" class="form-control" id="nik_ibu_pelita"
                                        placeholder="Masukkan NIK Ibu" name="nik_ibu_pelita">
                                </div>
                                <div class="col">
                                    <label for="nama_lengkap">Nama Lengkap Ibu</label>
                                    <input type="text" class="form-control" id="nama_ibu_pelita" name="nama_ibu_pelita"
                                        placeholder=" Masukkan Nama Lengkap Ibu">
                                </div>
                            </div>
                            <div class="form-row">

                                <div class="col-md-10">
                                    <label for="rt">Alamat Domisili</label>
                                    <input type="text" id="alamat_domisili_pelita" name="alamat_domisili_pelita"
                                        class="form-control" placeholder="Alamat Domisili Pelita">
                                </div>

                                <div class="col-md-1">

                                    <label for="rt">RT</label>
                                    <input type="number" id="rt_pelita" name="rt_pelita" class="form-control"
                                        placeholder="rt">

                                </div>

                                <div class="col-md-1">
                                    <label for="rt">RW</label>
                                    <input type="number" id="rw_pelita" name="rw_pelita" class="form-control"
                                        placeholder="rw">

                                </div>

                            </div><br><br>


                            <div class="form-row">
                                <div class="col">
                                    <label for="nama_lengkap">Alamat KTP</label>
                                    <input type="text" class="form-control" id="alamat_ktp_pelita"
                                        name="alamat_ktp_pelita" placeholder=" Masukkan Alamat KTP Pelita">
                                </div>
                                <div class="form-group">
                                    <label for="nik">No Hp Orang Tua</label>
                                    <input type="number" class="form-control" id="no_hp_ortu_pelita"
                                        placeholder="Masukkan NIK" name="no_hp_ortu_pelita">

                                </div>
                            </div>

                            <h4>III. Satus Balita</h4>

                            <div class="form-row">
                                <div class="col">
                                    <label for="status">Status Pelita</label>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="status_pelita[]"
                                            name="status_pelita[]" value="Asi Eks">
                                        <label>ASI Eks</label><br>
                                        <input type="checkbox" class="form-check-input" id="status_pelita[]"
                                            name="status_pelita[]" value="Vit A Biru">
                                        <label>Vit A Biru</label><br>
                                        <input type="checkbox" class="form-check-input" id="status_pelita[]"
                                            name="status_pelita[]" value="Vit A Merah">
                                        <label>Vit A Merah</label><br>
                                        <input type="checkbox" class="form-check-input" id="status_pelita[]"
                                            name="status_pelita[]" value="Tabura">
                                        <label>Tabura</label><br>
                                        <input type="checkbox" class="form-check-input" id="status_pelita[]"
                                            name="status_pelita[]" value="PMT Biskuit">
                                        <label>PMT Biskuit</label><br>
                                        <input type="checkbox" class="form-check-input" id="status_pelita[]"
                                            name="status_pelita[]" value="PMT Penyuluhan">
                                        <label>PMT Penyuluhan</label><br>
                                    </div>
                                </div>

                                <div class="col">
                                    <label for="">Perkembangan Balita (BUKU KIA)</label><br>
                                    <input type="radio" name="perkembangan_balita_pelita" value="Sesuai">
                                    <label for="berdiri">Sesuai</label><br>
                                    <input type="radio" name="perkembangan_balita_pelita" value="Tidak Sesuai">
                                    <label for="tidur">Tidak Sesuai</label><br>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="gambar">Foto Kegiatan</label>
                                <input type="file" class="form-control-file" id="foto_pelita"
                                    placeholder="Masukkan foto" name="foto_pelita">
                            </div>

                        </div>

                        <!-- Rumah Sehat -->
                        <div id="rumah_sehat" class="tab-pane fade">
                            <h4>I. Identitas</h4>
                            <input type="hidden" value="1" id="id_rs">
                            <div class="form-group">
                                <label for="nik">Nama KK</label>
                                <input type="number" class="form-control" id="nama_kk_rs" placeholder="Masukkan Nama KK"
                                    name="nama_kk_rs">

                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label for="jumlah">Jumlah KK</label>
                                    <input type="number" class="form-control" id="jumlah_kk_rs" name="jumlah_kk_rs"
                                        placeholder="Masukkan Jumlah KK">
                                </div>
                                <div class="col">
                                    <label for="jumlah">Jumlah Jiwa</label>
                                    <input type="number" class="form-control" id="jumlah_jiwa_rs" name="jumlah_jiwa_rs"
                                        placeholder="Masukkan Jumlah Jiwa">
                                </div>
                            </div>
                            <br>

                            <div class="form-row">
                                <div class="col">
                                    <label for="nama_lengkap">Alamat</label>
                                    <input type="text" class="form-control" id="alamat_rs" name="alamat_rs"
                                        placeholder=" Masukkan Alamat">
                                </div>
                                <div class="form-group">
                                    <label for="kecamatan">Kecamatan</label>
                                    <input type="number" class="form-control" id="kecamatan_rs"
                                        placeholder="Masukkan Kecamatan" name="kecamatan_rs">

                                </div>
                            </div>

                            <div class="form-row">

                                <div class="col-md-10">
                                    <label for="rt">Kelurahan</label>
                                    <input type="text" id="kelurahan_rs" name="kelurahan_rs" class="form-control"
                                        placeholder="Kelurahan">
                                </div>

                                <div class="col-md-1">

                                    <label for="rt">RT</label>
                                    <input type="number" id="rt_rs" name="rt_rs" class="form-control" placeholder="rt">

                                </div>

                                <div class="col-md-1">
                                    <label for="rt">RW</label>
                                    <input type="number" id="rw_rs" name="rw_rs" class="form-control" placeholder="rw">

                                </div>

                            </div><br><br>

                            <h4>II. Keadaan Rumah</h4>

                            <div class="form-row">
                                <div class="col">
                                    <label for="">Jendela</label><br>
                                    <input type="radio" name="jendela_rs" value="2">
                                    <label for="berdiri">Ada, memenuhi syarat</label><br>
                                    <input type="radio" name="jendela_rs" value="1">
                                    <label for="tidur">Ada, tidak memenuhi syarat</label><br>
                                    <input type="radio" name="jendela_rs" value="0">
                                    <label for="tidur">Tidak ada</label><br>
                                </div>

                                <div class="col">
                                    <label for="">Ventilasi</label><br>
                                    <input type="radio" name="ventilasi_rs" value="2">
                                    <label for="berdiri">Ada, memenuhi syarat</label><br>
                                    <input type="radio" name="ventilasi_rs" value="1">
                                    <label for="tidur">Ada, tidak memenuhi syarat</label><br>
                                    <input type="radio" name="ventilasi_rs" value="0">
                                    <label for="tidur">Tidak ada</label><br>
                                </div>

                            </div><br>

                            <div class="form-row">
                                <div class="col">
                                    <label for="">Pencahayaan</label><br>
                                    <input type="radio" name="pencahayaan_rs" value="2">
                                    <label for="berdiri">Ada, memenuhi syarat</label><br>
                                    <input type="radio" name="pencahayaan_rs" value="1">
                                    <label for="tidur">Ada, tidak memenuhi syarat</label><br>
                                    <input type="radio" name="pencahayaan_rs" value="0">
                                    <label for="tidur">Tidak ada</label><br>
                                </div>

                                <div class="col">
                                    <label for="">Lubang Asap Dapur</label><br>
                                    <input type="radio" name="lad_rs" value="2">
                                    <label for="berdiri">Ada, memenuhi syarat</label><br>
                                    <input type="radio" name="lad_rs" value="1">
                                    <label for="tidur">Ada, tidak memenuhi syarat</label><br>
                                    <input type="radio" name="lad_rs" value="0">
                                    <label for="tidur">Tidak ada</label><br>
                                </div>

                            </div><br>


                            <div class="form-row">
                                <div class="col">
                                    <label for="">Kepadatan Penghuni</label><br>
                                    <input type="radio" name="kepadatan_penghuni_rs" value="2">
                                    <label for="berdiri">Tidak padat penghuni</label><br>
                                    <input type="radio" name="kepadatan_penghuni_rs" value="0">
                                    <label for="tidur">Padat penghuni</label><br>
                                </div>

                                <div class="col">
                                    <label for="">Kandang Hewan Peliharaan</label><br>
                                    <input type="radio" name="khp_rs" value="2">
                                    <label for="berdiri">Terpisah/tidak punya peliharaan</label><br>
                                    <input type="radio" name="khp_rs" value="0">
                                    <label for="tidur">Tidak terpisah</label><br>
                                </div>

                            </div><br>


                            <div class="form-group">
                                <label for="">KONSTRUKSI RUMAH</label><br>
                                <input type="radio" name="konstruksi_rumah_rs" value="2">
                                <label for="berdiri">Permanen</label><br>
                                <input type="radio" name="konstruksi_rumah_rs" value="1">
                                <label for="tidur">Semi Permanen</label><br>
                                <input type="radio" name="konstruksi_rumah_rs" value="0">
                                <label for="tidur">Tidak permanen</label><br>
                            </div>
                            <br>

                            <h4>III. Sarana Sanitasi</h4>
                            <div class="form-row">
                                <div class="col">
                                    <label for="">Sarana Air Bersih (SAB)</label><br>
                                    <input type="radio" name="sab_rs" value="4">
                                    <label for="berdiri">Ada, layak sebagai air bersih</label><br>
                                    <input type="radio" name="sab_rs" value="2">
                                    <label for="tidur">Ada, tidak layak sebagai air bersih</label><br>
                                    <input type="radio" name="sab_rs" value="0">
                                    <label for="tidur">Tidak ada</label><br>
                                </div>

                                <div class="col">
                                    <label for="">Sarana Air Minum</label><br>
                                    <input type="radio" name="sam_rs" value="4">
                                    <label for="berdiri">Ada, pengelolaan baik</label><br>
                                    <input type="radio" name="sam_rs" value="2">
                                    <label for="tidur">Ada, pengelolaan kurang baik</label><br>
                                    <input type="radio" name="sam_rs" value="0">
                                    <label for="tidur">Tidak layak sebagai air minum</label><br>
                                </div>

                            </div><br>


                            <div class="form-group">
                                <label for="">Jamban</label><br>
                                <input type="radio" name="jamban_rs" value="4">
                                <label for="berdiri">Jamban sehat permanen</label><br>
                                <input type="radio" name="jamban_rs" value="2">
                                <label for="tidur">Jamban sehat semi permanen</label><br>
                                <input type="radio" name="jamban_rs" value="1">
                                <label for="tidur">Jamban umum/bersama</label><br>
                                <input type="radio" name="jamban_rs" value="0">
                                <label for="tidur">Buang Air Besar Sembarangan (ke got, sungai, laut dll)</label><br>
                            </div>

                            <div class="form-row">
                                <div class="col">
                                    <label for="">Sarana Pembuangan Air Limbah</label><br>
                                    <input type="radio" name="spal_rs" value="2">
                                    <label for="berdiri">Ada, memenuhi syarat</label><br>
                                    <input type="radio" name="spal_rs" value="1">
                                    <label for="tidur">Ada, tidak memenuhi syarat</label><br>
                                    <input type="radio" name="spal_rs" value="0">
                                    <label for="tidur">Tidak ada</label><br>
                                </div>

                                <div class="col">
                                    <label for="">Tempat Sampah</label><br>
                                    <input type="radio" name="tempat_sampah_rs" value="2">
                                    <label for="berdiri">Ada, memenuhi syarat</label><br>
                                    <input type="radio" name="tempat_sampah_rs" value="1">
                                    <label for="tidur">Ada, tidak memenuhi syarat</label><br>
                                    <input type="radio" name="tempat_sampah_rs" value="0">
                                    <label for="tidur">Tidak ada</label><br>
                                </div>

                            </div><br>

                            <h4>IV. Perilaku Penghuni</h4>
                            <div class="form-row">
                                <div class="col">
                                    <label for="">Bebas Jentik</label><br>
                                    <input type="radio" name="bebas_jentik_rs" value="1">
                                    <label for="tidur">Bebas Jentik</label><br>
                                    <input type="radio" name="bebas_jentik_rs" value="0">
                                    <label for="tidur">Ada Jentik</label><br>
                                </div>
                                <div class="col">
                                    <label for="">Bebas Tikus</label><br>
                                    <input type="radio" name="bebas_tikus_rs" value="1">
                                    <label for="tidur">Bebas Tikus</label><br>
                                    <input type="radio" name="bebas_tikus_rs" value="0">
                                    <label for="tidur">Ada Tikus</label><br>
                                </div>

                            </div><br>

                            <div class="form-row">
                                <div class="col">
                                    <label for="">Membersihkan Rumah dan Halaman</label><br>
                                    <input type="radio" name="pembersihan_halaman_rs" value="1">
                                    <label for="tidur">Setiap hari</label><br>
                                    <input type="radio" name="pembersihan_halaman_rs" value="0">
                                    <label for="tidur">Kadang-Kadang</label><br>
                                </div>
                                <div class="col">
                                    <label for="">Membersihkan Tinja Bayi dan Balita</label><br>
                                    <input type="radio" name="pembersihan_tinja_rs" value="1">
                                    <label for="tidur">Ke jamban</label><br>
                                    <input type="radio" name="pembersihan_tinja_rs" value="0">
                                    <label for="tidur">Ke sungai, kebun, sembarang tempat</label><br>
                                </div>

                            </div><br>

                            <div class="form-group">
                                <label for="">Membuang Sampah</label><br>
                                <input type="radio" name="membuang_sampah_rs" value="1">
                                <label for="tidur">Ke tempat sampah</label><br>
                                <input type="radio" name="membuang_sampah_rs" value="0">
                                <label for="tidur">Ke sungai, kebun, sembarang tempat</label><br>
                            </div>


                            <div class="form-group">
                                <label for="gambar">Foto Kegiatan</label>
                                <input type="file" class="form-control-file" id="foto_rs" placeholder="Masukkan foto"
                                    name="foto_rs">
                            </div>

                        </div>

                        <!-- KP ASI -->
                        <div id="kampung_asi" class="tab-pane fade">
                            <h4>I. Identitas</h4>
                            <input type="hidden" value="1" id="id_kpasi">
                            <div class="form-group">
                                <label for="nik">Nama</label>
                                <input type="text" class="form-control" id="nama_kpasi" placeholder="Masukkan Nama"
                                    name="nama_kpasi">

                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label for="usia_kehamilan_kpasi">Usia Kehamilan</label>
                                    <input type="number" class="form-control" id="usia_kehamilan_kpasi"
                                        name="usia_kehamilan_kpasi" placeholder=" Masukkan Usia Kehamilan">
                                </div>
                                <div class="col">
                                    <label for="usia_bayi_kpasi">Usia Bayi</label>
                                    <input type="number" class="form-control" id="usia_bayi_kpasi"
                                        name="usia_bayi_kpasi" placeholder=" Masukkan Usia Bayi">
                                </div>
                            </div>
                            <br>



                            <div class="form-group">
                                <label for="">NIK Ibu</label><br>
                                <input type="number" class="form-control" id="nik_ibu_kpasi"
                                    placeholder="Masukkan NIK Ibu" name="nik_ibu_kpasi">
                            </div>


                            <div class="form-group">
                                <label for="">No.HP Ibu</label><br>
                                <input type="number" class="form-control" id="no_hp_kpasi"
                                    placeholder="Masukkan No.Hp Ibu" name="no_hp_kpasi">
                            </div>

                            <div class="form-group">
                                <label for="">Domisili</label><br>
                                <input type="text" class="form-control" id="nama_ibu_domisili_kpasi"
                                    placeholder="Domisili" name="nama_ibu_domisili_kpasi">
                            </div>

                            <div class="form-group">
                                <label for="">Alamat Domisili</label><br>
                                <input type="text" class="form-control" id="alamat_ibu_domisili_kpasi"
                                    placeholder="Alamat Lengkap Domisili" name="alamat_ibu_domisili_kpasi">
                            </div>


                            <div class="form-group">
                                <label for="">Alamat KTP</label><br>
                                <input type="text" class="form-control" id="alamat_ibu_ktp_kpasi"
                                    placeholder="Alamat Lengkap Sesuai KTP" name="alamat_ibu_ktp_kpasi">
                            </div>

                            <div class="form-group">
                                <label for="Pesan">Apakah ada permasalahan yang ditemukan pada saat kunjungan?</label>
                                <textarea class="form-control" id="permasalahan_kunjungan_kpasi"
                                    name="permasalahan_kunjungan_kpasi" rows="3"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="Pesan">Penyuluhan yang disampaikan pada saat kunjungan ?</label>
                                <textarea class="form-control" id="penyuluhan_kunjungan_kpasi"
                                    name="penyuluhan_kunjungan_kpasi" rows="3"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="Pesan">Apakah ibu hamil/menyusui dirujuk ke Puskesmas</label>
                                <textarea class="form-control" id="status_rujukan_kpasi" name="status_rujukan_kpasi"
                                    rows="3"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="Pesan">Penyebab ibu hamil/menyusui dirujuk ke Puskesmas</label>
                                <textarea class="form-control" id="penyebab_dirujuk_kpasi" name="penyebab_dirujuk_kpasi"
                                    rows="3"></textarea>
                            </div>


                            <div class="form-group">
                                <label for="gambar">Foto Kegiatan</label>
                                <input type="file" class="form-control-file" id="foto_kpasi" placeholder="Masukkan foto"
                                    name="foto_kpasi">
                            </div>
                        </div>

                        <!-- TBC -->
                        <div id="form_tbc" class="tab-pane fade">
                            <h4>I. Identitas</h4>
                            <div class="form-row">
                                <div class="col">
                                    <label for="nama_siswa_tbc">Nama</label>
                                    <input type="text" class="form-control" id="nama_siswa_tbc" name="nama_siswa_tbc"
                                        placeholder=" Masukkan Nama">
                                </div>

                                <div class="col">
                                    <label for="umur_tbc">Umur</label>
                                    <input type="number" class="form-control" id="umur" name="umur"
                                        placeholder="Masukkan Umur">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col form-group">
                                    <label for="jenis_kelamin_tbc">Jenis Kelamin</label>
                                    <select class="form-control" id="jenis_kelamin_tbc" name="jenis_kelamin_tbc">
                                        <option selected value="">Pilih Jenis Kelamin</option>
                                        <option value="laki_laki">Laki_Laki</option>
                                        <option value="perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col form-group">
                                    <label for="alamat_tbc">Alamat</label>
                                    <input type="text" class="form-control" id="alamat_tbc" name="alamat_tbc"
                                        placeholder="Masukkan Alamat">
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
                                        <div class="col form-group">
                                            <label for="riwayat_kontak_tbc">Riwayat Kontak dengan Pasien TBC</label>
                                            <select class="form-control" id="riwayat_kontak_tbc"
                                                name="riwayat_kontak_tbc">
                                                <option selected value="">Pilih</option>
                                                <option value="ada">Ada</option>
                                                <option value="tidak">Tidak Ada</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <label for="status_rujukan_tbc">Status Rujukan</label>
                                            <select class="form-control" id="status_rujukan_tbc"
                                                name="status_rujukan_tbc">
                                                <option selected value="">Pilih Status</option>
                                                <option value="ya">Dirujuk</option>
                                                <option value="tidak">Tidak Dirujuk</option>
                                            </select>
                                        </div>


                                        <div class="col">
                                            <label for="status_fasyankes_rujukan">Fasyankes</label>
                                            <input type="text" class="form-control" id="status_fasyankes_rujukan"
                                                name="status_fasyankes_rujukan" placeholder="Masukkan Rujukan">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col form-group">
                                            <label for="hasil_pemeriksaan">Hasil Pemeriksaan</label>
                                            <select class="form-control" id="hasil_pemeriksaan"
                                                name="hasil_pemeriksaan">
                                                <option selected value="">Pilih Hasil</option>
                                                <option value="ya">Sakit TBC</option>
                                                <option value="tidak">Tidak TBC</option>
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

                                               <!-- jemantik -->
                                               <div id="jumantik" class="tab-pane fade">

<div class="table">

        <b>I. Pemeriksaan Dalam Rumah</b>
        <table>
            <thead>
                <td width="300px">
                </td>
                <td style="text-align: center;" width="200px"> <b><label for="ada">Ada</label></td></b>
                <td style="text-align: center;" width="200px"> <b><label for="tidak">Tidak Ada</label></td></b>
            </thead>

            <tbody>
                <tr>
                    <td>
                       <label for="jentik_bak_km">Jentik Bak Kamar Mandi</label>
                    </td>

                    <td style="text-align: center;"> <input type="radio" id="jentik_bak_km" name="jentik_bak_km" value="ada"></td>
                    <td style="text-align: center;"> <input type="radio" id="jentik_bak_km" name="jentik_bak_km" value="tidak"></td>
                </tr>

                <tr>
                    <td>
                       <label for="jentik_dispenser">Jentik Dispenser</label>
                    </td>

                    <td style="text-align: center;"> <input type="radio" id="jentik_dispenser" name="jentik_dispenser" value="ada"></td>
                    <td style="text-align: center;"> <input type="radio" id="jentik_dispenser" name="jentik_dispenser" value="tidak"></td>
                </tr>

                <tr>
                    <td>
                       <label for="jentik_gentong">Jentik di Gentong</label>
                    </td>

                    <td style="text-align: center;"> <input type="radio" id="jentik_gentong" name="jentik_gentong" value="ada"></td>
                    <td style="text-align: center;"> <input type="radio" id="jentik_gentong" name="jentik_gentong" value="tidak"></td>
                </tr>

                <tr>
                    <td>
                       <label for="jentik_tampungan_lemari_es">Jentik di
                    Tampungan Lemari ES</label>
                    </td>

                    <td style="text-align: center;"> <input type="radio" id="jentik_tampungan_lemari_es" name="jentik_tampungan_lemari_es" value="ada"></td>
                    <td style="text-align: center;"> <input type="radio" id="jentik_tampungan_lemari_es" name="jentik_tampungan_lemari_es" value="tidak"></td>
                </tr>

                </tbody>
        </table>
    </div>

    <!-- pemeriksaan luar -->
    
    <div class="table">
        <b>II. Pemeriksaan Luar Rumah</b>
        <table>
            <thead>
                <td width="300px">
                </td>
                <td style="text-align: center;" width="200px"> <b><label for="ya">Ya</label></td></b>
                <td style="text-align: center;" width="200px"> <b><label for="tidak">Tidak</label></td></b>
            </thead>

            <tbody>
                <tr>
                    <td>
                       <label for="jentik_tampungan_pot_bunga">Jentik di Pot Bunga</label>
                    </td>

                    <td style="text-align: center;"> <input type="radio" id="jentik_tampungan_pot_bunga" name="jentik_tampungan_pot_bunga" value="ada"></td>
                    <td style="text-align: center;"> <input type="radio" id="jentik_tampungan_pot_bunga" name="jentik_tampungan_pot_bunga" value="tidak"></td>
                </tr>

                <tr>
                    <td>
                       <label for="jentik_tampungan_minum_burung">Jentik di Tampungan Minum Burung</label>
                    </td>

                    <td style="text-align: center;"><input type="radio" id="jentik_tampungan_minum_burung" name="jentik_tampungan_minum_burung" value="ada"></td>
                    <td style="text-align: center;"><input type="radio" id="jentik_tampungan_minum_burung" name="jentik_tampungan_minum_burung" value="tidak"></td>
                </tr>

                <tr>
                    <td>
                       <label for="jentik_tampungan_barang">Jentik
                            di Tampungan Barang Bekas</label>
                    </td>

                    <td style="text-align: center;"><input type="radio" id="jentik_tampungan_barang" name="jentik_tampungan_barang" value="ada"></td>
                    <td style="text-align: center;"><input type="radio" id="jentik_tampungan_barang" name="jentik_tampungan_barang" value="tidak"></td>
                </tr>

                <tr>
                    <td>
                       <label for="jentik_tampungan_lubang_pohon">Jentik di Tampungan Lubang Pohon</label>
                    </td>

                    <td style="text-align: center;"><input type="radio" id="jentik_tampungan_lubang_pohon" name="jentik_tampungan_lubang_pohon" value="ada"></td>
                    <td style="text-align: center;"><input type="radio" id="jentik_tampungan_lubang_pohon" name="jentik_tampungan_lubang_pohon" value="tidak"></td>
                </tr>

                </tbody>
                </table>
                </div>

            <!-- Penyuluhan Edukasi -->
    
            <div class="table">
                <b>III. Pelaksanaan Edukasi PSN dan 3M</b>
                <table>
                    <thead>
                        <td width="300px">
                        </td>
                        <td style="text-align: center;" width="200px"> <b><label for="ya">Ya</label></td></b>
                        <td style="text-align: center;" width="200px"> <b><label for="tidak">Tidak</label></td></b>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                            <label for="penyuluhan_psn">Penyuluhan PSN</label>
                            </td>

                            <td style="text-align: center;"><input type="radio" id="penyuluhan_psn" name="penyuluhan_psn" value="ada"></td>
                            <td style="text-align: center;"><input type="radio" id="penyuluhan_psn" name="penyuluhan_psn" value="tidak"></td>
                        </tr>

                        <tr>
                            <td>
                            <label for="pemahaman_3m_plus">Pemahaman 3M Plus</label>
                            </td>

                            <td style="text-align: center;"><input type="radio" id="pemahaman_3m_plus" name="pemahaman_3m_plus" value="ada"></td>
                            <td style="text-align: center;"><input type="radio" id="pemahaman_3m_plus" name="pemahaman_3m_plus" value="tidak"></td>
                        </tr>

                        </tbody>
                    </table>
             </div>
    <div class="form-group">
        <label for="gambar">Foto Kegiatan</label>
        <input type="file" class="form-control-file" id="foto_jumantik" placeholder="Masukkan Foto Jumantik" name="foto_jumantik">
    </div>
    </div>

                        <!-- Kesehatan -->
                        <div id="kesehatan_jiwa" class="tab-pane fade">
                            <h7>Kesehatan Jiwa</h7>
                            <p>Membuat navigasi tabs dan pills bootstrap.</p>
                        </div>
                    </div>
                </div><br><br>

                <!-- FORM DP5A -->

                <a id="dp5abtn" style="color:white " class="btn btn-block btn-primary">DP5A</a>
                <div id="mydp5a" action="">

                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#kader_ipm">Kader
                                IPM</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#satgas_pbkm">Satgas
                                PBKM</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#satgas_ppa">Satgas
                                PPA</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div id="kader_ipm" class="tab-pane fade show active">
                            <input type="hidden" value="3" name="id_satgas_pbkm">
                            <div class="form-row">
                                <div class="col">
                                    <label for="nik">NIK</label>
                                    <input type="number" class="form-control" id="nik_satgas" name="nik_satgas"
                                        placeholder="
                                            Masukkan NIK">
                                </div>
                                <div class="col">
                                    <label for="nama_lengkap">Nama Lengkap</label>
                                    <input type="text" id="nama_lengkap_satgas" name="nama_lengkap_satgas"
                                        class=" form-control" placeholder="Masukkan Nama Lengkap">
                                </div>
                            </div>
                            <br>


                            <div class="form-row">
                                <div class="col">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="tempat_lahir_satgas"
                                        name="tempat_lahir_satgas" placeholder="Masukkan Tempat Lahir">
                                </div>
                                <div class="col">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input class="form-control" id="tanggal_lahir_satgas" name="tanggal_lahir_satgas"
                                        placeholder="MM/DD/YYYY" type="date" />
                                </div>
                            </div>
                            <br>
                            <div class="form-row">
                                <div class="col">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select class="form-control" id="jenis_kelamin_satgas" name="jenis_kelamin_satgas">
                                        <option selected value="">Pilih Jenis Kelamin</option>
                                        <option value="laki-laki">Laki-Laki</option>
                                        <option value="perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="no_telp">No. Telepon</label>
                                    <input type="number" class="form-control" id="telp_satgas" name="telp_satgas"
                                        placeholder="Masukkan No Telpon">
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="pendidikan">Pendidikan</label>
                                <input type="text" class="form-control" id="pendidikan_satgas"
                                    placeholder="Masukkan Pendidikan" name="pendidikan_satgas">
                            </div><br>
                            <div class="form-group">
                                <label for="gambar">Foto Kegiatan</label>
                                <input type="file" class="form-control-file" id="foto_pbkm" placeholder="Masukkan foto"
                                    name="foto_pbkm">
                            </div>

                        </div><br>
                        <div id="satgas_pbkm" class="tab-pane fade">
                            <h7>Satgas PBKM</h7>
                            <p>tes dulu</p>
                        </div>
                        <div id="satgas_ppa" class="tab-pane fade">
                            <h7>Satgas PPA</h7>
                            <p>ini ppa</p>
                        </div>
                    </div>
                </div><br><br>






                <!-- FORM DKRTH -->



                <a id="dkrthbtn" style="color:white " class="btn btn-block btn-primary">DKRTH</a>
                <div id="mydkrth">
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a class="nav-link active" data-toggle="tab"
                                href="#fasil_lingkungan">Fasilitator
                                Lingkungan</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#form_lain">Form
                                Lain</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#lain_juga">Lain
                                Juga</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div id="fasil_lingkungan" class="tab-pane fade show active">
                            <input type="hidden" value="2" name="id_fasil">
                            <div class="form-row">
                                <div class="col">
                                    <label for="nik">NIK</label>
                                    <input type="number" class="form-control" id="nik_fasil" name="nik_fasil"
                                        placeholder="Masukkan NIK">
                                </div>
                                <div class="col">
                                    <label for="nama_lengkap">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama_lengkap_fasil"
                                        name="nama_lengkap_fasil" placeholder="Masukkan Nama Lengkap">
                                </div>
                            </div>
                            <br>


                            <div class="form-row">
                                <div class="col">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="tempat_lahir_fasil"
                                        name="tempat_lahir_fasil" placeholder="Masukkan Tempat Lahir">
                                </div>
                                <div class="col">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input class="form-control" id="tanggal_lahir_fasil" name="tanggal_lahir_fasil"
                                        placeholder="MM/DD/YYYY" type="date" />
                                </div>
                            </div>
                            <br>

                            <div class="form-row">
                                <div class="col">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select class="form-control" id="jenis_kelamin_fasil" name="jenis_kelamin_fasil">
                                        <option selected value="">Pilih Jenis Kelamin</option>
                                        <option value="laki-laki">Laki-Laki</option>
                                        <option value="perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="no_telp">No. Telepon</label>
                                    <input type="number" id="telp_fasil" name="telp_fasil" class=" form-control"
                                        placeholder="Masukkan No Telpon">
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="pendidikan">Pendidikan</label>
                                <input type="text" class="form-control" id="pendidikan_fasil"
                                    placeholder="Masukkan Pendidikan" name="pendidikan_fasil">
                            </div><br>
                            <div class="form-group">
                                <label for="gambar">Foto Kegiatan</label>
                                <input type="file" class="form-control-file" id="foto_kegiatan_fasil"
                                    placeholder="Masukkan foto" name="foto_kegiatan_fasil">
                            </div>
                        </div>
                        <br>
                        <div id="form_lain" class="tab-pane fade">
                            <h7>Satgas PBKM</h7>
                            <p>tes dulu</p>
                        </div>
                        <div id="lain_juga" class="tab-pane fade">
                            <h7>Satgas PPA</h7>
                            <p>ini ppa</p>
                        </div>
                    </div>
                </div>

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
                    var last = $('#inputFormRow').length;
                    if (last == 1) {
                        alert("you can not remove last row");
                    } else {
                        $(this).closest('#inputFormRow').remove();
                    }


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
                        console.log($("#status_penduduk option:selected").val());
                        if ($("#status_penduduk option:selected").val() == 'permanen') {
                            $('.table').prop('hidden', 'true');
                        } else {
                            $('.table').prop('hidden', false);
                        }


                    });
                });

               
               
                jQuery(document).ready(function() {
                    jQuery('select[name="kecamatan"]').on('change', function() {
                        var mainID = jQuery(this).val();
                        if (mainID) {
                            jQuery.ajax({
                                url: 'tambah/getkelurahan/' + mainID,
                                type: "GET",
                                dataType: "json",
                                success: function(data) {
                                    console.log(data);
                                    jQuery('select[name="kelurahan"]').empty();
                                    jQuery.each(data, function(key, value) {
                                        $('select[name="kelurahan"]').append(
                                            '<option value="' +
                                            key + '">' + value + '</option>');
                                    });
                                }
                            });
                        } else {
                            $('select[name="kelurahan"]').empty();
                        }
                    });
                });
            
              
               
        </script>



                <style>
                #mydinkes {
                    display: none;

                    border: 3px solid #ccc;
                    padding: 20px;
                    background: #ffffff;
                }

                #mydp5a {
                    display: none;

                    border: 3px solid #ccc;
                    padding: 40px;
                    background: #ffffff;

                }

                #mydkrth {
                    display: none;

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