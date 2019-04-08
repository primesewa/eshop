<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class minicategory extends Model
{
    protected $table ='minicategories';

    protected $fillable = [
        'mini_category',
        'sub_id','confirmed','price','expire_date','currency'
    ];
    public function subcategory()
    {
        return $this->belongsTo('App\subcategory');
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
