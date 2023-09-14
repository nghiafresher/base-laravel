<?php

namespace App\Repositories;

use App\Models\Permission;
class PermissionRepository extends BaseRepository
{

    public function getFieldsSearchable()
    {
        // TODO: Implement getFieldsSearchable() method.
    }
    /**
     * Model
     *
     * @return string
     */
    public function model()
    {
        return Permission::class;
    }
}
