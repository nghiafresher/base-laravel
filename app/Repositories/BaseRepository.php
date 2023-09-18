<?php

namespace App\Repositories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

abstract class BaseRepository
{
    const PAGINATE = 10;
    /**
     * @var     Model
     */
    protected $model;

    /**
     * Get status
     *
     * @return  array
     */
    public function statusTypes(): array
    {
        return [];
    }

    /**
     * Get query model.
     *
     * @param   array $params
     * @param   array $relations
     * @param   array $relationCounts
     * @param   array $selectable
     * @return  Builder
     */
    public function query(array $params = [], array $relations = [], array $relationCounts = [], array $selectable = ['*']): Builder
    {
        $params = collect($params);

        // Select list column
        $entities = $this->model->select(!empty($selectable) ? $selectable : ($this->model->selectable ?? ['*']));

        // Load relation counts
        if (count($relationCounts)) {
            $entities = $entities->withCount($relationCounts);
        }

        // Load relations
        if (count($relations)) {
            $entities = $entities->with($relations);
        }

        // Filter list by condition
        if (count($params) && method_exists($this, 'mergeQuery')) {
            foreach ($params as $key => $value) {
                if ($value != null) {
                    $entities = $this->mergeQuery($entities, $key, $value);
                }
            }
        }

        // Order list
        $orderBy = $this->model->getKeyName();
        if ($params->has('sort')) {
            if (!empty($this->model->sortable) && in_array($params['sort'], $this->model->sortable)) {
                $orderBy = $params['sort'];
            } else {
                $fields = DB::getSchemaBuilder()->getColumnListing($this->model->getTable());
                if (in_array($params['sort'], $fields)) {
                    $orderBy = $params['sort'];
                }
            }
        }

        return $entities->orderBy($orderBy, $params->has('sortType') && $params['sortType'] == SORT_TYPE_ASC ? SORT_TYPE_ASC : SORT_TYPE_DESC);
    }

    /**
     * Get query model.
     *
     * @param   array $params
     * @param   array $relations
     * @param   array $relationCounts
     * @param   array $selectable
     * @return  Collection
     */
    public function queryCollection(array $params, array $relations = [], array $relationCounts = [], array $selectable = ['*']): Collection
    {
        return $this->query($params, $relations, $relationCounts, $selectable)->get();
    }

    /**
     * Get query model.
     *
     * @param   array $params
     * @param   array $relations
     * @param   array $relationCounts
     * @param   array $selectable
     * @return  LengthAwarePaginator
     */
    public function queryPaginate(array $params, array $relations = [], array $relationCounts = [], array $selectable = ['*']): LengthAwarePaginator
    {
        // Limit result
        $limit = $params['limit'] ?? self::PAGINATE;

        return $this->query($params, $relations, $relationCounts, $selectable)->paginate($limit);
    }

    /**
     * Create model.
     *
     * @param   array $data
     * @return  Model
     */
    public function create(array $data = []): Model
    {
        return $this->model->create($data);
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
        if (count($relations)) {
            return $entity->load($relations);
        }

        return $entity;
    }

    /**
     * Update model.
     *
     * @param   Model $entity
     * @param   array $data
     *
     * @return  Model
     */
    public function update(Model $entity, array $data = []): Model
    {
        $entity->update($data);

        return $entity;
    }

    /**
     * Update By ID.
     *
     * @param   int $id
     * @param   array $data
     *
     * @return  Model
     */
    public function updateById(int $id, array $data = []): Model
    {
        return $this->model->updateOrCreate([
            'id' => $id,
        ], $data);
    }

    /**
     * Update or create model.
     *
     * @param   array $condition
     * @param   array $data
     * @return  Model
     */
    public function updateOrCreate(array $condition = [], array $data = []): Model
    {
        return $this->model->updateOrCreate($condition, $data);
    }

    /**
     * Delete model.
     *
     * @param   Model $entity
     * @return  boolean|null
     */
    public function delete(Model $entity): ?bool
    {
        return $entity->delete();
    }

    /**
     * Synchro model relation with data.
     *
     * @param   Model $entity
     * @param   mixed $relation
     * @param   array $data
     * @return  void
     */
    public function sync(Model $entity, $relation, array $data = []): void
    {
        $entity->$relation()->sync($data);
    }

    /**
     * Insert multiple values.
     *
     * @param   mixed $data
     * @return  integer
     */
    public function insert($data): int
    {
        $data = array_map(function ($item) {
            $item['created_at'] = Carbon::now()->format('Y-m-d H:i:s');
            $item['updated_at'] = Carbon::now()->format('Y-m-d H:i:s');

            return $item;
        }, $data);

        return $this->model->insert($data);
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
        $entity = $this->model->findOrFail($id);

        if (count($relations)) {
            return $entity->load($relations);
        }

        return $entity;
    }

    /**
     * Find model by id.
     *
     * @param   mixed $id
     * @param   array $relations
     * @return  Model|null
     */
    public function find($id, array $relations = []): ?Model
    {
        $entity = $this->model->find($id);

        if (count($relations)) {
            return $entity->load($relations);
        }

        return $entity;
    }

    /**
     * Find many model by id.
     *
     * @param   array $ids
     * @param   array $relations
     * @return  Collection
     */
    public function findMany(array $ids, array $relations = []): Collection
    {
        $entity = $this->model->findMany($ids);

        if (count($relations)) {
            return $entity->load($relations);
        }

        return $entity;
    }

    /**
     * Find by condition .
     *
     * @param   mixed $condition
     * @param   array $relations
     *
     * @return  object
     */
    public function findByCondition($condition, array $relations = [], array $select = []): object
    {
        $entities = $this->model->select(count($select) ? $select : ($this->model->selectable ?? '*'));

        if (count($relations)) {
            // If there is where has
            if (isset($relations['whereHas']) && count($relations['whereHas'])) {
                foreach ($relations['whereHas'] as $key => $item) {
                    $entities->wherehas($key, $item);
                }

                unset($relations['whereHas']);
            }

            // If there is or where has
            if (isset($relations['orWhereHas']) && count($relations['orWhereHas'])) {
                foreach ($relations['orWhereHas'] as $key => $item) {
                    $entities->orWhereHas($key, $item);
                }
                unset($relations['orWhereHas']);
            }

            $entities = $entities->with($relations);
        }
        if (count($condition)) {
            foreach ($condition as $key => $value) {
                $entities = $this->mergeQuery($entities, $key, $value);
            }
        }

        return $entities;
    }

    /**
     * Get model's fillable attribute.
     *
     * @return  array
     */
    public function getFillable(): array
    {
        return $this->model->getFillable();
    }

    /**
     * Batch update.
     *
     * @param array $condition
     * @param array $data
     * @return mixed
     */
    public function batchUpdate(array $condition, array $data): mixed
    {
        $model = $this->model;
        if (count($condition) && method_exists($this, 'mergeQuery')) {
            foreach ($condition as $key => $value) {
                $model = $this->mergeQuery($model, $key, $value);
            }
        }

        return $model->update($data);
    }
}
