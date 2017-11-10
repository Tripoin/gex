<?php

namespace App\Http\Controllers\Arz;

use App\Helpers\ArzReport;
use App\Http\Controllers\_PayableController;
use App\MasterBank;
use App\MasterCurrency;
use App\MasterRate;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Reference;
use App\JobSheet;
use App\Revision;
use App\Payable;
use App\RC;
use App\RequestModel;

class _ArzPayableController extends _PayableController
{
    //==============================================================================================
    //              REQUEST
    //==============================================================================================

    public function request_list(Request $request)
    {
        $query = RequestModel::where('status', 'requested');

        if(  $request->get('request_type')  ){
            $query->where('type',  $request->get('request_type'));
        }

        $dateForm = '';
        $dateTo = '';
        if( $request->get('date_from') && $request->get('date_to')){
            $dateForm = $request->get('date_from') ;
            $dateTo = $request->get('date_to');
            $query->whereBetween('tanggal', [$dateForm,$dateTo]);
        }

        $requests = $query->get();
        $isRequested = true;

        $today = Carbon::now()->toDateString();
        $masterRateToday = MasterRate::whereDate('date',$today)->first();
        $rateToday = $masterRateToday && $masterRateToday->rate ? $masterRateToday->rate : 0;
        $listsPaymentType = RequestModel::listsPaymentType();
        $masterBank = MasterBank::get()->toArray();
        $listsCurrency = MasterCurrency::pluck('name','id')->toArray();
        $listsMasterBank = [''=>'Select Bank'];
        foreach($masterBank as $bank){
            $listsMasterBank[$bank['id']] = $bank['name'] . ' - ' .$bank['cabang'];
        }

        return view('request.payable.index', compact('requests','isRequested','dateForm','dateTo','listsPaymentType','listsMasterBank','rateToday','listsCurrency'));
    }

    public function request_create(Request $request)
    {
        //$jobSheetsRequested = RequestModel::where('status', 'requested')->where('type','operation')->pluck('jobsheet_id','jobsheet_id');
        $role = Auth::user()->role;
        if (in_array($role, ['admin','admin2'])) {
            $query = JobSheet::query();
        } else {
            $query = JobSheet::where('status', 'completed');
        }

        $dateForm = '';
        $dateTo = '';
        if( $request->get('date_from') && $request->get('date_to')){
            $dateForm = $request->get('date_from') ;
            $dateTo = $request->get('date_to');
            $query->whereBetween('date', [$dateForm,$dateTo]);
        }
        $jobsheets = $query->get();

        return view('request.payable.create', compact('jobsheets','dateForm','dateTo'));
    }

    public function request_detail_jobsheet(Request $request, $id)
    {
        $jobsheet = JobSheet::find($id);
        $references = Reference::where('jobsheet_id', $jobsheet->id)->get();
        $payables = Payable::where('jobsheet_id', $jobsheet->id)->get();
        $revisions   = Revision::where('jobsheet_id', $id)->get();
        $requestedModel = RequestModel::where('jobsheet_id', $id)->get()->toArray();
        $requestedPayableIds = $requestedModel ? array_pluck($requestedModel, 'payable_id', 'payable_id') : [];
        $requestedPayableDates = $requestedModel ? array_pluck($requestedModel, 'tanggal', 'payable_id') : [];
        $defaultRequestDate = Carbon::now()->toDateString();
        $controllerRole = Auth::user()->role;
        $pay_total_price = $payables->sum('price');
        $pay_total_price_idr = $payables->where('currency',1);
        $pay_total_price_usd = $payables->where('currency',2);
        $rcs = RC::where('jobsheet_id', $id)->get();

        return view('request.payable.detail_jobsheet', compact('jobsheet','references','payables','revisions',
            'requestedPayableDates','requestedPayableIds','defaultRequestDate', 'controllerRole', 'pay_total_price',
            'pay_total_price_idr','pay_total_price_idr','pay_total_price_usd','rcs'));
    }

    public function request_store(Request $request)
    {
        try {
            $this->validate($request,[
                'payable_ids'  => 'required',
                'jobsheet_id'   => 'required'
            ]);
            $userId = \Auth::user()->getKey();
            $role = \Auth::user()->role;
            $requestDate = Carbon::now()->toDateString();
            if( ($payableIds = $request->get('payable_ids')) && ($jobsheetId = $request->get('jobsheet_id')) ){
                $requestDates = $request->get('request_dates');
                $i = 0;
                foreach($payableIds as $payableId){
                    $attributes = [
                        'jobsheet_id' => $jobsheetId,
                        'payable_id' => $payableId,
                        'user_id' => $userId,
                        'tanggal' => isset($requestDates[$payableId]) ? Carbon::createFromTimestamp(strtotime($requestDates[$payableId]))->toDateString() : $requestDate,
                        'status' => 'requested',
                        'type' => 'payable'
                    ];
                    $requestModel = new RequestModel();
                    if( RequestModel::where('jobsheet_id',$jobsheetId)->where('payable_id',$payableId)->count() >= 1 ) {
                        $request->session()->put('message-error', 'Some data already exists!');
                    } else {
                        if ($requestModel->fill($attributes) && $requestModel->save()) {
                            $request->session()->put('message-success', 'Success Created Request');
                        }
                    }
                    $i++;
                }
            }
        }
        catch (\Exception $e) {
            $request->session()->put('message-error','Something Wrong');
            return redirect()->route('payable.request.detail-jobsheet', ['id'=>$jobsheetId]);
        }

        return redirect()->route('payable.request.detail-jobsheet', ['id'=>$jobsheetId]);
    }

    public function request_submit_approvable(Request $request)
    {
        try {
            $this->validate($request,[
                'request_ids'  => 'required',
            ]);

            if( ($requestIds = $request->get('request_ids')) ){

                $requestRates = $request->get('request_rates');
                $requestPaymentIds = $request->get('request_payment_types');
                $requestBankIds = $request->get('request_bank_ids');
                $requestPayableIds = $request->get('request_payable_ids');
                $requestRCIds = $request->get('request_rc_ids');
                $requestPaymentCurr = $request->get('request_payment_currency');
                $requestCurr = $request->get('request_currency');
                $dataRequest = [];
                $i = 0;
                foreach($requestIds as $requestId){
                    $dataRequest[$requestId] = [
                        'payment_type' => isset($requestPaymentIds[$requestId]) ? $requestPaymentIds[$requestId] : '',
                        'bank_id' => isset($requestBankIds[$requestId]) ? $requestBankIds[$requestId] : '',
                        'rate' => isset($requestRates[$requestId]) ? $requestRates[$requestId] : 1,
                        'payable_id' => isset($requestPayableIds[$requestId]) ? $requestPayableIds[$requestId] : '',
                        'rc_id' => isset($requestRCIds[$requestId]) ? $requestRCIds[$requestId] : '',
                        'payment_currency' => isset($requestPaymentCurr[$requestId]) ? $requestPaymentCurr[$requestId] : '',
                        'currency' => isset($requestCurr[$requestId]) ? $requestCurr[$requestId] : '',
                    ];
                    $i++;
                }
                //$requestIds = implode(",",$requestIds);
                //dd($dataRequest);
                //\DB::update("UPDATE requests SET status=:s WHERE id IN (".$requestIds.") ", ['s' => 'approvable']);
                $approvable = 'approvable';
                foreach( $dataRequest as $requestId => $dRequest ){
                    //dd($requestId,$dRequest);

                    if( !empty($dRequest['rate']) ) {
                        if (!empty($dRequest['payable_id'])) {
                            \DB::update("UPDATE payables SET rate=?, payment_currency=? WHERE id=?", [$dRequest['rate'], $dRequest['payment_currency'], $dRequest['payable_id']]);

                            // IDR to IDR nothing to change
                            if( $dRequest['currency'] == 1 && $dRequest['payment_currency'] == 1  ) {
                                //\DB::update("UPDATE payables SET total=total*rate WHERE id = ?", [$dRequest['payable_id']]);
                            }

                            // USD to IDR
                            if( $dRequest['currency'] == 2 && $dRequest['payment_currency'] == 1 ) {
                                \DB::update("UPDATE payables SET total=total*rate WHERE id = ?", [$dRequest['payable_id']]);
                            }

                            // IDR to USD
                            if( $dRequest['currency'] == 1 && $dRequest['payment_currency'] == 2 ) {
                                \DB::update("UPDATE payables SET total=total/rate WHERE id = ?", [$dRequest['payable_id']]);
                            }

                            // USD to USD nothing to change
                            if( $dRequest['currency'] == 2 && $dRequest['payment_currency'] == 2 ) {
                                //\DB::update("UPDATE payables SET total=total*rate WHERE id = ?", [$dRequest['payable_id']]);
                            }
                        }
                        if (!empty($dRequest['rc_id'])) {
                            \DB::update("UPDATE rc SET rate=?, rc_payment_currency=? WHERE id=?", [$dRequest['rate'], $dRequest['payment_currency'], $dRequest['rc_id']]);

                            // IDR to IDR nothing to change
                            if( $dRequest['currency'] == 1 && $dRequest['payment_currency'] == 1  ) {
                                //\DB::update("UPDATE rc SET rc_total=rc_total*rate WHERE id = ?", [$dRequest['rc_id']]);
                            }

                            // USD to IDR
                            if( $dRequest['currency'] == 2 && $dRequest['payment_currency'] == 1 ) {
                                \DB::update("UPDATE rc SET rc_total=rc_total*rate WHERE id = ?", [$dRequest['rc_id']]);
                            }

                            // IDR to USD
                            if( $dRequest['currency'] == 1 && $dRequest['payment_currency'] == 2 ) {
                                \DB::update("UPDATE rc SET rc_total=rc_total/rate WHERE id = ?", [$dRequest['rc_id']]);
                            }

                            // USD to USD nothing to change
                            if( $dRequest['currency'] == 2 && $dRequest['payment_currency'] == 2 ) {
                                //\DB::update("UPDATE rc SET rc_total=rc_total*rate WHERE id = ?", [$dRequest['rc_id']]);
                            }
                        }

                        if( !empty($dRequest['bank_id']) &&  $dRequest['payment_type'] == RequestModel::PAY_TYPE_BANK) {
                            \DB::update("UPDATE requests SET status=?, payment_type=?, bank_id=? WHERE id=?", [$approvable, $dRequest['payment_type'], $dRequest['bank_id'], $requestId]);
                        } else {
                            \DB::update("UPDATE requests SET status=?, payment_type=?  WHERE id=?", [$approvable, $dRequest['payment_type'], $requestId]);
                        }

                    } else {
                        if( !empty($dRequest['bank_id']) &&  $dRequest['payment_type'] == RequestModel::PAY_TYPE_BANK) {
                            \DB::update("UPDATE requests SET status=?, payment_type=?, bank_id=? WHERE id=?", [$approvable, $dRequest['payment_type'], $dRequest['bank_id'], $requestId]);
                        } else {
                            \DB::update("UPDATE requests SET status=?, payment_type=?  WHERE id=?", [$approvable, $dRequest['payment_type'], $requestId]);
                        }
                    }
                }
            }

            $request->session()->put('message-success', 'Success Submit Request to Approvable');
        } catch (\Exception $e) {
            $request->session()->put('message-error','Something Wrong');
            return redirect()->route('payable.request.list', ['date_from'=>$request->get('date_from'), 'date_to'=>$request->get('date_to')]);
        }

        return redirect()->route('payable.request.list', ['date_from'=>$request->get('date_from'), 'date_to'=>$request->get('date_to')]);
    }

    public function request_index(Request $request)
    {

    }

    public function request_approvable(Request $request, Datatables $datatables)
    {
        $query = RequestModel::where('status', 'approvable');
        $title = 'Approvable Charges';
        $isRequested = false;
        $dateForm = '';
        $dateTo = '';

        if(  $request->get('request_type')  ){
            $query->where('type',  $request->get('request_type'));
        }

        if( $request->get('date_from') && $request->get('date_to')){
            $dateForm = $request->get('date_from') ;
            $dateTo = $request->get('date_to');
            $query->whereBetween('tanggal', [$dateForm,$dateTo]);
        }

        $requests = $query->get();
        $isApprovable = true;
        return view('request.payable.index', compact('requests','title','isRequested','isApprovable','dateForm','dateTo'));
    }

    public function request_approved(Request $request, Datatables $datatables)
    {
        $query = RequestModel::where('status', 'approved');
        $title = 'Approved Charges';
        $isRequested = false;
        $dateForm = '';
        $dateTo = '';

        if(  $request->get('request_type')  ){
            $query->where('type',  $request->get('request_type'));
        }
        
        if( $request->get('date_from') && $request->get('date_to')){
            $dateForm = $request->get('date_from') ;
            $dateTo = $request->get('date_to');
            $query->whereBetween('tanggal', [$dateForm,$dateTo]);
        }
        $requests = $query->get();
        $isApproved = true;
        return view('request.payable.index', compact('requests','title','isRequested','isApproved','dateForm','dateTo'));
    }

    //==============================================================================================
    //              REPORT
    //==============================================================================================

    public function report_jobsheet_all(Request $request, Datatables $datatables)
    {
        $reportForm = $request->get('report_from');
        $reportTo = $request->get('report_to');
        $controllerRole = 'jobsheet.all';

        $query = JobSheet::query();
        if ($reportForm && $reportTo)
            $query->whereBetween('date', [$reportForm, $reportTo]);

        $title = "All Jobsheets";
        $jobsheets = $query->get();

        if( $request->get('isExportExcel') == 1 ) {
            $report = new ArzReport();
            $report->exportExcel("Payable - Report - ".$title, $jobsheets->toArray());
        }

        if( $request->get('isExportPDF') ) {
            //$report = new ArzReport();
            //$report->exportExcel("Operation - Report - ".$title, $jobsheets->toArray());
        }

        return view('jobsheet.payable.report', compact('jobsheets', 'controllerRole','reportForm','reportTo','title'));
    }

    public function report_jobsheet_completed(Request $request, Datatables $datatables)
    {
        $reportForm = $request->get('report_from');
        $reportTo = $request->get('report_to');
        $controllerRole = 'jobsheet.completed';

        $query = JobSheet::where('status', 'completed');

        if ($reportForm && $reportTo)
            $query->whereBetween('date', [$reportForm, $reportTo]);

        $title = "Completed Jobsheets";
        $jobsheets = $query->get();

        if( $request->get('isExportExcel') == 1 ) {
            $report = new ArzReport();
            $report->exportExcel("Payable - Report - ".$title, $jobsheets->toArray());
        }

        if( $request->get('isExportPDF') ) {
            //$report = new ArzReport();
            //$report->exportExcel("Operation - Report - ".$title, $jobsheets->toArray());
        }

        return view('jobsheet.payable.report', compact('jobsheets', 'controllerRole','reportForm','reportTo','title'));
    }

    public function report_jobsheet_uncompleted(Request $request, Datatables $datatables)
    {

        $reportForm = $request->get('report_from');
        $reportTo = $request->get('report_to');
        $controllerRole = 'jobsheet.uncompleted';

        $query = JobSheet::where('operation_id', Auth::user()->getKey())->where('status', 'uncompleted');
        if ($reportForm && $reportTo)
            $query->whereBetween('date', [$reportForm, $reportTo]);

        $title = "Uncompleted Jobsheets";
        $jobsheets = $query->get();

        if( $request->get('isExportExcel') == 1 ) {
            $report = new ArzReport();
            $report->exportExcel("Payable - Report - ".$title, $jobsheets->toArray());
        }

        if( $request->get('isExportPDF') ) {
            //$report = new ArzReport();
            //$report->exportExcel("Operation - Report - ".$title, $jobsheets->toArray());
        }

        return view('jobsheet.payable.report', compact('jobsheets', 'controllerRole','reportForm','reportTo','title'));
    }

    public function report_request_requested(Request $request, Datatables $datatables)
    {

        $reportForm = $request->get('report_from');
        $reportTo = $request->get('report_to');
        $title = "Requested Charges";
        $controllerRole = 'request.requested';

        $query = RequestModel::where('status', 'requested');

        if ($reportForm && $reportTo)
            $query->whereBetween('tanggal', [$reportForm, $reportTo]);

        $requests = $query->get();

        if( $request->get('isExportExcel') == 1 ) {
            $report = new ArzReport();
            $report->exportExcel("Payable - Report - ".$title, $requests->toArray());
        }

        if( $request->get('isExportPDF') ) {
            //$report = new ArzReport();
            //$report->exportExcel("Operation - Report - ".$title, $jobsheets->toArray());
        }

        return view('request.payable.report', compact('requests','controllerRole','reportForm','reportTo','title'));

    }

    public function report_request_approvable(Request $request, Datatables $datatables)
    {
        $reportForm = $request->get('report_from');
        $reportTo = $request->get('report_to');
        $controllerRole = 'request.approvable';

        $query = RequestModel::where('status', 'approvable');

        if ($reportForm && $reportTo)
            $query->whereBetween('tanggal', [$reportForm, $reportTo]);

        $title = "Approvable Charges";
        $requests = $query->get();

        if( $request->get('isExportExcel') == 1 ) {
            $report = new ArzReport();
            $report->exportExcel("Payable - Report - ".$title, $requests->toArray());
        }

        if( $request->get('isExportPDF') ) {
            //$report = new ArzReport();
            //$report->exportExcel("Operation - Report - ".$title, $jobsheets->toArray());
        }

        return view('request.payable.report', compact('requests','controllerRole','reportForm','reportTo','title'));
    }

    public function report_request_approved(Request $request, Datatables $datatables)
    {
        $reportForm = $request->get('report_from');
        $reportTo = $request->get('report_to');
        $controllerRole = 'request.approved';

        $query = RequestModel::where('status', 'approved');

        if ($reportForm && $reportTo)
            $query->whereBetween('tanggal', [$reportForm, $reportTo]);

        $title = "Approved Charges";
        $requests = $query->get();

        if( $request->get('isExportExcel') == 1 ) {
            $report = new ArzReport();
            $report->exportExcel("Payable - Report - ".$title, $requests->toArray());
        }

        if( $request->get('isExportPDF') ) {
            //$report = new ArzReport();
            //$report->exportExcel("Operation - Report - ".$title, $jobsheets->toArray());
        }

        return view('request.payable.report', compact('requests','controllerRole','reportForm','reportTo','title'));
    }
}
