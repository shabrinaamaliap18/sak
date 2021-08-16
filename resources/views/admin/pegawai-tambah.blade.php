@extends('layouts.master')
@section('title', 'Laravel')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class=" section-header">
                <h1>Tambah Pegawai</h1>
            </div>
            <form method="post" action="/pegawai" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="judul">NIP</label>
                    <input type="number" class="form-control @error('nip') is-invalid @enderror" id="NIP"
                        placeholder="Masukkan NIP pegawai baru" name="NIP" required>

                    @error('nip')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="judul">NIK</label>
                    <input type="number" class="form-control @error('nik') is-invalid @enderror" id="NIK"
                        placeholder="Masukkan NIK pegawai baru" name="NIK" required>

                    @error('nik')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="jabatan">Jabatan</label>
                    <select class="form-control" id="jabatan" name="jabatan" required>
                        <option selected>Pilih Jabatan</option>
                        <option value="kader">Kader</option>
                        <option value="koordinator">Koordinator </option>
                        <option value="opd dinkes">opd dinkes </option>
                        <option value="opd dp5a">opd dp5a </option>
                        <option value="opd dkrth">opd dkrth </option>
                        <option value="pemberi honor">pemberi honor </option>
                        <option value="admin">admin</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="judul">Nama Pegawai</label>
                    <input type="text" class="form-control" id="nama_pegawai" placeholder="Masukkan nama pegawai baru"
                        name="nama_pegawai" required>
                </div>

                <div class="form-group">
                    <label for="judul">Jenis Kelamin</label>
                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                        <option selected>Pilih Jenis Kelamin</option>
                        <option value="Laki_Laki">Laki - Laki</option>
                        <option value="Perempuan">Perempuan </option>
                    </select>
                </div>

                <div class="form-group">
                    <div class="input-group-addon"></div>
                    <label for="judul">Tanggal Lahir</label>
                    <input class="form-control" id="tanggal_lahir" name="tanggal_lahir" placeholder="DD/MM/YYYY"
                        type="date">
                </div>

                <div class="form-group">
                    <label for="gambar">Foto Pegawai</label>
                    <input type="file" class="form-control-file" id="foto_pegawai" placeholder="Masukkan foto"
                        name="foto_pegawai" required>
                </div>



                <div class="manajementim" name="manajementim" id="manajementim">
                    <div class=" section-header">
                        <h1>Manajemen Tim Kader</h1>
                    </div>

                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Perhatian!</strong> Menu ini hanya diperuntukkan untuk pengisian tim untuk jabatan kader
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>


                    <div class="col">
                        <div id="inputFormRow">
                            <div class="form-group">
                                <div class="row">
                                    <select class="form-control" id="master_pegawai[]" name="master_pegawai[]">
                                        <option selected value="">Pilih Pegawai</option>
                                        @foreach ($pegawai2 as $pegawai2)
                                        <option value="{{$pegawai2->id}}"> {{$pegawai2->jabatan}} -
                                            {{$pegawai2->nama_pegawai}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div><br>

                                <div class="input-group-append">
                                    <button id="removeRow" type="button" class="btn btn-danger" style="
                                            text-align:center; width:100px">Hapus</button>
                                </div>
                            </div>
                        </div>

                        <div id="newRow"></div>
                        <button id="addRow" type="button" class="btn btn-info" style="
                                            text-align:center; width:100px">Tambah</button>
                    </div>
                </div><br>



                <script type="text/javascript">
                // add row
                $("#addRow").click(function() {
                    var html = '';

                    html += '<div id="inputFormRow">';
                    html += '<div class="form-group">';
                    html += '<div class="row">';
                    html +=
                        '<select class="form-control" value="{{$pegawai2->id}}"id="master_pegawai[]" name="master_pegawai[]"required><select></div><br>';
                    html += '<div class="input-group-append">';
                    html +=
                        '<button id="removeRow" style="text-align:center;width:100px" type="button " class="btn btn-danger">Hapus</button>';
                    html += '</div>';
                    html += '</div>';


                    $('#newRow').append(html);


                    jQuery(document).ready(function() {
                        jQuery.ajax({
                            url: '/pegawai2/tambah/getsub/',
                            type: "GET",
                            dataType: "json",
                            success: function(data) {
                                console.log(data);
                                jQuery('select[name="master_pegawai[]"]').empty();
                                jQuery.each(data, function(key, value) {
                                    $('select[name="master_pegawai[]"]').append(
                                        '<option value="' +
                                        key + '">' + value +
                                        '</option>');
                                });
                            }
                        });
                    });

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

                // $('.remove').live('click', function() {
                //     var last = $('tbody tr').length;
                //     if (last == 1) {
                //         alert("you can not remove last row");
                //     } else {
                //         $(this).parent().parent().remove();
                //     }

                // });



                // $('.remove').live('click', function() {
                //     var last = $('tbody tr').length;
                //     if (last == 1) {
                //         alert("you can not remove last row");
                //     } else {
                //         $(this).parent().parent().remove();
                //     }

                // });

                $(window).load(function() {
                    $("#jabatan").change(function() {
                        console.log($("#jabatan option:selected").val());
                        if ($("#jabatan option:selected").val() == 'koordinator') {
                            $('.manajementim').prop('hidden', 'true');
                        } else if ($("#jabatan option:selected").val() == 'opd') {
                            $('.manajementim').prop('hidden', 'true');
                        } else {
                            $('.manajementim').prop('hidden', false);
                        }
                    });
                });
                </script>







                <button type="submit" class="btn btn-success">Tambah Pegawai</button>
                <a href="/pegawai" class="btn btn-info">Kembali</a>
            </form>

        </div>
    </div>
</div>



@endsection

@push('page-scripts')
@endpush