<?php

use Illuminate\Database\Seeder;
use App\JobSheet;
use Carbon\Carbon;

class ArzJobsheetsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //disable foreign key check for this connection before running seeders
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \App\RequestModel::truncate();
        \App\RC::truncate();
        \App\Payable::truncate();
        \App\Reference::truncate();
        JobSheet::truncate();
        // supposed to only apply to a single connection and reset it's self
        // but I like to explicitly undo what I've done for clarity
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        //$userIds = [4=>'operation', 6=>'pricing', 12=>'marketing'];
        //6=>'pricing', 12=>'marketing',10=>payable

        $operation_user_id = 4;
        $pricing_user_id = 6;
        $marketing_user_id = 12;
        $payable_user_id = 10;

        for ($arz = 1; $arz < 50; $arz++) {

            $convert_date = Carbon::now()->addDays(random_int(8, 20));
            $convert_etd = Carbon::now()->addDays(random_int(20, 24));
            $convert_eta = Carbon::now()->addDays(random_int(25, 35));

            $generate_code = $convert_date->format('m') . '/' . $convert_date->format('Y') . '/JKT';

            $jobsheet = new JobSheet();
            $jobsheet->operation_id = $operation_user_id;
            $jobsheet->customer_id = random_int(1, 5);
            $jobsheet->poo_id = random_int(1, 5);
            $jobsheet->pod_id = random_int(1, 5);
            $jobsheet->freight_type = random_int(1, 2);
            $jobsheet->vessel = "vessel";
            $jobsheet->partymeas = "partymeas";
            $jobsheet->party_unit_id = random_int(1, 5);
            $jobsheet->marketing_id = random_int(12, 23);
            $jobsheet->description = "description";
            $jobsheet->remarks = "remarks";
            $jobsheet->instruction = "instruction";
            $jobsheet->date = $convert_date->toDateString();
            $jobsheet->etd = $convert_etd->toDateString();
            $jobsheet->eta = $convert_eta->toDateString();
            $jobsheet->status = $arz % 2 == 0 ? 'uncompleted' : 'completed';
            $jobsheet->save();

            if ($jobsheet->id < 10) {
                $jobsheet->code = '000' . $jobsheet->id . '/' . $generate_code;
            } elseif ($jobsheet->id >= 10 && $jobsheet->id < 100) {
                $jobsheet->code = '00' . $jobsheet->id . '/' . $generate_code;
            } elseif ($jobsheet->id >= 100 && $jobsheet->id < 1000) {
                $jobsheet->code = '0' . $jobsheet->id . '/' . $generate_code;
            } else {
                $jobsheet->code = $jobsheet->id . '/' . $generate_code;
            }
            $jobsheet->save();

            if ($jobsheet) {

                // =======================Simpan Reference baru=======================
                $ref_no = [uniqid(), uniqid(), uniqid()];
                $doc_id = [random_int(1, 5), random_int(1, 5), random_int(1, 5)];

                for ($i = 0; $i < count($ref_no); $i++) {
                    if (!empty($ref_no[$i]) || !empty($doc_id[$i])) {
                        \App\Reference::create([
                            'jobsheet_id' => $jobsheet->id,
                            'document_id' => $doc_id[$i],
                            'ref_no' => $ref_no[$i]
                        ]);
                    }
                }

                // =======================Simpan Payable baru=======================
                $charge = [1, 2, 3, 4, 5];
                $vendor = [1, 2, 3, 4, 5];
                $unit = [1, 2, 3, 4, 5];
                $quanty = [1, 2, 3, 4, 5];

                for ($jj = 0; $jj < count($charge); $jj++) {
                    if (!empty($charge[$jj])) {
                        $price = $charge[$jj]*1000;
                        $qty =  $quanty[$jj];
                        $opayable = new \App\Payable();
                        $opayable->user_id = $operation_user_id;
                        $opayable->jobsheet_id = $jobsheet->id;
                        $opayable->document_id = $charge[$jj];
                        $opayable->vendor_id = $vendor[$jj];
                        $opayable->unit_id = $unit[$jj];
                        $opayable->price = $charge[$jj]*1000;
                        $opayable->quantity = $qty;
                        $opayable->currency = rand(1,2);
                        $opayable->total = $price*$qty;
                        $opayable->save();
                    }
                }
                for ($jj = 0; $jj < count($charge); $jj++) {
                    if (!empty($charge[$jj])) {
                        $price = $charge[$jj]*1000;
                        $qty =  $quanty[$jj];
                        $opayable = new \App\Payable();
                        $opayable->user_id = $pricing_user_id;
                        $opayable->jobsheet_id = $jobsheet->id;
                        $opayable->document_id = $charge[$jj];
                        $opayable->vendor_id = $vendor[$jj];
                        $opayable->unit_id = $unit[$jj];
                        $opayable->quantity = $qty;
                        $opayable->currency = rand(1,2);
                        $opayable->total = $price*$qty;
                        $opayable->save();
                    }
                }
                for ($j = 0; $j < 3; $j++) {
                    if (!empty($charge[$j])) {
                        $price = $charge[$j]*1000;
                        $qty =  $quanty[$j];
                        $payable = new \App\Payable();
                        $payable->user_id = $payable_user_id;
                        $payable->jobsheet_id = $jobsheet->id;
                        $payable->document_id = $charge[$j];
                        $payable->vendor_id = $vendor[$j];
                        $payable->unit_id = $unit[$j];
                        $payable->price = $price;
                        $payable->quantity = $qty;
                        $payable->currency = rand(1,2);
                        $payable->total = $price*$qty;
                        $payable->save();
                    }
                }
                for ($gj = 4; $gj < 10; $gj++) {
                    if (!empty($charge[$j])) {
                        $rc = new \App\RC();
                        $price =  rand(100,2000);
                        $qty =  rand(1,5);
                        $data = [
                            'jobsheet_id' =>  $jobsheet->id,
                            'rc_document_id' => 1,
                            'rc_vendor_id' => rand(1,3),
                            'rc_unit_id' => rand(1,3),
                            'rc_price' => $price,
                            'rc_currency' => rand(1,2),
                            'rc_quantity' => $qty,
                            'rc_total'=> $price*$qty,
                            'rc_type'=> $gj % 2 == 0 ? 'pricing' : 'marketing',
                            'rate' => null,
                            'payment_id' => null
                        ];
                        //$payable->user_id = $marketing_user_id;
                        $rc->fill($data);
                        $rc->save();
                    }
                }
            }
        }
    }
}