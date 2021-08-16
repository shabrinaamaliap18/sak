<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Proses;
use App\Models\Schema;
use App\Models\Workflow;
use Illuminate\Http\Request;



class MasterProsesController extends Controller
{

    public function index()
    {

        // Join table proses, workflow dan schema untuk mendapatkan nama schema dan nama workflow
        $proses = proses::join('schema', 'schema_sebelum', '=', 'schema.id')
            ->join('workflow', 'flow_id', '=', 'workflow.id')
            ->get(['proses.*', 'nama_schema', 'nama_workflow']);

        return view('admin.proses', ['proses' => $proses]);
    }

    public function tambah()
    {
        //Memanggil workflow dan schema sebagai fk
        $workflow = workflow::all();
        $schema = schema::all();
        return view('admin.proses-tambah', compact('workflow', 'schema'));
    }


    public function store(Request $request, Proses $proses)
    {

        Proses::create([
            'flow_id' => $request->flow_id,
            'schema_sebelum' => $request->schema1,
            'schema_sesudah' => $request->schema2,
            'urutan' => $request->urutan,
        ]);

        return redirect('/proses')->with('status', 'Data proses Berhasil Ditambahkan!');
    }

    public function edit($id, proses $proses)

    {

        $proses2 = proses::all();
        $proses = proses::find($id);
        $schema = Schema::all();
        $workflow = workflow::all();
        return view('admin.proses-edit', compact('proses', 'schema', 'workflow', 'proses2'));
    }

    public function update($id, Request $request, proses $proses)
    {


        $proses = proses::find($id);
        $proses->flow_id = $request->flow_id;
        $proses->schema_sebelum = $request->schema1;
        $proses->schema_sesudah = $request->schema2;
        $proses->urutan = $request->urutan;
        $proses->save();
        return redirect('/proses')->with('status', 'Data proses Berhasil Diubah!');
    }

    public function delete($id)
    {
        $proses = Proses::find($id);
        $proses->delete();
        return redirect('/proses')->with('status', 'Data proses Berhasil Dihapus!');
    }

    public function trash()
    {
        // mengambil data proses yang sudah dihapus
        $proses = proses::join('schema', 'schema_sebelum', '=', 'schema.id')
            ->join('workflow', 'flow_id', '=', 'workflow.id')->onlyTrashed()->get(['proses.*', 'nama_schema', 'nama_workflow']);
        return view('admin.proses-trash', ['proses' => $proses]);
    }

    // restore data proses yang dihapus
    public function kembalikan($id)
    {
        $proses = Proses::onlyTrashed()->where('id', $id);
        $proses->restore();
        return redirect('/proses')->with('status', 'Data proses Berhasil Dikembalikan!');
    }

    // restore semua data proses yang sudah dihapus
    public function kembalikan_semua()
    {

        $proses = Proses::onlyTrashed();
        $proses->restore();

        return redirect('/proses')->with('status', 'Data proses Berhasil Dikembalikan!');
    }

    // hapus permanen
    public function hapus_permanen($id)
    {
        // hapus permanen data proses
        $proses = Proses::onlyTrashed()->where('id', $id);
        $proses->forceDelete();

        return redirect('/proses/trash')->with('status', 'Data proses Berhasil Dihapus!');
    }

    // hapus permanen semua proses yang sudah dihapus
    public function hapus_permanen_semua()
    {
        // hapus permanen semua data proses yang sudah dihapus
        $proses = Proses::onlyTrashed();
        $proses->forceDelete();

        return redirect('/proses/trash')->with('status', 'Data proses Berhasil Dihapus!');
    }


    public function cari(Request $request)
    {
        // menangkap data pencarian
        $cari = $request->get('cari');
        $proses = Proses::all();

        if ($cari) {
            $proses = proses::join('schema', 'schema_id', '=', 'schema.id')
                ->join('workflow', 'flow_id', '=', 'workflow.id')
                ->where("nama_workflow", "like", "%$cari%")->get();
        }


        return view('admin.proses', compact('proses'));
    }
}