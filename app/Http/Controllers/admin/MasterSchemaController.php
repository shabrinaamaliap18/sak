<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Schema;
use App\Models\Level;
use App\Models\Menu;
use App\Models\Role;
use Illuminate\Http\Request;



class MasterSchemaController extends Controller
{

    public function index()
    {
        $schema = Schema::all();
        return view('admin.schema', ['schema' => $schema]);
    }

    public function tambah()
    {
        $schema = Schema::all();
        return view('admin.schema-tambah', compact('schema'));
    }


    public function store(Request $request, schema $schema)
    {
        $this->validate($request, [
            'nama_schema' => 'required'
        ]);

        schema::create([
            'nama_schema' => $request->nama_schema
        ]);

        return redirect('/schema')->with('status', 'Data schema Berhasil Ditambahkan!');
    }

    public function edit($id, schema $schema)

    {
        $schema = schema::find($id);
        return view('admin.schema-edit', compact('schema'));
    }

    public function update($id, Request $request, schema $schema)
    {
        $this->validate($request, [
            'nama_schema' => 'required',
        ]);

        $schema = schema::find($id);
        $schema->schema = $request->schema;



        $schema->save();
        return redirect('/schema')->with('status', 'Data schema Berhasil Diubah!');
    }

    public function delete($id)
    {
        $schema = Schema::find($id);
        $schema->delete();
        return redirect('/schema')->with('status', 'Data schema Berhasil Dihapus!');
    }

    public function trash()
    {
        // mengambil data schema yang sudah dihapus
        $schema = Schema::onlyTrashed()->get();
        return view('admin.schema-trash', ['schema' => $schema]);
    }

    // restore data schema yang dihapus
    public function kembalikan($id)
    {
        $schema = Schema::onlyTrashed()->where('id', $id);
        $schema->restore();
        return redirect('/schema')->with('status', 'Data schema Berhasil Dikembalikan!');
    }

    // restore semua data schema yang sudah dihapus
    public function kembalikan_semua()
    {

        $schema = Schema::onlyTrashed();
        $schema->restore();

        return redirect('/schema')->with('status', 'Data schema Berhasil Dikembalikan!');
    }

    // hapus permanen
    public function hapus_permanen($id)
    {
        // hapus permanen data schema
        $schema = Schema::onlyTrashed()->where('id', $id);
        $schema->forceDelete();

        return redirect('/schema/trash')->with('status', 'Data schema Berhasil Dihapus!');
    }

    // hapus permanen semua schema yang sudah dihapus
    public function hapus_permanen_semua()
    {
        // hapus permanen semua data schema yang sudah dihapus
        $schema = Schema::onlyTrashed();
        $schema->forceDelete();

        return redirect('/schema/trash')->with('status', 'Data schema Berhasil Dihapus!');
    }


    public function cari(Request $request)
    {
        // menangkap data pencarian
        $cari = $request->get('cari');
        $schema = Schema::all();

        if ($cari) {
            $schema = Schema::where("nama_schema", "like", "%$cari%")->get();
        }


        return view('admin.schema', compact('schema'));
    }
}