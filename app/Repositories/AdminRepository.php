<?php
/**
 * Created by PhpStorm.
 * User: Prime IT Sewa
 * Date: 3/14/2019
 * Time: 1:49 PM
 */
namespace App\Repositories;
use App\Admin;
class AdminRepository extends Repository implements AdminInterface
{
    protected $model;
    public function __construct(Admin $model)
    {
        $this->model = $model;
    }


}
