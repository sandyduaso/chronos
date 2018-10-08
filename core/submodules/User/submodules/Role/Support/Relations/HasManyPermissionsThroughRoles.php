<?php

namespace Role\Support\Relations;

use Illuminate\Support\Facades\DB;
use Role\Models\Permission;
use Role\Models\Role;

trait HasManyPermissionsThroughRoles
{
    /**
     * Get all of the permissions for the resource.
     *
     * @return Illuminate\Database\Eloquent\Model
     */
    public function permissions()
    {
        return $this->hasManyThroughMany(Permission::class, Role::class);
    }

    /**
     * Determine if the resource has a given ability.
     *
     * @param string $code
     * @return boolean
     */
    public function isPermittedTo($code)
    {
        foreach ($this->permissions as $permission) {
            if ($permission->code === $code) {
                return true;
            }
        }

        return false;
    }
}
