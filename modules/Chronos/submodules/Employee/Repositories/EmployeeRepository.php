<?php

namespace Employee\Repositories;

use Pluma\Support\Repository\Repository;
use User\Models\User;
use User\Repositories\UserRepository;

class EmployeeRepository extends UserRepository
{
    /**
     * The model instance.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model = User::class;

    /**
     * The User model type.
     * Used for module specific users.
     *
     * @var string
     */
    protected $usertype = 'employee';
}
