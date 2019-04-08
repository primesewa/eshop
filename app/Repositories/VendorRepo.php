<?php
/**
 * Created by PhpStorm.
 * User: Prime IT Sewa
 * Date: 3/14/2019
 * Time: 1:49 PM
 */
namespace App\Repositories;
use App\Vendor;
class VendorRepo extends Repository implements VendorInterface
{
    protected $model;
    public function __construct(Vendor $model)
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
