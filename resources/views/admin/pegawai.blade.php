@extends('layouts.master')
@section('title', 'Laravel')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class=" section-header">
                <h1>Daftar Pegawai</h1>
            </div>

            <div class="cari">
                <form action="/pegawai/cari" method="get" class="form-inline">
                    @csrf
                    <div class="col-12">
                        <input type="text" class="form-control" name="cari" placeholder="Cari Nama Pegawai"
                            value="{{ old('cari') }}">
                        <button type="submit" class="btn btn-primary my-3 fa fa-search" value="cari"></button>
                    </div>
                </form>
            </div>

            <head>
                <meta charset="utf-8">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
            </head>

            <a href="/pegawai/tambah" class="btn btn-info">Tambah pegawai</a> &nbsp;&nbsp;
            <a href="/pegawai/trash" class="btn btn-warning fas fa-trash"></a> &nbsp;&nbsp;
            <a href="/pegawai " class="btn btn-info fas fa-redo"></a><br> <br>


            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif
            <table id="myTable" class="table">

                <thead class="table table-hover">
                    <tr>
                        <th scope="col">No. </th>
                        <th onclick="sortTable(0)" style="cursor:pointer">NIP <i class="fa fa-sort"></i></th>
                        <th onclick="sortTable(1)" style="cursor:pointer">NIK <i class="fa fa-sort"></i></th>
                        <th onclick="sortTable(2)" style="cursor:pointer">Jabatan <i class="fa fa-sort"></i></th>
                        <th onclick="sortTable(3)" style="cursor:pointer">Nama Pegawai <i class="fa fa-sort"></i>
                        </th>
                        <th onclick="sortTable(4)" style="cursor:pointer">Jenis Kelamin <i class="fa fa-sort"></i>
                        </th>
                        <th onclick="sortTable(5)" style="cursor:pointer">Tanggal Lahir <i class="fa fa-sort"></i>
                        </th>
                        <th scope="col">Foto Pegawai</th>
                        <th width="250px" scope="col">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @if($pegawai->count())
                    @foreach($pegawai as $as)
                    <tr class="item">
                        <th scope="row">{{$loop->iteration + $skipped}}</th>
                        <td>{{ $as->NIP}}</td>
                        <td>{{ $as->NIK}}</td>
                        <td>{{ $as->jabatan}}</td>
                        <td>{{ $as->nama_pegawai}}</td>
                        <td>{{ $as->jenis_kelamin}}</td>
                        <td>{{ Carbon\Carbon::parse($as->tanggal_lahir)->format('d-m-Y')}}</td>
                        <td><br><img class="img" width="70" src="/image/{{$as->foto_pegawai}}"></td>
                        <td>
                            <a class="fas fa-edit" href="/pegawai/edit/{{$as->id}}"></a>
                            &nbsp;&nbsp;
                            <a class="fas fa-trash" href="/pegawai/hapus/{{$as->id}}"
                                onclick="return confirm('Apakah anda yakin data ini akan dihapus?')"></a>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
            {!! $pegawai->appends(\Request::except('page'))->render() !!}
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