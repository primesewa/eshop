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
}
