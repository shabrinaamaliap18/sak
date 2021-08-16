<?php

namespace App\Models\forms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Satgas extends Model
{
    // use HasFactory;
    // use SoftDeletes;
    // protected $dates = ['deleted_at'];
    protected $fillable = [
        'form_kk_id', 'kegiatan_id', 'nik_satgas', 'nama_lengkap_satgas', 'jenis_kelamin_satgas', 'tempat_lahir_satgas', 'tanggal_lahir_satgas', 'telp_satgas', 'pendidikan_satgas', 'foto_pbkm'
    ];
    protected $table = 'form_satgas_pbkm';
}