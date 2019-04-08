<?php
/**
 * Created by PhpStorm.
 * User: Prime IT Sewa
 * Date: 3/13/2019
 * Time: 1:34 PM
 */
namespace App\Repositories;

interface UserInterface{
    public function update(array  $data, $id);
}
