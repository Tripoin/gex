<?php

use Illuminate\Database\Seeder;
use App\MasterDocument;

class MasterDocumentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        MasterDocument::truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        MasterDocument::create([ 'name' => 'MASTER B/L', 'display_name' => 'MB/L']);
        MasterDocument::create([ 'name' => 'HOUSE B/L', 'display_name' => 'HB/L']);
        MasterDocument::create([ 'name' => 'PART OF B/L', 'display_name' => 'PART OFF']);
        MasterDocument::create([ 'name' => 'PEB', 'display_name' => 'PEB']);
        MasterDocument::create([ 'name' => 'SPLIT B/L', 'display_name' => 'SPLIT']);
        MasterDocument::create([ 'name' => 'DELIVERY ORDER', 'display_name' => 'DO']);
        MasterDocument::create([ 'name' => 'CONTAINER AND SEAL', 'display_name' => 'CONTAINER']);
    }
}
