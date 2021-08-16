@extends('layouts.master')
@section('title', 'Laravel')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class=" section-header">
                <h1>Edit State</h1>
            </div>

            <form method="post" action="/schema/{{$schema->id}}">

                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="form-group">
                    <label for="schema">Edit State</label>
                    <input type="text" class="form-control" id="nama_schema" placeholder="Masukkan nama state baru"
                        name="nama_schema" value="{{$schema->nama_schema}}" required>

                </div>

                <button type="submit" class="btn btn-success">Edit State</button>
            </form>


        </div>
    </div>
</div>

@endsection

@push('page-scripts')
@endpush