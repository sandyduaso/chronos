<?php

namespace Page\Policies;

use Page\Models\Page;
use Pluma\Support\Policy\Policy;
use User\Models\User;

class PagePolicy extends Policy
{
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
        return $this->unrestricted('pages') || $user->id === $page->user->id;
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
        return $this->unrestricted('pages') || $user->id === $page->user->id;
    }
}
