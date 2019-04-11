<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usersewainfo extends Model
{
    protected $fillable = [
        'user_id','account'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
