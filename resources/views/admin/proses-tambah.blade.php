@extends('layouts.master')
@section('title', 'Laravel')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class=" section-header">
                <h1>Tambah Proses</h1>
            </div>

            <form method="post" action="/proses" enctype="multipart/form-data">
                @csrf
                <br>

                <div class="form-group">
                    <label for="id-workflow">Pilih ID Workflow</label>

                    <select class="form-control" id="flow_id" name="flow_id" required>
                        <@foreach ($workflow as $flow) <option value="{{ $flow->id}} ">{{$flow->id}} -
                            {{$flow->nama_workflow}}</option>
                            </option>
                            @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="id-schema1">Pilih Schema Sebelum</label>

                    <select class="form-control" id="schema1" name="schema1" required>
                        <@foreach ($schema as $schema1) <option value="{{ $schema1['id']}} ">{{$schema1['id']}} -
                            {{$schema1['nama_schema']}}</option>
                            </option>
                            @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="id-schema2">Pilih Schema Sesudah</label>

                    <select class="form-control" id="schema2" name="schema2" required>
                        <@foreach ($schema as $schema2) <option value="{{ $schema2['id']}} ">{{$schema2['id']}} -
                            {{$schema2['nama_schema']}}</option>
                            </option>
                            @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="id-urutan">Urutan</label>
                    <input type="integer" class="form-control" id="urutan" placeholder="Urutan" name="urutan" required>
                </div>

                <button type="submit" class="btn btn-success">Tambah Proses</button>
            </form>


        </div>
    </div>
</div>

@endsection

@push('page-scripts')
@endpush