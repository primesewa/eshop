<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userpic extends Model
{

    protected $fillable = [
        'image','user_id'
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
