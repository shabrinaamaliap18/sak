<?php

namespace App\Models\forms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class RumahSehat extends Model
{
    // use HasFactory;
    // use SoftDeletes;
    // protected $dates = ['deleted_at'];
    protected $fillable = [
        'form_kk_id', 'kegiatan_id', 'nama_kk_rs','jumlah_kk_rs','jumlah_jiwa_rs','alamat_rs','rt_rs','rw_rs','kecamatan_rs','kelurahan_rs','jendela_rs','ventilasi_rs','pencahayaan_rs','lad_rs','kepadatan_penghuni_rs','khp_rs','kontruksi_rumah_rs','sab_rs','sam_rs','jamban_rs','spal_rs','tempat_sampah_rs','bebas_jentik_rs','bebas_tikus_rs','pembersihan_halaman_rs','pembersihan_tinja_rs','membuang_sampah_rs','foto_rs'
    ];
    protected $table = 'form_rumah_sehat';


    // public function akses()
    // {
    //     return $this->hasMany('App\Models\Akses', 'level_user_id', 'id');
    // }
}