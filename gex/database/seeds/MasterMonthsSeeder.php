<?php

use Illuminate\Database\Seeder;
use App\MasterMonths;

class MasterMonthsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
      MasterMonths::truncate();
      \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
      MasterMonths::create(['code'  => '01', 'name'  => 'Januari', 'days'  => 31]);
      MasterMonths::create(['code'  => '02', 'name'  => 'Februari', 'days'  => 28]);
      MasterMonths::create(['code'  => '02L', 'name'  => 'Februari Leap', 'days'  => 29]);
      MasterMonths::create(['code'  => '03', 'name'  => 'Maret', 'days'  => 31]);
      MasterMonths::create(['code'  => '04', 'name'  => 'April', 'days'  => 30]);
      MasterMonths::create(['code'  => '05', 'name'  => 'Mei', 'days'  => 31]);
      MasterMonths::create(['code'  => '06', 'name'  => 'Juni', 'days'  => 30]);
      MasterMonths::create(['code'  => '07', 'name'  => 'Juli', 'days'  => 31]);
      MasterMonths::create(['code'  => '08', 'name'  => 'Agustus', 'days'  => 31]);
      MasterMonths::create(['code'  => '09', 'name'  => 'September', 'days'  => 30]);
      MasterMonths::create(['code'  => '10', 'name'  => 'Oktober', 'days'  => 31]);
      MasterMonths::create(['code'  => '11', 'name'  => 'Nopember', 'days'  => 30]);
      MasterMonths::create(['code'  => '12', 'name'  => 'Desember', 'days'  => 31]);
    }
}
