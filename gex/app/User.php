<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\JobSheet;
use App\Revision;
use App\Payable;

class User extends Authenticatable
{
    use Notifiable;

    // protected $table = "users";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code','name', 'username','email', 'password','role','address1','address2','city','province','country','phone1','phone2','phone3'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function jobsheets()
    {
        return $this->hasMany('App\JobSheet');
    }

    public function payables()
    {
        return $this->hasMany('App\Payable');
    }

    public function revision()
    {
        return $this->hasMany('App\Revision');
    }
}
