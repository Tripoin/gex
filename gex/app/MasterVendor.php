<?php

namespace App;

use App\RC;
use App\Payable;
use App\Payment;
use Illuminate\Database\Eloquent\Model;

class MasterVendor extends Model
{
	protected $fillable = ['code','name','nick_name','address1','address2','city','province','country','phone1','phone2','zip_code','remark','type'];
	
    public function payables()
    {
    	return $this->hasMany('App\Payable');
    }

    public function payments()
    {
        return $this->hasMany('App\Payment');
    }

    public function reimbursements()
    {
        return $this->hasMany('App\Reimbursement');
    }

    public function rc()
    {
        return $this->hasMany('App\RC');
    }
}
