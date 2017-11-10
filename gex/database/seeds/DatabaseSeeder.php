<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(MastersSeeder::class);
        $this->call(MasterDocumentsSeeder::class);
        $this->call(MasterPortsSeeder::class);
        $this->call(MasterTermsSeeder::class);
        $this->call(ArzJobsheetsSeeder::class);
    }
}
