<?php
namespace App\Repositories;
use Illuminate\Support\Facades\Config;
trait Title{
    public $data = [];
    public function data($key,$value=NULL)
    {
        if (empty($key)) return false;
        return $this->data[$key] = $value;
    }
    public function make_title($page_name,$seprate = '::',$project_name = null)
    {
        if(!isset($project_name))
        {
            $project_name = Config::get('title.name');;
        }
        return $project_name.$seprate.$page_name;
    }
}
