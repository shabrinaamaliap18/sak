@extends('layouts.master')
@section('title', 'Laravel')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class=" section-header">
                <h1>Edit Proses</h1>
            </div>

            <form method="post" action="/proses/update/{{$proses->id}}">

                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <br>

                <div class="form-group">
                    <label for="id-schema">Pilih Workflow</label>

                    <select class="form-control" id="flow_id" name="flow_id">

                        @foreach($workflow as $workflow)
                        <option value="{{ $proses->flow_id }}" @if($workflow->id==$proses->flow_id)
                            selected='selected'
                            @endif >{{ $workflow->id}} - {{ $workflow->nama_workflow}}</option>
                        @endforeach
                    </select>
                </div>


                <div class="form-group">
                    <label for="id-schema">Pilih Schema Sebelum</label>

                    <select class="form-control" id="schema1" name="schema1" required>
                        <!-- <option selected>Pilih Level User</option> -->
                        @foreach($schema as $schema1)
                        <option value="{{ $schema1['id'] }}" @if($schema1->id==$proses->schema_id)
                            selected='selected'
                            @endif >{{ $schema1['id']}} - {{ $schema1['nama_schema']}}</option>
                        @endforeach
                    </select>
                </div>


                <div class="form-group">
                    <label for="id-schema">Pilih Schema Sesudah</label>

                    <select class="form-control" id="schema2" name="schema2" required>
                        <!-- <option selected>Pilih Level User</option> -->
                        @foreach($schema as $schema2)
                        <option value="{{ $schema2['id'] }}" @if($schema2->id==$proses->schema_id)
                            selected='selected'
                            @endif >{{ $schema2['id']}} - {{ $schema2['nama_schema']}}</option>
                        @endforeach
                    </select>
                </div>





                <div class="form-group">
                    <label for="id-urutan">Urutan</label>
                    <input type="text" class="form-control" id="urutan" placeholder="Urutan" name="urutan"
                        value="{{$proses->urutan}}" required>
                </div>

                <button type="submit" class="btn btn-success">Edit Proses</button>
            </form>


        </div>
    </div>
</div>

@endsection

@push('page-scripts')
@endpush