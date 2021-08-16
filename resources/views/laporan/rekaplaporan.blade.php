@extends('layouts.master')
@section('title', 'Laravel')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class=" section-header">
                <h1>Rekap Report</h1>
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



                    </div>

                </div>


            </form>



            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif


            <table id="myTable" class="table table-striped table-bordered nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th onclick="sortTable(0)" style="cursor:pointer">No KK</th>
                        <th onclick="sortTable(1)" style="cursor:pointer">Nama Kepala KK</th>
                        <th onclick="sortTable(2)" style="cursor:pointer">Alamat Lengkap</th>
                        <th onclick="sortTable(3)" style="cursor:pointer">Tanggal Input</th>
                        <th onclick="sortTable(4)" style="cursor:pointer">Status Form</th>
                        <th width="100px" scope="col">Aksi</th>
                    </tr>
                </thead>


                <tbody>

                    @foreach($forms as $as)
                    <tr>
                        <th class="no" scope="row">{{$loop->iteration}}</th>
                        <td class="no_kk">{{ $as->no_kk}}</td>
                        <td class="nama_kepala_kk">{{ $as->nama_kepala_kk}}</td>
                        <td class="alamat_lengkap">{{ $as->alamat_lengkap}}</td>
                        <td>{{ Carbon\Carbon::parse($as->tanggal_input)->format('d-m-Y')}}</td>
                        <td><?php if ($as['status'] == 'Pending') { ?>
                            <span class="badge badge-info"><?php echo $as['status']; ?></span>
                            <?php } ?>

                            <?php if ($as['status'] == 'Menunggu Verifikasi Koordinator') { ?>
                            <span class="badge badge-warning"><?php echo $as['status']; ?></span>
                            <?php } ?>

                            <?php if ($as['status'] == 'Menunggu Verifikasi OPD') { ?>
                            <span class="badge badge-warning"><?php echo $as['status']; ?></span>
                            <?php } ?>

                            <?php if ($as['status'] == 'Menunggu Verifikasi OPD Lain') { ?>
                            <span class="badge badge-secondary"><?php echo $as['status']; ?></span>
                            <?php } ?>

                            <?php if ($as['status'] == 'Keputusan Dinkes Disimpan') { ?>
                            <span class="badge badge-secondary"><?php echo $as['status']; ?></span>
                            <?php } ?>

                            <?php if ($as['status'] == 'Keputusan Dp5a Disimpan') { ?>
                            <span class="badge badge-secondary"><?php echo $as['status']; ?></span>
                            <?php } ?>

                            <?php if ($as['status'] == 'Keputusan Dkrth Disimpan') { ?>
                            <span class="badge badge-secondary"><?php echo $as['status']; ?></span>
                            <?php } ?>

                            <?php if ($as['status'] == 'Verifikasi Diterima') { ?>
                            <span class="badge badge-success"><?php echo $as['status']; ?></span>
                            <?php } ?>

                            <?php if ($as['status'] == 'Proses Revisi') { ?>
                            <span class="badge badge-danger"><?php echo $as['status']; ?></span>
                            <?php } ?>


                            <?php if ($as['status'] == 'Verifikasi Ditolak') { ?>
                            <span class="badge badge-danger"><?php echo $as['status']; ?></span>
                            <?php } ?>

                            <?php if ($as['status'] == 'Honor Terverifikasi') { ?>
                            <span class="badge badge-primary"><?php echo $as['status']; ?></span>
                            <?php } ?>

                        </td>

                        <td>
                            <a class="fas fa-folder" href="/rekaplaporan/show/{{$as->id}}"></a>
                            &nbsp;&nbsp;
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
    $('#myTable').DataTable({
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