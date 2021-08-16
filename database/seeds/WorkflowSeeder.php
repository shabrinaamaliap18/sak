<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkflowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('workflow')->insert([
            [
                'nama_workflow' => 'workflow 1'
            ],

            [
                'nama_workflow' => 'workflow 2'
            ],
        ]);
    }
}