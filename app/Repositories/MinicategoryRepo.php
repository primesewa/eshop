<?php
/**
 * Created by PhpStorm.
 * User: Prime IT Sewa
 * Date: 3/15/2019
 * Time: 11:58 AM
 */
namespace App\Repositories;

use App\minicategory;
class MinicategoryRepo extends Repository implements MinicategoryInterface
{
    protected $model;
    public function __construct(minicategory $model)
    {
        $this->model = $model;
    }

    public function getminicategory($id)
    {
        return $minicategory = $this->model->where('sub_id','=',$id)->get();
        response()->json(['data'=>$minicategory]);
    }
}
