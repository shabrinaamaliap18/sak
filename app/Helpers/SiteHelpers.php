<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use App\Models\Akses;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class SiteHelpers
{
    public static function cek_akses()
    {
        // $user  = Auth::user();
        // $akses = Akses::select('menu_id')->where('level_user_id', $user->level_user_id)->get();
        // $menu = Menu::select('id')->where('id', $akses)->get();
        // $akses = Akses::All();
        // dd($akses);


    }


    public static function main_menu()
    {

        $user  = Auth::user();
        $main_menu = DB::table('akses')->join('menu', 'menu.id', '=', 'akses.main_menu')
            ->select('menu.*')
            ->where('akses.level_user_id', $user->level_user_id)
            ->where('menu.level_menu', "main_menu")->get()
            ->unique();


        return $main_menu;
    }

    public static function sub_menu()
    {
        $user  = Auth::user();
        $sub_menu = DB::table('akses')->join('menu', 'menu.id', '=', 'akses.sub_menu')
            ->select('menu.*')
            ->where('akses.level_user_id',  $user->level_user_id)
            ->where('menu.level_menu', "sub_menu")->get()
            ->unique();

        // dd($sub_menu);

        return $sub_menu;
    }
}