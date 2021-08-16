<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Livewire\Component;
use App\Models\Product;
use App\Models\HasFactory;

class LihatHonor extends Model
{

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['nama_kader', 'daftar_kegiatan', 'no_rekening', 'nominal', 'selip_gaji'];
    protected $table = 'lihat_honor';
    
}