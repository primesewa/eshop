<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = ['Title','Description','tag','expire_date', 'Author', 'Categories', 'Main_price', 'Image', 'Discount_price', 'file', 'main_id', 'sub_id', 'mini_id','currency','feature'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function maincategory()
    {
        return $this->hasOne('App\maincategory', 'id', 'main_id');
    }

    public function subcategory()
    {
        return $this->hasOne('App\subcategory', 'id', 'sub_id');
    }

    public function minicategory()
    {
        return $this->hasOne('App\minicategory', 'id', 'mini_id');
    }
}
