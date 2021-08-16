@extends('layouts.master')
@section('title', 'Laravel')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class=" section-header">
                <h1>Rekap Kelurahan Report</h1>
            </div>

            <!-- 
            <div class="cari">
                <form action="/rekaplaporan/cari" method="get" class="form-inline">
                    @csrf
                    <div class="col-12">
                        <input type="text" class="form-control" name="cari" placeholder="Cari Laporan"
                            value="{{ old('cari') }}">
                        <button type="submit" class="btn btn-primary my-3 fa fa-search" value="cari"></button>
                </form>
            </div> -->

            <a href="/forms" class=" btn btn-info">Tambah Laporan</a> &nbsp;&nbsp;
            <a href="/forms/trash" class="btn btn-warning fas fa-trash"></a>
            &nbsp;&nbsp;
            <a href="/forms " class="btn btn-info fas fa-redo"></a>

            <form action="/rekaplaporan/date" method="POST">
                @csrf <br>
                <div class="ha">

                    <div class="form-group row">
                        <div class="col-md-6 form-group">
                            <label for="date" class="col-form-label">Mulai Tanggal</label>
                            <input type="date" class="form-control input-sm" id="fromDate" name="fromDate"
                                required /><br>
                            <button type="submit" class="btn btn-info" name="search" title="search">Filter Berdasarkan
                                Tanggal</button>
                        </div>


                        <div class="col-md-6 form-group mt-md-0">
                            <label for="date" class="col-form-label">Hingga Tanggal</label>
                            <input type="date" class="form-control input-sm" id="toDate" name="toDate" required />

                        </div>


                        <div class="form-row">
                    <div class="col">
                        <label for="rt">Kelurahan</label>
                        <select name="kecamatan" class="form-control" style="width:250px">
                            <option value="">--- Select Kelurahan ---</option>
                            @foreach ($kelurahan as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>

                    </div>
                </div><br>


                    </div>

                </div>


            </form>



            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif


            <table id="myTable2" class="table table-striped table-bordered nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">No KK</th>
                        <th scope="col">Nama Kepala KK</th>
                        <th scope="col">Alamat Lengkap</th>
                        <th scope="col">Status Form</th>
                        <th scope="col">Tanggal Input</th>

                        <th width="250px" scope="col">Aksi</th>
                    </tr>
                </thead>


                <tbody>
                    @foreach($query as $as)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{ $as->no_kk}}</td>
                        <td>{{ $as->nama_kepala_kk}}</td>
                        <td>{{ $as->alamat_lengkap}}</td>

                        <td>{{ Carbon\Carbon::parse($as->tanggal_input)->format('d-m-Y')}}</td>
                        <td><span class="badge bg-info" style="color:white">{{ $as->status}}</span></td>
                        <td>
                            <a class="fas fa-folder" href="/alllaporan/show/{{$as->id}}"></a>
                            &nbsp;&nbsp;
                            <a class="fas fa-edit" href="/alllaporan/edit/{{$as->id}}"></a>
                            &nbsp;&nbsp;
                            <a class="fas fa-trash" href="/alllaporan/hapus/{{$as->id}}"
                                onclick="return confirm('Apakah anda yakin data ini akan dihapus?')"></a>


                        </td>

                    </tr>
                    @endforeach

                </tbody>



            </table>


        </div>


    </div>

</div>





<script>
$(document).ready(function() {
    $('#myTable2').DataTable({
        pageLength: 25,
        responsive: true,
        paging: true,
        scrollX: true,
        lengthChange: true,
        searching: true,
        ordering: true,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [{
                extend: 'copy'
            },
            {
                extend: 'csv'
            },
            {
                extend: 'excel',
                title: 'ExampleFile'
            },
            {
                extend: 'pdf',
                title: 'ExampleFile'
            },

            {
                extend: 'print',
                customize: function(win) {
                    $(win.document.body).addClass('white-bg');
                    $(win.document.body).css('font-size', '10px');

                    $(win.document.body).find('table')
                        .addClass('compact')
                        .css('font-size', 'inherit');
                }
            }
        ]
    });
});
</script>



@endsection

@push('page-scripts')
@endpush