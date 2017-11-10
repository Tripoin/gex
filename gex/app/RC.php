<?php

namespace App;

use App\JobSheet;
use App\MasterUnit;
use App\MasterVendor;
use App\MasterDocument;
use Illuminate\Database\Eloquent\Model;

class RC extends Model
{
    protected $table = 'rc';
    protected $fillable = ['jobsheet_id','rc_document_id','rc_vendor_id','rc_unit_id','rc_price','rc_currency','rc_payment_currency','rc_quantity','rc_total','rc_type','rate','payment_id'];
    public function jobsheet()
    {
    	return $this->belongsTo('App\JobSheet');
    }

    public function vendor()
    {
    	return $this->belongsTo('App\MasterVendor');
    }

    public function rc_document()
    {
    	return $this->belongsTo('App\MasterDocument');
    }

    public function rc_unit()
    {
        return $this->belongsTo('App\MasterUnit');
    }

    public function masterRequestCurrency()
    {
        return $this->hasOne(MasterCurrency::class, 'id','rc_currency');
    }

    public function masterPaymentCurrency()
    {
        return $this->hasOne(MasterCurrency::class, 'id','rc_payment_currency');
    }

}
