<?php

use App\Http\Middleware\CekLoginMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\Authenticate;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', 'otentikasi\OtentikasiController@index')->name('loginindex');
Route::get('/masuk', 'otentikasi\OtentikasiController@login')->name('loginotentikasi');

Route::group(['middleware' => 'auth'], function () {

    //User CRUD Clear
    Route::get('/user/edit/{id}', 'admin\UserMasterController@edit');
    Route::put('/user/update/{id}', 'admin\UserMasterController@update');
    Route::get('/user/tambah', 'admin\UserMasterController@tambah');
    Route::get('/user/hapus/{id}', 'admin\UserMasterController@delete');
    Route::get('/user/cari', 'admin\UserMasterController@cari');
    Route::get('/user/trash', 'admin\UserMasterController@trash');
    Route::get('/user/kembalikan/{id}', 'admin\UserMasterController@kembalikan');
    Route::get('/user/kembalikan_semua', 'admin\UserMasterController@kembalikan_semua');
    Route::get('/user/hapus_permanen/{id}', 'admin\UserMasterController@hapus_permanen');
    Route::get('/user/hapus_permanen_semua', 'admin\UserMasterController@hapus_permanen_semua');
    Route::resource('/user', 'admin\UserMasterController');
    //Batas CRUD



    //Akses CRUD Clear
    Route::get('/akses/tambah', 'admin\UserAksesController@getMain');
    Route::get('/akses/tambah/getsub/{id}', 'admin\UserAksesController@getSub');
    Route::get('/akses/tambah/', 'admin\UserAksesController@tambah');
    Route::get('/akses/hapus/{id}', 'admin\UserAksesController@delete');
    Route::get('/akses/show/{id}', 'admin\UserAksesController@show'); //untuk menampilkan akses pada setiap role
    Route::resource('/akses', 'admin\UserAksesController');
    //Batas CRUDs


    //Role CRUD Clear
    Route::get('/role/edit/{id}', 'admin\UserRoleController@edit');
    Route::put('/role/update/{id}', 'admin\UserRoleController@update');
    Route::get('/role/tambah', 'admin\UserRoleController@tambah');
    Route::get('/role/hapus/{id}', 'admin\UserRoleController@delete');
    Route::get('/role/trash', 'admin\UserRoleController@trash');
    Route::get('/role/kembalikan/{id}', 'admin\UserRoleController@kembalikan');
    Route::get('/role/kembalikan_semua', 'admin\UserRoleController@kembalikan_semua');
    Route::get('/role/hapus_permanen/{id}', 'admin\UserRoleController@hapus_permanen');
    Route::get('/role/hapus_permanen_semua', 'admin\UserRoleController@hapus_permanen_semua');
    Route::get('/role/cari', 'admin\UserRoleController@cari');
    Route::resource('/role', 'admin\UserRoleController');
    //Batas CRUD

    //Pegawai CRUD Clear
    Route::get('/pegawai/edit/{id}', 'admin\UserPegawaiController@edit');
    Route::put('/pegawai/update/{id}', 'admin\UserPegawaiController@update');
    Route::get('/pegawai2/tambah/getsub', 'admin\UserPegawaiController@getSub');
    Route::get('/pegawai/tambah', 'admin\UserPegawaiController@tambah');
    Route::get('/pegawai/hapus/{id}', 'admin\UserPegawaiController@delete');
    Route::get('/pegawai/trash', 'admin\UserPegawaiController@trash');
    Route::get('/pegawai/kembalikan/{id}', 'admin\UserPegawaiController@kembalikan');
    Route::get('/pegawai/kembalikan_semua', 'admin\UserPegawaiController@kembalikan_semua');
    Route::get('/pegawai/hapus_permanen/{id}', 'admin\UserPegawaiController@hapus_permanen');
    Route::get('/pegawai/hapus_permanen_semua', 'admin\UserPegawaiController@hapus_permanen_semua');
    Route::get('/pegawai/cari', 'admin\UserPegawaiController@cari');
    Route::resource('/pegawai', 'admin\UserPegawaiController');

    //Batas CRUD


    //Tim CRUD Clear
    Route::get('/tim/hapus/{id}', 'admin\MasterTimController@delete');
    Route::get('/tim/edit/{id}', 'admin\MasterTimController@tambah');
    Route::resource('/tim', 'admin\MasterTimController');
    // nampilin tim ada di pegawai
    //Batas CRUD

    //Menu CRUD Clear
    Route::get('/menu/tambah', 'admin\UserMenuController@getMain');
    Route::get('/menu/tambah', 'admin\UserMenuController@tambah');
    Route::get('/menu/edit/{id}', 'admin\UserMenuController@edit');
    Route::put('/menu/update/{id}', 'admin\UserMenuController@update');
    Route::get('/menu/hapus/{id}', 'admin\UserMenuController@delete');
    Route::get('/menu/cari', 'admin\UserMenuController@cari');
    Route::get('/menu/trash', 'admin\UserMenuController@trash');
    Route::get('/menu/kembalikan/{id}', 'admin\UserMenuController@kembalikan');
    Route::get('/menu/kembalikan_semua', 'admin\UserMenuController@kembalikan_semua');
    Route::get('/menu/hapus_permanen/{id}', 'admin\UserMenuController@hapus_permanen');
    Route::get('/menu/hapus_permanen_semua', 'admin\UserMenuController@hapus_permanen_semua');
    Route::resource('/menu', 'admin\UserMenuController');
    //Batas CRUD

    //Schema CRUD Clear
    Route::get('/schema/tambah', 'admin\MasterSchemaController@tambah');
    Route::get('/schema/edit/{id}', 'admin\MasterSchemaController@edit');
    Route::put('/schema/update/{id}', 'admin\MasterSchemaController@update');
    Route::get('/schema/hapus/{id}', 'admin\MasterSchemaController@delete');
    Route::get('/schema/trash', 'admin\MasterSchemaController@trash');
    Route::get('/schema/kembalikan/{id}', 'admin\MasterSchemaController@kembalikan');
    Route::get('/schema/kembalikan_semua', 'admin\MasterSchemaController@kembalikan_semua');
    Route::get('/schema/hapus_permanen/{id}', 'admin\MasterSchemaController@hapus_permanen');
    Route::get('/schema/hapus_permanen_semua', 'admin\MasterSchemaController@hapus_permanen_semua');
    Route::get('/schema/cari', 'admin\MasterSchemaController@cari');
    Route::resource('/schema', 'admin\MasterSchemaController');
    //Batas CRUD

    //Workflow CRUD Clear
    Route::get('/workflow/tambah', 'admin\MasterWorkflowController@tambah');
    Route::get('/workflow/edit/{id}', 'admin\MasterWorkflowController@edit');
    Route::put('/workflow/update/{id}', 'admin\MasterWorkflowController@update');
    Route::get('/workflow/hapus/{id}', 'admin\MasterWorkflowController@delete');
    Route::get('/workflow/trash', 'admin\MasterWorkflowController@trash');
    Route::get('/workflow/kembalikan/{id}', 'admin\MasterWorkflowController@kembalikan');
    Route::get('/workflow/kembalikan_semua', 'admin\MasterWorkflowController@kembalikan_semua');
    Route::get('/workflow/hapus_permanen/{id}', 'admin\MasterWorkflowController@hapus_permanen');
    Route::get('/workflow/hapus_permanen_semua', 'admin\MasterWorkflowController@hapus_permanen_semua');
    Route::get('/workflow/cari', 'admin\MasterWorkflowController@cari');
    Route::resource('/workflow', 'admin\MasterWorkflowController');
    //Batas CRUD

    //Proses CRUD Clear
    Route::get('/proses/tambah', 'admin\MasterProsesController@tambah');
    Route::get('/proses/edit/{id}', 'admin\MasterProsesController@edit');
    Route::put('/proses/update/{id}', 'admin\MasterProsesController@update');
    Route::get('/proses/hapus/{id}', 'admin\MasterProsesController@delete');
    Route::get('/proses/trash', 'admin\MasterProsesController@trash');
    Route::get('/proses/kembalikan/{id}', 'admin\MasterProsesController@kembalikan');
    Route::get('/proses/kembalikan_semua', 'admin\MasterProsesController@kembalikan_semua');
    Route::get('/proses/hapus_permanen/{id}', 'admin\MasterProsesController@hapus_permanen');
    Route::get('/proses/hapus_permanen_semua', 'admin\MasterProsesController@hapus_permanen_semua');
    Route::get('/proses/cari', 'admin\MasterProsesController@cari');
    Route::resource('/proses', 'admin\MasterProsesController');
    //Batas CRUD


    //isi form

    Route::get('/alllaporan/tambah/getkelurahan/{id}', 'masterreport\AllLaporanController@getKelurahan');
    Route::get('/alllaporan/tambah', 'masterreport\AllLaporanController@getKecamatan');
    
    Route::get('/alllaporan/tambah/', 'masterreport\AllLaporanController@tambah');
    Route::get('/alllaporan/hapus/{id}', 'masterreport\AllLaporanController@delete');
    Route::put('/alllaporan/update/{id}', 'masterreport\AllLaporanController@update');
    Route::get('/alllaporan/edit/{id}', 'masterreport\AllLaporanController@edit');
    Route::get('/alllaporan/trash', 'masterreport\AllLaporanController@trash');
    Route::get('/alllaporan/kembalikan/{id}', 'masterreport\AllLaporanController@kembalikan');
    Route::get('/alllaporan/kembalikan_semua', 'masterreport\AllLaporanController@kembalikan_semua');
    Route::get('/alllaporan/hapus_permanen/{id}', 'masterreport\AllLaporanController@hapus_permanen');
    Route::get('/alllaporan/hapus_permanen_semua', 'masterreport\AllLaporanController@hapus_permanen_semua');
    Route::get('/alllaporan/cari', 'masterreport\AllLaporanController@cari');
    Route::get('/alllaporan/show/{id}', 'masterreport\AllLaporanController@show');
    Route::get('/alllaporan/hapus/{id}', 'masterreport\AllLaporanController@delete');
    Route::put('/alllaporan/teruskanopd/{id}', 'masterreport\AllLaporanController@teruskanopd');
    Route::put('/alllaporan/teruskan/{id}', 'masterreport\AllLaporanController@teruskan');
    Route::get('/alllaporan/alllaporan', 'masterreport\AllLaporanController@index');
    Route::resource('alllaporan', 'masterreport\AllLaporanController');


    //laporan koordinator
    Route::put('/lapkoor/teruskan/{id}', 'masterreport\LapKoorController@teruskan');
    Route::get('/lapkoor/show/{id}', 'masterreport\LapKoorController@show');
    Route::get('lapkoor', 'masterreport\LapKoorController@index');
    Route::resource('lapkoor', 'masterreport\LapKoorController');


    Route::put('/lapopddinkes/revisi/{id}', 'masterreport\LapOpdDinkesController@revisi');
    Route::put('/lapopddinkes/teruskanhonor/{id}', 'masterreport\LapOpdDinkesController@teruskanhonor');

    Route::put('/lapopddinkes/teruskan/{id}', 'masterreport\LapOpdDinkesController@teruskan');
    Route::get('/lapopddinkes/show/{id}', 'masterreport\LapOpdDinkesController@show');
    Route::get('/lapopddinkes/teruskan/{id}', 'masterreport\LapOpdDinkesController@teruskan');
    Route::resource('lapopddinkes', 'masterreport\LapOpdDinkesController');

    Route::put('/lapopddkrth/revisi/{id}', 'masterreport\LapOpdDkrthController@revisi');
    Route::put('/lapopddkrth/teruskanhonor/{id}', 'masterreport\LapOpdDkrthController@teruskanhonor');
    Route::put('/lapopddkrth/teruskan/{id}', 'masterreport\LapOpdDkrthController@teruskan');
    Route::get('/lapopddkrth/show/{id}', 'masterreport\LapOpdDkrthController@show');
    Route::resource('lapopddkrth', 'masterreport\LapOpdDkrthController');


    Route::get('/laphonor/show/{id}', 'masterreport\LapHonorController@show');
    Route::resource('laphonor', 'masterreport\LapHonorController');

    Route::put('/lapopddp5a/revisi/{id}', 'masterreport\LapOpdDp5aController@revisi');
    Route::put('/lapopddp5a/teruskanhonor/{id}', 'masterreport\LapOpdDp5aController@teruskanhonor');
    Route::put('/lapopddp5a/teruskan/{id}', 'masterreport\LapOpdDp5aController@teruskan');
    Route::get('/lapopddp5a/show/{id}', 'masterreport\LapOpdDp5aController@show');
    Route::resource('lapopddp5a', 'masterreport\LapOpdDp5aController');


    //HONOR
    Route::get('/lihathonor', 'honor\LihatHonorController@index');
    Route::get('/lihathonor/edit/{id}', 'honor\LihatHonorController@edit');
    Route::put('/lihathonor/update/{id}', 'honor\LihatHonorController@update');
    Route::get('/lihathonor/tambah', 'honor\LihatHonorController@tambah');
    Route::get('/lihathonor/hapus/{id}', 'honor\LihatHonorController@delete');
    Route::get('/lihathonor/trash', 'honor\LihatHonorController@trash');
    Route::get('/lihathonor/kembalikan/{id}', 'honor\LihatHonorController@kembalikan');
    Route::get('/lihathonor/kembalikan_semua', 'honor\LihatHonorController@kembalikan_semua');
    Route::get('/lihathonor/hapus_permanen/{id}', 'honor\LihatHonorController@hapus_permanen');
    Route::get('/lihathonor/hapus_permanen_semua', 'honor\LihatHonorController@hapus_permanen_semua');
    Route::get('/lihathonor/cari', 'honor\LihatHonorController@cari');
    Route::resource('lihathonor', 'honor\LihatHonorController');


    Route::get('/rekaplaporan/show/{id}', 'rekap\RekapLaporanController@show');
    Route::post('/rekaplaporan/date', 'rekap\RekapLaporanController@search');
    Route::resource('/rekaplaporan', 'rekap\RekapLaporanController');
    Route::resource('/kellaporanwarga', 'laporan\KelLaporanWargaController');
    Route::resource('/kellaporankader', 'laporan\KelLaporanKaderController');

    


    Route::get('/dashboard', function () {
        return view('dashboard.dashboard');
    });
});
Auth::routes();