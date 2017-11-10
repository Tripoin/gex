<?php

namespace App;

use App\JobSheet;
use App\Receivable;
use App\ReceivablePayment;
use App\Reimbursement;
use App\MasterPort;
use App\MasterDocument;
use App\MasterCustomer;
use App\InvoiceDocument;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{   

    protected $table = 'invoices';

    protected $fillable = ['code','customer_id','jobsheet_id','bank_id','document_id','tanggal','status','approval','type','efaktur','due_date','receipt_date','reason','date_request'];

    public function invoicedocuments() {
        return $this->hasMany('App\InvoiceDocument');
    }

    public function receivables()
    {
        return $this->hasMany('App\Receivable');
    }

    public function receivable_payment()
    {
        return $this->hasMany('App\ReceivablePayment');
    }

    public function reimbursement()
    {
        return $this->hasMany('App\Reimbursement');
    }

    /*===============================================================*/

    public function jobsheet()
    {
    	return $this->belongsTo('App\JobSheet');
    }

    public function document()
    {
    	return $this->belongsTo('App\MasterDocument');
    }

    public function customer()
    {
    	return $this->belongsTo('App\MasterCustomer');
    }

    public function bank()
    {
    	return $this->belongsTo('App\MasterBank');
    }
}
