<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use function Ramsey\Uuid\v1;

class AksesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('akses')->insert([

            // user 1



            [

                'level_user_id' => 1,
                'main_menu' => 7,
                'sub_menu' => 8,

            ],

            [

                'level_user_id' => 1,
                'main_menu' => 9,
                'sub_menu' => 27,

            ],

            [

                'level_user_id' => 1,
                'main_menu' => 11,
                'sub_menu' => 12,

            ],



            // user 2

            [

                'level_user_id' => 2,
                'main_menu' => 7,
                'sub_menu' => 22,

            ],



            [

                'level_user_id' => 2,
                'main_menu' => 11,
                'sub_menu' => 12,

            ],

            // user 3



            [

                'level_user_id' => 3,
                'main_menu' => 7,
                'sub_menu' => 23,

            ],


            [

                'level_user_id' => 3,
                'main_menu' => 7,
                'sub_menu' => 26,

            ],



            [

                'level_user_id' => 3,
                'main_menu' => 11,
                'sub_menu' => 12,

            ],

            // user 4



            [

                'level_user_id' => 4,
                'main_menu' => 7,
                'sub_menu' => 24,

            ],



            [

                'level_user_id' => 4,
                'main_menu' => 11,
                'sub_menu' => 12,

            ],

            // user 5



            [

                'level_user_id' => 5,
                'main_menu' => 7,
                'sub_menu' => 25,

            ],



            [

                'level_user_id' => 5,
                'main_menu' => 11,
                'sub_menu' => 12,

            ],




            // user 6



            [

                'level_user_id' => 6,
                'main_menu' => 9,
                'sub_menu' => 10,

            ],
            
            [

                'level_user_id' => 6,
                'main_menu' => 7,
                'sub_menu' => 26,

            ],

            [

                'level_user_id' => 6,
                'main_menu' => 11,
                'sub_menu' => 12,

            ],
         

            //user 7

            [

                'level_user_id' => 7,
                'main_menu' => 13,
                'sub_menu' => 14,

            ],


            [

                'level_user_id' => 7,
                'main_menu' => 13,
                'sub_menu' => 15,

            ],


            [

                'level_user_id' => 7,
                'main_menu' => 13,
                'sub_menu' => 16,

            ],


            [

                'level_user_id' => 7,
                'main_menu' => 13,
                'sub_menu' => 17,

            ],


            //kelurahan

            [

                'level_user_id' => 9,
                'main_menu' => 31,
                'sub_menu' => 32,

            ],

            [

                'level_user_id' => 9,
                'main_menu' => 31,
                'sub_menu' => 33,

            ],
            


        ]);
    }
}