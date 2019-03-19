<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class book_homesection extends Model
{
    protected $table ='book_homesections';
    protected $fillable = ['position', 'book_id','homesection_id' ];

}
