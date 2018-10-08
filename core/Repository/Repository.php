<?php

namespace Pluma\Repository;

use Illuminate\Database\Eloquent\Model;
use Pluma\Repository\Contracts\RepositoryInterface;
use Pluma\Repository\Criteria\Criteria;

abstract class Repository implements RepositoryInterface
{
    /**
     * The property on class instances.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * The static id of the resource.
     *
     * @var int
     */
    protected static $id;

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    abstract function model();

    /**
     * Constructor to bind model to a repository.
     *
     */
    public function __construct()
    {
        $this->model = $this->model();
    }

    /**
     * Bind the resource model statically.
     *
     * @param int $id
     * @return self
     */
    public static function bind($id)
    {
        $instance = new static;
        $model = new $instance->model;
        $resource = $model->find($id);

        self::$id = $id;

        $instance->model = $resource ?? $model;

        return $instance;
    }

    /**
     * Search the model.
     *
     * @param  array $parameters
     * @return self
     */
    public function search($parameters = [])
    {
        $this->model = $this->model->search($parameters);

        return $this;
    }

    /**
     * Order the model.
     *
     * @param  string $column
     * @param  string $sort
     * @return self
     */
    public function order($column = 'id', $sort = 'ASC')
    {
        $column = $column ?? 'id';
        $sort = $sort ?? 'ASC';

        $this->model = $this->model->orderBy($column, $sort);

        return $this;
    }

    /**
     * Returns a paginated instance of the model.
     *
     * @param  int $count
     * @param  int $page
     * @return self
     */
    public function paginate($count = 0, $page = 1)
    {
        $count = $count <= 0 ? $this->model->count() : $count;

        return $this->model->paginate($count, ['*'], 'page', $page);
    }

    /**
     * Retrieve all instances of model.
     *
     * @return mixed
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Create model resource.
     *
     * @param array $data
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Update model resource.
     *
     * @param array  $data
     * @param int $id
     */
    public function update(array $data, $id)
    {
        return $this->model->update($data, $id);
    }

    /**
     * Retrieve model resource details.
     *
     * @param int $id
     */
    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Permanently delete model resource.
     *
     * @param int $id
     */
    public function delete($id)
    {
        return $this->model->forceDelete($id);
    }

    /**
     * Soft delete model resource.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        return $this->model->delete($id);
    }

    /**
     * Restore model resource.
     *
     * @param int $id
     */
    public function restore($id)
    {
        return $this->model->restore($id);
    }
}
