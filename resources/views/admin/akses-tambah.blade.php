@extends('layouts.master')
@section('title', 'Laravel')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class=" section-header">
                <h1>Tambah Akses</h1>
            </div>

            <form method="post" action="/akses" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Perhatian!</strong> Pilih Role yang ingin ditambah akses nya!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="form-group">
                    <label for="id-level">Pilih Role</label>
                    <!-- <input type="text" class="form-control" id="id-level" placeholder="Masukkan id-level"
                        name="id-level" required> -->
                    <select class="form-control @error('level_user_id') is-invalid @enderror " id="level_user_id"
                        name="level_user_id" required>
                        <!-- <option selected>Pilih Level User</option> -->

                        @foreach ($level as $level) <option value="{{ $level->id}} ">{{$level->id}} -
                            {{$level->nama_level_user}}</option>
                        @endforeach

                    </select>

                    @error('level_user_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror




                </div>

                <div class="form-group">
                    <label for="main_menu">Main Menu</label>
                    <select name="main_menu" id="main_menu" class="form-control">
                        <option value="">Pilih Main Menu</option>
                        @foreach ($main as $main) <option value="{{ $main->id}} ">
                            {{$main->id}} -
                            {{$main->nama_menu}}</option>
                        @endforeach
                    </select>

                </div>
                <div class="form-group">
                    <label for="sub_menu">Sub Menu</label>
                    <select name="sub_menu" class="form-control" id="menu_id">
                        <option>Pilih Sub Menu</option>
                    </select>
                </div>


                <script type="text/javascript">
                jQuery(document).ready(function() {
                    jQuery('select[name="main_menu"]').on('change', function() {
                        var mainID = jQuery(this).val();
                        if (mainID) {
                            jQuery.ajax({
                                url: 'tambah/getsub/' + mainID,
                                type: "GET",
                                dataType: "json",
                                success: function(data) {
                                    console.log(data);
                                    jQuery('select[name="sub_menu"]').empty();
                                    jQuery.each(data, function(key, value) {
                                        $('select[name="sub_menu"]').append(
                                            '<option value="' +
                                            key + '">' + value + '</option>');
                                    });
                                }
                            });
                        } else {
                            $('select[name="sub_menu"]').empty();
                        }
                    });
                });
                </script>





                <button type="submit" class="btn btn-success">Tambah Akses</button>
                <a href="/role" class="btn btn-info">Kembali</a>
            </form>


        </div>
    </div>
</div>

@endsection

@push('page-scripts')
@endpush