<?php

namespace Pluma\Support\Repository;

class Repository implements RepositoryInterface
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
     * Constructor to bind model to a repository.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     */
    public function __construct($model = null)
    {
        $this->model = $model ?? new $this->model;
    }

    /**
     * Retrieve the full model instance.
     *
     * @return \Pluma\Models\Model
     */
    public function model()
    {
        return $this->model;
    }

    /**
     * Bind the resource model statically.
     *
     * @param mixed $model
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
        $resources = $this->model
            ->onlyTrashed()
            ->whereIn('id', $id)
            ->get();

        $resources->each(function ($resource) {
            $resource->forceDelete();
        });
    }

    /**
     * Soft delete model resource.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        return $this->model->destroy($id);
    }

    /**
     * Restore model resource.
     *
     * @param mixed $id
     */
    public function restore($id)
    {
        $resources = $this->model
            ->onlyTrashed()
            ->whereIn('id', $id)
            ->get();

        $resources->each(function ($resource) {
            $resource->restore();
        });
    }

    /**
     * Get the model with relation.
     *
     * @param string $relation
     * @return \Pluma\Models\Model
     */
    public function with($relation)
    {
        return $this->model->with($relation);
    }

    /**
     * Get the search params.
     *
     * @param array $params
     * @return \Pluma\Models\Model
     */
    public function search($params)
    {
        $this->model = $this->model()->search($params);

        return $this;
    }

    /**
     * Retrieve only trashed resources.
     *
     * @return \Pluma\Models\Model
     */
    public function onlyTrashed()
    {
        $this->model = $this->model->onlyTrashed();

        return $this;
    }

    /**
     * Get the paginated result.
     *
     * @return \Pluma\Models\Model
     */
    public function paginate()
    {
        if (is_null(request()->get('per_page')) && is_null(request()->get('page'))) {
            $this->model = $this->model()->paginate();
            $this->model = $this->model->appends('per_page', $this->model->perPage());
            return $this->model;
        }

        if (request()->get('per_page') !== null && request()->get('per_page') <= 0) {
            return $this->model()->paginate($this->model()->count());
        }

        $perPage = ! request()->get('per_page')
            ? $this->model()->count()
            : request()->get('per_page');

        $this->model = $this->model()->paginate($perPage);
        $this->model->appends('per_page', $perPage);

        return $this->model;
    }
}
