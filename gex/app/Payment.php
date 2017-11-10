<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
	protected $table = 'payments';
    protected $fillable = [
    	'vendor_id','payment','currency','note','date_payment','status','code'
    ];

    public function payable()
    {
    	return $this->hasMany(Payable::class);
    }

    public function pay_docs()
    {
        return $this->hasMany(PaymentDoc::class);
    }

    public function vendor()
    {
    	return $this->belongsTo(MasterVendor::class);
    }
}
