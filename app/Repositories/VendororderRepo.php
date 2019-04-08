<?php
/**
 * Created by PhpStorm.
 * User: Prime IT Sewa
 * Date: 3/14/2019
 * Time: 1:49 PM
 */
namespace App\Repositories;
use App\Vendororder;
class VendororderRepo extends Repository implements VendororderInterface
{
    protected $model;
    public function __construct(Vendororder $model)
    {
        $this->model = $model;
    }
    public function update(array $data,$id)
    {
        try {
            $result= $this->model->find($id);
            return $result->update($data);
        }


        catch(Exception $e) {
            return redirect()->route('user.profile')->with('error',$e->getMessage());
        }


    }


}
