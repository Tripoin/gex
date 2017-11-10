<?php

use App\MasterRole;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        MasterRole::truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        MasterRole::create(['name'=>'admin','description'=>'apalah apalah']);
        MasterRole::create(['name'=>'operation','description'=>'apalah apalah']);
        MasterRole::create(['name'=>'marketing','description'=>'apalah apalah']);
        MasterRole::create(['name'=>'pricing','description'=>'apalah apalah']);
        MasterRole::create(['name'=>'invoice','description'=>'apalah apalah']);
        MasterRole::create(['name'=>'payable','description'=>'apalah apalah']);
        MasterRole::create(['name'=>'manager','description'=>'apalah apalah']);
        MasterRole::create(['name'=>'pajak','description'=>'apalah apalah']);
        // MasterRole::create(['name'=>'admin','description'=>'apalah apalah']);
    }
}
