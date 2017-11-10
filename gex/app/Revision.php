<?php

namespace App;

use App\User;
use App\JobSheet;
use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{
    protected $table = 'revisions';
	protected $fillable = ['jobsheet_id','sender','receiver','note','role'];
	
    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function jobsheet()
    {
    	return $this->belongsTo('App\JobSheet');
    }
}
