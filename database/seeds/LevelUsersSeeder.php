<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('level_users')->insert([
            [
                'nama_level_user' => 'KADER'
            ],

            [
                'nama_level_user' => 'KOORDINATOR'
            ],

            [
                'nama_level_user' => 'OPD Dinkes'
            ],

            [
                'nama_level_user' => 'OPD DP5A'
            ],

            [
                'nama_level_user' => 'OPD DKRTH'
            ],

            [
                'nama_level_user' => 'PEMBERI HONOR'
            ],

            [
                'nama_level_user' => 'ADMIN'
            ],

            [
                'nama_level_user' => 'Kecamatan'
            ],

            [
                'nama_level_user' => 'Kelurahan'
            ],

        ]);
    }
}