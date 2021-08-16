<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use App\Models\Tim;
use Illuminate\Http\Request;



class MasterTimController extends Controller
{

    public function tambah($id)
    {

        $pegawai = Pegawai::find($id);
        $pegawai2 = Pegawai::paginate(10);;


        $tim = Tim::join('pegawai', 'tim.master_pegawai', '=', 'pegawai.id')
            ->get(['tim.*', 'nama_pegawai'])
            ->where('id_pegawai', $id);


        return view('admin.tim-tambah', compact('pegawai', 'tim', 'pegawai2'));
    }


    public function store(Request $request, Tim $tim)
    {

        Tim::create([
            'id_pegawai' => $request->id_pegawai,
            'master_pegawai' => $request->master_pegawai,
        ]);

        return redirect('/pegawai')->with('status', 'Data tim Berhasil Ditambahkan!');
    }


    public function delete($id)
    {
        $tim = Tim::find($id);
        $tim->delete();
        return redirect('/pegawai')->with('status', 'Data tim Berhasil Dihapus!');
    }
}