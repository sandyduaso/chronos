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
        $resources = $this->repository->grouped();

        return view('Role::permissions.index')->with(compact('resources'));
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
