<?php

namespace App;

use App\Receivable;
use App\Marketing;
use App\Reimbursement;
use Illuminate\Database\Eloquent\Model;

class MasterMonths extends Model
{
	protected $fillable = ['code','name','days'];

    public function receivable()
    {
        return $this->hasMany('App\Receivable');
    }

    public function marketings()
    {
        return $this->hasMany('App\Marketing');
    }

    public function reimbursement()
    {
        return $this->hasMany('App\Reimbursement');
    }
}
