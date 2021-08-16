<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterOPDSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('master_opd')->insert([
            [
                'nama_opd' => 'Dinas Kesehatan'
            ],

            [
                'nama_opd' => 'DKRTH'
            ],

            [
                'nama_opd' => 'DP5A'
            ],

            

        ]);
    }
}