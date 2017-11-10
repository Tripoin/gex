<?php

namespace App;

use App\User;
use App\JobSheet;
use App\MasterUnit;
use App\MasterVendor;
use App\MasterDocument;
use Illuminate\Database\Eloquent\Model;

class Payable extends Model
{
    protected $table = 'payables';
    protected $fillable = ['user_id','jobsheet_id','document_id','vendor_id','unit_id','price','currency','payment_currency','quantity','rate','total'];
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
    
	public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function jobsheet()
    {
        return $this->belongsTo('App\JobSheet');
    }

    public function unit()
    {
        return $this->belongsTo('App\MasterUnit');
    }

    public function vendor()
    {
        return $this->belongsTo('App\MasterVendor');
    }
    
    public function document()
    {
        return $this->belongsTo('App\MasterDocument');
    }

    public function masterRequestCurrency()
    {
        return $this->hasOne(MasterCurrency::class, 'id','currency');
    }

    public function masterPaymentCurrency()
    {
        return $this->hasOne(MasterCurrency::class, 'id','payment_currency');
    }

}
