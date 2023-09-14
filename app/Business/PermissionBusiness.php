<?php
namespace App\Business;

use App\Repositories\PermissionRepository;

class PermissionBusiness extends BaseBusiness
{
    protected $repository;
    public function __construct(PermissionRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getListData(array $inputs)
    {
        return $this->repository->getList($inputs);
    }

    /**
     * Find by id
     *
     * @param integer $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed|null
     */
    public function findById($id)
    {
        return $this->repository->find($id);
    }
}
