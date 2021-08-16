@extends('layouts.master')
@section('title', 'Laravel')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class=" section-header">
                <h1>Tambah Tim</h1>
            </div>


            <form method="post" action="/tim" enctype="multipart/form-data">
                {{ csrf_field() }}



                <div class="form-group">
                    <label for="main">Pegawai</label>
                    <input type="text" class="form-control" id="id_pegawai" name="id_pegawai" value="{{$pegawai->id}}" required readonly>
                </div>



                <div class="form-group">
                    <label for="main">Daftar Tim</label>
                    <select class="form-control" id="master_pegawai" name="master_pegawai" required>
                        @foreach ($pegawai2 as $pegawai2)
                        <option value="{{ $pegawai2->id}}">{{$pegawai2->nama_pegawai}}
                        </option>
                        @endforeach
                    </select>

                </div>



                <script type="text/javascript">
                    jQuery(document).ready(function() {
                        jQuery('select[name="main"]').on('change', function() {
                            var mainID = jQuery(this).val();
                            if (mainID) {
                                jQuery.ajax({
                                    url: 'tambah/getsub/' + mainID,
                                    type: "GET",
                                    dataType: "json",
                                    success: function(data) {
                                        console.log(data);
                                        jQuery('select[name="menu_id"]').empty();
                                        jQuery.each(data, function(key, value) {
                                            $('select[name="menu_id"]').append(
                                                '<option value="' +
                                                key + '">' + value + '</option>');
                                        });
                                    }
                                });
                            } else {
                                $('select[name="menu_id"]').empty();
                            }
                        });
                    });
                </script>





                <button type="submit" class="btn btn-success">Tambah Akses</button>
            </form>


        </div>
    </div>
</div>

@endsection

@push('page-scripts')
@endpush