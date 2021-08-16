<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;



class UserRoleController extends Controller
{

    public function index()
    {

        $role = Role::join('akses', 'level_users.id', 'akses.level_user_id')
            ->get(['level_users.*', 'akses.*'])
            ->where('level_user_id , id');

        $role = Role::paginate(10);;
        return view('admin.role', ['role' => $role]);
    }

    public function tambah()
    {
        $role = Role::all();
        return view('admin.role-tambah', compact('role'));
    }


    public function store(Request $request, Role $role)
    {
        $this->validate($request, [
            'nama_level_user' => ['required', 'string', 'unique:level_users', 'max:255'],

        ]);

        Role::create([
            'nama_level_user' => $request->nama_level_user
        ]);

        return redirect('/role')->with('status', 'Data role Berhasil Ditambahkan!');
    }

    public function edit($id, Role $role)

    {
        $role = Role::all();
        $role = Role::find($id);
        return view('admin.role-edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $this->validate($request, [
            'nama_level_user' => ['required', 'string', 'unique:level_users', 'max:255'],
        ]);

        $role->nama_level_user = $request->nama_level_user;
        $role->save();
        return redirect('/role')->with('status', 'Data role Berhasil Diubah!');
    }

    public function delete($id)
    {
        $role = Role::find($id);
        $role->delete();
        return redirect('/role')->with('status', 'Data role Berhasil Dihapus!');
    }

    public function trash()
    {
        // mengampil data role yang sudah dihapus
        $role = Role::onlyTrashed()->get();
        return view('admin.role-trash', ['role' => $role]);
    }

    // restore data role yang dihapus
    public function kembalikan($id)
    {
        $role = Role::onlyTrashed()->where('id', $id);
        $role->restore();
        return redirect('/role')->with('status', 'Data role Berhasil Dikembalikan!');
    }

    // restore semua data role yang sudah dihapus
    public function kembalikan_semua()
    {

        $role = Role::onlyTrashed();
        $role->restore();

        return redirect('/role')->with('status', 'Data role Berhasil Dikembalikan!');
    }

    // hapus permanen
    public function hapus_permanen($id)
    {
        // hapus permanen data role
        $role = Role::onlyTrashed()->where('id', $id);
        $role->forceDelete();

        return redirect('/role/trash')->with('status', 'Data role Berhasil Dihapus!');
    }

    // hapus permanen semua role yang sudah dihapus
    public function hapus_permanen_semua()
    {
        // hapus permanen semua data role yang sudah dihapus
        $role = Role::onlyTrashed();
        $role->forceDelete();

        return redirect('/role/trash')->with('status', 'Data role Berhasil Dihapus!');
    }

    public function cari(Request $request)
    {
        // menangkap data pencarian
        $cari = $request->get('cari');
        $role = Role::all();

        if ($cari) {
            $role = Role::where("nama_level_user", "like", "%$cari%")->get();
        }


        return view('admin.role', compact('role'));
    }
}