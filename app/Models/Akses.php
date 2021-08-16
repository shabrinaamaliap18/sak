<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Akses extends Model
{
    // use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['level_user_id', 'main_menu', 'sub_menu'];
    protected $table = 'akses';


    public function role()
    {
        return $this->belongsTo('App\Models\Role', 'level_user_id', 'id');
    }

    public function main_menu()
    {
        return $this->belongsTo('App\Models\Menu', 'main_menu', 'id');
    }

    public function sub_menu()
    {
        return $this->belongsTo('App\Models\Menu', 'sub_menu', 'id');
    }
}
