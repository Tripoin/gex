<?php

namespace App;

use App\RC;
use App\Invoice;
use App\Payable;
use App\JobSheet;
use App\Reference;
use App\Reimbursement;
use Illuminate\Database\Eloquent\Model;

class MasterDocument extends Model
{
    protected $fillable = ['code','name','display_name','type','remark'];

    public function jobsheets()
    {
    	return $this->hasMany('App\JobSheet');
    }

    public function invoices()
    {
    	return $this->hasMany('App\Invoice');
    }

    public function payables()
    {
    	return $this->hasMany('App\Payable');
    }

    public function rc()
    {
        return $this->hasMany('App\RC');
    }

    public function receivable()
    {
        return $this->hasMany('App\Receivable');
    }

    public function reimbursement()
    {
        return $this->hasMany('App\Reimbursement');
    }

    //=================================================

    public function references()
    {
        return $this->hasMany('App\Reference');
    }
}
