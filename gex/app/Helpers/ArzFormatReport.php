<?php

namespace App\Helpers;

use App\JobSheet;
use App\Receivable;
use App\ReceivablePayment;
use App\Reimbursement;
use App\MasterPort;
use App\MasterDocument;
use App\MasterCustomer;
use App\InvoiceDocument;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Facades\Excel;
use Psy\Exception\ErrorException;
use Symfony\Component\HttpKernel\Tests\Exception\NotFoundHttpExceptionTest;
use App\User;
use App\MasterUnit;
use App\MasterVendor;
use App\MasterCurrency;
use App\Payable;
use Illuminate\Support\Facades\Auth;

class ArzFormatReport
{   

    public function operationJobsheet($jobsheets){
        $jobsheetPayables = [];
        if ($jobsheets) {

            $masterUsers = User::pluck('name','id')->toArray();
            $masterDocuments = MasterDocument::pluck('display_name','id')->toArray();
            $masterPorts = MasterPort::pluck('nick_name','id')->toArray();
            $masterUnits = MasterUnit::pluck('name','id')->toArray();
            $customerIds = array_pluck($jobsheets->toArray(), 'customer_id','customer_id');
            $masterCustomers = MasterCustomer::whereIn('id',$customerIds)->pluck('nick_name','id')->toArray();
            $masterVendors = MasterVendor::pluck('nick_name','id')->toArray();
            $masterCurrencies = MasterCurrency::pluck('name','id')->toArray();
            $masterFreightType = [1=>'PREPAID',2=>'COLLECT'];
            foreach ($jobsheets as $jobsheet) {

                $dataJobsheet = '';//$jobsheet->getAttributes();
                $operatorName = isset($masterUsers[$jobsheet->operation_id]) ? $masterUsers[$jobsheet->operation_id] : '';
                $marketingName = isset($masterUsers[$jobsheet->marketing_id]) ? $masterUsers[$jobsheet->marketing_id] : '';
                $customerName = isset($masterCustomers[$jobsheet->customer_id]) ? $masterCustomers[$jobsheet->customer_id] : '';
                $pooName = isset($masterPorts[$jobsheet->poo_id]) ? $masterPorts[$jobsheet->poo_id] : '';
                $podName = isset($masterPorts[$jobsheet->pod_id]) ? $masterPorts[$jobsheet->pod_id] : '';

                $dataJobsheet['CODE'] = $jobsheet->code;
                $dataJobsheet['REF NO'] = $jobsheet->ref_no;
                $dataJobsheet['DATE'] = $jobsheet->date;
                $dataJobsheet['ETD'] = $jobsheet->etd;
                $dataJobsheet['ETA'] = $jobsheet->eta;
                $dataJobsheet['VESSEL'] = $jobsheet->vessel;
                $dataJobsheet['PARTYMEAS'] = $jobsheet->partymeas;
                $dataJobsheet['PARTY UNIT'] = isset($masterUnits[$jobsheet->party_unit_id]) ? $masterUnits[$jobsheet->party_unit_id] : '';;
                //$dataJobsheet['REMARKS'] = $jobsheet->remarks;
                //$dataJobsheet['INSTRUCTION'] = $jobsheet->instruction;
                $dataJobsheet['FREIGHT'] = isset($masterFreightType[$jobsheet->freight_type]) ? $masterFreightType[$jobsheet->freight_type] : $jobsheet->freight_type;

                $dataJobsheet['OPERATOR'] = $operatorName;
                $dataJobsheet['MARKETING'] = $marketingName;
                $dataJobsheet['CUSTOMER'] = $customerName;
                $dataJobsheet['POO'] = $pooName;
                $dataJobsheet['POD'] = $podName;

                $payables = Payable::where('jobsheet_id', $jobsheet['id'])
                    ->where('user_id',Auth::user()->getKey())->get()->toArray();
                //$dataJobsheet['payables'] = $payables;

                if ($payables) {
                    foreach ($payables as $payable) {
                        $dataJobsheet["DOC"] = isset($masterDocuments[$payable['document_id']]) ? $masterDocuments[$payable['document_id']] : '';
                        $dataJobsheet["VENDOR"] = isset($masterVendors[$payable['vendor_id']]) ? $masterVendors[$payable['vendor_id']] : '';
                        $dataJobsheet["UNIT"] = isset($masterUnits[$payable['unit_id']]) ? $masterUnits[$payable['unit_id']] : '';;
                        $dataJobsheet["PRICE"] = $payable['price'];
                        $dataJobsheet["CURRENCY"] = isset($masterCurrencies[$payable['currency']]) ? $masterCurrencies[$payable['currency']] : '';
                        $dataJobsheet["QTY"] = $payable['quantity'];
                        $dataJobsheet["RATE"] = $payable['rate'];
                        $dataJobsheet["TOTAL"] = $payable['total'];
                        $jobsheetPayables[$jobsheet->id.$payable['id']] = $dataJobsheet;
                    }
                }
            }
        }

        return $jobsheetPayables;
    }

    public function operationRequest(){

    }

    public function marketingRequest(){

    }
    
}