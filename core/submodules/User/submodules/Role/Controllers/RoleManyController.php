<?php

namespace Role\Controllers;

use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
use Role\Models\Role;

class RoleManyController extends AdminController
{
    /**
     * Restore the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request)
    {
        foreach ($request->input('roles') as $id) {
            $role = Role::onlyTrashed()->findOrFail($id);
            $role->restore();
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        foreach ($request->input('roles') as $id) {
            $role = Role::findOrFail($id);
            $role->delete();
        }

        return redirect()->route('roles.index');
    }

    /**
     * Delete the specified resource from storage permanently.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        foreach ($request->input('roles') as $id) {
            $role = Role::withTrashed()->findOrFail($id);
            $role->forceDelete();
        }

        return back();
    }
}
