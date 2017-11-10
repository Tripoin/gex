<?php

namespace App;

use App\Invoice;
use Illuminate\Database\Eloquent\Model;

class MasterBank extends Model
{
	protected $fillable = ['name','cabang','account','atas_nama','address','swiftcode','remarks'];

    public function invoices()
    {
    	return $this->hasMany('App\Invoice');
    }
}
