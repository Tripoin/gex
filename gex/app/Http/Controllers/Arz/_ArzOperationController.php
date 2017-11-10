<?php

namespace App\Http\Controllers\Arz;

use App\Helpers\ArzFormatReport;
use App\Helpers\ArzReport;
use App\Http\Controllers\_OperationController;
use App\MasterCurrency;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\MasterDocument;
use App\MasterCustomer;
use App\MasterVendor;
use App\MasterUnit;
use App\MasterPort;
use App\Reference;
use App\JobSheet;
use App\Revision;
use App\Payable;
use App\User;
use App\RequestModel;


class _ArzOperationController extends _OperationController
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

        $title = 'Requested Charges';
        return view('request.operation.index', compact('requests','title','dateForm','dateTo'));
    }

    public function request_create(Request $request)
    {
        //$role = Auth::user()->role;
        $query = JobSheet::where('status', 'completed')
            ->where('operation_id', Auth::user()->getKey());

        $dateForm = '';
        $dateTo = '';
        if( $request->get('date_from') && $request->get('date_to')){
            $dateForm = $request->get('date_from');
            $dateTo = $request->get('date_to');
            $query->whereBetween('date', [$dateForm,$dateTo]);
        }

        $jobsheets = $query->get();
        return view('request.operation.create', compact('jobsheets','dateForm','dateTo'));
    }

    public function request_detail_jobsheet(Request $request, $id)
    {
        $jobsheet = JobSheet::find($id);
        $references = Reference::where('jobsheet_id', $jobsheet->id)->get();
        $payables = Payable::where('jobsheet_id', $jobsheet->id)->where('user_id',  Auth::user()->getKey())->get();
        $revisions   = Revision::where('jobsheet_id', $id)->get();
        $requestedModel = RequestModel::where('jobsheet_id', $id)->get()->toArray();
        $requestedPayableIds = $requestedModel ? array_pluck($requestedModel, 'payable_id', 'payable_id') : [];
        $requestedPayableDates = $requestedModel ? array_pluck($requestedModel, 'tanggal', 'payable_id') : [];
        $defaultRequestDate = Carbon::now()->toDateString();
        $controllerRole = Auth::user()->role;
        return view('request.operation.detail_jobsheet', compact('jobsheet','references','payables','revisions',
            'requestedPayableDates','requestedPayableIds','defaultRequestDate', 'controllerRole'));
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
            return redirect()->route('operation.request.detail-jobsheet', ['id'=>$jobsheetId]);
        }

        return redirect()->route('operation.request.detail-jobsheet', ['id'=>$jobsheetId]);
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
        return view('request.operation.index', compact('requests','title','dateForm','dateTo'));
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
        return view('request.operation.index', compact('requests','title','dateForm','dateTo'));
    }

    //==============================================================================================
    //              REPORT
    //==============================================================================================

    public function report_jobsheet_all(Request $request, Datatables $datatables)
    {
        $reportForm = $request->get('report_from');
        $reportTo = $request->get('report_to');
        $controllerRole = 'jobsheet.all';

        $query = JobSheet::where('operation_id', Auth::user()->getKey());
        if ($reportForm && $reportTo)
            $query->whereBetween('date', [$reportForm, $reportTo]);

        $title = "All Jobsheets";

        $jobsheets = $query->get();

        if( $request->get('isExportExcel') == 1 ) {
            $formatReport = new ArzFormatReport();
            $reportJobsheets = $formatReport->operationJobsheet($jobsheets);
            if( $reportJobsheets ) {
                $report = new ArzReport();
                $report->exportExcel([
                    'filename'=>"Operation - Report - " . $title,
                    'data'=>$reportJobsheets
                ]);
            }
        }

        if( $request->get('isExportPDF') == 1 ) {
            $formatReport = new ArzFormatReport();
            $reportJobsheets = $formatReport->operationJobsheet($jobsheets);
            if( $reportJobsheets ) {
                $pdfTitle = "Operation - Report - " . $title;
                $report = new ArzReport();
                return $report->exportPdf([
                    'filename' => $pdfTitle,
                    'view' => 'report.operation.jobsheet',
                    'jobsheets' => $reportJobsheets,
                    'title' => $pdfTitle,
                ]);

            }
        }

        return view('jobsheet.operation.report', compact('jobsheets', 'controllerRole','reportForm','reportTo','title'));
    }

    public function report_jobsheet_completed(Request $request, Datatables $datatables)
    {
        $reportForm = $request->get('report_from');
        $reportTo = $request->get('report_to');
        $controllerRole = 'jobsheet.completed';

        $query = JobSheet::where('operation_id', Auth::user()->getKey())->where('status', 'completed');

        if ($reportForm && $reportTo)
            $query->whereBetween('date', [$reportForm, $reportTo]);

        $title = "Completed Jobsheets";
        $jobsheets = $query->get();

        if( $request->get('isExportExcel') == 1 ) {
            $report = new ArzReport();
            $report->exportExcel("Operation - Report - ".$title, $jobsheets->toArray());
        }

        if( $request->get('isExportPDF') ) {
            //$report = new ArzReport();
            //$report->exportExcel("Operation - Report - ".$title, $jobsheets->toArray());
        }

        return view('jobsheet.operation.report', compact('jobsheets', 'controllerRole','reportForm','reportTo','title'));
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
            $report->exportExcel("Operation - Report - ".$title, $jobsheets->toArray());
        }

        if( $request->get('isExportPDF') ) {
            //$report = new ArzReport();
            //$report->exportExcel("Operation - Report - ".$title, $jobsheets->toArray());
        }

        return view('jobsheet.operation.report', compact('jobsheets', 'controllerRole','reportForm','reportTo','title'));
    }

    public function report_request_requested(Request $request, Datatables $datatables)
    {

        $reportForm = $request->get('report_from');
        $reportTo = $request->get('report_to');
        $title = "Requested Charges";

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

        $controllerRole = 'request.requested';
        return view('request.operation.report', compact('requests','controllerRole','reportForm','reportTo','title'));

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
            $report->exportExcel("Operation - Report - ".$title, $requests->toArray());
        }

        if( $request->get('isExportPDF') ) {
            //$report = new ArzReport();
            //$report->exportExcel("Operation - Report - ".$title, $jobsheets->toArray());
        }

        return view('request.operation.report', compact('requests','controllerRole','reportForm','reportTo','title'));
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
            $report->exportExcel("Operation - Report - ".$title, $requests->toArray());
        }

        if( $request->get('isExportPDF') ) {
            //$report = new ArzReport();
            //$report->exportExcel("Operation - Report - ".$title, $jobsheets->toArray());
        }

        return view('request.operation.report', compact('requests','controllerRole','reportForm','reportTo','title'));
    }
}
