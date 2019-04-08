<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class subcategory extends Model
{
    protected $table ='subcategories';

    protected $fillable = [
        'sub_category',
        'main_id','confirmed','price','expire_date','currency'
    ];
    public function minicategory()
    {
        return $this->hasMany('App\minicategory','sub_id','id');
    }

    public function suborder()
    {
        return $this->hasMany('App\Subcategoryorder','sub_id','id');
    }

    public function maincategory()
    {
        return $this->belongsTo('App\maincategory');
    }
    public function book()
    {
        return $this->belongsTo('App\Book');
    }
    public function vendor()
    {
        return $this->belongsTo('App\Vendor');
    }

}
