<?php

namespace Employee\Repositories;

use Category\Repositories\CategoryRepository;
use Employee\Models\Department;
use User\Models\User;
use User\Repositories\UserRepository;

class DepartmentRepository extends CategoryRepository
{
    /**
     * The model instance.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model = Department::class;

    /**
     * The User model type.
     * Used for module specific users.
     *
     * @var string
     */
    protected $categorytype = 'department';
}
