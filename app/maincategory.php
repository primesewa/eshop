<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class maincategory extends Model
{
    protected $table='maincategories';

    protected $fillable = [
        'main_category','position','confirmed'
    ];

    public function subcategory()
    {
          return $this->hasMany('App\subcategory','main_id','id');
    }


    public function book()
    {
        return $this->belongsTo('App\Book');
    }
}
