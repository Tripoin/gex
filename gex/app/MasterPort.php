<?php

namespace App;

use App\JobSheet;
use Illuminate\Database\Eloquent\Model;

class MasterPort extends Model
{
	protected $table = 'master_ports';
	protected $fillable = ['code','nick_name','address','city','province','country','type','loading'];

    public function jobsheets()
    {
    	return $this->hasMany('App\JobSheet');
    }
}
