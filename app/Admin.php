<?php

namespace App;

use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Admin extends Authenticatable
{
    use Notifiable;

    protected $table ='admins';
    protected $guard ='admin';
    protected $fillable = [
        'username','first_name','last_name','nick_name','email','password','role','image',
    ];
    public function setPasswordAttribute($value){

        $this->attributes['password'] = Hash::make($value);

    }

    protected $hidden = [
        'password', 'remember_token',
    ];
}
