<?php

namespace App;

use App\Invoice;
use App\JobSheet;
use App\Reimbursement;
use App\Receivable;
use App\ReceivablePayment;
use Illuminate\Database\Eloquent\Model;

class MasterCustomer extends Model
{
    protected $fillable = ['code','name','nick_name','address1','address2','city','province','country','phone1','phone2','fax','zipcode'];

    // protected $guarded = ['type'];
    
    public function jobsheets()
    {
    	return $this->hasMany('App\JobSheet');
    }

    public function invoices()
    {
    	return $this->hasMany('App\Invoice');
    }

    public function receivable()
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

}
