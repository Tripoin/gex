<?php

use Illuminate\Database\Seeder;
use App\MasterPort;

class MasterPortsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
		\DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		MasterPort::truncate();
		\DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        MasterPort::create([
        	'code'			=> 'PO01',
        	'nick_name'		=> 'JKT',
        	'city'			=> 'JAKARTA',
        	'country'		=> 'INDONESIA',
        	'type'	        => $faker->randomElement($array = array ('origin','destination')),
        	'loading'		=> '2'
        ]);

        MasterPort::create([
        	'code'			=> 'PO02',
        	'nick_name'		=> 'SBY',
        	'city'			=> 'SURABAYA',
        	'country'		=> 'INDONESIA',
        	'type'	        => $faker->randomElement($array = array ('origin','destination')),
        	'loading'		=> '2'
        ]);

        MasterPort::create([
        	'code'			=> 'PO03',
        	'nick_name'		=> 'BLW',
        	'city'			=> 'BELAWAN',
        	'country'		=> 'INDONESIA',
        	'type'	        => $faker->randomElement($array = array ('origin','destination')),
        	'loading'		=> '2'
        ]);

        MasterPort::create([
        	'code'			=> 'PO04',
        	'nick_name'		=> 'SMR',
        	'city'			=> 'SEMARANG',
        	'country'		=> 'INDONESIA',
        	'type'	        => $faker->randomElement($array = array ('origin','destination')),
        	'loading'		=> '2'
        ]);

        MasterPort::create([
        	'code'			=> 'PO05',
        	'nick_name'		=> 'PJG',
        	'city'			=> 'PANJANG',
        	'country'		=> 'INDONESIA',
        	'type'	        => $faker->randomElement($array = array ('origin','destination')),
        	'loading'		=> '2'
        ]);

        MasterPort::create([
        	'code'			=> 'PO06',
        	'nick_name'		=> 'PEN',
        	'city'			=> 'PENANG',
        	'country'		=> 'INDONESIA',
        	'type'	        => $faker->randomElement($array = array ('origin','destination')),
        	'loading'		=> '2'
        ]);

        MasterPort::create([
        	'code'			=> 'PO07',
        	'nick_name'		=> 'CGK',
        	'city'			=> 'SOEKARNO HATTA',
        	'country'		=> 'INDONESIA',
        	'type'	        => $faker->randomElement($array = array ('origin','destination')),
        	'loading'		=> '2'
        ]);

        MasterPort::create([
        	'code'			=> 'PO08',
        	'nick_name'		=> 'HCH',
        	'city'			=> 'HOCHIMINCH',
        	'country'		=> 'VIETNAM',
        	'type'	        => $faker->randomElement($array = array ('origin','destination')),
        	'loading'		=> '2'
        ]);

        MasterPort::create([
        	'code'			=> 'PO09',
        	'nick_name'		=> 'PLM',
        	'city'			=> 'PALEMBANG',
        	'country'		=> 'INDONESIA',
        	'type'	        => $faker->randomElement($array = array ('origin','destination')),
        	'loading'		=> '2'
        ]);

        MasterPort::create([
        	'code'			=> 'PO364',
        	'nick_name'		=> 'PDG',
        	'city'			=> 'PADANG',
        	'country'		=> 'INDONESIA',
        	'type'	        => $faker->randomElement($array = array ('origin','destination')),
        	'loading'		=> '2'
        ]);

        MasterPort::create([
        	'code'			=> 'PO330',
        	'nick_name'		=> 'KWT',
        	'city'			=> 'KUWAIT',
        	'country'		=> 'SAUDI ARABIA',
        	'type'	        => $faker->randomElement($array = array ('origin','destination')),
        	'loading'		=> '2'
        ]);

        MasterPort::create([
        	'code'			=> 'PO365',
        	'nick_name'		=> 'HONGKONG',
        	'city'			=> 'HONGKONG',
        	'country'		=> 'HONGKONG',
        	'type'	        => $faker->randomElement($array = array ('origin','destination')),
        	'loading'		=> '2'
        ]);
    }
}
