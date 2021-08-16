<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'pegawai_id'  => '1',
                'name' => 'KADER',
                'username' => 'kader',
                'level_user_id' => '1',
                'email' => 'kader@gmail.com',
                'password' => bcrypt('123456'),
                'remember_token' => Str::random(40),
            ],

            [
                'pegawai_id'  => '2',
                'name' => 'KOORDINATOR',
                'username' => 'koordinator',
                'level_user_id' => '2',
                'email' => 'koor@gmail.com',
                'password' => bcrypt('123456'),
                'remember_token' => Str::random(40),
            ],

            [
                'pegawai_id'  => '3',
                'name' => 'KOORDINATOR',
                'username' => 'koordinator',
                'level_user_id' => '2',
                'email' => 'koor2@gmail.com',
                'password' => bcrypt('123456'),
                'remember_token' => Str::random(40),
            ],


            [
                'pegawai_id'  => '4',
                'name' => 'DINKES',
                'username' => 'dinkes',
                'level_user_id' => '3',
                'email' => 'dinkes@gmail.com',
                'password' => bcrypt('123456'),
                'remember_token' => Str::random(40),
            ],

            [
                'pegawai_id'  => '5',
                'name' => 'DP5A',
                'username' => 'dp5a',
                'level_user_id' => '4',
                'email' => 'dp5a@gmail.com',
                'password' => bcrypt('123456'),
                'remember_token' => Str::random(40),
            ],

            [
                'pegawai_id'  => '6',
                'name' => 'DKRTH',
                'username' => 'dkrth',
                'level_user_id' => '5',
                'email' => 'dkrth@gmail.co',
                'password' => bcrypt('123456'),
                'remember_token' => Str::random(40),
            ],

            [
                'pegawai_id'  => '4',
                'name' => 'PEMBERI HONOR',
                'username' => 'pemberi_honor',
                'level_user_id' => '6',
                'email' => 'pemberi_honor@gmail.com',
                'password' => bcrypt('123456'),
                'remember_token' => Str::random(40),
            ],


            [
                'pegawai_id'  => '7',
                'name' => 'ADMIN',
                'username' => 'admin',
                'level_user_id' => '7',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('123456'),
                'remember_token' => Str::random(40),
            ],

            [
                'pegawai_id'  => '9',
                'name' => 'dinkes2',
                'username' => 'dinkes2',
                'level_user_id' => '3',
                'email' => 'dinkes2@gmail.com',
                'password' => bcrypt('123456'),
                'remember_token' => Str::random(40),
            ],

            [
                'pegawai_id'  => '1',
                'name' => 'Kelurahan',
                'username' => 'kelurahan',
                'level_user_id' => '9',
                'email' => 'kelurahan@gmail.com',
                'password' => bcrypt('123456'),
                'remember_token' => Str::random(40),
            ],



        ]);
    }
}