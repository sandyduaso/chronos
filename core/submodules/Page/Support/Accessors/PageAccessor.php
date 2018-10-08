<?php

namespace Page\Support\Accessors;

trait PageAccessor
{
    /**
     * Retrieve the user's displayname.
     *
     * @return [type] [description]
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
