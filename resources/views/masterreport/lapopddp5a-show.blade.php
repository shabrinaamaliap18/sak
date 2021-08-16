@extends('layouts.master')
@section('title', 'Laravel')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class=" section-header">
                <h1>Laporan Kegiatan</h1>
            </div>

            <div class="card">
                <div class="card-body">


                    <div class="row mt-1">
                        <div class="col-md-4 form-group">
                            <div class="card-subtitle mb-4"><span class="span">ID Laporan <class
                                        style="padding-left:50px;"> : </span>
                                {{$forms->id}}
                            </div>

                            <div class="card-subtitle mb-4"><span class="span">Nomor KK <class
                                        style="padding-left:56px;">: </span>
                                {{$forms->no_kk}}
                            </div>

                            <div class="card-subtitle mb-4"><span class="span">Tanggal Input <class
                                        style="padding-left:32px;">: </span>
                                {{$forms->created_at}}
                            </div>

                            @foreach($pegawai as $p)
                            @if ($loop->first)
                            <div class="card-subtitle mb-4"><span class="span">Diinput Oleh <class
                                        style="padding-left:40px;">: </span>
                                {{$p->nama_pegawai}}
                            </div>
                            @endif
                            @endforeach

                        </div><br>


                        @if ($forms->status == "Menunggu Verifikasi OPD")
                        <div class="col-md-4 form-group">
                            <form method="post" action="/lapopddp5a/teruskan/{{$forms->id}}"
                                enctype=" multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <input type="hidden" value="{{$forms->id}}" id="id_form" name="id_form">
                                <input type="hidden" value="Honor Diverifikasi" id="keputusan_honor"
                                    name="keputusan_honor">
                                @foreach ($keputusan as $keputusan)
                                <label>Keputusan Anda : </label>
                                @if ($keputusan->keputusan_dp5a == "1")
                                <span class="badge badge-success">Terima</span><br>
                                @endif
                                @if ($keputusan->keputusan_dp5a== "0")
                                <span class="badge badge-danger">Tolak</span><br>
                                @endif
                                @endforeach
                                <label>Teruskan ke : </label>
                                <select class="form-control" id="status" name="status" required>
                                    <option selected value="">Pilih Status</option>
                                    <option value="1">Terima</option>
                                    <option value="0">Tolak</option>
                                </select>
                                <br>
                                <input type="hidden" value="{{$forms->status}}" id="keputusan_dp5a"
                                    name="keputusan_dp5a">
                                <div class="form-group">
                                    <label for="Pesan">Pesan</label>
                                    <textarea class="form-control" id="keterangan" name="keterangan"
                                        rows="3"></textarea>
                                </div>

                                <button type="submit" class="btn btn-success">Teruskan</button>
                        </div>

                        @elseif ($forms->status == "Menunggu Verifikasi OPD Lain")
                        <div class="col-md-4 form-group">
                            <form method="post" action="/lapopddp5a/teruskan/{{$forms->id}}"
                                enctype=" multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <input type="hidden" value="{{$forms->id}}" id="id_form" name="id_form">
                                <input type="hidden" value="Honor Diverifikasi" id="keputusan_honor"
                                    name="keputusan_honor">
                                @foreach ($keputusan as $keputusan)
                                <label>Keputusan Anda : </label>
                                @if ($keputusan->keputusan_dp5a == "1")
                                <span class="badge badge-success">Terima</span><br>
                                @endif
                                @if ($keputusan->keputusan_dp5a == "0")
                                <span class="badge badge-danger">Tolak</span><br>
                                @endif
                                @endforeach
                                <label>Teruskan ke : </label>
                                <select class="form-control" id="status" name="status" required>
                                    <option selected value="">Pilih Status</option>
                                    <option value="1">Terima</option>
                                    <option value="0">Tolak</option>
                                </select>
                                <br>
                                <input type="hidden" value="{{$forms->status}}" id="keputusan_dp5a"
                                    name="keputusan_dp5a">
                                <div class="form-group">
                                    <label for="Pesan">Pesan</label>
                                    <textarea class="form-control" id="keterangan" name="keterangan"
                                        rows="3"></textarea>
                                </div>


                                <button type="submit" class="btn btn-success">Teruskan</button>
                        </div>




                        @elseif ($forms->status == "Verifikasi Diterima")
                        <div class="col-md-4 form-group">
                            <form method="post" action="/lapopddp5a/teruskanhonor/{{$forms->id}}"
                                enctype=" multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <input type="hidden" value="{{$forms->id}}" id="id_form" name="id_form">
                                <input type="hidden" value="Honor Diverifikasi" id="keputusan_honor"
                                    name="keputusan_honor">
                                @foreach ($keputusan as $keputusan)
                                <label>Keputusan Anda : </label>
                                @if ($keputusan->keputusan_dp5a== "1")
                                <span class="badge badge-success">Terima</span><br>
                                @endif
                                @if ($keputusan->keputusan_dp5a == "0")
                                <span class="badge badge-danger">Tolak</span><br>
                                @endif
                                @endforeach
                                <label>Teruskan ke Verifikasi Honor </label>
                                @foreach ($tim2 as $tim2)
                                <input type="hidden" value="{{$tim2->master_pegawai}}" id="id_penerima[]"
                                    name="id_penerima[]">
                                @endforeach

                                <label><b>Disclaimer!</b> Perhatikan Bahwa Laporan sudah diisi dengan benar dan siap
                                    untuk dilaporkan!</label>

                                <button type="submit" class="btn btn-success">Teruskan</button>
                            </form>
                        </div>

                        @elseif ($forms->status == "Verifikasi Ditolak")
                        <div class="col-md-4 form-group">
                            <form method="post" action="/lapopddp5a/revisi/{{$forms->id}}"
                                enctype=" multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <input type="hidden" value="{{$forms->id}}" id="id_form" name="id_form">
                                <input type="hidden" value="Honor Diverifikasi" id="keputusan_honor"
                                    name="keputusan_honor">
                                @foreach ($keputusan as $keputusan)
                                <label>Keputusan Anda : </label>
                                @if ($keputusan->keputusan_dp5a== "1")
                                <span class="badge badge-success">Terima</span><br>
                                @endif
                                @if ($keputusan->keputusan_dp5a == "0")
                                <span class="badge badge-danger">Tolak</span><br>
                                @endif
                                @endforeach
                                <label>Teruskan ke Proses Revisi</label>
                                @foreach ($pegawai as $pegawai)
                                <input type="hidden" value="{{$pegawai->id}}" id="pegawai_id[]" name="pegawai_id[]">
                                @endforeach

                                <label><b>Disclaimer!</b> Perhatikan Bahwa Laporan sudah diisi dengan benar dan siap
                                    untuk dilaporkan!</label>

                                <button type="submit" class="btn btn-success">Teruskan</button>
                            </form>
                        </div>

                        @endif






                        <div class="col-md-4 form-group">
                            <div class="card-subtitle mb-4"><span class="span"> Status Laporan : </span>
                                {{$forms->status}}
                            </div>

                        </div><br>




                    </div>

                </div>


            </div>

            </form>

            <a id="historybtn" style="color:white " class="btn btn-warning btn-block">History</a>
            <div id="history" action="">
                <div class="table-wrapper" style="width: 100%">
                    <div class="md-card-content" style="overflow-x: auto;">

                        <table class="table">
                            <thead class="table table-hover">
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Judul</th>
                                    <th scope="col">Nama Proses</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Tanggal ACC</th>
                                    <th scope="col">Tanggal Riwayat</th>
                                    <th scope="col">Nama Pegawai</th>
                                    <th scope="col">Jabatan</th>
                                    <th scope="col">Tujuan</th>


                                </tr>
                            </thead>


                            <tbody>
                                @foreach($history as $as)

                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{ $as->judul}}</td>
                                    <td>{{ $as->nama_proses}}</td>
                                    <td>{{ $as->keterangan}}</td>
                                    <td>{{ $as->tanggal_acc}}</td>
                                    <td>{{ $as->date_time}}</td>
                                    <td>{{ $as->nama_pegawai}}</td>
                                    <td>{{ $as->jabatan}}</td>
                                    <td>{{ str_replace(array('[','"',']'),'',$user->where('id', $as->id_penerima)->pluck('jabatan'))}}
                                    </td>


                                </tr>

                                @endforeach
                            </tbody>


                        </table>
                    </div>
                </div>
            </div>
            <br><br>



            <h5> Form Kartu Keluarga </h5>
            <table class="table table-light">

                <tbody>
                    <tr>
                        <td>Kecamatan</td>
                        <td>&nbsp;&nbsp;:</td>
                        <td>&nbsp;&nbsp;{{$forms->kecamatan}}</td>
                    </tr>

                    <tr>
                        <td>Kelurahan</td>
                        <td>&nbsp;&nbsp;:</td>
                        <td>&nbsp;&nbsp;{{$forms->kelurahan}}</td>

                    </tr>
                    <tr>
                        <td>RT</td>
                        <td>&nbsp;&nbsp;:</td>
                        <td>&nbsp;&nbsp;{{$forms->rt}}</td>
                    </tr>

                    <tr>
                        <td>RW</td>
                        <td>&nbsp;&nbsp;:</td>
                        <td>&nbsp;&nbsp;{{$forms->rw}}</td>
                    </tr>

                    <tr>
                        <td>Jumlah Anggota</td>
                        <td>&nbsp;&nbsp;:</td>
                        <td>&nbsp;&nbsp;{{$forms->jumlah_anggota}}</td>
                    </tr>

                    <tr>
                        <td>Status Rumah</td>
                        <td>&nbsp;&nbsp;:</td>
                        <td>&nbsp;&nbsp;{{$forms->status_rumah}}</td>
                    </tr>

                    <tr>
                        <td>Status Penduduk</td>
                        <td>&nbsp;&nbsp;:</td>
                        <td>&nbsp;&nbsp;{{$forms->status_penduduk}}</td>
                    </tr>

                    <tr>
                        <td>Tanggal Kedatangan</td>
                        <td>&nbsp;&nbsp;:</td>
                        <td>&nbsp;&nbsp;{{$forms->tanggal_kedatangan}}</td>
                    </tr>

                </tbody>
            </table class="table table-light">
            <br>
            <br>
            <h5> Form Penduduk </h5>
            <table>
                <tbody>
                    @foreach($penduduk as $penduduk)
                    <th scope="row"><br> Anggota Keluarga &nbsp;{{$loop->iteration}}</th>
                    <tr>
                        <td>NIK</td>
                        <td>
                        <td>
                        <td>
                        <td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                        <td>&nbsp;&nbsp;{{$penduduk->nik}}</td>
                    </tr>

                    <tr>
                        <td>Nama Lengkap</td>
                        <td>
                        <td>
                        <td>
                        <td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                        <td>&nbsp;&nbsp;{{$penduduk->nama_lengkap}}</td>
                    </tr>

                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>
                        <td>
                        <td>
                        <td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                        <td>&nbsp;&nbsp;{{$penduduk->jenis_kelamin}}</td>
                    </tr>

                    <tr>
                        <td>Tempat Lahir</td>
                        <td>
                        <td>
                        <td>
                        <td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                        <td>&nbsp;&nbsp;{{$penduduk->tempat_lahir}}</td>
                    </tr>

                    <tr>
                        <td>No Telepon</td>
                        <td>
                        <td>
                        <td>
                        <td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                        <td>&nbsp;&nbsp;{{$penduduk->telp}}</td>
                    </tr>

                    <tr>
                        <td>Pekerjaan</td>
                        <td>
                        <td>
                        <td>
                        <td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                        <td>&nbsp;&nbsp;{{$penduduk->pekerjaan}}</td>
                    </tr>

                    <tr>
                        <td>Pendidikan</td>
                        <td>
                        <td>
                        <td>
                        <td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                        <td>&nbsp;&nbsp;{{$penduduk->pendidikan}}</td>
                    </tr>

                    <tr>
                        <td>Status Kawin</td>
                        <td>
                        <td>
                        <td>
                        <td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                        <td>&nbsp;&nbsp;{{$penduduk->status_kawin}}</td>
                    </tr>
                    @endforeach

                </tbody>
            </table>




            <br>
            <h5>Data Kegiatan</h5><br>

            <h6 for="opd">Pilih OPD</h6>

            <a id="dinkesbtn" style="color:white " class="btn btn-primary btn-block">Dinas
                Kesehatan</a>
            <div id="mydinkes" action="">


                <ul class="nav nav-tabs">
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#posyandu_remaja">Posyandu
                            Remaja</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#jemantik">Jemantik</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#kesehatan_jiwa">Kesehatan
                            Jiwa</a></li>
                </ul>
                <br>
                <div class="tab-content">
                    <!-- Posyandu Remaja -->

                    <div id="posyandu_remaja" class="tab-pane fade show active">
                        <h6>I. Identitas</h6>
                        <table>
                            <tbody>
                                @foreach($posyandu as $posyandu)
                                <tr>
                                    <td>NIK</td>
                                    <td>
                                    <td>
                                    <td>
                                    <td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                                    <td>&nbsp;&nbsp;{{$posyandu->nik_remaja}}</td>
                                </tr>

                                <tr>
                                    <td>Nama Lengkap</td>
                                    <td>
                                    <td>
                                    <td>
                                    <td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                                    <td>&nbsp;&nbsp;{{$posyandu->nama_lengkap_remaja}}</td>
                                </tr>

                                <tr>
                                    <td>Tempat Lahir</td>
                                    <td>
                                    <td>
                                    <td>
                                    <td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                                    <td>&nbsp;&nbsp;{{$posyandu->tempat_lahir_remaja}}</td>
                                </tr>

                                <tr>
                                    <td>Tanggal Lahir</td>
                                    <td>
                                    <td>
                                    <td>
                                    <td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                                    <td>&nbsp;&nbsp;{{$posyandu->tanggal_lahir_remaja}}</td>
                                </tr>

                                <tr>
                                    <td>Umur</td>
                                    <td>
                                    <td>
                                    <td>
                                    <td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                                    <td>&nbsp;&nbsp;{{$posyandu->umur}}</td>
                                </tr>

                                <tr>
                                    <td>No Telepon</td>
                                    <td>
                                    <td>
                                    <td>
                                    <td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                                    <td>&nbsp;&nbsp;{{$posyandu->telp_remaja}}</td>
                                </tr>
                            </tbody>
                        </table><br>

                        <h6>II. Status Kesehatan Sekarang</h6>
                        <table>
                            <tbody>
                                <tr>
                                    <td>Keluhan Utama</td>
                                    <td>
                                    <td>
                                    <td>
                                    <td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                                    <td>&nbsp;&nbsp;{{$posyandu->keluhan_utama}}</td>
                                </tr>

                                <tr>
                                    <td>Cara Mengatasi</td>
                                    <td>
                                    <td>
                                    <td>
                                    <td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                                    <td>&nbsp;&nbsp;{{$posyandu->cara_mengatasi}}</td>
                                </tr>

                                <tr>
                                    <td>Obat - obatan</td>
                                    <td>
                                    <td>
                                    <td>
                                    <td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                                    <td>&nbsp;&nbsp;{{$posyandu->obat_obatan}}</td>
                                </tr>
                            </tbody>
                        </table><br>

                        <h6>III. Assesmen Gizi</h6>
                        <table>
                            <tbody>
                                <tr>
                                    <td>Berat Badan</td>
                                    <td>
                                    <td>
                                    <td>
                                    <td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                                    </td>
                                    <td>&nbsp;&nbsp;{{$posyandu->berat_badan}}</td>
                                </tr>

                                <tr>
                                    <td>Tinggi Badan</td>
                                    <td>
                                    <td>
                                    <td>
                                    <td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                                    </td>
                                    <td>&nbsp;&nbsp;{{$posyandu->tinggi_badan}}</td>
                                </tr>

                                <tr>
                                    <td>Lila</td>
                                    <td>
                                    <td>
                                    <td>
                                    <td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                                    </td>
                                    <td>&nbsp;&nbsp;{{$posyandu->lila}}</td>
                                </tr>

                                <tr>
                                    <td>Anemia</td>
                                    <td>
                                    <td>
                                    <td>
                                    <td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                                    </td>
                                    <td>&nbsp;&nbsp;{{$posyandu->anemia}}</td>
                                </tr>

                                <tr>
                                    <td>Foto Kegiatan</td>
                                    <td>
                                    <td>
                                    <td>
                                    <td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                                    </td>
                                    <td>&nbsp;&nbsp;{{$posyandu->foto_posyandu}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div><br>


                    <!-- Jemantik -->
                    <div id="jemantik" class="tab-pane fade">
                        <h7>Jemantik</h7>
                        <p>Tutorial pemrograman web, mobile dan design</p>
                    </div>

                    <!-- Kesehatan -->
                    <div id="kesehatan_jiwa" class="tab-pane fade">
                        <h7>Kesehatan Jiwa</h7>
                        <p>Membuat navigasi tabs dan pills bootstrap.</p>
                    </div>
                </div>
            </div><br><br>

            <!-- FORM DP5A -->

            <a id="dp5abtn" style="color:white " class="btn btn-primary btn-block">DP5A</a>
            <div id="mydp5a" action="">

                <ul class="nav nav-tabs">
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#kader_ipm">Satgas
                            PBKM</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#satgas_pbkm">Kader
                            IPM</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#satgas_ppa">Satgas PPA</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div id="kader_ipm" class="tab-pane fade show active">
                        <table>
                            @foreach($satgas_pbkm as $satgas_pbkm)
                            <tbody>
                                <tr>
                                    <td>NIK</td>
                                    <td>
                                    <td>
                                    <td>
                                    <td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                                    <td>&nbsp;&nbsp;{{$satgas_pbkm->nik_satgas}}</td>
                                </tr>

                                <tr>
                                    <td>Nama Lengkap</td>
                                    <td>
                                    <td>
                                    <td>
                                    <td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                                    <td>&nbsp;&nbsp;{{$satgas_pbkm->nama_lengkap_satgas}}</td>
                                </tr>

                                <tr>
                                    <td>Tempat Lahir</td>
                                    <td>
                                    <td>
                                    <td>
                                    <td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                                    <td>&nbsp;&nbsp;{{$satgas_pbkm->tempat_lahir_satgas}}</td>
                                </tr>

                                <tr>
                                    <td>Tanggal Lahir</td>
                                    <td>
                                    <td>
                                    <td>
                                    <td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                                    <td>&nbsp;&nbsp;{{$satgas_pbkm->tanggal_lahir_satgas}}</td>
                                </tr>

                                <tr>
                                    <td>No Telepon</td>
                                    <td>
                                    <td>
                                    <td>
                                    <td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                                    <td>&nbsp;&nbsp;{{$satgas_pbkm->telp_satgas}}</td>
                                </tr>

                                <tr>
                                    <td>Pendidikan</td>
                                    <td>
                                    <td>
                                    <td>
                                    <td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                                    <td>&nbsp;&nbsp;{{$satgas_pbkm->pendidikan_satgas}}</td>
                                </tr>

                                <tr>
                                    <td>Foto Kegiatan</td>
                                    <td>
                                    <td>
                                    <td>
                                    <td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                                    <td>&nbsp;&nbsp;{{$satgas_pbkm->foto_pbkm}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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



            <a id="dkrthbtn" style="color:white " class="btn btn-primary btn-block">DKRTH</a>
            <div id="mydkrth">
                <ul class="nav nav-tabs">
                    <li class=" nav-item"><a class="nav-link active" data-toggle="tab"
                            href="#fasil_lingkungan">Fasilitator
                            Lingkungan</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#form_lain">Form Lain</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#lain_juga">Lain Juga</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div id="fasil_lingkungan" class="tab-pane fade show active">
                        <table>
                            @foreach($fasil as $fasil)
                            <tbody>
                                <tr>
                                    <td>NIK</td>
                                    <td>
                                    <td>
                                    <td>
                                    <td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                                    <td>&nbsp;&nbsp;{{$fasil->nik_fasil}}</td>
                                </tr>

                                <tr>
                                    <td>Nama Lengkap</td>
                                    <td>
                                    <td>
                                    <td>
                                    <td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                                    <td>&nbsp;&nbsp;{{$fasil->nama_lengkap_fasil}}</td>
                                </tr>

                                <tr>
                                    <td>Tempat Lahir</td>
                                    <td>
                                    <td>
                                    <td>
                                    <td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                                    <td>&nbsp;&nbsp;{{$fasil->tempat_lahir_fasil}}</td>
                                </tr>

                                <tr>
                                    <td>Tanggal Lahir</td>
                                    <td>
                                    <td>
                                    <td>
                                    <td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                                    <td>&nbsp;&nbsp;{{$fasil->tanggal_lahir_fasil}}</td>
                                </tr>

                                <tr>
                                    <td>No Telepon</td>
                                    <td>
                                    <td>
                                    <td>
                                    <td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                                    <td>&nbsp;&nbsp;{{$fasil->telp_fasil}}</td>
                                </tr>

                                <tr>
                                    <td>Pendidikan</td>
                                    <td>
                                    <td>
                                    <td>
                                    <td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                                    <td>&nbsp;&nbsp;{{$fasil->pendidikan_fasil}}</td>
                                </tr>

                                <tr>
                                    <td>Foto Kegiatan</td>
                                    <td>
                                    <td>
                                    <td>
                                    <td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                                    <td>&nbsp;&nbsp;{{$fasil->foto_fasil}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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

            </div>


            <script type="text/javascript">
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

            $(document).ready(function() {
                $('#historybtn').click(function() {
                    $('#history').toggle(500);
                });
            });
            </script>

            <style>
            #mydinkes {
                display: none;
                width: 100%;
                border: 3px solid #ccc;
                padding: 20px;
                background: #ffffff;
            }

            #mydp5a {
                display: none;
                width: 100%;
                border: 3px solid #ccc;
                padding: 20px;
                background: #ffffff;

            }

            #mydkrth {
                display: none;
                width: 100%;
                border: 3px solid #ccc;
                padding: 20px;
                background: #ffffff;
            }

            #history {
                display: none;
                width: auto;
                border: 3px solid #ccc;
                padding: 20px;
                background: #ffffff;
            }
            </style>


            <br><br>

        </div>
        <a href="/masterreport" class="btn btn-success">Kembali</a><br>
    </div>



    @endsection

    @push('page-scripts')
    @endpush