<?php

namespace App\Business;

use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserBusiness extends BaseBusiness
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
     * @param $inputs
     * @param $id
     * @return false|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model
     */
    public function updateUser($inputs, $id)
    {
        try {
            DB::beginTransaction();
            $user = $this->repository->find($id);
            if(!$user) {
                return false;
            }
            $dataUpdate = [
                'name' => $inputs['name'],
                'email' => $inputs['email'],
                'phone' => $inputs['phone'],
            ];
            if(!empty($inputs['password'])) {
                $dataUpdate['password'] = bcrypt($inputs['password']);
            }
            $updated = $this->repository->update($dataUpdate, $id);
            DB::commit();

            return $updated;
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollBack();
            return false;
        }
    }
}
