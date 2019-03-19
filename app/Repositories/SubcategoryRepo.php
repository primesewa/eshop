<?php
/**
 * Created by PhpStorm.
 * User: Prime IT Sewa
 * Date: 3/15/2019
 * Time: 11:27 AM
 */
namespace App\Repositories;
use App\subcategory;

class SubcategoryRepo extends Repository implements SubcategoryInterface
{
    protected $model;
    public function __construct(subcategory $model)
    {
        $this->model = $model;
    }
    public function getsubcategory($id)
    {
        return $subcategory = $this->model->where('main_id','=',$id)->get();
        response()->json(['data'=>$subcategory]);
    }


}
