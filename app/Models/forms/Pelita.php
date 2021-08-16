<?php

namespace App\Models\forms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\SoftDeletes;


class Pelita extends Model
{
    // use HasFactory;
    // use SoftDeletes;
    // protected $dates = ['deleted_at'];
    use SoftDeletes;
    use Sortable;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'form_kk_id', 'kegiatan_id', 'nama_pelita', 'nik_pelita', 'jenis_kelamin_pelita', 'tanggal_lahir_pelita', 'umur_pelita', 'bb_lahir_pelita', 'pb_lahir_pelita', 'bb_pelita', 'pb_pelita', 'lila_pelita', 'cara_ukur_pb_pelita', 'nama_ayah_pelita', 'nik_ayah_pelita', 'nama_ibu_pelita', 'nik_ibu_pelita', 'alamat_domisili_pelita', 'rt_pelita', 'rw_pelita', 'alamat_ktp_pelita', 'no_hp_ortu_pelita', 'status_pelita', 'perkembangan_balita_pelita', 'foto_pelita'
    ];
    protected $table = 'form_pelita';
    
    // public function akses()
    // {
    //     return $this->hasMany('App\Models\Akses', 'level_user_id', 'id');
    // }
}