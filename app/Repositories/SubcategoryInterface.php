<?php
/**
 * Created by PhpStorm.
 * User: Prime IT Sewa
 * Date: 3/13/2019
 * Time: 1:34 PM
 */
namespace App\Repositories;

interface SubcategoryInterface{
    public  function all();
    public function create(array $data);
    public function update(array  $data, $id);
    public  function delete($id);
    public function find($id);
    public function show($id);
    public function conformed($id);
    public function getsubcategory($id);
   // public function subcategory();//get all sub category with ststus 0
    public  function paginate($perpage =10, $column= array('*'));

}
