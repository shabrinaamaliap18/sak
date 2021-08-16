<?php

namespace App\Models\forms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Penduduk extends Model
{
    // use HasFactory;
    protected $fillable = ['form_kk_id', 'nik', 'nama_lengkap', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'telp', 'pekerjaan', 'pendidikan', 'status_kawin'];
    protected $table = 'form_penduduk';
    
}