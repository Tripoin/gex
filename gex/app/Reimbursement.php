<?php

namespace App;

use App\JobSheet;
use App\Marketing;
use App\Invoice;
use App\MasterTerm;
use App\MasterUnit;
use App\MasterVendor;
use App\MasterCustomer;
use App\MasterDocument;
use Illuminate\Database\Eloquent\Model;

class Reimbursement extends Model
{
    protected $fillable = ['jobsheet_id','rmb_invoice_id','rmb_marketing_id','rmb_document_id','rmb_vendor_id','rmb_unit_id','rmb_price','rmb_currency','rmb_quantity','rmb_total'];

    public function jobsheet()
    {
    	return $this->belongsTo('App\JobSheet');
    }

    public function rmb_marketing()
    {
        return $this->belongsTo('App\Marketing');
    }

    public function invoice()
    {
    	return $this->belongsTo('App\Invoice');
    }

    public function term()
    {
    	return $this->belongsTo('App\MasterTerm');
    }

    public function rmb_unit()
    {
    	return $this->belongsTo('App\MasterUnit');
    }

    public function customer()
    {
    	return $this->belongsTo('App\MasterCustomer');
    }

    public function rmb_document()
    {
    	return $this->belongsTo('App\MasterDocument');
    }

    public function rmb_vendor()
    {
        return $this->belongsTo('App\MasterVendor');
    }
}
