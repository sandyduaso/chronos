<?php

namespace Role\Controllers;

use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
use Role\Models\Permission;
use Role\Repositories\PermissionRepository;

class PermissionController extends AdminController
{
    use Resources\PermissionResourceAdminTrait;

    /**
     * Inject the resource model to the repository instance.
     *
     * @param \Pluma\Models\Model $model
     */
    public function __construct()
    {
        $this->repository = new PermissionRepository();

        parent::__construct();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("Theme::permissions.create");
    }
}
