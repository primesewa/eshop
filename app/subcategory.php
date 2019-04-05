<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class subcategory extends Model
{
    protected $table ='subcategories';

    protected $fillable = [
        'sub_category',
        'main_id','confirmed','price','expire_date'
    ];
    public function minicategory()
    {
        return $this->hasMany('App\minicategory','sub_id','id');
    }
    public function maincategory()
    {
        return $this->belongsTo('App\maincategory');
    }
    public function book()
    {
        return $this->belongsTo('App\Book');
    }

}
