<?php

namespace Form\Support\Traits;

use Crowfeather\Traverser\Traverser;

trait FormMutatorTrait
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
    function getExamineesAttribute()
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
