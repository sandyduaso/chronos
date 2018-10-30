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
     * @param string $key
     * @return boolean
     */
    public function isPermittedTo($code, $key = 'code')
    {
        return in_array($code, $this->permissions->pluck($key)->toArray());
    }
}
