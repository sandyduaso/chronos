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
