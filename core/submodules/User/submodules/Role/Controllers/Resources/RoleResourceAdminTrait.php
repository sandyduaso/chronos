<?php

namespace Role\Controllers\Resources;

use Blacksmith\Support\Facades\Blacksmith;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

trait RoleResourceAdminTrait
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $resources = $this->repository
            ->search($request->all())
            ->paginate();

        return view('Theme::admin.index')->with([
            'resources' => $resources,
            'actions' => false,
            'buttons' => [
                'primary' => [
                    'icon' => 'fe fe-plus',
                    'text' => __('New Role'),
                    'url' => route('roles.create'),
                ],
            ],
            'label' => [
                'singular' => __('Role'),
                'plural' => __('Roles'),
            ],
            'text' => [
                'singular' => 'role',
                'plural' => 'roles',
            ],
            'table' => [
                'body' => [
                    'name', 'code', 'description', 'created',
                ],
                'head' => [
                    [
                        'label' => __('Name'),
                        'column' => 'name',
                        'class' => 'pl-5',
                        'colspan' => 1,
                        'sortable' => true,
                    ],
                    [
                        'label' => __('Code'),
                        'column' => 'code',
                        'class' => '',
                        'colspan' => 1,
                        'sortable' => true,
                    ],
                    [
                        'label' => __('Description'),
                        'column' => 'description',
                        'class' => '',
                        'colspan' => 1,
                        'sortable' => false,
                    ],
                    [
                        'label' => __('Date Added'),
                        'column' => 'created_at',
                        'class' => '',
                        'colspan' => 1,
                        'sortable' => true,
                    ],
                ]
            ],
        ]);
    }
}
