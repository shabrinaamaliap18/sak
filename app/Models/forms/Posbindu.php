<?php

namespace App\Models\forms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;


class Posbindu extends Model
{
    // use HasFactory;
    use Sortable;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'nama_lengkap_bindu', 'nama_bindu', 'jenis_kelamin_bindu', 'riwayat_ptm_keluarga_bindu', 'riwayat_ptm_sendiri_bindu', 'merokok_bindu', 'kurang_aktivitas_fisik_bindu', 'kurang_sayur_buah_bindu', 'konsumsi_alkohol_bindu', 'tekanan_darah_bindu' ,'lingkar_perut_bindu','gula_darah_acak_bindu','kolestrol_bindu','foto_posbindu'
    ];
    protected $table = 'form_posbindu';

    public $sortable = ['nama_lengkap_bindu', 'nama_bindu', 'jenis_kelamin_bindu', 'riwayat_ptm_keluarga_bindu', 'riwayat_ptm_sendiri_bindu', 'merokok_bindu', 'kurang_aktivitas_fisik_bindu', 'kurang_sayur_buah_bindu', 'konsumsi_alkohol_bindu', 'tekanan_darah_bindu' ,'lingkar_perut_bindu','gula_darah_acak_bindu','kolestrol_bindu','foto_posbindu'];
}
