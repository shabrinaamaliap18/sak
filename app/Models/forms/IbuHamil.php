<?php

namespace App\Models\forms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;


class IbuHamil extends Model
{
    // use HasFactory;
    use Sortable;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'nama_ibu_hamil', 'umur_ibu_hamil', 'nik_ibu_hamil', 'nama_suami', 'nik_suami', 'alamat_ibu_hamil', 'kondisi_ibu_hamil', 'kasus_ibu_hamil', 'keterangan_ibu_hamil', 'foto_ibu_hamil'
    ];
    protected $table = 'form_ibu_hamil';
}