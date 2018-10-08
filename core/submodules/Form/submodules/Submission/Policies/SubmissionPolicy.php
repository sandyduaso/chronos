<?php

namespace Submission\Policies;

use Submission\Models\Submission;
use User\Models\User;

class SubmissionPolicy
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
        dd('asd');
        if ($user->isRoot()) {
            return true;
        }
    }

    /**
     * Determine if the given resource can be viewed by the user.
     *
     * @param  User\Models\User  $user
     * @param  Submission\Models\Submission  $form
     * @return bool
     */
    public function view(User $user, Submission $form)
    {
        return true;
    }

    /**
     * Determine if the given resource can be updated by the user.
     *
     * @param  User\Models\User  $user
     * @param  Submission\Models\Submission  $form
     * @return bool
     */
    public function update(User $user, Submission $form)
    {
        return $user->id === $form->user_id;
    }

    /**
     * Determine if the given resource can be deleted by the user.
     *
     * @param  User\Models\User  $user
     * @param  Submission\Models\Submission  $form
     * @return bool
     */
    public function delete(User $user, Submission $form)
    {
        return $user->id === $form->user_id;
    }
}
