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

class ArzFormatDate
{   

    public static function date($date)
    {
        return \Carbon\Carbon::createFromTimestamp(strtotime($date))->format('Y-m-d');
    }

}