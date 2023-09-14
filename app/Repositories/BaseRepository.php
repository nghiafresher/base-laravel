<?php

namespace App\Repositories;

use Illuminate\Container\Container as Application;
use Illuminate\Database\Eloquent\Model;


abstract class BaseRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * @var Application
     */
    protected $app;

    /**
     * @param Application $app
     *
     * @throws \Exception
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * Get searchable fields array
     *
     * @return array
     */
    abstract public function getFieldsSearchable();

    /**
     * Configure the Model
     *
     * @return string
     */
    abstract public function model();

    /**
     * Make Model instance
     *
     * @throws \Exception
     *
     * @return Model
     */
    public function makeModel()
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model) {
            throw new \Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->model = $model;
    }

    /**
     * Paginate records for scaffold.
     *
     * @param int $perPage
     * @param array $columns
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($perPage, $columns = ['*'])
    {
        $query = $this->allQuery();

        return $query->paginate($perPage, $columns);
    }

    /**
     * Build a query for retrieving all records.
     *
     * @param array $search
     * @param int|null $skip
     * @param int|null $limit
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function allQuery($search = [], $skip = null, $limit = null)
    {
        $query = $this->model->newQuery();

        if (count($search)) {
            foreach($search as $key => $value) {
                if (in_array($key, $this->getFieldsSearchable())) {
                    $query->where($key, $value);
                }
            }
        }

        if (!is_null($skip)) {
            $query->skip($skip);
        }

        if (!is_null($limit)) {
            $query->limit($limit);
        }

        return $query;
    }

    /**
     * Retrieve all records with given filter criteria
     *
     * @param array $search
     * @param int|null $skip
     * @param int|null $limit
     * @param array $columns
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all($search = [], $skip = null, $limit = null, $columns = ['*'])
    {
        $query = $this->allQuery($search, $skip, $limit);

        return $query->get($columns);
    }

    /**
     * Create model record
     *
     * @param array $input
     *
     * @return Model
     */
    public function create($input)
    {
        $model = $this->model->newInstance($input);

        $model->save();

        return $model;
    }

    /**
     * Find model record for given id
     *
     * @param int $id
     * @param array $columns
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model|null
     */
    public function find($id, $columns = ['*'])
    {
        $query = $this->model->newQuery();

        return $query->find($id, $columns);
    }

    /**
     * Update model record for given id
     *
     * @param array $input
     * @param int $id
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model
     */
    public function update($input, $id)
    {
        $query = $this->model->newQuery();

        $model = $query->findOrFail($id);

        $model->fill($input);

        $model->save();

        return $model;
    }

    /**
     * @param int $id
     *
     * @throws \Exception
     *
     * @return bool|mixed|null
     */
    public function delete($id)
    {
        $query = $this->model->newQuery();

        $model = $query->findOrFail($id);

        return $model->delete();
    }


    /**
     * Get sql query with binding value for debug.
     * @param object $model eloquent object to get data from mysql
     *
     * @return string sql query
     */
    public function getSql($model)
    {
        $replace = function ($sql, $bindings) {
            $needle = '?';
            foreach ($bindings as $replace) {
                $pos = strpos($sql, $needle);
                if ($pos !== false) {
                    $sql = substr_replace($sql, $replace, $pos, strlen($needle));
                }
            }
            return $sql;
        };
        $sql = $replace($model->toSql(), $model->getBindings());
        return $sql;
    }

    /**
     * get user id with email
     * @param string $email
     *
     * @throws \Exception
     * @return int $id
     */
    public function getUserIdWithEmail($email) {
        $query = $this->model->newQuery();

        $model = $query->where('email', $email)->pluck('id')->toArray();

        return $model;
    }

    /**
     * Get list item by input conditions
     *
     * @param array $conditions
     * Condition array format like:
     * $conditions = [
     *          0 => [
     *              'field_name' => fieldName1,
     *              'value'      => value,
     *              'type'       => 'string', // type of field to build where clause
     *          ],
     *          1 => [
     *              'field_name' => fieldName2,
     *              'value'      => value,
     *              'type'       => 'number', // type of field to build where clause
     *          ],
     * ]
     * @param array $relations
     * @param int $perPage
     * @param string $orderedField
     * @param string $typeSort
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getList(
        array $conditions = [],
        array $relations = [],
        int $perPage = DEFAULT_PER_PAGE,
        string $orderedField = '',
        string $typeSort = DESC
    )
    {
        $query = $this->model->newQuery();
        $query->with($relations);
        $tableName = $this->model->getTable();
        foreach ($conditions as $column) {
            $fieldName = $tableName.'.'.$column['field_name'];
            if ($column['type'] == 'string') {
                $query->where($fieldName, 'like', '%' . $column['value'] . '%');
            } else {
                $query->where($fieldName, $column['value']);
            }
        }

        $orderName = $tableName.'.id';
        if ($orderedField) {
            $orderName = $orderedField;
        }
        $query->orderBy($orderName, $typeSort);

        return $query->paginate($perPage);
    }
}
