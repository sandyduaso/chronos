<?php

namespace Role\Repositories;

use Illuminate\Database\QueryException;
use Pluma\Support\Repository\Repository;
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
}
