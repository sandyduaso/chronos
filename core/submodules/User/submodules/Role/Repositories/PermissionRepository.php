<?php

namespace Role\Repositories;

use Illuminate\Database\QueryException;
use Pluma\Support\Repository\Repository;
use Role\Models\Permission;

class PermissionRepository extends Repository
{
    /**
     * The model instance.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model = Permission::class;

    /**
     * Set of rules the model should be validated against when
     * storing or updating a resource.
     *
     * @return array
     */
    public static function rules()
    {
        return [
            'name' => 'required|max:255',
            'code' => 'required|max:255',
            'group' => 'sometimes|required',
        ];
    }

    /**
     * Array of custom error messages upon validation.
     *
     * @return array
     */
    public static function messages()
    {
        return [];
    }

    /**
     * Retrieve the seeds array.
     *
     * @return array
     */
    public function seeds()
    {
        return $this->model->seeds();
    }

    /**
     * Create model resource.
     *
     * @param array $data
     */
    public function create(array $data)
    {
        $permission = $this->model->updateOrCreate(
            ['code' => $data['code']],
            collect($data)->only(['name', 'code', 'description', 'group'])
        );

        return $permission;
    }
}
