<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pegawai')->insert([
            [
                'nama_pegawai' => 'Sima',
                'NIP' => 12345,
                'NIK' => 67890,
                'jabatan' => 'kader',
                'jenis_kelamin' => 'perempuan',
                'tanggal_lahir' => '1999-05-12',
                'foto_pegawai' => 'Shabrina.JPG',
            ],

            [
                'nama_pegawai' => 'Shabrina',
                'NIP' => 12346,
                'NIK' => 12345,
                'jabatan' => 'koordinator',
                'jenis_kelamin' => 'perempuan',
                'tanggal_lahir' => '1999-05-11',
                'foto_pegawai' => 'Shabrina.JPG',
            ],

            [
                'nama_pegawai' => 'Edi',
                'NIP' => 12346,
                'NIK' => 12345,
                'jabatan' => 'koordinator',
                'jenis_kelamin' => 'perempuan',
                'tanggal_lahir' => '1999-05-11',
                'foto_pegawai' => 'Shabrina.JPG',
            ],

            [
                'nama_pegawai' => 'Amanda',
                'NIP' => 34567,
                'NIK' => 12345,
                'jabatan' => 'opd dinkes',
                'jenis_kelamin' => 'perempuan',
                'tanggal_lahir' => '1999-05-10',
                'foto_pegawai' => 'Shabrina.JPG',
            ],


            [
                'nama_pegawai' => 'Safitri',
                'NIP' => 34567,
                'NIK' => 12345,
                'jabatan' => 'opd dp5a',
                'jenis_kelamin' => 'perempuan',
                'tanggal_lahir' => '1999-05-10',
                'foto_pegawai' => 'Shabrina.JPG',
            ],


            [
                'nama_pegawai' => 'Chandra',
                'NIP' => 34567,
                'NIK' => 12345,
                'jabatan' => 'opd dkrth',
                'jenis_kelamin' => 'perempuan',
                'tanggal_lahir' => '1999-05-10',
                'foto_pegawai' => 'Shabrina.JPG',
            ],

            [
                'nama_pegawai' => 'Eggi',
                'NIP' => 34567,
                'NIK' => 12345,
                'jabatan' => 'pemberi honor',
                'jenis_kelamin' => 'perempuan',
                'tanggal_lahir' => '1999-05-10',
                'foto_pegawai' => 'Shabrina.JPG',
            ],

            [
                'nama_pegawai' => 'Ejak',
                'NIP' => 34567,
                'NIK' => 12345,
                'jabatan' => 'admin',
                'jenis_kelamin' => 'perempuan',
                'tanggal_lahir' => '1999-05-10',
                'foto_pegawai' => 'Shabrina.JPG',
            ],

            [
                'nama_pegawai' => 'dinkes2',
                'NIP' => 345678,
                'NIK' => 123459,
                'jabatan' => 'opd dinkes',
                'jenis_kelamin' => 'perempuan',
                'tanggal_lahir' => '1999-05-10',
                'foto_pegawai' => 'Shabrina.JPG',
            ],

        ]);
    }
}