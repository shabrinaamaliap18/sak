<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Akses;
use App\Models\Level;
use App\Models\Menu;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserAksesController extends Controller
{
    public function index()
    {
        $main = DB::table('menu')
            ->where('level_menu', '=', 'main_menu')
            ->pluck("nama_menu", "id");


        $akses = Akses::join('level_users', 'level_user_id', '=', 'level_users.id')
            ->join('menu', 'main_menu', '=', 'menu.id')
            ->get(['akses.*', 'nama_level_user', 'nama_menu']);


        return view('admin.akses', ['akses' => $akses], ['main' => $main]);
    }

    public function tambah()
    {
        $level = Role::all();
        $menu = Menu::all();

        $main = DB::table('menu')
            ->where('level_menu', '=', 'main_menu')
            ->get(['menu.*', 'id', 'nama_menu']);

        return view('admin.akses-tambah', compact('menu', 'main', 'level'));
    }


    public function store(Request $request, Akses $akses)
    {
        $this->validate($request, [
            'level_user_id' => 'required',
            'main_menu' => 'required',
            'sub_menu' => 'required'

        ]);


        Akses::create([
            'level_user_id' => $request->level_user_id,
            'main_menu' => $request->main_menu,
            'sub_menu' => $request->sub_menu,

        ]);

        return redirect('/akses/show')->with('status', 'Data Akses Berhasil Ditambahkan!');
    }



    public function delete($id)
    {
        $akses = Akses::find($id);
        $akses->delete();
        return redirect('/role')->with('status', 'Data akses Berhasil Dihapus!');
    }

    public function trash()
    {
        // mengampil data akses yang sudah dihapus
        $akses = Akses::onlyTrashed()->get();
        return view('admin.akses-trash', ['akses' => $akses]);
    }

    // restore data akses yang dihapus
    public function kembalikan($id)
    {
        $akses = Akses::onlyTrashed()->where('id', $id);
        $akses->restore();
        return redirect('/akses')->with('status', 'Data akses Berhasil Dikembalikan!');
    }

    // restore semua data akses yang sudah dihapus
    public function kembalikan_semua()
    {

        $akses = Akses::onlyTrashed();
        $akses->restore();

        return redirect('/akses')->with('status', 'Data akses Berhasil Dikembalikan!');
    }

    // hapus permanen
    public function hapus_permanen($id)
    {
        // hapus permanen data akses
        $akses = Akses::onlyTrashed()->where('id', $id);
        $akses->forceDelete();

        return redirect('/akses/trash')->with('status', 'Data akses Berhasil Dihapus!');
    }

    // hapus permanen semua akses yang sudah dihapus
    public function hapus_permanen_semua()
    {
        // hapus permanen semua data akses yang sudah dihapus
        $akses = Akses::onlyTrashed();
        $akses->forceDelete();

        return redirect('/akses/trash')->with('status', 'Data akses Berhasil Dihapus!');
    }


    public function show(Request $request, $id)
    {
        $akses = Akses::join('level_users', 'level_user_id', 'level_users.id')
            ->join('menu', 'sub_menu', '=', 'menu.id')
            ->get(['level_users.*', 'akses.*', 'menu.*'])
            ->where('level_user_id', $id);


        return view('admin.role-akses', ['akses' => $akses]);
    }

    public function getMain()
    {
        $main = DB::table('menu')
            ->where('level_menu', '=', 'main_menu')
            ->pluck("nama_menu", "id");

        return view('admin.menu-tambah', compact('main'), ['main' => $main]);
    }

    public function getSub($id)
    {
        $sub = DB::table('menu')
            ->where('level_menu', '=', 'sub_menu')
            ->where('master_menu', '=', $id)
            ->pluck("nama_menu", "id");


        return json_encode($sub);
    }
}
