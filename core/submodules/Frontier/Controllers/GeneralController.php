<?php

namespace Frontier\Controllers;

use Frontier\Support\Generic\Interfaces\GenericResourceInterface;
use Illuminate\Http\Request;
use Pluma\Controllers\Controller;

class GeneralController extends Controller implements GenericResourceInterface
{
    const KEY_ONLY_TRASHED = 'only_trashed';
    const KEY_DESCENDING = 'descending';
    const KEY_SEARCH = 'search';
    const KEY_SORT = 'sort';
    const KEY_TAKE = 'take';

    /**
     * Registered authenticatable methods.
     *
     * @var array
     */
    protected $methodsAdmin = [
        'index',
        'show',
        'create',
        'store',
        'edit',
        'update',
        'destroy',
        'delete',
        'trashed',
        'restore',
    ];

    /**
     * Registered public methods.
     *
     * @var array
     */
    protected $methodsPublic = [
        'all',
        'single'
    ];

    /**
     * Registered API methods.
     *
     * @var array
     */
    protected $methodsApi = [
        'getAll',
        'getShow',
        'getCreate',
        'postStore',
        'getEdit',
        'putUpdate',
        'deleteDestroy',
        'deleteDelete',
        'getTrashed',
        'postRestore',
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth.admin')->only($this->methodsAdmin);

        // TODO: implement auth.permissions
        $this->middleware('auth.permissions')->only($this->methodsAdmin);

        // TODO: implement auth:api
        $this->middleware('api')->only($this->methodsApi);

        // $this->middleware('cors')->only($this->methodsApi);
    }

    /**
     * Retrieve list of all resources.
     *
     * @param  Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        //
    }

    /**
     * Retrieve the resource of the given slug.
     *
     * @param  Illuminate\Http\Request $request
     * @param  string $slug
     * @return Illuminate\Http\Response
     */
    public function single(Request $request, $slug = null)
    {
        //
    }
}
