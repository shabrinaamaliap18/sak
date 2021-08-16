<?php

namespace App\Http\Controllers\masterreport;

use App\Http\Controllers\Controller;
use App\Models\forms\ACCKoor;
use App\Models\forms\Form;
use App\Models\forms\ACCDinkes;
use App\Models\forms\ACCDp5a;
use App\Models\forms\ACCDkrth;
use App\Models\forms\Penduduk;
use App\Models\forms\Posyandu;
use App\Models\forms\Satgas;
use App\Models\forms\Fasil;
use App\Models\forms\Tbc;
use App\Models\forms\Jumantik;
use App\Models\forms\History;
use App\Models\forms\IbuHamil;
use App\Models\forms\Posbindu;
use App\Models\forms\KampungAsi;
use App\Models\forms\Pelita;
use App\Models\forms\RumahSehat;
use App\Models\Tim;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AllLaporanController extends Controller
{
    public function index()
    {

        // $forms = Form::all();
        // $forms = DB::table('form_kk')
        // ->where('pegawai_id', '=', Auth::user()->pegawai_id)
        // ->get(['form_kk.*'])->unique();

        $forms = Form::join('pegawai', 'pegawai_id', '=', 'pegawai.id')
            ->where('pegawai_id', '=', Auth::user()->pegawai_id)
            ->get(['form_kk.*'])->unique();

        $pegawai = Form::join('pegawai', 'pegawai_id', '=', 'pegawai.id')

            ->get(['pegawai.*', 'nama_pegawai']);

        return view('masterreport.alllaporan', ['forms' => $forms], ['pegawai' => $pegawai]);
    }

    public function tambah()
    {

        $forms = Form::all();
        $kecamatan = DB::table('m_kecamatan')->pluck("nama_kecamatan","id_kecamatan");
        $kelurahan = DB::table('m_kelurahan')->pluck("nama_kelurahan","id");

        return view('masterreport.alllaporan-tambah', compact('forms', 'kecamatan'));
    }


    public function store(Request $request, Form $forms)
    {

        //kirim data kk dan penduduk
        $forms = Form::create(([
            'pegawai_id' =>  Auth::user()->pegawai_id,
            'kecamatan' => $request->kecamatan,
            'kelurahan' => $request->kelurahan,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'no_kk' => $request->no_kk,
            'alamat_lengkap' => $request->alamat_lengkap,
            'nama_kepala_kk' => $request->nama_kepala_kk,
            'jumlah_anggota' => $request->jumlah_anggota,
            'status_rumah' => $request->status_rumah,
            'status_penduduk' => $request->status_penduduk,
            'alamat_asal' => $request->alamat_asal,
            'tanggal_kedatangan' => $request->tanggal_kedatangan,
            'status' => 'Pending',




        ]))->id;


        if (count($request->pekerjaan) > 0) {
            foreach ($request->pekerjaan as $penduduk => $v) {
                if ($request->nik[$penduduk] != null) {
                    $data2 = array(
                        'form_kk_id' => $forms,
                        'nik' => $request->nik[$penduduk],
                        'nama_lengkap' => $request->nama_lengkap[$penduduk],
                        'jenis_kelamin' => $request->jenis_kelamin[$penduduk],
                        'tempat_lahir' => $request->tempat_lahir[$penduduk],
                        'tanggal_lahir' => $request->tangga_lahir[$penduduk],
                        'telp' => $request->telp[$penduduk],
                        'pekerjaan' => $request->pekerjaan[$penduduk],
                        'pendidikan' => $request->pendidikan[$penduduk],
                        'status_kawin' => $request->status_kawin[$penduduk],
                    );


                    Penduduk::insert($data2);
                }
            }
        }

        // dd($request);

        $ibuhamil = new IbuHamil();

        // $foto_ibu_hamil = $request->foto_ibu_hamil->getClientOriginalName();
        // $request->foto_ibu_hamil->move(public_path('image'), $foto_ibu_hamil);

        $ibuhamil->form_kk_id = $forms;
        $ibuhamil->nama_ibu_hamil = $request->input("nama_ibu_hamil");
        $ibuhamil->umur_ibu_hamil = $request->input("umur_ibu_hamil");
        $ibuhamil->nik_ibu_hamil = $request->input("nik_ibu_hamil");
        $ibuhamil->nama_suami = $request->input("nama_suami");
        $ibuhamil->nik_suami = $request->input("nik_suami");
        $ibuhamil->alamat_ibu_hamil = $request->input("alamat_ibu_hamil");
        $ibuhamil->kondisi_ibu_hamil = $request->input("kondisi_ibu_hamil");
        $ibuhamil->kasus_ibu_hamil = $request->input("kasus_ibu_hamil");
        $ibuhamil->keterangan_ibu_hamil = $request->input("keterangan_ibu_hamil");
        // $ibuhamil->foto_ibu_hamil = $foto_ibu_hamil;
        $ibuhamil->save();

        $posbindu = new Posbindu();

        // $foto_posbindu = $request->foto_posbindu->getClientOriginalName();
        // $request->foto_posbindu->move(public_path('image'), $foto_posbindu);

        $posbindu->form_kk_id = $forms;
        $posbindu->nama_lengkap_bindu = $request->input("nama_lengkap_bindu");
        $posbindu->nama_bindu = $request->input("nama_bindu");
        $posbindu->jenis_kelamin_bindu = $request->input("jenis_kelamin_bindu");
        $posbindu->riwayat_ptm_keluarga_bindu = $request->input("riwayat_ptm_keluarga_bindu");
        $posbindu->riwayat_ptm_sendiri_bindu = $request->input("riwayat_ptm_sendiri_bindu");
        $posbindu->merokok_bindu = $request->input("merokok_bindu");
        $posbindu->kurang_aktivitas_fisik_bindu = $request->input("kurang_aktivitas_fisik_bindu");
        $posbindu->kurang_sayur_buah_bindu = $request->input("kurang_sayur_buah_bindu");
        $posbindu->konsumsi_alkohol_bindu = $request->input("konsumsi_alkohol_bindu");
        $posbindu->tekanan_darah_bindu = $request->input("tekanan_darah_bindu");
        $posbindu->lingkar_perut_bindu = $request->input("lingkar_perut_bindu");
        $posbindu->gula_darah_acak_bindu = $request->input("gula_darah_acak_bindu");
        $posbindu->kolestrol_bindu = $request->input("kolestrol_bindu");
        // $posbindu->foto_posbindu = $foto_posbindu;
        $posbindu->save();

        $posyandu = new Posyandu();

        $posyandu->form_kk_id = $forms;
        $posyandu->nik_remaja = $request->input("nik_remaja");
        $posyandu->kegiatan_id = $request->input("id_posyandu");
        $posyandu->nama_lengkap_remaja = $request->input("nama_lengkap_remaja");
        $posyandu->tempat_lahir_remaja = $request->input("tempat_lahir_remaja");
        $posyandu->tanggal_lahir_remaja = $request->input("tanggal_lahir_remaja");
        $posyandu->umur = $request->input("umur");
        $posyandu->telp_remaja = $request->input("telp_remaja");
        $posyandu->keluhan_utama = $request->input("keluhan_utama");
        $posyandu->cara_mengatasi = $request->input("cara_mengatasi");
        $posyandu->obat_obatan = $request->input("obat_obatan");
        $posyandu->berat_badan = $request->input("berat_badan");
        $posyandu->tinggi_badan = $request->input("tinggi_badan");
        $posyandu->lila = $request->input("lila");
        $posyandu->anemia = $request->input("anemia");
        $posyandu->save();





        $satgas_pbkm = new Satgas();

        $satgas_pbkm->form_kk_id = $forms;
        $satgas_pbkm->nik_satgas = $request->input("nik_satgas");
        $satgas_pbkm->kegiatan_id = $request->input("id_satgas_pbkm");
        $satgas_pbkm->nama_lengkap_satgas = $request->input("nama_lengkap_satgas");
        $satgas_pbkm->jenis_kelamin_satgas = $request->input("jenis_kelamin_satgas");
        $satgas_pbkm->tempat_lahir_satgas = $request->input("tempat_lahir_satgas");
        $satgas_pbkm->tanggal_lahir_satgas = $request->input("tanggal_lahir_satgas");
        $satgas_pbkm->telp_satgas = $request->input("telp_satgas");
        $satgas_pbkm->pendidikan_satgas = $request->input("pendidikan_satgas");
        $satgas_pbkm->foto_pbkm = $request->input("foto_pbkm");
        $satgas_pbkm->save();



        $fasil = new Fasil();

        $fasil->form_kk_id = $forms;
        $fasil->nik_fasil = $request->input("nik_fasil");
        $fasil->kegiatan_id = $request->input("id_fasil");
        $fasil->nama_lengkap_fasil = $request->input("nama_lengkap_fasil");
        $fasil->jenis_kelamin_fasil = $request->input("jenis_kelamin_fasil");
        $fasil->tempat_lahir_fasil = $request->input("tempat_lahir_fasil");
        $fasil->tanggal_lahir_fasil = $request->input("tanggal_lahir_fasil");
        $fasil->telp_fasil = $request->input("telp_fasil");
        $fasil->pendidikan_fasil = $request->input("pendidikan_fasil");
        $fasil->foto_fasil = $request->input("foto_fasil");
        $fasil->save();


        $rumahsehat = new RumahSehat();

        $foto_rs = $request->foto_rs->getClientOriginalName();
        $request->foto_rs->move(public_path('image'), $foto_rs);

        $rumahsehat->form_kk_id = $forms;
        $rumahsehat->kegiatan_id = $request->input("id_rs");
        $rumahsehat->nama_kk_rs = $request->input("nama_kk_rs");
        $rumahsehat->jumlah_kk_rs = $request->input("jumlah_kk_rs");
        $rumahsehat->jumlah_jiwa_rs = $request->input("jumlah_jiwa_rs");
        $rumahsehat->alamat_rs = $request->input("alamat_rs");
        $rumahsehat->rt_rs = $request->input("rt_rs");
        $rumahsehat->rw_rs = $request->input("rw_rs");
        $rumahsehat->kecamatan_rs = $request->input("kecamatan_rs");
        $rumahsehat->kelurahan_rs = $request->input("kelurahan_rs");
        $rumahsehat->jendela_rs = $request->input("jendela_rs");
        $rumahsehat->ventilasi_rs = $request->input("ventilasi_rs");
        $rumahsehat->pencahayaan_rs = $request->input("pencahayaan_rs");
        $rumahsehat->lad_rs = $request->input("lad_rs");
        $rumahsehat->kepadatan_penghuni_rs = $request->input("kepadatan_penghuni_rs");
        $rumahsehat->khp_rs = $request->input("khp_rs");
        $rumahsehat->kontruksi_rumah_rs = $request->input("kontruksi_rumah_rs");
        $rumahsehat->sab_rs = $request->input("sab_rs");
        $rumahsehat->sam_rs = $request->input("sam_rs");
        $rumahsehat->jamban_rs = $request->input("jamban_rs");
        $rumahsehat->spal_rs = $request->input("spal_rs");
        $rumahsehat->tempat_sampah_rs = $request->input("tempat_sampah_rs");
        $rumahsehat->bebas_jentik_rs = $request->input("bebas_jentik_rs");
        $rumahsehat->bebas_tikus_rs = $request->input("bebas_tikus_rs");
        $rumahsehat->pembersihan_halaman_rs = $request->input("pembersihan_halaman_rs");
        $rumahsehat->pembersihan_tinja_rs = $request->input("pembersihan_tinja_rs");
        $rumahsehat->membuang_sampah_rs = $request->input("membuang_sampah_rs");
        $rumahsehat->foto_rs = $foto_rs;
        $rumahsehat->save();




        //'form_kk_id', 'kegiatan_id', 'nama_kk_rs','jumlah_kk_rs','jumlah_jiwa_rs','alamat_rs','rt_rs','rw_rs','kecamatan_rs','kelurahan_rs','jendela_rs','ventilasi_rs','pencahayaan_rs','lad_rs','kepadatan_penghuni_rs','khp_rs','kontruksi_rumah_rs','sab_rs','sam_rs','jamban_rs','spal_rs','tempat_sampah_rs','bebas_jentik_rs','bebas_tikus_rs','pembersihan_halaman_rs','pembersihan_tinja_rs','membuang_sampah_rs'


        $kpasi = new KampungAsi();

        // $foto_kpasi = $request->foto_kpasi->getClientOriginalName();
        // $request->foto_kpasi->move(public_path('image'), $foto_kpasi);

        $kpasi->form_kk_id = $forms;
        $kpasi->kegiatan_id = $request->input("id_kpasi");
        $kpasi->nama_kader_kpasi = Auth::user()->pegawai_id;
        $kpasi->nama_kpasi = $request->input("nama_kpasi");
        $kpasi->usia_kehamilan_kpasi = $request->input("usia_kehamilan_kpasi");
        $kpasi->usia_bayi_kpasi = $request->input("usia_bayi_kpasi");
        $kpasi->nama_ibu_domisili_kpasi = $request->input("nama_ibu_domisili_kpasi");
        $kpasi->alamat_ibu_domisili_kpasi = $request->input("alamat_ibu_domisili_kpasi");
        $kpasi->alamat_ibu_ktp_kpasi = $request->input("alamat_ibu_ktp_kpasi");
        $kpasi->nik_ibu_kpasi = $request->input("nik_ibu_kpasi");
        $kpasi->no_hp_kpasi = $request->input("no_hp_kpasi");
        $kpasi->permasalahan_kunjungan_kpasi = $request->input("permasalahan_kunjungan_kpasi");
        $kpasi->penyuluhan_kunjungan_kpasi = $request->input("penyuluhan_kunjungan_kpasi");
        $kpasi->status_rujukan_kpasi = $request->input("status_rujukan_kpasi");
        $kpasi->penyebab_dirujuk_kpasi = $request->input("penyebab_dirujuk_kpasi");
        // $kpasi->foto_kpasi = $foto_kpasi;
        $kpasi->save();


        $tbc = new Tbc();

        $foto_tbc = $request->foto_tbc->getClientOriginalName();
        $request->foto_tbc->move(public_path('image'), $foto_tbc);

        $tbc->form_kk_id = $forms;
        $tbc->nama_siswa_tbc = $request->input("nama_siswa_tbc");
        $tbc->kegiatan_id = $request->input("id_tbc");
        $tbc->umur_tbc = $request->input("umur_tbc");
        $tbc->jenis_kelamin_tbc = $request->input("jenis_kelamin_tbc");
        $tbc->alamat_tbc = $request->input("alamat_tbc");
        $tbc->gejala_tbc = $request->input("gejala_tbc");
        $tbc->riwayat_kontak_tbc = $request->input("riwayat_kontak_tbc");
        $tbc->status_rujukan_tbc = $request->input("status_rujukan_tbc");
        $tbc->status_fasyankes_rujukan = $request->input("status_fasyankes_rujukan");
        $tbc->hasil_pemeriksaan = $request->input("hasil_pemeriksaan");
        $tbc->foto_tbc = $foto_tbc;
        $tbc->save();

        $jumantik = new Jumantik();
        
        $foto_jumantik = $request->foto_jumantik->getClientOriginalName();
        $request->foto_jumantik->move(public_path('image'), $foto_jumantik);
        
        $jumantik->form_kk_id = $forms;
        $jumantik->jentik_bak_km = $request->input("jentik_bak_km");
        $jumantik->kegiatan_id = $request->input("id_jumantik");
        $jumantik->jentik_dispenser = $request->input("jentik_dispenser");
        $jumantik->jentik_gentong = $request->input("jentik_gentong");
        $jumantik->jentik_tampungan_lemari_es = $request->input("jentik_tampungan_lemari_es");
        $jumantik->jentik_tampungan_pot_bunga = $request->input("jentik_tampungan_pot_bunga");
        $jumantik->jentik_tampungan_minum_burung = $request->input("jentik_tampungan_minum_burung");
        $jumantik->jentik_tampungan_barang_bekas = $request->input("jentik_tampungan_barang_bekas");
        $jumantik->jentik_tampungan_lubang_pohon = $request->input("jentik_tampungan_lubang_pohon");
        $jumantik->penyuluhan_psn = $request->input("penyuluhan_psn");
        $jumantik->pemahaman_3m_plus = $request->input("pemahaman_3m_plus");
        $jumantik->foto_jumantik = $foto_jumantik;
        $jumantik->save();


        $pelita = new Pelita();

        $foto_pelita = $request->foto_pelita->getClientOriginalName();
        $request->foto_pelita->move(public_path('image'), $foto_pelita);

        $pelita->form_kk_id = $forms;
        $pelita->kegiatan_id = $request->input("id_pelita");
        $pelita->nama_pelita = $request->input("nama_pelita");
        $pelita->nik_pelita = $request->input("nik_pelita");
        $pelita->jenis_kelamin_pelita = $request->input("jenis_kelamin_pelita");
        $pelita->tanggal_lahir_pelita = $request->input("tanggal_lahir_pelita");
        $pelita->umur_pelita = $request->input("umur_pelita");
        $pelita->bb_lahir_pelita = $request->input("bb_lahir_pelita");
        $pelita->pb_lahir_pelita = $request->input("pb_lahir_pelita");
        $pelita->bb_pelita = $request->input("bb_pelita");
        $pelita->pb_pelita = $request->input("pb_pelita");
        $pelita->lila_pelita = $request->input("lila_pelita");
        $pelita->cara_ukur_pb_pelita = $request->input("cara_ukur_pb_pelita");
        $pelita->nama_ayah_pelita = $request->input("nama_ayah_pelita");
        $pelita->nik_ayah_pelita = $request->input("nik_ayah_pelita");
        $pelita->nama_ibu_pelita = $request->input("nama_ibu_pelita");
        $pelita->nik_ibu_pelita = $request->input("nik_ibu_pelita");
        $pelita->alamat_domisili_pelita = $request->input("alamat_domisili_pelita");
        $pelita->rt_pelita = $request->input("rt_pelita");
        $pelita->rw_pelita = $request->input("rw_pelita");
        $pelita->alamat_ktp_pelita = $request->input("alamat_ktp_pelita");
        $pelita->no_hp_ortu_pelita = $request->input("no_hp_ortu_pelita");
        if (!empty($request->input('status_pelita'))) {
            $pelita->status_pelita = join(',', $request->input("status_pelita"));
        } else {
            $pelita->status_pelita = '';
        }
        $pelita->perkembangan_balita_pelita = $request->input("perkembangan_balita_pelita");
        $pelita->foto_pelita = $foto_pelita;

        // dd($pelita);
        $pelita->save();




        // dd($request);


        return redirect('alllaporan')->with('status', 'Data Berhasil Ditambahkan!');
    }

    public function edit($id, Form $forms)

    {

        $forms = Form::find($id);
        // $penduduk = Penduduk::find($id);
        // $pelita = Pelita::find($id);
        // $jumantik = Jumantik::find($id);
        // $tbc = Tbc::find($id);

        $penduduk = DB::table('form_penduduk')
            ->where("form_kk_id", $id)->get();

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


        $jumlahpd = DB::table('form_penduduk')
            ->where("form_kk_id", $id)->get();

        // echo $pelita;


        return view('masterreport.alllaporan-edit', compact('forms', 'penduduk', 'pelita', 'jumlahpd', 'tbc', 'jumantik', 'ibuhamil', 'posbindu', 'kpasi', 'rumahsehat'));
    }

    public function update($id, Form $forms, Request $request)
    {
        $forms = Form::find($id);
        $forms->pegawai_id =  Auth::user()->pegawai_id;
        $forms->kecamatan = $request->kecamatan;
        $forms->kelurahan = $request->kelurahan;
        $forms->rt = $request->rt;
        $forms->rw = $request->rw;
        $forms->no_kk = $request->no_kk;
        $forms->alamat_lengkap = $request->alamat_lengkap;
        $forms->nama_kepala_kk = $request->nama_kepala_kk;
        $forms->jumlah_anggota = $request->jumlah_anggota;
        $forms->status_rumah = $request->status_rumah;
        $forms->status_penduduk = $request->status_penduduk;
        $forms->alamat_asal = $request->alamat_asal;
        $forms->tanggal_kedatangan = $request->tanggal_kedatangan;
        $forms->save();

        $jumlahpd = DB::table('form_penduduk')
            ->where("form_kk_id", $id)->get();

        // dd($jumlahpd);

        // $penduduk = DB::table('form_penduduk')
        // ->where("form_kk_id", $id)->get();

        // $penduduk = Penduduk::find($id);
        // $penduduk->form_kk_id = $request->form_kk_id;
        // $penduduk->nik = $request->nik;
        // $penduduk->nama_lengkap = $request->nama_lengkap;
        // $penduduk->jenis_kelamin = $request->jenis_kelamin;
        // $penduduk->tempat_lahir = $request->tempat_lahir;
        // $penduduk->tanggal_lahir = $request->tanggal_lahir;
        // $penduduk->telp = $request->telp;
        // $penduduk->pekerjaan = $request->pekerjaan;
        // $penduduk->pendidikan = $request->pendidikan;
        // $penduduk->status_kawin = $request->status_kawin;
        // $penduduk->save();

        $ibuhamil = IbuHamil::find($id);

        $ibuhamil2 = $request->file('foto_ibu_hamil');
        
        if (file_exists($ibuhamil2)) {
            $ibuhamil2->move(public_path('image'), $ibuhamil2->getClientOriginalName());
            $ibuhamil->foto_ibu_hamil = $ibuhamil2->getClientOriginalName();
        }

        $ibuhamil->nama_ibu_hamil = $request->nama_ibu_hamil;
        $ibuhamil->umur_ibu_hamil = $request->umur_ibu_hamil;
        $ibuhamil->nik_ibu_hamil = $request->nik_ibu_hamil;
        $ibuhamil->nama_suami = $request->nama_suami;
        $ibuhamil->nik_suami = $request->nik_suami;
        $ibuhamil->alamat_ibu_hamil = $request->alamat_ibu_hamil;
        $ibuhamil->kondisi_ibu_hamil = $request->kondisi_ibu_hamil;
        $ibuhamil->kasus_ibu_hamil = $request->kasus_ibu_hamil;
        $ibuhamil->keterangan_ibu_hamil = $request->keterangan_ibu_hamil;
        $ibuhamil->save();

        $posbindu = Posbindu::find($id);

        $posbindu2 = $request->file('foto_posbindu');
        
        if (file_exists($posbindu2)) {
            $posbindu2->move(public_path('image'), $posbindu2->getClientOriginalName());
            $posbindu->foto_posbindu = $posbindu2->getClientOriginalName();
        }

        $posbindu->nama_lengkap_bindu = $request->nama_lengkap_bindu;
        $posbindu->nama_bindu = $request->nama_bindu;
        $posbindu->jenis_kelamin_bindu = $request->jenis_kelamin_bindu;
        $posbindu->riwayat_ptm_keluarga_bindu = $request->riwayat_ptm_keluarga_bindu;
        $posbindu->riwayat_ptm_sendiri_bindu = $request->riwayat_ptm_sendiri_bindu;
        $posbindu->merokok_bindu = $request->merokok_bindu;
        $posbindu->kurang_aktivitas_fisik_bindu = $request->kurang_aktivitas_fisik_bindu;
        $posbindu->kurang_sayur_buah_bindu = $request->kurang_sayur_buah_bindu;
        $posbindu->konsumsi_alkohol_bindu = $request->konsumsi_alkohol_bindu;
        $posbindu->tekanan_darah_bindu = $request->tekanan_darah_bindu;
        $posbindu->lingkar_perut_bindu = $request->lingkar_perut_bindu;
        $posbindu->gula_darah_acak_bindu = $request->gula_darah_acak_bindu;
        $posbindu->kolestrol_bindu = $request->kolestrol_bindu;
        $posbindu->save();

        $pelita = Pelita::find($id);

        $pelita2 = $request->file('foto_pelita');
        
        if (file_exists($pelita2)) {
            $pelita2->move(public_path('image'), $pelita2->getClientOriginalName());
            $pelita->foto_pelita = $pelita2->getClientOriginalName();
        }

        $pelita->kegiatan_id = $request->id_pelita;
        $pelita->nik_pelita = $request->nik_pelita;
        $pelita->nama_pelita = $request->nama_pelita;
        $pelita->jenis_kelamin_pelita = $request->jenis_kelamin_pelita;
        $pelita->tanggal_lahir_pelita = $request->tanggal_lahir_pelita;
        $pelita->umur_pelita = $request->umur_pelita;
        $pelita->bb_lahir_pelita = $request->bb_lahir_pelita;
        $pelita->pb_lahir_pelita = $request->pb_lahir_pelita;
        $pelita->bb_pelita = $request->bb_pelita;
        $pelita->pb_pelita = $request->pb_pelita;
        $pelita->lila_pelita = $request->lila_pelita;
        $pelita->cara_ukur_pb_pelita = $request->cara_ukur_pb_pelita;
        $pelita->nik_ayah_pelita = $request->nik_ayah_pelita;
        $pelita->nama_ayah_pelita = $request->nama_ayah_pelita;
        $pelita->nik_ibu_pelita = $request->nik_ibu_pelita;
        $pelita->nama_ibu_pelita = $request->nama_ibu_pelita;
        $pelita->alamat_domisili_pelita = $request->alamat_domisili_pelita;
        $pelita->rt_pelita = $request->rt_pelita;
        $pelita->rw_pelita = $request->rw_pelita;
        $pelita->alamat_ktp_pelita = $request->alamat_ktp_pelita;
        $pelita->no_hp_ortu_pelita = $request->no_hp_ortu_pelita;
        if (!empty($request->input('status_pelita'))) {
            $pelita->status_pelita = join(',', $request->input("status_pelita"));
        } else {
            $pelita->status_pelita = '';
        }
        $pelita->perkembangan_balita_pelita = $request->perkembangan_balita_pelita;
        $pelita->save();

        // dd($pelita);



        $rumahsehat = RumahSehat::find($id);

        $rs2 = $request->file('foto_rs');
        
        if (file_exists($rs2)) {
            $rs2->move(public_path('image'), $rs2->getClientOriginalName());
            $rumahsehat->foto_rs = $rs2->getClientOriginalName();
        }

        $rumahsehat->kegiatan_id = $request->id_rs;
        $rumahsehat->nama_kk_rs = $request->nama_kk_rs;
        $rumahsehat->jumlah_kk_rs = $request->jumlah_kk_rs;
        $rumahsehat->jumlah_jiwa_rs = $request->jumlah_jiwa_rs;
        $rumahsehat->alamat_rs = $request->alamat_rs;
        $rumahsehat->rt_rs = $request->rt_rs;
        $rumahsehat->rw_rs = $request->rw_rs;
        $rumahsehat->kecamatan_rs = $request->kecamatan_rs;
        $rumahsehat->kelurahan_rs = $request->kelurahan_rs;
        $rumahsehat->jendela_rs = $request->jendela_rs;
        $rumahsehat->ventilasi_rs = $request->ventilasi_rs;
        $rumahsehat->pencahayaan_rs = $request->pencahayaan_rs;
        $rumahsehat->lad_rs = $request->lad_rs;
        $rumahsehat->kepadatan_penghuni_rs = $request->kepadatan_penghuni_rs;
        $rumahsehat->khp_rs = $request->khp_rs;
        $rumahsehat->kontruksi_rumah_rs = $request->kontruksi_rumah_rs;
        $rumahsehat->sab_rs = $request->sab_rs;
        $rumahsehat->sam_rs = $request->sam_rs;
        $rumahsehat->jamban_rs = $request->jamban_rs;
        $rumahsehat->spal_rs = $request->spal_rs;
        $rumahsehat->tempat_sampah_rs = $request->tempat_sampah_rs;
        $rumahsehat->bebas_jentik_rs = $request->bebas_jentik_rs;
        $rumahsehat->bebas_tikus_rs = $request->bebas_tikus_rs;
        $rumahsehat->pembersihan_halaman_rs = $request->pembersihan_halaman_rs;
        $rumahsehat->pembersihan_tinja_rs = $request->pembersihan_tinja_rs;
        $rumahsehat->membuang_sampah_rs = $request->membuang_sampah_rs;
        $rumahsehat->save();

        $kpasi = KampungAsi::find($id);

        $kpasi2 = $request->file('foto_kpasi');
        
        if (file_exists($kpasi2)) {
            $kpasi2->move(public_path('image'), $kpasi2->getClientOriginalName());
            $kpasi->foto_kpasi = $kpasi2->getClientOriginalName();
        }

        $kpasi->kegiatan_id = $request->id_kpasi;
        $kpasi->nama_kader_kpasi = $request->nama_kader_kpasi;
        $kpasi->nama_kpasi = $request->nama_kpasi;
        $kpasi->usia_kehamilan_kpasi = $request->usia_kehamilan_kpasi;
        $kpasi->usia_bayi_kpasi = $request->usia_bayi_kpasi;
        $kpasi->nama_ibu_domisili_kpasi = $request->nama_ibu_domisili_kpasi;
        $kpasi->alamat_ibu_domisili_kpasi = $request->alamat_ibu_domisili_kpasi;
        $kpasi->alamat_ibu_ktp_kpasi = $request->alamat_ibu_ktp_kpasi;
        $kpasi->nik_ibu_kpasi = $request->nik_ibu_kpasi;
        $kpasi->no_hp_kpasi = $request->no_hp_kpasi;
        $kpasi->permasalahan_kunjungan_kpasi = $request->permasalahan_kunjungan_kpasi;
        $kpasi->penyuluhan_kunjungan_kpasi = $request->penyuluhan_kunjungan_kpasi;
        $kpasi->status_rujukan_kpasi = $request->status_rujukan_kpasi;
        $kpasi->penyebab_dirujuk_kpasi = $request->penyebab_dirujuk_kpasi;
        $kpasi->save();

        //TBC
        $tbc = Tbc::find($id);

        $tbc2 = $request->file('foto_tbc');
        
        if (file_exists($tbc2)) {
            $tbc2->move(public_path('image'), $tbc2->getClientOriginalName());
            $tbc->foto_tbc = $tbc2->getClientOriginalName();
        }

        $tbc->nama_siswa_tbc = $request->nama_siswa_tbc;
        $tbc->kegiatan_id = $request->id_tbc;
        $tbc->umur_tbc = $request->umur_tbc;
        $tbc->jenis_kelamin_tbc = $request->jenis_kelamin_tbc;
        $tbc->alamat_tbc = $request->alamat_tbc;
        $tbc->gejala_tbc = $request->gejala_tbc;
        $tbc->riwayat_kontak_tbc = $request->riwayat_kontak_tbc;
        $tbc->status_rujukan_tbc = $request->status_rujukan_tbc;
        $tbc->status_fasyankes_rujukan = $request->status_fasyankes_rujukan;
        $tbc->hasil_pemeriksaan = $request->hasil_pemeriksaan;
        $tbc->save();

        //JUMANTIK
        $jumantik = Jumantik::find($id);
        
        $jumantik2 = $request->file('foto_jumantik');
        
        if (file_exists($jumantik2)) {
            $jumantik2->move(public_path('image'), $jumantik2->getClientOriginalName());
            $jumantik->foto_jumantik = $jumantik2->getClientOriginalName();
        }
        
        $jumantik->jentik_bak_km = $request->jentik_bak_km;
        $jumantik->kegiatan_id = $request->id_jumantik;
        $jumantik->jentik_dispenser = $request->jentik_dispenser;
        $jumantik->jentik_gentong = $request->jentik_gentong;
        $jumantik->jentik_tampungan_lemari_es = $request->jentik_tampungan_lemari_es;
        $jumantik->jentik_tampungan_pot_bunga = $request->jentik_tampungan_pot_bunga;
        $jumantik->jentik_tampungan_minum_burung = $request->jentik_tampungan_minum_burung;
        $jumantik->jentik_tampungan_barang_bekas = $request->jentik_tampungan_barang_bekas;
        $jumantik->jentik_tampungan_lubang_pohon = $request->jentik_tampungan_lubang_pohon;
        $jumantik->penyuluhan_psn = $request->penyuluhan_psn;
        $jumantik->pemahaman_3m_plus = $request->pemahaman_3m_plus;
        $jumantik->save();


        return redirect('/alllaporan')->with('status', 'Data Berhasil Diubah!');
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

        $tbc = Tbc::join('form_kk', 'form_kk_id', '=', 'form_kk.id')
            ->where('form_kk_id',  $id)
            ->get(['form_tbc.*']);


        $rumahsehat = DB::table('form_rumah_sehat')
            ->where("form_kk_id", $id)->get();

        $pelita = DB::table('form_pelita')
            ->where("form_kk_id", $id)
            ->get(['form_pelita.*']);

        $kpasi = DB::table('form_kp_asi')
            ->where("form_kk_id", $id)->get();

        $jumantik = Jumantik::join('form_kk', 'form_kk_id', '=', 'form_kk.id')
            ->where('form_kk_id',  $id)
            ->get(['form_jumantik.*']);

        $posbindu = Posbindu::join('form_kk', 'form_kk_id', '=', 'form_kk.id')
            ->where('form_kk_id',  $id)
            ->get(['form_posbindu.*']);
        $ibuhamil = IbuHamil::join('form_kk', 'form_kk_id', '=', 'form_kk.id')
            ->where('form_kk_id',  $id)
            ->get(['form_ibu_hamil.*']);

        // dd($penduduk);

        $tim = Tim::join('pegawai', 'tim.master_pegawai', '=', 'pegawai.id')
            ->get(['tim.*', 'nama_pegawai', 'master_pegawai', 'jabatan'])
            ->where('id_pegawai',  Auth::user()->pegawai_id)
            ->where('jabatan',  'koordinator'); //menampilkan data tim setiap id
        // dd($tim);

        $tim2 = Tim::join('pegawai', 'tim.master_pegawai', '=', 'pegawai.id')
            ->get(['tim.*', 'nama_pegawai', 'master_pegawai', 'jabatan'])
            ->where('id_pegawai',   Auth::user()->pegawai_id)
            ->where('jabatan',  'opd dinkes'); //menampilkan data tim setiap id

        $history = History::join('form_kk', 'form_kk_id', '=', 'form_kk.id')
            ->join('pegawai', 'id_pengirim', '=', 'pegawai.id')
            // -> join('pegawai', 'tim.master_pegawai', '=', 'pegawai.id')
            ->where('form_kk_id',  $id)
            ->get(['histories.*', 'pegawai.*']);

        // dd($history);

        $user = DB::table('pegawai')->get();

        return view('masterreport.alllaporan-show', compact('forms', 'pegawai', 'penduduk', 'tim', 'tim2', 'posyandu', 'posbindu', 'satgas_pbkm', 'fasil', 'pegawai', 'tim2', 'history', 'user', 'tbc', 'jumantik', 'ibuhamil', 'rumahsehat', 'kpasi', 'pelita'));
    }



    public function teruskan(Request $request, Form $forms)
    {

        $koor = ($request->input('id_penerima'));
        if ($koor != null) {
            for ($i = 0; $i < count($koor); $i++) {
                ACCKoor::create([
                    'form_kk_id' => $request->id_form,
                    'id_koordinator' => $koor[$i],
                ]);

                //history
                $dt = Carbon::now();
                $todayDate = $dt->toDayDateTimeString();

                $forms = Form::find($request->id_form);
                $forms->status = 'Menunggu Verifikasi Koordinator';
                $forms->save();

                History::create([
                    'form_kk_id' => $request->id_form,
                    'id_pengirim' => Auth::user()->id,
                    'id_penerima' => $koor[$i],
                    'keterangan' => $request->keterangan,
                    'judul' => 'Verifikasi ke Koordinator',
                    'nama_proses' => $forms->status,
                    'date_time' => $todayDate,
                ]);
            }
        }


        return redirect('/alllaporan')->with('status', 'Data berhasil diteruskan!');
    }


    public function delete($id)
    {
        $forms = Form::find($id);
        $forms->delete();
        return redirect('/alllaporan')->with('status', 'Data schema Berhasil Dihapus!');
    }

    public function trash()
    {
        // mengambil data forms yang sudah dihapus
        $forms = Form::onlyTrashed()->get();
        return view('masterreport.alllaporan-trash', ['forms' => $forms]);
    }

    // restore data forms yang dihapus
    public function kembalikan($id)
    {
        $forms = Form::onlyTrashed()->where('id', $id);
        $forms->restore();
        return redirect('/alllaporan')->with('status', 'Data forms Berhasil Dikembalikan!');
    }

    // restore semua data forms yang sudah dihapus
    public function kembalikan_semua()
    {

        $forms = Form::onlyTrashed();
        $forms->restore();

        return redirect('/alllaporan')->with('status', 'Data forms Berhasil Dikembalikan!');
    }

    // hapus permanen
    public function hapus_permanen($id)
    {
        // hapus permanen data forms
        $forms = Form::onlyTrashed()->where('id', $id);
        $forms->forceDelete();

        return redirect('/alllaporan/trash')->with('status', 'Data forms Berhasil Dihapus!');
    }

    // hapus permanen semua forms yang sudah dihapus
    public function hapus_permanen_semua()
    {
        // hapus permanen semua data forms yang sudah dihapus
        $forms = Form::onlyTrashed();
        $forms->forceDelete();

        return redirect('/alllaporan/trash')->with('status', 'Data forms Berhasil Dihapus!');
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



        return view('masterreport.alllaporan', compact('forms', 'skipped'));
    }



    public function getKecamatan()
    {
        $kecamatan = DB::table('m_kecamatan')->get("m_kecamatan");

        return view('masterreport.alllaporan-tambah', compact('kecamatan'));
    }


    public function getKelurahan($id)
    {
        $kelurahan = DB::table('m_kelurahan')->where("id_kecamatan", $id)
            ->pluck("nama_kelurahan", "id");

        // dd($kelurahan);
        return json_encode($kelurahan);
    }
}