@extends('layouts.master')
@section('title', 'Laravel')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class=" section-header">
                <h1>Daftar Report</h1>
            </div>

            <div class="cari">
                <form action="/alllaporan/cari" method="get" class="form-inline">
                    @csrf
                    <div class="col-12">
                        <input type="text" class="form-control" name="cari" placeholder="Cari Laporan"
                            value="{{ old('cari') }}">
                        <button type="submit" class="btn btn-primary my-3 fa fa-search" value="cari"></button>
                </form>
            </div>
        </div>

        <head>
            <meta charset="utf-8">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        </head>

        <a href="/forms" class=" btn btn-info">Tambah Laporan</a> &nbsp;&nbsp;
        <a href="/forms/trash" class="btn btn-warning fas fa-trash"></a>
        &nbsp;&nbsp;
        <a href="/forms " class="btn btn-info fas fa-redo"></a><br> <br>


        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif


        <table id="myTable" class="table">
            <thead class="table table-hover">
                <th scope="col">No.</th>
                <th onclick="sortTable(0)" style="cursor:pointer">No KK <i class="fa fa-sort"></i></th>
                <th onclick="sortTable(1)" style="cursor:pointer">Nama Kepala KK<i class="fa fa-sort"></i></th>
                <th onclick="sortTable(2)" style="cursor:pointer">Alamat Lengkap<i class="fa fa-sort"></i></th>
                <th onclick="sortTable(3)" style="cursor:pointer">Tanggal Input<i class="fa fa-sort"></i></th>
                <th onclick="sortTable(4)" style="cursor:pointer">Status Form<i class="fa fa-sort"></i></th>
                <th width="250px" scope="col">Aksi</th>
            </thead>
            </thead>

            <tbody>
                @if($forms->count())
                @foreach($forms as $as)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{ $as->no_kk}}</td>
                    <td>{{ $as->nama_kepala_kk}}</td>
                    <td>{{ $as->alamat_lengkap}}</td>
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
                        <a class="fas fa-folder" href="/alllaporan/show/{{$as->id}}"></a>
                        &nbsp;&nbsp;
                        <a class="fas fa-edit" href="/alllaporan/edit/{{$as->id}}"></a>
                        &nbsp;&nbsp;
                        <a class="fas fa-trash" href="/alllaporan/hapus/{{$as->id}}"
                            onclick="return confirm('Apakah anda yakin data ini akan dihapus?')"></a>
                    </td>

                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>

</div>

<style>
.cari {
    float: right;
}
</style>
<script>
function sortTable(n) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById("myTable");
    switching = true;
    // Set the sorting direction to ascending:
    dir = "asc";
    /* Make a loop that will continue until
    no switching has been done: */
    while (switching) {
        // Start by saying: no switching is done:
        switching = false;
        rows = table.rows;
        /* Loop through all table rows (except the
        first, which contains table headers): */
        for (i = 1; i < (rows.length - 1); i++) {
            // Start by saying there should be no switching:
            shouldSwitch = false;
            /* Get the two elements you want to compare,
            one from current row and one from the next: */
            x = rows[i].getElementsByTagName("TD")[n];
            y = rows[i + 1].getElementsByTagName("TD")[n];
            /* Check if the two rows should switch place,
            based on the direction, asc or desc: */
            if (dir == "asc") {
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    // If so, mark as a switch and break the loop:
                    shouldSwitch = true;
                    break;
                }
            } else if (dir == "desc") {
                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                    // If so, mark as a switch and break the loop:
                    shouldSwitch = true;
                    break;
                }
            }
        }
        if (shouldSwitch) {
            /* If a switch has been marked, make the switch
            and mark that a switch has been done: */
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            // Each time a switch is done, increase this count by 1:
            switchcount++;
        } else {
            /* If no switching has been done AND the direction is "asc",
            set the direction to "desc" and run the while loop again. */
            if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }
}
</script>


@endsection

@push('page-scripts')
@endpush