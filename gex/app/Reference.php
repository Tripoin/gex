<?php

namespace App;

use App\JobSheet;
use App\MasterDocument;
use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    protected $fillable = ['jobsheet_id','document_id','ref_no'];
    // public $timestamps = false;

    public function jobsheet()
    {
        return $this->belongsTo('App\JobSheet');
    }

    public function document()
    {
        return $this->belongsTo('App\MasterDocument');
    }
}
