<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\workflow;
use App\Models\Level;
use App\Models\Menu;
use App\Models\Role;
use Illuminate\Http\Request;



class MasterWorkflowController extends Controller
{

    public function index()
    {
        $workflow = Workflow::all();
        return view('admin.workflow', ['workflow' => $workflow]);
    }

    public function tambah()
    {
        $workflow = Workflow::all();
        return view('admin.workflow-tambah', compact('workflow'));
    }


    public function store(Request $request, workflow $workflow)
    {
        $this->validate($request, [
            'nama_workflow' => 'required'
        ]);

        Workflow::create([
            'nama_workflow' => $request->nama_workflow
        ]);

        return redirect('/workflow')->with('status', 'Data workflow Berhasil Ditambahkan!');
    }

    public function edit($id, workflow $workflow)

    {

        $workflow = Workflow::find($id);
        return view('admin.workflow-edit', compact('workflow'));
    }

    public function update($id, Request $request, workflow $workflow)
    {
        $this->validate($request, [
            'nama_workflow' => 'required',
        ]);

        $workflow = Workflow::find($id);
        $workflow->workflow = $request->workflow;



        $workflow->save();
        return redirect('/workflow')->with('status', 'Data workflow Berhasil Diubah!');
    }

    public function delete($id)
    {
        $workflow = Workflow::find($id);
        $workflow->delete();
        return redirect('/workflow')->with('status', 'Data workflow Berhasil Dihapus!');
    }

    public function trash()
    {
        // mengampil data workflow yang sudah dihapus
        $workflow = Workflow::onlyTrashed()->get();
        return view('admin.workflow-trash', ['workflow' => $workflow]);
    }

    // restore data workflow yang dihapus
    public function kembalikan($id)
    {
        $workflow = Workflow::onlyTrashed()->where('id', $id);
        $workflow->restore();
        return redirect('/workflow')->with('status', 'Data workflow Berhasil Dikembalikan!');
    }

    // restore semua data workflow yang sudah dihapus
    public function kembalikan_semua()
    {

        $workflow = Workflow::onlyTrashed();
        $workflow->restore();

        return redirect('/workflow')->with('status', 'Data workflow Berhasil Dikembalikan!');
    }

    // hapus permanen
    public function hapus_permanen($id)
    {
        // hapus permanen data workflow
        $workflow = Workflow::onlyTrashed()->where('id', $id);
        $workflow->forceDelete();

        return redirect('/workflow/trash')->with('status', 'Data workflow Berhasil Dihapus!');
    }

    // hapus permanen semua workflow yang sudah dihapus
    public function hapus_permanen_semua()
    {
        // hapus permanen semua data workflow yang sudah dihapus
        $workflow = Workflow::onlyTrashed();
        $workflow->forceDelete();

        return redirect('/workflow/trash')->with('status', 'Data workflow Berhasil Dihapus!');
    }


    public function cari(Request $request)
    {
        // menangkap data pencarian
        $cari = $request->get('cari');
        $workflow = Workflow::all();

        if ($cari) {
            $workflow = Workflow::where("nama_workflow", "like", "%$cari%")->get();
        }


        return view('admin.workflow', compact('workflow'));
    }
}