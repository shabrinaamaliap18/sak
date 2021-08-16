<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    // use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['pegawai_id' , 'name', 'username', 'level_user_id', 'email', 'password'];
    protected $table = 'users';


    // public function akses()
    // {
    //     return $this->hasMany('App\Models\Akses', 'level_user_id', 'id');
    // }

    // public function role()
    // {
    //     return $this->belongsTo('App\Models\Role','role_id');
    // }
 
    // public function hasRole($roles)
    // {
    //     $this->have_role = $this->getUserRole();
        
    //     if(is_array($roles)){
    //         foreach($roles as $need_role){
    //             if($this->cekUserRole($need_role)) {
    //                 return true;
    //             }
    //         }
    //     } else{
    //         return $this->cekUserRole($roles);
    //     }
    //     return false;
    // }
    // private function getUserRole()
    // {
    //    return $this->role()->getResults();
    // }
    
    // private function cekUserRole($role)
    // {
    //     return (strtolower($role)==strtolower($this->have_role->nama)) ? true : false;
    // }

    public function role()
    {
        return $this->belongsTo('App\Models\Role','level_user_id');
    }
 
    public function hasRole($roles)
    {
        $this->have_role = $this->getUserRole();
        
        if(is_array($roles)){
            foreach($roles as $need_role){
                if($this->cekUserRole($need_role)) {
                    return true;
                }
            }
        } else{
            return $this->cekUserRole($roles);
        }
        return false;
    }
    private function getUserRole()
    {
       return $this->role()->getResults();
    }
    
    private function cekUserRole($role)
    {
        return (strtolower($role)==strtolower($this->have_role->nama)) ? true : false;
    }


}