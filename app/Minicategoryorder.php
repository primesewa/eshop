<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Minicategoryorder extends Model
{
    protected $fillable = [
        'user_id', 'mini_id', 'payment_id','expire_date'
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
