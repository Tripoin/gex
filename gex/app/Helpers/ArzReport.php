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
use Dompdf\Dompdf;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Facades\Excel;
use Psy\Exception\ErrorException;
use Symfony\Component\HttpKernel\Tests\Exception\NotFoundHttpExceptionTest;
use PDF;
//use PDF;

class ArzReport
{   

    public function report($request)
    {
        $modelClass = $request->get('model_class');
        $modelFieldStatusName = $request->get('model_field_status_name') ? $request->get('model_field_status_name') : 'status';
        $modelStatus = '';
        if ($request->get('model_status')) {
            $modelStatus = '';
            if ($request->get('model_status') != 'all') {
                $modelStatus = $request->get('model_status');
            }
        }

        //$a = JobSheet::query();
        $query = $modelClass::query();
        $modelClassName = class_basename($modelClass);
        if ($modelStatus)
            $query->where($modelFieldStatusName, $modelStatus);

        if ($request->get('report_from') && $request->get('report_to'))
            $query->whereBetween($request->get('model_field_date_name'), [$request->get('report_from'), $request->get('report_to')]);

        //dd($request->get('model_field_date_name'));
        $models = $query->get()->toArray();
        //dd($models,$query);

        /*$table = with(new $modelClass)->getTable();
        $pk = with(new $modelClass)->getKeyName();
        $prefixCol = with(new $modelClass)->prefix_col;
        $tblPrefix = \DB::getTablePrefix();*/

        if ($models){
            if ($request->get('exported_file_type') == 'excel') {
                self::exportExcel($request->get('exported_filename'), $models);
            } else {
                //Export::pdf($request->get('exported_filename'), $models);
            }
        } else {
            self::exportExcel($request->get('exported_filename'), [$modelClassName. " Not Found"]);

        }
        return redirect()->back()->withInput();

    }


    public function exportExcel($args=[]){
        $filename = $args['filename'];
        $data = $args['data'];
        Excel::create($filename, function($excel) use($data) {
            $excel->sheet('Sheet', function($sheet) use($data) {
                $sheet->fromArray($data);
            });
        })->export('xls');
    }

    public function exportPdf($args=[]){
        $filename = $args['filename'];
        //$view = $args['view'];
        $data = $args['jobsheets'];
        Excel::create($filename, function($excel) use($data) {
            $excel->sheet('Sheet', function($sheet) use($data) {
                $sheet->fromArray($data);
            });
        })->export('pdf');
        //return view($view, compact('data'));

        //dd(compact('view','filename'),func_get_args()[0]);
        //\PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        /*$pdf = \PDF::loadView($view, compact('data'));
        return $pdf->download($filename.'.pdf');*/
    }

}