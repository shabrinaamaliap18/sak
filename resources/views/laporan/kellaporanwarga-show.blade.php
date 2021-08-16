@extends('layouts.master')
@section('title', 'Laravel')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class=" section-header">
                <h1>Laporan Warga Kelurahan</h1>
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