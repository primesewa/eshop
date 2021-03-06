<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','username'
    ];

    public function sewa()
    {
        return $this->hasOne('App\Usersewainfo');
    }
    public function pic()
    {
        return $this->hasOne('App\Userpic', 'user_id', 'id');
    }
    public function vendor()
    {
        return $this->hasMany('App\Vendor');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function vorders()
    {
        return $this->hasMany('App\Vendororder');
    }


        public function suborders()
    {
        return $this->hasMany('App\Subcategoryorder');
    }


    public function miniorders()
    {
        return $this->hasMany('App\Minicategoryorder');
    }

    public function setPasswordAttribute($value){

        $this->attributes['password'] = Hash::make($value);

    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
