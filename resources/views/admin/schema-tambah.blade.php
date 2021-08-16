@extends('layouts.master')
@section('title', 'Laravel')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class=" section-header">
                <h1>Tambah Schema</h1>
            </div>

            <form method="post" action="/schema" enctype="multipart/form-data">
                @csrf


                <div class="form-group">
                    <label for="schema">Menambahkan State</label>
                    <input type="text" class="form-control" id="nama_schema" placeholder="Masukkan Nama State"
                        name="nama_schema" required>
                </div>

                <button type="submit" class="btn btn-success">Tambah State</button>
            </form>


        </div>
    </div>
</div>

@endsection

@push('page-scripts')
@endpush