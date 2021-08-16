@extends('layouts.master')
@section('title', 'Laravel')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class=" section-header">
                <h1>Edit workflow</h1>
            </div>

            <form method="post" action="/workflow/{{$workflow->id}}">

                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="form-group">
                    <label for="workflow">Edit workflow</label>
                    <input type="text" class="form-control" id="nama_workflow" placeholder="Masukkan Nama Workflow Baru"
                        name="nama_workflow" value="{{$workflow->nama_workflow}}" required>

                </div>

                <button type="submit" class="btn btn-success">Edit workflow</button>
            </form>


        </div>
    </div>
</div>

@endsection

@push('page-scripts')
@endpush