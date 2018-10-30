<?php

namespace Role\Repositories;

use Illuminate\Database\QueryException;
use Pluma\Support\Repository\Repository;
use Role\Models\Permission;
use Role\Models\Role;

class RoleRepository extends Repository
{
    /**
     * The model instance.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model = Role::class;

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
            'permissions' => 'required|array',
        ];
    }

    /**
     * Array of custom error messages upon validation.
     *
     * @return array
     */
    public static function messages()
    {
        return [
            'code.regex' => 'Only letters, numbers, spaces, and hypens are allowed.',
            'description.regex' => 'Only letters, spaces, and hypens are allowed.',
        ];
    }

    /**
     * Retrieve the grouped permissions.
     *
     * @return \Illuminate\Support\Collection
     */
    public function permissions()
    {
        return Permission::all()->groupBy('group');
    }

    /**
     * Create model resource.
     *
     * @param array $data
     * return \Role\Models\Role
     */
    public function create(array $data)
    {
        $resource = $this->model()->create($data);
        $resource->permissions()->attach($data['permissions']);

        return $resource;
    }
}
