<?php

namespace Page\Support\Mutators;

trait PageMutator
{
    /**
     * Retrieve the user's displayname.
     *
     * @return string
     */
    public function getAuthorAttribute()
    {
        return ! $this->user ?: $this->user->displayname;
    }

    /**
     * Retrieve the author's profile picture.
     *
     * @return string
     */
    public function getProfileAttribute()
    {
        return ! $this->user ?: $this->user->photo;
    }
}
