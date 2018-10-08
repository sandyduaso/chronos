<?php

namespace User\Policies;

use User\Models\User;

class UserPolicy
{
    /**
     * Run before any action in this class.
     *
     * @param  \User\Models\User $user
     * @param  string $ability
     * @return mixed
     */
    // public function before($user, $ability)
    // {
    //     if ($user->isRoot()) {
    //         return true;
    //     }
    // }

    /**
     * Determine if the given resource can be updated by the user.
     *
     * @param  \User\Models\User  $user
     * @param  \User\Models\User  $resource
     * @return bool
     */
    public function update(User $user, User $resource)
    {
        return $user->id === $resource->id;
    }

    /**
     * Determine if the given resource can be deleted by the user.
     *
     * @param  \User\Models\User  $user
     * @param  \User\Models\User  $resource
     * @return bool
     */
    public function delete(User $user, User $resource)
    {
        // User cannot delete self.
        return (! $resource->isRoot()) && (! $user->id === $resource->id);
    }
}
