<?php

namespace Employee\Controllers;

use Category\Controllers\CategoryController;
use Employee\Repositories\DepartmentRepository;
use Illuminate\Http\Request;

class DepartmentController extends CategoryController
{
    /**
     * The view hintpath.
     *
     * @var string
     */
    protected $hintpath = 'Employee';

    /**
     * The category type of the resource.
     *
     * @var string
     */
    protected $type = 'department';

    /**
     * Inject the resource model to the repository instance.
     *
     */
    public function __construct()
    {
        parent::__construct();

        $this->repository = new DepartmentRepository();
    }
}
