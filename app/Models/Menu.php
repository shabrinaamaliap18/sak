<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;use Illuminate\Database\Eloquent\SoftDeletes;


class Menu extends Model
{
    // use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['nama_menu', 'level_menu', 'master_menu', 'url', 'icon', 'aktif', 'no_urut'];
    protected $table = 'menu';


    public function akses()
    {
        return $this->hasMany('App\Models\Akses', 'level_user_id', 'id');
    }
}