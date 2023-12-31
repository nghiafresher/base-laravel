<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserService extends BaseService
{
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get list user
     *
     * @param array $inputs
     * @return mixed
     */
    public function getListUser(array $inputs)
    {
        return $this->repository->getListUser($inputs);
    }

    /**
     * Store user
     *
     * @param array $inputs
     * @return false|Model
     */
    public function storeUser(array $inputs)
    {
        try {
            DB::beginTransaction();
            $user = $this->repository->create($inputs);
            DB::commit();
            return $user;
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollBack();
            return false;
        }
    }

    /**
     * Find by id
     *
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model|mixed|null
     */
    public function findById($id)
    {
        return $this->repository->find($id);
    }

    /**
     * Update user
     *
     * @param $user
     * @param $inputs
     * @return false|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model
     */
    public function updateUser($user, $inputs)
    {
        try {
            DB::beginTransaction();
            $dataUpdate = [
                'name' => $inputs['name'],
                'email' => $inputs['email'],
                'phone' => $inputs['phone'],
            ];
            if (!empty($inputs['password'])) {
                $dataUpdate['password'] = bcrypt($inputs['password']);
            }
            $model = $this->repository->update($user, $dataUpdate);
            if ($model) {
                $model->roles()->detach();
                if (isset($inputs['role_ids']) && count($inputs['role_ids']) > 0) {
                    $model->roles()->attach($inputs['role_ids']);
                }
            }
            DB::commit();

            return $model;
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollBack();
            return false;
        }
    }
}
