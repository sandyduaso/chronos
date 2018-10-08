<?php

namespace Field\Support\Traits;

use Crowfeather\Traverser\Traverser;

trait FieldMutatorTrait
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
}
