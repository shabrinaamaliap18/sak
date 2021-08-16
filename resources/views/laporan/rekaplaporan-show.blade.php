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

                            <div class="card-subtitle mb-4"><span class="span"> Nomor KK <class
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



                        <!-- row 2 -->

                        @if ($forms->status == "Pending")
                        <div class="col-md-4 form-group">
                            <form method="post" action="/alllaporan/teruskan/{{$forms->id}}"
                                enctype=" multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <input type="hidden" value="{{$forms->id}}" id="id_form" name="id_form">
                                <label>Teruskan ke Koordinator : </label>
                                @foreach ($tim as $tim)
                                <input type="hidden" value="{{$tim->master_pegawai}}" id="id_penerima[]"
                                    name="id_penerima[]">
                                @endforeach
                                <label><b>Disclaimer!</b> Perhatikan Bahwa Laporan sudah diisi dengan benar dan siap
                                    untuk dilaporkan!</label>
                                <button type="submit" class="btn btn-success">Teruskan</button>
                            </form>
                        </div>

                        @elseif($forms->status == "Proses Revisi")
                        <div class="col-md-4 form-group">
                            <form method="post" action="/alllaporan/teruskan/{{$forms->id}}"
                                enctype=" multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <input type="hidden" value="{{$forms->id}}" id="id_form" name="id_form">
                                <label>Teruskan ke Koordinator (Revisi) : </label>
                                @foreach ($tim as $tim)
                                <input type="hidden" value="{{$tim->master_pegawai}}" id="id_penerima[]"
                                    name="id_penerima[]">
                                @endforeach
                                <label><b>Disclaimer!</b> Perhatikan Bahwa Laporan sudah <b>direvisi</b> dengan benar
                                    dan siap untuk dilaporkan!</label>

                                <button type="submit" class="btn btn-success">Teruskan</button>
                            </form>
                        </div>

                        @endif

                        <!-- row 3 -->
                        @if ($forms->status == "Menunggu Verifikasi OPD")
                        <div class="col-md-4 form-group">
                            <div class="card-subtitle mb-4"><span class="span"> Status Laporan : </span>
                                {{$forms->status}}
                            </div>
                            <div class="form-group">
                                <label for="Pesan">Pesan</label>
                                <textarea class="form-control" id="keterangan" name="keterangan" style="height:120px"
                                    value="{{$forms->keterangan}}" readonly>{{$forms->keterangan}}</textarea>
                            </div>
                            </form>
                        </div>

                        @elseif ($forms->status == "Verifikasi Diterima")
                        <div class=" col-md-4 form-group">

                            <div class="card-subtitle mb-4"><span class="span"> Status Laporan : </span>
                                {{$forms->status}}
                            </div>
                            <div class="form-group">
                                <label for="Pesan">Pesan</label>
                                <textarea class="form-control" id="keterangan" name="keterangan" style="height:120px"
                                    value="{{$forms->keterangan}}">{{$forms->keterangan}}</textarea>
                            </div><br>


                            </form>
                        </div>

                        @else
                        <div class="col-md-4 form-group">
                            <div class="card-subtitle mb-4"><span class="span"> Status Laporan : </span>
                                {{$forms->status}}
                            </div>


                        </div>

                        @endif



                    </div><br>


                </div>

            </div>

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
                                    <td>{{ str_replace(array('[','"',']'),'',$user->where('id', $as->id_penerima)->pluck('jabatan'))}}&nbsp;&nbsp;{{$loop->iteration}}
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
                        <td width="200px">Kecamatan</td>
                        <td width="20px">:</td>
                        <td>  {{$forms->kecamatan}}</td>
                    </tr>

                    <tr>
                        <td width="200px">Kelurahan</td>
                        <td width="20px">:</td>
                        <td>  {{$forms->kelurahan}}</td>

                    </tr>
                    <tr>
                        <td width="200px">RT</td>
                        <td width="20px">:</td>
                        <td>  {{$forms->rt}}</td>
                    </tr>

                    <tr>
                        <td width="200px">RW</td>
                        <td width="20px">:</td>
                        <td>  {{$forms->rw}}</td>
                    </tr>

                    <tr>
                        <td width="200px">Jumlah Anggota</td>
                        <td width="20px">:</td>
                        <td>  {{$forms->jumlah_anggota}}</td>
                    </tr>

                    <tr>
                        <td width="200px">Status Rumah</td>
                        <td width="20px">:</td>
                        <td>  {{$forms->status_rumah}}</td>
                    </tr>

                    <tr>
                        <td width="200px">Status Penduduk</td>
                        <td width="20px">:</td>
                        <td>  {{$forms->status_penduduk}}</td>
                    </tr>

                    <tr>
                        <td width="200px">Tanggal Kedatangan</td>
                        <td width="20px">:</td>
                        <td>  {{$forms->tanggal_kedatangan}}</td>
                    </tr>

                </tbody>
            </table>
            <br>
            <br>
            <h5> Form Penduduk </h5>
            <table class="table table-light">
                <tbody>
                    @foreach($penduduk as $penduduk)
                    <th scope="row"><br> Anggota Keluarga &nbsp;{{$loop->iteration}}</th>
                    <tr>
                        <td width="200px">NIK</td>
                        <td width="20px">:</td>
                        <td>  {{$penduduk->nik}}</td>
                    </tr>

                    <tr>
                        <td width="200px">Nama Lengkap</td>
                        <td width="20px">:</td>
                        <td>  {{$penduduk->nama_lengkap}}</td>
                    </tr>

                    <tr>
                        <td width="200px">Jenis Kelamin</td>
                        <td width="20px">:</td>
                        <td>  {{$penduduk->jenis_kelamin}}</td>
                    </tr>

                    <tr>
                        <td width="200px">Tanggal Lahir</td>
                        <td width="20px">:</td>
                        <td>  {{$penduduk->tempat_lahir}}</td>
                    </tr>

                    <tr>
                        <td width="200px">No Telpon</td>
                        <td width="20px">:</td>
                        <td>  {{$penduduk->telp}}</td>
                    </tr>

                    <tr>
                        <td width="200px">Pekerjaan</td>
                        <td width="20px">:</td>
                        <td>  {{$penduduk->pekerjaan}}</td>
                    </tr>

                    <tr>
                        <td width="200px">Pendidikan</td>
                        <td width="20px">:</td>
                        <td>  {{$penduduk->pendidikan}}</td>
                    </tr>

                    <tr>
                        <td width="200px">Status Kawin</td>
                        <td width="20px">:</td>
                        <td>  {{$penduduk->status_kawin}}</td>
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
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#jumantik">Jumantik</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#form_tbc">
                            TBC dan Paliatif</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#posbindu">
                            Posbindu</a></li>

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
                                    <td width="300px">NIK</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$posyandu->nik_remaja}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">Nama Lengkap</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$posyandu->nama_lengkap_remaja}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">Tempat Lahir</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$posyandu->tempat_lahir_remaja}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">Tanggal Lahir</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$posyandu->tanggal_lahir_remaja}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">Umur</td>
                                    <td width="20px">:</td>>
                                    <td>&nbsp;&nbsp;{{$posyandu->umur}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">No Telepon</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$posyandu->telp_remaja}}</td>
                                </tr>
                            </tbody>
                        </table><br>

                        <h6>II. Status Kesehatan Sekarang</h6>
                        <table>
                            <tbody>
                                <tr>
                                <td width="300px">Keluhan Utama</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$posyandu->keluhan_utama}}</td>
                                </tr>

                                <tr>
                                <td width="300px">Cara Mengatasi</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$posyandu->cara_mengatasi}}</td>
                                </tr>

                                <tr>
                                <td width="300px">Obat - obatan</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$posyandu->obat_obatan}}</td>
                                </tr>
                            </tbody>
                        </table><br>

                        <h6>III. Assesmen Gizi</h6>
                        <table>
                            <tbody>
                                <tr>
                                <td width="300px">Berat Badan</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$posyandu->berat_badan}}</td>
                                </tr>

                                <tr>
                                <td width="300px">Tinggi Badan</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$posyandu->tinggi_badan}}</td>
                                </tr>

                                <tr>
                                <td width="300px">LILA</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$posyandu->lila}}</td>
                                </tr>

                                <tr>
                                <td width="300px">Anemia</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$posyandu->anemia}}</td>
                                </tr>

                        </tbody>
                        </table>
                        <table>
                            <tbody>
                                <tr>
                                    <td>Foto Kegiatan</td>
                                </tr>
                                <tr>
                                    <td> <img class="img" width="500px" src="/image/{{$posyandu->foto_posyandu}}"></td>

                                </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Jemantik -->

                    <div id="jumantik" class="tab-pane fade">

                        <h6>I. Pemeriksaan di Dalam Rumah</h6>
                        <table>
                            <tbody>
                                @foreach($jumantik as $jumantik)
                                <tr>
                                    <td width="300px">Jentik di Bak Kamar Mandi</td>
                                    <td width="20px">:</td>
                                    <td> {{$jumantik->jentik_bak_km}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">Jentik di Dispenser</td>
                                    <td width="20px">:</td>
                                    <td> {{$jumantik->jentik_dispenser}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">Jentik di Gentong</td>
                                    <td width="20px">:</td>
                                    <td> {{$jumantik->jentik_gentong}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">Jentik di Tampungan Lemari ES</td>
                                    <td width="20px">:</td>
                                    <td> {{$jumantik->jentik_tampungan_lemari_es}}</td>
                                </tr>

                            </tbody>
                        </table><br>

                        <h6>II. Pemeriksaan di Luar Rumah</h6>
                        <table>
                            <tbody>
                                <tr>
                                    <td width="300px">Jentik di Tampungan Pot Bunga</td>
                                    <td width="20px">:</td>
                                    <td> {{$jumantik->jentik_tampungan_pot_bunga}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">Jentik di Tampungan Minum Burung</td>
                                    <td width="20px">:</td>
                                    <td> {{$jumantik->jentik_tampungan_minum_burung}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">Jentik di Tampungan Barang Bekas</td>
                                    <td width="20px">:</td>
                                    <td> {{$jumantik->jentik_tampungan_barang_bekas}}</td>
                                </tr>
                                <tr>
                                    <td width="300px">Jentik di Tampungan Lubang Pohon</td>
                                    <td width="20px">:</td>
                                    <td> {{$jumantik->jentik_tampungan_lubang_pohon}}</td>
                                </tr>
                            </tbody>
                        </table><br>

                        <h6>III. Penyuluhan PSN dan 3M Plus</h6>
                        <table>
                            <tbody>
                                <tr>
                                    <td width="300px">Penyuluhan PSN</td>
                                    <td width="20px">:</td>
                                    <td> {{$jumantik->penyuluhan_psn}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">Pemahaman 3M Plus</td>
                                    <td width="20px">:</td>
                                    <td> {{$jumantik->pemahaman_3m_plus}}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table>
                            <tbody>
                                <tr>
                                    <td>Foto Kegiatan</td>
                                </tr>
                                <tr>
                                    <td> <img class="img" width="500px" src="/image/{{$jumantik->foto_jumantik}}"></td>

                                </tr>

                                @endforeach
                            </tbody>
                        </table>

                    </div>

                    <!-- rumahsehat -->

                    <div id="rumahsehat" class="tab-pane fade">
                       
                        <h6>I. Identitas</h6>
                        <table>
                            <tbody>
                                @foreach($rumahsehat as $rumahsehat)
                                <tr>
                                    <td width="300px">No KK</td>
                                    <td width="20px">:</td>
                                    <td>  {{$rumahsehat->nama_kk_rs}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">No KK</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$rumahsehat->jumlah_kk_rs}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">Jumlah Jiwa</td>
                                    <td width="20px">:</td>:</td>
                                    <td>&nbsp;&nbsp;{{$rumahsehat->jumlah_jiwa_rs}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">Alamat Lengkap</td>
                                    <td width="20px">:</td>:</td>
                                    <td>&nbsp;&nbsp;{{$rumahsehat->alamat_rs}}</td>
                                </tr>


                                <tr>
                                    <td width="300px">Kecamatan</td>
                                    <td width="20px">:</td>:</td>
                                    <td>&nbsp;&nbsp;{{$rumahsehat->kecamatan_rs}}</td>
                                </tr>


                                <tr>
                                    <td width="300px">Kelurahan</td>
                                    <td width="20px">:</td>:</td>
                                    <td>&nbsp;&nbsp;{{$rumahsehat->kelurahan_rs}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">RT/RW</td>
                                    <td width="20px">:</td>:
                                    </td>
                                    <td>&nbsp;&nbsp;{{$rumahsehat->rt_rs}}/{{$rumahsehat->rw_rs}}</td>
                                </tr>


                            </tbody>
                        </table><br>

                        <h6>II. Data Rumah</h6>
                        <table>
                            <tbody>
                                <tr>
                                    <td width="300px">Jendela</td>
                                    <td width="20px">:</td>:</td>
                                    <td>&nbsp;&nbsp;{{$rumahsehat->jendela_rs}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">Ventilasi</td>
                                    <td width="20px">:</td>:</td>
                                    <td>&nbsp;&nbsp;{{$rumahsehat->ventilasi_rs}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">Pencahayaan</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$rumahsehat->pencahayaan_rs}}</td>
                                </tr>
                                <tr>
                                    <td width="300px">Lubang Asap Dapur</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$rumahsehat->lad_rs}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">Kepadatan Penghuni</td>
                                    <td width="20px">:</td>:</td>
                                    <td>&nbsp;&nbsp;{{$rumahsehat->kepadatan_penghuni_rs}}</td>
                                </tr>

                                <tr>
                                   <td width="300px">KHP</td>
                                    <td width="20px">:</td>:</td>
                                    <td>&nbsp;&nbsp;{{$rumahsehat->khp_rs}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">Kontruksi Rumah</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$rumahsehat->kontruksi_rumah_rs}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">SAB</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$rumahsehat->sab_rs}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">Sarana Air Minum</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$rumahsehat->sam_rs}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">Jamban</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$rumahsehat->jamban_rs}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">SPAL</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$rumahsehat->spal_rs}}</td>
                                </tr>


                                <tr>
                                    <td width="300px">Tempat Sampah</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$rumahsehat->tempat_sampah_rs}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">Bebas Jentik</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$rumahsehat->bebas_jentik_rs}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">Bebas Tikus</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$rumahsehat->bebas_tikus_rs}}</td>
                                </tr>


                                <tr>
                                    <td width="300px">Membersihkan Rumah dan Halaman</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$rumahsehat->pembersihan_halaman_rs}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">Membersihkan Tinja</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$rumahsehat->pembersihan_tinja_rs}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">Membuang Sampah</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$rumahsehat->membuang_sampah_rs}}</td>
                                </tr>
                                </tbody>
                        </table>
                        <table>
                            <tbody>
                                <tr>
                                    <td>Foto Kegiatan</td>
                                </tr>
                                <tr>
                                    <td> <img class="img" width="500px" src="/image/{{$rumahsehat->foto_rs}}"></td>

                                </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Posbindu -->

                    <div id="posbindu" class="tab-pane fade">
                       
                        <h6>I. Identitas</h6>
                        <table>
                            <tbody>
                                @foreach($posbindu as $posbindu)
                                <tr>
                                    <td width="300px">Nama Lengkap Bindu</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$posbindu->nama_lengkap_bindu}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">Nama Bindu</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$posbindu->nama_bindu}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">Jenis Kelamin</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$posbindu->jenis_kelamin_bindu}}</td>
                                </tr>


                            </tbody>
                        </table><br>

                        <h6>II. Status Kesehatan Sekarang</h6>
                        <table>
                            <tbody>
                                <tr>
                                    <td width="300px">Riwayat PTM Keluarga</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$posbindu->riwayat_ptm_keluarga_bindu}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">Riwayat PTM Sendiri</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$posbindu->riwayat_ptm_sendiri_bindu}}</td>
                                </tr>

                            </tbody>
                        </table><br>

                        <h6>III. Resiko PTM</h6>
                        <table>
                            <tbody>
                                <tr>
                                    <td width="300px">Merokok</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$posbindu->merokok_bindu}}</td>
                                </tr>
                                <tr>
                                    <td width="300px">Kurang Aktifitas Fisik</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$posbindu->kurang_aktivitas_fisik_bindu}}</td>
                                </tr>
                                <tr>
                                    <td width="300px">Kurang Sayur Buah</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$posbindu->kurang_sayur_buah_bindu}}</td>
                                </tr>
                                <tr>
                                    <td width="300px">Konsusmsi Alkohol</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$posbindu->konsumsi_alkohol_bindu}}</td>
                                </tr>
                                <tr>
                                    <td width="300px">Tekanan Darah</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$posbindu->tekanan_darah_bindu}}</td>
                                </tr>
                                <tr>
                                    <td width="300px">Lingkar Perut</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$posbindu->lingkar_perut_bindu}}</td>
                                </tr>
                                <tr>
                                    <td width="300px">Gula Darah Acak</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$posbindu->gula_darah_acak_bindu}}</td>
                                </tr>
                                <tr>
                                    <td width="300px">Kolestrol</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$posbindu->kolestrol_bindu}}</td>
                                </tr>
                                <tr>
                        </tbody>
                        </table>
                        <table>
                            <tbody>
                                <tr>
                                    <td>Foto Kegiatan</td>
                                </tr>
                                <tr>
                                    <td> <img class="img" width="500px" src="/image/{{$posbindu->foto_posbindu}}"></td>

                                </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>


                    <!-- TBC -->

                    <div id="form_tbc" class="tab-pane fade">
                      
                        @foreach($tbc as $tbc)
                        <table>
                            <tbody>
                                <tr>
                                    <td width="300px">Nama</td>
                                    <td width="20px">:</td>
                                    <td>  {{$tbc->nama_siswa_tbc}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">Umur</td>
                                    <td width="20px">:</td>:</td>
                                    <td>  {{$tbc->umur_tbc}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">Jenis Kelamin</td>
                                    <td width="20px">:</td>:</td>
                                    <td>  {{$tbc->jenis_kelamin_tbc}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">Alamat</td>
                                    <td width="20px">:</td>:</td>
                                    <td>  {{$tbc->alamat_tbc}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">Hejala</td>
                                    <td width="20px">:</td>:</td>
                                    <td>  {{$tbc->gejala_tbc}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">Riwayat Kontak dengan Pasien TBC</td>
                                    <td width="20px">:</td>:</td>
                                    <td>  {{$tbc->riwayat_kontak_tbc}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">Status Rujukan</td>
                                    <td width="20px">:</td>:</td>
                                    <td>  {{$tbc->status_rujukan_tbc}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">Status Fasyankes Rujukan</td>
                                    <td width="20px">:</td>:</td>
                                    <td>  {{$tbc->status_fasyankes_rujukan}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">Hasil Pemeriksaan</td>
                                    <td width="20px">:</td>:</td>
                                    <td>  {{$tbc->hasil_pemeriksaan}}</td>
                                </tr>

                                </tbody>
                        </table>
                        <table>
                                <tbody>
                                <tr>
                                    <td>Foto Kegiatan</td>
                                </tr>
                                <tr>
                                    <td> <img class="img" width="500px" src="/image/{{$tbc->foto_tbc}}"></td>
                                </tr>
                            </tbody>
                        </table>
                        @endforeach
                    </div>

                    <!-- Pelita -->

                    <div id="pelita" class="tab-pane fade">
                        
                        <h6>I. Identitas</h6>
                        <table>
                            <tbody>
                                @foreach($pelita as $pelita)
                                <tr>
                                    <td width="300px">NIK</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$pelita->nik_pelita}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">Nama Lengkap</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$pelita->nama_pelita}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">Jenis Kelamin</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$pelita->jenis_kelamin_pelita}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">Tanggal Lahir</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$pelita->tanggal_lahir_pelita}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">Umur</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$pelita->umur_pelita}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">Berat Badan Lahir</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$pelita->bb_lahir_pelita}}
                                    </td>
                                </tr>


                                <tr>
                                    <td width="300px">Panjang Badan Lahir</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$pelita->pb_lahir_pelita}}
                                    </td>
                                </tr>

                                <tr>
                                    <td width="300px">Berat Badan Saat Ini</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$pelita->bb_pelita}}
                                    </td>
                                </tr>


                                <tr>
                                    <td width="300px">Panjang Badan Saat Ini</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$pelita->pb_pelita}}
                                    </td>
                                </tr>

                                <tr>
                                    <td width="300px">LILA</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$pelita->lila_pelita}}
                                    </td>
                                </tr>

                                <tr>
                                    <td width="300px">Cara Ukur Panjang Balita</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$pelita->cara_ukur_pb_pelita}}
                                    </td>
                                </tr>
                            </tbody>
                        </table><br>

                        <h6>II. Data Orang Tua</h6>
                        <table>
                            <tbody>
                                <tr>
                                    <td width="300px">NIK Ayah</td>
                                    <td width="20px">:</td>>
                                    <td>&nbsp;&nbsp;{{$pelita->nik_ayah_pelita}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">Nama Ayah</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$pelita->nama_ayah_pelita}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">NIK Ibu</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$pelita->nik_ibu_pelita}}</td>
                                </tr>
                                <tr>
                                    <td width="300px">Nama Ibu</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$pelita->nama_ibu_pelita}}</td>
                                </tr>
                            </tbody>
                        </table><br>

                        <h6>III. Alamat</h6>
                        <table>
                            <tbody>
                                <tr>
                                    <td width="300px">Alamat Lengkap Domisili</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$pelita->alamat_domisili_pelita}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">RT/RW</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$pelita->rt_pelita}}/{{$pelita->rw_pelita}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">Alamat Lengkap KTP</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$pelita->alamat_ktp_pelita}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">NO HP</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$pelita->no_hp_ortu_pelita}}</td>
                                </tr>


                            </tbody>
                        </table>

                        <h6>IV. Perkembangan balita</h6>
                        <table>
                            <tbody>
                                <tr>
                                    <td width="300px">Status</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$pelita->status_pelita}}</td>
                                </tr>


                                <tr>
                                    <td width="300px">PErkembangan Balita (Sesuai Buku KIA)</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$pelita->perkembangan_balita_pelita}}</td>
                                </tr>
                        </tbody>
                        </table>
                        <table>
                            <tbody>
                                <tr>
                                    <td>Foto Kegiatan</td>
                                </tr>
                                <tr>
                                    <td> <img class="img" width="500px" src="/image/{{$pelita->foto_pelita}}"></td>

                                </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- kpasi -->

                    <div id="kpasi" class="tab-pane fade">
                       
                        <h6>I. Data Kunjungan</h6>
                        <table>
                            <tbody>
                                @foreach($kpasi as $kpasi)
                                <tr>
                                    <td width="300px">Tanggal Kunjungan</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$kpasi->tanggal_kunjungan_kpasi}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">Nama Kader</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$kpasi->nama_kader_kpasi}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">Nama Lengkap Ibu Kampung ASI</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$kpasi->nama_kpasi}}</td>
                                </tr>
                            </tbody>
                        </table>

                        <h6>II. Identitas</h6>
                        <table>
                            <tbody>
                                <tr>
                                    <td width="300px">Usia Kehamilan</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$kpasi->usia_kehamilan_kpasi}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">Usia Bayi</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$kpasi->usia_bayi_kpasi}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">NIK Ibu</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$kpasi->nik_ibu_kpasi}}</td>
                                </tr>
                                <tr>
                                    <td width="300px">Domisili</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$kpasi->nama_ibu_domisili_kpasi}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">Alamat Domisli</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$kpasi->alamat_ibu_domisili_kpasi}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">Alamat KTP</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$kpasi->alamat_ibu_ktp_kpasi}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">NO HP</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$kpasi->no_hp_kpasi}}</td>
                                </tr>
                            </tbody>
                        </table><br>

                        <h6>III. Data Permasalahan</h6>
                        <table>
                            <tbody>
                                <tr>
                                    <td width="300px">Permasalahan</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$kpasi->permasalahan_kunjungan_kpasi}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">Penyuluhan</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$kpasi->penyuluhan_kunjungan_kpasi}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">Status Rujukan</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$kpasi->status_rujukan_kpasi}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">Penyebab Dirujuk</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$kpasi->penyebab_dirujuk_kpasi}}</td>
                                </tr>
                        </tbody>
                        </table>
                        <table>
                            <tbody>
                                <tr>
                                    <td>Foto Kegiatan</td>
                                </tr>
                                <tr>
                                    <td> <img class="img" width="500px" src="/image/{{$kpasi->foto_kpasi}}"></td>

                                </tr>

                                @endforeach
                            </tbody>
                        </table>
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
                                    <td width="300px">NIK</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$satgas_pbkm->nik_satgas}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">Nama Lengkap</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$satgas_pbkm->nama_lengkap_satgas}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">Tempat Lahir</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$satgas_pbkm->tempat_lahir_satgas}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">Tanggal Lahir</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$satgas_pbkm->tanggal_lahir_satgas}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">No Telepon</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$satgas_pbkm->telp_satgas}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">Pendidikan</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$satgas_pbkm->pendidikan_satgas}}</td>
                                </tr>

                        </tbody>
                        </table>
                        <table>
                            <tbody>
                                <tr>
                                    <td>Foto Kegiatan</td>
                                </tr>
                                <tr>
                                    <td> <img class="img" width="500px" src="/image/{{$satgas_pbkm->foto_pbkm}}"></td>

                                </tr>

                                @endforeach
                            </tbody>
                        </table>
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
                                    <td width="300px">NIK</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$fasil->nik_fasil}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">Nama Lengkap</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$fasil->nama_lengkap_fasil}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">Tempat Lahir</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$fasil->tempat_lahir_fasil}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">Tanggal Lahir</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$fasil->tanggal_lahir_fasil}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">No Telp</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$fasil->telp_fasil}}</td>
                                </tr>

                                <tr>
                                    <td width="300px">Pendidikan</td>
                                    <td width="20px">:</td>
                                    <td>&nbsp;&nbsp;{{$fasil->pendidikan_fasil}}</td>
                                </tr>

                        </tbody>
                        </table>
                        <table>
                            <tbody>
                                <tr>
                                    <td>Foto Kegiatan</td>
                                </tr>
                                <tr>
                                    <td> <img class="img" width="500px" src="/image/{{$fasil->foto_fasil}}"></td>

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
            <a href="/masterreport" class="btn btn-success">Kembali</a>
        </div>
    </div>
</div>


@endsection

@push('page-scripts')
@endpush