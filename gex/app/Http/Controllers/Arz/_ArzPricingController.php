<?php

namespace App\Http\Controllers\Arz;

use App\Helpers\ArzReport;
use App\Http\Controllers\_PricingController;
use App\RequestModel;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Reference;
use App\JobSheet;
use App\Revision;
use App\Payable;
use App\RC;

class _ArzPricingController extends _PricingController
{
    //==============================================================================================
    //              REQUEST
    //==============================================================================================

    public function request_list(Request $request)
    {
        $query = RequestModel::where('status', 'requested')
            ->where('user_id', Auth::user()->getKey());

        $dateForm = '';
        $dateTo = '';
        if( $request->get('date_from') && $request->get('date_to')){
            $dateForm = $request->get('date_from');
            $dateTo = $request->get('date_to');
            $query->whereBetween('tanggal', [$dateForm,$dateTo]);
        }
        $requests = $query->get();

        return view('request.pricing.index', compact('requests','dateForm','dateTo'));
    }

    public function request_create(Request $request)
    {
        //$jobSheetsRequested = RequestModel::where('status', 'requested')->where('type','operation')->pluck('jobsheet_id','jobsheet_id');
        $payables = Payable::where('user_id', Auth::user()->getKey())->pluck('jobsheet_id','jobsheet_id')->toArray();
        if ( $payables )
            $query = JobSheet::where('status', 'completed')->whereIn('id', $payables);
        else
            $query = JobSheet::where('status', 'completed');

        $dateForm = '';
        $dateTo = '';
        if( $request->get('date_from') && $request->get('date_to')){
            $dateForm = $request->get('date_from');
            $dateTo = $request->get('date_to');
            $query->whereBetween('date', [$dateForm,$dateTo]);
        }

        $jobsheets = $query->get();
        return view('request.pricing.create', compact('jobsheets','dateForm','dateTo'));
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
        $requestedRCIds = $requestedModel ? array_pluck($requestedModel, 'rc_id', 'rc_id') : [];
        $requestedRCDates = $requestedModel ? array_pluck($requestedModel, 'tanggal', 'rc_id') : [];
        $defaultRequestDate = Carbon::now()->toDateString();
        $controllerRole = Auth::user()->role;
        $pay_total_price = $payables->sum('price');
        $pay_total_price_idr = $payables->where('currency',1);
        $pay_total_price_usd = $payables->where('currency',2);
        $rcs = RC::where('jobsheet_id', $id)->where('rc_type','pricing')->get();

        return view('request.pricing.detail_jobsheet', compact('jobsheet','references','payables','revisions',
            'requestedPayableIds','requestedPayableDates','requestedRCIds','requestedRCDates','defaultRequestDate', 'controllerRole', 'pay_total_price',
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
            return redirect()->route('pricing.request.detail-jobsheet', ['id'=>$jobsheetId]);
        }

        return redirect()->route('pricing.request.detail-jobsheet', ['id'=>$jobsheetId]);
    }

    public function request_rc_store(Request $request)
    {
        try {
            $this->validate($request,[
                'rc_ids'  => 'required',
                'jobsheet_id'   => 'required'
            ]);
            $userId = \Auth::user()->getKey();
            $requestDate = Carbon::now()->toDateString();
            if( ($rcIds = $request->get('rc_ids')) && ($jobsheetId = $request->get('jobsheet_id')) ){
                $requestDates = $request->get('request_dates');
                $i = 0;
                foreach($rcIds as $rcId){
                    $attributes = [
                        'jobsheet_id' => $jobsheetId,
                        'rc_id' => $rcId,
                        'user_id' => $userId,
                        'tanggal' => isset($requestDates[$rcId]) ? Carbon::createFromTimestamp(strtotime($requestDates[$rcId]))->toDateString() : $requestDate,
                        'status' => 'requested',
                        'type' => 'rc'
                    ];
                    $requestModel = new RequestModel();
                    if( RequestModel::where('jobsheet_id',$jobsheetId)->where('rc_id',$rcId)->count() >= 1 ) {
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
            return redirect()->route('pricing.request.detail-jobsheet', ['id'=>$jobsheetId]);
        }

        return redirect()->route('pricing.request.detail-jobsheet', ['id'=>$jobsheetId]);
    }


    public function request_index(Request $request)
    {

    }

    public function request_approvable(Request $request, Datatables $datatables)
    {
        $query = RequestModel::where('status', 'approvable')
            ->where('user_id', Auth::user()->getKey());

        $dateForm = '';
        $dateTo = '';
        if( $request->get('date_from') && $request->get('date_to')){
            $dateForm = $request->get('date_from');
            $dateTo = $request->get('date_to');
            $query->whereBetween('tanggal', [$dateForm,$dateTo]);
        }

        $requests = $query->get();

        $title = 'Approvable Charges';
        return view('request.pricing.index', compact('requests','title','dateForm','dateTo'));
    }

    public function request_approved(Request $request, Datatables $datatables)
    {
        $query = RequestModel::where('status', 'approved')
            ->where('user_id', Auth::user()->getKey());

        $dateForm = '';
        $dateTo = '';
        if( $request->get('date_from') && $request->get('date_to')){
            $dateForm = $request->get('date_from');
            $dateTo = $request->get('date_to');
            $query->whereBetween('tanggal', [$dateForm,$dateTo]);
        }

        $requests = $query->get();

        $title = 'Approved Charges';
        return view('request.pricing.index', compact('requests','title','dateForm','dateTo'));
    }


    //==============================================================================================
    //              REPORT
    //==============================================================================================

    public function report_request_requested(Request $request, Datatables $datatables)
    {

        $reportForm = $request->get('report_from');
        $reportTo = $request->get('report_to');
        $title = "Requested Charges";
        $controllerRole = 'request.requested';

        $query = RequestModel::where('status', 'requested')
            ->where('user_id', Auth::user()->getKey());

        if ($reportForm && $reportTo)
            $query->whereBetween('tanggal', [$reportForm, $reportTo]);

        $requests = $query->get();

        if( $request->get('isExportExcel') == 1 ) {
            $report = new ArzReport();
            $report->exportExcel("Operation - Report - ".$title, $requests->toArray());
        }

        if( $request->get('isExportPDF') ) {
            //$report = new ArzReport();
            //$report->exportExcel("Operation - Report - ".$title, $jobsheets->toArray());
        }

        return view('request.pricing.report', compact('requests','controllerRole','reportForm','reportTo','title'));

    }

    public function report_request_approvable(Request $request, Datatables $datatables)
    {
        $reportForm = $request->get('report_from');
        $reportTo = $request->get('report_to');
        $controllerRole = 'request.approvable';

        $query = RequestModel::where('status', 'approvable')
            ->where('user_id', Auth::user()->getKey());

        if ($reportForm && $reportTo)
            $query->whereBetween('tanggal', [$reportForm, $reportTo]);

        $title = "Approvable Charges";
        $requests = $query->get();

        if( $request->get('isExportExcel') == 1 ) {
            $report = new ArzReport();
            $report->exportExcel("Pricing - Report - ".$title, $requests->toArray());
        }

        if( $request->get('isExportPDF') ) {
            //$report = new ArzReport();
            //$report->exportExcel("Operation - Report - ".$title, $jobsheets->toArray());
        }

        return view('request.pricing.report', compact('requests','controllerRole','reportForm','reportTo','title'));
    }

    public function report_request_approved(Request $request, Datatables $datatables)
    {
        $reportForm = $request->get('report_from');
        $reportTo = $request->get('report_to');
        $controllerRole = 'request.approved';

        $query = RequestModel::where('status', 'approved')
            ->where('user_id', Auth::user()->getKey());

        if ($reportForm && $reportTo)
            $query->whereBetween('tanggal', [$reportForm, $reportTo]);

        $title = "Approved Charges";
        $requests = $query->get();

        if( $request->get('isExportExcel') == 1 ) {
            $report = new ArzReport();
            $report->exportExcel("Pricing - Report - ".$title, $requests->toArray());
        }

        if( $request->get('isExportPDF') ) {
            //$report = new ArzReport();
            //$report->exportExcel("Operation - Report - ".$title, $jobsheets->toArray());
        }

        return view('request.pricing.report', compact('requests','controllerRole','reportForm','reportTo','title'));
    }
}