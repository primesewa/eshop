<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['Title', 'Description', 'Author', 'Categories', 'Main_price', 'Image', 'Discount_price', 'file', 'main_id', 'sub_id', 'mini_id'];


    public function maincategory()
    {
        return $this->belongsTo('App\maincategory', 'main_id', 'id');
    }

    public function subcategory()
    {
        return $this->belongsTo('App\subcategory', 'sub_id', 'id');
    }

    public function minicategory()
    {
        return $this->belongsTo('App\minicategory', 'mini_id', 'id');
    }

}
