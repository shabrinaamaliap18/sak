<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchemaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('schema')->insert([
            [
                'nama_schema' => 'skema 1'
            ],

            [
                'nama_schema' => 'skema 2'
            ],
        ]);
    }
}