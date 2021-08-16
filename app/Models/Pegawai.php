<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;
use Livewire\Component;
use App\Models\Product;
use App\Models\HasFactory;

class Pegawai extends Model
{

    use Sortable;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['nama_pegawai', 'NIP', 'NIK', 'jenis_kelamin', 'tanggal_lahir', 'foto_pegawai'];
    protected $table = 'pegawai';
    protected $casts = [
        'pengurus' => 'array'
    ];
    public $sortable = ['nama_pegawai', 'NIP', 'NIK', 'jenis_kelamin', 'tanggal_lahir', 'foto_pegawai'];
}