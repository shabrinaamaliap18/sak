<?php

namespace App\Models\forms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $fillable = [
        'form_kk_id', 'id_penerima','id_pengirim','nama_proses', 'judul', 'keterangan','tanggal_acc','date_time'
    ];

    protected $table = 'histories';
}