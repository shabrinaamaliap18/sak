<?php

namespace App\Models\forms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Tbc extends Model
{
    // use HasFactory;
    // use SoftDeletes;
    // protected $dates = ['deleted_at'];
    protected $fillable = [
        'form_kk_id', 'kegiatan_id', 'nama_siswa_tbc', 'umur_tbc', 'jenis_kelamin_tbc', 'alamat_tbc', 'gejala_tbc',
        'riwayat_kontak_tbc', 'status_rujukan_tbc', 'status_fasyankes_rujukan', 'hasil_pemeriksaan', 'foto_tbc'
    ];
    protected $table = 'form_tbc';


    // public function akses()
    // {
    //     return $this->hasMany('App\Models\Akses', 'level_user_id', 'id');
    // }


}