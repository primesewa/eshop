<?php
/**
 * Created by PhpStorm.
 * User: Prime IT Sewa
 * Date: 3/13/2019
 * Time: 1:34 PM
 */
namespace App\Repositories;

interface MaincategoryInterface{
    public  function all();
    public function create(array $data);
    public function update(array  $data, $id);
    public  function delete($id);
    public function find($id);
    public function show($id);
    public  function paginate($perpage =10, $column= array('*'));

}
