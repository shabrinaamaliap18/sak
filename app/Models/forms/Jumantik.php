<?php

namespace App\Models\forms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Jumantik extends Model
{
    // use HasFactory;
    // use SoftDeletes;
    // protected $dates = ['deleted_at'];
    protected $fillable = [
        'form_kk_id', 'kegiatan_id', 'jentik_bak_km', 'jentik_dispenser', 'jentik_gentong', 'jentik_tampungan_lemari_es', 'jentik_tampungan_pot_bunga',
        'jentik_tampungan_minum_burung', 'jentik_tampungan_barang_bekas', 'jentik_tampungan_lubang_pohon', 'penyuluhan_psn', 'pemahaman_3m_plus','foto_jumantik'
    ];
    protected $table = 'form_jumantik';


    // public function akses()
    // {
    //     return $this->hasMany('App\Models\Akses', 'level_user_id', 'id');
    // }
}