<?php
namespace App\Repositories;

use App\Role;
class RoleRepository extends Repository implements RoleInterface
{
    protected $model;
    public function __construct(Role $model)
    {
        $this->model = $model;
    }
    public  function conformed($id)
    {
        try {
            $main = $this->model->find($id);
            if($main->confirmed == 0)
            {
                return $main->update([
                    'confirmed' => 1,
                ]);

            }
            else
            {

                return  $main->update([
                    'confirmed'=> 0,
                ]);
            }

        }

        catch(Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());
        }



    }
}
