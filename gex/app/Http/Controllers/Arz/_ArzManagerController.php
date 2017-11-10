<?php

namespace App\Http\Controllers\Arz;

use App\Http\Controllers\_ManagerController;

use App\Helpers\ArzReport;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Http\Request;
use App\RequestModel;

class _ArzManagerController extends _ManagerController
{
    public function request_approvable(Request $request, Datatables $datatables)
    {
        $query = RequestModel::where('status', 'approvable');
        $title = 'Approvable Charges';
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
        return view('request.manager.index', compact('requests','title','isApprovable','dateForm','dateTo'));
    }

    public function request_approved(Request $request, Datatables $datatables)
    {
        $query = RequestModel::where('status', 'approved');
        $title = 'Approved Charges';
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
        return view('request.manager.index', compact('requests','title','isApproved','dateForm','dateTo'));
    }

    public function request_submit_approved(Request $request)
    {
        try {
            $this->validate($request,[
                'request_ids'  => 'required',
            ]);
            if( $requestIds = $request->get('request_ids') ){
                $requestIds = implode(",",$requestIds);
                \DB::update("UPDATE requests SET status='approved' WHERE id IN (".$requestIds.")");

                $request->session()->put('message-success', 'Success Submit Request to Approved');
            }
        }
        catch (\Exception $e) {
            $request->session()->put('message-error','Something Wrong');
            return redirect()->route('manager.request.approvable', ['date_from'=>$request->get('date_from'), 'date_to'=>$request->get('date_to')]);
        }

        return redirect()->route('manager.request.approvable', ['date_from'=>$request->get('date_from'), 'date_to'=>$request->get('date_to')]);
    }


    /* REPORT HERE */
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

        return view('request.manager.report', compact('requests','controllerRole','reportForm','reportTo','title'));
    }
}