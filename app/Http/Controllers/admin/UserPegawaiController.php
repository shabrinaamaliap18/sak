<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use App\Models\Tim;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserPegawaiController extends Controller
{

    public function index()
    {
        $pegawai = Pegawai::sortable()->paginate(10);
        $skipped = ($pegawai->currentPage() * $pegawai->perPage()) - $pegawai->perPage();
        return view('admin.pegawai', ['pegawai' => $pegawai], ['skipped' => $skipped]);
    }

    public function tambah()
    {
        $pegawai = Pegawai::all();

        $pegawai2 = DB::table('pegawai')->where('jabatan', 'koordinator')
            ->where("jabatan", "koordinator")
            ->orWhere("jabatan", "opd dinkes")
            ->orWhere("jabatan", "opd dp5a")
            ->orWhere("jabatan", "opd dkrth")
            ->get();

        return view('admin.pegawai-tambah', compact('pegawai', 'pegawai2'));
    }


    public function store(Request $request, Pegawai $pegawai)
    {

        $request->validate([
            'nama_pegawai' => 'required',
            'NIP' => 'required',
            'NIK' => 'required',
            'jenis_kelamin' => 'required',
            'jabatan' => 'required',
            'tanggal_lahir' => 'required',
            'foto_pegawai' =>  ['required', 'mimes:jpeg,png,JPG,gif,svg'],
        ]);

        $foto_pegawai = $request->foto_pegawai->getClientOriginalName();
        $request->foto_pegawai->move(public_path('image'), $foto_pegawai);
        
        $lastid = Pegawai::create(([
            'nama_pegawai' => $request->nama_pegawai,
            'NIP' => $request->NIP,
            'NIK' => $request->NIK,
            'jabatan' => $request->jabatan,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'foto_pegawai' => $foto_pegawai,

        ]))->id;
        if (count($request->master_pegawai) > 0) {
            foreach ($request->master_pegawai as $tim => $v) {
                if ($request->master_pegawai[$tim] != null) {
                    $data2 = array(
                        'id_pegawai' => $lastid,
                        'master_pegawai' => $request->master_pegawai[$tim],
                    );

                    Tim::insert($data2);
                }
            }
        }


    


        return redirect('/pegawai')->with('status', 'Data pegawai Berhasil Ditambahkan!');
    }

    public function edit($id, Pegawai $pegawai)

    {
        $pegawai = Pegawai::find($id);


        $tim = Tim::join('pegawai', 'tim.master_pegawai', '=', 'pegawai.id')
            ->get(['tim.*', 'nama_pegawai'])
            ->where('id_pegawai', $id); //menampilkan data tim setiap id


        return view('admin.pegawai-edit', compact('pegawai', 'tim'));
    }

    public function update(Request $request, Pegawai $pegawai)
    {
        $request->validate([
            'nama_pegawai' => 'required',
            'NIP' => 'required',
            'NIK' => 'required',
            'jenis_kelamin' => 'required',
            'jabatan' => 'required',
            'tanggal_lahir' => 'required',
            'foto_pegawai' =>  'sometimes',
        ]);

        $pegawai_2 = $request->file('foto_pegawai');


        if (file_exists($pegawai_2)) {
            $pegawai_2->move(public_path('image'), $pegawai_2->getClientOriginalName());
            $pegawai->foto_pegawai = $pegawai_2->getClientOriginalName();
        }

        $pegawai->nama_pegawai = $request->nama_pegawai;
        $pegawai->NIP = $request->NIP;
        $pegawai->NIK = $request->NIK;
        $pegawai->jenis_kelamin = $request->jenis_kelamin;
        $pegawai->jabatan = $request->jabatan;
        $pegawai->tanggal_lahir = $request->tanggal_lahir;


        // dd($request);
        $pegawai->save();
        return redirect('/pegawai')->with('status', 'Data pegawai Berhasil Diubah!');
    }

    public function delete($id)
    {
        $pegawai = Pegawai::find($id);
        $pegawai->delete();
        return redirect('/pegawai')->with('status', 'Data pegawai Berhasil Dihapus!');
    }

    public function trash()
    {
        // mengambil data pegawai yang sudah dihapus
        $pegawai = Pegawai::onlyTrashed()->get();
        return view('admin.pegawai-trash', ['pegawai' => $pegawai]);
    }

    // restore data pegawai yang dihapus
    public function kembalikan($id)
    {
        $pegawai = Pegawai::onlyTrashed()->where('id', $id);
        $pegawai->restore();
        return redirect('/pegawai')->with('status', 'Data pegawai Berhasil Dikembalikan!');
    }

    // restore semua data pegawai yang sudah dihapus
    public function kembalikan_semua()
    {

        $pegawai = Pegawai::onlyTrashed();
        $pegawai->restore();

        return redirect('/pegawai')->with('status', 'Data pegawai Berhasil Dikembalikan!');
    }

    // hapus permanen
    public function hapus_permanen($id)
    {
        // hapus permanen data pegawai
        $pegawai = Pegawai::onlyTrashed()->where('id', $id);
        $pegawai->forceDelete();

        return redirect('/pegawai/trash')->with('status', 'Data pegawai Berhasil Dihapus!');
    }

    // hapus permanen semua pegawai yang sudah dihapus
    public function hapus_permanen_semua()
    {
        // hapus permanen semua data pegawai yang sudah dihapus
        $pegawai = Pegawai::onlyTrashed();
        $pegawai->forceDelete();

        return redirect('/pegawai/trash')->with('status', 'Data pegawai Berhasil Dihapus!');
    }


    public function cari(Request $request)
    {
        $pegawai = Pegawai::sortable()->paginate(10);
        $skipped = ($pegawai->currentPage() * $pegawai->perPage()) - $pegawai->perPage();
        // menangkap data pencarian
        $cari = $request->get('cari');
        $pegawai = Pegawai::all();

        if ($cari) {
            $pegawai = Pegawai::where("nama_pegawai", "like", "%$cari%")->sortable()->paginate(5);
        }
        


        return view('admin.pegawai', compact('pegawai','skipped'));
    }

    public function getSub()
    {
        $pegawai2 = DB::table('pegawai')
            ->where("jabatan", "koordinator")
            ->orWhere("jabatan", "opd dinkes")
            ->orWhere("jabatan", "opd dp5a")
            ->orWhere("jabatan", "opd dkrth")
            ->pluck("nama_pegawai", "id");

            return json_encode($pegawai2);
    }
}