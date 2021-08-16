<?php

namespace App\Models\forms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Posyandu extends Model
{
    // use HasFactory;
    // use SoftDeletes;
    // protected $dates = ['deleted_at'];
    protected $fillable = [
        'form_kk_id', 'kegiatan_id', 'nik_remaja', 'nama_lengkap_remaja', 'tempat_lahir_remaja', 'tanggal_lahir_remaja', 'umur',
        'telp_remaja', 'keluhan_utama', 'cara_mengatasi', 'obat_obatan', 'berat_badan', 'tinggi_badan', 'lila', 'anemia', 'foto_posyandu'
    ];
    protected $table = 'form_posyandu_remaja';


    // public function akses()
    // {
    //     return $this->hasMany('App\Models\Akses', 'level_user_id', 'id');
    // }
}