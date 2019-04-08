<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategoryorder extends Model
{
    protected $fillable = [
        'user_id', 'sub_id', 'payment_id','expire_date'
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function subcategory()
    {
        return $this->belongsTo('App\subcategory');
    }




}
