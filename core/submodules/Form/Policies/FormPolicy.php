<?php

namespace Form\Policies;

use Form\Models\Form;
use User\Models\User;

class FormPolicy
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
     * @param  Form\Models\Form  $form
     * @return bool
     */
    public function view(User $user, Form $form)
    {
        return true;
    }

    /**
     * Determine if the given resource can be updated by the user.
     *
     * @param  User\Models\User  $user
     * @param  Form\Models\Form  $form
     * @return bool
     */
    public function update(User $user, Form $form)
    {
        return $user->id === $form->user_id;
    }

    /**
     * Determine if the given resource can be deleted by the user.
     *
     * @param  User\Models\User  $user
     * @param  Form\Models\Form  $form
     * @return bool
     */
    public function delete(User $user, Form $form)
    {
        return $user->id === $form->user_id;
    }
}
