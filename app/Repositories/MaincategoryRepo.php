<?php
/**
 * Created by PhpStorm.
 * User: Prime IT Sewa
 * Date: 3/14/2019
 * Time: 1:49 PM
 */
namespace App\Repositories;
use App\maincategory;
class MaincategoryRepo extends Repository implements MaincategoryInterface
{
    protected $model;
    public function __construct(maincategory $model)
    {
        $this->model = $model;
    }


}
