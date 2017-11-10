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

class ArzFormatPrice
{   

    public static function price($price, $curr=1)
    {
        if( $curr == 1 ){
            $price = number_format($price, 0, ",", ".");
        } else {
            $price = round($price,2);
            $price = $price > 1 ? number_format($price) :$price;
        }

        return $price;
    }

}