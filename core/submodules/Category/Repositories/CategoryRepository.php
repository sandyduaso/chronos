<?php

namespace Category\Repositories;

use Category\Models\Category;
use Pluma\Support\Repository\Repository;

class CategoryRepository extends Repository
{
    /**
     * The model instance.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model = Category::class;

    /**
     * The Category model type.
     * Used for module specific users.
     *
     * @var string
     */
    protected $categorytype = 'category';

    /**
     * Retrieve the full model instance.
     *
     * @return \Pluma\Models\Model
     */
    public function model()
    {
        return $this->model->type($this->categorytype);
    }

    /**
     * Retrieve the categorytype value.
     * @return string
     */
    public function type()
    {
        return $this->categorytype;
    }

    /**
     * Create model resource.
     *
     * @param array $data
     */
    public function create(array $data)
    {
        $data = array_merge([
            'code' => $data['code'] ?? str_slug($data['name'])
        ], $data);

        return $this->model->create($data);
    }
}
