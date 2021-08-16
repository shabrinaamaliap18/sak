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
use App\Models\forms\History;
use Carbon\Carbon;

class LapOpdDkrthController extends Controller
{
    public function index()
    {


        $pegawai = Form::join('pegawai', 'pegawai_id', '=', 'pegawai.id')
            //  ->where('pegawai_id',  $id)
            ->get(['pegawai.*', 'nama_pegawai', 'jabatan']);

        // if(auth()->id()->jabatan == opd_dinkes){


        $forms = Form::join('acc_dkrth', 'acc_dkrth.form_kk_id', '=', 'form_kk.id')
            ->where('id_opd_dkrth', '=', Auth::user()->pegawai_id)
            ->get(['form_kk.*'])->unique();




        // dd($forms);

        return view('masterreport.lapopddkrth', ['forms' => $forms], ['pegawai' => $pegawai]);
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

        // $pegawai2 = Pegawai::join('master_pegawai', 'id_opd_dinkes', '=', 'pegawai.id')
        //     ->where('jabatan', 'opd dinkes')
        //     ->get(['pegawai.*']);

        // dd($pegawai2);

        $keputusan = DB::table('acc_dkrth')
            ->where('form_kk_id',  $id)
            ->get('acc_dkrth.*');


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


            $history = History::join('form_kk', 'form_kk_id', '=', 'form_kk.id')
            ->join('pegawai', 'id_pengirim', '=', 'pegawai.id')
            // -> join('pegawai', 'tim.master_pegawai', '=', 'pegawai.id')
            ->where('form_kk_id',  $id)
            ->get(['histories.*', 'pegawai.*']);

        $user = DB::table('pegawai')->get();

        return view('masterreport.lapopddkrth-show', compact('forms', 'pegawai', 'penduduk', 'tim', 'tim2', 'posyandu', 'satgas_pbkm', 'fasil', 'pegawai', 'tim2', 'history', 'user','keputusan'));
    }
    
    public function teruskan(Request $request, Form $forms)
    {

        $forms_2 = Form::find($request->id_form);
        $forms_2->acc_dk = $request->status;
        $forms_2->keterangan = $request->keterangan;
        $forms_2->save();

        $forms_3 = ACCDkrth::find($request->id_form);
        $forms_3->keputusan_dkrth = $forms_2->acc_dk;
        $forms_3->save();



        $fasil = Fasil::join('form_kk', 'form_kk_id', '=', 'form_kk.id')
            ->where('form_kk_id',  $request->id_form)
            ->get(['form_fasil_lingkungan.*']);

        $forms = Form::find($request->id_form);
        $opd_dkrth = ($request->input('id_opd_dkrth'));

        //history
        $dt = Carbon::now();
        $todayDate = $dt->toDayDateTimeString();

        $dt2 = Carbon::now();
        $todayDate2 = $dt2->toDayDateTimeString();



        if ($forms->acc_din == '1'  && $forms->acc_dp == '1'  && $forms->acc_dk == '1') {
            $forms_4 = Form::find($request->id_form);
            $forms_4->status = 'Verifikasi Diterima';
            $forms_4->save();
        }

        if ($forms->acc_din == null) {

            $forms_4 = Form::find($request->id_form);
            $forms_4->status = 'Menunggu Verifikasi OPD Lain';
            $forms_4->save();
        }

        if ($forms->acc_dp == null) {

            $forms_4 = Form::find($request->id_form);
            $forms_4->status = 'Menunggu Verifikasi OPD Lain';
            $forms_4->save();
        }

        if ($forms->acc_dk == null) {

            $forms_4 = Form::find($request->id_form);
            $forms_4->status = 'Menunggu Verifikasi OPD Lain';
            $forms_4->save();
        }


        if ($forms->acc_din == '0' && $forms->acc_dp == '1'  && $forms->acc_dk == '1') {

            $forms_4 = Form::find($request->id_form);
            $forms_4->status = 'Verifikasi Ditolak';
            $forms_4->save();
        }

        if ($forms->acc_din == '0'  || $forms->acc_dp == '0' || $forms->acc_dk == '0') {

            $forms_4 = Form::find($request->id_form);
            $forms_4->status = 'Verifikasi Ditolak';
            $forms_4->save();
        }

        // opd dkrth
        $opd_dkrth = ($request->input('id_opd_dkrth'));

        $forms = Form::find($request->id_form);

        History::create([
            'form_kk_id' => $request->id_form,
            'id_pengirim' => Auth::user()->id,
            'id_penerima' => $forms_2->pegawai_id,
            'judul' => 'Verifikasi Dkrth Disimpan',
            'nama_proses' => $forms_4->status,
            'keterangan' => $request->keterangan,
            'tanggal_acc' => $todayDate2,
            'date_time' => $todayDate,
        ]);


        // dd($forms_3);






        // $tim = Tim::join('pegawai', 'tim.master_pegawai', '=', 'pegawai.id')
        //     ->where('id_pegawai', auth()->id())
        //     ->orWhere('jabatan',  'opd dinkes')
        //     ->orWhere('jabatan',  'opd dp5a')
        //     ->orWhere('jabatan',  'opd dkrth')
        //     ->get(['tim.*', 'nama_pegawai', 'master_pegawai', 'jabatan']);

        // $status1 = Form::join('acc_dinkes', 'form_kk_id', '=', 'form_kk.id')
        //     ->where('form_kk_id', $request->id_form)
        //     ->get(['form_kk_id', 'status', 'keputusan_dinkes']);

        // $status2 = Form::join('acc_dp5a', 'form_kk_id', '=', 'form_kk.id')
        //     ->where('form_kk_id',  $request->id_form)
        //     ->get(['form_kk_id', 'status', 'keputusan_dp5a']);

        // $status3 = Form::join('acc_dkrth', 'form_kk_id', '=', 'form_kk.id')
        //     ->where('form_kk_id',  $request->id_form)
        //     ->get(['form_kk_id', 'status', 'keputusan_dkrth']);




        // foreach ($tim as $tim) {
        //     if ($tim->master_pegawai != null) {
        //         foreach ($status1 as $st1) {
        //             foreach ($status2 as $st2) {
        //                 foreach ($status3 as $st3) {
        //                     if ($st1->keputusan_dinkes == 'Verifikasi Diterima' && $st2->keputusan_dp5a == 'Verifikasi Diterima' && $st3->keputusan_dkrth == 'Verifikasi Diterima') {
        //                         $forms_4 = Form::find($request->id_form);
        //                         $forms_4->status = 'Verifikasi Selesai';
        //                         $forms_4->save();
        //                     }
        //                 }
        //             }
        //         }
        //     }
        // }
        return redirect('/lapopddkrth')->with('status', 'Data berhasil diteruskan!');
    }

    public function teruskanhonor(Request $request, Form $forms)
    {
        // $forms_2 = ACCHonor::find($request->id_form);
        // $forms_2->keputusan_honor = $request->keputusan_honor;
        // $forms_2->save();

        $forms_3 = Form::find($request->id_form);
        $forms_3->status = 'Honor Terverifikasi';
        $forms_3->save();

        $honor = ($request->input('id_opd_honor'));
        if ($honor != null) {
            for ($i = 0; $i < count($honor); $i++) {
                ACCHonor::create([
                    'form_kk_id' => $request->id_form,

                    'id_opd_honor' => $honor[$i],
                ]);
            }
        }

        return redirect('/lapopddkrth')->with('status', 'Data berhasil diteruskan!');
    }

    public function revisi(Request $request, Form $forms)
    {
        // $forms_2 = ACCHonor::find($request->id_form);
        // $forms_2->keputusan_honor = $request->keputusan_honor;
        // $forms_2->save();

        $forms_3 = Form::find($request->id_form);
        $forms_3->status = 'Proses Revisi';
        $forms_3->save();

        $kader = ($request->input('pegawai_id'));
        if ($kader != null) {
            for ($i = 0; $i < count($kader); $i++) {
                $forms_4 = Form::find($request->id_form);
                $forms_4->id  = $request->id_form;
                $forms_4->pegawai_id  = $kader[$i];
                $forms_4->save();
            }
        }


        return redirect('/lapopddkrth')->with('status', 'Data berhasil diteruskan!');
    }
}