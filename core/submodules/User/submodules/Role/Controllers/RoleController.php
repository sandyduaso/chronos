<?php

namespace Role\Controllers;

use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
use Role\Models\Role;
use Role\Repositories\RoleRepository;
use Role\Requests\RoleRequest;

class RoleController extends AdminController
{
    use Resources\RoleResourceAdminTrait;

    /**
     * Inject the resource model to the repository instance.
     *
     * @param \Pluma\Models\Model $model
     */
    public function __construct()
    {
        $this->repository = new RoleRepository();

        parent::__construct();
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $resource = Role::findOrFail($id);

        return view("Theme::roles.show")->with(compact('resource'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $resource = Role::findOrFail($id);
        $grants = Grant::pluck('name', 'id');

        return view("Theme::roles.edit")->with(compact('resource', 'grants'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Role\Requests\RoleRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->name = $request->input('name');
        $role->code = $request->input('code');
        $role->description = $request->input('description');
        $role->alias = $request->input('alias');
        $role->save();
        $role->grants()->sync($request->input('grants'));

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        if (! in_array($role->code, config('auth.rootroles', []))) {
            $role->delete();
        }

        return redirect()->route('roles.index');
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        $resources = Role::onlyTrashed()->paginate();

        return view("Theme::roles.trashed")->with(compact('resources'));
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request, $id)
    {
        $role = Role::onlyTrashed()->findOrFail($id);
        $role->restore();

        return back();
    }

    /**
     * Delete the specified resource from storage permanently.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $id)
    {
        $role = Role::withTrashed()->findOrFail($id);
        $role->forceDelete();

        return redirect()->route('roles.trashed');
    }
}
