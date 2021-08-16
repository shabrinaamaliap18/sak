<?php

namespace App\Models\forms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\SoftDeletes;


class KampungAsi extends Model
{
    // use HasFactory;
    // use SoftDeletes;
    // protected $dates = ['deleted_at'];
    use SoftDeletes;
    use Sortable;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'form_kk_id', 'kegiatan_id', 'tanggal_kunjungan_kpasi','nama_kader_kpasi','nama_kpasi','usia_kehamilan_kpasi','usia_bayi_kpasi' .'nama_ibu_domisili_kpasi', 'alamat_ibu_domisili_kpasi','alamat_ibu_ktp_kpasi','nik_ibu_kpasi','no_hp_kpasi','permasalahan_kunjungan_kpasi','penyuluhan_kunjungan_kpasi','status_rujukan_kpasi','penyebab_dirujuk_kpasi','foto_kpasi'
    ];
    protected $table = 'form_kp_asi';


    // public function akses()
    // {
    //     return $this->hasMany('App\Models\Akses', 'level_user_id', 'id');
    // }
}