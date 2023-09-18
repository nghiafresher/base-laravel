<?php

namespace App\Repositories;

use App\Models\Permission;
class PermissionRepository extends BaseRepository
{
    public function __construct(Permission $permission)
    {
        $this->model = $permission;
    }

    public function getListData($inputs)
    {
        return $this->query($inputs)->paginate(DEFAULT_PER_PAGE);
    }

    public function getGroupPermissionData()
    {
        return $this->query()->get()->groupBy('model_name');
    }
}
