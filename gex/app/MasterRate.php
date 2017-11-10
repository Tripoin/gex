<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use App\Receivable;

class MasterRate extends Model
{
    protected $fillable = ['date','rate'];

    // public function receivables()
    // {
    // 	return $this->hasMany('App\Receivable');
    // }
}
