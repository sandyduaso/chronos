<?php

namespace Role\Support\Relations;

use Role\Models\Role;

trait BelongsToManyRoles
{
    /**
     * Keywords listed in this array will be excluded from role checking.
     * All roles listed here will have unrestricted access to the application.
     *
     * @var array
     */
    protected $rootRoles = [
        'root',
        'dev',
        'superadmin',
        'super-administrator',
        'super-admin',
    ];

    /**
     * The column's key name used to check for a role's given code.
     *
     * @var string
     */
    protected $columnKey = 'code';

    /**
     * Gets all Role resources associated
     * with this model.
     *
     * @return Illuminate\Database\Eloquent\Model
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Alias for isRoot.
     *
     * @return boolean
     */
    public function isSuperAdmin()
    {
        return $this->isRoot();
    }

    /**
     * Determine if the user's role is in the root roles list.
     *
     * @return boolean
     */
    public function isRoot()
    {
        foreach ($this->roles as $role) {
            if (in_array($role->{$this->columnKey}, $this->rootRoles())) {
                return true;
            }
        }

        return false;
    }

    /**
     * Gets the root roles.
     *
     * @return array
     */
    protected function rootRoles()
    {
        return array_merge($this->rootRoles, config('auth.roles', []));
    }

    /**
     * Determine if user has the given role.
     *
     * @param  string  $role
     * @param  string $columnKey
     * @return boolean
     */
    public function as($role, $columnKey = false)
    {
        $columnKey = $columnKey ?: $this->columnKey;

        return $this->roles()
            ->where($columnKey, $role)
            ->orWhere('name', $role)
            ->exists();
    }

    /**
     * Determine if user has the given roles.
     *
     * @param  string\array  $roles
     * @param  string $columnKey
     * @return boolean
     */
    public function hasRole($roles, $columnKey = false)
    {
        $columnKey = $columnKey ?: $this->columnKey;

        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->as(trim($role), $columnKey)) {
                    return true;
                }
            }
        } else {
            return $this->as($roles, $columnKey);
        }

        return false;
    }
}
