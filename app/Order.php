<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'library', 'payment_id','expire_date'
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
