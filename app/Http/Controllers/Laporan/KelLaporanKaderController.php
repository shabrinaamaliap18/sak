<?php

namespace App\Http\Controllers\laporan;

use App\Http\Controllers\Controller;
use App\Models\forms\ACCDinkes;
use App\Models\forms\ACCDkrth;
use App\Models\forms\ACCDp5a;
use App\Models\forms\ACCKoor;
use App\Models\forms\Fasil;
use App\Models\forms\Form;
use App\Models\forms\History;
use App\Models\forms\Penduduk;
use App\Models\forms\Posyandu;
use App\Models\forms\Satgas;
use App\Models\Tim;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class KelLaporanKaderController extends Controller
{
    public function index()
    {

        $forms = Form::all();
        $pegawai = Form::join('pegawai', 'pegawai_id', '=', 'pegawai.id')
            ->get(['pegawai.*', 'nama_pegawai']);

        return view('laporan.kellaporankader', ['forms' => $forms], ['pegawai' => $pegawai]);
    }

    public function show(Request $request, Form $forms, $id)
    {
        $forms = Form::find($id);

        $pegawai = Form::join('pegawai', 'pegawai_id', '=', 'pegawai.id')
            //  ->where('pegawai_id',  $id)
            ->get(['pegawai.*', 'nama_pegawai']);

        $penduduk = Penduduk::join('form_kk', 'form_kk_id', '=', 'form_kk.id')
            ->where('form_kk_id',  $id)
            ->get(['form_penduduk.*']);

        $posyandu = Posyandu::join('form_kk', 'form_kk_id', '=', 'form_kk.id')
            ->where('form_kk_id',  $id)
            ->get(['form_posyandu_remaja.*']);

        $satgas_pbkm = Satgas::join('form_kk', 'form_kk_id', '=', 'form_kk.id')
            ->where('form_kk_id',  $id)
            ->get(['form_satgas_pbkm.*']);

        $fasil = Fasil::join('form_kk', 'form_kk_id', '=', 'form_kk.id')
            ->where('form_kk_id',  $id)
            ->get(['form_fasil_lingkungan.*']);

        // dd($penduduk);

        $tim = Tim::join('pegawai', 'tim.master_pegawai', '=', 'pegawai.id')
            ->get(['tim.*', 'nama_pegawai', 'master_pegawai', 'jabatan'])
            ->where('id_pegawai',  auth()->id())
            ->where('jabatan',  'koordinator'); //menampilkan data tim setiap id
        // dd($tim);

        $tim2 = Tim::join('pegawai', 'tim.master_pegawai', '=', 'pegawai.id')
            ->get(['tim.*', 'nama_pegawai', 'master_pegawai', 'jabatan'])
            ->where('id_pegawai',   auth()->id())
            ->where('jabatan',  'opd dinkes'); //menampilkan data tim setiap id

        $history = History::join('form_kk', 'form_kk_id', '=', 'form_kk.id')
            ->join('pegawai', 'pegawai_id', '=', 'pegawai.id')
            // -> join('pegawai', 'tim.master_pegawai', '=', 'pegawai.id')
            ->where('form_kk_id',  $id)
            ->get(['histories.*', 'nama_pegawai', 'jabatan']);
        // dd($history); 

        $history2 = ACCKoor::join('form_kk', 'form_kk_id', '=', 'form_kk.id')
            ->join('pegawai', 'id_koordinator', '=', 'pegawai.id')
            ->where('form_kk_id',  $id)
            ->get(['id_koordinator', 'nama_pegawai', 'jabatan']);
        // dd($history2);

        $history3 = ACCDinkes::join('form_kk', 'form_kk_id', '=', 'form_kk.id')
            ->join('pegawai', 'id_opd_dinkes', '=', 'pegawai.id')
            ->where('form_kk_id',  $id)
            ->get(['id_opd_dinkes', 'nama_pegawai', 'jabatan']);
        // dd($history3);


        $history4 = ACCDkrth::join('form_kk', 'form_kk_id', '=', 'form_kk.id')
            ->join('pegawai', 'id_opd_dkrth', '=', 'pegawai.id')
            ->where('form_kk_id',  $id)
            ->get(['id_opd_dkrth', 'nama_pegawai', 'jabatan']);
        // dd($history5);

        $history5 = ACCDp5a::join('form_kk', 'form_kk_id', '=', 'form_kk.id')
            ->join('pegawai', 'id_opd_dp5a', '=', 'pegawai.id')
            ->where('form_kk_id',  $id)
            ->get(['id_opd_dp5a', 'nama_pegawai', 'jabatan']);
        // dd($history4);


        return view('laporan.kellaporankader-show', compact('forms', 'pegawai','penduduk', 'tim', 'tim2', 'posyandu', 'satgas_pbkm', 'fasil', 'pegawai', 'tim2', 'history', 'history2', 'history3', 'history4', 'history5'));
    }

    public function search(Request $request)
    {
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');

        $query = DB::table('form_kk')->select()
            ->where('tanggal_input', '>=', $fromDate)
            ->where('tanggal_input', '<=', $toDate)
            ->get();

        // dd($query);

        $forms = Form::all();


        return view('laporan.kellaporankader-date', compact('forms', 'query'));
    }

    public function cari(Request $request)
    {
        $forms = Form::sortable()->paginate(10);
        $skipped = ($forms->currentPage() * $forms->perPage()) - $forms->perPage();
        // menangkap data pencarian
        $cari = $request->get('cari');
        $forms = Form::all();

        if ($cari) {
            $forms = Form::where("no_kk", "like", "%$cari%")->sortable()->paginate(5);
        }



        return view('laporan.kellaporankader', compact('forms', 'skipped'));
    }
}