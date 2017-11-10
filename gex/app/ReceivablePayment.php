<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Invoice;
use App\JobSheet;
use App\MasterCustomer;

class ReceivablePayment extends Model
{
	protected $table = 'receivable_payments';

    protected $fillable = ['no_form','customer_id','jobsheet_id','currency','payment','invoice_id','amount_rec','rate','pph','adm_bank','other','remarks','note'];

    public function jobsheet()
    {
        return $this->belongsTo('App\JobSheet');
    }

    public function customer()
    {
        return $this->belongsTo('App\MasterCustomer');
    }

    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }
}
