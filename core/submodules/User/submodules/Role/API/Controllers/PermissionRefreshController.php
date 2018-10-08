<?php

namespace Role\API\Controllers;

use Illuminate\Http\Request;
use Pluma\API\Controllers\APIController;
use Role\Models\Permission;

class PermissionRefreshController extends APIController
{
    /**
     * Get all resources.
     *
     * @param  Illuminate\Http\Request $request [description]
     * @return Illuminate\Http\Response
     */
    public function postRefresh(Request $request)
    {
        try {
            $permissions = get_permissions();

            foreach ($permissions as $permission) {
                $permissions = require_once $permission;

                collect($permissions)->chunk($this->chunk, function ($subset) {
                    $subset->each(function ($permission) {
                        Permission::updateOrCreate(['code' => $permission['code']], $permission);
                    });
                });
            }
        } catch (Exception $e) {
            return response()->json(['response' => 500, 'message' => $e->getMessage()]);
        }

        return response()->json(['response' => 200, 'message' => 'Success']);
    }
}
