<?php

use Illuminate\Database\Seeder;
use App\MasterTerm;

class MasterTermsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        MasterTerm::truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        MasterTerm::create(['name'  => 'CREDIT','type'  => '2','days'  => 0]);
        MasterTerm::create(['name'  => 'CASH','type'  => '1','days'  => 0]);
        MasterTerm::create(['name'  => 'COD','type'  => '2','days'  => 0]);
        MasterTerm::create(['name'  => '1 DAY AFTER RECEIVING B/L','type'  => '2','days'  => 0]);
        MasterTerm::create(['name'  => '2 DAYS','type'  => '2','days'  => 2]);
        MasterTerm::create(['name'  => '3 DAYS','type'  => '2','days'  => 3]);
        MasterTerm::create(['name'  => '45 DAYS','type'  => '2','days'  => 45]);
        MasterTerm::create(['name'  => '1 WEEK','type'  => '2','days'  => 7]);
        MasterTerm::create(['name'  => '1 WEEK FROM ETA','type'  => '2','days'  => 7]);
        MasterTerm::create(['name'  => '1 WEEK AFTER RECEIVING B/L','type'  => '2','days'  => 0]);
        MasterTerm::create(['name'  => '2 WEEKS','type'  => '2','days'  => 14]);
        MasterTerm::create(['name'  => '3 WEEKS','type'  => '2','days'  => 21]);
        MasterTerm::create(['name'  => '1 MONTH','type'  => '2','days'  => 1]);
        MasterTerm::create(['name'  => '2 MONTHS','type'  => '2','days'  => 0]);
        MasterTerm::create(['name'  => '2 MONTHS FROM ETD','type'  => '2','days'  => 0]);
    }
}
