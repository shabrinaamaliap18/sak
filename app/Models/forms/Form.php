<?php

namespace App\Models\forms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\SoftDeletes;


class Form extends Model
{
    // use HasFactory;
    // use SoftDeletes;
    // protected $dates = ['deleted_at'];
    use SoftDeletes;
    use Sortable;
    protected $dates = ['deleted_at'];
    protected $fillable = [

        'pegawai_id', 'kecamatan', 'kelurahan', 'rt', 'rw', 'no_kk', 'alamat_lengkap',
        'nama_kepala_kk', 'jumlah_anggota', 'status_rumah', 'status_penduduk', 'alamat_asal', 'tanggal_kedatangan', 'status', 'keterangan',  'acc_din', 'acc_dp', 'acc_dk', 'tanggal_input'
    ];
    protected $table = 'form_kk';
    public $sortable = [
        'pegawai_id', 'kecamatan', 'kelurahan', 'rt', 'rw', 'no_kk', 'alamat_lengkap',
        'nama_kepala_kk', 'jumlah_anggota', 'status_rumah', 'status_penduduk', 'alamat_asal', 'tanggal_kedatangan', 'status', 'keterangan',  'acc_din', 'acc_dp', 'acc_dk', 'tanggal_input'
    ];

    // public function akses()
    // {
    //     return $this->hasMany('App\Models\Akses', 'level_user_id', 'id');
    // }

    public function tbc()
    {
        return $this->hasOne('App\Models\Tbc', 'form_kk_id' , 'id');
    }

    public function jumantik()
    {
        return $this->hasOne('App\Models\Jumantik', 'form_kk_id' , 'id');
    }

    public function pelita()
    {
        return $this->hasOne('App\Models\Pelita', 'form_kk_id' , 'id');
    }

    public function ibu_hamil()
    {
        return $this->hasOne('App\Models\IbuHamil', 'form_kk_id' , 'id');
    }
}