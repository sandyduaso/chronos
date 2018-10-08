<?php

namespace Field\Policies;

use Field\Models\Field;
use User\Models\User;

class FieldPolicy
{
    /**
     * Run before any action in this class.
     *
     * @param  User\Models\User $user
     * @param  string $ability
     * @return mixed
     */
    public function before(User $user, $ability)
    {
        if ($user->isRoot()) {
            return true;
        }
    }

    /**
     * Determine if the given resource can be viewed by the user.
     *
     * @param  User\Models\User  $user
     * @param  Field\Models\Field  $field
     * @return bool
     */
    public function view(User $user, Field $field)
    {
        return true;
    }

    /**
     * Determine if the given resource can be updated by the user.
     *
     * @param  User\Models\User  $user
     * @param  Field\Models\Field  $field
     * @return bool
     */
    public function update(User $user, Field $field)
    {
        return $user->id === $field->user_id;
    }

    /**
     * Determine if the given resource can be deleted by the user.
     *
     * @param  User\Models\User  $user
     * @param  Field\Models\Field  $field
     * @return bool
     */
    public function delete(User $user, Field $field)
    {
        return $user->id === $field->user_id;
    }
}
