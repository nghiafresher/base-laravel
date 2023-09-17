<?php

namespace App\Repositories;

use App\Models\Permission;

class RoleRepository extends BaseRepository
{
    public function __construct(Role $role)
    {
        $this->model = $role;
    }

}
