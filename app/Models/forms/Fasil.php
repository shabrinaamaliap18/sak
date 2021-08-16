<?php

namespace App\Models\forms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Fasil extends Model
{
    // use HasFactory;
    // use SoftDeletes;
    // protected $dates = ['deleted_at'];
    protected $fillable = [
        'form_kk_id', 'kegiatan_id', 'nik_fasil', 'nama_lengkap_fasil', 'jenis_kelamin_fasil', 'tempat_lahir_fasil', 'tanggal_lahir_fasil', 'telp_fasil', 'pendidikan_fasil', 'foto_fasil'
    ];
    protected $table = 'form_fasil_lingkungan';


    public function akses()
    {
        return $this->hasMany('App\Models\Akses', 'level_user_id', 'id');
    }
}