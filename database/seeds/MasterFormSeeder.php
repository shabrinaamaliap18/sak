<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterFormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('master_form')->insert([
            [
                'nama_kegiatan' => 'Posyandu Remaja',
                'opd_id' => 1,

            ],

            [
                'nama_kegiatan' => 'Fasilitator Lingkungan',
                'opd_id' => 2,

            ],

            [
                'nama_kegiatan' => 'Satgas PPKM',
                'opd_id' => 3,

            ],

            


        ]);
    }
}