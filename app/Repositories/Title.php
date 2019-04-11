<?php
namespace App\Repositories;
use Illuminate\Support\Facades\Config;
use App\Htitle;
trait Title{
    public $data = [];
    public function data($key,$value=NULL)
    {
        if (empty($key)) return false;
        return $this->data[$key] = $value;
    }
    public function make_title($page_name,$seprate = '::',$project_name = null)
    {
        $title = Htitle::all()->take(1);
        foreach ($title as $t)
    {
        return $t->title.$seprate.$page_name;
    }


    }
}
