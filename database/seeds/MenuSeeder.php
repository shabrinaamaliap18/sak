<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menu')->insert([

            [
                'nama_menu' => 'Forms',
                'level_menu' => 'main_menu',
                'url' => 'forms',
                'icon' => 'far fa-file-alt',
                'aktif' => 'Y',
                'no_urut' => 1,
                'master_menu' => 0,
            ],

            [
                'nama_menu' => 'Forms Kader',
                'level_menu' => 'sub_menu',
                'url' => 'forms',
                'icon' => '',
                'aktif' => 'Y',
                'no_urut' => 2,
                'master_menu' => 1,
            ],



            [
                'nama_menu' => 'Daftar Report',
                'level_menu' => 'main_menu',
                'url' => 'daftarreport',
                'icon' => 'far fa-clipboard',
                'aktif' => 'Y',
                'no_urut' => 3,
                'master_menu' => 0,
            ],

            [
                'nama_menu' => 'Dinas Kesehatan',
                'level_menu' => 'sub_menu',
                'url' => 'daftarreport/dinkes',
                'icon' => '',
                'aktif' => 'Y',
                'no_urut' => 4,
                'master_menu' => 3,
            ],

            [
                'nama_menu' => 'DP5A',
                'level_menu' => 'sub_menu',
                'url' => 'daftarreport/dp5a',
                'icon' => '',
                'aktif' => 'Y',
                'no_urut' => 5,
                'master_menu' => 3,
            ],

            [
                'nama_menu' => 'DKRTH',
                'level_menu' => 'sub_menu',
                'url' => 'daftarreport/dkrth',
                'icon' => '',
                'aktif' => 'Y',
                'no_urut' => 6,
                'master_menu' => 3,
            ],

            [
                'nama_menu' => 'Master Report',
                'level_menu' => 'main_menu',
                'url' => 'masterreport',
                'icon' => 'far fa-copy',
                'aktif' => 'Y',
                'no_urut' => 7,
                'master_menu' => 0,
            ],

            [
                'nama_menu' => 'All Laporan',
                'level_menu' => 'sub_menu',
                'url' => 'alllaporan',
                'icon' => '',
                'aktif' => 'Y',
                'no_urut' => 8,
                'master_menu' => 7,
            ],



            [
                'nama_menu' => 'Honor',
                'level_menu' => 'main_menu',
                'url' => 'honor',
                'icon' => 'far fa-money-bill-alt',
                'aktif' => 'Y',
                'no_urut' => 9,
                'master_menu' => 0,
            ],

            [
                'nama_menu' => 'Lihat Honor',
                'level_menu' => 'sub_menu',
                'url' => 'lihathonor',
                'icon' => '',
                'aktif' => 'Y',
                'no_urut' => 10,
                'master_menu' => 9,
            ],


            [
                'nama_menu' => 'Rekap',
                'level_menu' => 'main_menu',
                'url' => 'rekap',
                'icon' => 'fas fa-history',
                'aktif' => 'Y',
                'no_urut' => 11,
                'master_menu' => 0,
            ],

            [
                'nama_menu' => 'Rekap Laporan',
                'level_menu' => 'sub_menu',
                'url' => 'rekaplaporan',
                'icon' => '',
                'aktif' => 'Y',
                'no_urut' => 12,
                'master_menu' => 11,
            ],

            [
                'nama_menu' => 'Manajemen Hak Akses',
                'level_menu' => 'main_menu',
                'url' => 'manajemen',
                'icon' => 'far fa-file-alt',
                'aktif' => 'Y',
                'no_urut' => 13,
                'master_menu' => 0,
            ],

            [
                'nama_menu' => 'Manajemen Role',
                'level_menu' => 'sub_menu',
                'url' => 'role',
                'icon' => '',
                'aktif' => 'Y',
                'no_urut' => 14,
                'master_menu' => 13,
            ],

            [
                'nama_menu' => 'Manajemen Pegawai',
                'level_menu' => 'sub_menu',
                'url' => 'pegawai',
                'icon' => '',
                'aktif' => 'Y',
                'no_urut' => 15,
                'master_menu' => 13,
            ],


            [
                'nama_menu' => 'Manajemen User',
                'level_menu' => 'sub_menu',
                'url' => 'user',
                'icon' => '',
                'aktif' => 'Y',
                'no_urut' => 16,
                'master_menu' => 13,
            ],

            [
                'nama_menu' => 'Manajemen Menu',
                'level_menu' => 'sub_menu',
                'url' => 'menu',
                'icon' => '',
                'aktif' => 'Y',
                'no_urut' => 17,
                'master_menu' => 13,
            ],


            [
                'nama_menu' => 'Manajemen Alur',
                'level_menu' => 'main_menu',
                'url' => 'alur',
                'icon' => 'far fa-file-alt',
                'aktif' => 'Y',
                'no_urut' => 18,
                'master_menu' => 0,
            ],

            [
                'nama_menu' => 'Manajemen State',
                'level_menu' => 'sub_menu',
                'url' => 'schema',
                'icon' => '',
                'aktif' => 'Y',
                'no_urut' => 19,
                'master_menu' => 18,
            ],

            [
                'nama_menu' => 'Manajemen Workflow',
                'level_menu' => 'sub_menu',
                'url' => 'workflow',
                'icon' => '',
                'aktif' => 'Y',
                'no_urut' => 20,
                'master_menu' => 18,
            ],


            [
                'nama_menu' => 'Manajemen Proses',
                'level_menu' => 'sub_menu',
                'url' => 'proses',
                'icon' => '',
                'aktif' => 'Y',
                'no_urut' => 21,
                'master_menu' => 18,
            ],



            [
                'nama_menu' => 'Laporan Koordinator',
                'level_menu' => 'sub_menu',
                'url' => 'lapkoor',
                'icon' => '',
                'aktif' => 'Y',
                'no_urut' => 22,
                'master_menu' => 7,
            ],

            [
                'nama_menu' => 'Laporan OPD Dinkes',
                'level_menu' => 'sub_menu',
                'url' => 'lapopddinkes',
                'icon' => '',
                'aktif' => 'Y',
                'no_urut' => 23,
                'master_menu' => 7,
            ],

            [
                'nama_menu' => 'Laporan OPD DP5A',
                'level_menu' => 'sub_menu',
                'url' => 'lapopddp5a',
                'icon' => '',
                'aktif' => 'Y',
                'no_urut' => 24,
                'master_menu' => 7,
            ],

            [
                'nama_menu' => 'Laporan OPD DKRTH',
                'level_menu' => 'sub_menu',
                'url' => 'lapopddkrth',
                'icon' => '',
                'aktif' => 'Y',
                'no_urut' => 25,
                'master_menu' => 7,
            ],

            [
                'nama_menu' => 'Laporan Honor',
                'level_menu' => 'sub_menu',
                'url' => 'laphonor',
                'icon' => '',
                'aktif' => 'Y',
                'no_urut' => 26,
                'master_menu' => 7,
            ],

            [
                'nama_menu' => 'Honorku',
                'level_menu' => 'sub_menu',
                'url' => 'honorku',
                'icon' => '',
                'aktif' => 'Y',
                'no_urut' => 27,
                'master_menu' => 9,
            ],

            [
                'nama_menu' => 'Laporan Kecamatan',
                'level_menu' => 'main_menu',
                'url' => 'kecamatan',
                'icon' => '',
                'aktif' => 'Y',
                'no_urut' => 28,
                'master_menu' => 0,
            ],

            [
                'nama_menu' => 'Report Warga (Alamat)',
                'level_menu' => 'sub_menu',
                'url' => 'keclaporanwarga',
                'icon' => '',
                'aktif' => 'Y',
                'no_urut' => 29,
                'master_menu' => 28,
            ],

            [
                'nama_menu' => 'Report Kegiatan (Kader)',
                'level_menu' => 'sub_menu',
                'url' => 'keclaporankeg',
                'icon' => '',
                'aktif' => 'Y',
                'no_urut' => 30,
                'master_menu' => 28,
            ],

            [
                'nama_menu' => 'Laporan Kelurahan',
                'level_menu' => 'main_menu',
                'url' => 'kelurahan',
                'icon' => '',
                'aktif' => 'Y',
                'no_urut' => 31,
                'master_menu' => 0,
            ],

            [
                'nama_menu' => 'Report Warga (Alamat)',
                'level_menu' => 'sub_menu',
                'url' => 'kellaporanwarga',
                'icon' => '',
                'aktif' => 'Y',
                'no_urut' => 32,
                'master_menu' => 31,
            ],

            [
                'nama_menu' => 'Report Kegiatan (Kader)',
                'level_menu' => 'sub_menu',
                'url' => 'kellaporankader',
                'icon' => '',
                'aktif' => 'Y',
                'no_urut' => 33,
                'master_menu' => 31,
            ],

        ]);
    }
}