<?php

namespace Frontier\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Pluma\Controllers\Controller as BaseController;
use Pluma\Support\Auth\Access\Traits\AuthorizesRequests;
use Pluma\Support\Bus\Traits\DispatchesJobs;
use Pluma\Support\Validation\Traits\ValidatesRequests;

class AdminController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->middleware('web');
        $this->middleware('auth.admin');
        $this->middleware('permissions');
    }
}
