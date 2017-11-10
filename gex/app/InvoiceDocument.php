<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Invoice;

class InvoiceDocument extends Model
{
    protected $table = 'invoice_documents';
    protected $fillable = ['invoice_id','name','no_ref'];

    public function invoice() {
    	return $this->belongsTo('App\Invoice');
    }
}
