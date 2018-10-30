<?php

namespace Role\Support\Accessors;

trait RoleAccessor
{
    /**
     * Retrieve the permissions count for the resource.
     *
     * @return int
     */
    public function getPermissionCountAttribute()
    {
        return $this->permissions->count();
    }
}
