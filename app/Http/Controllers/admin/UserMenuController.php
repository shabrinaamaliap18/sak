<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Akses;
use App\Models\user;

use App\Models\Menu;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;



class UserMenuController extends Controller
{
    public function index()
    {
        $menu = Menu::paginate(10);
        $skipped = ($menu->currentPage() * $menu->perPage()) - $menu->perPage();

        return view('admin.menu', ['menu' => $menu], ['skipped' => $skipped]);
    }

    public function tambah()
    {

        $master_menu = DB::table('menu')
            ->where('level_menu', '=', 'main_menu')
            ->get(['menu.*', 'id', 'nama_menu']);

        $menu = Menu::all();

        return view('admin.menu-tambah', compact('menu', 'master_menu'));
    }


    public function store(Request $request, menu $menu)
    {
        $this->validate($request, [
            'nama_menu' => 'required',
            'level_menu' => 'required',
            'url' => 'required',
            'icon' => 'required',
            'aktif' => 'required',
            'no_urut' => 'required',

        ]);

        menu::create([
            'nama_menu' => $request->nama_menu,
            'level_menu' => $request->level_menu,
            'master_menu' => $request->master_menu,
            'url' => $request->url,
            'icon' => $request->icon,
            'aktif' => $request->aktif,
            'no_urut' => $request->no_urut,
        ]);

        return redirect('/menu')->with('status', 'Data menu Berhasil Ditambahkan!');
    }

    public function edit($id, Menu $menu)

    {


        $master_menu = DB::table('menu')
            ->where('level_menu', '=', 'main_menu')
            ->get(['menu.*', 'id', 'nama_menu']);

        $menu = Menu::find($id);

        return view('admin.menu-edit', compact('menu', 'master_menu'));
    }

    public function update($id, Request $request, Menu $menu)
    {


        $menu = Menu::find($id);
        $menu->nama_menu = $request->nama_menu;
        $menu->level_menu = $request->level_menu;
        $menu->master_menu = $request->master_menu;
        $menu->url = $request->url;
        $menu->icon = $request->icon;
        $menu->aktif = $request->aktif;
        $menu->no_urut = $request->no_urut;


        if (Akses::where('main_menu', $id)->where('sub_menu', $id)->doesntExist()) {
            $menu = Menu::find($id);
            $menu->save();
            return redirect('/menu')->with('status', 'Data menu berhasil diubah!');
        }
        return redirect('/menu')->with('status', 'Data menu gagal diubah karena sedang digunakan!');
    }

    public function delete($id)
    {

        if (Akses::where('main_menu', $id)->doesntExist()) {
            $menu = Menu::find($id);
            $menu->delete();
            return redirect('/menu')->with('status', 'Data menu berhasil dihapus!');
        }

        if (Akses::where('sub_menu', $id)->doesntExist()) {
            $menu = Menu::find($id);
            $menu->delete();
            return redirect('/menu')->with('status', 'Data menu berhasil dihapus!');
        }
        return redirect('/menu')->with('status', 'Data menu gagal dihapus karena sedang digunakan!');
    }

    public function trash()
    {
        // mengambil data menu yang sudah dihapus
        $menu = Menu::onlyTrashed()->get();
        return view('admin.menu-trash', ['menu' => $menu]);
    }

    // restore data menu yang dihapus
    public function kembalikan($id)
    {
        $menu = Menu::onlyTrashed()->where('id', $id);
        $menu->restore();
        return redirect('/menu')->with('status', 'Data menu Berhasil Dikembalikan!');
    }

    // restore semua data menu yang sudah dihapus
    public function kembalikan_semua()
    {

        $menu = Menu::onlyTrashed();
        $menu->restore();

        return redirect('/menu')->with('status', 'Data menu Berhasil Dikembalikan!');
    }

    // hapus permanen
    public function hapus_permanen($id)
    {
        // hapus permanen data menu
        $menu = Menu::onlyTrashed()->where('id', $id);
        $menu->forceDelete();

        return redirect('/menu/trash')->with('status', 'Data menu Berhasil Dihapus!');
    }

    // hapus permanen semua menu yang sudah dihapus
    public function hapus_permanen_semua()
    {
        // hapus permanen semua data menu yang sudah dihapus
        $menu = Menu::onlyTrashed();
        $menu->forceDelete();

        return redirect('/menu/trash')->with('status', 'Data menu Berhasil Dihapus!');
    }
    public function cari(Request $request)
    {
        // menangkap data pencarian
        $cari = $request->get('cari');
        $menu = Menu::all();

        if ($cari) {
            $menu = Menu::where("nama_menu", "like", "%$cari%")->get();
        }


        return view('admin.menu', compact('menu'));
    }



    public function getMain()
    {
        $main = DB::table('menu')
            ->where('level_menu', '=', 'main_menu')
            ->pluck("nama_menu", "id");

        return view('admin.menu-tambah', compact('main'));
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