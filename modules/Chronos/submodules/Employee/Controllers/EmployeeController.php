<?php

namespace Employee\Controllers;

use Employee\Repositories\EmployeeRepository;
use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
use User\Models\User;

class EmployeeController extends AdminController
{
    use Resources\EmployeeAdminResourceTrait;

    /**
     * The constructor of the controller.
     *
     * @return void
     */
    public function __construct()
    {
        $this->repository = new EmployeeRepository();

        parent::__construct();
    }
}
