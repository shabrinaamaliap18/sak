<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\user;
use App\Models\Level;
use App\Models\Menu;
use App\Models\Pegawai;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserMasterController extends Controller
{

    public function index()
    {

        $user = User::join('level_users', 'level_user_id', '=', 'level_users.id')
            ->join('pegawai', 'pegawai_id', '=', 'pegawai.id')
            ->paginate(10, ['users.*', 'nama_level_user', 'nama_pegawai']);
        $skipped = ($user->currentPage() * $user->perPage()) - $user->perPage();


        return view('admin.user', ['user' => $user], ['skipped' => $skipped]);
    }

    public function tambah()
    {
        $pegawai = Pegawai::all();
        $level = Role::all();
        $menu = Menu::all();
        return view('admin.user-tambah', compact('level', 'menu', 'pegawai'));
    }


    public function store(Request $request, user $user)
    {
        $this->validate($request, [
            'pegawai_id' => 'required',
            'name' => 'required',
            'username' => ['required', 'string', 'unique:users', 'max:255'],
            'level_user_id' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' =>  ['required', 'string', 'min:8']

        ]);

        user::create([
            'pegawai_id' => $request->pegawai_id,
            'name' => $request->name,
            'username' => $request->username,
            'level_user_id' => $request->level_user_id,
            'email' => $request->email,
            'password' => Hash::make($request->get('password')),
        ]);

        return redirect('/user')->with('status', 'Data user Berhasil Ditambahkan!');
    }

    public function edit($id, user $user)

    {
        $pegawai = Pegawai::all();
        $level = Role::all();
        $menu = Menu::all();
        $user = User::find($id);
        return view('admin.user-edit', compact('level', 'menu', 'user', 'pegawai'));
    }

    public function update($id, Request $request, user $user)
    {
        $this->validate($request, [
            'pegawai_id' => 'required',
            'name' => 'required',
            'username' => ['required', 'string',  'max:255'],
            'level_user_id' => 'required',
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' =>  ['required', 'string', 'min:8']
        ]);

        $user = User::find($id);
        $user->pegawai_id = $request->pegawai_id;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->level_user_id = $request->level_user_id;
        $user->email = $request->email;
        $user->password = Hash::make($request->get('password'));


        $user->save();
        return redirect('/user')->with('status', 'Data user Berhasil Diubah!');
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/user')->with('status', 'Data pegawai Berhasil Dihapus!');
    }

    public function trash()
    {

        // mengampil data pegawai yang sudah dihapus
        $user = User::join('level_users', 'level_user_id', '=', 'level_users.id')
            ->join('pegawai', 'pegawai_id', '=', 'pegawai.id')->onlyTrashed()->get(['users.*', 'nama_level_user', 'nama_pegawai']);

        return view('admin.user-trash', ['user' => $user]);
    }


    // restore data pegawai yang dihapus
    public function kembalikan($id)
    {
        $user = User::onlyTrashed()->where('id', $id);
        $user->restore();
        return redirect('/user')->with('status', 'Data pegawai Berhasil Dikembalikan!');
    }

    // restore semua data pegawai yang sudah dihapus
    public function kembalikan_semua()
    {

        $user = User::onlyTrashed();
        $user->restore();

        return redirect('/user')->with('status', 'Data pegawai Berhasil Dikembalikan!');
    }

    // hapus permanen
    public function hapus_permanen($id)
    {
        // hapus permanen data pegawai
        $user = User::onlyTrashed()->where('id', $id);
        $user->forceDelete();

        return redirect('/user/trash')->with('status', 'Data pegawai Berhasil Dihapus!');
    }

    // hapus permanen semua pegawai yang sudah dihapus
    public function hapus_permanen_semua()
    {
        // hapus permanen semua data pegawai yang sudah dihapus
        $user = User::onlyTrashed();
        $user->forceDelete();

        return redirect('/user/trash')->with('status', 'Data pegawai Berhasil Dihapus!');
    }

    public function cari(Request $request)
    {
        // menangkap data pencarian
        $cari = $request->get('cari');
        $user = User::all();

        if ($cari) {
            $user = User::join('level_users', 'level_user_id', '=', 'level_users.id')
                ->join('pegawai', 'pegawai_id', '=', 'pegawai.id')
                ->where("name", "like", "%$cari%")->get();
        }


        return view('admin.user', compact('user'));
    }
}