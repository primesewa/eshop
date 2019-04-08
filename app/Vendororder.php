<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendororder extends Model
{
    protected $fillable = [
        'user_id', 'vendor', 'payment_id','expire_date','vendor_id'
    ];
}
