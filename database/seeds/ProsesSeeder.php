<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use function Ramsey\Uuid\v1;

class ProsesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('proses')->insert([
            [
                'flow_id' => 1,
                'schema_sebelum' => 1,
                'schema_sesudah' => 2,
                'urutan' => 1
            ],

            [
                'flow_id' => 1,
                'schema_sebelum' => 1,
                'schema_sesudah' => 2,
                'urutan' => 2
            ]
        ]);
    }
}