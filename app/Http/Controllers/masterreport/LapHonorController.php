<?php

namespace App\Http\Controllers\masterreport;

use App\Http\Controllers\Controller;
use App\Models\forms\ACCKoor;
use App\Models\forms\Fasil;
use App\Models\forms\Form;
use App\Models\forms\Penduduk;
use App\Models\forms\Posyandu;
use App\Models\forms\Satgas;
use App\Models\forms\ACCDinkes;
use App\Models\forms\ACCDkrth;
use App\Models\forms\ACCDp5a;
use App\Models\forms\ACCHonor;
use App\Models\Pegawai;
use App\Models\Tim;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LapHonorController extends Controller
{
    public function index()
    {

        $pegawai = Form::join('pegawai', 'pegawai_id', '=', 'pegawai.id')
            //  ->where('pegawai_id',  $id)
            ->get(['pegawai.*', 'nama_pegawai', 'jabatan']);

        $forms = Form::join('acc_honor', 'acc_honor.form_kk_id', '=', 'form_kk.id')
            ->where('id_opd_honor', '=', Auth::user()->pegawai_id)
            ->get(['form_kk.*'])->unique();


        return view('masterreport.laphonor', ['forms' => $forms],  ['pegawai' => $pegawai]);
    }

    public function show(Request $request, Form $forms, $id)
    {


        $forms = Form::find($id);


        $pegawai = Form::join('pegawai', 'pegawai_id', '=', 'pegawai.id')
            //  ->where('pegawai_id',  $id)
            ->get(['pegawai.*', 'nama_pegawai', 'jabatan']);


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


        $tim = Tim::join('pegawai', 'tim.master_pegawai', '=', 'pegawai.id')
            ->where('id_pegawai', Auth::user()->pegawai_id)
            ->orWhere('jabatan',  'opd dinkes')
            ->orWhere('jabatan',  'opd dp5a')
            ->orWhere('jabatan',  'opd dkrth')
            ->get(['tim.*', 'nama_pegawai', 'master_pegawai', 'jabatan']); //menampilkan data tim setiap id
        // dd($tim);

        $tim2 = Tim::join('pegawai', 'tim.master_pegawai', '=', 'pegawai.id')
            ->where('id_pegawai', Auth::user()->pegawai_id)
            ->orWhere('jabatan',  'opd dinkes')
            ->get(['tim.*', 'nama_pegawai', 'master_pegawai', 'jabatan']);

        // dd($tim2);

        return view('masterreport.laphonor-show', compact('forms', 'tim', 'posyandu', 'satgas_pbkm', 'fasil', 'pegawai', 'penduduk'));
    }
    public function cari(Request $request)
    {
        $forms = Form::join('acc_honor', 'acc_honor.form_kk_id', '=', 'form_kk.id')
            ->where('id_opd_honor', '=', Auth::user()->pegawai_id)
            ->get(['form_kk.*'])->unique();
        // menangkap data pencarian
        $cari = $request->get('cari');
        $forms = Form::all();

        if ($cari) {
            $forms = Form::where("no_kk", "like", "%$cari%")->sortable()->paginate(5);
        }



        return view('masterreport.alllaporan', compact('forms'));
    }
}