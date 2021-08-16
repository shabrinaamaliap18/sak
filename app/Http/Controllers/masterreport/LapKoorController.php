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

class LapKoorController extends Controller
{
    public function index()
    {


        $pegawai = Form::join('pegawai', 'pegawai_id', '=', 'pegawai.id')
            //  ->where('pegawai_id',  $id)
            ->get(['pegawai.*', 'nama_pegawai', 'jabatan']);

        $forms = Form::join('acc_koordinator', 'acc_koordinator.form_kk_id', '=', 'form_kk.id')
            ->where('id_koordinator', '=', Auth::user()->pegawai_id)
            ->get(['form_kk.*'])->unique();


        // dd($forms);

        return view('masterreport.lapkoor', ['forms' => $forms], ['pegawai' => $pegawai]);
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

        // dd($posyandu);

        $jumantik = DB::table('form_jumantik')
            ->where("form_kk_id", $id)->get();


        $tbc = DB::table('form_tbc')
            ->where("form_kk_id", $id)
            ->get(['form_tbc.*']);

        $rumahsehat = DB::table('form_rumah_sehat')
            ->where("form_kk_id", $id)->get();

        $pelita = DB::table('form_pelita')
            ->where("form_kk_id", $id)
            ->get(['form_pelita.*']);

        $kpasi = DB::table('form_kp_asi')
            ->where("form_kk_id", $id)->get();

        $ibuhamil = DB::table('form_ibu_hamil')
            ->where("form_kk_id", $id)->get();

        $posbindu = DB::table('form_posbindu')
            ->where("form_kk_id", $id)
            ->get(['form_posbindu.*']);


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

        $history = History::join('form_kk', 'form_kk_id', '=', 'form_kk.id')
            ->join('pegawai', 'id_pengirim', '=', 'pegawai.id')
            // -> join('pegawai', 'tim.master_pegawai', '=', 'pegawai.id')
            ->where('form_kk_id',  $id)
            ->get(['histories.*', 'pegawai.*']);



        $user = DB::table('pegawai')->get();

        return view('masterreport.lapkoor-show', compact('forms', 'pegawai', 'penduduk', 'tim', 'posyandu', 'satgas_pbkm', 'fasil', 'pegawai', 'history', 'user', 'pelita', 'tbc', 'jumantik', 'ibuhamil', 'posbindu', 'kpasi', 'rumahsehat'));
    }


    public function teruskan(Request $request, Form $forms, $id)
    {

        $posyandu = Posyandu::join('form_kk', 'form_kk_id', '=', 'form_kk.id')
            ->where('form_kk_id',  $id)
            ->get(['form_posyandu_remaja.*']);

        // dd($posyandu);

        $satgas_pbkm = Satgas::join('form_kk', 'form_kk_id', '=', 'form_kk.id')
            ->where('form_kk_id',  $id)
            ->get(['form_satgas_pbkm.*']);

        $fasil = Fasil::join('form_kk', 'form_kk_id', '=', 'form_kk.id')
            ->where('form_kk_id',  $id)
            ->get(['form_fasil_lingkungan.*']);




        $forms_koor = Form::find($request->id_form);
        // $forms_2->id_koordinator = $request->id_koordinator;
        $forms_koor->status = 'Menunggu Verifikasi OPD';
        $forms_koor->save();

        //history
        $dt = Carbon::now();
        $todayDate = $dt->toDayDateTimeString();

        $dt2 = Carbon::now();
        $todayDate2 = $dt2->toDayDateTimeString();

        // $koor = DB::table('histories')
        //     ->where('id_koordinator', '!=', null)
        //     ->where('form_kk_id', $id)
        //     ->get('id_koordinator');

        // dd($koor);



        // opd dinkes

        // buat boolean
        $opd_dinkes = ($request->input('id_opd_dinkes'));
        $opd_dp5a = ($request->input('id_opd_dp5a'));
        $opd_dkrth = ($request->input('id_opd_dkrth'));

        if ($opd_dinkes != null && $posyandu != null) {
            for ($i = 0; $i < count($opd_dinkes); $i++) {
                $forms_3 = Form::find($request->id_form);
                $forms_3->save();
            }
        } else {
            $forms_3 = Form::find($request->id_form);
            $forms_3->acc_din = '1';
            $forms_3->save();
        }

        if ($opd_dp5a != null && $satgas_pbkm != null) {
            for ($i = 0; $i < count($opd_dp5a); $i++) {
                $forms_3 = Form::find($request->id_form);
                $forms_3->save();
            }
        } else {
            $forms_3 = Form::find($request->id_form);
            $forms_3->acc_dp = '1';
            $forms_3->save();
        }

        if ($opd_dkrth != null && $fasil != null) {
            for ($i = 0; $i < count($opd_dkrth); $i++) {
                $forms_3 = Form::find($request->id_form);
                $forms_3->save();
            }
        } else {
            $forms_3 = Form::find($request->id_form);
            $forms_3->acc_dk = '1';
            $forms_3->save();
        }

        // null buat yg diisi
        // 1 buat yg nggak diisi + diterima
        // 0 buat tolak

        $opd_dinkes = ($request->input('id_opd_dinkes'));
        if ($opd_dinkes != null && $posyandu != null) {
            for ($i = 0; $i < count($opd_dinkes); $i++) {
                ACCDinkes::create([
                    'form_kk_id' => $request->id_form,
                    'id_opd' => '1',
                    'id_opd_dinkes' => $opd_dinkes[$i],
                ]);

                History::create([
                    'form_kk_id' => $request->id_form,
                    'id_pengirim' => Auth::user()->id,
                    'id_penerima' => $opd_dinkes[$i],
                    'judul' => 'Verifikasi ke Dinkes',
                    'keterangan' => $request->keterangan,
                    'nama_proses' => $forms_3->status,
                    'tanggal_acc' => $todayDate2,
                    'date_time' => $todayDate,
                ]);
            }
        }



        // opd dp5a
        $opd_dp5a = ($request->input('id_opd_dp5a'));
        if ($opd_dp5a != null && $satgas_pbkm != null) {
            for ($i = 0; $i < count($opd_dp5a); $i++) {
                ACCDp5a::create([
                    'form_kk_id' => $request->id_form,
                    'id_opd' => '2',
                    'id_opd_dp5a' => $opd_dp5a[$i],
                ]);

                History::create([
                    'form_kk_id' => $request->id_form,
                    'id_pengirim' => Auth::user()->id,
                    'id_penerima' => $opd_dp5a[$i],
                    'judul' => 'Verifikasi ke Dp5a',
                    'nama_proses' => $forms_3->status,
                    'tanggal_acc' => $todayDate2,
                    'date_time' => $todayDate,
                ]);
            }
        }


        // opd dkrth
        $opd_dkrth = ($request->input('id_opd_dkrth'));
        if ($opd_dkrth != null && $fasil != null) {
            for ($i = 0; $i < count($opd_dkrth); $i++) {
                ACCDkrth::create([
                    'form_kk_id' => $request->id_form,
                    'id_opd' => '3',
                    'id_opd_dkrth' => $opd_dkrth[$i],
                ]);

                History::create([
                    'form_kk_id' => $request->id_form,
                    'id_pengirim' => Auth::user()->id,
                    'id_penerima' => $opd_dkrth[$i],
                    'judul' => 'Verifikasi ke Dkrth',
                    'nama_proses' => $forms_3->status,
                    'tanggal_acc' => $todayDate2,
                    'date_time' => $todayDate,
                ]);
            }
        }


        // dd($request);

        return redirect('/lapkoor')->with('status', 'Data berhasil diteruskan!');
    }

    public function cari(Request $request)
    {

        $forms = ACCKoor::join('form_kk', 'acc_koordinator.form_kk_id', '=', 'form_kk.id')
            ->where('id_koordinator', '=', auth()->id())
            ->get(['form_kk.*'])->unique()->sortable()->paginate(10);
        $skipped = ($forms->currentPage() * $forms->perPage()) - $forms->perPage();
        // menangkap data pencarian
        $cari = $request->get('cari');
        // $forms = Form::all();

        if ($cari) {
            $forms = Form::where("no_kk", "like", "%$cari%")->sortable()->paginate(5);
        }



        return view('masterreport.lapkoor', compact('forms', 'skipped'));
    }
}