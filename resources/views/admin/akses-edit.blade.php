@extends('layouts.master')
@section('title', 'Laravel')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class=" section-header">
                <h1>Edit Akses</h1>
            </div>

            <form method="post" action="/akses/update/{{$akses->id}}">

                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="form-group">
                    <label for="level_user_id">ID Level</label>

                    <select class="form-control @error('level_user_id') is-invalid @enderror" id="level_user_id"
                        name="level_user_id">
                        @foreach($level as $level)
                        <option value="{{ $akses->level_user_id }}" @if($level->id==$akses->level_user_id)
                            selected='selected'
                            @endif >{{ $level->id}} - {{ $level->nama_level_user}}</option>
                        @endforeach
                    </select>

                    @error('level_user_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                </div>

                <div class="form-group">
                    <label for="id-menu">ID Menu</label>


                    <select class="form-control @error('menu_id') is-invalid @enderror" id="menu_id" name="menu_id">
                        @foreach($menu as $menu)
                        <option value="{{ $akses->menu_id }}" @if($menu->id==$akses->menu_id)
                            selected='selected'
                            @endif >{{ $menu->id}} - {{ $menu->nama_menu}}</option>
                        @endforeach
                    </select>

                    @error('menu_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>



                <button type="submit" class="btn btn-success">Edit Akses</button>
            </form>


        </div>
    </div>
</div>
@endsection

@push(' page-scripts') @endpush