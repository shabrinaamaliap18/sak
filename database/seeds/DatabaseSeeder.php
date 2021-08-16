<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call(LevelUsersSeeder::class);
        $this->call(PegawaiSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(MenuSeeder::class);
        $this->call(AksesSeeder::class);
        $this->call(SchemaSeeder::class);
        $this->call(WorkflowSeeder::class);
        $this->call(ProsesSeeder::class);
        $this->call(TimSeeder::class);
        $this->call(MasterOPDSeeder::class);
        $this->call(MasterFormSeeder::class);
    }
}
