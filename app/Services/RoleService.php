<?php

namespace App\Services;

use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RoleService extends BaseService
{
    protected $repository;
    protected $permissionRepository;
    public function __construct(
        RoleRepository $repository,
        PermissionRepository $permissionRepository
    ){
        $this->repository = $repository;
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * Get list data
     *
     * @param array $inputs
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getListData(array $inputs)
    {
        return $this->repository->getListData($inputs);
    }

    /**
     * Store role
     *
     * @param array $inputs
     * @return false| Model
     */
    public function storeRole(array $inputs)
    {
        try {
            DB::beginTransaction();
            $role = $this->repository->create([
                'name' => $inputs['name'],
                'display_name' => $inputs['display_name'],
                'description' => $inputs['description'],
            ]);
            if($role) {
                if(isset($inputs['permission_ids']) && count($inputs['permission_ids']) > 0) {
                    $role->permissions()->attach($inputs['permission_ids']);
                }
            }
            DB::commit();
            return $role;
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e);
        }
        return false;
    }

    /**
     * Update role
     *
     * @param array $inputs
     * @return false| Model
     */
    public function updateRole($role, array $inputs)
    {
        try {
            DB::beginTransaction();
            $role = $this->repository->update($role, $inputs);
            if($role) {
                $role->permissions()->detach();
                if(isset($inputs['permission_ids']) && count($inputs['permission_ids']) > 0) {
                    $role->permissions()->attach($inputs['permission_ids']);
                }
            }
            DB::commit();
            return $role;

        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e);
        }
        return false;
    }

}
