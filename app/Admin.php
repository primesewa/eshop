<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Admin extends Model
{
    protected $fillable = [
        'Username','First_name','Last_name','Nick_name','Email','Password','Role','Image',
    ];
    public function setPasswordAttribute($value){

        $this->attributes['Password'] = Hash::make($value);

    }

    protected $hidden = [
        'Password', 'remember_token',
    ];
}
