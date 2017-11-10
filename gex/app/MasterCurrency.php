<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Receivable;

class MasterCurrency extends Model
{
    const IDR = 1;
    const USD = 2;

    protected $fillable = ['name','display_name','priceToIDR'];

    public function receivables()
    {
    	return $this->hasMany('App\Receivable');
    }
}
