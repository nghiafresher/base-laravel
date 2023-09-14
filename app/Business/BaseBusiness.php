<?php

namespace App\Business;

/**
 * Class BaseBusiness
 * @package App\Business
 */
class BaseBusiness
{
    protected $repository;

    /**
     * BaseBusiness constructor.
     * @param $repository
     */
    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    /**
     * Create
     *
     * @param $input
     * @return mixed
     */
    public function create($input)
    {
        return $this->repository->create($input);
    }

    /**
     * Find by Id
     *
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return $this->repository->getById($id);
    }

    /**
     * Update
     *
     * @param $id
     * @param $input
     * @return mixed
     */
    public function update($id, $input)
    {
        return $this->repository->updateById($id, $input);
    }

    /**
     * Delete
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->repository->deleteById($id);
    }

    /**
     * Get all
     *
     * @param array $search
     * @param null $skip
     * @param null $limit
     * @param string[] $columns
     * @return mixed
     */
    public function all($search = [], $skip = null, $limit = null, $columns = ['*'])
    {
        return $this->repository->all($search, $skip, $limit, $columns);
    }

    public function getList(
        array $conditions = [],
        array $relations = [],
        int $perPage = DEFAULT_PER_PAGE,
        string $orderedField = '',
        string $typeSort = DESC
    ){
        return $this->repository->getList($conditions, $relations, $perPage, $orderedField, $typeSort);
    }


}
