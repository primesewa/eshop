<?php
/**
 * Created by PhpStorm.
 * User: Prime IT Sewa
 * Date: 3/13/2019
 * Time: 1:34 PM
 */
namespace App\Repositories;

interface OrderInterface{

    public function create($user_id,$library,$payment_id);
    public  function delete($id);

}
