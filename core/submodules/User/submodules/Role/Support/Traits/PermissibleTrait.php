<?php

namespace Role\Support\Traits;

trait PermissibleTrait
{
    /**
     * Array of permissions.
     *
     * @var array
     */
    protected $permissions;

    /**
     * Sets the array of permissions.
     *
     * @param array $roles
     * @return  void
     */
    public function setPermissions($roles)
    {
        foreach ($roles as $role) {
            if ($role->permissions()->exists()) {
                foreach ($role->permissions as $permission) {
                    $this->permissions [] = $permission;
                }
            }
        }
    }
}
