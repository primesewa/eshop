<?php
/**
 * Created by PhpStorm.
 * User: Prime IT Sewa
 * Date: 3/14/2019
 * Time: 3:17 PM
 */
namespace App\Repositories;

interface MinicategoryInterface{
    public  function all();
    public function create(array $data);
    public function update(array  $data, $id);
    public  function delete($id);
    public function find($id);
    public function show($id);
    public function getminicategory($id);
    public  function paginate($perpage =10, $column= array('*'));
}
