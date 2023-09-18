<?php

namespace App\Repositories;

use App\Models\Role;

class RoleRepository extends BaseRepository
{
    public function __construct(Role $role)
    {
        $this->model = $role;
    }

    public function getListData(array $inputs)
    {
        return $this->query($inputs)->paginate(DEFAULT_PER_PAGE);
    }

}
