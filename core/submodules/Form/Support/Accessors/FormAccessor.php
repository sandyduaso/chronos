<?php

namespace Form\Support\Accessors;

use Crowfeather\Traverser\Traverser;

trait FormAccessor
{
    /**
     * Gets the user's displayname.
     *
     * @return string
     */
    public function getAuthorAttribute()
    {
        return ! $this->user ?: $this->user->displayname;
    }

    /**
     * Alias for submissions relation.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getExamineesAttribute()
    {
        return $this->submissions;
    }

    /**
     * Gets the employee count submitted.
     *
     * @return string
     */
    public function getCountAttribute()
    {
        return $this->submissions->count();
    }
}
