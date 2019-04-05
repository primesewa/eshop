<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contactinfo extends Model
{
    protected $table ='contactinfos';

    protected $fillable = [ 'address','introduction', 'phonenumber', 'email', 'name', 'facebook', 'twitter', 'gmail', 'youtube', 'linkedin', 'about_us', 'office_info'];


}
