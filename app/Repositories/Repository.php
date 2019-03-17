<?php
namespace App\Repositories;
abstract class Repository{

    public function all()
    {
        return $this->model->all();
    }
    public  function paginate($perpage =10, $column= array('*'))
    {
        return $this->model->paginate($perpage,$column);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function  find($id)
    {
        return $this->model->find($id);
    }
    public function show($id)
    {
        return $this->model->findorfail($id);
    }

    public  function delete($id)
    {
        $result= $this->model->find($id);
        return $result::destroy($id);
    }
    public function update(array $data,$id)
    {

        $result= $this->model->find($id);
        return $result->update($data);
    }
}

?>

