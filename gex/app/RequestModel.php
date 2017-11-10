<?php

namespace App;

use App\JobSheet;
use Illuminate\Database\Eloquent\Model;

class RequestModel extends Model
{
    const PAY_TYPE_CASH = 'CASH';
    const PAY_TYPE_BANK = 'BANK';

    protected $table = 'requests';
    protected $fillable = ['jobsheet_id','payable_id','rc_id','payment_type','bank_id', 'tanggal','user_id','tanggal','status','type'];

    public function jobsheet()
    {
        return $this->belongsTo('App\JobSheet');
    }

    public function payable()
    {
        return $this->hasOne('App\Payable', 'id','payable_id');
    }

    public function rc()
    {
        return $this->hasOne('App\RC', 'id','rc_id');
    }

    public function requestCurrency()
    {
        if( $this->payable_id ){
            return $this->payable && $this->payable->masterRequestCurrency ? $this->payable->masterRequestCurrency : '';
        } else {
            return $this->rc && $this->rc->masterRequestCurrency ? $this->rc->masterRequestCurrency : '';
        }
    }

    public function paymentCurrency()
    {
        if( $this->payable_id ){
            return $this->payable && $this->payable->masterPaymentCurrency ? $this->payable->masterPaymentCurrency : '';
        } else {
            return $this->rc && $this->rc->masterPaymentCurrency ? $this->rc->masterPaymentCurrency : '';
        }
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function bank()
    {
        return $this->hasOne('App\MasterBank', 'id','bank_id');
    }

    public static function listsPaymentType(){
        return [
            RequestModel::PAY_TYPE_CASH=>'CASH',
            RequestModel::PAY_TYPE_BANK=>'BANK'
        ];
    }
}
