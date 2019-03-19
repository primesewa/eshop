<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class homesection extends Model
{
    protected $table ='homesections';

    protected $fillable = ['title', 'description','position' ];

    public function book()
    {
        return $this->hasMany('App\Book');
    }

}
