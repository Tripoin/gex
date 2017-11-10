<?php

use Illuminate\Database\Seeder;
use App\MasterBank;
use App\MasterUnit;
use App\MasterPort;
use App\MasterTerm;
use App\MasterVendor;
use App\MasterCustomer;
use App\MasterDocument;
use App\MasterCurrency;
use App\MasterRate;


class MastersSeeder extends Seeder
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
        MasterCustomer::truncate();
        MasterVendor::truncate();
        MasterUnit::truncate();
        MasterCurrency::truncate();
        MasterRate::truncate();
        MasterBank::truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        //Master Customer
        $bank = new MasterBank();
        $bank->name         = 'CITIBANK';
        $bank->cabang       = 'MANGGA DUA';
        $bank->account      = '8006 881 515';
        $bank->atas_nama    = 'PT. GLOBALINDO EXPRESS CARGO';
        $bank->swiftcode    = 'CITIIDJX';
        $bank->save();

        $bank2 = new MasterBank();
        $bank2->name         = 'HSBC';
        $bank2->cabang       = 'SUDIRMAN';
        $bank2->account      = '050 – 054550 – 007';
        $bank2->atas_nama    = 'PT. GLOBALINDO EXPRESS CARGO';
        $bank2->swiftcode    = 'HSBCIDJA';
        $bank2->save();

        $bank3 = new MasterBank();
        $bank3->name         = 'BCA';
        $bank3->cabang       = 'KCP PLUIT KENCANA';
        $bank3->account      = '244 3023 500';
        $bank3->atas_nama    = 'PT. GLOBALINDO EXPRESS CARGO';
        $bank3->swiftcode    = 'CENAIDJA';
        $bank3->save();

        $bank4 = new MasterBank();
        $bank4->name         = 'DANAMON';
        $bank4->cabang       = 'PANGERAN JAYAKARTA';
        $bank4->account      = '0035 9231 0191';
        $bank4->atas_nama    = 'PT. GLOBALINDO EXPRESS CARGO';
        $bank4->swiftcode    = 'BDINIDJA';
        $bank4->save();

        for ($i=0; $i < 10; $i++) 
        {     
            MasterCustomer::create([
                'code'      => 'CS0'.$i,
                'name'      => strtoupper($faker->name),
                'nick_name' => strtoupper($faker->userName),
                'address1'  => strtoupper($faker->address),
                'address2'  => strtoupper($faker->address),
                'city'      => strtoupper($faker->city),
                'province'  => strtoupper($faker->state),
                'country'   => strtoupper($faker->country),
                'phone1'    => $faker->e164PhoneNumber,
                'phone2'    => $faker->e164PhoneNumber,
                'fax'       => $faker->tollFreePhoneNumber,
                'zipcode'   => $faker->postCode,
                'type'      => strtoupper($faker->randomElement($array = array ('agent','shipper','consignee','agent+shipper','agent+consignee','shipper+consignee','agent+shipper+consignee'))),
            ]);

            MasterVendor::create([
                'code'      => 'VD0'.$i,
                'name'      => strtoupper($faker->name),
                'nick_name' => strtoupper($faker->userName),
                'address1'  => strtoupper($faker->address),
                'address2'  => strtoupper($faker->address),
                'city'      => strtoupper($faker->city),
                'province'  => strtoupper($faker->state),
                'country'   => strtoupper($faker->country),
                'phone1'    => $faker->e164PhoneNumber,
                'phone2'    => $faker->e164PhoneNumber,
                'fax'       => $faker->tollFreePhoneNumber,
                'zipcode'   => $faker->postCode,
                'remark'    => strtoupper('whatever'),
                'type'      => $faker->randomElement($array = array ('marketing','payable','pelayaran'))
            ]);

            // MasterDocument::create([
            //     'code'      => 'DC0'.$i,
            //     'name'      => $faker->name,
            //     'type'      => 'job',
            //     'remark'    => 'whatever'
            // ]);

            // MasterPort::create([
            //     'code'      => 'PO0'.$i,
            //     'nick_name' => $faker->userName,
            //     'address'   => $faker->address,
            //     'city'      => $faker->city,
            //     'province'  => $faker->state,
            //     'country'   => $faker->country,
            //     'destination'=>$faker->country,
            //     'loading'   => 'whatever'
            // ]);

            MasterUnit::create([
                'name'      => strtoupper($faker->word),
                'display_name'=> strtoupper($faker->word)
            ]);

            // MasterTerm::create([
            //     'name'  => $faker->word,
            //     'type'  => $faker->word,
            //     'days'  => $faker->numberBetween($min = 1000, $max = 9000)
            // ]);
        }


        //
        // DB::table('master_customers')->delete();
        // $cust = array(
        //     ['code' => 'CS-00001', 'name' => 'A-SUNG TRADING CO', 'nick_name' => 'ASUNG', 'address1' => '1-158,WOLAM-DONG, DALSEO-GU, DAEGU', 'created_at' => new DateTime, 'updated_at' => new DateTime],
        //     ['code' => 'CS-00002', 'name' => 'ABID TRADING', 'nick_name' => 'ABID', 'address1' => 'SHOP NO. 2, FIRST FLOOR NATIONAL BARA MARKET SHAH ALAM MARKET LAHORE', 'created_at' => new DateTime, 'updated_at' => new DateTime],
        // );
        // DB::table('master_customers')->insert($cust);

        // DB::table('master_vendors')->delete();
        // $vendor = array(
        //     ['code' => 'VE-0003', 'name' => 'SARJONO - PT. BONGMAN INTERNATIONAL', 'nick_name' => 'SARJONO - BONGMAN', 'address1' => '1-158,WOLAM-DONG, DALSEO-GU, DAEGU', 'created_at' => new DateTime, 'updated_at' => new DateTime],
        //     ['code' => 'VE-0004', 'name' => 'JIMMY - PT. BONGMAN INTERNATIONAL', 'nick_name' => 'JIMMY - BONGMAN', 'address1' => 'SHOP NO. 2, FIRST FLOOR NATIONAL BARA MARKET SHAH ALAM MARKET LAHORE', 'created_at' => new DateTime, 'updated_at' => new DateTime],
        // );
        // DB::table('master_vendors')->insert($vendor);

        // DB::table('master_documents')->delete();
        // $document = array(
        //     ['code' => 'RC-00008', 'name' => 'TRUCKING CHARGES', 'type' => 'receivable', 'created_at' => new DateTime, 'updated_at' => new DateTime],
        //     ['code' => 'RC-00009', 'name' => 'B/L CHARGES', 'type' => 'receivable', 'created_at' => new DateTime, 'updated_at' => new DateTime],
        //     ['code' => 'PB-00001', 'name' => 'OCEAN FREIGHT', 'type' => 'payable', 'created_at' => new DateTime, 'updated_at' => new DateTime],
        //     ['code' => 'PB-00002', 'name' => 'THC - DESTINATION', 'type' => 'payable', 'created_at' => new DateTime, 'updated_at' => new DateTime],
        //     ['code' => 'PB-00005', 'name' => 'MB', 'type' => 'job', 'created_at' => new DateTime, 'updated_at' => new DateTime],
        //     ['code' => 'PB-00006', 'name' => 'TEST', 'type' => 'job', 'created_at' => new DateTime, 'updated_at' => new DateTime],
        // );
        // DB::table('master_documents')->insert($document);

        // // DB::table('master_ports')->delete();
        // // $port = array(
        // //     ['code' => 'PR-00001', 'nick_name' => 'JKT', 'address' => '1-158,WOLAM-DONG, DALSEO-GU, DAEGU', 'city' => 'JAKARTA','province'=>'', 'created_at' => new DateTime, 'updated_at' => new DateTime],
        // //     ['code' => 'PR-00002', 'nick_name' => 'SBY', 'address' => '1-158,WOLAM-DONG, DALSEO-GU, DAEGU', 'city' => 'SURABAYA', 'created_at' => new DateTime, 'updated_at' => new DateTime],
        // // );
        // // DB::table('master_ports')->insert($port);

        // DB::table('master_units')->delete();
        // $unit = array(
        //     ['name' => 'M³', 'display_name' => 'M³', 'created_at' => new DateTime, 'updated_at' => new DateTime],
        //     ['name' => '20 FT', 'display_name' => '20', 'created_at' => new DateTime, 'updated_at' => new DateTime],
        // );
        // DB::table('master_units')->insert($unit);

         $currencies = [
             'IDR'=>['display_name'=>"RP",'priceToIDR'=>1],
             'USD'=>['display_name'=>"USD",'priceToIDR'=>13000],
        ];

        foreach($currencies as $key => $currency){
            $payment = new \App\MasterCurrency();
            $payment->name = $key;
            $payment->display_name = $currency['display_name'];
            $payment->priceToIDR = $currency['priceToIDR'];
            $payment->save();
        }

        $mr = new \App\MasterRate();
        $mr->date = \Carbon\Carbon::now()->toDateString();
        $mr->rate = array_random([13000,14000,12000,13000,15000,16000,12000,13000,14000]);
        $mr->save();
        for($i=1;$i<20;$i++){
            $mr = new \App\MasterRate();
            $mr->date = \Carbon\Carbon::now()->addDays($i)->toDateString();
            $mr->rate = array_random([13000,14000,12000,13000,15000,16000,12000,13000,14000]);
            $mr->save();
        }
    }
}
