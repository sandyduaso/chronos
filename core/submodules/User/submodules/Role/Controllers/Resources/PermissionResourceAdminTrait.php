<?php

namespace Role\Controllers\Resources;

use Blacksmith\Support\Facades\Blacksmith;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

trait PermissionResourceAdminTrait
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
                    'icon' => 'fe fe-refresh-ccw',
                    'text' => __('Refresh Permissions'),
                    'url' => route('permissions.edit'),
                ],
            ],
            'label' => [
              'singular' => __('Permission'),
              'plural' => __('Permissions'),
            ],
            'text' => [
              'singular' => 'permission',
              'plural' => 'permissions',
            ],
            'table' => [
              'body' => [
                'name', 'code', 'description', 'group', 'created',
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
                  'label' => __('Group'),
                  'column' => 'group',
                  'class' => '',
                  'colspan' => 1,
                  'sortable' => true,
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Illuminate\Http\Request $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        return view('Theme::permissions.refresh');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function refresh(Request $request)
    {
        foreach ($this->repository->seeds() as $permission) {
            $this->repository->model()->updateOrCreate(
                ['code' => $permission['code']],
                $permission
            );
        }

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reset(Request $request)
    {
        Schema::disableForeignKeyConstraints();
        DB::table($this->repository->model()->getTable())->truncate();
        Schema::enableForeignKeyConstraints();

        // Reseed
        Artisan::call('db:seed', ['--class' => 'PermissionsTableSeeder']);
        Artisan::call('db:seed', ['--class' => 'RolesTableSeeder']);

        return back();
    }
}
