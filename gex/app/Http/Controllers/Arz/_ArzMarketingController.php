<?php

namespace App\Http\Controllers\Arz;

use App\Helpers\ArzReport;
use App\Http\Controllers\_MarketingController;
use App\RequestModel;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Reference;
use App\JobSheet;
use App\Revision;
use App\RC;


class _ArzMarketingController extends _MarketingController
{
    //==============================================================================================
    //              REQUEST
    //==============================================================================================

    public function request_rc_list(Request $request)
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

        $title = 'Requested Charges';
        return view('request.marketing.index', compact('requests','title','dateForm','dateTo'));
    }

    public function request_rc_create(Request $request)
    {
        //$role = Auth::user()->role;
        $query = JobSheet::where('status', 'completed')
            ->where('marketing_id', Auth::user()->getKey());

        $dateForm = '';
        $dateTo = '';
        if( $request->get('date_from') && $request->get('date_to')){
            $dateForm = $request->get('date_from');
            $dateTo = $request->get('date_to');
            $query->whereBetween('date', [$dateForm,$dateTo]);
        }
        $jobsheets = $query->get();
        return view('request.marketing.create', compact('jobsheets','dateForm','dateTo'));
    }

    public function request_rc_detail_jobsheet(Request $request, $id)
    {
        $jobsheet = JobSheet::find($id);
        $references = Reference::where('jobsheet_id', $jobsheet->id)->get();
        $rcs = RC::where('jobsheet_id', $jobsheet->id)->get();
        $revisions   = Revision::where('jobsheet_id', $id)->get();
        $requestedModel = RequestModel::where('jobsheet_id', $id)->get()->toArray();
        $requestedRCIds = $requestedModel ? array_pluck($requestedModel, 'rc_id', 'rc_id') : [];
        $requestedRCDates = $requestedModel ? array_pluck($requestedModel, 'tanggal', 'rc_id') : [];
        $defaultRequestDate = Carbon::now()->toDateString();
        $controllerRole = Auth::user()->role;
        return view('request.marketing.detail_jobsheet', compact('jobsheet','references','rcs','revisions',
            'requestedRCDates','defaultRequestDate', 'controllerRole','requestedRCIds'));
    }

    public function request_rc_store(Request $request)
    {
        try {
            $this->validate($request,[
                'rc_ids'  => 'required',
                'jobsheet_id'   => 'required'
            ]);
            $userId = \Auth::user()->getKey();
            $role = \Auth::user()->role;
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
            return redirect()->route('marketing.request-rc.detail-jobsheet', ['id'=>$jobsheetId]);
        }

        return redirect()->route('marketing.request-rc.detail-jobsheet', ['id'=>$jobsheetId]);
    }

    public function request_rc_index(Request $request)
    {

    }

    public function request_rc_approvable(Request $request, Datatables $datatables)
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
        return view('request.marketing.index', compact('requests','title','dateForm','dateTo'));
    }

    public function request_rc_approved(Request $request, Datatables $datatables)
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
        return view('request.marketing.index', compact('requests','title','dateForm','dateTo'));
    }

    //==============================================================================================
    //              REPORT
    //==============================================================================================

    public function report_jobsheet_all(Request $request, Datatables $datatables)
    {
        $reportForm = $request->get('report_from');
        $reportTo = $request->get('report_to');
        $controllerRole = 'jobsheet.all';

        $query = JobSheet::where('marketing_id', Auth::user()->getKey());
        if ($reportForm && $reportTo)
            $query->whereBetween('date', [$reportForm, $reportTo]);

        $title = "All Jobsheets";
        $jobsheets = $query->get();

        if( $request->get('isExportExcel') == 1 ) {
            $report = new ArzReport();
            $report->exportExcel("Marketing - Report - ".$title, $jobsheets->toArray());
        }

        if( $request->get('isExportPDF') ) {
            //$report = new ArzReport();
            //$report->exportExcel("Marketing - Report - ".$title, $jobsheets->toArray());
        }

        return view('jobsheet.marketing.report', compact('jobsheets', 'controllerRole','reportForm','reportTo','title'));
    }

    public function report_jobsheet_completed(Request $request, Datatables $datatables)
    {
        $reportForm = $request->get('report_from');
        $reportTo = $request->get('report_to');
        $controllerRole = 'jobsheet.completed';

        $query = JobSheet::where('marketing_id', Auth::user()->getKey())->where('status', 'completed');

        if ($reportForm && $reportTo)
            $query->whereBetween('date', [$reportForm, $reportTo]);

        $title = "Completed Jobsheets";
        $jobsheets = $query->get();

        if( $request->get('isExportExcel') == 1 ) {
            $report = new ArzReport();
            $report->exportExcel("Marketing - Report - ".$title, $jobsheets->toArray());
        }

        if( $request->get('isExportPDF') ) {
            //$report = new ArzReport();
            //$report->exportExcel("Marketing - Report - ".$title, $jobsheets->toArray());
        }

        return view('jobsheet.marketing.report', compact('jobsheets', 'controllerRole','reportForm','reportTo','title'));
    }

    public function report_jobsheet_uncompleted(Request $request, Datatables $datatables)
    {

        $reportForm = $request->get('report_from');
        $reportTo = $request->get('report_to');
        $controllerRole = 'jobsheet.uncompleted';

        $query = JobSheet::where('marketing_id', Auth::user()->getKey())->where('status', 'uncompleted');
        if ($reportForm && $reportTo)
            $query->whereBetween('date', [$reportForm, $reportTo]);

        $title = "Uncompleted Jobsheets";
        $jobsheets = $query->get();

        if( $request->get('isExportExcel') == 1 ) {
            $report = new ArzReport();
            $report->exportExcel("Marketing - Report - ".$title, $jobsheets->toArray());
        }

        if( $request->get('isExportPDF') ) {
            //$report = new ArzReport();
            //$report->exportExcel("Marketing - Report - ".$title, $jobsheets->toArray());
        }

        return view('jobsheet.marketing.report', compact('jobsheets', 'controllerRole','reportForm','reportTo','title'));
    }

    public function report_request_rc_requested(Request $request, Datatables $datatables)
    {

        $reportForm = $request->get('report_from');
        $reportTo = $request->get('report_to');
        $title = "Requested Charges";
        $controllerRole = 'request-rc.requested';

        $query = RequestModel::where('status', 'requested')->whereNotNull('rc_id');

        if ($reportForm && $reportTo)
            $query->whereBetween('tanggal', [$reportForm, $reportTo]);

        $requests = $query->get();

        if( $request->get('isExportExcel') == 1 ) {
            $report = new ArzReport();
            $report->exportExcel("Marketing - Report - ".$title, $requests->toArray());
        }

        if( $request->get('isExportPDF') ) {
            //$report = new ArzReport();
            //$report->exportExcel("Operation - Report - ".$title, $jobsheets->toArray());
        }

        return view('request.marketing.report', compact('requests','controllerRole','reportForm','reportTo','title'));

    }

    public function report_request_rc_approvable(Request $request, Datatables $datatables)
    {
        $reportForm = $request->get('report_from');
        $reportTo = $request->get('report_to');
        $controllerRole = 'request-rc.approvable';

        $query = RequestModel::where('status', 'approvable')
            ->whereNotNull('rc_id')
            ->where('user_id', Auth::user()->getKey());

        if ($reportForm && $reportTo)
            $query->whereBetween('tanggal', [$reportForm, $reportTo]);

        $title = "Approvable Charges";
        $requests = $query->get();

        if( $request->get('isExportExcel') == 1 ) {
            $report = new ArzReport();
            $report->exportExcel("Marketing - Report - ".$title, $requests->toArray());
        }

        if( $request->get('isExportPDF') ) {
            //$report = new ArzReport();
            //$report->exportExcel("Operation - Report - ".$title, $jobsheets->toArray());
        }

        return view('request.marketing.report', compact('requests','controllerRole','reportForm','reportTo','title'));
    }

    public function report_request_rc_approved(Request $request, Datatables $datatables)
    {
        $reportForm = $request->get('report_from');
        $reportTo = $request->get('report_to');
        $controllerRole = 'request-rc.approved';

        $query = RequestModel::where('status', 'approved')
            ->whereNotNull('rc_id')
            ->where('user_id', Auth::user()->getKey());

        if ($reportForm && $reportTo)
            $query->whereBetween('tanggal', [$reportForm, $reportTo]);

        $title = "Approved Charges";
        $requests = $query->get();

        if( $request->get('isExportExcel') == 1 ) {
            $report = new ArzReport();
            $report->exportExcel("Marketing - Report - ".$title, $requests->toArray());
        }

        if( $request->get('isExportPDF') ) {
            //$report = new ArzReport();
            //$report->exportExcel("Operation - Report - ".$title, $jobsheets->toArray());
        }

        return view('request.marketing.report', compact('requests','controllerRole','reportForm','reportTo','title'));
    }

}
