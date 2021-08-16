<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TimSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tim')->insert([
            [
                'id_pegawai' => '1',
                'master_pegawai' => '2',

            ],

            [
                'id_pegawai' => '1',
                'master_pegawai' => '3',

            ],

            [
                'id_pegawai' => '1',
                'master_pegawai' => '4',

            ],
            [
                'id_pegawai' => '1',
                'master_pegawai' => '5',

            ],


            [
                'id_pegawai' => '1',
                'master_pegawai' => '6',

            ],

            [
                'id_pegawai' => '1',
                'master_pegawai' => '9',

            ],


        ]);
    }
}