<?php

namespace App\Http\Controllers\honor;
use App\Models\LihatHonor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LihatHonorController extends Controller
{
    public function index()
    {
        $lihathonor = LihatHonor::all();
        return view('honor.lihathonor', ['lihathonor' => $lihathonor]);
    }

    public function tambah()
    {
        $lihathonor = LihatHonor::all();
        return view('honor.lihathonor-tambah', compact('lihathonor'));
    }

    public function store(Request $request, LihatHonor $lihathonor)
    {

        $request->validate([
            'nama_kader' => 'required',
            'daftar_kegiatan' => 'required',
            'no_rekening' => 'required',
            'nominal' => 'required',
            'selip_gaji' => 'required',
        ]);
    

    $lastid = LihatHonor::create(([
        'nama_kader' => $request->nama_kader,
        'daftar_kegiatan' => $request->daftar_kegiatan,
        'no_rekening' => $request->no_rekening,
        'nominal' => $request->nominal,
        'selip_gaji' => $request->selip_gaji,
                ]))->id;
        
        return redirect('/lihathonor')->with('status', 'Data Honor Berhasil Ditambahkan!');
    }

    public function edit($id, LihatHonor $lihathonor)

    {
        $lihathonor = LihatHonor::all();
        $lihathonor = LihatHonor::find($id);
     
        return view('honor.lihathonor-edit', compact('lihathonor'));
        
    }

    public function update(Request $request, LihatHonor $lihathonor)
    {
        $request->validate([
            'nama_kader' => 'required',
            'daftar_kegiatan' => 'required',
            'no_rekening' => 'required',
            'nominal' => 'required',
            'selip_gaji' => 'required',
        ]);

        $lihathonor->nama_kader = $request->nama_kader;
        $lihathonor->daftar_kegiatan = $request->daftar_kegiatan;
        $lihathonor->no_rekening = $request->no_rekening;
        $lihathonor->nominal = $request->nominal;
        $lihathonor->selip_gaji = $request->selip_gaji;
      
        // dd($request);
        $lihathonor->save();
        return redirect('/lihathonor')->with('status', 'Data pegawai Berhasil Diubah!');
    }

    public function delete($id)
    {
        $lihathonor = LihatHonor::find($id);
        $lihathonor->delete();
        return redirect('/lihathonor')->with('status', 'Data pegawai Berhasil Dihapus!');
    }

    public function trash()
    {
        // mengambil data pegawai yang sudah dihapus
        $lihathonor = LihatHonor::onlyTrashed()->get();
        return view('honor.lihathonor-trash', ['lihathonor' => $lihathonor]);
    }

    // restore data pegawai yang dihapus
    public function kembalikan($id)
    {
        $lihathonor = LihatHonor::onlyTrashed()->where('id', $id);
        $lihathonor->restore();
        return redirect('/lihathonor')->with('status', 'Data Honor Berhasil Dikembalikan!');
    }

    // restore semua data pegawai yang sudah dihapus
    public function kembalikan_semua()
    {

        $lihathonor = LihatHonor::onlyTrashed();
        $lihathonor->restore();

        return redirect('/lihathonor')->with('status', 'Data Honor Berhasil Dikembalikan!');
    }

    // hapus permanen
    public function hapus_permanen($id)
    {
        // hapus permanen data pegawai
        $lihathonor = LihatHonor::onlyTrashed()->where('id', $id);
        $lihathonor->forceDelete();

        return redirect('/lihathonor/trash')->with('status', 'Data Honor Berhasil Dihapus!');
    }

    // hapus permanen semua pegawai yang sudah dihapus
    public function hapus_permanen_semua()
    {
        // hapus permanen semua data pegawai yang sudah dihapus
        $lihathonor = LihatHonor::onlyTrashed();
        $lihathonor->forceDelete();

        return redirect('/lihathonor/trash')->with('status', 'Data Honor Berhasil Dihapus!');
    }

    public function cari(Request $request)
    {
        // menangkap data pencarian
        $cari = $request->get('cari');
        $lihathonor = LihatHonor::all();

        if ($cari) {
            $lihathonor = LihatHonor::where("nama_kader", "like", "%$cari%")->get();
        }


        return view('honor.lihathonor', compact('lihathonor'));
    }


}