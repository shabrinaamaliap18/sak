<?php

namespace App\Http\Controllers\forms;

use App\Http\Controllers\Controller;
use App\Models\forms\Fasil;
use App\Models\forms\Form;
use App\Models\forms\KampungAsi;
use App\Models\forms\IbuHamil;
use App\Models\forms\Pelita;
use App\Models\forms\Penduduk;
use App\Models\forms\Posyandu;
use App\Models\forms\Posbindu;
use App\Models\forms\RumahSehat;
use App\Models\forms\Jumantik;
use App\Models\forms\Tbc;
use App\Models\forms\Satgas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FormsController extends Controller
{
    public function index()
    {
        $forms = Form::all();
        return view('forms.forms', ['forms' => $forms]);
    }

    public function tambah()
    {

        $forms = Form::all();

        return view('forms.forms', compact('forms'))->with('status', 'Data KK Berhasil Ditambahkan!');
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
        $ibuhamil->foto_ibu_hamil = $request->input("foto_ibu_hamil");
        $ibuhamil->save();

        $posbindu = new Posbindu();

        $posbindu->form_kk_id = $forms;
        $posbindu->nama_lengkap_bindu = $request->input("nama_lengkap_bindu");
        $posbindu->nama_bindu = $request->input("nama_bindu");
        $posbindu->jenis_kelamin_bindu = $request->input("jenis_kelamin_bindu");
        $posbindu->riwayat_ptm_keluarga_bindu = $request->input("riwayat_ptm_keluarga_bindu");
        $posbindu->riwayat_ptm_sendir_bindu = $request->input("riwayat_ptm_sendiri_bindu");
        $posbindu->merokok_bindu = $request->input("merokok_bindu");
        $posbindu->kurang_aktivitas_fisik_bindu = $request->input("kurang_aktivitas_fisik_bindu");
        $posbindu->kurang_sayur_buah_bindu = $request->input("kurang_sayur_buah_bindu");
        $posbindu->konsumsi_alkohol_bindu = $request->input("konsumsi_alkohol_bindu");
        $posbindu->tekanan_darah_bindu = $request->input("tekanan_darah_bindu");
        $posbindu->lingkar_perut_bindu = $request->input("lingkar_perut_bindu");
        $posbindu->gula_darah_acak_bindu = $request->input("gula_darah_acak_bindu");
        $posbindu->kolestro_bindul = $request->input("kolestrol_bindu");
        $posbindu->foto_posbindu = $request->input("foto_posbindu");
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
        $rumahsehat->foto_rs = $request->input("foto_rs");
        $rumahsehat->save();




        //'form_kk_id', 'kegiatan_id', 'nama_kk_rs','jumlah_kk_rs','jumlah_jiwa_rs','alamat_rs','rt_rs','rw_rs','kecamatan_rs','kelurahan_rs','jendela_rs','ventilasi_rs','pencahayaan_rs','lad_rs','kepadatan_penghuni_rs','khp_rs','kontruksi_rumah_rs','sab_rs','sam_rs','jamban_rs','spal_rs','tempat_sampah_rs','bebas_jentik_rs','bebas_tikus_rs','pembersihan_halaman_rs','pembersihan_tinja_rs','membuang_sampah_rs'



        $kpasi = new KampungAsi();

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
        $kpasi->foto_kpasi = $request->input("foto_kpasi");
        $kpasi->save();


        $tbc = new Tbc();
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
        $tbc->foto_tbc = $request->input("foto_tbc");
        $tbc->save();

        $jumantik = new Jumantik();
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
        $jumantik->foto_jumantik = $request->input("foto_jumantik");
        $jumantik->save();


        $pelita = new Pelita();
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
        $pelita->foto_pelita = $request->input("foto_pelita");

        // dd($pelita);
        $pelita->save();




        // dd($request);


        return redirect('alllaporan')->with('status', 'Data Berhasil Ditambahkan!');
    }

    public function edit($id, Form $forms)

    {

        $forms = Form::find($id);
        $penduduk = Penduduk::find($id);
        // $pelita = Pelita::find($id);
        // $jumantik = Jumantik::find($id);
        // $tbc = Tbc::find($id);

        $jumantik = DB::table('form_jumantik')
            ->where("form_kk_id", $id)->get();

        $tbc = DB::table('form_tbc')
            ->where("form_kk_id", $id)
            ->get(['form_tbc.*']);

        $pelita = DB::table('form_pelita')
            ->where("form_kk_id", $id)
            ->get(['form_pelita.*']);

        $ibuhamil = DB::table('form_ibu_hamil')
            ->where("form_kk_id", $id)->get();

        $jumlahpd = DB::table('form_penduduk')
            ->where("form_kk_id", $id)->get();

        // echo $pelita;


        return view('forms.forms-edit', compact('forms', 'penduduk', 'pelita', 'jumlahpd', 'tbc', 'jumantik', 'ibuhamil'));
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


        $ibuhamil = IbuHamil::find($id);
        $ibuhamil->form_kk_id = $request->form_kk_id;
        $ibuhamil->nama_ibu_hamil = $request->nama_ibu_hamil;
        $ibuhamil->umur_ibu_hamil = $request->umur_ibu_hamil;
        $ibuhamil->nik_ibu_hamil = $request->nik_ibu_hamil;
        $ibuhamil->nama_suami = $request->nama_suami;
        $ibuhamil->nik_suami = $request->nik_suami;
        $ibuhamil->alamat_ibu_hamil = $request->alamat_ibu_hamil;
        $ibuhamil->kondisi_ibu_hamil = $request->kondisi_ibu_hamil;
        $ibuhamil->kasus_ibu_hamil = $request->kasus_ibu_hamil;
        $ibuhamil->keterangan_ibu_hamil = $request->keterangan_ibu_hamil;
        $ibuhamil->foto_ibu_hamil = $request->foto_ibu_hamil;
        $ibuhamil->save();

        

        $pelita = Pelita::find($id);
        $pelita->form_kk_id = $request->form_kk_id;
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
        $pelita->foto_pelita = $request->foto_pelita;
        $pelita->save();

        // dd($pelita);





        // $rumahsehat = RumahSehat::find($id);

        // $rumahsehat->form_kk_id = $lastid;
        // $rumahsehat->kegiatan_id = $request->id_rs;
        // $rumahsehat->nama_kk_rs = $request->nama_kk_rs;
        // $rumahsehat->jumlah_kk_rs = $request->jumlah_kk_rs;
        // $rumahsehat->jumlah_jiwa_rs = $request->jumlah_jiwa_rs;
        // $rumahsehat->alamat_rs = $request->alamat_rs;
        // $rumahsehat->rt_rs = $request->rt_rs;
        // $rumahsehat->rw_rs = $request->rw_rs;
        // $rumahsehat->kecamatan_rs = $request->kecamatan_rs;
        // $rumahsehat->kelurahan_rs = $request->kelurahan_rs;
        // $rumahsehat->jendela_rs = $request->jendela_rs;
        // $rumahsehat->ventilasi_rs = $request->ventilasi_rs;
        // $rumahsehat->pencahayaan_rs = $request->pencahayaan_rs;
        // $rumahsehat->lad_rs = $request->lad_rs;
        // $rumahsehat->kepadatan_penghuni_rs = $request->kepadatan_penghuni_rs;
        // $rumahsehat->khp_rs = $request->khp_rs;
        // $rumahsehat->kontruksi_rumah_rs = $request->kontruksi_rumah_rs;
        // $rumahsehat->sab_rs = $request->sab_rs;
        // $rumahsehat->sam_rs = $request->sam_rs;
        // $rumahsehat->jamban_rs = $request->jamban_rs;
        // $rumahsehat->spal_rs = $request->spal_rs;
        // $rumahsehat->tempat_sampah_rs = $request->tempat_sampah_rs;
        // $rumahsehat->bebas_jentik_rs = $request->bebas_jentik_rs;
        // $rumahsehat->bebas_tikus_rs = $request->bebas_tikus_rs;
        // $rumahsehat->pembersihan_halaman_rs = $request->pembersihan_halaman_rs;
        // $rumahsehat->pembersihan_tinja_rs = $request->pembersihan_tinja_rs;
        // $rumahsehat->membuang_sampah_rs = $request->membuang_sampah_rs;
        // $rumahsehat->foto_rs = $request->foto_rs;
        // $rumahsehat->save();

        // $kpasi = KampungAsi::find($id);

        // $kpasi->form_kk_id = $lastid;
        // $kpasi->kegiatan_id = $request->id_kpasi;
        // $kpasi->tanggal_kunjungan_kpasi = $request->tanggal_kunjungan_kpasi;
        // $kpasi->nama_kader_kpasi = $request->nama_kader_kpasi;
        // $kpasi->nama_kpasi = $request->nama_kpasi;
        // $kpasi->usia_kehamilan_kpasi = $request->usia_kehamilan_kpasi;
        // $kpasi->usia_bayi_kpasi = $request->usia_bayi_kpasi;
        // $kpasi->nama_ibu_domisili_kpasi = $request->nama_ibu_domisili_kpasi;
        // $kpasi->alamat_ibu_domisili_kpasi = $request->alamat_ibu_domisili_kpasi;
        // $kpasi->alamat_ibu_ktp_kpasi = $request->alamat_ibu_ktp_kpasi;
        // $kpasi->nik_ibu_kpasi = $request->nik_ibu_kpasi;
        // $kpasi->no_hp_kpasi = $request->no_hp_kpasi;
        // $kpasi->permasalahan_kunjungan_kpasi = $request->permasalahan_kunjungan_kpasi;
        // $kpasi->penyuluhan_kunjungan_kpasi = $request->penyuluhan_kunjungan_kpasi;
        // $kpasi->status_rujukan_kpasi = $request->status_rujukan_kpasi;
        // $kpasi->penyebab_dirujuk_kpasi = $request->penyebab_dirujuk_kpasi;
        // $kpasi->foto_kpasi = $request->foto_kpasi;
        // $kpasi->save();

        $tbc = Tbc::find($id);
        $tbc->form_kk_id = $request->form_kk_id;
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
        $tbc->foto_tbc = $request->foto_tbc;
        $tbc->save();

        $jumantik = Jumantik::find($id);
        $jumantik->form_kk_id = $request->form_kk_id;
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
        $jumantik->foto_jumantik = $request->foto_jumantik;
        $jumantik->save();


        return view('forms.forms', compact('forms',  'jumlahpd',  'pelita',  'jumantik', 'tbc'));
    }
}