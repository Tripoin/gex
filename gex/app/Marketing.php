<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\JobSheet;
use App\MasterTerm;
use App\Receivable;
use App\Reimbursement;

class Marketing extends Model
{
	protected $table = 'marketings';
    protected $fillable = ['jobsheet_id','term_id', 'customer_id'];
	
    public function receivables()
    {
        return $this->hasMany('App\Receivable');
    }

    public function reimbursements()
    {
        return $this->hasMany('App\Reimbursement');
    }

    public function jobsheet()
    {
        return $this->belongsTo('App\JobSheet');
    }

    public function term()
    {
        return $this->belongsTo('App\MasterTerm');
    }
}
