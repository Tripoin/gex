<?php

namespace App;

use App\RC;
use App\User;
use App\Invoice;
use App\Revision;
use App\Marketing;
use App\Receivable;
use App\Reimbursement;
use App\Reference;
use App\MasterPort;
use App\MasterUnit;
use App\Payable;
use App\MasterDocument;
use App\MasterCustomer;
use App\RequestModel;
use Illuminate\Database\Eloquent\Model;

class JobSheet extends Model
{
	protected $table = 'jobsheets';

    protected $fillable = ['code','operation_id','marketing_id','customer_id','poo_id','pod_id','description','date','etd','eta','vessel','partymeas','party_unit_id','remarks','instruction','freight_type'];

    protected $guarded = ['status','vessel','remarks','instruction'];

    // protected $guarded = ['remarks','instruction'];

    public function payable()
    {
        return $this->hasMany('App\Payable');
    }

    public function invoice()
    {
        return $this->hasMany('App\Invoice');
    }

    public function requests()
    {
        return $this->hasMany('App\RequestModel');
    }

    public function marketings()
    {
        return $this->hasMany('App\Marketing');
    }

    public function rc()
    {
        return $this->hasMany('App\RC');
    }

    public function receivables()
    {
        return $this->hasMany('App\Receivable');
    }

    public function reimbursements()
    {
        return $this->hasMany('App\Reimbursement');
    }

    public function revisions()
    {
        return $this->hasMany('App\Revision');
    }

    public function references()
    {
        return $this->hasMany('App\Reference');
    }
    
    //=================================================

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function port()
    {
        return $this->belongsTo('App\MasterPort');
    }

    public function party_unit()
    {
        return $this->belongsTo('App\MasterUnit');
    }

    public function document()
    {
        return $this->belongsTo('App\MasterDocument');
    }

    public function customer()
    {
        return $this->belongsTo('App\MasterCustomer');
    }

    public function term()
    {
        return $this->belongsTo('App\MasterCustomer');
    }
}
