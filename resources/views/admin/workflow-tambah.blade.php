@extends('layouts.master')
@section('title', 'Laravel')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class=" section-header">
                <h1>Tambah Workflow</h1>
            </div>

            <form method="post" action="/workflow" enctype="multipart/form-data">
                @csrf


                <div class="form-group">
                    <label for="workflow">Menambahkan Workflow</label>
                    <input type="text" class="form-control" id="nama_workflow" placeholder="Masukkan Nama Workflow"
                        name="nama_workflow" required>
                </div>

                <button type="submit" class="btn btn-success">Tambah Workflow</button>
            </form>


        </div>
    </div>
</div>

@endsection

@push('page-scripts')
@endpush