<?php

namespace App;

use App\JobSheet;
use App\Marketing;
use App\Invoice;
use App\Receivable;
use App\MasterUnit;
use App\MasterCustomer;
use App\MasterDocument;
use Illuminate\Database\Eloquent\Model;

class Receivable extends Model
{
    protected $fillable = ['jobsheet_id','rec_invoice_id','rec_marketing_id','rec_document_id','rec_unit_id','rec_price','rec_currency','rec_quantity','rec_tax','rec_tax_amount','rec_total','rec_charge_type'];

    public function jobsheet()
    {
    	return $this->belongsTo('App\JobSheet');
    }

    public function rec_marketing()
    {
        return $this->belongsTo('App\Marketing');
    }

    public function rec_invoice()
    {
    	return $this->belongsTo('App\Invoice');
    }

    public function rec_unit()
    {
    	return $this->belongsTo('App\MasterUnit');
    }

    public function rec_customer()
    {
    	return $this->belongsTo('App\MasterCustomer');
    }

    public function rec_document()
    {
    	return $this->belongsTo('App\MasterDocument');
    }
}
