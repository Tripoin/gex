<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentDoc extends Model
{
    protected $fillable = ['payment_id','add_type','add_amount'];

    public function payment()
    {
    	return $this->belongsTo(Payment::class);
    }
}
