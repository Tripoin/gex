<?php

namespace App;

use App\Payable;
use App\JObSheet;
use App\Receivable;
use App\Reimbursement;
use Illuminate\Database\Eloquent\Model;

class MasterUnit extends Model
{
    protected $fillable = ['name','display_name'];

    public function jobsheets()
    {
    	return $this->hasMany('App\JObSheet');
    }

    public function payables()
    {
        return $this->hasMany('App\Payable');
    }

    public function receivable()
    {
        return $this->hasMany('App\Receivable');
    }

    public function reimbursement()
    {
        return $this->hasMany('App\Reimbursement');
    }
}
