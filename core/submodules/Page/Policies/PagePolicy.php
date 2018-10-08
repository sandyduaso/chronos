<?php

namespace Page\Policies;

use Page\Models\Page;
use User\Models\User;

class PagePolicy
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
     * @param  Page\Models\Page  $page
     * @return bool
     */
    public function view(User $user, Page $page)
    {
        return true;
    }

    /**
     * Determine if the given resource can be updated by the user.
     *
     * @param  User\Models\User  $user
     * @param  Page\Models\Page  $page
     * @return bool
     */
    public function update(User $user, Page $page)
    {
        return $user->id === $page->user_id;
    }

    /**
     * Determine if the given resource can be deleted by the user.
     *
     * @param  User\Models\User  $user
     * @param  Page\Models\Page  $page
     * @return bool
     */
    public function delete(User $user, Page $page)
    {
        return $user->id === $page->user_id;
    }
}
