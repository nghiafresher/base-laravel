<?php

namespace App\Services;

use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

abstract class BaseService
{
    /**
     * @var $repository
     */
    protected $repository;

    /**
     * Get status
     *
     * @return  array
     */
    public function statusTypes(): array
    {
        return $this->repository->statusTypes();
    }

    /**
     * Get list.
     *
     * @param   array $conditions
     * @param   array $relations
     * @param   array $relationCounts
     * @param   array $selects
     * @return  Collection
     */
    public function list(array $conditions, array $relations = [], array $relationCounts = [], array $selects = ['*']): Collection
    {
        return $this->repository->queryCollection($conditions, $relations, $relationCounts, $selects);
    }

    /**
     * Get list.
     *
     * @param   array $conditions
     * @param   array $relations
     * @param   array $relationCounts
     * @param   array $selects
     * @return  LengthAwarePaginator
     */
    public function listPaginate(array $conditions, array $relations = [], array $relationCounts = [], array $selects = ['*'])
    : LengthAwarePaginator
    {
        return $this->repository->queryPaginate($conditions, $relations, $relationCounts, $selects);
    }

    /**
     * Create model.
     *
     * @param   array $data
     * @return  Model
     */
    public function create(array $data): Model
    {
        return $this->repository->create($data);
    }

    /**
     * Update model.
     *
     * @param   Model $entity
     * @param   array $data
     * @return  Model
     */
    public function update(Model $entity, array $data = []): Model
    {
        $this->repository->update($entity, $data);

        return $entity;
    }

    /**
     * Delete model.
     *
     * @param   Model $entity
     * @return  boolean|null
     */
    public function destroy(Model $entity): ?bool
    {
        return $this->repository->delete($entity);
    }

    /**
     * Get model detail.
     *
     * @param   Model $entity
     * @param   array $relations
     * @return  Model
     */
    public function show(Model $entity, array $relations = []): Model
    {
        return $this->repository->show($entity, $relations);
    }

    /**
     * Update By ID.
     *
     * @param   int $id
     * @param   array $data
     * @return  Model
     */
    public function updateById(int $id, array $data = []): Model
    {
        return $this->repository->updateById($id, $data);
    }

    /**
     * Update or create model.
     *
     * @param array $condition
     * @param array $data
     * @return Model
     */
    public function updateOrCreate(array $condition = [], array $data = []): Model
    {
        return $this->repository->updateOrCreate($condition, $data);
    }

    /**
     * Synchro model relation with data.
     *
     * @param   Model $entity
     * @param   mixed $relation
     * @param   array $data
     * @return void
     */
    public function sync(Model $entity, $relation, array $data = [])
    {
        $this->repository->sync($entity, $relation, $data);
    }

    /**
     * Insert multiple values.
     *
     * @param   mixed $data
     * @return  integer
     */
    public function insert($data): int
    {
        return $this->repository->insert($data);
    }

    /**
     * Find model by id.
     *
     * @param   mixed $id
     * @param   array $relations
     * @return  Model
     */
    public function findOrFail($id, array $relations = []): Model
    {
        return $this->repository->findOrFail($id, $relations);
    }

    /**
     * Find model by id.
     *
     * @param   mixed $id
     * @param   array $relations
     *
     * @return  Model|null
     */
    public function find($id, array $relations = []): ?Model
    {
        return $this->repository->find($id, $relations);
    }

    /**
     * Find many model by id.
     *
     * @param   array $ids
     * @param   array $relations
     *
     * @return  Collection
     */
    public function findMany(array $ids, array $relations = []): Collection
    {
        return $this->repository->findMany($ids, $relations);
    }

    /**
     * Find by condition .
     *
     * @param   mixed $condition
     * @param   array $relations
     *
     * @return  object $entities
     */
    public function findByCondition($condition, array $relations = []): object
    {
        return $this->repository->findByCondition($condition, $relations);
    }

    /**
     * Get model's fillable attribute.
     *
     * @return  array
     */
    public function getFillable(): array
    {
        return $this->repository->getFillable();
    }

    /**
     * Batch update.
     *
     * @param   array $condition
     * @param   array $data
     * @return  mixed
     */
    public function batchUpdate(array $condition, array $data)
    {
        return $this->repository->batchUpdate($condition, $data);
    }

    /**
     * Check Duplicate Data
     *
     * @param mixed $data
     * @param string $column
     * @param mixed $model
     * @return  boolean
     */
    public function checkDuplicateData($data, string $column, $model): bool
    {
        $exitsData = $model->where($column, $data)->exists();

        // check case update
        if ((array) $model) {
            return !($model->$column === $data || !$exitsData);
        }
        return $exitsData;
    }
}
